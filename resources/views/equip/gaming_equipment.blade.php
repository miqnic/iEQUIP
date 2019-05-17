@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | Gaming Equipment</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin-equiplist.css') }}">
@endsection

@section('navi')
  @if(Auth::user()->access_role == "ADMIN")
    @include('inc.naviAdmin')
  @else
    @include('inc.naviStudent', [$totalEquip, $lastTransaction, $countCart])
  @endif
@endsection

@section('content')
    <div class="header">
        <h2 class="border-bottom pb-2 pl-3">Gaming Equipment</h2>
    </div>

    <div class="container-fluid pt-4">
        <!--Admin Roles to Add/Delete-->
        @if(Auth::user()->access_role == "ADMIN")
            <div class="row">
                <div class="col-md-12 pb-2 text-right">
                    <button type="button" name="addEquip" class="btn btn-light btn-default" data-toggle="modal" data-target="#addEquip"><img id="plus" src="{{ asset('img/plus.png') }}" height=18;> Add Equipment</button>
                    <button type="button" name="delEquip" class="btn btn-light btn-default" data-toggle="modal" data-target="#delEquip"><img id="minus" src="{{ asset('img/minus.png') }}" height=18;> Delete Equipment</button>
                </div>
            </div>

            @include('inc.addEquipModal')
            @include('inc.delEquipModal')
        @endif

      <!--Item List-->
      <div class="row pb-3">
        @foreach ($equipments->unique('equip_name') as $equipment)
          <div class="col-md-3">
            <div class="card text-center pt-2">
              <img src="images/camera.png" class="card-img-top align-self-center" alt="Item photo">
              <div class="card-body">
                <h5 class="card-title text-truncate">{{$equipment->equip_name}}</h5>
                <p class="card-text">Availability: 
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
                </p>
                <button data-toggle="modal" data-target="#itemList-{{$equipment->equipID}}" class="btn btn-dark btn-sm w-75">More Info</button>
              </div>
            </div>
          </div>

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
                                      <button type="button" data-target="#editStockModal-{{$equipment_modal->equipID}}" data-dismiss="modal" data-toggle="modal" class="btn btn-sm btn-outline-secondary">Edit</button>
                                      <button type="button" data-target="#deleteSingleModal-{{$equipment_modal->equipID}}" data-dismiss="modal" data-toggle="modal" class="btn btn-sm btn-danger">Delete</button>
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

                          <!--Edit and Delete Modals for EACH equipment (by equipID)-->
                          @include('inc.editStockModal', [$equipment_modal, $equipment])
                          @include('inc.deleteSingleModal', [$equipment])

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

        @endforeach
      </div>
    </div>
@endsection

@section('modal')
    @include('inc.deleteConfirmationModal')
@endsection