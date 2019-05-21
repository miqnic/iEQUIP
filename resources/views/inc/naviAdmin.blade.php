<head>
        <style>
            .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            }
    
            @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
            }
    
            body.modal-open div.modal-backdrop {
                z-index: 0;
            }
    
            .navbar-nav {
            font-size: 14px !important;
            }

            .logout a, a:hover {
              color: white;
              text-decoration: none;
            }
        </style>
</head>
<body>
    <div class = "navi">
        <!-- Fixed navbar -->
          <nav class="navbar sticky-top navbar-expand-md navbar-dark bg-dark">
            <a class="navbar-brand">
              <img src = "{{ url('img/iacademylogo.png') }}" height="28">
              <img src = "{{ url('img/logo.png') }}" height="30">
              <img src = "{{ url('img/logotext.png') }}" height="15">
            </a>
    
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarCollapse">
              <div class = "navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="home">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="balances">Balances</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="calendar">Calendar</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="equipmentlist">Equipment</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="request-history">Request History</a>
                </li>
                <li class="nav-item">
                  <span class="badge badge-pill badge-primary text-light" style="float:right;margin-bottom:-10px;margin-right:-15px;">1</span>
                  <a class="nav-link" href="feedbacks">Feedback</a>
                </li>
              </div>
            </div>
    

                {!! Form::open(['action' => 'EquipmentsController@searchEquipment', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'form-inline']) !!}
                {{Form::text('search', '',['class' => 'form-control mr-sm-2', 'placeholder' => 'Search', 'aria-label' => 'Search'])}}
                {{Form::submit('Search', ['class' => 'btn btn-outline-light'])}}
                <!--<input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                <button type="submit" class="btn btn-outline-light">Search</button>-->
                {!! Form::close() !!}
    
            <div class="btn dropdown">
            <a href="#" id="account" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" title="Sign Out">
              <img src = "{{ url('img/user-account-box.png') }}" height= 23;>
            </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="account">
                {{-- <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">Log out</a> --}}
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </div>

            <!--MODALS-->
{{-- 
            <div class="modal" id="logoutModal">
              <div class="modal-dialog">
                <div class="modal-content">
    
                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Log Out Confirmation</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
    
                  <!-- Modal body -->
                  <div class="modal-body">
                    If you want to log out, click on the "Log out" button below.
                  </div>
    
                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary logout">
                      <a class="" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  </div>
    
                </div>
              </div>
            </div> --}}
          </nav>
        </div>
</body>
    