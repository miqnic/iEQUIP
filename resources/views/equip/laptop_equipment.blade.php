@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | Laptops and Accessories</title>
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
          <a class="list-group-item list-group-item-action active" href="laptops-accessories" role="tab">Laptops and Accessories</a>            
          <a class="list-group-item list-group-item-action" href="sports-equipment" role="tab">Sports Equipment</a>            
          <a class="list-group-item list-group-item-action" href="misc-equipment" role="tab">Miscellaneous</a>
      </div>
    </div>
    
    <div class="col-md-9 mt-2">
      @if(Auth::user()->access_role == "ADMIN")
      <div class="addEdit float-left mb-2">
        <button type="button" name="addEquip" class="btn btn-sm btn-light"><a href="add" class="text-dark"><i class="fas fa-lg fa-plus-circle text-success"></i> Add Equipment</a></button>
        <button type="button" name="delEquip" class="btn btn-sm btn-light" data-toggle="modal" data-target="#delEquip"><i class="fas fa-lg fa-minus-circle text-danger"></i> Delete Equipment</button>
        @include('inc.addEquipModal')
        @include('inc.delEquipModal')
      </div>
      @else
      <div class="pt-1">
        <h5>Laptops and Accessories</h5>
      </div>
      @endif
      <hr style="clear:both;">
      <div class="d-inline-flex flex-row flex-wrap align-items-center justify-content-start">
          @foreach ($equipments->unique('equip_name') as $equipment)
          <div class="card itemCard text-center mt-1 pt-3 mr-1">
            @foreach ($countEquip as $itemCurr)
              @if (Arr::get($itemCurr, 'equip_name') == $equipment->equip_name)
                  @if(Arr::get($itemCurr, 'total') == Arr::get($itemCurr, 'unavail'))
                  <span class="badge stockStat badge-danger ml-3">Out of stock</span>
                  @elseif(Arr::get($itemCurr, 'total')/2 >= Arr::get($itemCurr, 'avail'))
                  <span class="badge stockStat badge-warning ml-3">Low in stock</span>
                  @else 
                  <span class="badge stockStat badge-success ml-3">In stock</span>
                  @endif
              @endif
            @endforeach 
            <img src="{{ asset('img/'.$equipment->equip_img) }}" class="card-img-top align-self-center" alt="Item photo">
            <div class="card-body">
              @php
                $spaces = '/\s+/';
                $replace = '-';
                $string= $equipment->equip_name;
                $trimmedString = preg_replace($spaces, $replace, $string);
              @endphp
              @if(Auth::user()->access_role == "ADMIN")
              <a class="card-link" href="{{ url('admin/'.$trimmedString) }}"><h6 class="card-title text-truncate">{{$equipment->equip_name}}</h6></a>
              @else
                  <a class="card-link" href="{{ url('student/'.$trimmedString) }}"><h6 class="card-title text-truncate">{{$equipment->equip_name}}</h6></a>
              @endif
              <p class="card-text mb-4">
                  Availability: 
                  @foreach ($countEquip as $item)
                    @if (Arr::get($item, 'equip_name') == $equipment->equip_name)
                      {{Arr::get($item, 'avail')}} / {{Arr::get($item, 'total')}}
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