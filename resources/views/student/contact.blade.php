@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | Contact</title>
    <link rel="stylesheet" href="{{ asset('css/student-contact.css') }}" type=text/css>
@endsection

@section('navi')
    @include('inc.naviStudent')
@endsection

@section('content')
<div class="row">
    <div class="col-md-5">
        <div class="header">
            <h2 class="border-bottom pb-2 pl-3">Contact Us</h2><br>
            <h4>If you have problems/suggestions, kindly write us an email. You could also go to the 2nd Floor, iACADEMY Nexus, Yakal, Makati City.</h4><br>
            <p>Tel. No. : +63 XXXXX XXXXX</p>
        </div>
    </div>

    <div class="col-md-5 offset-2">
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="input-group-prepend">
            <span class="input-group-text" id="inlineFormCustomSelect">Type of feedback: </span>
            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                <option value="0" selected>Suggestion</option>
                <option value="1">Complaint</option>
                <option value="2">Others</option>
            </select>
        </div>
        <div class="input-group">

            {!! Form::open(['action' => 'EmailsController@feedback', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::label('subject', 'Subject')}}
                {{Form::text('subject', '',['class' => 'form-control', 'placeholder' => 'Subject'])}}
            </div>

            <div class="form-group">
                    {{Form::label('body', 'Body')}}
                    {{Form::textarea('body', '',['id' => 'article-ckeditor','class' => 'form-control', 'placeholder' => 'Body'])}}
            </div>
            
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
</div>
    
@endsection
