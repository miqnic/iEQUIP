@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | Delete Equipment</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/equiplist.css') }}">

    <script>
    $(document).ready(function() {
        $('#equipList').DataTable({
            order: [[1, "asc"]],
            columnDefs: [
                    {
                        orderable: false,
                        targets: 0
                    }
                ]
        });
    });
    </script>
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
        <a class="list-group-item list-group-item-action" href="sports-equipment" role="tab">Sports Equipment</a>            
        <a class="list-group-item list-group-item-action" href="misc-equipment" role="tab">Miscellaneous</a>
      </div>
    </div>
    
    <div class="col-md-9 mt-2">
        <div class="pt-1">
        <h5>Delete Equipment</h5>
        </div>
        <hr style="clear:both;">
        <div class="items mt-4 mx-auto">
            <table class="table table-hover table-striped table-bordered" id="equipList">
                <thead class="text-center">
                    <tr>
                        <th>Select</th>
                        <th class="align-middle">Category</th>
                        <th class="align-middle">Equipment Name</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($equipments->unique('equip_name') as $equipment)
                    <tr>
                        <td class="align-middle">
                            {{ Form::checkbox('selectDelete[]', "$equipment->equipID", null, array('id'=>'qtyCheck')) }}
                        </td>
                        <td class="align-middle">
                            @if($equipment->equip_category=='ART')
                                Art Tools
                            @elseif($equipment->equip_category=='CAMACC')
                                Cameras and Accessories
                            @elseif($equipment->equip_category=='GMNG')
                                Gaming Devices
                            @elseif($equipment->equip_category=='LPTP')
                                Laptops and Accessories
                            @elseif($equipment->equip_category=='SPRT')
                                Sports Equipment
                            @else 
                                Miscellaneous
                            @endif
                        </td>
                        <td class="align-middle">{{$equipment->equip_name}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-xs-1 mx-auto">
                    {{Form::button('Delete Selected', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger'])}}
                </div>
            </div>
        </div>
    </div>
@endsection