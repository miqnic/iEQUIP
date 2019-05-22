<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment;
use App\TransactionForm;
use DB;
use Session;
use URL;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;

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
   
    //SHOW EQUIPMENT START

    public function showCamEquipment(){
        /*$equipment = Equipment::find($id);
        //please change show URL with {id}
        return view('posts.show')->with('equipment', $equipment);*/
        
        if(auth()->user()->access_role != 'ADMIN'){
            $lastTransaction = TransactionForm::where('user_id', auth()->user()->user_id)->get()->last();

            $equipments =  Equipment::where('equip_category', 'CAMACC')
                                    ->where('equip_avail', '0')
                                    ->orderBy('equip_name', 'desc')
                                    ->get();

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

            return view('equip.cam_equipment')->with('lastTransaction',$lastTransaction)
                                        ->with('countCart', $countCart)
                                        ->with('equipments',$equipments)
                                        ->with('totalEquip',$totalEquip)
                                        ->with('countTotalAvail', $this->countTotalAvail)
                                        ->with('countCurrAvail', $this->countCurrAvail);
        } else {
            $equipments =  Equipment::where('equip_category', 'CAMACC')->orderBy('equip_name', 'desc')->get(); 
            return view('equip.cam_equipment')->with('equipments',$equipments)
                                            ->with('countTotalAvail', $this->countTotalAvail)
                                            ->with('countCurrAvail', $this->countCurrAvail);
                                    
        }
    } 

    public function showArtEquipment(){
        if(auth()->user()->access_role != 'ADMIN'){
            $equipments =  Equipment::where('equip_category', 'ART')
                                    ->where('equip_avail', '0')
                                    ->orderBy('equip_name', 'desc')
                                    ->get();

            $totalEquip = Equipment::all();
                        
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

            return view('equip.art_equipment')->with('equipments',$equipments)
                                ->with('lastTransaction',$lastTransaction)
                                ->with('countCart', $countCart)
                                ->with('totalEquip', $totalEquip)
                                ->with('countTotalAvail', $this->countTotalAvail)
                                ->with('countCurrAvail', $this->countCurrAvail);  
        } else {
            $equipments =  Equipment::where('equip_category', 'ART')->orderBy('equip_name', 'desc')->get(); 
            return view('equip.art_equipment')->with('equipments',$equipments)
                                            ->with('countTotalAvail', $this->countTotalAvail)
                                            ->with('countCurrAvail', $this->countCurrAvail);
                                    
        }
    } 

    public function showSportEquipment(){
        if(auth()->user()->access_role != 'ADMIN'){
            $equipments =  Equipment::where('equip_category', 'SPRT')
                                    ->where('equip_avail', '0')
                                    ->orderBy('equip_name', 'desc')
                                    ->get();
            
            $totalEquip = Equipment::all();

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

            return view('equip.sport_equipment')->with('equipments',$equipments)
                                ->with('lastTransaction',$lastTransaction)
                                ->with('countCart', $countCart)
                                ->with('totalEquip', $totalEquip)
                                ->with('countTotalAvail', $this->countTotalAvail)
                                ->with('countCurrAvail', $this->countCurrAvail);    
        } else {
            $equipments =  Equipment::where('equip_category', 'SPRT')->orderBy('equip_name', 'desc')->get(); 
            return view('equip.sport_equipment')->with('equipments',$equipments)
                                            ->with('countTotalAvail', $this->countTotalAvail)
                                            ->with('countCurrAvail', $this->countCurrAvail);
                                    
        }
    } 

    public function showMiscEquipment(){
        if(auth()->user()->access_role != 'ADMIN'){
            $equipments =  Equipment::where('equip_category', 'MISC')
                                    ->where('equip_avail', '0')
                                    ->orderBy('equip_name', 'desc')
                                    ->get();

            $totalEquip = Equipment::all();

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

            return view('equip.misc_equipment')->with('equipments',$equipments)
                                    ->with('lastTransaction',$lastTransaction)
                                    ->with('countCart', $countCart)
                                    ->with('totalEquip', $totalEquip)
                                    ->with('countTotalAvail', $this->countTotalAvail)
                                    ->with('countCurrAvail', $this->countCurrAvail);   
            } else {
                $equipments =  Equipment::where('equip_category', 'MISC')->orderBy('equip_name', 'desc')->get(); 
                return view('equip.misc_equipment')->with('equipments',$equipments)
                                                ->with('countTotalAvail', $this->countTotalAvail)
                                                ->with('countCurrAvail', $this->countCurrAvail);
                                        
            }
    } 

    public function showLapEquipment(){
        if(auth()->user()->access_role != 'ADMIN'){
            $equipments =  Equipment::where('equip_category', 'LPTP')
                                    ->where('equip_avail', '0')
                                    ->orderBy('equip_name', 'desc')
                                    ->get();
            $totalEquip = Equipment::all();
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
    
            return view('equip.laptop_equipment')->with('equipments',$equipments)
                                    ->with('lastTransaction',$lastTransaction)
                                    ->with('countCart', $countCart)
                                    ->with('totalEquip', $totalEquip)
                                    ->with('countTotalAvail', $this->countTotalAvail)
                                    ->with('countCurrAvail', $this->countCurrAvail);
            } else {
                $equipments =  Equipment::where('equip_category', 'LPTP')->orderBy('equip_name', 'desc')->get(); 
                return view('equip.laptop_equipment')->with('equipments',$equipments)
                                                ->with('countTotalAvail', $this->countTotalAvail)
                                                ->with('countCurrAvail', $this->countCurrAvail);
                                        
            }
    }
    
    public function showGameEquipment(){
        if(auth()->user()->access_role != 'ADMIN'){
            $equipments =  Equipment::where('equip_category', 'GMNG')
                                    ->where('equip_avail', '0')
                                    ->orderBy('equip_name', 'desc')
                                    ->get();
            
            $totalEquip = Equipment::all();
            
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
                                    
    
            return view('equip.gaming_equipment')->with('equipments',$equipments)
                                    ->with('lastTransaction',$lastTransaction)
                                    ->with('countCart', $countCart)
                                    ->with('totalEquip', $totalEquip)
                                    ->with('countTotalAvail', $this->countTotalAvail)
                                    ->with('countCurrAvail', $this->countCurrAvail);
            } else {
                $equipments =  Equipment::where('equip_category', 'GMNG')->orderBy('equip_name', 'desc')->get(); 
                return view('equip.gaming_equipment')->with('equipments',$equipments)
                                                ->with('countTotalAvail', $this->countTotalAvail)
                                                ->with('countCurrAvail', $this->countCurrAvail);
                                        
            }
    }
    
    public function faqs(){
            $totalEquip = Equipment::all();
            
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
                                    
    
            return view('student.faq')->with('lastTransaction',$lastTransaction)
                                    ->with('countCart', $countCart)
                                    ->with('totalEquip', $totalEquip)
                                    ->with('countTotalAvail', $this->countTotalAvail)
                                    ->with('countCurrAvail', $this->countCurrAvail);
    }

    public function searchEquipment(Request $request){
        $search = Input::get('search');
        $possibleEquips = Equipment::where('equip_name', 'like', '%' . $search . '%')
                                    ->orWhere('equipID', 'like', '%' . $search . '%')
                                    ->get();

        $totalEquip = Equipment::all();
        $equipments = Equipment::all();

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
                                

        return view('pages.search')->with('lastTransaction',$lastTransaction)
                                    ->with('possibleEquips', $possibleEquips)
                                    ->with('search', $search)
                                    ->with('countCart', $countCart)
                                    ->with('equipments', $equipments)
                                    ->with('totalEquip', $totalEquip)
                                    ->with('countTotalAvail', $this->countTotalAvail)
                                    ->with('countCurrAvail', $this->countCurrAvail);
                            
    }

    //SHOW EQUIPMENT END

    //EQUIPMENT FUNCTIONS START
    public function add(){
        return view('inc.addEquipModal');
    }

    public function addEquipment(Request $request){
        if(auth()->user()->access_role != 'ADMIN'){
            return abort(403, 'Unauthorized action.');
        }

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
            'itemName' => 'required',
            'category' => 'required',
            'description' => 'nullable',
            'penalty' => 'required',
            'basePrice' => 'required',
            'equipIMG' => 'image|nullable|max:1999'
          ]);
          $equipment = new Equipment([
            'equip_name' => $request->get('itemName'),
            'equip_description' => $request->get('description'),
            'equip_penalty' => $request->get('penalty'),
            'equip_baseprice' => $request->get('basePrice'),
            'equip_category' => $request->get('category'),
            'equip_img' => $fileNameToStore,
            'equip_avail' => '0',
            'returned' => false,
          ]);

          $equipment->save();

          $equipment->equipID = "$equipment->equip_category"."$equipment->id";
          //dd($equipment->category);

          $equipment->save();
          //return redirect(URL::current());

          return redirect()->back()->with('success', 'Equipment Added!');
    }

    public function addStock(Request $request){
        $equipments = Equipment::get();
        $currentEquipName = $request->get('itemName');
        $quantity = $request->get('quantity');

        //dd($currentEquipName);

        foreach ($equipments as $equip) {
            if ($equip->equip_name == $currentEquipName) {
                $currentEquip = $equip;
                break;
            }
        }

        for ($i=0; $i < $quantity; $i++) { 
            $request->validate([
                'quantity' => 'required',
                'description' => 'required'
            ]);

            $equipment = new Equipment([
                'equip_name' => $currentEquip->equip_name,
                'equip_description' => $currentEquip->equip_description,
                'equip_penalty' => $currentEquip->equip_penalty,
                'equip_baseprice' => $currentEquip->equip_baseprice,
                'equip_category' => $currentEquip->equip_category,
                'equip_img' => $currentEquip->equip_img,
                'equip_avail' => '0',
                'returned' => false,
            ]);

            $equipment->save();

            $equipment->equipID = "$equipment->equip_category"."$equipment->id";
            //dd($equipment->category);

            $equipment->save();
            //return redirect(URL::current());
        }

          return redirect()->back()->with('success', $equipment->equip_name.'is Added!');

    }

    public function del(){
        return view('inc.deleteEquipModal');
    }
    
    public function delEquipment(Request $request){
        $equipments = Equipment::get()->unique('equip_name');
        $inputs = $request->input('checkbox');
        
        //Check if admin
        if(auth()->user()->access_role != 'ADMIN'){
            return abort(403, 'Unauthorized action.');
        }

        //dd($inputs);

        foreach($inputs as $input){
            foreach($equipments as $equipment){
                if($input == $equipment->equip_name){
                    //dd($equipment);
                    $equipment->delete();
                }
            }
        }
        
        
        return redirect()->back()->with('warning', 'Equipment Deleted!');
    }

    public function delSingleEquipment(Request $request){
        if(auth()->user()->access_role != 'ADMIN'){
            return abort(403, 'Unauthorized action.');
        }

        $equipments = Equipment::get();
        //dd(Input::get("currentEquip"));
        
        foreach($equipments as $equipment){
            if(Input::get("currentEquip") == "$equipment->equipID"){
                //dd(Input::get("currentEquip"));
                $equipment->delete();
            }
        }
        
        return redirect()->back()->with('warning', 'Equipment Deleted!');
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
                $equipment->update([
                        'equip_name' => $request->get('itemName'),
                        'equip_description' => $request->get('description'),
                        'equip_penalty' => $request->get('penalty'),
                        'equip_baseprice' => $request->get('basePrice'),
                        'equip_category' => $request->get('category'),
                        'equip_img' => $fileNameToStore,
                    ]); 
              }
            
          }
          
          //return redirect(URL::current());
          return redirect()->back()->with('success', 'Equipment Details Updated!');
    } 

    public function editSingleEquipment(Request $request){
        $equipments = Equipment::get();

        foreach($equipments as $equipment){
            if(Input::get('currentEquip') == $equipment->equipID){
                $equipment->update([
                    'equip_avail' => Input::get('availability'),
                    'equip_description' => Input::get('description')
                ]);

                $equipment->save();
            }
        }

        return redirect()->back()->with('success', 'Equipment Details Updated!');
    }

    //EQUIPMENT FUNCTIONS END

    //RESERVATION FUNCTIONS START

    public function returnEquipment(Request $request){
        $equipments = Equipment::where('transaction_id', $request->get('currentForm'))
                                ->get();

        $form = TransactionForm::where('transaction_id', $request->get('currentForm'));
        
        //Check if admin
        if(auth()->user()->access_role != 'ADMIN'){
            return abort(403, 'Unauthorized action.');
        }

        foreach($equipments as $equipment){
            if(Input::get("checkbox-$equipment->equipID") === "$equipment->equipID"){
                $equipment->update(array('transaction_id' => null));
            }
        }

        if($equipments->isEmpty() == 0){
            $form->update([
                'returned'=>'1', 
                'returned_date' => Carbon::now()
            ]);
        }
        
        return redirect()->back()->with('warning', 'Equipments of Transaction# '.$request->get('currentForm').' have been returned!');
    }

    public function reserveEquipment(Request $request){
        $equipments = Equipment::get();
        $lastTransaction = TransactionForm::where('user_id', auth()->user()->user_id)->get()->last();

        foreach($equipments as $equipment){
            if($equipment->equipID == Input::get('currentEquipID')){
                if($lastTransaction->submitted_date != null){
                    $transaction_form = new TransactionForm([
                        'transaction_id' => 'tc',
                        'user_id' => Input::get('userID'),
                      ]);
    
                    $transaction_form->save();
    
                    $transaction_form->transaction_id = "TC"."$transaction_form->id";
    
                    $transaction_form->save();

                    $equipment->update([
                        'transaction_id' => $transaction_form->transaction_id,
                        'equip_avail' => '1',
                    ]); 
                } else {
                    $equipment->update([
                        'transaction_id' => $lastTransaction->transaction_id,
                        'equip_avail' => '1',
                    ]); 
                }
            }
        }

        return redirect()->back()->with('success', 'Equipment Reserved!');
    }

    //RESRVATION FUNCTIONS END
}
