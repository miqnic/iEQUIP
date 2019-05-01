@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | Home</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}">
@endsection

@section('navi')
    @include('inc.naviAdmin')
@endsection

@section('content')
<div class="header">
    <h2 class="border-bottom pb-2 pl-3">Currently Reserved Equipment</h2>
</div>

<div class="container-fluid">
    <table class = "table table-responsive-md text-center table-striped">
        <thead>
        <tr class = "category">
            <th>Equipment ID</th>
            <th>Equipment Name</th>
            <th>Transaction Number</th>
            <th>Due Date</th>
            <th>Student Name</th>
        </tr>
        </thead>
        <tbody>
        <tr class = "member">
            <td>CANCAM0001</td>
            <td>Canon EOS 80D DSLR Camera</td>
            <td id = "transaction" data-toggle="modal" data-target ="#checkForm">TC19000001</td>
            <td>9/19/2019</td>
            <td id="student" data-toggle="modal" data-target ="#viewStudent">Rhej Christian J. Laurel</td>
        </tr>
        <tr class = "member">
            <td>ZHISTA0001</td>
            <td>Zhiyun Crane 2 Stabilizer</td>
            <td id = "transaction" data-toggle="modal" data-target ="#checkForm">TC19000001</td>
            <td>9/19/2019</td>
            <td id="student" data-toggle="modal" data-target ="#viewStudent">Miqaela Nicole D. Banguilan</td>
        </tr>
        <tr class = "member">
            <td>WACCIN0002</td>
            <td>Wacom CINTIQ 13HD Tablet</td>
            <td id = "transaction" data-toggle="modal" data-target ="#checkForm">TC19000008</td>
            <td>7/01/2020</td>
            <td id="student" data-toggle="modal" data-target ="#viewStudent">Joshua Joseph M. Mayo</td>
        </tr>
        <tr class = "member">
            <td>SPANBA0005</td>
            <td>Spalding NBA Official Game Ball Basketball</td>
            <td id = "transaction" data-toggle="modal" data-target ="#checkForm">TC19000027</td>
            <td>16/9/2019</td>
            <td id="student" data-toggle="modal" data-target ="#viewStudent">Rhej Christian J. Laurel</td>
        </tr>
        </tbody>
    </table>
</div>
@endsection

@section('modal')
    @include('inc.checkFormModal')
    @include('inc.viewStudentModal')
@endsection
