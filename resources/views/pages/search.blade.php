@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | Search Results: {{$search}}</title>
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
      @if(Auth::user()->access_role == "ADMIN")
      <div class="addEdit float-left mb-2">
        <button type="button" name="addEquip" class="btn btn-sm btn-light"><a href="add" class="text-dark"><i class="fas fa-lg fa-plus-circle text-success"></i> Add Equipment</a></button>
        <button type="button" name="delEquip" class="btn btn-sm btn-light" data-toggle="modal" data-target="#delEquip"><i class="fas fa-lg fa-minus-circle text-danger"></i> Delete Equipment</button>
        @include('inc.addEquipModal')
        @include('inc.delEquipModal')
      </div>
      @else
      <div class="pt-1">
        <h5>Search Results: {{$search}}</h5>
      </div>
      @endif
      <hr style="clear:both;">
      <div class="d-inline-flex flex-row flex-wrap align-items-center justify-content-start">
        @foreach ($equipments->unique('equip_name') as $equipment)
            @foreach ($possibleEquips->unique('equip_name') as $searchEquip)
                @if ($equipment->equip_name == $searchEquip->equip_name || $equipment->equipID == $searchEquip->equipID)
                    <div class="card itemCard text-center mt-1 pt-3 mr-1">
                        @foreach ($countCurrAvail as $itemCurr)
                        @foreach($countTotalAvail as $itemTotal)
                            @if (Arr::get($itemCurr, 'equip_name') == $equipment->equip_name && Arr::get($itemTotal, 'equip_name') == $equipment->equip_name)
                            @if(Arr::get($itemCurr, 'record')== '')
                            <span class="badge stockStat badge-danger ml-3">Out of stock</span>
                            @elseif(Arr::get($itemTotal, 'record')/2 >= Arr::get($itemCurr, 'record'))
                            <span class="badge stockStat badge-warning ml-3">Low in stock</span>
                            @else 
                            <span class="badge stockStat badge-success ml-3">In stock</span>
                            @endif
                            @endif
                        @endforeach
                        @endforeach 
                        <img src="{{ asset('img/'.$equipment->equip_img) }}" class="card-img-top align-self-center" alt="Item photo">
                        <div class="card-body">
                        @php
                            $spaces = '/\s+/';
                            $replace = '-';
                            $string= $equipment->equip_name;
                            $trimmedString = preg_replace($spaces, $replace, $string);
                        @endphp
                        @if(Auth::user()->access_role == "ADMIN")
                        <a class="card-link" href="{{ url('admin/'.$trimmedString) }}"><h6 class="card-title text-truncate">{{$equipment->equip_name}}</h6></a>
                        @else
                            <a class="card-link" href="{{ url('student/'.$trimmedString) }}"><h6 class="card-title text-truncate">{{$equipment->equip_name}}</h6></a>
                        @endif
                        <p class="card-text mb-4">
                            Availability: 
                            @foreach ($countCurrAvail as $item)
                            @if (Arr::get($item, 'equip_name') == $equipment->equip_name)
                                {{Arr::get($item, 'record')}}
                            @endif
                            @endforeach 
                            /
                            @foreach ($countTotalAvail as $item)
                            @if (Arr::get($item, 'equip_name') == $equipment->equip_name)
                                @if (Arr::get($item, 'record') == '')
                                    0
                                @else
                                {{Arr::get($item, 'record')}}
                                @endif
                            @endif
                            @endforeach
                        </p>
                        </div>
                    </div>
<<<<<<< HEAD

                    <!--MODAL SECTION-->

                    <div class="modal fade" id="itemList-{{$equipment->equipID}}" tabindex="-1">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                
                            <div class="modal-header">
                                <h4 class="modal-title">Item Overview</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                
                            <div class="modal-body">
                                <div class="media">
                                <img class="align-self-center mr-5" src="images/camera.png" style="width: 100px;" alt="Sample photo">
                                    <div class="media-body">
                                    <h5>{{$equipment->equip_name}}</h5>
                                    <div class="row">
                                        <div class="col-md-3">
                                        <small>
                                        <strong>Availability:</strong>
                                            @foreach ($countCurrAvail as $item)
                                                
                                            @if (Arr::get($item, 'equip_name') == $equipment->equip_name)
                                            {{Arr::get($item, 'record')}}
                                            @endif
                                                
                                                
                                            @endforeach 
                                            /
                                            @foreach ($countTotalAvail as $item)
                                            @if (Arr::get($item, 'equip_name') == $equipment->equip_name)
                                                {{Arr::get($item, 'record')}}
                                            @endif
                                            @endforeach
                                        <br>
                                        <strong>Base Price: </strong>PHP {{$equipment->equip_baseprice}}<br>
                                        <strong>Penalty: </strong>PHP {{$equipment->equip_penalty}}<br>
                                        </small>
                                        </div>
                                        <div class="col-md-7">
                                        <!--Item Description
                                        <small>
                                        <strong>Image Sensor: </strong>22.3mm x 14.9mm CMOS<br>
                                        <strong>Pixels: </strong>Approx. 24.2 megapixels<br>
                                        <strong>Image Processor: </strong>DIGIC 6<br>
                                        <strong>Lens Mount: </strong>EF/EF-S lens<br>
                                        </small>-->
                                        </div>
                                        <div class="col-md-1 pt-2">
                                        <button type="button" data-target="#editItemModal-{{$equipment->equip_name}}" data-dismiss="modal" data-toggle="modal" class="btn btn-outline-secondary">Edit</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                
                                <table class="table table-bordered table-responsive-sm text-center">
                                <thead>
                                    <tr>
                                    <th>Equipment Code</th>
                                    @if (Auth::user()->access_role == "ADMIN")
                                        <th>Status</th>
                                    @endif
                                    <th>Remarks</th>
                                    <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($equipments as $equipment_modal)
                                    <tr>
                                        @if ($equipment_modal->equip_name == $equipment->equip_name)
                                            <td class="align-middle">{{$equipment_modal->equipID}}</td>
                                            @if (Auth::user()->access_role == "ADMIN")
                                            <td class="align-middle">
                                                @if ($equipment_modal->equip_avail == 0)
                                                Available
                                                @elseif($equipment_modal->equip_avail > 0)
                                                Borrowed
                                                @else
                                                Unavailable
                                                @endif
                                            </td>
                                            @endif
                                            <td class="align-middle">{{$equipment_modal->equip_description}}</td>
                                            <td>
                                                @if (Auth::user()->access_role == "ADMIN")
                                                <button type="button" data-dismiss="modal" data-toggle="modal" class="btn btn-sm btn-outline-secondary" data-target="#editStockModal-{{$equipment_modal->equipID}}">Edit</button>
                                                <button type="button" data-dismiss="modal" data-toggle="modal" class="btn btn-sm btn-danger" data-target="#deleteSingleModal-{{$equipment_modal->equipID}}">Delete</button>

                                                <!--Edit and Delete Modals for EACH equipment (by equipID)-->
                                                @include('inc.editStockModal', [$equipment_modal, $equipment])
                                                @include('inc.deleteSingleModal', $equipment_modal)
                                                @else
                                                    @php
                                                    $spaces = '/\s*/m';
                                                    $replace = '';

                                                    $string= $equipment->equip_name;

                                                    $trimmedString = preg_replace($spaces, $replace, $string);
                                                @endphp
                                                <button type="button" data-dismiss="modal" data-toggle="modal" class="btn btn-outline-secondary" data-target="#editItemModal-{{$trimmedString}}" >Edit</button>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                                </table>
                            </div>
                
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                    </div>

                    <!--Edit Modal for a SPECIFIC equipment (by equip_name)-->
                    @include('inc.confirmEquipChangesModal', $equipment)
                    @include('inc.editItemModal', [$equipment, $countTotalAvail])
=======
>>>>>>> ccf0fb9708b1b11ce52dada69c46a07931a82e83
                @endif
            @endforeach 
        @endforeach
            </div>
            <div class="pagination d-block position-absolute mt-3" style="right:20px">
                {{ $possibleEquips->links() }}
            </div>
        </div>
    </div>
      </div>
    </div>
@endsection

@section('modal')
    @include('inc.deleteConfirmationModal')
@endsection