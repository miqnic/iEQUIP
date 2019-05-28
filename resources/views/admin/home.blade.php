@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | Home</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/equiplist.css') }}">

    <style>
        form {
            display: inline;
        }

        .count-container {
            height: 160px;
            color: white;
            padding-top: 20px;
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            border-radius: 10px;
        }

        .count-container p {
            font-size: 60px;
        }

        .count-container h6 {
            margin-top: -30px;
        }

        table a:hover {
            color: royalblue;
        }
    </style>

    <script>
        $(document).ready( function () {
            $('#activeForms').DataTable({
                order: [[0, "desc"]],
                columnDefs: [
                    {
                        orderable: false,
                        targets: 6
                    }
                ]
            });
        });

        $(function () {
            $('#declineBtn').popover({
                title: 'Reason for Declining',
                html: true,
                content:  $('#declineReasonForm').html()
            })
        });
    </script>
@endsection

@section('navi')
    @include('inc.naviAdmin')
@endsection

@section('content')
<div class="row py-4">
    <div class="col-md-3">
        {{--borrowed and available equip pie--}}
        <div class="count-container" style="background-image: linear-gradient(to bottom right, rgb(154,208,245), rgb(54, 162, 235))">
            <p>{{$borrowedEquip}}</p>
            <h6 data-toggle="dropdown"><a class="dropdown-toggle">Items Currently Reserved</a></h6>
            <div class="dropdown-menu px-2 py-2" style="min-width: 40vw; max-height: 400px; overflow: scroll;">
                <table class="table table-sm">
                    <thead class="bg-dark text-light text-center">
                        <th>Transaction ID</th>
                        <th>Item Code</th>
                        <th>Item Name</th>
                        <th>Status</th>
                    </thead>
                    <tbody class="text-center">
                    @foreach($borrowedList as $item) 
                        @php
                            $spaces = '/\s+/';
                            $replace = '-';
                            $string= $item->equip_name;
                            $trimmedString = preg_replace($spaces, $replace, $string);
                        @endphp
                        <tr>
                            <td>{{$item->transaction_id}}</td>
                            <td>{{$item->equipID}}</td>
                            <td>
                                <a href="{{ url('admin/'.$trimmedString) }}">{{$item->equip_name}}</a>
                                @foreach($transaction_forms as $form)
                                @if($form->transaction_id==$item->transaction_id)
                                    @if($form->approval==1 && $form->claimed==1 && $form->returned==0 && \Carbon\Carbon::parse($form->due_date)->isPast())
                                        <i class="fas fa-lg fa-exclamation-triangle text-danger"></i>
                                    @endif
                                @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach($transaction_forms as $form)
                                @if($form->transaction_id==$item->transaction_id)
                                    @if($form->claimed==1)
                                    <span class="badge badge-primary">Claimed</span>
                                    @else 
                                    <span class="badge badge-danger">Unclaimed</span>
                                    @endif
                                @endif
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="count-container" style="background-image: linear-gradient(to bottom right, rgb(255,230,127), rgb(255, 206, 0))">
            <p>{{$availableEquip}}</p>
            <h6>Items Available</h6>
        </div>
    </div>
    <div class="col-md-3">
        <div class="count-container" style="background-image: linear-gradient(to bottom right, rgb(255,127,145), rgb(255, 0, 35))">
            <p>{{$defectiveEquip}}</p>
            <h6 data-toggle="dropdown"><a class="dropdown-toggle">Items with Defect</a></h6>
            <div class="dropdown-menu px-2 py-2" style="min-width: 40vw; max-height: 400px; overflow: scroll;">
                <table class="table table-sm">
                    <thead class="bg-dark text-light text-center">
                        <th>Item Code</th>
                        <th>Item Name</th>
                    </thead>
                    <tbody class="text-center">
                    @foreach($defectiveList as $item)
                    @php
                        $spaces = '/\s+/';
                        $replace = '-';
                        $string= $item->equip_name;
                        $trimmedString = preg_replace($spaces, $replace, $string);
                    @endphp
                    <tr>
                        <td>{{$item->equipID}}</td>
                        <td><a href="{{ url('admin/'.$trimmedString) }}">{{$item->equip_name}}</a></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="count-container" style="background-image: linear-gradient(to bottom right, rgb(135,153,214), rgb(15, 52, 173)">
            <p>{{$dueTransactions}}</p>
            <h6>Items Due Today</h6>
        </div>
    </div>
</div>
<hr style="height: 3px" class="bg-light">
<div class="row">
    <div class="col-md-12">
        <h3 class="pt-1">Active Requests</h3>
        <div class="table-responsive">
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
                    @if($transaction_forms->isEmpty())
                        <tr>
                            <td colspan="7">No active/pending requests</td>
                        </tr>
                    @else
                        @foreach($transaction_forms as $form)
                            @if ($form->returned != 1 || $form->approval != -1 || $form->approval != -2)
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
                                <td class="align-middle">
                                    {{\Carbon\Carbon::parse($form->due_date)->toFormattedDateString()}}
                                    @if($form->approval==1 && $form->claimed==1 && $form->returned==0 && \Carbon\Carbon::parse($form->due_date)->isPast())
                                        <i class="fas fa-lg fa-exclamation-triangle text-danger"></i>
                                    @endif
                                </td>
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
                                        @if ($form->claimed == 1)
                                            <button class="btn btn-outline-primary" disabled>Claimed</button>
                                            <button data-toggle="modal" data-target="#returnEquip-{{$form->transaction_id}}" class="btn btn-outline-primary">Returned</button>
                                        @else
                                            {!! Form::open(['action' => 'TransactionFormsController@afterApproval', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                                                {{Form::hidden('currentForm', $form->transaction_id)}}
                                                {{Form::hidden('sub_date', $form->submitted_date)}}
                                                {{Form::hidden('start_date', $form->start_date)}}
                                                {{Form::hidden('start_time', $form->start_time)}}
                                                {{Form::hidden('end_date', $form->due_date)}}
                                                {{Form::hidden('end_time', $form->end_time)}}
                                                {{Form::hidden('room', $form->room_number)}}
                                                {{Form::hidden('reason', $form->purpose)}}
                                                {{Form::hidden('user_id', $form->user_id)}}
                                                @foreach ($users as $user)
                                                    @if ($user->user_id == $form->user_id)
                                                        {{Form::hidden('first', $user->first_name)}}
                                                        {{Form::hidden('last', $user->last_name)}}
                                                        {{Form::hidden('course', $user->course)}}
                                                    @endif
                                                @endforeach
                                                {{ Form::submit('Claimed', array('class' => 'btn btn-outline-primary','name'=>'claimed')) }}
                                            {!! Form::close() !!}
                                            <button data-toggle="modal" data-target="#returnEquip-{{$form->transaction_id}}" class="btn btn-outline-primary" disabled>Returned</button>
                                        @endif
                                            
                                    @else 
                                        {!! Form::open(['action' => 'TransactionFormsController@transactionApproval', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                                            {{Form::hidden('currentForm', $form->transaction_id)}}
                                            {{Form::hidden('sub_date', $form->submitted_date)}}
                                            {{Form::hidden('start_date', $form->start_date)}}
                                            {{Form::hidden('start_time', $form->start_time)}}
                                            {{Form::hidden('end_date', $form->due_date)}}
                                            {{Form::hidden('end_time', $form->end_time)}}
                                            {{Form::hidden('room', $form->room_number)}}
                                            {{Form::hidden('reason', $form->purpose)}}
                                            {{Form::hidden('user_id', $form->user_id)}}
                                            @foreach ($users as $user)
                                                @if ($user->user_id == $form->user_id)
                                                    {{Form::hidden('first', $user->first_name)}}
                                                    {{Form::hidden('last', $user->last_name)}}
                                                    {{Form::hidden('course', $user->course)}}
                                                @endif
                                            @endforeach
                                            {{-- {{Form::button('Decline', array('class' => 'btn btn-outline-danger','name'=>'decision', 'value'=>'decline')) }} --}}
                                            {{ Form::submit('Approve', array('class' => 'btn btn-outline-success d-inline-block','name'=>'decision', 'value'=>'approve')) }}
                                        {!! Form::close() !!}
                                        <button type="button" id="declineBtn" class="btn btn-outline-danger d-inline" data-container="body" data-toggle="popover" data-placement="bottom">Decline</button>
                                        <div id="declineReasonForm" style="display: none">
                                        <form action="{{ action('TransactionFormsController@transactionApproval') }}" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="decision" value="decline">
                                            <textarea type="text" name="declineReason" class="form-control" id="declineReason" placeholder="Enter reason" rows="2"></textarea>
                                            <button type="submit" class="btn btn-sm btn-danger float-right my-2">Decline</button>
                                        </form>
                                        </div>
                                    @endif
                                </td>
                            @endif
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <span><b>Legend:</b> <i class="fas fa-exclamation-triangle text-danger"></i> - due date has passed</span>
    </div>
</div>
@endsection

@section('modal')
@if (!$transaction_forms->isEmpty())
@include('inc.checkFormModal')
@include('inc.viewStudentModal')
@include('inc.returnEquipModal')
@endif
@endsection
