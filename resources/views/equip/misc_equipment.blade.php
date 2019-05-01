@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | Miscellaneous Equipment</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin-equiplist.css') }}">
    
@endsection

@section('navi')
  @if(Auth::user()->access_role == "ADMIN")
    @include('inc.naviAdmin')
  @else
    @include('inc.naviStudent')
  @endif
@endsection

@section('content')
<div class="header">
    <h2 class="border-bottom pb-2 pl-3">Miscellaneous</h2>
</div>

<div class="container-fluid pt-4">
        <!--Admin Roles to Add/Delete-->
        @if(Auth::user()->access_role == "ADMIN")
            <div class="row">
                <div class="col-md-12 pb-2 text-right">
                    <button type="button" name="addEquip" class="btn btn-default" data-toggle="modal" data-target="#addEquip"><img id="plus" src="images/plus.png" height=18;> Add Equipment</button>
                    <button type="button" name="delEquip" class="btn btn-default" data-toggle="modal" data-target="#delEquip"><img id="minus" src="images/minus.png" height=18;> Delete Equipment</button>
                </div>
            </div>
        @endif


  <!--Item List-->
  <div class="row pb-3">
    @foreach ($equipments as $equipment)
      <div class="col-md-3">
        <div class="card text-center pt-2">
          <img src="images/camera.png" class="card-img-top align-self-center" alt="Item photo">
          <div class="card-body">
            <h5 class="card-title text-truncate">{{$equipment->equip_name}}</h5>
            <p class="card-text">Availability: 4/4</p>
            <button data-toggle="modal" data-target="#itemList" class="btn btn-dark btn-sm w-75">More Info</button>
          </div>
        </div>
      </div>
    @endforeach

    <!--<div class="col-md-3">
      <div class="card text-center pt-2">
        <img src="images/marker.png" class="card-img-top align-self-center" alt="Item photo">
        <div class="card-body">
          <h5 class="card-title text-truncate">Whiteboard Marker</h5>
          <p class="card-text">Availability: 38/70</p>
          <button data-toggle="modal" data-target="#itemList" class="btn btn-dark btn-sm w-75">More Info</button>
        </div>
      </div>
    </div>
  </div>-->

  <!--MODAL SECTION-->

  <div class="modal fade" id="itemList" tabindex="-1">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Item Overview</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <div class="media">
            <img class="align-self-center mr-5" src="images/chair.png" style="width: 100px;" alt="Sample photo">
              <div class="media-body">
                <h5>Swivel Chair</h5>
                <div class="row">
                  <div class="col-md-3">
                    <small>
                    <strong>Availability:</strong> 16/24<br>
                    <strong>Base Price: </strong>PHP 1,699.00<br>
                    <strong>Penalty: </strong>PHP 100.00<br>
                    </small>
                  </div>
                  <div class="col-md-7">
                  </div>
                  <div class="col-md-2 pt-2">
                    <button type="button" data-target="#editItemModal" data-dismiss="modal" data-toggle="modal" class="btn btn-outline-secondary">Edit</button>
                    </div>
                </div>
              </div>
            </div>
          
          <table class="table table-bordered table-responsive-sm text-center">
            <thead>
              <tr>
                <th>Equipment Code</th>
                <th>Status</th>
                <th>Remarks</th>
                <th>Options</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="align-middle">SWICHA0001</td>
                <td class="align-middle">Available</td>
                <td class="align-middle">N/A</td>
                <td>
                    @if (Auth::user()->access_role == "ADMIN")
                    <button type="button" data-target="#editStockModal" data-dismiss="modal" data-toggle="modal" class="btn btn-sm btn-outline-secondary">Edit</button>
                    <button type="button" data-target="#deleteSingleModal" data-dismiss="modal" data-toggle="modal" class="btn btn-sm btn-danger">Delete</button>
                    @else
                    <button type="button" data-target="#confirmReserveModal" data-dismiss="modal" data-toggle="modal" class="btn btn-sm btn-success">Reserve</button>
                    @endif
                </td>
              </tr>
              <tr>
                <td class="align-middle">SWICHA0001</td>
                <td class="align-middle">Available</td>
                <td class="align-middle">N/A</td>
                <td>
                    @if (Auth::user()->access_role == "ADMIN")
                    <button type="button" data-target="#editStockModal" data-dismiss="modal" data-toggle="modal" class="btn btn-sm btn-outline-secondary">Edit</button>
                    <button type="button" data-target="#deleteSingleModal" data-dismiss="modal" data-toggle="modal" class="btn btn-sm btn-danger">Delete</button>
                    @else
                    <button type="button" data-target="#confirmReserveModal" data-dismiss="modal" data-toggle="modal" class="btn btn-sm btn-success">Reserve</button>
                    @endif
                </td>
              </tr>
              <tr>
                <td class="align-middle">SWICHA0003</td>
                <td class="align-middle">Under Maintenance</td>
                <td class="align-middle">Detached wheel</td>
                <td>
                    @if (Auth::user()->access_role == "ADMIN")
                    <button type="button" data-target="#editStockModal" data-dismiss="modal" data-toggle="modal" class="btn btn-sm btn-outline-secondary">Edit</button>
                    <button type="button" data-target="#deleteSingleModal" data-dismiss="modal" data-toggle="modal" class="btn btn-sm btn-danger">Delete</button>
                    @else
                    <button type="button" data-target="#confirmReserveModal" data-dismiss="modal" data-toggle="modal" class="btn btn-sm btn-success">Reserve</button>
                    @endif
                </td>
              </tr>
              <tr>
                <td class="align-middle">SWICHA0004</td>
                <td class="align-middle">Reserved</td>
                <td class="align-middle">N/A</td>
                <td>
                    @if (Auth::user()->access_role == "ADMIN")
                    <button type="button" data-target="#editStockModal" data-dismiss="modal" data-toggle="modal" class="btn btn-sm btn-outline-secondary">Edit</button>
                    <button type="button" data-target="#deleteSingleModal" data-dismiss="modal" data-toggle="modal" class="btn btn-sm btn-danger">Delete</button>
                    @else
                    <button type="button" data-target="#confirmReserveModal" data-dismiss="modal" data-toggle="modal" class="btn btn-sm btn-success">Reserve</button>
                    @endif
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('modal')
    @include('inc.editItemModal')
    @include('inc.editStockModal')
    @include('inc.deleteConfirmationModal')
    @include('inc.deleteSingleModal')
    @include('inc.addEquipModal')
    @include('inc.delEquipModal')
    @include('inc.confirmEquipChangesModal')
@endsection