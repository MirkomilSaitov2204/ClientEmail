<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Session;
use App\Models\Order;
use App\Jobs\SendEmail;
use App\Models\Product;
use App\Models\OrderProduct;
use App\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
    * @var \App\Models\Product
    */
    protected $product;

    /**
    * @var \App\Models\Email
    */
    protected $email;

    public function __construct(Product $product, Email $email)
    {
        $this->product = $product;
        $this->email = $email;
    }

    public function index()
    {
        $orders = Order::all();
        return view('admin.product.index')->with('orders', $orders);
    }
    public function show(Request $request, $id)
    {
        $order = Order::find($id);
        $products = $order->products;

        return view('admin.product.show')->with([
            'products'=> $products,
            'order' => $order
            ]);
    }

        public function send(Request $request)
        {
            // dd($request->all());
            $this->email->storeEmail($request->all());

            dispatch(new SendEmail($request->user, $request->name, $request->description));
        }



}
