@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | Home</title>
@endsection

@section('navi')
    @include('inc.naviStudent')
@endsection

@section('content')
<div class="row">
    <div class="col-md-3 mx-auto" style="display: block; width: auto; flex: 0 0 0">
        <div class="card mt-4 ml-3" style="width: 20rem;" id="con1">
            <img class="card-img-top" src="img\user-account-box.jpg" alt="Sample photo">
            <div class="card-body text-center">
                <h4 class="card-title">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h4>
                <p class="card-text">
                    <b>Student ID:</b> {{ Auth::user()->user_id }}<br>
                    <b>Course:</b> {{ Auth::user()->course }}<br>
                    <b>Penalty:</b> P{{ Auth::user()->penalty }}.00</p>
            </div>
        </div>
    </div>

    <div class="col-md-9 mr-auto">
        <div class="container-fluid mx-auto pt-4" id="con2">
            <h3>Pending Requests</h3>
            <table class="table table-striped table-hover">
                <thead class="text-center">
                <tr>
                    <th>Transaction Code</th>
                    <th>Date Submitted</th>
                    <th></th>
                </tr>
                </thead>
                <tbody class="text-center">
                @if($transaction_forms->isEmpty())
                <tr>
                    <td colspan="3">No pending requests</td>
                </tr>
                @else
                    @foreach($transaction_forms as $form)
                        @if($form->approval==-1)
                            <tr>
                                <td class="align-middle" data-toggle="modal" data-target ="#checkForm{{$form->transaction_id}}">{{$form->transaction_id}}</td>
                                <td class="align-middle" data-toggle="modal" data-target ="#checkForm{{$form->transaction_id}}">{{\Carbon\Carbon::parse($form->submitted_date)->toFormattedDateString()}}</td>
                                <td class="align-middle"><button type="button" class="btn btn-danger">Cancel</button></td>
                            </tr>
                        @endif
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>

        <div class="container-fluid mx-auto pt-3" id="con3">
            <div class="accepted">
                <h3>Accepted Requests</h3>
                <table class="table table-striped table-hover">
                <thead class="text-center">
                    <tr>
                    <th>Transaction Code</th>
                    <th>Date Submitted</th>
                    <th>Date Approved</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody class="text-center">
                @if($recentForms->isEmpty())
                    <tr>
                        <td colspan="3">No submitted requests</td>
                    </tr>
                @else
                    @foreach($recentForms as $form)
                        @if($form->user_id==Auth::user()->user_id)
                            <tr>
                            <td class="align-middle" data-toggle="modal" data-target ="#checkForm{{$form->transaction_id}}">{{$form->transaction_id}}</td>
                            <td class="align-middle" data-toggle="modal" data-target ="#checkForm{{$form->transaction_id}}">{{\Carbon\Carbon::parse($form->submitted_date)->toFormattedDateString()}}</td>
                            <td class="align-middle" data-toggle="modal" data-target ="#checkForm{{$form->transaction_id}}">04/02/2019</td>
                            <td class="align-middle"><button type="button" class="btn btn-danger">Cancel</button></td>
                            </tr>
                        @endif
                    @endforeach
                @endif
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
    {@include('inc.checkFormModal')
@endsection
{{-- 
     <a class="" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form> --}}