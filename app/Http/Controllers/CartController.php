<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Auth::user()->cart;
        return view('cart', ['cart' => $cart]);
    }

    public function add($id)
    {
        $user = Auth::user();
        if ($user->cart) {
            $cart = $user->cart;
        } else {
            $cart = Cart::create([
                'user_id' => $user->id
            ]);
        }

        $cartitem = $cart->items()->where('product_id', $id)->first();

        if ($cartitem) {
            $cartitem->update([
                'quantity' => $cartitem->quantity + 1
            ]);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $id,
                'quantity' => 1
            ]);
        }

        return redirect()->back();
    }

    public function remove($id)
    {
        $cart = Auth::user()->cart;
        $product = $cart->items()->where('product_id', $id)->first();
        $product->delete();
        return redirect()->back();
    }

    public function complet()
    {
        $cart = Auth::user()->cart;
        return view('products.check_out_products', ['cart' => $cart]);
    }

    public function store_order(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'address' => 'required|string',
            'phone' => 'required|string',
        ]);
        $order = Order::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        $cart = $user->cart;

        if ($cart) {
            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }
            $cart->items()->delete();
        } else {
            return "not found order";
        }
        return redirect('/');
    }

    public function previous_orders()
    {
        $user = Auth::user();
        $orders = Order::with(['items.product'])->where('user_id', $user->id)->get();
        return view('products.previous_orders', ['orders' => $orders]);
    }
}
