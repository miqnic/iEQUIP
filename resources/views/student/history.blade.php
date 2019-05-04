@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | History</title>
    <link rel="stylesheet" href="{{ asset('css/history.css') }}" type=text/css>
@endsection

@section('navi')
    @include('inc.naviStudent')
@endsection

@section('content')
<div class="header">
    <h2 class="border-bottom pb-2 pl-3">Request History</h2>
    <p class="lead pl-3">Reservation and student details can be seen by clicking on the corresponding IDs. Use the search bar and sort buttons to filter data.</p>
        
    <p class="legend pl-3 pt-4" style="color: red;">* Equipment/s not returned</p><br>
    <table class="table text-center" id="dataTables">
      <thead>
        <tr>
          <th>Transaction Number</th>
          <th>Date Submitted</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody class="text-center">
          @foreach ($transaction_forms as $form)
          <tr @if($form->approval==0)style="color: red"; @endif>
              <td data-toggle="modal" data-target="#checkForm{{$form->transaction_id}}" id="transaction">{{$form->transaction_id}}</td>
              <td>{{\Carbon\Carbon::parse($form->created_at)->toFormattedDateString()}}</td>
              <td>
                @if($form->approval==1)
                  APPROVED
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