<?php

namespace App\Http\Controllers;

use Session;
use Validator;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $product;

    public function __construct(Product $product)
    {
        $this->middleware('auth');
        $this->product = $product;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function products()
    {
        return view('products')->with([
            'products' => $this->product->getAllProducts()
        ]);
    }

    public function index()
    {

        $discount = session()->get('coupon')['discount'] ?? 0;
        $newSubtotal = Cart::subtotal();

     $totalPrice = $newSubtotal - $discount;
        if($totalPrice < 0){
            $totalPrice = 0;
        }
        return view('cart')->with([
            'discount' => $discount,
            'totalPrice'    =>$totalPrice,
        ]);
    }

    public function store(Request $request)
    {
        $duplicates = Cart::search(function($cartItem, $rowId) use ($request){
            return $cartItem->id === $request->id;
        });
        if($duplicates->isNotEmpty()){
            return redirect()->back();
        }
        Cart::add($request->id, $request->product, 1, $request->cost)->associate('App\Models\Product');


        Session::flash('success', 'Product added to cart Successfully' );
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);
        return redirect()->back();
    }




    // Orders
    public function OrderStore(Request $request)
    {


        try {
            $order = $this->addOrdersTable($request, null);
            // Mail::send(new OrderPlaced($order));


            Cart::instance('default')->destroy();
           Session::flash('success','Thanks for Buying');
           return redirect()->route('main');

        } catch (ErrorException $e) {

            $this->addOrdersTable($request, $e->getMessage());
            Session::warning('warning','Make Error');
            return redirect()->back();

        }
    }
    protected function addOrdersTable($request, $error){
        $discount = session()->get('coupon')['discount'] ?? 0;
        $newSubtotal = Cart::subtotal();
        $totalPrice = $newSubtotal - $discount;
        if($totalPrice < 0){
            $totalPrice = 0;
        }
        $order = Order::create([
            'user_id' => auth()->user() ? auth()->user()->id :null,
            'billing_email'    =>auth()->user() ? auth()->user()->email :null,
            'billing_phone'    =>auth()->user() ? auth()->user()->phone :null,
            'billing_total'    => $totalPrice,
            ]);
        foreach(Cart::content() as $item){
            OrderProduct::create([
                'order_id'   =>  $order->id,
                'product_id' =>  $item->model->id,
            ]);
        }
        return $order;
    }
}

