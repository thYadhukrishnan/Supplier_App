@extends('master')
@section('content')
<div class="container">
    @if(session('message'))
    <div class="alert alert-success" role="alert" id="successDiv">
      {{session('message')}}
    </div>
    @endif
    <div class="row pt-3" style="justify-content: end;">
        <a  href="{{route('printOrder')}}" class="btn btn-danger me-2 w-a">Print</a>
        <a  href="{{route('exportOrder')}}" class="btn btn-primary me-2 w-a">Export</a>
    </div>

    <div class="row px-0 pt-5">
        <table class="table table-striped">
            <thead>
                <th>#</th>
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
                        <td>{{$purchaseOrderdata->firstItem() + $loop->index}}</td>
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
        <div class="d-flex justify-content-between">
            <div>
                Showing {{ $purchaseOrderdata->firstItem() }} to {{ $purchaseOrderdata->lastItem() }} of {{ $purchaseOrderdata->total() }} results
            </div>
            <div>
                {{ $purchaseOrderdata->links() }} <!-- Bootstrap 4 pagination -->
            </div>
        </div>
</div>
@endsection