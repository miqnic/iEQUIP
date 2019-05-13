<div class="modal fade" id="editItemModal-{{$equipment->equipID}}" tabindex="-1">
        <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
            <h4 class="modal-title">Edit Item Details</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
            <form>
                <label for="itemName">Item Name</label>
                <input type="text" class="form-control" id="itemName" placeholder="Enter item name" value="{{$equipment->equip_name}}">
                <div class="row">
                <div class="col-md-4">
                    <label class="pt-3" for="category">Category</label>
                    <select id="category" class="form-control">
                        @if ($equipment->equip_category == "CAMACC")
                            <option selected>Cameras & Accessories</option>
                            <option>Art Tools</option>
                            <option>Sports Equipment</option>
                            <option>Gaming Devices</option>
                            <option>Laptops & Accessories</option>
                            <option>Miscellaneous</option>
                        @elseif ($equipment->equip_category == "ART")
                            <option>Cameras & Accessories</option>
                            <option selected>Art Tools</option>
                            <option>Sports Equipment</option>
                            <option>Gaming Devices</option>
                            <option>Laptops & Accessories</option>
                            <option>Miscellaneous</option>
                        @elseif ($equipment->equip_category == "SPRT")
                            <option>Cameras & Accessories</option>
                            <option>Art Tools</option>
                            <option selected>Sports Equipment</option>
                            <option>Gaming Devices</option>
                            <option>Laptops & Accessories</option>
                            <option>Miscellaneous</option>
                        @elseif ($equipment->equip_category == "MISC")
                            <option>Cameras & Accessories</option>
                            <option>Art Tools</option>
                            <option>Sports Equipment</option>
                            <option>Gaming Devices</option>
                            <option>Laptops & Accessories</option>
                            <option selected>Miscellaneous</option>
                        @elseif ($equipment->equip_category == "LPTP")
                            <option>Cameras & Accessories</option>
                            <option>Art Tools</option>
                            <option>Sports Equipment</option>
                            <option>Gaming Devices</option>
                            <option selected>Laptops & Accessories</option>
                            <option>Miscellaneous</option>    
                        @else
                            <option>Cameras & Accessories</option>
                            <option>Art Tools</option>
                            <option>Sports Equipment</option>
                            <option selected>Gaming Devices</option>
                            <option>Laptops & Accessories</option>
                            <option>Miscellaneous</option>     
                        @endif
                        
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="pt-3" for="remarks">Base Price (PHP)</label>
                    <input type="text" class="form-control" id="itemName" placeholder="Enter amount" value="{{$equipment->equip_baseprice}}">
                </div>
                <div class="col-md-4">
                    <label class="pt-3" for="remarks">Penalty Fee (PHP)</label>
                    <input type="text" class="form-control" id="penalty" placeholder="Enter amount" value="{{$equipment->equip_penalty}}">
                </div>
                </div>
                    <label class="pt-3" for="remarks">Specifications</label>
                    <textarea class="form-control" name="remarks" rows="5" placeholder="Enter specifications here"></textarea>
                <div class="row">
                <div class="col-md-4">
                <label class="pt-3" for="remarks">Item Quantity</label>
                <input type="text" class="form-control" id="itemName" placeholder="Enter quantity" value=
                    @foreach ($countTotalAvail as $item)
                        @if (Arr::get($item, 'equip_name') == $equipment->equip_name)
                            {{Arr::get($item, 'record')}}
                        @endif
                    @endforeach
                >
                </div>
                <div class="col-md-4">
                    <label class="pt-3" for="itemImage">Item Image</label>
                    <input type="file">
                </div>
                </div>
            </form>
            </div>

            <div class="modal-footer">
            <button type="submit" class="btn btn-success" data-target="#confirmEquipChanges" data-dismiss="modal" data-toggle="modal">Save Changes</button>

            @include('inc.confirmEquipChangesModal', $equipment)

            <button type="button" class="btn btn-outline-secondary" data-target="#itemList-{{$equipment->equipID}}" data-dismiss="modal" data-toggle="modal">Cancel</button>
            </div>
        </div>
        </div>
    </div>