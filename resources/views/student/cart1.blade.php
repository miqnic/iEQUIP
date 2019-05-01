@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | Cart</title>
    <link rel="stylesheet" href="{{ asset('css/cart1.css') }}" type=text/css>
@endsection

@section('navi')
    @include('inc.naviStudent')
@endsection

@section('content')
<div class="container-fluid" id="progress">
    <ul class="progressbar justify-content-center">
        <li class="active">Review Equipment/s</li>
        <li>Reservation Form Fill-up</li>
        <li>Summary</li>
    </ul>
</div>
  
<div class="formtable">
    <table class="table table-striped">
        <thead>
            <tr>
                <th><br></th>
                <th><br></th>
                <th>Equipment ID</th>
                <th><br></th>
                <th><br></th>
                <th><br></th>
                <th><br></th>
                <th>Equipment Name</th>
                <th><br></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><br></td>
                <td><br></td>
                <td>CANCAM0001</td>
                <td><br></td>
                <td><br></td>
                <td><br></td>
                <td><br></td>
                <td>Canon EOS 80D</td>
                <td><button type="button" class="btn btn-danger">Remove</button></td>
            </tr>
            <tr>
                <td><br></td>
                <td><br></td>
                <td>SPANBA0005</td>
                <td><br></td>
                <td><br></td>
                <td><br></td>
                <td><br></td>
                <td>Spalding NBA Official Game Ball Basketball</td>
                <td><button type="button" class="btn btn-danger">Remove</button></td>
            </tr>
            <tr>
                <td><br></td>
                <td><br></td>
                <td>CANCAM0002</td>
                <td><br></td>
                <td><br></td>
                <td><br></td>
                <td><br></td>
                <td>Canon EOS 80D</td>
                <td><button type="button" class="btn btn-danger">Remove</button></td>
            </tr>
        </tbody>
    </table>
</div>

<div class="wrapper text-center">
    <div class="btn-group text-center mt-2" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-outline-secondary btn-lg" disabled>Previous</button>
        <a href="cart2"><button type="button" class="btn btn-outline-primary btn-lg">Next</button></a>
    </div>
</div>
@endsection

@section('modal')
    @include('inc.checkFormModal')
    @include('inc.awayModalContact')
    @include('inc.awayModalEquip')
    @include('inc.awayModalHist')
    @include('inc.awayModalHome')
@endsection