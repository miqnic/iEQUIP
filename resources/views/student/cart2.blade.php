@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | Cart</title>
    <link rel="stylesheet"  type="text/css" href="{{ asset('css/cart2.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
    
    <script>
        $(function () {
            $('#startdate').datetimepicker({
                format: 'DD-MM-YYYY'
            });
        });

        $(function () {
            $('#enddate').datetimepicker({
                format: 'DD-MM-YYYY'
            });
        });

        $(function () {
            $('#starttime').datetimepicker({
                format: 'LT'
            });
        });

        $(function () {
            $('#endtime').datetimepicker({
                format: 'LT'
            });
        });
    </script>
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
    <div class="fill-up">
        <h2>Reservation Form Details</h2>
        <p>Please fill all fields.</p>
        <form>
        <div class="form-row">
            <div class="col-md-6 text-center">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Start Date</span>
                    </div>
                    <input type="text" class="form-control date datetimepicker-input" id="startdate" placeholder="DD-MM-YYYY" data-target-input="nearest" data-target="#startdate" data-toggle="datetimepicker" data-target="#startdate"/>
                </div>
            </div>

            <div class="col-md-6 text-center">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">End Date</span>
                    </div>
                    <input type="text" class="form-control date datetimepicker-input" id="enddate" placeholder="DD-MM-YYYY" data-target-input="nearest" data-target="#enddate" data-toggle="datetimepicker" data-target="#enddate"/>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 text-center">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Start Time</span>
                    </div>
                    <input type="text" class="form-control date datetimepicker-input" id="starttime" placeholder="hh:mm AM/PM" data-target-input="nearest" data-target="#starttime" data-toggle="datetimepicker" data-target="#starttime"/>
                </div>
            </div>

            <div class="col-md-6 text-center">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">End Time</span>
                    </div>
                    <input type="text" class="form-control date datetimepicker-input" id="endtime" placeholder="hh:mm AM/PM" data-target-input="nearest" data-target="#endtime" data-toggle="datetimepicker" data-target="#endtime"/>
                </div>
            </div>
        </div>

        
        <div class="form-group text-center">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inlineFormCustomSelect">Room Number</span>
                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                        <option selected disabled>Choose Room Number...</option>
                        <option value="1">1001</option>
                        <option value="1">1002</option>
                        <option value="1">1003</option>
                        <option value="1">1004</option>
                        <option value="1">1005</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group text-center">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text">Reason:</span>
                </div>
                <textarea class="form-control" placeholder="Enter the purpose of reservation"></textarea>
            </div>
        </div>
        </form>
    </div>
</div>
  
<div class="wrapper text-center">
    <div class="btn-group text-center mt-2" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-outline-secondary btn-lg"><a href="cart">Previous</a></button>
        <button type="button" class="btn btn-outline-primary btn-lg"><a href="cart3">Next</a></button>
    </div>
</div>
@endsection

@section('modal')
    {{-- @include('inc.checkFormModal') --}}
    @include('inc.awayModalContact')
    @include('inc.awayModalEquip')
    @include('inc.awayModalHist')
    @include('inc.awayModalHome')
@endsection