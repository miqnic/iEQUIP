@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | Home</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}">
@endsection

@section('navi')
    @include('inc.naviAdmin')
@endsection

@section('content')
<div class="header">
    <h2 class="border-bottom pb-2 pl-3">Current Transactions</h2>
    <p class="lead pl-3">Statuses of approved and pending transactions can be updated here.</p>
</div>

<div class="container-fluid">
    <table class="table table-striped table-hover text-center" id="activeForms">
        <thead>
        <tr>
            <th>Transaction Number</th>
            <th>Student ID</th>
            <th>Equipment ID</th>
            <th>Equipment Name</th>
            <th>Due Date</th>
            <th>Status</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            @if($equipments->isEmpty())
                <tr>
                    <td colspan="5">No active/pending requests</td>
                </tr>
            @else
            @foreach($transaction_forms as $form)
                <tr>
                    <td class="align-middle" id="transaction" data-toggle="modal" data-target = "#checkForm{{$form->transaction_id}}">{{$form->transaction_id}}</td>
                    <td class="align-middle" id="student" data-toggle="modal" data-target = "#viewStudent{{$form->user_id}}">{{$form->user_id}}</td>
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
                    <td class="align-middle">{{$form->due_date}}</td>
                    <td class="align-middle">
                        <h5>
                        @if($form->approval==1)
                        <span class="badge badge-success">Approved</span>
                        @else
                        <span class="badge badge-warning">Pending</span>
                        @endif
                        </h5>
                    </td>
                    <td class="align-middle">
                        @if($form->approval==1)
                            <button type="button" class="btn btn-outline-primary" @if($form->claimed==1) disabled @endif>Claimed</button>
                            <button type="button" class="btn btn-outline-primary" @if($form->claimed==0 || $form->returned==1) disabled @endif>Returned</button>
                        @else 
                            <button type="button" class="btn btn-outline-danger">Decline</button>
                            <button type="button" class="btn btn-outline-success">Approve</button>
                        @endif
                    </td>
                </tr>
          @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection

@section('modal')
    @include('inc.checkFormModal')
    @include('inc.viewStudentModal')
@endsection
