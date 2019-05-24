<?php

namespace App\Http\Controllers;

use App\Equipment;
use App\User;
use App\TransactionForm;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

use Carbon\Carbon;
use DB;

use App\Mail\Approved;
use App\Mail\Declined;
use App\Mail\Received;

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
    public function studentHome()
    {
        $transaction_forms = TransactionForm::where('user_id', auth()->user()->user_id)->get();
        $recentForms =  TransactionForm::where(['user_id' => auth()->user()->user_id, 'approval' => 1])
                                        ->orderBy('transaction_id', 'desc')
                                        ->take(5)
                                        ->get();
        $pendingForms =  TransactionForm::where(['user_id' => auth()->user()->user_id, 'approval' => 0])
                                        ->orderBy('transaction_id', 'desc')
                                        ->take(5)
                                        ->get();
        $unclaimedForms = TransactionForm::where([
                                        'user_id' => auth()->user()->user_id, 
                                        'approval' => 1,
                                        'claimed'=> 0])
                                        ->orderBy('transaction_id', 'desc')
                                        ->get();
        $unreturnedForms = TransactionForm::where([
                                            'user_id' => auth()->user()->user_id, 
                                            'approval' => 1,
                                            'claimed'=> 1,
                                            'returned' => 0])
                                            ->orderBy('transaction_id', 'desc')
                                            ->get();                         
        $lastTransaction = TransactionForm::where('user_id', auth()->user()->user_id)->where('submitted_date', null)->get()->last();

        if($lastTransaction != null){
            $countCart = Equipment::all()
                            ->where("transaction_id", "$lastTransaction->transaction_id")
                            ->groupBy('equip_name')
                            ->map(function($equipment, $equip_name) {
                                return [
                                    'equip_name' => $equip_name,
                                    'record' => $equipment->count(),
                                ];
                            })
                            ->values();
        } else {
            $countCart = null;
        }
        

        $equipments = Equipment::get();
        $totalEquip = Equipment::all();
        
        return view('student.home')->with('transaction_forms', $transaction_forms)
                                   ->with('pendingForms', $pendingForms)
                                   ->with('recentForms', $recentForms)
                                   ->with('unclaimedForms', $unclaimedForms)
                                   ->with('unreturnedForms', $unreturnedForms)
                                   ->with('lastTransaction', $lastTransaction)
                                   ->with('countCart', $countCart)
                                   ->with('equipments',$equipments)
                                   ->with('totalEquip',$totalEquip);
    }

    public function adminHome(){
        $transaction_forms = TransactionForm::orderBy('transaction_id', 'desc')
                                            ->where('approval', '>=', 0)
                                            ->where('returned', '!=', 1)
                                            ->get();
        $users = User::get();
        $equipments = Equipment::get();  
        return view('admin.home')->with('equipments',$equipments)
                                 ->with('users',$users)
                                 ->with('transaction_forms',$transaction_forms);
    }

    public function adminBalances(){
        $transaction_forms = TransactionForm::where('approval', '1')
                                            ->get();
                                          
        $users = User::where('penalty','>',0)
                     ->get();
        
        $equipments = Equipment::get();
        return view('admin.balances')->with('transaction_forms',$transaction_forms)
                                    ->with('users',$users)
                                    ->with('equipments',$equipments);
    }

    public function paidPenalty(Request $request){
        $userInput = $request->get('user');
        $formInput = $request->get('form');
        $users = User::get();

        foreach ($users as $user) {
            if($user->user_id == $userInput){
                $user->update([
                    'penalty' => 0
                ]);
            }
        }

        return redirect()->back()->with('success', 'Penalty of Student '.$userInput.' is paid.');
    }

    public function reqHistory(){
        $transaction_forms = TransactionForm::orderBy('transaction_id','desc')->get();
        $users = User::get();
        $equipments = Equipment::get();
        return view('admin.history')->with('transaction_forms',$transaction_forms)
                                    ->with('users',$users)
                                    ->with('equipments',$equipments);
    }

    public function calendar(){
        $lastTransaction = TransactionForm::where('user_id', auth()->user()->user_id)->get()->last();
        $transaction_forms = TransactionForm::where('returned', 0)->get();
        $users = User::get();
        $equipments = Equipment::orderBy('equip_name','asc')->get();
        $totalEquip = Equipment::all();
        $countCart = Equipment::all()
                                ->where("transaction_id", "$lastTransaction->transaction_id")
                                ->groupBy('equip_name')
                                ->map(function($equipment, $equip_name) {
                                    return [
                                        'equip_name' => $equip_name,
                                        'record' => $equipment->count(),
                                    ];
                                })
                                ->values(); 

        return view('admin.calendar')->with('transaction_forms',$transaction_forms)
                                     ->with('lastTransaction',$lastTransaction)
                                     ->with('users',$users) 
                                     ->with('totalEquip', $totalEquip)
                                     ->with('equipments',$equipments)
                                     ->with('countCart', $countCart);
    }

    public function cart1(){
        $lastTransaction = TransactionForm::where('user_id', auth()->user()->user_id)->get()->last();
        $totalEquip = Equipment::get();
        $equipments = Equipment::get();
        $countCart = Equipment::all()
                            ->where("transaction_id", "$lastTransaction->transaction_id")
                            ->groupBy('equip_name')
                            ->map(function($equipment, $equip_name) {
                                return [
                                    'equip_name' => $equip_name,
                                    'record' => $equipment->count(),
                                ];
                            })
                            ->values();
        $currentTransaction = TransactionForm::where('user_id', auth()->user()->user_id)
                                            ->where('submitted_date', null)
                                            ->get()->last();
        $transaction_forms = TransactionForm::get();
        
        return view('student.cart1')->with('transaction_forms',$transaction_forms)
                                    ->with('currentTransaction', $currentTransaction)
                                    ->with('countCart', $countCart)
                                    ->with('lastTransaction',$lastTransaction)
                                    ->with('equipments', $equipments)
                                    ->with('totalEquip', $totalEquip);
    }

    public function cart2(){
        $lastTransaction = TransactionForm::where('user_id', auth()->user()->user_id)->get()->last();
        $totalEquip = Equipment::get();
        $equipments = Equipment::get();
        $countCart = Equipment::all()
                            ->where("transaction_id", "$lastTransaction->transaction_id")
                            ->groupBy('equip_name')
                            ->map(function($equipment, $equip_name) {
                                return [
                                    'equip_name' => $equip_name,
                                    'record' => $equipment->count(),
                                ];
                            })
                            ->values();
        $currentTransaction = TransactionForm::where('user_id', auth()->user()->user_id)
                                            ->where('submitted_date', null)
                                            ->get()->last();
        $transaction_forms = TransactionForm::get();
        
        return view('student.cart2')->with('transaction_forms',$transaction_forms)
                                    ->with('currentTransaction', $currentTransaction)
                                    ->with('countCart', $countCart)
                                    ->with('lastTransaction',$lastTransaction)
                                    ->with('equipments', $equipments)
                                    ->with('totalEquip', $totalEquip);
    }

    public function cart3(Request $request){
        $lastTransaction = TransactionForm::where('user_id', auth()->user()->user_id)->get()->last();
        $totalEquip = Equipment::get();
        $equipments = Equipment::get();
        $countCart = Equipment::all()
                            ->where("transaction_id", "$lastTransaction->transaction_id")
                            ->groupBy('equip_name')
                            ->map(function($equipment, $equip_name) {
                                return [
                                    'equip_name' => $equip_name,
                                    'record' => $equipment->count(),
                                ];
                            })
                            ->values();
        $currentTransaction = TransactionForm::where('user_id', auth()->user()->user_id)
                                            ->where('submitted_date', null)
                                            ->get()->last();
        //dd($currentTransaction);
        $transaction_forms = TransactionForm::get();
        $users = User::get();
   
        

        $startDate = Carbon::parse($request->get('startdate'))->toDateString();
        $startTime = Carbon::parse($request->get('starttime'))->format('h:i:s');
        $endDate = Carbon::parse($request->get('enddate'))->toDateString();
        $endTime = Carbon::parse($request->get('endtime'))->format('h:i:s');
        
        $now = Carbon::now();
        $start = Carbon::parse($startDate." ".$startTime)->toDateTimeString();
        $end = Carbon::parse($endDate." ".$endTime)->toDateTimeString();

        if (Carbon::parse($start)->diffInHours($now)<3){
            return redirect('student/cart2')->with('errorMsg','The start date and time cannot be less than 3 hours from now. Please try again.');
        }
        else if (Carbon::parse($start)->equalTo($end)){
            return redirect('student/cart2')->with('errorMsg','The start and end of the reservation period cannot be the same. Please try again.');
        }
        else {
        $currentTransaction->update([
            'start_time' => $startTime,
            'end_time' => $endTime,
            'start_date' => $startDate,
            'due_date' => $endDate,
            'purpose' => $request->get('reason'),
            'room_number' => $request->get('roomnumber')
        ]);

        $currentTransaction->save();
        }
        
        return view('student.cart3')->with('transaction_forms',$transaction_forms)
                                    ->with('currentTransaction', $currentTransaction)
                                    ->with('countCart', $countCart)
                                    ->with('lastTransaction',$lastTransaction)
                                    ->with('equipments', $equipments)
                                    ->with('totalEquip', $totalEquip)
                                    ->with('users', $users);
    }

    public function submitForm(Request $request){
        $totalEquip = Equipment::get();
        $equipments = Equipment::get();
        $transaction_forms = TransactionForm::get();
        

        $currentTransaction = TransactionForm::where('user_id', auth()->user()->user_id)
                                            ->where('submitted_date', null)
                                            ->get()->last();
        $currentTransaction->update([
            'submitted_date' => Carbon::now(),
            'approval' => 0,
            'claimed' => 0,
            'returned' => 0
        ]);

        $currentTransaction->save();

        $request->merge([
            'sub_date' => $currentTransaction->submitted_date, 
            'start_date' => $currentTransaction->start_date,
            'start_time' => $currentTransaction->start_time,
            'end_date' => $currentTransaction->due_date, 
            'end_time' => $currentTransaction->end_time
            ]);
        //dd($request);

        $lastTransaction = TransactionForm::where('user_id', auth()->user()->user_id)->where('submitted_date', null)->get()->last();

        $countCart = null;

        $pendingForms =  TransactionForm::where(['user_id' => auth()->user()->user_id, 'approval' => 0])
                                        ->orderBy('transaction_id', 'desc')
                                        ->take(5)
                                        ->get();
                                        $recentForms =  TransactionForm::where(['user_id' => auth()->user()->user_id, 'approval' => 1])
                                        ->orderBy('transaction_id', 'desc')
                                        ->take(5)
                                        ->get();
        $unclaimedForms = TransactionForm::where([
                                        'user_id' => auth()->user()->user_id, 
                                        'approval' => 1,
                                        'claimed'=> 0])
                                        ->orderBy('transaction_id', 'desc')
                                        ->get();
        $unreturnedForms = TransactionForm::where([
                                            'user_id' => auth()->user()->user_id, 
                                            'approval' => 1,
                                            'claimed'=> 1,
                                            'returned' => 0])
                                            ->orderBy('transaction_id', 'desc')
                                            ->get(); 
        $recentForms =  TransactionForm::where(['user_id' => auth()->user()->user_id, 'approval' => 1])
                                        ->orderBy('transaction_id', 'desc')
                                        ->take(5)
                                        ->get();
        
        Mail::to('ac01f813b2-8ea59b@inbox.mailtrap.io')->send(new Received($request)); 
        return redirect('student/home')->with('success', 'Form Submitted')
                                ->with('transaction_forms', $transaction_forms)
                                ->with('countCart', $countCart)
                                ->with('pendingForms', $pendingForms)
                                ->with('recentForms', $recentForms)
                                ->with('unclaimedForms', $unclaimedForms)
                                ->with('unreturnedForms', $unreturnedForms)
                                ->with('lastTransaction',$lastTransaction)
                                ->with('equipments',$equipments)
                                ->with('totalEquip', $totalEquip);
    }

    public function studentHistory(){
        $lastTransaction = TransactionForm::where('user_id', auth()->user()->user_id)->get()->last();
        $transaction_forms = TransactionForm::where('user_id', auth()->user()->user_id)->get();
        $equipments = Equipment::get();
        $totalEquip = Equipment::get();
        $countCart = Equipment::all()
                            ->where("transaction_id", "$lastTransaction->transaction_id")
                            ->groupBy('equip_name')
                            ->map(function($equipment, $equip_name) {
                                return [
                                    'equip_name' => $equip_name,
                                    'record' => $equipment->count(),
                                ];
                            })
                            ->values();
        return view('student.history')->with('transaction_forms',$transaction_forms)
                                      ->with('countCart', $countCart)
                                      ->with('lastTransaction',$lastTransaction)
                                      ->with('totalEquip', $totalEquip)
                                      ->with('equipments',$equipments);
    }

    public function studentContact(){
        $lastTransaction = TransactionForm::where('user_id', auth()->user()->user_id)->get()->last();
        $equipments = Equipment::get();
        $totalEquip = Equipment::all();

        $countCart = Equipment::all()
                            ->where("transaction_id", "$lastTransaction->transaction_id")
                            ->groupBy('equip_name')
                            ->map(function($equipment, $equip_name) {
                                return [
                                    'equip_name' => $equip_name,
                                    'record' => $equipment->count(),
                                ];
                            })
                            ->values();

        return view('student.contact')->with('lastTransaction',$lastTransaction)
                                      ->with('countCart', $countCart)
                                      ->with('totalEquip', $totalEquip)
                                      ->with('equipments',$equipments);
    }

    public function transactionApproval(Request $request){
        $decision = $request->get('decision');
        $equipments = Equipment::get();

        //dd($decision);
        if($decision == "Approve"){
            TransactionForm::where('transaction_id', $request->get('currentForm'))
                            ->update([
                                'approval' => '1',
                                'approval_date' => Carbon::now()
                            ]);
            //dd($request);
            Mail::to('ac01f813b2-8ea59b@inbox.mailtrap.io')->send(new Approved($request));               
            return redirect()->back()->with('success', 'Transaction Form has been successfully Approved!');
        } else {
            TransactionForm::where('transaction_id', $request->get('currentForm'))
                            ->update([
                                'approval' => '-1',
                                'approval_date' => Carbon::now()
                            ]);
            Mail::to('ac01f813b2-8ea59b@inbox.mailtrap.io')->send(new Declined($request)); 
            return redirect()->back()->with('success', 'Transaction Form has been successfully Declined!');
        }

        
    }

    public function cancelForm(Request $request){
        $equipments = Equipment::get();
         
        TransactionForm::where('transaction_id', $request->get('currentForm'))
                            ->update([
                                'approval' => '-2',
                                'approval_date' => null,
                                'cancelled_date' => Carbon::now()
                            ]);
            
            foreach ($equipments as $equipment) {
                if ($equipment->transaction_id == $request->get('currentForm')) {
                    $equipment->update([
                        'equip_avail' => '0',
                        'transaction_id' => null
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Transaction Form has been successfully Cancelled!');
    }

    public function afterApproval(Request $request){
        if($request->get('claimed')){
            TransactionForm::where('transaction_id', $request->get('currentForm'))
                            ->update(array('claimed' => '1', 'claimed_date' => Carbon::now()));
            
            return redirect()->back()->with('success', 'Transaction# '.$request->get('currentForm').' has been successfully claimed!');
        }
    }
}
