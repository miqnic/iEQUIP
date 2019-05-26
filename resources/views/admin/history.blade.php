@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | Request History</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/equiplist.css') }}">

    <script>
        $(document).ready( function () {
            $('#dataTables').DataTable( {
            dom: 'Bfrtip',
            order: [[0, "desc"]],
            lengthMenu: [
                [ 10, 25, 50, -1 ],
                [ '10 rows', '25 rows', '50 rows', 'Show all' ]
            ],
            buttons: [
                'pageLength',
                {
                extend: 'pdfHtml5',
                text: 'Export as PDF',
                exportOptions: {
                    modifier: {
                        selected: null
                    }
                },
                download: 'open'
                }
            ]
            });
        });
    </script>
@endsection

@section('navi')
    @include('inc.naviAdmin')
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 pt-3">
        <h3>Request History</h3>
        <button type="button" name="deleteHistory" class="btn btn-light float-right" data-toggle="modal" data-target="#delete"><i class="fas fa-lg fa-minus-circle text-danger"></i> Delete All</button>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped table-bordered table-hover text-center" id="dataTables">
          <thead>
            <tr>
              <th>Transaction ID</th>
              <th>Student ID</th>
              <th>Student Name</th>
              <th>Date Submitted</th>
              <th>Date Responded</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody class="text-center">
            @foreach ($transaction_forms as $form)
            <tr>
                <td data-toggle="modal" data-target="#checkForm{{$form->transaction_id}}" id="transaction">
                    {{$form->transaction_id}}
                    @if($form->returned==0 && \Carbon\Carbon::parse($form->due_date)->isPast())
                        <i class="fas fa-lg fa-exclamation-triangle text-danger"></i>
                    @endif
                </td>
                @foreach($users as $user)
                    @if($user->user_id==$form->user_id)
                        <td data-toggle="modal" data-target="#viewStudent{{$user->user_id}}" id="student">{{$user->user_id}}</td>
                        <td data-toggle="modal" data-target="#viewStudent{{$user->user_id}}" id="student">{{$user->first_name}} {{$user->last_name}}</td>
                    @endif
                @endforeach
                <td>{{\Carbon\Carbon::parse($form->submitted_date)->toFormattedDateString()}}</td>
                <td>{{\Carbon\Carbon::parse($form->updated_at)->toFormattedDateString()}}</td>
                <td>
                @if($form->approval==1)
                    @if($form->claimed==1 and $form->returned==0)
                        <span class="badge badge-success">Approved</span>
                        <span class="badge badge-primary">Claimed</span>
                    @elseif($form->claimed==1 and $form->returned==1)
                        <span class="badge badge-success">Returned</span>
                    @else
                        <span class="badge badge-success">Approved</span>
                        <span class="badge badge-warning">Unclaimed</span>
                    @endif
                @elseif($form->approval==0)
                    <span class="badge badge-warning">Pending</span>
                @elseif($form->approval==-1)
                    <span class="badge badge-danger">Declined</span>
                @else 
                    <span class="badge badge-danger">Cancelled</span>
                @endif
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <span><b>Legend:</b> <i class="fas fa-exclamation-triangle text-danger"></i> - due date has passed</span>
    </div>
</div>

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
@endsection

@section('modal')
    @include('inc.checkFormModal')
    @include('inc.viewStudentModal')
@endsection