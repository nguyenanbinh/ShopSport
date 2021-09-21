<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CheckoutRequest;
use App\Order;
use App\OrderProduct;
use App\Product;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function getCartEmpty()
    {
        return view('cart.empty');
    }

    public function getCheckout()
    {
        return view('cart.cart');
    }


    public function order(CheckoutRequest $Request)
    {


        try {
            DB::beginTransaction();
            $data = $Request->only('name', 'email', 'phone', 'address', 'user_id', 'note','status_id');
            // dd($data);
            $order = Order::create($data);

            // dd($orders);
            // $cart = json_decode($Request->cart);
            // dd($data);
            // return $cart;
            foreach ($Request->cart as $key => $item) {

                OrderProduct::create([
                    'order_id' => $order->id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'] * $item['quantity'],
                    'product_id' => $item['id']
                ]);

                // DB::enableQueryLog();
                // Product::find($item['id'])->update(['quantity' => 'quantity'- $item['quantity']]);
                // dd(DB::getQueryLog());

                // $product = Product::find($item['id']);
                // $product->quantity = ($product['quantity'] -= $item['quantity']);
                // $product->save();
            }
            $order = Order::with('products')->where('user_id', $order->id)->get();
            // $orderDetail = OrderProduct::where('order_id',$order->id)->get();
            // // dump($products);
            // // $data['products'] = $products;
            // $data['orderDetail'] = $orderDetail->toArray();
            $data['order'] = $order->toArray();

            $to_email = $data['email'];
            $to_name = $data['name'];
            $from_email = 'nhi12299@gmail.com';
            Mail::send('mail.order-confirm', $data, function ($message) use ($to_email, $to_name, $from_email) {
                $message->to($to_email, $to_name)->subject('Contact Mail');
                $message->from($from_email, 'Shop-Sport');
            });

            DB::commit();
            return response()->json(['success' => 'Successful'], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['fail' => 'fail'], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
