<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransactionForm;
use App\User;

class PagesController extends Controller
{
    public function index(){
        return view('pages.landingPage');
    }

    //Student
    public function studentHome(){
        return view('student.home');
    }

    public function studentContact(){
        return view('student.contact');
    }

    public function studentHistory(){
        return view('student.history');
    }

    public function studentCart(){
        return view('student.cart1');
    }

    public function studentCart2(){
        return view('student.cart2');
    }

    public function studentCart3(){
        return view('student.cart3');
    }

    public function studentArtEquip(){
        return view('equip.art_equipment');
    }

    public function studentCamEquip(){
        return view('equip.cam_equipment');
    }
    
    public function studentSportEquip(){
        return view('equip.sport_equipment');
    }

    public function studentMiscEquip(){
        return view('equip.misc_equipment');
    }

    public function studentLapEquip(){
        return view('equip.laptop_equipment');
    }

    public function studentsGameEquip(){
        return view('equip.gaming_equipment');
    }

    //Admin
    public function adminHome(){
        return view('admin.home');
    }

    public function adminBalances(){
        return view('admin.balances');
    }

    public function reqHistory(){
        return view('admin.history');
    }

    public function adminCalendar(){
        return view('admin.calendar');
    }
    
    public function adminFeedbacks(){
        return view('admin.feedbacks');
    }

    public function adminArtEquip(){
        return view('equip.art_equipment');
    }

    public function adminCamEquip(){
        return view('equip.cam_equipment');
    }
    
    public function adminSportEquip(){
        return view('equip.sport_equipment');
    }

    public function adminMiscEquip(){
        return view('equip.misc_equipment');
    }

    public function adminLapEquip(){
        return view('equip.laptop_equipment');
    }

    public function adminGameEquip(){
        return view('equip.gaming_equipment');
    }
}
