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

        <table class="table text-center" id="dataTables">
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
            @foreach ($users as $user)
              @if($user->penalty>0)
                @foreach($transaction_forms as $form)
                  @if($form->user_id==$user->user_id)
                    @if($form->claiming==true && $form->returned==false && $form->due_date)
                      <tr>
                        <td class="align-middle">{{$user->user_id}}</td>
                        <td class="align-middle" id="student" data-toggle="modal" data-target = "#viewStudent{{$user->user_id}}">{{$user->first_name}} {{$user->last_name}}</td>
                        <td class="align-middle" id="transaction" data-toggle="modal" data-target = "#checkForm{{$form->transaction_id}}">{{$form->transaction_id}}</td>
                          @foreach($equipments as $equipment)
                            @if($form->transaction==$equipment->transaction_id)
                              <td class="align-middle">{{$equipment->equip_name}}</td>
                              <td class="align-middle">{{$equipment->equipID}}</td>
                            @endif
                          @endforeach
                          <td>2</td>
                          @if($form->user_id==$user->user_id)
                            <td class="align-middle">P{{$user->penalty}}.00</td>
                          @endif
                        <td><button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#confirm">Paid</button></td>
                      </tr>
                    @endif
                  @endif
                @endforeach
              @endif
            @endforeach
          </tbody>
        </table>
    </div>
@endsection

@section('modal')
  @include('inc.checkFormModal')
  @include('inc.viewStudentModal')
@endsection