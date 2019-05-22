@foreach($equipments->unique('equip_name') as $equipment)
@php
    $spaces = '/\s*/m';
    $replace = '';

    $string= $equipment->equip_name;

    $trimmedString = preg_replace($spaces, $replace, $string);
@endphp
<div class="modal fade" id="addStockModal-{{$trimmedString}}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

        <div class="modal-header">
            <h4 class="modal-title">Add New Stock</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        {!! Form::open(['action' => 'EquipmentsController@addStock', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        @csrf
        <div class="modal-body">
                <div class="form-group">
                    {{Form::label('quantity', 'Quantity')}}
                    {{Form::hidden('itemName', $equipment->equip_name)}}
                    {{Form::text('quantity', '',['class' => 'form-control', 'placeholder' => 'Enter quantity', 'required' => ''])}}
                </div>

                <div class="form-group">
                    <label class="pt-3" for="remarks">Remarks</label>
                    {{Form::textarea('description', '',['class' => 'form-control', 'placeholder' => 'Enter specifications here', 'required' => ''])}}   
                </div> 
        </div>

        <div class="modal-footer">
            
            {{Form::submit('Add Stock', ['class' => 'btn btn-success'])}}
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
        </div>
        {!! Form::close() !!}
        </div>
    </div>
</div>
@endforeach