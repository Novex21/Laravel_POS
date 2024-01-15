<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Models\Order_Detail;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $orders = Order::all();
        //Last order details
        $lastID = Order_Detail::max('order_id');
        $order_receipt = Order_Detail::where('order_id', $lastID)->get();
        return view('orders.index',
        [
            'products' => $products,
            'orders' => $orders,
            'order_receipt' => $order_receipt,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        DB::beginTransaction();
        //Order Modal
        $orders = new Order();
        $orders->name = $request->customer_name;
        $orders->address = $request->customer_phone;
        $orders->save();
        $order_id = $orders->id;


        //Order Detail Model
        for ($count=0; $count < count($request->product_id) ; $count++) {
            $order_details = new Order_Detail();
            $order_details->order_id = $order_id;
            $order_details->product_id =$request->product_id[$count];
            $order_details->unitprice = $request->price[$count];
            $order_details->quantity = $request->quantity[$count];
            $order_details->amount = $request->total_amount[$count];
            $order_details->discount = $request->discount[$count];
            $order_details->save();
        }

        //Reduce Stock
        $stocks = Order_Detail::where('order_id', $order_id)->get();

        foreach($stocks as $stock) {
            $product_id = $stock->product_id;
            $product_qty = $stock->quantity;

            Product::where('id', $product_id)->update([
                'quantity' => DB::raw("quantity - $product_qty")
            ]);
        }



        //Transaction Model
        $transactions = new Transaction();
        $transactions->order_id = $order_id;
        $transactions->paid_amount =$request->paid_amount;
        $transactions->balance = $request->balance;
        $transactions->payment_method = $request->payment_method;
        $transactions->transac_date = date('Y-m-d');
        //Total amount in cart
        $items = Order_Detail::where('order_id',$order_id)->get();
        $transactions->transac_amount = $items->sum('amount');

        $transactions->user_id = auth()->user()->id;
        $transactions->save();
        DB::commit();

        Cart::where('user_id',auth()->user()->id)->delete();

        //Last Order History

        $products = Product::all();
        $orderBy = Order::where('id',  $order_id)->get();
        $lastID = Order_Detail::max('order_id');
        $order_receipt = Order_Detail::where('order_id', $lastID)->get();
        $payment = Transaction::where('order_id', $lastID)->get();


        return view('reports.receipt', [
            'products' => $products,
            'customer_orders' => $orderBy,
            'order_receipt' => $order_receipt,
            'payment' => $payment,
        ]);


    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
