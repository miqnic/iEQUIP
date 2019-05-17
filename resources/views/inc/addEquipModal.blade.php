<div class="modal fade" id="addEquip" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

        <div class="modal-header">
            <h4 class="modal-title">Add Equipment</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        {!! Form::open(['action' => 'EquipmentsController@addEquipment', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        @csrf
        <div class="modal-body">
                <div class="form-group">
                    {{Form::label('itemName', 'Item Name')}}
                    {{Form::text('itemName', '',['class' => 'form-control', 'placeholder' => 'Enter Item Name', 'required' => ''])}}
                    <div class="row">
                        <div class="col-md-4">
                            {{Form::label('category', 'Category')}}
                            {{Form::select('category', array(
                                'CAMACC' => 'Cameras & Accessories',
                                'ART' => 'Art Tools',
                                'SPRT' => 'Sports Equipment',
                                'GMNG' => 'Gaming Devices',
                                'LPTP' => 'Laptops & Accessories',
                                'MISC' => 'Miscellaneous Equipment'), NULL, array('class' => 'form-control', 'required' => ''))}}

                        </div>
                        <div class="col-md-4">
                            {{Form::label('basePrice', 'Base Price (PHP)', ['class' => 'pt-3'])}}
                            {{Form::text('basePrice', '',['class' => 'form-control', 'placeholder' => 'Enter Base Price', 'required' => ''])}}
                        </div>
                        <div class="col-md-4">
                            {{Form::label('penalty', 'Penalty Fee (PHP)', ['class' => 'pt-3'])}}
                            {{Form::text('penalty', '',['class' => 'form-control', 'placeholder' => 'Enter Penalty Price', 'required' => ''])}}
                        </div>
                    </div>

                    {{Form::label('description', 'Specifications')}}
                    {{Form::textarea('description', '',['id' => 'article-ckeditor','class' => 'form-control', 'placeholder' => 'Enter specifications here', 'required' => ''])}}      

                    <div class="row">
                        <div class="col-md-4">
                            <!--Form::label('totalAmount', 'Item Quantity', ['class' => 'pt-3'])
                            Form::text('totalAMount', '',['class' => 'form-control', 'placeholder' => 'Enter Item Quantity'])-->
                        </div>
                        <div class="col-md-6">
                            {{Form::label('equipIMG', 'Specifications',['class' => 'pt-3'])}}
                            {{Form::file('equipIMG')}}
                        </div>
                        
                    </div>
                </div>
            
        </div>

        <div class="modal-footer">
            
                {{Form::submit('Add Equipment', ['class' => 'btn btn-success'])}}
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
        </div>
        {!! Form::close() !!}
        </div>
    </div>
</div>