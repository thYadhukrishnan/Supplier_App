<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SupplierController extends Controller
{
    public function listSupplier(){
        $supplierData = Supplier::get();
        return view('listSupplier',compact('supplierData'));
    }

    public function addSupplier(Request $request){
        $validatedData = $request->validate([
            'supplierName' => 'required',
            'supplierAddress' => 'required',
            'taxNo' => 'required',
            'country' => 'required',
            'mobNo' => 'required|numeric',
            'email' => 'required|email',
        ]);
        $supplier = new Supplier();
        $supplier->supplier_name = $validatedData['supplierName'];
        $supplier->address = $validatedData['supplierAddress'];
        $supplier->tax_no = $validatedData['taxNo'];
        $supplier->country = $validatedData['country'];
        $supplier->mobile_no = $validatedData['mobNo'];
        $supplier->email = $validatedData['email'];
        $supplier->save();

        return redirect()->route('listSupplier')->with('message','Supplier Added');

    }

    public function listItem(){
        $itemData = Item::with('supplier')->get();
        foreach($itemData as $item){
            if (!empty($item->item_images)) {
                $item->item_images = explode(',', $item->item_images);
            } else {
                $item->item_images = [];
            }
        }
        $supplierData = Supplier::where('status','Active')->get();
        return view('listItem',compact('itemData','supplierData'));
    }

    public function addItem(Request $request){

        $itemName = $request->input('itemName');
        $inventoryLocation = $request->input('inventoryLocation');
        $brand = $request->input('brand');
        $category = $request->input('category');
        $stockUnit = $request->input('stockUnit');
        $unitPrice = $request->input('unitPrice');
        $status = $request->input('status');
        $supplierID = $request->input('supplierID');
        $discount   = $request->input('discount');
        $filenames = '';
// return $request;
       if( $request->hasFile('itemImages') ){
            foreach($request->file('itemImages') as $image){
                // return $image->getClientOriginalExtension();
                if(in_array($image->getClientOriginalExtension(), ['jpeg', 'png', 'jpg', 'gif'])){
                    $filename = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('uploads'), $filename);
                    $filenames .= $filename.',';
                }
            }
       }

       $filenames = rtrim($filenames, ',');

       $items = new Item();
       $items->item_name = $itemName;
       $items->inventory_location = $inventoryLocation;
       $items->brand = $brand;
       $items->category = $category;
       $items->supplier_id = $supplierID;
       $items->stock_unit = $stockUnit;
       $items->unit_price = $unitPrice;
       $items->item_images = $filenames;
       $items->status = $status;
       $items->discount = $discount;
       $items->save();

       return redirect()->route('listItem')->with('message','Item Added.');

    }

    public function getItemPurchaseDetails(Request $request){
        $itemID = $request->input('itemId');
        $itemData = Item::with('supplier')->where('item_no',$itemID)->first();
        if (!empty($itemData->item_images)) {
            $itemData->item_images = explode(',', $itemData->item_images);
        } else {
            $itemData->item_images = [];
        }
        return response()->json([
            'itemData'=> $itemData,
        ]);
    }

    public function itemBuy(Request $request){

        $itemID = $request->input('itemID');
        $itemSupplierID = $request->input('itemSupplierID');
        $numberOfItem = $request->input('numberOfItem');
        $itemTotal = $request->input('itemTotal');
        $itemUnitPrice = $request->input('itemUnitPrice');
        $itemDiscount = $request->input('itemDiscount');
        $netAmount = $request->input('netAmount');

        $purchaseOrder = new PurchaseOrder();
        $purchaseOrder->order_date = Carbon::now();
        $purchaseOrder->supplier_id = $itemSupplierID;
        $purchaseOrder->item_id = $itemID;
        $purchaseOrder->item_total = $itemTotal;
        $purchaseOrder->discount = $itemDiscount;
        $purchaseOrder->net_amount = $netAmount;
        $purchaseOrder->item_total_no = $numberOfItem;
        $purchaseOrder->save();

        $itemData = Item::where('item_no',$itemID)->first();
        $newStock_unit = $itemData->stock_unit - $numberOfItem;

        Item::where('item_no',$itemID)->update([
            'stock_unit'=>$newStock_unit,
        ]);

        return redirect()->route('listItem')->with('message','Item Purchased');
    }

    public function listPurchaseOrder(){

        $purchaseOrderdata = DB::table('purchase_orders as po')
                            ->join('items','items.item_no','=','po.item_id')
                            ->join('suppliers','suppliers.supplier_no','=','po.supplier_id')
                            ->orderBy('po.order_date','desc')
                            ->get();
        
        return view('listPurchaseOrder',compact('purchaseOrderdata'));
    }
}
