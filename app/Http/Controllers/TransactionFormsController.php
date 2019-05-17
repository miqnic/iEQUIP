<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment;
use App\User;
use App\TransactionForm;
use Carbon\Carbon;

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
        $lastTransaction = TransactionForm::where('user_id', auth()->user()->user_id)->get()->last();
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

        $equipments = Equipment::get();
        $totalEquip = Equipment::all();
        
        return view('student.home')->with('transaction_forms', $transaction_forms)
                                   ->with('pendingForms', $pendingForms)
                                   ->with('recentForms', $recentForms)
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

    public function reqHistory(){
        $transaction_forms = TransactionForm::get();
        $users = User::get();
        $equipments = Equipment::get();
        return view('admin.history')->with('transaction_forms',$transaction_forms)
                                    ->with('users',$users)
                                    ->with('equipments',$equipments);
    }

    public function adminCalendar(){
        $lastTransaction = TransactionForm::where('user_id', auth()->user()->user_id)->get()->last();
        $transaction_forms = TransactionForm::where('returned', 0)->get();
        $users = User::get();
        $equipments = Equipment::get();
        $totalEquip = Equipment::all();
        return view('admin.calendar')->with('transaction_forms',$transaction_forms)
                                     ->with('lastTransaction',$lastTransaction)
                                     ->with('users',$users) 
                                     ->with('totalEquip', $totalEquip)
                                     ->with('equipments',$equipments);
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

   
        $currentTransaction->update([
            'start_time' => Carbon::parse($request->get('starttime')),
            'end_time' => Carbon::parse($request->get('endtime')),
            'start_date' => Carbon::parse($request->get('startdate')),
            'due_date' => Carbon::parse($request->get('enddate')),
            'purpose' => $request->get('reason'),
            'room_number' => $request->get('roomnumber'),
        ]);

        $currentTransaction->save();
        
        return view('student.cart3')->with('transaction_forms',$transaction_forms)
                                    ->with('currentTransaction', $currentTransaction)
                                    ->with('countCart', $countCart)
                                    ->with('lastTransaction',$lastTransaction)
                                    ->with('equipments', $equipments)
                                    ->with('totalEquip', $totalEquip);
    }

    public function submitForm(){
        $lastTransaction = TransactionForm::where('user_id', auth()->user()->user_id)->where('submitted_date', '!=', null)->get()->last();
        $totalEquip = Equipment::get();
        $transaction_forms = TransactionForm::get();
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
        $currentTransaction->update([
            'submitted_date' => Carbon::now(),
            'approval' => 0,
            'claimed' => 0,
            'returned' => 0
        ]);

        $pendingForms =  TransactionForm::where(['user_id' => auth()->user()->user_id, 'approval' => 0])
                                        ->orderBy('transaction_id', 'desc')
                                        ->take(5)
                                        ->get();

        $currentTransaction->save();

        

        return view('student.home')->with('success', 'Form Submitted')
                                ->with('transaction_forms', $transaction_forms)
                                ->with('countCart', $countCart)
                                ->with('pendingForms', $pendingForms)
                                ->with('lastTransaction',$lastTransaction)
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

            return redirect()->back()->with('success', 'Transaction Form has been successfully Approved!');
        } else {
            TransactionForm::where('transaction_id', $request->get('currentForm'))
                            ->update([
                                'approval' => '-1',
                                'approval_date' => Carbon::now()
                            ]);

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
