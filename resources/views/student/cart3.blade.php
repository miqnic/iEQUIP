@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | Cart</title>
    <link rel="stylesheet" href="{{ asset('css/cart3.css') }}" type=text/css>
@endsection

@section('navi')
    @include('inc.naviStudent')
@endsection

@section('content')
<div class="container-fluid" id="progress">
    <ul class="progressbar justify-content-center">
        <li class="active">Review Equipment/s</li>
        <li class ="active">Reservation Form Fill-up</li>
        <li class ="active">Summary</li>
    </ul>
</div>
  
<div class="container-fluid">
    <div class="summary">
        <div class="row">
            <div class="col-md-3">
                <h5 class="border-bottom pb-2">Reservation Details</h5>
                <div class="formsum mt-4 ml-2">
                    <p>
                        <b>Start Date and Time:</b><br>
                        07/01/2019 07:30AM
                    </p>
                    <p>
                        <b>End Date and Time:</b><br>
                        07/01/2019 11:00AM
                    </p>
                    <p>
                        <b>Room Number:</b><br>
                        1001
                    </p>
                    <p>
                        <b>Reason:</b><br>
                        Class Activity
                    </p>
                </div>
            </div>
 
            <div class="col-md-9">
                <h5 class="border-bottom pb-2">Item Summary</h5>
                <table class="table table-striped table-bordered mt-4">
                    <thead class="text-center align-middle">
                    <tr>
                        <th>Equipment Name</th>
                        <th>Quantity</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="pl-4 align-middle">Canon EOS 80D
                            <br>
                            <small class="pl-2">CANCAM0001</small>
                            <br>
                            <small class="pl-2">CANCAM0002</small>
                        </td>
                        <td class="text-center align-middle">2</td>
                    </tr>
                    <tr>
                        <td class="pl-4 align-middle">Spalding NBA Official Game Ball Basketball
                            <br>
                            <small class="pl-2">SPANBA0001</small>
                        </td>
                        <td class="text-center align-middle">1</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
  
<div class="wrapper text-center">
    <div class="btn-group text-center mt-2" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-outline-secondary btn-lg"><a href="cart2">Previous</a></button>
        <button type="button" class="btn btn-outline-success btn-lg" data-toggle = "modal" data-target="#modalConfirm">Submit</button>
    </div>
</div>
@endsection

@section('modal')
    {{-- @include('inc.checkFormModal') --}}
    @include('inc.awayModalContact')
    @include('inc.awayModalEquip')
    @include('inc.awayModalHist')
    @include('inc.awayModalHome')

    <div class="modal" id="modalConfirm">
        <div class="modal-dialog">
            <div class="modal-content">
    
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Form Submission Confirmation</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
    
            <!-- Modal body -->
            <div class="modal-body">
                <p>Please click on the "Confirm" button below to submit your reservation form. If not, press Cancel.</p>
                <p>Pending requests can be cancelled in your homepage.</p>
            </div>
    
            <!-- Modal footer -->
            <div class="modal-footer">
                <a href="home"><button type="button" class="btn btn-success">Confirm</button></a>
                <button type="button" class="btn btn" data-dismiss="modal">Close</button>
            </div>
    
            </div>
        </div>
    </div>
@endsection