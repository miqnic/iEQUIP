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
        <button type="button" name="deleteHistory" class="btn btn-light float-right mr-3 mb-2" data-toggle="modal" data-target="#delete"><img id="minus" src="{{ asset('img/minus.png') }}" height=18;>Delete All</button>
    </div>
  
    <div class="container-fluid">
        <p class="pl-3 pt-4 text-danger">* Equipment/s not returned</p>
        <table class="table table-striped table-bordered table-hover text-center" id="dataTables">
          <thead>
            <tr>
              <th>Transaction ID</th>
              <th>Student ID</th>
              <th>Student Name</th>
              <th>Submitted Date</th>
              <th>Start Date</th>
              <th>End Date</th>
            </tr>
          </thead>
          <tbody class="text-center">
            @foreach ($transaction_forms as $form)
            <tr @if($form->returned==0 && $form->approval==1)class="text-danger"; @endif>
                <td data-toggle="modal" data-target="#checkForm{{$form->transaction_id}}" id="transaction">{{$form->transaction_id}}</td>
                @foreach($users as $user)
                    @if($user->user_id==$form->user_id)
                        <td data-toggle="modal" data-target="#viewStudent{{$user->user_id}}" id="student">{{$user->user_id}}</td>
                        <td data-toggle="modal" data-target="#viewStudent{{$user->user_id}}" id="student">{{$user->first_name}} {{$user->last_name}}</td>
                    @endif
                @endforeach
                <td>{{\Carbon\Carbon::parse($form->created_at)->toFormattedDateString()}}</td>
                <td>{{\Carbon\Carbon::parse($form->start_date)->toFormattedDateString()}}</td>
                <td>{{\Carbon\Carbon::parse($form->due_date)->toFormattedDateString()}}</td>
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
    </div>
@endsection

@section('modal')
    @include('inc.checkFormModal')
    @include('inc.viewStudentModal')
@endsection