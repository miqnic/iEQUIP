@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | Balances</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}">
@endsection

@section('navi')
    @include('inc.naviAdmin')
@endsection

@section('content')
    <div class="header">
        <h2 class="border-bottom pb-2 pl-3">Balances</h2>
        <p class="lead pl-3">Reservation and student details can be seen by clicking on the corresponding name and transaction ID.</p>
        <button type="button" name="addequip" class="btn float-right mr-3 mb-2" data-toggle="modal" data-target="#email"><img id="plus" src="images/envelope.png" height=30;>Email All</button>
    </div>
    
    <div class="container-fluid">
      <div class="modal fade" id="confirm" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title">Change Confirmation</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
              Are you sure about these changes?
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-success" data-dismiss="modal">Confirm</button>
              <button type="button" class="btn btn" data-dismiss="modal">Cancel</button>
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

              <table class = "table table-bordered text-center">
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
      </div>

      <div class="modal fade" id="viewStudent" tabindex="-1">
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

        <div class="modal fade" id="email" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
  
              <div class="modal-header">
                <h4 class="modal-title">Email Confirmation</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
  
              <div class="modal-body">
                This will send an email notification to all students with penalties.
              </div>
  
              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Confirm</button>
                <button type="button" class="btn btn" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>

        <table class="table table-bordered table-responsive-md text-center">
          <thead>
            <tr>
              <th>Student ID</th>
              <th>Student Name</th>
              <th>Transaction ID</th>
              <th>Equipment Borrowed</th>
              <th>Equipment ID</th>
              <th>Quantity</th>
              <th>Penalty Fee</th>
              <th>Paid</th>
            </tr>
          </thead>
          <tbody>
            <tr class="member">
              <td class = "align-middle">201709876</td>
              <td class = "align-middle" id="student" data-toggle="modal" data-target = "#viewStudent">Zildjian Adrian D. Dayo</td>
              <td class = "align-middle" id="transaction" data-toggle="modal" data-target = "#checkForm">TC19000018</td>
              <td class = "align-middle">Spalding NBA Official Game Ball Basketball</td>
              <td class = "align-middle">SPANBA0001</td>
              <td class = "align-middle">2</td>
              <td class = "align-middle">P500</td>
              <td><button class="btn btn-outline-secondary my-2 my-sm-0" data-toggle="modal" data-target="#confirm">Paid</button></td>
            </tr>
            <tr class="member">
              <td class = "align-middle">201754321</td>
              <td class = "align-middle" id="student" data-toggle="modal" data-target = "#viewStudent">Joshua Miguel B. De Veyra</td>
              <td class = "align-middle" id="transaction" data-toggle="modal" data-target = "#checkForm">TC19000019</td>
              <td class = "align-middle">Microsoft New Surface Pro 2017 Laptop</td>
              <td class = "align-middle">MICSUR0001</td>
              <td class = "align-middle">1</td>
              <td class = "align-middle">P500</td>
              <td><button class="btn btn-outline-secondary my-2 my-sm-0" data-toggle="modal" data-target="#confirm">Paid</button></td>
            </tr>
          </tbody>
        </table>
    </div>
@endsection

@section('modal')
    @include('inc.checkFormModal')
    @include('inc.viewStudentModal')
@endsection