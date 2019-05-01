@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | Home</title>
    <link rel="stylesheet" href="{{ asset('css/student-homepage.css') }}" type=text/css>
@endsection

@section('navi')
    @include('inc.naviStudent')
@endsection

@section('content')
<div class="row">
    <div class="col-md-3 mx-auto" style="display: block; width: auto; flex: 0 0 0">
        <div class="card" style="width: 20rem;" id="con1">
            <img class="card-img-top" src="img\user-account-box.jpg" alt="Sample photo">
            <div class="card-body">
                <h5 class="card-title">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h5><br>
                <p class="card-text"><b>Student ID #:</b> {{ Auth::user()->user_id }}</p>
                <p class="card-text"><b>Course:</b> {{ Auth::user()->course }}</p>
                <p class="card-text"><b>Penalty:</b> {{ Auth::user()->penalty }} PHP</p>
            </div>
        </div>
    </div>

    <div class="col-md-9 mr-auto">
        <div class="container-fluid mx-auto" id="con2">
            <h2><b>Pending Requests</b></h2><br>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Transaction Code</th>
                    <th>Date Submitted</th>
                    <th>Cancel Request</th>
                </tr>
                </thead>
                <tbody>
                <tr class = "member" data-toggle="modal" data-target ="#checkForm">
                    <td>TC19000027</td>
                    <td >5/02/2019</td>
                    <td><button type="button" class="btn btn-danger">Cancel</button></td>
                </tr>
                <tr class = "member" data-toggle="modal" data-target ="#checkForm">
                    <td>TC19000024</td>
                    <td>1/02/2019</td>
                    <td><button type="button" class="btn btn-danger">Cancel</button></td>
                </tr>
                <tr class = "member" data-toggle="modal" data-target ="#checkForm">
                    <td>TC19000019</td>
                    <td>2/02/2019</td>
                    <td><button type="button" class="btn btn-danger">Cancel</button></td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="container-fluid mx-auto" id="con3">
            <div class="accepted">
                <h2><b>Accepted Requests</b></h2><br>
                <table class="table table-striped">
                <thead>
                    <tr>
                    <th>Transaction Code</th>
                    <th>Date Submitted</th>
                    <th>Date Approved</th>
                    <th>Cancel Request</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class = "member" data-toggle="modal" data-target ="#checkForm">
                    <td>TC19000010</td>
                    <td>02/02/2019</td>
                    <td>04/02/2019</td>
                    <td><button type="button" class="btn btn-danger">Cancel</button></td>
                    </tr>
                    <tr class = "member" data-toggle="modal" data-target ="#checkForm">
                    <td>TC19000002</td>
                    <td>31/01/2019</td>
                    <td>02/02/2019</td>
                    <td><button type="button" class="btn btn-danger">Cancel</button></td>
                    </tr>
                    <tr class = "member" data-toggle="modal" data-target ="#checkForm">
                    <td>TC19000001</td>
                    <td>31/01/2019</td>
                    <td>01/02/2019</td>
                    <td><button type="button" class="btn btn-danger">Cancel</button></td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
    @include('inc.checkFormModal')
@endsection

<!-- <a class="" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>-->