@extends('master')
@section('content')
<div class="container">
    <style>
        .w-a{
            width: auto;
        }
    </style>
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
        <a  href="#" class="btn btn-primary addSupplier me-2 w-a" data-toggle="modal" data-target ="#addSupplier">Add Supplier</a>
    </div>

    <div class="row px-0 pt-5">
        <table class="table table-striped">
            <thead>
                <th scope="col">Supplier Name</th>
                <th scope="col">Address</th>
                <th scope="col">TAX No</th>
                <th scope="col">Country</th>
                <th scope="col">Mobile No</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
            </thead>
            <tbody>
                @if(!$supplierData->isEmpty())
                    @foreach ($supplierData as $data)
                        <td>{{$data->supplier_name}}</td>
                        <td>{{$data->address}}</td>
                        <td>{{$data->tax_no}}</td>
                        <td>{{$data->country}}</td>
                        <td>{{$data->mobile_no}}</td>
                        <td>{{$data->email}}</td>
                        <td>{{$data->status}}</td>
                    @endforeach
                @else
                    <td colspan="7" style="text-align: center"> No Data Found</td>
                @endif
            </tbody>
        </table>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="addSupplier">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Filter</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{route('addSupplier')}}">
          @csrf
        <div class="modal-body">
            <div class="form-group row pt-3">
              <label class="col-sm-4">Supplier Name :</label>
              <div class="col-sm-8">
                <input  type="text" name="supplierName" class="form-control" id="supplierName" placeholder="" required>
              </div>
          </div>
          <div class="form-group row pt-3">
            <label class="col-sm-4">Address :</label>
            <div class="col-sm-8">
                <input  type="text" name="supplierAddress" class="form-control" id="supplierAddress" placeholder="" required>
            </div>
        </div>

        <div class="form-group row pt-3">
          <label class="col-sm-4">Tax No :</label>
          <div class="col-sm-8">
            <input  type="text" name="taxNo" class="form-control" id="taxNo" placeholder="" required>
          </div>
        </div>

        <div class="form-group row pt-3">
            <label class="col-sm-4">Country :</label>
            <div class="col-sm-8">
                <select class="form-select " name="country" id="country" >
                    <option value="">--Country--</option>
                      <option value="india">India</option>
                      <option value="usa">USA</option>
                  </select>            
                </div>
          </div>

          <div class="form-group row pt-3">
            <label class="col-sm-4">Mobile No :</label>
            <div class="col-sm-8">
              <input  type="number" name="mobNo" class="form-control" id="mobNo" placeholder="" required maxlength="10">
            </div>
          </div>

          <div class="form-group row pt-3">
            <label class="col-sm-4">Email :</label>
            <div class="col-sm-8">
              <input  type="email" name="email" class="form-control" id="email" placeholder="" required>
            </div>
          </div>

          <div class="form-group row pt-3">
            <label class="col-sm-4">Status :</label>
            <div class="col-sm-8">
                <select class="form-select " name="category" id="category" >
                      <option value="Active" selected>Active</option>
                      <option value="InActive">InActive</option>
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

@endsection 