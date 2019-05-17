@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | Contact</title>
    <link rel="stylesheet" href="{{ asset('css/student-contact.css') }}" type=text/css>
@endsection

@section('navi')
    @include('inc.naviStudent', [$totalEquip, $lastTransaction, $countCart])
@endsection

@section('content')
<div class="row">
    <div class="col-md-6 align-middle text-right pt-5 pr-4">
        <div class="header">
            <h2 class="border-bottom pb-2 pl-3">Contact Us</h2><br>
            <p>
                If you have problems/suggestions, kindly write us an email.<br>
                You may also proceed to the Facilities Department, <br>
                2nd Floor, iACADEMY Nexus, Yakal, Makati City.</p><br>
            <p>
                <b>Building Admin and Facilities</b><br>
                adminfacilities@iacademy.edu.ph<br>
                Tel.: 889 5555 ext. 2234 - 2235</p>
        </div>
    </div>

    <div class="col-md-6 border-left pt-2 pb-5 pl-4">
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        
            
            {{--<div class="input-group-prepend w-50">
                 <span class="input-group-text" id="inlineFormCustomSelect">Type of feedback: </span>
            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                <option value="0" selected>Suggestion</option>
                <option value="1">Complaint</option>
                <option value="2">Others</option>
            </select>
            
            </div>--}}
        <div class="input-group">
            {!! Form::open(['action' => 'FeedbacksController@feedback', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::label('feedbackType', 'Type of Feedback')}}
                {{Form::select('feedbackType', array(0 => 'Suggestion', 1 => 'Complaint', 2 => 'Others'), 0, ['class' => 'form-control custom-select'])}}
            </div>



            <div class="form-group">
                {{Form::label('subject', 'Subject')}}
                {{Form::text('subject', '',['class' => 'form-control', 'placeholder' => 'Enter subject'])}}
            </div>

            <div class="form-group">
                    {{Form::label('body', 'Message')}}
                    {{Form::textarea('body', '',['class' => 'form-control', 'rows' => '8', 'placeholder' => 'Enter message'])}}
            </div>
            
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
</div>
    
@endsection
