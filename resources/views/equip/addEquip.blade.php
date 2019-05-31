@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | Add Equipment</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/equiplist.css') }}">
@endsection

@section('navi')
  @if(Auth::user()->access_role == "ADMIN")
    @include('inc.naviAdmin')
  @else
    @include('inc.naviStudent', [$totalEquip, $lastTransaction, $countCart])
  @endif
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
    
    <div class="col-md-9 mt-2">
        <div class="pt-1">
        <h5>Add Equipment</h5>
        </div>
        <hr style="clear:both;">
        <form action="{{ action('EquipmentsController@addEquipment')}}" method="POST" enctype="multipart/formdate">
        @csrf
        <div id="addForm">
            <div class="row my-3 w-75 mx-auto">
                <div class="col-md-12">
                    <div class="border px-3 py-3 bg-light">
                        <label for="itemName">Item Name</label>
                        <input type="text" name="itemName" class="form-control" id="itemName" placeholder="Enter item name">
                        <div class="row">
                        <div class="col-md-4">
                            <label class="pt-3" for="category">Category</label>
                            <select id="category" name="category" class="form-control custom-select">
                                <option selected disabled>Select category</option>
                                <option value="CAMACC">Cameras & Accessories</option>
                                <option value="ART">Art Tools</option>
                                <option value="SPRT">Sports Equipment</option>
                                <option value="GMNG">Gaming Devices</option>
                                <option value="LPTP">Laptops & Accessories</option>
                                <option value="MISC">Miscellaneous</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="pt-3" for="remarks">Base Price (PHP)</label>
                            <input type="text" name="basePrice" class="form-control" id="basePrice" placeholder="Enter amount">
                        </div>
                        <div class="col-md-4">
                            <label class="pt-3" for="remarks">Penalty Fee (PHP)</label>
                            <input type="text" name="penalty" class="form-control" id="penalty" placeholder="Enter amount">
                        </div>
                        </div>
                        <label class="pt-3" for="remarks">Specifications</label>
                        <textarea class="form-control" name="description" rows="5" placeholder="Enter specifications here"></textarea>
                        <div class="row">
                        <div class="col-md-4">
                        <label class="pt-3" for="totalAmount">Item Quantity</label>
                        <input type="text" name="totalAmount" class="form-control" id="itemName" placeholder="Enter quantity">
                        </div>
                        <div class="col-md-6">
                            <label class="pt-3" for="itemImage">Item Image</label>
                            <input type="file" name="equipIMG">
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <button type="submit" class="btn btn-success text-center">Add Equipment</button>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- 
@section('modal')
    @include('inc.deleteSingleModal')
    @include('inc.deleteConfirmationModal')
@endsection --}}