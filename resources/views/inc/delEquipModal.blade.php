{!! Form::open(['action' => 'EquipmentsController@delEquipment', 'method' => "POST", 'enctype' => 'multipart/form-data']) !!}
@csrf
<div class="modal fade" id="delEquip" tabindex="-1">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
    
            <div class="modal-header">
                <h4 class="modal-title">Delete Equipment</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
    
            <div class="modal-body">
                <small class="py-2">Select the item/s to be deleted.</small>
                <table class="table table-bordered table-responsive-sm text-center">
                <thead>
                    <tr>
                    <th></th>
                    <th>Equipment Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($equipments->unique('equip_name') as $equipment)
                        <tr>
                            <td class="align-middle">
                                <div class="checkbox pt-1">
                                        
                                <label>{{Form::checkbox("checkbox-$equipment->equip_name","$equipment->equip_name")}}</label>
                                </div>
                            </td>
                            <td class="align-middle">{{$equipment->equip_name}}</td>
                            {{Form::hidden('inputEquipCategory', $equipment->equip_category )}}
                        </tr>
                    @endforeach
                    <!--<tr>
                    <td class="align-middle">
                        <div class="checkbox pt-1">
                        <label><input type="checkbox" value=""></label>
                        </div>
                    </td>
                    <td class="align-middle">Wacom Intuos Pro Tablet</td>
                    </tr>
                    <tr>
                    <td class="align-middle">
                        <div class="checkbox pt-1">
                        <label><input type="checkbox" value=""></label>
                        </div>
                    </td>
                    <td class="align-middle">Wacom Bamboo Ink Stylus</td>
                    </tr>-->
                </tbody>
                </table>
            </div>
    
            <div class="modal-footer">
                {{Form::submit('Delete Equipment', ['class' => 'btn btn-danger'])}}
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
            </div>
    
            </div>
        </div>
        </div>
{!! Form::close() !!}