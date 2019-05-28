@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | Login</title>
    <link rel="stylesheet" href="{{ asset('css/landingPage.css') }}" type=text/css>

    <script>
        $(document).ready(function(){
        $('.popover-dismiss').popover({
            trigger: 'focus'
        })
        });
    </script>
@endsection

@section('content')
@csrf
<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first">
            <div class="row">
                <div>
                    <img class = "col-md-3" src="img\iacademylogo.png" id="iaclogo" alt="User Icon" style='max-width: auto'/>
                    <img class = "col-md-3" src="img\logo.png" id="iequiplogo" alt="User Icon" style='max-width: auto'/>
                </div>
            </div>
            <img src="img\logotext.png" id="icon" alt="User Icon"/>
            <p class="subtitle"><b>Easy & Hassle-free</b></p>
            <p class="subtitle2">With iEQUIP, reserving equipments can be done in just a few clicks!</p>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <input type="email" id="userid" class="fadeIn second form-control{{ $errors->has('email') ? ' is-invalid' : '' }} input-sm" name="email" placeholder="iACADEMY email" required autofocus>
            
            <!--Email errors-->
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif

            <input type="password" id="pswrd" class="fadeIn third form-control{{ $errors->has('password') ? ' is-invalid' : '' }} input-sm" name="password" placeholder="Password" required><br>
            
            <!--Password errors-->
            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif

            <input type="submit" class="fadeIn fourth" value="login">
        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
                <a tabindex="0" role="button" class="popover-dismiss" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Please proceed to the IT Department at the Mezzanine, iACADEMY Nexus.">Forgot your password?</a>
        </div>

    </div>
</div>
@endsection