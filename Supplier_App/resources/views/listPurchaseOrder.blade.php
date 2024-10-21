@extends('master')
@section('content')
<div class="container">
    @if(session('message'))
    <div class="alert alert-success" role="alert" id="successDiv">
      {{session('message')}}
    </div>
    @endif
    <div class="row pt-3" style="justify-content: end;">
        <a  href="#" class="btn btn-primary me-2 w-a">Export</a>
        <a  href="#" class="btn btn-primary me-2 w-a">Print</a>
    </div>

    <div class="row px-0 pt-5">
        <table class="table table-striped">
            <thead>
                <th>Item Name</th>
                <th>Stock Unit</th>
                <th>Unit Price</th>
                <th>Order Qty</th>
                <th>Item Amount</th>
                <th>Discount</th>
                <th>Net Amount</th>
            </thead>
            <tbody>
                @foreach ($purchaseOrderdata as $orderData)
                    <tr>
                        <td>{{$orderData->item_name}}</td>
                        <td>{{$orderData->stock_unit}}</td>
                        <td>{{$orderData->unit_price}}</td>
                        <td>{{$orderData->item_total_no}}</td>
                        <td>{{$orderData->item_total}}</td>
                        <td>{{$orderData->discount}} %</td>
                        <td>{{$orderData->net_amount}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection