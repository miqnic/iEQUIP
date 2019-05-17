<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransactionForm;
use App\Equipment;
use App\User;

class PagesController extends Controller
{
    public function index(){
        return view('pages.landingPage');
    }

    public function deleteSingleModal(Request $request){
        $currentEquip = $request->get('currentEquip');

        return view('inc.deleteSingleModal')->with('currentEquip', $currentBreak);
    }

}
