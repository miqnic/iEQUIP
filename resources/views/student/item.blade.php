@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | {{$item->equip_name}}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/equiplist.css') }}">
    <script>
        $(document).ready(function() {
            $('#itemStock').DataTable({
                "ordering": false
            });
        });

        $(document).ready(function () {
            $('.selectSubmit').hide();
            $("input:checkbox").prop('checked', false);
            $('.indiv').show();
            $('.hide').hide();
            $('#triggerSelect').click(function () {  
                var $this = $(this);
                $this.toggleClass('selectLabel');
                if($this.hasClass('selectLabel')){
                $('.selectSubmit').hide(); 
                $('.hide').hide(); 
                $('.indiv').show();
                $this.text('Select');			
                } 
                else {
                $('.hide').show(); 
                $("input:checkbox").prop('checked', false);
                $('.indiv').hide();
                $('.selectSubmit').show();
                $this.text('Cancel');
                }
            });  
        }); 
    </script>
@endsection

@section('navi')
    @include('inc.naviStudent', [$totalEquip, $lastTransaction, $countCart])
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
    
    <div class="col-md-9">
        <div class="media">
            <img class="itemPhoto align-self-center border mr-3 mt-2 py-3 px-4" src="{{ asset('img/'.$item->equip_img) }}" style="width: 230px;" alt="Sample photo">
            <div class="media-body mt-4">
                <span class="text-muted displayCategory">
                    @if($item->equip_category=='ART')
                        Art Tools
                    @elseif($item->equip_category=='CAMACC')
                        Cameras and Accessories
                    @elseif($item->equip_category=='GMNG')
                        Gaming Devices
                    @elseif($item->equip_category=='LPTP')
                        Laptops and Accessories
                    @elseif($item->equip_category=='SPRT')
                        Sports Equipment
                    @else 
                        Miscellaneous
                    @endif
                </span>
                <h4 class="displayEquipName">{{$item->equip_name}}</h4>
                <p class="displayDesc text-muted pt-2 description text-justify">{{$item->equip_description}}</p>
            </div>
        </div>
        
        <div class="items mt-4 mx-auto">
            <table class="table table-hover table-striped table-bordered" id="itemStock">
                <thead class="text-center">
                    <tr>
                        <th class="align-middle"><button type="button" class="btn btn-sm btn-secondary mb-2" id="triggerSelect">Select</button></th>
                        <th class="align-middle">Equipment</th>
                        <th class="align-middle">Status</th>
                        <th class="align-middle">Remarks</th>
                        <th class="align-middle">Option</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($totalEquip as $equipment)
                    @if($equipment->equip_name==$item->equip_name)
                    <tr>
                        <td class="align-middle"><input type="checkbox" id="qtyCheck" class="hide"></td>
                        <td class="align-middle">{{$equipment->equipID}}</td>
                        <td class="align-middle">
                            @if($equipment->equip_avail==0)
                                Available
                            @else
                                Reserved
                            @endif
                        </td>
                        <td class="align-middle">Enter specifications here</td>
                        <td class="align-middle">
                        {{--{!! Form::open(['action' => 'EquipmentsController@reserveEquipment', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        {{Form::submit('Reserve', ['class' => 'btn btn-success'])}}
                        {{Form::hidden('currentEquipID', $equipment_modal->equipID)}}
                        {{Form::hidden('userID', Auth::user()->user_id)}}
                        {!! Form::close() !!} --}}
                        <form action="EquipmentsController@reserveEquipment" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="currentEquipID" value="{{$equipment->equipID}}">
                            <input type="hidden" name="userID" value="{{Auth::user()->user_id}}">
                            <button type="submit" class="btn btn-sm btn-primary indiv"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                        </form>
                            
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            <button type="button" class="btn btn-sm btn-primary selectSubmit float-right" style="margin-top: -35px; margin-right: 200px;"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
        </div>
    </div>
</div>
@endsection
{{-- 
@section('modal')
    @include('inc.deleteSingleModal')
    @include('inc.deleteConfirmationModal')
@endsection --}}