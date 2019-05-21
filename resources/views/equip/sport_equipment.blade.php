@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | Sports Equipment</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/equiplist.css') }}">
@endsection

@section('navi')
  @if(Auth::user()->access_role == "ADMIN")
    @include('inc.naviAdmin')
  @else
    @include('inc.naviStudent', [$totalEquip, $lastTransaction, $countCart])
  @endif
@endsection

@section('content')
  <div class="row pb-3">
    <div class="col-md-3 pt-2 padding-right-0">
      <div class="list-group" id="list-tab" role="tablist">
          <a class="list-group-item text-uppercase font-weight-bold">Browse Categories</a>
          <a class="list-group-item list-group-item-action" href="equipmentlist" role="tab">All</a>
          <a class="list-group-item list-group-item-action" href="art-tools" role="tab">Art Tools</a>
          <a class="list-group-item list-group-item-action" href="camera-equipment" role="tab">Cameras and Accessories</a>
          <a class="list-group-item list-group-item-action" href="gaming-equipment" role="tab">Gaming Devices</a>
          <a class="list-group-item list-group-item-action" href="laptops-accessories" role="tab">Laptops and Accessories</a>            
          <a class="list-group-item list-group-item-action active" href="sports-equipment" role="tab">Sports Equipment</a>            
          <a class="list-group-item list-group-item-action" href="misc-equipment" role="tab">Miscellaneous</a>
      </div>
    </div>
    
    <div class="col-md-9 mt-2">
      @if(Auth::user()->access_role == "ADMIN")
      <div class="addEdit float-left">
        <button type="button" name="addEquip" class="btn btn-sm btn-light" data-toggle="modal" data-target="#addEquip"><img id="plus" src="{{ asset('img/plus.png') }}" height=18;> Add Equipment</button>
        <button type="button" name="delEquip" class="btn btn-sm btn-light" data-toggle="modal" data-target="#delEquip"><img id="minus" src="{{ asset('img/minus.png') }}" height=18;> Delete Equipment</button>
        @include('inc.addEquipModal')
        @include('inc.delEquipModal')
      </div>
      @endif
      <div class="dropdown float-right mb-1">
        <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Show 12
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </div>
      <hr style="clear:both;">
      <div class="d-inline-flex flex-row flex-wrap align-items-center justify-content-start">
          @foreach ($equipments->unique('equip_name') as $equipment)
          <div class="card text-center mt-1 pt-3 mr-1">
            <span class="badge badge-success ml-3 w-25">In stock</span>
            <img src="{{ asset('img/'.$equipment->equip_img) }}" class="card-img-top align-self-center" alt="Item photo">
            <div class="card-body">
              @if(Auth::user()->access_role == "ADMIN")
              <a class="card-link" href="{{ url('admin/'.$equipment->equipID) }}"><h6 class="card-title text-truncate">{{$equipment->equip_name}}</h6></a>
              @else
                  <a class="card-link" href="{{ url('student/'.$equipment->equipID) }}"><h6 class="card-title text-truncate">{{$equipment->equip_name}}</h6></a>
              @endif
              <p class="card-text mb-4">
                Availability: 
                @foreach ($countCurrAvail as $item)
                  @if (Arr::get($item, 'equip_name') == $equipment->equip_name)
                    {{Arr::get($item, 'record')}}
                  @endif
                @endforeach 
                /
                @foreach ($countTotalAvail as $item)
                  @if (Arr::get($item, 'equip_name') == $equipment->equip_name)
                    @if (Arr::get($item, 'record') == '')
                        0
                    @else
                      {{Arr::get($item, 'record')}}
                    @endif
                  @endif
                @endforeach
              </p>
            </div>
          </div>
          @endforeach
      </div>
      <div class="pagination d-block position-absolute mt-3" style="right:20px">
        {{ $equipments->links() }}
      </div>
    </div>
  </div>
@endsection

@section('modal')
    {{-- @include('inc.deleteConfirmationModal') --}}
@endsection