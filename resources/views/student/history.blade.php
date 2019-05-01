@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | History</title>
    <link rel="stylesheet" href="{{ asset('css/student-history.css') }}" type=text/css>
@endsection

@section('navi')
    @include('inc.naviStudent')
@endsection

@section('content')
<div class="container-fluid" id="con1">
    <h2>Request History</h2><hr>
    <p class="legend" style="color: red; background-color: white;">* Equipment/s not returned</p><br>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Transaction Number</th>
          <th>Date Submitted</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <tr class = "member" data-toggle="modal" data-target ="#checkForm">
          <td>TC19000005</td>
          <td>27/01/2019</td>
          <td>APPROVED</td>
        </tr>
        <tr class = "member notReturned" data-toggle="modal" data-target ="#checkForm-noReturn">
          <td>TC19000005</td>
          <td>22/01/2019</td>
          <td>APPROVED</td>
        </tr>
        <tr class = "member" data-toggle="modal" data-target ="#checkForm">
          <td>TC19000003</td>
          <td>05/01/2019</td>
          <td>CANCELLED</td>
        </tr>
        <tr class = "member" data-toggle="modal" data-target ="#checkForm">
          <td>TC19000001</td>
          <td>04/01/2019</td>
          <td>DECLINED</td>
        </tr>
      </tbody>
    </table>
  </div>
@endsection

@section('modal')
    @include('inc.checkFormModal')
@endsection