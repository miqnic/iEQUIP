@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | Cart</title>
    <link rel="stylesheet"  type="text/css" href="{{ asset('css/equiplist.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
    
    <style>
    .btn > a {
        color: #007bff;
        text-decoration: none;
        background-color: none;
    }
    .inside {
        background-color: transparent !important;
    }
    </style>
    <script>
        $(function () {
            $('#startdate').datetimepicker({
                format: 'MMMM DD, YYYY',
                minDate: moment()
            });

            $('#enddate').datetimepicker({
                format: 'MMMM DD, YYYY',
                minDate: moment()
            });

            $('#starttime').datetimepicker({
                format: 'LT'
            });

            $('#endtime').datetimepicker({
                format: 'LT'
            });
        });
    </script>
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
                    <li>Summary</li>
                </ul>
            </div>
        </div>
    </div>

<div class="row">
    <div class="col-md-12 mt-5">
        <div class="fill-up w-75 mx-auto">
            @if(session('errorMsg'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                {{ session('errorMsg') }}
            </div>
            @endif

            <h2>Reservation Form Details</h2>
            <p>Please fill all fields.</p>

            {!! Form::open(['action' => 'TransactionFormsController@cart3', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

            <div class="form-row">
                <div class="col-md-6 text-center">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Start Date</span>
                        </div>
                        {{Form::text('startdate', '',['class' => 'form-control date datetimepicker-input', 'placeholder'=>'Choose start date', 'data-target-input'=>'nearest', 'data-target'=>'#startdate', 'data-toggle'=>'datetimepicker', 'id'=>'startdate'])}}
                    </div>
                </div>

                <div class="col-md-6 text-center">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">End Date</span>
                        </div>
                        {{Form::text('enddate', '',['class' => 'form-control date datetimepicker-input', 'placeholder'=>'Choose end date', 'data-target-input'=>'nearest', 'data-target'=>'#enddate', 'data-toggle'=>'datetimepicker', 'id'=>'enddate'])}}
                        <!--<input type="text" class="form-control date datetimepicker-input" id="enddate" placeholder="DD-MM-YYYY" data-target-input="nearest" data-target="#enddate" data-toggle="datetimepicker" data-target="#enddate"/>-->
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 text-center">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Start Time</span>
                        </div>
                        {{Form::text('starttime', '',['class' => 'form-control date datetimepicker-input', 'placeholder'=>'Choose start time', 'data-target-input'=>'nearest', 'data-target'=>'#starttime', 'data-toggle'=>'datetimepicker', 'id'=>'starttime'])}}
                        <!--<input type="text" class="form-control date datetimepicker-input" id="starttime" placeholder="hh:mm AM/PM" data-target-input="nearest" data-target="#starttime" data-toggle="datetimepicker" data-target="#starttime"/>-->
                    </div>
                </div>

                <div class="col-md-6 text-center">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">End Time</span>
                        </div>
                        {{Form::text('endtime', '',['class' => 'form-control date datetimepicker-input', 'placeholder'=>'Choose end time', 'data-target-input'=>'nearest', 'data-target'=>'#endtime', 'data-toggle'=>'datetimepicker', 'id'=>'endtime'])}}
                        <!--<input type="text" class="form-control date datetimepicker-input" id="endtime" placeholder="hh:mm AM/PM" data-target-input="nearest" data-target="#endtime" data-toggle="datetimepicker" data-target="#endtime"/>-->
                    </div>
                </div>
            </div>
            
            <div class="form-group text-center">
                <div class="input-group w-50">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inlineFormCustomSelect">Room Number</span>
                        
                    </div>
                    {{Form::select('roomnumber', array(
                                    '1001' => '1001',
                                    '1002' => '1002',
                                    '1003' => '1003',
                                    '1004' => '1004',
                                    '1005' => '1005',
                                    '1006' => '1006'), 0, array('class' => 'form-control custom-select', 'required' => '', 'placeholder'=>'Choose Room Number'))}}
                </div>
            </div>

            <div class="form-group text-center">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Reason:</span>
                    </div>
                    {{Form::textarea('reason', '',['class' => 'form-control', 'placeholder' => 'Enter the purpose of reservation', 'required' => '', 'rows' =>'4'])}} 
                </div>
            </div>
        </div>
    </div>
</div>
  
<div class="text-center">
    <div class="btn-group text-center mt-2" role="group" aria-label="Basic example">
        <a href="cart" class="btn btn-outline-secondary btn-lg">Previous</a>
        {{Form::submit('Next', ['class' => 'btn btn-outline-primary btn-lg cartNext', 'href'=>'cart3'])}}
    </div>
</div>
{!! Form::close() !!}
@endsection

@section('modal')
    {{-- @include('inc.checkFormModal') --}}
    @include('inc.awayModalContact')
    @include('inc.awayModalEquip')
    @include('inc.awayModalHist')
    @include('inc.awayModalHome')
@endsection