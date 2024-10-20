@extends('master')
@section('content')

<div class="container">
    @if(session('message'))
    <div class="alert alert-success" role="alert" id="successDiv">
      {{session('message')}}
    </div>
    @endif
    
    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
              {{ $error }}
            @endforeach
        </div>
    @endif
    
    <div class="row pt-3" style="justify-content: end;">
        <a  href="#" class="btn btn-primary addSupplier me-2 w-a" data-toggle="modal" data-target ="#addItem">Add Item</a>
    </div>

    <div class="row px-0 pt-5">
        <table class="table table-striped">
            <thead>
                <th>Item Name</th>
                <th>Inventory Location</th>
                <th>Brand</th>
                <th>Category</th>
                <th>Supplier</th>
                <th>Stock Unit</th>
                <th>Unit Price</th>
                <th>Item Images</th>
                <th>Status</th>
                <th>Action</th>
            </thead>
            <tbody>
                @if(!$itemData->isEmpty())
                    @foreach ($itemData as $item)
                    <tr>
                      <td>{{$item->item_name}}</td>
                      <td>{{$item->inventory_location}}</td>
                      <td>{{$item->brand}}</td>
                      <td>{{$item->category}}</td>
                      <td>{{$item->supplier->supplier_name}}</td>
                      <td>{{$item->stock_unit}}</td>
                      <td>{{$item->unit_price}}</td>
                      <td>
                        <table>
                          <tr>
                            @if(!empty($item->item_images))
                              @foreach ($item->item_images as $image)
                                  <td>
                                    <img src="{{ asset('uploads/' . $image) }}" alt="" width="100" height="100">
                                  </td>
                              @endforeach
                            @endif
                          </tr>
                        </table>
                      </td>
                      <td>{{$item->status}}</td>
                      <td>
                        <button class="btn btn-primary buyItemBtn" data-id="{{$item->item_no}}">Buy</button>
                      </td>
                    </tr>
                    @endforeach
                @else
                    <td colspan="9" style="text-align: center;">No data Found</td>
                @endif
            </tbody>
        </table>
    </div>
</div>


<div class="modal" tabindex="-1" role="dialog" id="addItem">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Filter</h5>
          <button type="button" class="close btn-light" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{route('addItem')}}" enctype="multipart/form-data">
          @csrf
        <div class="modal-body">
            <div class="form-group row pt-3">
              <label class="col-sm-4">Item Name :</label>
              <div class="col-sm-8">
                <input  type="text" name="itemName" class="form-control" id="itemName" placeholder="" required>
              </div>
          </div>
          <div class="form-group row pt-3">
            <label class="col-sm-4">Inventory Location :</label>
            <div class="col-sm-8">
                <input  type="text" name="inventoryLocation" class="form-control" id="inventoryLocation" placeholder="" required>
            </div>
        </div>

        <div class="form-group row pt-3">
          <label class="col-sm-4">Brand :</label>
          <div class="col-sm-8">
            <input  type="text" name="brand" class="form-control" id="brand" placeholder="" required>
          </div>
        </div>

        <div class="form-group row pt-3">
            <label class="col-sm-4">Category :</label>
            <div class="col-sm-8">
              <input  type="text" name="category" class="form-control" id="category" placeholder="" required>
            </div>
          </div>

        <div class="form-group row pt-3">
            <label class="col-sm-4">Supplier :</label>
            <div class="col-sm-8">
                <select class="form-select " name="supplierID" id="supplierID" required>
                    <option value="">--Supplier--</option>
                    @foreach ($supplierData as $supData)
                        <option value="{{$supData->supplier_no}}">{{$supData->supplier_name}}</option>
                    @endforeach
                  </select>            
                </div>
          </div>

          <div class="form-group row pt-3">
            <label class="col-sm-4">Stock Unit :</label>
            <div class="col-sm-8">
              <input  type="number" name="stockUnit" class="form-control" id="stockUnit" placeholder="" required maxlength="10">
            </div>
          </div>

          <div class="form-group row pt-3">
            <label class="col-sm-4">Unit Price :</label>
            <div class="col-sm-8">
              <input  type="number" name="unitPrice" class="form-control" id="unitPrice" placeholder="" required>
            </div>
          </div>

          
          <div class="form-group row pt-3">
            <label class="col-sm-4">Discount(%) :</label>
            <div class="col-sm-8">
              <input  type="number" name="discount" class="form-control" id="discount" placeholder="" required>
            </div>
          </div>

          <div class="form-group row pt-3">
            <label class="col-sm-4">Item Images :</label>
            <div class="col-sm-8">
                <input type="file" name="itemImages[]" multiple class="form-control">
            </div>
          </div>

          <div class="form-group row pt-3">
            <label class="col-sm-4">Status :</label>
            <div class="col-sm-8">
                <select class="form-select " name="status" id="status" >
                      <option value="Enabled" selected>Enabled</option>
                      <option value="Disabled">Disabled</option>
                  </select>            
                </div>
          </div>

        </div>
        <div class="modal-footer">
          <input type="hidden" name="from" value="filter">
          <button type="submit" class="btn btn-primary" id ="addSupplierbtn">Submit </button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
      </div>
    </div>
  </div>


  <div class="modal" tabindex="-1" role="dialog" id="buyItemModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Buy This Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{route('itemBuy')}}">
          @csrf
        <div class="modal-body">
            <div class="form-group row pt-3">
              <label class="col-sm-4">Supplier Name :</label>
              <div class="col-sm-8">
                <input  type="text" name="supplierName" class="form-control" id="supplierName" placeholder="" readonly>
                <input type="hidden" name="itemSupplierID" id="itemSupplierID">
                <input type="hidden" name="itemID" id="itemID">
              </div>
          </div>

        <div class="form-group row pt-3">
            <label class="col-sm-4">Select Number Of Items :</label>
            <div class="col-sm-8">
                <select class="form-select " name="numberOfItem" id="numberOfItem" required>
                    <option value="">--number--</option>
                  </select>            
                </div>
          </div>

          <div class="form-group row pt-3">
            <label class="col-sm-4">Item Total :</label>
            <div class="col-sm-8">
              <input  type="number" name="itemTotal" class="form-control" id="itemTotal" placeholder="" readonly>
              <input type="hidden" name="itemUnitPrice" id="itemUnitPrice">
            </div>
          </div>

          <div class="form-group row pt-3">
            <label class="col-sm-4">Discount(%) :</label>
            <div class="col-sm-8">
              <input  type="text" name="itemDiscount" class="form-control" id="itemDiscount" placeholder="" readonly>
            </div>
          </div>


          <div class="form-group row pt-3">
            <label class="col-sm-4">Net Amount :</label>
            <div class="col-sm-8">
              <input  type="number" name="netAmount" class="form-control" id="netAmount" placeholder="" readonly>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id ="addSupplierbtn">Buy Now </button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
      </div>
    </div>
  </div>


  <script>
    $(document).ready(function(){
      $(document).on('click','.buyItemBtn',function(){
        var itemId = $(this).data('id');
        $.ajax({
          url:'{{route('getItemPurchaseDetails')}}',
          type: 'POST',
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
          data:{
            itemId:itemId,
          },
          success:function(response){
            $('#itemSupplierID').val(response.itemData.supplier.supplier_no);
            $('#supplierName').val(response.itemData.supplier.supplier_name);
            $('#itemDiscount').val(response.itemData.discount);
            $('#itemUnitPrice').val(response.itemData.unit_price);
            $('#itemID').val(response.itemData.item_no);
            var stock_unit = response.itemData.stock_unit;
            var selectItem = '';
            for(var i = 1; i <= stock_unit; i++){
              selectItem +='<option value="'+i+'">'+i+'</option>';
            }
            $('#numberOfItem').append(selectItem);
            $('#buyItemModal').modal('show');

          },
        });
      });

      $(document).on('change','#numberOfItem',function(){
        var numOfItm = $(this).val();
        var itemUnitPrice = $('#itemUnitPrice').val();
        var itemDiscount = $('#itemDiscount').val();
        var discountPercentage = $('#itemDiscount').val();
        var itemTotal = parseFloat(numOfItm) * parseFloat(itemUnitPrice);
        $('#itemTotal').val(itemTotal);
        var discountAmount = (discountPercentage / 100) * itemTotal;
        var netAmount = itemTotal - discountAmount;
        $('#netAmount').val(netAmount);

      });
    });
  </script>
@endsection
