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
          <nav class="navbar sticky-top navbar-expand-md navbar-dark" style="background-color: #171717;">
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
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Equipments</a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="camera-equipment">Cameras & Accessories</a>
                    <a class="dropdown-item" href="art-tools">Art Tools</a>
                    <a class="dropdown-item" href="sports-equipment">Sports Equipment</a>
                    <a class="dropdown-item" href="gaming-equipment">Gaming Devices</a>
                    <a class="dropdown-item" href="laptops-accessories">Laptops & Accessories</a>
                    <a class="dropdown-item" href="misc-equipment">Miscellaneous</a>
                  </div>
                </li>        
                <li class="nav-item">
                  <a class="nav-item nav-link" href="faqs">FAQs</a>
                </li>
                <li class="nav-item">
                  <a class="nav-item nav-link" href="contact">Contact Us</a>
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
                <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">Log out</a>
              </div>
            </div>
  
            <a href="#" role="button" data-toggle="modal" data-target="#cartModal" data-toggle="tooltip" data-placement="bottom" title="Cart">
              <img src = "{{ url('img/cart.png') }}" height= 23;>
            </a>

            <!--MODALS-->

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
            </div>
    
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
                          @foreach ($totalEquip->unique('equip_name') as $equipment)
                              @if ($equipment->transaction_id == $lastTransaction->transaction_id)
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
                              @endif
                          @endforeach
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
    