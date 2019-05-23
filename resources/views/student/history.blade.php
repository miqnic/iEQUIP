@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | History</title>
    <link rel="stylesheet"  type="text/css" href="{{ asset('css/equiplist.css') }}">

    <script>
      $(document).ready( function () {
        $('#dataTables').DataTable( {
          dom: "Bfrtip",
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
    @include('inc.naviStudent', [$totalEquip, $lastTransaction, $countCart])
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12 pt-3">
    <h4 class="pb-4">Transaction History</h4>
    <table class="table table-striped table-bordered table-hover text-center" id="dataTables">
      <thead>
        <tr>
          <th>Transaction Number</th>
          <th>Date Submitted</th>
          <th>Start Date and Time</th>
          <th>Due Date and Time</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody class="text-center">
          @foreach ($transaction_forms as $form)
          <tr @if($form->returned==0 && $form->approval==1)class="text-danger" @endif  data-toggle="modal" data-target="#checkForm{{$form->transaction_id}}" id="transaction">
              <td>{{$form->transaction_id}}</td>
              <td>{{\Carbon\Carbon::parse($form->created_at)->format('F d, Y h:i A')}}</td>
              <td>{{\Carbon\Carbon::parse($form->start_date)->toFormattedDateString()}} {{\Carbon\Carbon::parse($form->start_time)->format('h:i A')}}</td>
              <td>{{\Carbon\Carbon::parse($form->due_date)->toFormattedDateString()}} {{\Carbon\Carbon::parse($form->end_time)->format('h:i A')}}</td>
              <td>
                @if($form->approval==1)
                  <span class="badge badge-success">Approved</span>
                  @if($form->claimed==1 and $form->returned==0)
                    <span class="badge badge-primary">Claimed</span>
                  @elseif($form->claimed==1 and $form->returned==1)
                    <span class="badge badge-success">Returned</span>
                  @else
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
    <span><b>Legend:</b> <i class="fas fa-square-full text-danger"></i> - overdue/not yet returned</span>
  </div>
</div>
@endsection

@section('modal')
    @include('inc.checkFormModal')
@endsection