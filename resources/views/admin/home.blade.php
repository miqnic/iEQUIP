@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | Home</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}">


    <script>
        $(document).ready( function () {
            $('#dataTables').DataTable( {
                dom: 'Bfrtip',
                lengthMenu: [
                    [ 10, 25, 50, -1 ],
                    [ '10 rows', '25 rows', '50 rows', 'Show all' ]
                ],
                buttons: [
                    'pageLength',
                    {
                    extend: 'pdfHtml5',
                    text: 'Export All as PDF',
                    exportOptions: {
                        modifier: {
                            selected: null
                        },
                        columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                    },
                    download: 'open'
                    },
                    {
                    extend: 'pdfHtml5',
                    text: 'Export Selected Row/s as PDF',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                    },
                    download: 'open'
                    }
                ],
                select: true
            });
    
            $('#activeForms').DataTable( {
                "ordering": false,
                "lengthChange": false
            });
        });
    </script>
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
                            <td class="align-middle">{{\Carbon\Carbon::parse($form->due_date)->toFormattedDateString()}}</td>
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
                                        {{ Form::submit('Decline', array('class' => 'btn btn-outline-danger','name'=>'decision', 'value'=>'decline')) }}
                                        {{ Form::submit('Approve', array('class' => 'btn btn-outline-success','name'=>'decision', 'value'=>'approve')) }}
                                    {!! Form::close() !!}
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach

                
            @endif
        </tbody>
    </table>
</div>
@endsection

@section('modal')
@if (!$transaction_forms->isEmpty())
@include('inc.checkFormModal')
@include('inc.viewStudentModal')
@include('inc.returnEquipModal')
@endif
@endsection
