@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | Cart</title>
    <link rel="stylesheet" href="{{ asset('css/cart2.css') }}" type=text/css>
@endsection

@section('navi')
    @include('inc.naviStudent')
@endsection

@section('content')
<div class="container-fluid" id="progress">
    <ul class="progressbar justify-content-center">
        <li class="active">Review Equipment/s</li>
        <li class ="active">Reservation Form Fill-up</li>
        <li>Summary</li>
    </ul>
</div>
  
<div class="container-fluid">
    <div class = "fill-up">
        <h2>Reservation Form Details</h2>
        <p>Please fill all fields.</p>
        <div class="row">
            <div class="col-md-6 text-center">
                <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Start Date</span>
                </div>
                <input type="text" class="form-control" placeholder="dd/mm/yyyy" aria-label="startdate" aria-describedby="basic-addon1">
                </div>
            </div>

            <div class="col-md-6 text-center">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">End Date</span>
                    </div>
                    <input type="text" class="form-control" placeholder="dd/mm/yyyy" aria-label="enddate" aria-describedby="basic-addon1">
                </div>
            </div>

            <div class="col-md-6 text-center">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Start Time</span>
                    </div>
                    <input type="text" class="form-control" placeholder="hh:mm AM/PM" aria-label="starttime" aria-describedby="basic-addon1">
                </div>
            </div>

            <div class="col-md-6 text-center">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">End Time</span>
                    </div>
                    <input type="text" class="form-control" placeholder="hh:mm AM/PM" aria-label="starttime" aria-describedby="basic-addon1">
                </div>
            </div>

            <div class="col-md-6 text-center">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inlineFormCustomSelect">Room Number</span>
                            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                <option selected>Choose...</option>
                                <option value="1">1001</option>
                                <option value="1">1002</option>
                                <option value="1">1003</option>
                                <option value="1">1004</option>
                                <option value="1">1005</option>
                            </select>
                    </div>
                </div>
            </div>

            <div class="col-md-12 text-center">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Reason:</span>
                    </div>
                    <textarea class="form-control" aria-label="Reason for reserving equipment/s"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
  
<div class="wrapper text-center">
    <div class="btn-group text-center mt-2" role="group" aria-label="Basic example">
        <a href="cart"><button type="button" class="btn btn-outline-secondary btn-lg">Previous</button></a>
        <a href="cart3"><button type="button" class="btn btn-outline-primary btn-lg">Next</button></a>
    </div>
</div>
@endsection

@section('modal')
    @include('inc.checkFormModal')
    @include('inc.awayModalContact')
    @include('inc.awayModalEquip')
    @include('inc.awayModalHist')
    @include('inc.awayModalHome')
@endsection