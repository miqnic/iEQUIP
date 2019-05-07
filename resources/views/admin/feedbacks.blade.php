@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | Feedbacks</title>
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/admin-feedback.css') }}"> --}}
@endsection

@section('navi')
    @include('inc.naviAdmin')
@endsection

@section('content')
    <h2 class="border-bottom pb-2 pl-3">Feedbacks</h2>
    <p class="lead pl-3">Unread messages sent by the faculty and students can be seen by clicking on each tab below.</p> 
    <div class="w-25 ml-4 mt-4">
      <div class="btn-group dropright">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Sort by
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#">Newest</a>
          <a class="dropdown-item" href="#">Oldest</a>
          <a class="dropdown-item" href="#">Type of Feedback</a>
        </div>
      </div>
    </div>
    {{--<div class="feedback">
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
    </div> --}}

    <div class="mx-4 mt-4">
      <div class="accordion" id="feedback">
        <div class="card">
          <div class="card-header" id="feedbackPost1" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <h5 class="pt-2 pb-3 text-primary">
              <span class="float-left"><b>02/02/19</b> | Student ID: 201702012 | Subject: Item Defect</span>
              <span class="float-right"><i class="fas fa-chevron-down fa-xs"></i></span>
            </h5>
          </div>
      
          <div id="collapseOne" class="collapse" aria-labelledby="feedbackPost1" data-parent="#feedback">
            <div class="card-body mx-4">
              <p>
                  <button class="btn btn-primary float-right">Mark as Read</button>
                  <b>Student Name:</b> Nicole Kaye Bilon<br>
                  <b>Course:</b> BSCS-SE<br>
                  <b>Type of Feedback:</b> Complaint
              </p>
              <p>
                  <b>Message:</b><br>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                  sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
                  quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                  Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, 
                  sunt in culpa qui officia deserunt mollit anim id est laborum.
              </p>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="feedbackPost2" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              <h5 class="pt-2 pb-3 text-primary">
                  <span class="float-left"><b>02/02/19</b> | Student ID: 201702012 | Subject: Item Defect</span>
                  <span class="float-right"><i class="fas fa-chevron-down fa-xs"></i></span>
              </h5>
          </div>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#feedback">
            <div class="card-body mx-4">
              <p>
                  <button class="btn btn-primary float-right">Mark as Read</button>
                  <b>Student Name:</b> Nicole Kaye Bilon<br>
                  <b>Course:</b> BSCS-SE<br>
                  <b>Type of Feedback:</b> Complaint
              </p>

              <p>
                  <b>Message:</b><br>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                  sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
                  quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                  Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, 
                  sunt in culpa qui officia deserunt mollit anim id est laborum.
              </p>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="feedbackPost3" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            <h5 class="pt-2 pb-3 text-primary">
                <span class="float-left"><b>02/02/19</b> | Student ID: 201702012 | Subject: Item Defect</span>
                <span class="float-right"><i class="fas fa-chevron-down fa-xs"></i></span>
            </h5>
          </div>
          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#feedback">
            <div class="card-body mx-4">
                <p>
                    <button class="btn btn-primary float-right">Mark as Read</button>
                    <b>Student Name:</b> Nicole Kaye Bilon<br>
                    <b>Course:</b> BSCS-SE<br>
                    <b>Type of Feedback:</b> Complaint
                </p>

                <p>
                    <b>Message:</b><br>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, 
                    sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="feedbackPost4" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
            <h5 class="pt-2 pb-3 text-primary">
              <span class="float-left"><b>02/02/19</b> | Student ID: 201702012 | Subject: Item Defect</span>
              <span class="float-right"><i class="fas fa-chevron-down fa-xs"></i></span>
            </h5>
          </div>
          <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#feedback">
            <div class="card-body mx-4">
                <p>
                    <button class="btn btn-primary float-right">Mark as Read</button>
                    <b>Student Name:</b> Nicole Kaye Bilon<br>
                    <b>Course:</b> BSCS-SE<br>
                    <b>Type of Feedback:</b> Complaint
                </p>

                <p>
                    <b>Message:</b><br>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, 
                    sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('modal')
{{--     @include('inc.checkFormModal')
    @include('inc.viewStudentModal') --}}
@endsection
