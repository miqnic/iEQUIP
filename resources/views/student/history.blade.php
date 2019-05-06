@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | History</title>
    <link rel="stylesheet"  type="text/css" href="{{ asset('css/history.css') }}">
@endsection

@section('navi')
    @include('inc.naviStudent')
@endsection

@section('content')
  <div class="header">
    <h2 class="border-bottom pb-2 pl-3">Request History</h2>
    <p class="lead pl-3">Reservation and student details can be seen by clicking on the corresponding IDs. Use the search bar and sort buttons to filter data.</p>
  </div>

  <div class="container-fluid">
    <p class="pl-3 pt-4" style="color: red;">* Equipment/s not returned</p><br>
    <table class="table table-striped table-bordered table-hover text-center" id="dataTables">
      <thead>
        <tr>
          <th>Transaction Number</th>
          <th>Date Submitted</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody class="text-center">
          @foreach ($transaction_forms as $form)
          <tr @if($form->returned==0 && $form->approval==1)class="text-danger" @endif  data-toggle="modal" data-target="#checkForm{{$form->transaction_id}}" id="transaction">
              <td>{{$form->transaction_id}}</td>
              <td>{{\Carbon\Carbon::parse($form->created_at)->toFormattedDateString()}}</td>
              <td>
                @if($form->approval==1)
                  APPROVED
                @elseif($form->approval==-1)
                  PENDING
                @else
                  DECLINED
                @endif
            </td>
          </tr>
          @endforeach
        </tbody>
    </table>
  </div>
@endsection

@section('modal')
    @include('inc.checkFormModal')
@endsection