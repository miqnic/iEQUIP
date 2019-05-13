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
  
<div class="formtable mx-auto w-75">
    <table class="table table-striped">
        <thead class="text-center align-middle">
            <tr>
                <th>Equipment Name</th>
                <th>Quantity</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="pl-5 align-middle">
                    Canon EOS 80D DSLR Camera
                    <br>
                    <small class="pl-2">CANCAM0001</small>
                    <br>
                    <small class="pl-2">CANCAM0002</small>
                    </td>
                <td class="text-center align-middle">2</td>
                <td class="text-center align-middle"><button type="button" class="btn btn-danger">Remove</button></td>
            </tr>
            <tr>
                <td class="pl-5 align-middle">
                    Spalding NBA Official Game Ball Basketball
                    <br>
                    <small class="pl-2">SPANBA0005</small>
                </td>
                <td class="text-center align-middle">1</td>
                <td class="text-center align-middle"><button type="button" class="btn btn-danger">Remove</button></td>
            </tr>
        </tbody>
    </table>
</div>

<div class="wrapper text-center">
    <div class="btn-group text-center mt-2" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-outline-secondary btn-lg" disabled>Previous</button>
        <button type="button" class="btn btn-outline-primary btn-lg"><a href="cart2">Next</a></button>
    </div>
</div>
@endsection

@section('modal')
    {{-- @include('inc.checkFormModal') --}}
    @include('inc.awayModalContact')
    @include('inc.awayModalEquip')
    @include('inc.awayModalHist')
    @include('inc.awayModalHome')
@endsection