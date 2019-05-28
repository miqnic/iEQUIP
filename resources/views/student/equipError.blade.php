@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | Banned</title>
    <link rel="stylesheet" href="{{ asset('css/equiplist.css') }}" type=text/css>

    <style>
    .inside {
        margin-top: 200px;
        background-color: transparent;
    }
    </style>
@endsection

@section('navi')
    @include('inc.naviStudent', [$totalEquip, $lastTransaction, $countCart])
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 text-center">
        <h4 class="display-4 w-75 mx-auto py-2">
            <i class="fas fa-sad-cry text-primary"></i> Oh no! Looks like you've reached the penalty limit.
        </h4>
        <h4 class="pb-3">
            Your penalty has reached over <strong>P5000</strong>, making you temporarily banned from reserving equipment.
            <br>
            Please settle your balance amounting to <span class="text-danger font-weight-bold">PHP {{Auth()->user()->penalty}}.00</span> as soon as possible to dismiss this message.
        </h4>

        <p class="lead">For concerns and inquiries, please go to the <a href="contact">Contact Us</a> page.</p>
    </div>
</div>
@endsection
