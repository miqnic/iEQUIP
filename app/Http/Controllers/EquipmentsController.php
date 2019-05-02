<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment;
use App\TransactionForm;
use DB;
use Illuminate\Support\Facades\Storage;

class EquipmentsController extends Controller
{
    public $countTotalAvail;
    public $countCurrAvail;

    public function __construct()
    {
        $this->countTotalAvail = Equipment::all()
                            ->groupBy('equip_name')
                            ->map(function($equipment, $equip_name) {
                                return [
                                    'equip_name' => $equip_name,
                                    'record' => $equipment->count(),
                                ];
                            })
                            ->values();

        $this->countCurrAvail = Equipment::all()
                            ->where('equip_avail', '0')
                            ->groupBy('equip_name')
                            ->map(function($equipment, $equip_name) {
                                return [
                                    'equip_name' => $equip_name,
                                    'record' => $equipment->count(),
                                ];
                            })
                            ->values();
    }

    public function transaction_forms()
    {
        return $this->belongsTo('App\Transaction','foreign_key');
    }

    public function addEquipment(){
        if(auth()->user()->access_role != 'ADMIN'){
            return abort(403, 'Unauthorized action.');
        }

        $this->validate($request, [
            'equipID' => 'required',
            'equip_name' => 'required',
            'equip_category' => 'required',
            'equip_description' => 'required',
            'equip_penalty' => 'required',
            'equip_img' => 'image|nullable|max:1999'
        ]);

        //Create Equipment
        $equipment = new Equipment;
        $equipment->equipID = $request->input('equipID');
        $equipment->equip_name = $request->input('equip_name');
        $equipment->equip_category = $request->input('equip_category');
        $equipment->equip_description = $request->input('equip_description');
        $equipment->equip_penalty = $request->input('equip_penalty');
        $equipment->equip_img = $fileNameToStore;

        $equipment->equip_avail = '0'; //available
        $equipment->returned = true;
        $equipment->transaction_id = '';

        //Handle File Upload
        if($request->hasFile('equip_img')){
            //Get a filename with the extension
            $fileNameWithExt = $request->file('equip_img')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('equip_img')->getClientOriginalExtension();
            //Filename to store (has to be unique)
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('equip_img')->storeAs('public/equip_img', $fileNameToStore);
        } else {
            $fileNameToStore = 'noImage.jpg';
        }

        $equipment->save();

        return redirect('/admin/equipment')->with('success', 'Equipment Created');
    }

    //SHOW EQUIPMENT START

    public function showCamEquipment(){
        /*$equipment = Equipment::find($id);
        //please change show URL with {id}
        return view('posts.show')->with('equipment', $equipment);*/

        if(auth()->user()->access_role != 'ADMIN'){
            $equipments =  Equipment::where('equip_category', 'CAMACC')
                                    ->where('equip_avail', '0')
                                    ->orderBy('equip_name', 'desc')
                                    ->get();
        } else {
            $equipments =  Equipment::where('equip_category', 'CAMACC')->orderBy('equip_name', 'desc')->get();            
        }

        return view('equip.cam_equipment')->with('equipments',$equipments)
                                            ->with('countTotalAvail', $this->countTotalAvail)
                                            ->with('countCurrAvail', $this->countCurrAvail);
    } 

    public function showArtEquipment(){
        if(auth()->user()->access_role != 'ADMIN'){
            $equipments =  Equipment::where('equip_category', 'ART')
                                    ->where('equip_avail', '0')
                                    ->orderBy('equip_name', 'desc')
                                    ->get();
        } else {
            $equipments =  Equipment::where('equip_category', 'ART')->orderBy('equip_name', 'desc')->get();            
        }

        return view('equip.art_equipment')->with('equipments',$equipments)
                                            ->with('countTotalAvail', $this->countTotalAvail)
                                            ->with('countCurrAvail', $this->countCurrAvail);
    } 

    public function showSportEquipment(){
        if(auth()->user()->access_role != 'ADMIN'){
            $equipments =  Equipment::where('equip_category', 'SPRT')
                                    ->where('equip_avail', '0')
                                    ->orderBy('equip_name', 'desc')
                                    ->get();
        } else {
            $equipments =  Equipment::where('equip_category', 'SPRT')->orderBy('equip_name', 'desc')->get();            
        }

        return view('equip.sport_equipment')->with('equipments',$equipments)
                                            ->with('countTotalAvail', $this->countTotalAvail)
                                            ->with('countCurrAvail', $this->countCurrAvail);
    } 

    public function showMiscEquipment(){
        if(auth()->user()->access_role != 'ADMIN'){
            $equipments =  Equipment::where('equip_category', 'MISC')
                                    ->where('equip_avail', '0')
                                    ->orderBy('equip_name', 'desc')
                                    ->get();
        } else {
            $equipments =  Equipment::where('equip_category', 'MISC')->orderBy('equip_name', 'desc')->get();            
        }

        return view('equip.misc_equipment')->with('equipments',$equipments)
                                            ->with('countTotalAvail', $this->countTotalAvail)
                                            ->with('countCurrAvail', $this->countCurrAvail);
    } 

    public function showLapEquipment(){
        if(auth()->user()->access_role != 'ADMIN'){
            $equipments =  Equipment::where('equip_category', 'LPTP')
                                    ->where('equip_avail', '0')
                                    ->orderBy('equip_name', 'desc')
                                    ->get();
        } else {
            $equipments =  Equipment::where('equip_category', 'LPTP')->orderBy('equip_name', 'desc')->get();            
        }

        return view('equip.laptop_equipment')->with('equipments',$equipments)
                                            ->with('countTotalAvail', $this->countTotalAvail)
                                            ->with('countCurrAvail', $this->countCurrAvail);
    }
    
    public function showGameEquipment(){
        if(auth()->user()->access_role != 'ADMIN'){
            $equipments =  Equipment::where('equip_category', 'GMNG')
                                    ->where('equip_avail', '0')
                                    ->orderBy('equip_name', 'desc')
                                    ->get();
        } else {
            $equipments =  Equipment::where('equip_category', 'GMNG')->orderBy('equip_name', 'desc')->get();            
        }

        return view('equip.gaming_equipment')->with('equipments',$equipments)
                                            ->with('countTotalAvail', $this->countTotalAvail)
                                            ->with('countCurrAvail', $this->countCurrAvail);
    } 

    public function showCurrentlyBorrowed(){
        $transaction_forms = TransactionForm::get();

        $equipments = Equipment::where('equip_avail', '1')
                                ->get();
        
        return view('admin.home')->with('equipments',$equipments)
                                ->with('transaction_forms',$transaction_forms);
    }

    //SHOW EQUIPMENT END

    public function deleteEquipment($equipID){
        $equipment = Equipment::find($equipID);
        
        //Check if admin
        if(auth()->user()->access_role != 'ADMIN'){
            return abort(403, 'Unauthorized action.');
        }

        $equipment->delete();
        return redirect('/admin/equipment')->with('success', 'Equipment Removed');
    } 

    public function editEquipment(Request $request, $id){
        //Check if admin
        if(auth()->user()->access_role != 'ADMIN'){
            return abort(403, 'Unauthorized action.');
        }

        //Update Equipment Details
        $equipment = Equipment::find($equipID);
        $equipment->equipID = $request->input('equipID');
        $equipment->equip_name = $request->input('equip_name');
        $equipment->equip_category = $request->input('equip_category');
        $equipment->equip_description = $request->input('equip_description');
        $equipment->equip_penalty = $request->input('equip_penalty');

        //Updating Equipment Image
        if($request->hasFile('equip_img')){
            //Get a filename with the extension
            $fileNameWithExt = $request->file('equip_img')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('equip_img')->getClientOriginalExtension();
            //Filename to store (has to be unique)
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('equip_img')->storeAs('public/equip_imgs', $fileNameToStore);
        }

        if($request->hasFile('equip_img')){
            $equipment->equip_img = $fileNameToStore;
        }

        $equipment->save();

        return redirect('/equipment')->with('success', 'Equipment Updated');
    } 
}
