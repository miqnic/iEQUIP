@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | Feedbacks</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin-feedback.css') }}">
@endsection

@section('navi')
    @include('inc.naviAdmin')
@endsection

@section('content')
<div class="row">
    <div class="col-md-3" id="sort">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inlineFormCustomSelect">Sort by: </span>
            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                <option selected>Choose...</option>
                <option value="1">Oldest</option>
                <option value="1">Newest</option>
                <option value="1">Type of feedback</option>
            </select>
        </div>
    </div>

    <div class="feedback">
        <div class="media">
            <div class="media-body">
                <h2>ID#: 201701039</h2>
                <div class="row">
                <div class="col-md-6"><h6><strong>Student Name:</strong> Nicole Kaye R. Bilon</h6></div>
                <div class="col-md-6 "><h6><strong>Year and Course: </strong>2nd Year - BSCS SE</h6></div>
                <div class="col-md-6  "><h6><strong>Type of feedback: </strong>Complaint </h6></div>
                <div class="col-md-6  "><h6><strong>Date Sent: </strong>02/02/19</h6></div><br><br>
                <div class="col-md-12  "><h6><strong>Message: </strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, 
                    sunt in culpa qui officia deserunt mollit anim id est laborum.</h6></div>
                <div class="col-md-12 text-right pb-2" data-toggle="modal" data-target="#confirm"><button class = "btn btn-dark mr-5 mt-2">Mark as read</button></div>
                </div>
            </div>
        </div>

        
    </div>
</div>
@endsection

@section('modal')
    @include('inc.checkFormModal')
    @include('inc.viewStudentModal')
@endsection
