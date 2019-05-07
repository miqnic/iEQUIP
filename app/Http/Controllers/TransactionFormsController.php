<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment;
use App\User;
use App\TransactionForm;

use DB;
use Illuminate\Support\Facades\Storage;

class TransactionFormsController extends Controller
{
    public function user()
    {
        return $this->belongsTo('App\User','foreign_key');
    }

    public function equipment()
    {
        return $this->hasMany('App\Equipment','foreign_key');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction_forms = TransactionForm::where('user_id', auth()->user()->user_id)->get();
        $recentForms =  TransactionForm::where(['user_id' => auth()->user()->user_id, 'approval' => 1])
                                        ->orderBy('transaction_id', 'desc')
                                        ->take(5)
                                        ->get();
        $equipments = Equipment::get();
        return view('student.home')->with('transaction_forms', $transaction_forms)
                                   ->with('recentForms', $recentForms)
                                   ->with('equipments',$equipments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.cart2');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'start_date' => 'required',
            'due_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'purpose' => 'required',
            'room_number' => 'required'
        ]);

        //Create Transaction Form
        $form = new TransactionForm;
        $form->start_date = $request->input('start_date');
        $form->due_date = $request->input('due_date');
        $form->start_time = $request->input('start_time');
        $form->end_time = $request->input('end_time');
        $form->purpose = $request->input('purpose');
        $form->room_number = $request->input('room_number');

        $form->student_id = auth()->user()->student_id;
        $form->submitted_date = date('Y-m-d H:i:s');
        $form->save();

        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $form = TransactionForm::find($id);
        return view('student.home')->with('form',$form);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Use update to cancel a form

        $form = TransactionForm::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $form->delete();
        return redirect('student.home')->with('success', 'Form Removed');
    }

    public function adminHome(){
        $transaction_forms = TransactionForm::orderBy('transaction_id', 'desc')
                                            ->where('approval', '!=', 0)
                                            ->where('returned', '!=', 1)
                                            ->get();
        $users = User::get();
        $equipments = Equipment::get();
        return view('admin.home')->with('equipments',$equipments)
                                 ->with('users',$users)
                                 ->with('transaction_forms',$transaction_forms);
    }

    public function adminBalances(){
        $transaction_forms = TransactionForm::get();
        $users = User::where('penalty','>',0)
                     ->get();
        $equipments = Equipment::get();
        return view('admin.balances')->with('transaction_forms',$transaction_forms)
                                    ->with('users',$users)
                                    ->with('equipments',$equipments);
    }

    public function reqHistory(){
        $transaction_forms = TransactionForm::get();
        $users = User::get();
        $equipments = Equipment::get();
        return view('admin.history')->with('transaction_forms',$transaction_forms)
                                    ->with('users',$users)
                                    ->with('equipments',$equipments);
    }

    public function adminCalendar(){
        $transaction_forms = TransactionForm::where('returned', 0)->get();
        $users = User::get();
        $equipments = Equipment::get();
        return view('admin.calendar')->with('transaction_forms',$transaction_forms)
                                     ->with('users',$users) 
                                     ->with('equipments',$equipments);
    }

    public function studentHistory(){
        $transaction_forms = TransactionForm::where('user_id', auth()->user()->user_id)->get();
        $equipments = Equipment::get();
        return view('student.history')->with('transaction_forms',$transaction_forms)
                                      ->with('equipments',$equipments);
    }
}
