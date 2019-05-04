<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment;
use App\TransactionForm;
use DB;
use Session;
use URL;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(){
        return view('inc.addEquipModal');
    }
    public function addEquipment(Request $request){
        if(auth()->user()->access_role != 'ADMIN'){
            return abort(403, 'Unauthorized action.');
        }

        /*$this->validate($request, [
            'itemID' => 'required',
            'itemName' => 'required',
            'category' => 'required',
            'description' => 'nullable',
            'penalty' => 'required',
            'basePrice' => 'required',
            'equipIMG' => 'image|nullable|max:1999'
        ]);

        //Create Equipment
        $equipment = Equipment::create([
            'equipID' =>  $request->itemID,
            'equip_name' => $request->itemName,
            'equip_description' => $request->description,
            'equip_penalty' => $request->penalty,
            'equip_baseprice' => $request->basePrice,
            'equip_img' => $fileNameToStore,
            'equip_avail' => '0',
            'returned' => true,
            'transaction_id' => '',
        ]);*/

        //Handle File Upload
        if($request->hasFile('equipIMG')){
            //Get a filename with the extension
            $fileNameWithExt = $request->file('equipIMG')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('equipIMG')->getClientOriginalExtension();
            //Filename to store (has to be unique)
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('equipIMG')->storeAs('public/equipIMG', $fileNameToStore);
        } else {
            $fileNameToStore = 'noImage.jpg';
        }

        $request->validate([
            'itemID' => 'required',
            'itemName' => 'required',
            'category' => 'required',
            'description' => 'nullable',
            'penalty' => 'required',
            'basePrice' => 'required',
            'equipIMG' => 'image|nullable|max:1999'
          ]);
          $equipment = new Equipment([
            'equipID' =>  $request->get('itemID'),
            'equip_name' => $request->get('itemName'),
            'equip_description' => $request->get('description'),
            'equip_penalty' => $request->get('penalty'),
            'equip_baseprice' => $request->get('basePrice'),
            'equip_category' => $request->get('category'),
            'equip_img' => $fileNameToStore,
            'equip_avail' => '0',
            'returned' => true,
          ]);
          $equipment->save();
          //return redirect(URL::current());

        return redirect(URL::current())->with('success', 'Equipment Created');
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
    public function del(){
        return view('inc.deleteEquipModal');
    }
    
    public function delEquipment(Request $request){
        $equipment = Equipment::get()->unique('equip_name');
        
        //Check if admin
        if(auth()->user()->access_role != 'ADMIN'){
            return abort(403, 'Unauthorized action.');
        }

        if(Input::get('checkbox-', false))

        $equipment->delete();
        return redirect(URL::current())->with('success', 'Equipment Deleted');
    }
    
    public function edit(){
        return view('inc.editItemModal');
    }
    public function editEquipment(Request $request){
        //Check if admin
        if(auth()->user()->access_role != 'ADMIN'){
            return abort(403, 'Unauthorized action.');
        }

        if($request->hasFile('equipIMG')){
            //Get a filename with the extension
            $fileNameWithExt = $request->file('equipIMG')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('equipIMG')->getClientOriginalExtension();
            //Filename to store (has to be unique)
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('equipIMG')->storeAs('public/equipIMG', $fileNameToStore);
        } else {
            $fileNameToStore = 'noImage.jpg';
        }

        $request->validate([
            'currentEquipName' => 'required',
            'itemName' => 'required',
            'category' => 'required',
            'penalty' => 'required',
            'basePrice' => 'required',
            'description' => 'required',
            'equipIMG' => 'image|nullable|max:1999'
          ]);
        
          $currentEquipName = $request->get('currentEquipName');
          $equipments = Equipment::get();

          foreach($equipments as $equipment){
              if($equipment->equip_name == $currentEquipName){
                $equipment = [
                    'equip_name' => $request->get('itemName'),
                    'equip_description' => $request->get('description'),
                    'equip_penalty' => $request->get('penalty'),
                    'equip_baseprice' => $request->get('basePrice'),
                    'equip_category' => $request->get('category'),
                    'equip_img' => $fileNameToStore,
                  ];
              }
            
          }
          
          //return redirect(URL::current());
          return redirect(URL::current())->with('success', 'Equipment Edited');
    } 
}
