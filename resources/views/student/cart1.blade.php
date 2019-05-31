@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | Cart</title>
    <link rel="stylesheet" href="{{ asset('css/equiplist.css') }}" type=text/css>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <style>
    .btn > a {
        color: #007bff;
        text-decoration: none;
        background-color: none;
    }

    .inside {
        background-color: transparent;
    }
    </style>
@endsection

@section('navi')
    @include('inc.naviStudent', [$totalEquip, $lastTransaction, $countCart])
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div id="progress">
            <ul class="progressbar justify-content-center">
                <li class="active">Review Equipment</li>
                <li>Reservation Form Fill-up</li>
                <li>Summary</li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mt-5">
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
                    @foreach ($totalEquip->unique('equip_name') as $equipment)
                        @if ($equipment->transaction_id == $lastTransaction->transaction_id)
                        <tr>
                            <td class="pl-5 align-middle">
                                {{$equipment->equip_name}}
                                @foreach ($totalEquip as $specificEquip)
                                    @if ($specificEquip->equip_name == $equipment->equip_name && $specificEquip->transaction_id == $lastTransaction->transaction_id)
                                        <br>
                                        <small class="pl-2">{{$specificEquip->equipID}}</small>
                                    @endif
                                @endforeach
                            </td>
                            <td class="text-center align-middle">
                                @foreach ($countCart as $item)
                                    @if (Arr::get($item, 'equip_name') == $equipment->equip_name)
                                        {{Arr::get($item, 'record')}}
                                    @endif
                                @endforeach
                            </td>
                            <td class="text-center align-middle">
                                {!! Form::open(['action' => 'EquipmentsController@deleteReservation', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                                {{Form::hidden('equip_name', $equipment->equip_name)}}
                                {{Form::submit('Remove', ['class' => 'btn btn-danger'])}}
                                {!! Form::close() !!} 
                                <!--<button type="button" class="btn btn-danger">Remove</button>-->
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="text-center">
    <div class="btn-group text-center mt-2" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-outline-secondary btn-lg" disabled>Previous</button>
        <a href="cart2" class="btn btn-outline-primary btn-lg">Next</a>
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