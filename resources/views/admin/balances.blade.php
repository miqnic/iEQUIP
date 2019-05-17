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
        <button type="button" name="addequip" class="btn btn-light float-right mr-3" data-toggle="modal" data-target="#email"><img id="plus" src="{{ asset('img/envelope.png') }}" height=30;>Email All</button>
    </div>
    
    <div class="container-fluid">
      
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
                  {!! Form::open(['action' => 'FeedbacksController@emailAll', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                  {{Form::hidden('users', $users)}}
                  {{Form::submit('Confirm', ['class' => 'btn btn-success'])}}
                  {!! Form::close() !!}
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
              <th>Equipment ID</th>
              <th>Equipment Borrowed</th>
              <th>Quantity</th>
              <th>Penalty Fee</th>
              <th>Paid</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
                @foreach($transaction_forms as $form)
                  @if($form->user_id==$user->user_id)
                    {{-- @if($form->claiming==true && $form->returned==false && \Carbon\Carbon::parse($form->due_date)->diffInDays(Carbon::now()->toDateString())>=1) --}}
                      <tr>
                      @if($user->user_id==$form->user_id)
                          <td class="align-middle" data-toggle="modal" data-target="#viewStudent{{$user->user_id}}" id="student">{{$user->user_id}}</td>
                          <td class="align-middle" data-toggle="modal" data-target="#viewStudent{{$user->user_id}}" id="student">{{$user->first_name}} {{$user->last_name}}</td>
                      @endif
                        <td class="align-middle" id="transaction" data-toggle="modal" data-target = "#checkForm{{$form->transaction_id}}">{{$form->transaction_id}}</td>
                        <td class="align-middle">
                            @foreach($equipments as $equipment)
                              @if($form->transaction_id==$equipment->transaction_id)
                                {{$equipment->equipID}}<br>
                              @endif
                            @endforeach
                        </td>
                        <td class="align-middle">
                            @foreach($equipments as $equipment)
                            @if($form->transaction_id==$equipment->transaction_id)
                              {{$equipment->equip_name}}<br>
                            @endif
                            @endforeach
                        </td>
                          <td class="align-middle">2</td>
                          @if($form->user_id==$user->user_id)
                            <td class="align-middle">P{{$user->penalty}}.00</td>
                          @endif
                        <td class="align-middle"><button class="btn btn-outline-primary" data-toggle="modal" data-target="#confirm">Paid</button></td>
                      </tr>
                    {{-- @endif --}}
                  @endif
                @endforeach
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
                            {!! Form::open(['action' => 'TransactionFormsController@paidPenalty', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                            {{Form::hidden('user', $user->user_id)}}
                            {{Form::hidden('form', $form->transacton_id)}}
                            {{Form::submit('Confirm', ['class' => 'btn btn-success'])}}
                            {!! Form::close() !!}
                          <button type="button" class="btn btn" data-dismiss="modal">Cancel</button>
                        </div>
            
                      </div>
                    </div>
                  </div>
            @endforeach
          </tbody>
        </table>
    </div>
@endsection

@section('modal')
  @include('inc.checkFormModal')
  @include('inc.viewStudentModal')
@endsection