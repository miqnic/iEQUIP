<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment;
use DB;
use Illuminate\Support\Facades\Storage;

class EquipmentsController extends Controller
{
    public function transaction_forms()
    {
        return $this->belongsTo('App\Transaction','foreign_key');
    }

    public function addEquipment(){
        if(auth()->user()->access_role != 'ADMIN'){
            return abort(403, 'Unauthorized action.');
        }

        $this->validate($request, [
            'equip_id' => 'required',
            'equip_name' => 'required',
            'equip_category' => 'required',
            'equip_description' => 'required',
            'equip_penalty' => 'required',
            'equip_img' => 'image|nullable|max:1999'
        ]);

        //Create Equipment
        $equipment = new Equipment;
        $equipment->equip_id = $request->input('equip_id');
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
    
    public function showEquipment(){
        /*$equipment = Equipment::find($id);
        //please change show URL with {id}
        return view('posts.show')->with('equipment', $equipment);*/

        $equipments =  Equipment::orderBy('equip_name', 'desc')->get();
        return view('equip.cam_equipment')->with('equipments',$equipments);
    } 

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
        $equipment->equip_id = $request->input('equip_id');
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
