<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment;
use App\TransactionForm;
use App\Cart;
use DB;
use Yajra\Datatables\Datatables;
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
    public $countCurrUnavail;

    public function index(Request $request)
    {
        return Datatables::of(Equipment::query()->where('equip_name', $request->equip_name))
        ->rawColumns(['equip_description'])
        ->make(true);
    }

    public function __construct()
    {
        $this->countEquip = Equipment::all()
                            ->groupBy('equip_name')
                            ->map(function($equipment, $equip_name) {
                                return [
                                    'equip_name' => $equip_name,
                                    'total' => $equipment->count(),
                                    'avail' => $equipment->where('equip_avail', '0')->count(),
                                    'unavail' => $equipment->where('equip_avail', '!=', '0')->count(),
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

    public function show($id){
        if(auth()->user()->access_role != 'ADMIN'){
            $itemName = str_replace('-', ' ', $id);
            $item = Equipment::where('equip_name',$itemName)->first();
            $equipments = Equipment::get();
            
            $lastTransaction = TransactionForm::where('user_id', auth()->user()->user_id)->where('submitted_date', null)->get()->last(); 
            if($lastTransaction != null){
                $countCart = Cart::all()
                                ->where("transaction_id", "$lastTransaction->transaction_id")
                                ->where("deleted_at", null)
                                ->groupBy('equip_name')
                                ->map(function($equipment, $equip_name) {
                                    return [
                                        'equip_name' => $equip_name,
                                        'record' => $equipment->count(),
                                    ];
                                })
                                ->values();
                $totalEquip = Cart::where('transaction_id', $lastTransaction->transaction_id)->get();
            } else {
                $countCart = null;
                $totalEquip = null;
            }

            return view('student.item')->with('lastTransaction',$lastTransaction)
                                     ->with('countCart', $countCart)
                                     ->with('item',$item)
                                     ->with('equipments',$equipments)
                                     ->with('totalEquip',$totalEquip)
                                     ->with('countEquip', $this->countEquip);
        } else {
            $itemName = str_replace('-', ' ', $id);
            $item = Equipment::where('equip_name',$itemName)->first();
            return view('admin.item')->with('item',$item);
                                    
        }
    }

    public function showAllEquipment(){
        if(auth()->user()->access_role != 'ADMIN'){
            if(auth()->user()->penalty>5000){
                return view('student.equipError');
            } else {
                $lastTransaction = TransactionForm::where('user_id', auth()->user()->user_id)->where('submitted_date', null)->get()->last();


                $equipments =  Equipment::orderBy('equip_name', 'asc')
                                        ->paginate(27);

                if($lastTransaction != null){
                    $countCart = Cart::all()
                                    ->where("transaction_id", "$lastTransaction->transaction_id")
                                    ->where("deleted_at", null)
                                    ->groupBy('equip_name')
                                    ->map(function($equipment, $equip_name) {
                                        return [
                                            'equip_name' => $equip_name,
                                            'record' => $equipment->count(),
                                        ];
                                    })
                                    ->values();
                    $totalEquip = Cart::where('transaction_id', $lastTransaction->transaction_id)->get();
                } else {
                    $countCart = null;
                    $totalEquip = null;
                }

                return view('equip.all_equipment')->with('lastTransaction',$lastTransaction)
                                                  ->with('countCart', $countCart)
                                                  ->with('equipments',$equipments)
                                                  ->with('totalEquip',$totalEquip)
                                                  ->with('countEquip', $this->countEquip);
            }
        } else {
            $equipments =  Equipment::orderBy('equip_name', 'asc')->paginate(27); 
            return view('equip.all_equipment')->with('equipments',$equipments)
                                            ->with('countEquip', $this->countEquip);
        }
    }

    public function showCamEquipment(){
        /*$equipment = Equipment::find($id);
        //please change show URL with {id}
        return view('posts.show')->with('equipment', $equipment);*/
        
        if(auth()->user()->access_role != 'ADMIN'){
            if(auth()->user()->penalty>5000){
                return view('student.equipError');
            } else {
                $lastTransaction = TransactionForm::where('user_id', auth()->user()->user_id)->where('submitted_date', null)->get()->last();

                $equipments =  Equipment::where('equip_category', 'CAMACC')
                                        ->orderBy('equip_name', 'asc')
                                        ->paginate(27);

                if($lastTransaction != null){
                    $countCart = Cart::all()
                                    ->where("transaction_id", "$lastTransaction->transaction_id")
                                    ->where("deleted_at", null)
                                    ->groupBy('equip_name')
                                    ->map(function($equipment, $equip_name) {
                                        return [
                                            'equip_name' => $equip_name,
                                            'record' => $equipment->count(),
                                        ];
                                    })
                                    ->values();
                    $totalEquip = Cart::where('transaction_id', $lastTransaction->transaction_id)->get();
                } else {
                    $countCart = null;
                    $totalEquip = null;
                }

                return view('equip.cam_equipment')->with('lastTransaction',$lastTransaction)
                                                 ->with('countCart', $countCart)
                                                 ->with('equipments',$equipments)
                                                 ->with('totalEquip',$totalEquip)
                                                 ->with('countEquip', $this->countEquip);
            }
        } else {
            $equipments =  Equipment::where('equip_category', 'CAMACC')->orderBy('equip_name', 'asc')->paginate(27);
            return view('equip.cam_equipment')->with('equipments',$equipments)
                                        ->with('countEquip', $this->countEquip);
                                    
        }
    } 

    public function showArtEquipment(){
        if(auth()->user()->access_role != 'ADMIN'){
            if(auth()->user()->penalty>5000){
                return view('student.equipError');
            } else {
                $equipments =  Equipment::where('equip_category', 'ART')
                                        ->orderBy('equip_name', 'asc')
                                        ->paginate(27);

                $lastTransaction = TransactionForm::where('user_id', auth()->user()->user_id)->where('submitted_date', null)->get()->last();
                if($lastTransaction != null){
                    $countCart = Cart::all()
                                    ->where("transaction_id", "$lastTransaction->transaction_id")
                                    ->where("deleted_at", null)
                                    ->groupBy('equip_name')
                                    ->map(function($equipment, $equip_name) {
                                        return [
                                            'equip_name' => $equip_name,
                                            'record' => $equipment->count(),
                                        ];
                                    })
                                    ->values();
                    $totalEquip = Cart::where('transaction_id', $lastTransaction->transaction_id)->get();
                } else {
                    $countCart = null;
                    $totalEquip = null;
                }

                return view('equip.art_equipment')->with('equipments',$equipments)
                                                 ->with('lastTransaction',$lastTransaction)
                                                 ->with('countCart', $countCart)
                                                 ->with('totalEquip',$totalEquip)
                                                 ->with('countEquip', $this->countEquip);
            }
        } else {
            $equipments =  Equipment::where('equip_category', 'ART')->orderBy('equip_name', 'asc')->paginate(27); 
            return view('equip.art_equipment')->with('equipments',$equipments)
                                            ->with('countEquip', $this->countEquip);
                                    
        }
    } 

    public function showSportEquipment(){
        if(auth()->user()->access_role != 'ADMIN'){
            if(auth()->user()->penalty>5000){
                return view('student.equipError');
            } else {
                $equipments =  Equipment::where('equip_category', 'SPRT')
                                        ->orderBy('equip_name', 'asc')
                                        ->paginate(27);
                
                $lastTransaction = TransactionForm::where('user_id', auth()->user()->user_id)->where('submitted_date', null)->get()->last();
                if($lastTransaction != null){
                    $countCart = Cart::all()
                                    ->where("transaction_id", "$lastTransaction->transaction_id")
                                    ->where("deleted_at", null)
                                    ->groupBy('equip_name')
                                    ->map(function($equipment, $equip_name) {
                                        return [
                                            'equip_name' => $equip_name,
                                            'record' => $equipment->count(),
                                        ];
                                    })
                                    ->values();
                    $totalEquip = Cart::where('transaction_id', $lastTransaction->transaction_id)->get();
                } else {
                    $countCart = null;
                    $totalEquip = null;
                }

                return view('equip.sport_equipment')->with('equipments',$equipments)
                                                    ->with('lastTransaction',$lastTransaction)
                                                    ->with('countCart', $countCart)
                                                    ->with('totalEquip',$totalEquip)
                                                    ->with('countEquip', $this->countEquip); 
            }
        } else {
            $equipments =  Equipment::where('equip_category', 'SPRT')->orderBy('equip_name', 'asc')->paginate(27); 
            return view('equip.sport_equipment')->with('equipments',$equipments)
                                            ->with('countTotalAvail', $this->countTotalAvail)
                                            ->with('countEquip', $this->countEquip);
                                    
        }
    } 

    public function showMiscEquipment(){
        if(auth()->user()->access_role != 'ADMIN'){
            if(auth()->user()->penalty>5000){
                return view('student.equipError');
            } else {
                $equipments =  Equipment::where('equip_category', 'MISC')
                                        ->orderBy('equip_name', 'asc')
                                        ->paginate(27);

                $lastTransaction = TransactionForm::where('user_id', auth()->user()->user_id)->where('submitted_date', null)->get()->last();
                if($lastTransaction != null){
                    $countCart = Cart::all()
                                    ->where("transaction_id", "$lastTransaction->transaction_id")
                                    ->where("deleted_at", null)
                                    ->groupBy('equip_name')
                                    ->map(function($equipment, $equip_name) {
                                        return [
                                            'equip_name' => $equip_name,
                                            'record' => $equipment->count(),
                                        ];
                                    })
                                    ->values();
                    $totalEquip = Cart::where('transaction_id', $lastTransaction->transaction_id)->get();
                } else {
                    $countCart = null;
                    $totalEquip = null;
                }

                return view('equip.misc_equipment')->with('equipments',$equipments)
                                                   ->with('lastTransaction',$lastTransaction)
                                                   ->with('countCart', $countCart)
                                                   ->with('totalEquip',$totalEquip)
                                                   ->with('countEquip', $this->countEquip);
            }
        } else {
            $equipments =  Equipment::where('equip_category', 'MISC')->orderBy('equip_name', 'asc')->paginate(27); 
            return view('equip.misc_equipment')->with('equipments',$equipments)
                                            ->with('countEquip', $this->countEquip);
                                    
        }
    } 

    public function showLapEquipment(){
        if(auth()->user()->access_role != 'ADMIN'){
            if(auth()->user()->penalty>5000){
                return view('student.equipError');
            } else {
                $equipments =  Equipment::where('equip_category', 'LPTP')
                                        ->orderBy('equip_name', 'asc')
                                        ->paginate(27);

                $lastTransaction = TransactionForm::where('user_id', auth()->user()->user_id)->where('submitted_date', null)->get()->last(); 
                if($lastTransaction != null){
                    $countCart = Cart::all()
                                    ->where("transaction_id", "$lastTransaction->transaction_id")
                                    ->where("deleted_at", null)
                                    ->groupBy('equip_name')
                                    ->map(function($equipment, $equip_name) {
                                        return [
                                            'equip_name' => $equip_name,
                                            'record' => $equipment->count(),
                                        ];
                                    })
                                    ->values();
                    $totalEquip = Cart::where('transaction_id', $lastTransaction->transaction_id)->get();
                } else {
                    $countCart = null;
                    $totalEquip = null;
                }
        
                return view('equip.laptop_equipment')->with('equipments',$equipments)
                                                    ->with('lastTransaction',$lastTransaction)
                                                    ->with('totalEquip',$totalEquip)
                                                    ->with('countCart', $countCart)
                                                    ->with('countEquip', $this->countEquip);
            }
        } else {
            $equipments =  Equipment::where('equip_category', 'LPTP')->orderBy('equip_name', 'asc')->paginate(27); 
            return view('equip.laptop_equipment')->with('equipments',$equipments)
                                            ->with('countEquip', $this->countEquip);
                                    
        }
    }
    
    public function showGameEquipment(){
        if(auth()->user()->access_role != 'ADMIN'){
            if(auth()->user()->penalty>5000){
                return view('student.equipError');
            } else {
                $equipments =  Equipment::where('equip_category', 'GMNG')
                                        ->orderBy('equip_name', 'asc')
                                        ->paginate(27);
                
                $lastTransaction = TransactionForm::where('user_id', auth()->user()->user_id)->where('submitted_date', null)->get()->last();  
                if($lastTransaction != null){
                    $countCart = Cart::all()
                                    ->where("transaction_id", "$lastTransaction->transaction_id")
                                    ->where("deleted_at", null)
                                    ->groupBy('equip_name')
                                    ->map(function($equipment, $equip_name) {
                                        return [
                                            'equip_name' => $equip_name,
                                            'record' => $equipment->count(),
                                        ];
                                    })
                                    ->values();
                    $totalEquip = Cart::where('transaction_id', $lastTransaction->transaction_id)->get();
                } else {
                    $countCart = null;
                    $totalEquip = null;
                }
                                        
        
                return view('equip.gaming_equipment')->with('equipments',$equipments)
                                        ->with('lastTransaction',$lastTransaction)
                                        ->with('countCart', $countCart)
                                        ->with('totalEquip',$totalEquip)
                                        ->with('countEquip', $this->countEquip);
            }
        } else {
            $equipments =  Equipment::where('equip_category', 'GMNG')->orderBy('equip_name', 'asc')->paginate(27); 
            return view('equip.gaming_equipment')->with('equipments',$equipments)
                                            ->with('countEquip', $this->countEquip);
                                    
        }
    }
    
    public function faqs(){
            $lastTransaction = TransactionForm::where('user_id', auth()->user()->user_id)->where('submitted_date', null)->get()->last(); 
            if($lastTransaction != null){
                $countCart = Cart::all()
                                ->where("transaction_id", "$lastTransaction->transaction_id")
                                ->where("deleted_at", null)
                                ->groupBy('equip_name')
                                ->map(function($equipment, $equip_name) {
                                    return [
                                        'equip_name' => $equip_name,
                                        'record' => $equipment->count(),
                                    ];
                                })
                                ->values();
                $totalEquip = Cart::where('transaction_id', $lastTransaction->transaction_id)->get();
            } else {
                $countCart = null;
                $totalEquip = null;
            }

            $equipments = Equipment::all();
    
            return view('student.faq')->with('lastTransaction',$lastTransaction)
                                      ->with('countCart', $countCart)
                                      ->with('equipments', $equipments)
                                      ->with('totalEquip',$totalEquip)
                                      ->with('countEquip', $this->countEquip);
    }

    public function searchEquipment(Request $request){
        $search = Input::get('search');
        $possibleEquips = Equipment::where('equip_name', 'like', '%' . $search . '%')
                                    ->orWhere('equipID', 'like', '%' . $search . '%')
                                    ->paginate(27);
                                    
        $equipments = Equipment::all();
        if(auth()->user()->access_role != 'ADMIN'){
            $totalEquip = Equipment::all();

            $lastTransaction = TransactionForm::where('user_id', auth()->user()->user_id)->where('submitted_date', null)->get()->last();
            if($lastTransaction != null){
                $countCart = Cart::all()
                                ->where("transaction_id", "$lastTransaction->transaction_id")
                                ->where("deleted_at", null)
                                ->groupBy('equip_name')
                                ->map(function($equipment, $equip_name) {
                                    return [
                                        'equip_name' => $equip_name,
                                        'record' => $equipment->count(),
                                    ];
                                })
                                ->values();
                $totalEquip = Cart::where('transaction_id', $lastTransaction->transaction_id)->get();
            } else {
                $countCart = null;
                $totalEquip = null;
            }
                                    

            return view('pages.search')->with('lastTransaction',$lastTransaction)
                                        ->with('possibleEquips', $possibleEquips)
                                        ->with('search', $search)
                                        ->with('countCart', $countCart)
                                        ->with('equipments', $equipments)
                                        ->with('totalEquip',$totalEquip)
                                        ->with('countEquip', $this->countEquip);
        } else {
            return view('pages.search')->with('equipments',$equipments)
                                                ->with('possibleEquips', $possibleEquips)
                                                ->with('search', $search)
                                                ->with('countEquip', $this->countEquip);
        } 
                            
    }

    //SHOW EQUIPMENT END

    //EQUIPMENT FUNCTIONS START
    public function add(){
        return view('equip.addEquip');
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
            'returned' => true,
          ]);

          $equipment->save();

          $equipment->equipID = "$equipment->equip_category"."$equipment->id";
          //dd($equipment->category);

          $equipment->save();
          //return redirect(URL::current());

          return redirect()->back()->with('success', 'Equipment Added!');
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
        $request->validate([
            'equipName' => 'required',
            'category' => 'required',
            'description' => 'nullable',
            'penalty' => 'nullable',
            'price' => 'nullable',
          ]);
        
          $currentEquipName = $request->get('currentEquipName');
          $equipments = Equipment::get();

          foreach($equipments as $equipment){
              if($equipment->equip_name == $currentEquipName){
                if($request->get('equipName') == null){
                    $request->merge(['equipName' => $equipment->equip_name] );
                } 
                
                if($request->get('category') == null){
                    $request->merge(['category' => $equipment->equip_category] );
                }
                
                if($request->get('description') == null){
                    $request->merge(['description' => $equipment->equip_description] );
                }
                
                if($request->get('penalty') == null){
                    $request->merge(['penalty' => $equipment->equip_penalty] );
                }
                
                if($request->get('price') == null){
                    $request->merge(['price' => $equipment->equip_baseprice] );
                }

                $equipment->update([
                        'equip_name' => $request->get('equipName'),
                        'equip_description' => $request->get('description'),
                        'equip_category' => $request->get('category'),
                        'equip_penalty' => $request->get('penalty'),
                        'equip_baseprice' => $request->get('basePrice')
                    ]); 
                $equipment->save();
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
        $lastTransaction = TransactionForm::where('user_id', auth()->user()->user_id)->where('submitted_date', null)->get()->last();  

        foreach($equipments as $equipment){
            if(Input::get('selectReserve') == null){
                if($equipment->equipID == $request->get('currentEquipID')){
                    if($lastTransaction == null){
                        $transaction_form = new TransactionForm([
                            'transaction_id' => 'tc',
                            'user_id' => Input::get('userID'),
                          ]);
        
                        $transaction_form->save();
        
                        $transaction_form->transaction_id = "TC"."$transaction_form->id";
        
                        $transaction_form->save();
    
                        $equipment->update([
                            'equip_avail' => '2', //currently in cart
                        ]); 

                        $cart = new Cart([
                            'transaction_id' => $transaction_form->transaction_id,
                            'equipID' => $equipment->equipID,
                            'user_id' => Input::get('userID'),
                            'equip_name' => $equipment->equip_name,
                        ]);

                        $cart->save();
                    } else {
                        $equipment->update([
                            'equip_avail' => '2', //currently in cart
                        ]);
                        
                        $cart = new Cart([
                            'transaction_id' => $lastTransaction->transaction_id,
                            'equipID' => $equipment->equipID,
                            'user_id' => Input::get('userID'),
                            'equip_name' => $equipment->equip_name,
                        ]);

                        $cart->save();
                    }
                }
            } else {
                foreach (Input::get('selectReserve') as $select) {
                    if($equipment->equipID == $select){
                        if($lastTransaction == null){
                            $transaction_form = new TransactionForm([
                                'transaction_id' => 'tc',
                                'user_id' => Input::get('userID'),
                              ]);
            
                            $transaction_form->save();
            
                            $transaction_form->transaction_id = "TC"."$transaction_form->id";
            
                            $transaction_form->save();
        
                            $equipment->update([
                                'equip_avail' => '2', //currently in cart
                            ]); 

                            $cart = new Cart([
                                'transaction_id' => $transaction_form->transaction_id,
                                'equipID' => $equipment->equipID,
                                'user_id' => Input::get('userID'),
                                'equip_name' => $equipment->equip_name,
                            ]);
    
                            $cart->save();

                        } else {
                            $equipment->update([
                                'equip_avail' => '2', //currently in cart
                            ]); 

                            $cart = new Cart([
                                'transaction_id' => $lastTransaction->transaction_id,
                                'equipID' => $equipment->equipID,
                                'user_id' => Input::get('userID'),
                                'equip_name' => $equipment->equip_name,
                            ]);
    
                            $cart->save();
                        }
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Equipment Reserved!');
    }

    public function deleteReservation(Request $request){
        if(auth()->user()->access_role != 'ADMIN'){
            return abort(403, 'Unauthorized action.');
        }

        $lastTransaction = TransactionForm::where('user_id', auth()->user()->user_id)->where('submitted_date', null)->get()->last();
        $totalEquip = Equipment::where('transaction_id', $lastTransaction->transaction_id)->get();

        foreach ($totalEquip as $tEquip) {
            if($tEquip->equip_name == $request->get('equip_name')){
                $tEquip->transaction_id = null;
                $tEquip->equip_avail = null;
            }
        }
    }

    //RESRVATION FUNCTIONS END
}
