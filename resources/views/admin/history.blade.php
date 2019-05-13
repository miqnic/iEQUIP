@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | Request History</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/history.css') }}">
@endsection

@section('navi')
    @include('inc.naviAdmin')
@endsection

@section('content')
    <div class="header">
        <h2 class="border-bottom pb-2 pl-3">Request History</h2>
        <p class="lead pl-3">Reservation and student details can be seen by clicking on the corresponding IDs. Use the search bar and sort buttons to filter data.</p>
        <button type="button" name="deleteHistory" class="btn btn-default float-right mr-3 mb-2" data-toggle="modal" data-target="#delete"><img id="minus" src="images/minus.png" height=18;>Delete All</button>
    </div>
  
    <div class="container-fluid">
        <table class="table text-center" id="requestHistory">
          <thead>
            <tr>
              <th>Transaction ID</th>
              <th>Student ID</th>
              <th>Student Name</th>
              <th>Submitted Date</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Returned Equipment</th>
            </tr>
          </thead>
          <tbody class="text-center">
            @foreach ($transaction_forms as $form)
            <tr>
                <td data-toggle="modal" data-target="#checkForm{{$form->transaction_id}}" id="transaction">{{$form->transaction_id}}</td>
                <td>{{$form->user_id}}</td>
                <td data-toggle="modal" data-target="#viewStudent{{$form->user->user_id}}" id="student">{{$form->user->first_name}} {{$form->user->last_name}}</td>
                <td>{{\Carbon\Carbon::parse($form->created_at)->toFormattedDateString()}}</td>
                <td>{{\Carbon\Carbon::parse($form->start_date)->toFormattedDateString()}}</td>
                <td>{{\Carbon\Carbon::parse($form->due_date)->toFormattedDateString()}}</td>
                <td>
                    @if($form->equipment[0]->returned==1)
                    Yes
                    @else 
                    No
                    @endif
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>

        <div class="modal fade" id="delete" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                    <h4 class="modal-title">Deletion Confirmation</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body m-3">
                    Are you sure you want to delete the history? This will not delete records from the database.
                    </div>

                    <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" data-dismiss="modal">Delete</button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <!--<div class="modal fade" id="viewStudent" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Student Details</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <img src = "images/user-account-box.jpg" height= 100;>
                        </div>
                        <div class="col-md-9">
                            <p><strong>Student ID: </strong>201712345</p>
                            <p><strong>Student Name: </strong>Rhej Christian J. Laurel</p>
                            <p><strong>Course: </strong>BS-CS-SE</p>
                            <p><strong>Penalty: </strong>P500</p>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="checkForm" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title">Transaction Form Details</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="row pb-3">
                            <div class="col-md-7">
                            <p><strong>Transaction Form:</strong><br>TC19000018</p>
                            <p><strong>Student ID:</strong><br>201712345</p>
                            <p><strong>Student Name:</strong><br>Rhej Christian J. Laurel</p>
                            <p><strong>Reason:</strong><br>Class-related activity</p>

                            </div>
                            <div class="col-md-5">
                            <p><strong>Start Date:</strong><br>01/22/2019</p>
                            <p><strong>End Date:</strong><br>02/22/2019</p>
                            <p><strong>Start Time:</strong><br>07:30AM</p>
                            <p><strong>End Time:</strong><br>11:00AM</p>
                            </div>
                        </div>

                        <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                            <th>Equipment Code</th>
                            <th>Equipment Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td>CANCAM0001</td>
                            <td>Canon EOS 80D</td>
                            </tr>
                        </tbody>
                        </table>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>-->
    </div>

    <script>
            $(document).ready( function (){
                $('#requestHistory').DataTable();
            });
        </script>
@endsection

@section('modal')
    @include('inc.checkFormModal')
    @include('inc.viewStudentModal')
@endsection