@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | FAQ</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/equiplist.css') }}">
    <script>
    $(document).ready(function(){
        $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
            $('#back-to-top').tooltip('hide');
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
        
        $('#back-to-top').tooltip('show');
    });

    $('.rotate').click(function() {
        $('this').toggleClass("down"); 
    }) //lmao this aint working yet sobs
    </script>

    <style>
    .inside {
        background-color: transparent;
    }
    </style>
@endsection

@section('navi')
    @include('inc.naviStudent', [$equipments, $lastTransaction, $countCart]) 
@endsection

@section('content')
    <div class="mb-5 mx-auto">
        <h1 class="text-center mb-3 pt-5 pb-5 text-uppercase">Frequently Asked Questions</h1>
        <h1 class="display-5 text-center text-primary pt-4"><img src="{{ url('img/bulb.png') }}" height="50" class="mb-3 mr-2">What is iEQUIP?</h1>
        <p class="lead w-50 text-center text-secondary mx-auto pb-5">
            iEQUIP is a reservation system wherein iACADEMY students and faculty alike can reserve equipment — anytime, anywhere.
        </p>
        <ul class="nav nav-pills mx-auto w-75 pb-5 mb-5 nav-justified">
            <li class="nav-item">
                <a class="nav-link active mr-3" href="#jump1">Reservation</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active mr-3" href="#jump2">Penalties</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active mr-3" href="#jump3">Account</a>
            </li>
        </ul>

        <h4 class="text-center pt-5 mb-3 text-uppercase" id="jump1">Reservation</h4>
        <div class="accordion w-75 pb-5 mx-auto" id="faq1">
            <hr>
            <div class="faq">
                <div class="faq-header" id="reservationq1" data-toggle="collapse" data-target="#reservationqcollapse1" aria-expanded="true" aria-controls="reservationqcollapse1">
                    <h2 class="mt-1">
                        <span class="float-left question pr-2 pt-1"><b>|</b> Q.</span><span style="font-size: 16px;">How do I browse for equipment?</span>
                        <span class="float-right pt-1"><i class="fas fa-chevron-down fa-xs rotate"></i></span>
                    </h2>
                </div>
            
                <div id="reservationqcollapse1" class="collapse" aria-labelledby="reservationq1" data-parent="#faq1">
                <div class="faq-body text-secondary text-justify my-2">
                    <h2 class="float-left text-primary pr-2 d-inline"><b>|</b> A.</h2>
                    You may browse for equipment by clicking the corresponding category in the <b>Equipments</b> dropdown. 
                    Alternatively, you may use the search bar if you have a specific item in mind. By clicking on the corresponding equipment, 
                    its details and individual stock description and availability.
                </div>
                </div>
            </div>
            <div class="faq">
                <div class="faq-header" id="reservationq2" data-toggle="collapse" data-target="#reservationqcollapse2" aria-expanded="false" aria-controls="reservationqcollapse2">
                    <h2 class="mt-1">
                        <span class="float-left question pr-2 pt-1"><b>|</b> Q.</span><span style="font-size: 16px;">How do I reserve equipment?</span>
                        <span class="float-right pt-1"><i class="fas fa-chevron-down fa-xs"></i></span>
                    </h2>
                </div>
                <div id="reservationqcollapse2" class="collapse" aria-labelledby="reservationq2" data-parent="#faq1">
                <div class="faq-body text-secondary text-justify my-2">
                    <h2 class="float-left text-primary pr-2 d-inline"><b>|</b> A.</h2>
                    Find the item/s that you need, click the <b>Reserve</b> button to specify the quantity then click <b>Add to Cart</b>. 
                    Once you are done adding items, click on the <i class="fas fa-shopping-cart"></i>Cart icon located at the top right of the site, which will allow 
                    you to finalize your cart contents (edit quantity and/or delete items) and provide necessary details, 
                    (i.e. reservation period, room number, and purpose).
                </div>
                </div>
            </div>
            <div class="faq">
                <div class="faq-header" id="reservationq3" data-toggle="collapse" data-target="#reservationqcollapse3" aria-expanded="false" aria-controls="reservationqcollapse3">
                <h2 class="mt-1">
                    <span class="float-left question pr-2 pt-1"><b>|</b> Q.</span><span style="font-size: 16px;">How do I know when this item will be available?</span>
                    <span class="float-right pt-1"><i class="fas fa-chevron-down fa-xs"></i></span>
                </h2>
                </div>
                <div id="reservationqcollapse3" class="collapse" aria-labelledby="reservationq3" data-parent="#faq1">
                <div class="faq-body text-secondary text-justify my-2">
                    <h2 class="float-left text-primary pr-2 d-inline"><b>|</b> A.</h2>
                    You may check for the availability of items by clicking on the <b>Calendar</b> tab, where you can filter the display by category. 
                    Clicking on each reservation entry will show its details.
                </div>
                </div>
            </div>
            <div class="faq">
                <div class="faq-header" id="reservationq4" data-toggle="collapse" data-target="#reservationqcollapse4" aria-expanded="false" aria-controls="reservationqcollapse4">
                <h2 class="mt-1">
                    <span class="float-left question pr-2 pt-1"><b>|</b> Q.</span><span style="font-size: 16px;">Up to what time am I allowed to reserve?</span>
                    <span class="float-right pt-1"><i class="fas fa-chevron-down fa-xs"></i></span>
                </h2>
                </div>
                <div id="reservationqcollapse4" class="collapse" aria-labelledby="reservationq4" data-parent="#faq1">
                <div class="faq-body text-secondary text-justify my-2">
                    <h2 class="float-left text-primary pr-2 d-inline"><b>|</b> A.</h2>
                    You can submit your request/s anytime up until <b>3 hours before your preferred start date and time</b>.
                </div>
                </div>
            </div>
            <div class="faq">
                <div class="faq-header" id="reservationq5" data-toggle="collapse" data-target="#reservationqcollapse5" aria-expanded="false" aria-controls="reservationqcollapse5">
                <h2 class="mt-1">
                    <span class="float-left question pr-2 pt-1"><b>|</b> Q.</span><span style="font-size: 16px;">Why is the admin taking so long to confirm?</span>
                    <span class="float-right pt-1"><i class="fas fa-chevron-down fa-xs"></i></span>
                </h2>
                </div>
                <div id="reservationqcollapse5" class="collapse" aria-labelledby="reservationq5" data-parent="#faq1">
                <div class="faq-body text-secondary text-justify my-2">
                    <h2 class="float-left text-primary pr-2 d-inline"><b>|</b> A.</h2>
                    We apologize for this. You should expect a status update on the site and via email notification within 24 hours (excluding non-office hours). 
                    If 24 hours have already passed and the status of your request still remains pending, you may contact the <b>Facilities Department</b> for a follow-up 
                    at <b>889 5555 ext. 2234 - 2235</b>, use the <a href="contact" target="_blank"><b>Contact Us</b></a> page of the site, or proceed to their office itself at the 
                    <b>Mezzanine, 2nd Floor Parking Area, iACADEMY Nexus</b>.
                </div>
                </div>
            </div>
            <div class="faq">
                <div class="faq-header" id="reservationq6" data-toggle="collapse" data-target="#reservationqcollapse6" aria-expanded="false" aria-controls="reservationqcollapse6">
                <h2 class="mt-1">
                    <span class="float-left question pr-2 pt-1"><b>|</b> Q.</span><span style="font-size: 16px;">Am I allowed to revise my request after submission?</span>
                    <span class="float-right pt-1"><i class="fas fa-chevron-down fa-xs"></i></span>
                </h2>
                </div>
                <div id="reservationqcollapse6" class="collapse" aria-labelledby="reservationq6" data-parent="#faq1">
                <div class="faq-body text-secondary text-justify my-2">
                    <h2 class="float-left text-primary pr-2 d-inline"><b>|</b> A.</h2>
                    Unfortunately, revisions aren’t permitted to avoid confusion on the Facilities Department’s side. If ever you need to make changes, 
                    please cancel your request on the Homepage and submit another one.
                </div>
                </div>
            </div>
            <div class="faq">
                <div class="faq-header" id="reservationq7" data-toggle="collapse" data-target="#reservationqcollapse7" aria-expanded="false" aria-controls="reservationqcollapse7">
                <h2 class="mt-1">
                    <span class="float-left question pr-2 pt-1"><b>|</b> Q.</span><span style="font-size: 16px;">Can I extend my reservation?</span>
                    <span class="float-right pt-1"><i class="fas fa-chevron-down fa-xs"></i></span>
                </h2>
                </div>
                <div id="reservationqcollapse7" class="collapse" aria-labelledby="reservationq7" data-parent="#faq1">
                <div class="faq-body text-secondary text-justify my-2">
                    <h2 class="float-left text-primary pr-2 d-inline"><b>|</b> A.</h2>
                    To give way to other users, extension is not allowed. However, if you haven’t claimed your reserved item/s yet and your target date/time 
                    for extension is still vacant, you may cancel your reservation and submit another one.
                </div>
                </div>
            </div>   
        </div>

        <h4 class="text-center pt-5 mb-3 text-uppercase" id="jump2">Penalties</h4>
        <div class="accordion w-75 pb-5 mx-auto" id="faq2">
            <hr>
            <div class="faq">
                <div class="faq-header" id="penaltyq1" data-toggle="collapse" data-target="#penaltyqcollapse1" aria-expanded="true" aria-controls="penaltyqcollapse1">
                <h2 class="mt-1">
                    <span class="float-left question pr-2 pt-1"><b>|</b> Q.</span><span style="font-size: 16px;">Where can I check my balance?</span>
                    <span class="float-right pt-1"><i class="fas fa-chevron-down fa-xs"></i></span>
                </h2>
                </div>
            
                <div id="penaltyqcollapse1" class="collapse" aria-labelledby="penaltyq1" data-parent="#faq2">
                <div class="faq-body text-secondary text-justify my-2">
                    <h2 class="float-left text-primary pr-2 d-inline"><b>|</b> A.</h2>
                    Your outstanding balance (if there’s any) will appear on the left side of the Homepage along with your photo, student ID, and name. 
                    Aside from this, you may also receive an email notification reminding you of your penalty from time to time.
                </div>
                </div>
            </div>
            <div class="faq">
                <div class="faq-header" id="penaltyq2" data-toggle="collapse" data-target="#penaltyqcollapse2" aria-expanded="false" aria-controls="penaltyqcollapse2">
                <h2 class="mt-1">
                    <span class="float-left question pr-2 pt-1"><b>|</b> Q.</span><span style="font-size: 16px;">When will I incur penalties?</span>
                    <span class="float-right pt-1"><i class="fas fa-chevron-down fa-xs"></i></span>
                </h2>
                </div>
                <div id="penaltyqcollapse2" class="collapse" aria-labelledby="penaltyq2" data-parent="#faq2">
                <div class="faq-body text-secondary text-justify my-2">
                    <h2 class="float-left text-primary pr-2 d-inline"><b>|</b> A.</h2>
                    Your account will start incurring penalties a day right after your declared end date and will continue to do so weekly until the 
                    admin declares your transaction status as returned.
                </div>
                </div>
            </div>
            <div class="faq">
                <div class="faq-header" id="penaltyq3" data-toggle="collapse" data-target="#penaltyqcollapse3" aria-expanded="false" aria-controls="penaltyqcollapse3">
                <h2 class="mt-1">
                    <span class="float-left question pr-2 pt-1"><b>|</b> Q.</span><span style="font-size: 16px;">How am I going to pay for the penalty? Can I pay online?</span>
                    <span class="float-right pt-1"><i class="fas fa-chevron-down fa-xs"></i></span>
                </h2>
                </div>
                <div id="penaltyqcollapse3" class="collapse" aria-labelledby="penaltyq3" data-parent="#faq2">
                <div class="faq-body text-secondary text-justify my-2">
                    <h2 class="float-left text-primary pr-2 d-inline"><b>|</b> A.</h2>
                    Unfortunately, iEQUIP doesn’t come with an online payment feature yet. You may settle your balance by proceeding to the <b>Accounting Office</b> 
                    at the <b>Ground Floor, iACADEMY Nexus</b>.
                </div>
                </div>
            </div>
            <div class="faq">
                <div class="faq-header" id="penaltyq4" data-toggle="collapse" data-target="#penaltyqcollapse4" aria-expanded="false" aria-controls="penaltyqcollapse4">
                <h2 class="mt-1">
                    <span class="float-left question pr-2 pt-1"><b>|</b> Q.</span><span style="font-size: 16px;">I broke an item. How much do I need to pay?</span>
                    <span class="float-right pt-1"><i class="fas fa-chevron-down fa-xs"></i></span>
                </h2>
                </div>
                <div id="penaltyqcollapse4" class="collapse" aria-labelledby="penaltyq4" data-parent="#faq2">
                <div class="faq-body text-secondary text-justify my-2">
                    <h2 class="float-left text-primary pr-2 d-inline"><b>|</b> A.</h2>
                    The item details provided for the Equipment list includes the corresponding base price, which will be the basis for your penalty in case 
                    the item gets returned with defect.
                </div>
                </div>
            </div>
        </div>

        <h4 class="text-center pt-5 mb-3 text-uppercase"  id="jump3">Account</h4>
        <div class="accordion w-75 pb-5 mx-auto" id="faq3">
            <hr>
            <div class="faq">
                <div class="faq-header" id="accountq1" data-toggle="collapse" data-target="#accountqcollapse1" aria-expanded="true" aria-controls="accountqcollapse1">
                <h2 class="mt-1">
                    <span class="float-left question pr-2 pt-1"><b>|</b> Q.</span><span style="font-size: 16px;">How do I modify my account credentials (email and password)?</span>
                    <span class="float-right pt-1"><i class="fas fa-chevron-down fa-xs"></i></span>
                </h2>
                </div>
            
                <div id="accountqcollapse1" class="collapse" aria-labelledby="accountq1" data-parent="#faq3">
                <div class="faq-body text-secondary text-justify my-2">
                    <h2 class="float-left text-primary pr-2 d-inline"><b>|</b> A.</h2>
                    Your credentials are based on your records in the school directory. For concerns regarding password changes, please visit the <b>IT Department</b> at the 
                    <b>Mezzanine, iACADEMY Nexus</b>.
                </div>
                </div>
            </div>

            <div class="faq">
                <div class="faq-header" id="accountq2" data-toggle="collapse" data-target="#accountqcollapse2" aria-expanded="true" aria-controls="accountqcollapse2">
                <h2 class="mt-1">
                    <span class="float-left question pr-2 pt-1"><b>|</b> Q.</span><span style="font-size: 16px;">Why do I have a "Facilities" deficiency in iSIMS?</span>
                    <span class="float-right pt-1"><i class="fas fa-chevron-down fa-xs"></i></span>
                </h2>
                </div>
            
                <div id="accountqcollapse2" class="collapse" aria-labelledby="accountq2" data-parent="#faq3">
                <div class="faq-body text-secondary text-justify my-2">
                    <h2 class="float-left text-primary pr-2 d-inline"><b>|</b> A.</h2>
                    This deficiency is caused by the user's inability to settle penalty fees before the end of term. Please coordinate with the <b>Facilities and Accounting Department</b>
                    to fix this issue.
                </div>
                </div>
            </div>

            <div class="faq">
                <div class="faq-header" id="accountq3" data-toggle="collapse" data-target="#accountqcollapse3" aria-expanded="true" aria-controls="accountqcollapse3">
                <h2 class="mt-1">
                    <span class="float-left question pr-2 pt-1"><b>|</b> Q.</span><span style="font-size: 16px;">Why is this site function not working?</span>
                    <span class="float-right pt-1"><i class="fas fa-chevron-down fa-xs"></i></span>
                </h2>
                </div>
            
                <div id="accountqcollapse3" class="collapse" aria-labelledby="accountq3" data-parent="#faq3">
                <div class="faq-body text-secondary text-justify my-2">
                    <h2 class="float-left text-primary pr-2 d-inline"><b>|</b> A.</h2>
                    We apologize for this issue. This could be either due to network connection issues or site bugs. If ever you encounter problems, please feel free to report by sending a 
                    message using the <a href="contact" target="_blank"><b>Contact Us</b></a> page.
                </div>
                </div>
            </div>

            <div class="faq">
                <div class="faq-header" id="accountq4" data-toggle="collapse" data-target="#accountqcollapse4" aria-expanded="true" aria-controls="accountqcollapse4">
                <h2 class="mt-1">
                    <span class="float-left question pr-2 pt-1"><b>|</b> Q.</span><span style="font-size: 16px;">How do I delete my account?</span>
                    <span class="float-right pt-1"><i class="fas fa-chevron-down fa-xs"></i></span>
                </h2>
                </div>
            
                <div id="accountqcollapse4" class="collapse" aria-labelledby="accountq4" data-parent="#faq3">
                <div class="faq-body text-secondary text-justify my-2">
                    <h2 class="float-left text-primary pr-2 d-inline"><b>|</b> A.</h2>
                    Since iEQUIP's connected to the school's active directory, account deletion won't be possible. 
                    Unenrolled students, however, will have their accounts set to inactive.
                </div>
                </div>
            </div>

            <div class="faq">
                <div class="faq-header" id="accountq5" data-toggle="collapse" data-target="#accountqcollapse5" aria-expanded="true" aria-controls="accountqcollapse5">
                <h2 class="mt-1">
                    <span class="float-left question pr-2 pt-1"><b>|</b> Q.</span><span style="font-size: 16px;">Am I allowed to change my picture?</span>
                    <span class="float-right pt-1"><i class="fas fa-chevron-down fa-xs"></i></span>
                </h2>
                </div>
            
                <div id="accountqcollapse5" class="collapse" aria-labelledby="accountq5" data-parent="#faq3">
                <div class="faq-body text-secondary text-justify my-2">
                    <h2 class="float-left text-primary pr-2 d-inline"><b>|</b> A.</h2>
                    Unfortunately, your ID picture will be set as your permanent account picture for formality.
                </div>
                </div>
            </div>
        </div>
    </div>

    <a id="back-to-top" href="#" class="btn btn-primary btn-lg topBtn" role="button" title="Back to Top" data-toggle="tooltip" data-placement="left"><span class="fas fa-chevron-up"></span></a>
@endsection