@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | Cart</title>
    <link rel="stylesheet" href="{{ asset('css/equiplist.css') }}" type=text/css>

    <style>
    .btn > a {
        color: #007bff !important;
        text-decoration: none;
        background-color: none;
    }
    .inside {
        background-color: transparent !important;
    }

    .summary {
        width: 85%;
    }
    </style>
@endsection

@section('navi')
    @include('inc.naviStudent',[$totalEquip, $lastTransaction, $countCart])
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div id="progress">
            <ul class="progressbar justify-content-center">
                <li class="active">Review Equipment</li>
                <li class ="active">Reservation Form Fill-up</li>
                <li class ="active">Summary</li>
            </ul>
        </div>
    </div>
</div>
  
<div class="summary row mt-5 mx-auto">
    <div class="col-md-3">
        <h5 class="border-bottom pb-2">Reservation Details</h5>
        <div class="formsum mt-4 ml-2">
            <p>
                <b>Start Date and Time:</b><br>
                {{\Carbon\Carbon::parse($currentTransaction->start_date)->toDayDateTimeString()}}
            </p>
            <p>
                <b>End Date and Time:</b><br>
                {{\Carbon\Carbon::parse($currentTransaction->due_date)->toDayDateTimeString()}}
            <p>
                <b>Room Number:</b><br>
                {{$currentTransaction->room_number}}
            </p>
            <p>
                <b>Reason:</b><br>
                {{$currentTransaction->purpose}}
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
                @foreach ($totalEquip->unique('equip_name') as $equipment)
                    @if ($equipment->transaction_id == $lastTransaction->transaction_id)
                        <tr>
                        <td class="pl-5 align-middle">
                            {{$equipment->equip_name}}
                            @foreach ($totalEquip as $specificEquip)
                                @if ($specificEquip->equip_name == $equipment->equip_name && $specificEquip->transaction_id == $lastTransaction->transaction_id)
                                    <br>
                                    <small class="pl-2">{{$specificEquip->equipID}}</small>
                                @endif
                            @endforeach
                        </td>
                        <td class="text-center align-middle">
                            @foreach ($countCart as $item)
                                @if (Arr::get($item, 'equip_name') == $equipment->equip_name)
                                    {{Arr::get($item, 'record')}}
                                @endif
                            @endforeach
                        </td>
                        </tr>
                    @endif
                @endforeach
            <!--<tr>
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
            </tr>-->
            </tbody>
        </table>
    </div>
</div>
  
<div class="text-center">
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
                {!! Form::open(['action' => 'TransactionFormsController@submitForm', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                {{Form::submit('Confirm', ['class' => 'btn btn-success'])}}
                {!! Form::close() !!}
                <button type="button" class="btn btn" data-dismiss="modal">Close</button>
            </div>
    
            </div>
        </div>
    </div>
@endsection