
    <div class="row px-0 pt-5">
        <h1 style="text-align: center;">Purchase Orders</h1>
        <table class="table table-striped">
            <thead>
                <tr style="background-color: #f2f2f2; color: #333;">
                    <th style="padding: 12px; border: 1px solid #ddd;" >Item Name</th>
                    <th style="padding: 12px; border: 1px solid #ddd;" >Stock Unit</th>
                    <th style="padding: 12px; border: 1px solid #ddd;" >Unit Price</th>
                    <th style="padding: 12px; border: 1px solid #ddd;" >Order Qty</th>
                    <th style="padding: 12px; border: 1px solid #ddd;" >Item Amount</th>
                    <th style="padding: 12px; border: 1px solid #ddd;" >Discount</th>
                    <th style="padding: 12px; border: 1px solid #ddd;" >Net Amount</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($purchaseOrderdata))
                    @foreach ($purchaseOrderdata as $orderData)
                        <tr>
                            <td style="padding: 12px; border: 1px solid #ddd;">{{$orderData->item_name}}</td>
                            <td style="padding: 12px; border: 1px solid #ddd;">{{$orderData->stock_unit}}</td>
                            <td style="padding: 12px; border: 1px solid #ddd;">{{$orderData->unit_price}}</td>
                            <td style="padding: 12px; border: 1px solid #ddd;">{{$orderData->item_total_no}}</td>
                            <td style="padding: 12px; border: 1px solid #ddd;">{{$orderData->item_total}}</td>
                            <td style="padding: 12px; border: 1px solid #ddd;">{{$orderData->discount}} %</td>
                            <td style="padding: 12px; border: 1px solid #ddd;">{{$orderData->net_amount}}</td>
                        </tr>
                    @endforeach
                @else 
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 12px; border: 1px solid #ddd;">No Data Found</td>
                        </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>