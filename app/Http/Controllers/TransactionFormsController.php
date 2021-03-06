<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment;
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
        $forms =  TransactionForm::orderBy('created_at', 'desc')->get();
        return view('student.home')->with('forms',$forms);
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
    public function show($id)
    {
        $form = TransactionForm::find($id);
        return view('student.home')->with('form', $form);
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
}
