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
            <div class="col-md-6 text-center">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Equipment ID</th>
                        <th>Equipment Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>CANCAM0001</td>
                        <td >Canon EOS 80D</td>
                    </tr>
                    <tr>
                        <td>SPANBA0001</td>
                        <td>Spalding NBA Official Game Ball Basketball</td>
                    </tr>
                    <tr>
                        <td>CANCAM0002</td>
                        <td>Canon EOS 80D</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-md-6 text-center">
                <div class="formsum">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <h4>Transaction Number:</h4>
                        </div>
                        
                        <div class="col-md-6 text-center">
                            <h4>Room Number:</h4>
                        </div>

                        <div class="col-md-6 text-center">
                            <p>TC19000015</p>
                        </div>

                        <div class="col-md-6 text-center">
                            <p>1001</p>
                        </div>

                        <div class="col-md-6 text-center">
                            <h4>Start Date:</h4>
                        </div>

                        <div class="col-md-6 text-center">
                            <h4>End Date:</h4>
                        </div>

                        <div class="col-md-6 text-center">
                            <p>07/01/2019</p>
                        </div>

                        <div class="col-md-6 text-center">
                            <p>07/01/2019</p>
                        </div>

                        <div class="col-md-6 text-center">
                            <p></p>
                        </div>

                        <div class="col-md-6 text-center">
                            <p></p>
                        </div>

                        <div class="col-md-6 text-center">
                            <h4>Start Time:</h4>
                        </div>

                        <div class="col-md-6 text-center">
                            <h4>End Time:</h4>
                        </div>

                        <div class="col-md-6 text-center">
                            <p>07:30 AM</p>
                        </div>

                        <div class="col-md-6 text-center">
                            <p>11:00 AM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  
<div class="wrapper text-center">
    <div class="btn-group text-center mt-2" role="group" aria-label="Basic example">
        <a href="cart2"><button type="button" class="btn btn-outline-secondary btn-lg">Previous</button></a>
        <button type="button" class="btn btn-outline-success btn-lg" data-toggle = "modal" data-target="#modalConfirm">Submit</button>
    </div>
</div>
@endsection

@section('modal')
    @include('inc.checkFormModal')
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