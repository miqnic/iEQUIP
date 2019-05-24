@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | {{$item->equip_name}}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/equiplist.css') }}">

     <style>
        .popover {
            max-width: 200px;
        }
    </style>
    <script>
        $(document).ready(function () { 
            $('#itemStockEdit').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{!! route('equip.index', ['equip_name' => $item->equip_name]) !!}",
                "columns":[
                    { "data": "equipID" },
                    { data: null, render: function ( data, type, row ) {
                        if (row.equip_avail == 0) {
                            return 'AVAILABLE';
                        }
                        else if (row.equip_avail == -1){
                            return 'NOT AVAILABLE';
                        }
                        else{
                            return 'BORROWED';
                        }
                        }
                    },  
                    { data: null, render: function ( data, type, row) {
                        return '<span>'+data.equip_description+'</span>';
                    }
                    }, 
                ]
            });
            $('#saveEditEquip').hide();
            $('#editEquip').click(function () {  
                $('.displayCategory').hide();
                $('.displayEquipName').hide();
                $('.displayDesc').hide();
                $('#editEquip').hide();
                $('#editEquipDetails').toggle();
                $('#faqtitle1').text('');
                $('#equipCategory').val('{{$item->equip_category}}');
                $('#equipName').val($('.displayEquipName').text());
                $('#equipDesc').val($('.displayDesc').text());
                $('#saveEditEquip').show();
            });  
            $('#saveEditEquip').click(function () { 
                $('#editEquipDetails').submit();
            });
        });  
    </script>
@endsection

@section('navi')
  @include('inc.naviAdmin')
@endsection

@section('content')
  <div class="row pb-3">
    <div class="col-md-3 pt-2 padding-right-0">
      <div class="list-group" id="list-tab" role="tablist">
        <a class="list-group-item text-uppercase font-weight-bold">Browse Categories</a>
        <a class="list-group-item list-group-item-action" href="equipmentlist" role="tab">All</a>
        <a class="list-group-item list-group-item-action" href="art-tools" role="tab">Art Tools</a>
        <a class="list-group-item list-group-item-action" href="camera-equipment" role="tab">Cameras and Accessories</a>
        <a class="list-group-item list-group-item-action" href="gaming-equipment" role="tab">Gaming Devices</a>
        <a class="list-group-item list-group-item-action" href="laptops-accessories" role="tab">Laptops and Accessories</a>            
        <a class="list-group-item list-group-item-action" href="sports-equipment" role="tab">Sports Equipment</a>            
        <a class="list-group-item list-group-item-action" href="misc-equipment" role="tab">Miscellaneous</a>
      </div>
    </div>
    
    <div class="col-md-9">
        <div class="media">
            <img class="itemPhoto align-self-center border mr-3 mt-2 py-3 px-4" src="{{ asset('img/'.$item->equip_img) }}" style="width: 230px;" alt="Sample photo">
            <div class="media-body mt-4">
                    
                    <button type="button" class="btn btn-sm btn-primary mt-2 float-right" id="editEquip">Edit</button>
                <span class="text-muted displayCategory">
                    @if($item->equip_category=='ART')
                        Art Tools
                    @elseif($item->equip_category=='CAMACC')
                        Cameras and Accessories
                    @elseif($item->equip_category=='GMNG')
                        Gaming Devices
                    @elseif($item->equip_category=='LPTP')
                        Laptops and Accessories
                    @elseif($item->equip_category=='SPRT')
                        Sports Equipment
                    @else 
                        Miscellaneous
                    @endif
                </span>
<<<<<<< HEAD
                <h4 class="displayEquipName">{{$item->equip_name}}</h4>

                <p class="displayDesc text-muted pt-2 description text-justify">{{$item->equip_description}}</p>
                    <!--<button type="button" class="btn btn-sm btn-success float-right mb-3" id="saveEditEquip">Save</button>
                    <form id="editEquipDetails" style="display:none; margin-top: 20px;">
                        <div class="form-group">
                        <label for="equipCategory">Category</label>
                        <select class="custom-select custom-select-md" name="category" id="equipCategory">
                            <option value="ART">Art Tools</option>
                            <option value="CAMACC">Cameras and Accessories</option>
                            <option value="GMNG">Gaming Devices</option>
                            <option value="LPTP">Laptops and Accessories</option>
                            <option value="SPRT">Sports Equipment</option>
                            <option value="MISC">Miscellaneous</option>
                        </select>
                        </div>
=======
                <h4 class="displayEquipName text-primary">{{$item->equip_name}}</h4>
                <h6 class="displayEquipFee">Base Price: P<span class="displayBasePrice">{{$item->equip_baseprice}}</span> | Penalty: P<span class="displayPenalty">{{$item->equip_penalty}}</span>.00</h6>
                <p class="displayDesc text-muted pt-2 description text-justify">{{$item->equip_description}}</p>
                <button type="button" class="btn btn-sm btn-success float-right mb-3" id="saveEditEquip">Save</button>
                <form id="editEquipDetails" style="display:none; margin-top: 20px;">
                    <div class="form-group">
                    <label for="equipCategory">Category</label>
                    <select class="custom-select custom-select-md" name="category" id="equipCategory">
                        <option value="ART">Art Tools</option>
                        <option value="CAMACC">Cameras and Accessories</option>
                        <option value="GMNG">Gaming Devices</option>
                        <option value="LPTP">Laptops and Accessories</option>
                        <option value="SPRT">Sports Equipment</option>
                        <option value="MISC">Miscellaneous</option>
                    </select>
                    </div>
>>>>>>> b0cd0a861335555bad78167267a9181b6433a3e9

                    <div class="form-group">
                        <label for="equipName">Name</label>
                        <input type="text" class="form-control form-control-sm" name="itemName" id="equipName">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="remarks">Base Price (PHP)</label>
                                <input type="text" name="basePrice" class="form-control" id="basePrice" placeholder="Enter amount">
                            </div>
                            <div class="col-md-6">
                                <label for="remarks">Penalty Fee (PHP)</label>
                                <input type="text" name="penalty" class="form-control" id="penalty" placeholder="Enter amount">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="equipDesc">Description</label>
                        <textarea class="form-control form-control-sm" id="equipDesc" name="description" rows="3"></textarea>
                    </div>
                </form>

<<<<<<< HEAD
                        <div class="form-group">
                            <label for="equipDesc">Description</label>
                            <textarea class="form-control form-control-sm" id="equipDesc" name="description" rows="3"></textarea>
                        </div>
                    </form>-->

                    {!! Form::open(['action' => 'EquipmentsController@editEquipment', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'editEquipDetails', 'style' => 'display:none; margin-top:20px;']) !!}
                        {{Form::submit('Save', ['class' => 'btn btn-sm btn-success float-right mb-3', 'id' => 'saveEditEquip'])}}
                        {{Form::label('category', 'Category')}}
                        {{Form::select('category', array(
                                    'CAMACC' => 'Cameras & Accessories',
                                    'ART' => 'Art Tools',
                                    'SPRT' => 'Sports Equipment',
                                    'GMNG' => 'Gaming Devices',
                                    'LPTP' => 'Laptops & Accessories',
                                    'MISC' => 'Miscellaneous Equipment'), NULL, array('class' => 'custom-select custom-select-md', 'placeholder' => 'Category'))}}

                        {{Form::label('equipName', 'Name', ['class' => 'pt-3'])}}
                        {{Form::text('equipName', '',['class' => 'form-control form-control-sm', 'placeholder' => $item->equip_name])}}

                        {{Form::label('description', 'Description')}}
                        {{Form::textarea('description', '',['id' => 'equipDesc','class' => 'form-control form-control-sm', 'placeholder' => 'Enter specifications here', 'rows' => '3'])}}     

                        {{Form::hidden('currentEquipName', $item->equip_name)}}
                    {!! Form::close() !!}
=======
                <button type="button" id="addStockBtn" class="btn btn-light float-right" data-container="body" data-toggle="popover" data-placement="bottom"><i class="fas fa-lg fa-plus-circle text-success"></i>
                  Add Stock
                </button>
                <div id="addStockForm" style="display: none">
                <form action="{{ action('EquipmentsController@addEquipment') }}" class="form-inline" id="addStock" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="itemName" value="{{$item->equipName}}">
                    <input type="hidden" name="category" value="{{$item->equip_category}}">
                    <input type="hidden" name="basePrice" value="{{$item->equip_baseprice}}">
                    <input type="hidden" name="penalty" value="{{$item->equip_penalty}}">
                    <input type="hidden" name="description" value="{{$item->equip_description}}">
                    <input type="hidden" name="equipIMG" value="{{$item->equip_img}}">
                    <input type="text" name="totalAmount" class="form-control rounded-0 border-right-0 form-control-sm w-75" id="itemName" placeholder="Enter quantity">
                    <button type="submit" class="btn btn-sm btn-success rounded-0 float-right">Add</button>
                </form>
                </div>
>>>>>>> b0cd0a861335555bad78167267a9181b6433a3e9
            </div>
        </div>
        
        <div class="items mt-4 mx-auto">
            <table class="table table-hover table-striped table-bordered" id="itemStockEdit">
                <thead class="text-center">
                    <tr>
                        <th class="align-middle">Equipment</th>
                        <th class="align-middle">Status</th>
                        <th class="align-middle">Remarks</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
{{-- 
@section('modal')
    @include('inc.deleteSingleModal')
    @include('inc.deleteConfirmationModal')
@endsection --}}