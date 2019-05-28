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

            .cartBtn a, a:hover {
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
                  <a class="nav-link" href="history">History</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="calendar">Calendar</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="equipmentlist">Equipment</a>
                </li>      
                <li class="nav-item">
                  <a class="nav-link" href="faqs">FAQ</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="contact">Contact Us</a>
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
              <div class="dropdown-menu dropdown-menu-right bg-white" aria-labelledby="account" style="width: 300px;">
                <div class="profileInfo h-50 text-center mx-auto bg-white">
                    <img src = "{{ url('img/user-account-box.jpg') }}" class="my-2 rounded-circle" height="80">
                    <h5 class="pt-2 text-uppercase">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h5>
                    <p>{{Auth::user()->user_id}} | {{Auth::user()->course}}</p>
                </div>
                {{-- <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">Log out</a> --}}
                <a class="dropdown-item text-right bg-light font-weight-bold" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </div>
  
            <a href="#" role="button" data-toggle="modal" data-target="#cartModal" data-toggle="tooltip" data-placement="bottom" title="Cart">
              <img src = "{{ url('img/cart.png') }}" height= 23;>
            </a>

            <!--MODALS-->
    
            <!-- The Modal -->
            <div class="modal" id="cartModal">
              <div class="modal-dialog">
                <div class="modal-content">
    
                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Cart Details</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
    
                  <!-- Modal body -->
                  <div class="modal-body">
                    <p class="cartbody">These are the equipments you have added.<br>Click "Checkout" to proceed.</p>
                    <table class="table table-bordered table-striped">
                      <thead class="text-center align-middle">
                        <tr>
                          <th>Equipments</th>
                          <th>Quantity</th>
                        </tr>
                      </thead>
                      <tbody class="text-center align-middle">
                          @if ($countCart == null || $countCart->isEmpty())
                            <tr>
                              <td colspan="2">No equipments reserved!</td>
                            </tr>
                          @else
                              @foreach ($totalEquip->unique('equip_name') as $equipment)
                                <tr>
                                  <td>{{$equipment->equip_name}}</td>
                                  <td>
                                    @foreach ($countCart as $item)
                                      @if (Arr::get($item, 'equip_name') == $equipment->equip_name)
                                        {{Arr::get($item, 'record')}}
                                      @endif
                                    @endforeach 
                                  </td>
                                </tr>
                            @endforeach
                          @endif
                      </tbody>
                    </table>
                  </div>
    
                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success cartBtn">
                      <a href="cart">Checkout</a>
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
    
                </div>
              </div>
            </div>
          </nav>
        </div>
</body>
    