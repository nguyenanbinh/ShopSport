<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\Product;

use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function __construct()
    {
        // $this->middleware('is.admin');
    }
    public function showOrder(){
        $orders = Order::with(['products'])->get();
        // dd($orders->toArray());
        return view('admin.orders.list',compact('orders'));
    }

    public function viewOrder(Request $request){
        if($request->ajax()){
            $orders = Order::with(['products'])->get();
            
            $html = view('admin.components.order',compact(['orders']))->render();
            // foreach($orders as $order){
            //     dd($order->products->toArray());
            // }
            
            return response()->json($html);
        }
    }

   

    public function actionOrder($id){
        $order = Order::with('products')->find($id);
        // dd($order->products->toArray());
        if($order){
            foreach ($order->products as  $ord) {
                $product =Product::find($ord->id);
                $product->quantity -= $ord->pivot->quantity;
                if($product->quantity>0){
                    $product->save();
                }
                
            }
        }
        
        $order->status_id =2;
        $order->save();

        return redirect()->back()->with('success','Order successfully approved!');
    }

    public function deleteOrder($id)
    {
        $order = Order::find($id);
        if($order->status_id>2){
            $order->delete();
            return redirect()->route('admin.orders.list')
        ->with('delete','Order deleted successfully!');
        }else{
            return redirect()->route('admin.orders.list')
        ->with('error','Cannot delete this order!');
        }
        
        
    }
}
