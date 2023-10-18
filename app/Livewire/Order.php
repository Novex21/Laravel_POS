<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use Ramsey\Uuid\Type\Integer;

class Order extends Component
{
    public $orders;
    public $product_code;
    public $message = '';
    public $products = [];
    public $productInCart;
    public $pay_money;
    public $balance;

    public function mount ()
    {
        $this->products = Product::all();
        $this->productInCart = Cart::all();
    }

    public function insertToCart()
    {
        $countProduct = Product::where('id',$this->product_code)->first();

        if (!$countProduct) {
            return $this->message = 'Product not Found';
        }

        $countCartProduct=Cart::where('product_id',$this->product_code)->count();

        if ($countCartProduct > 0) {
            return $this->message = 'Product ' .  $countProduct->name . ' is already added in cart';
        }

        $add_to_cart = new Cart();
        $add_to_cart->product_id = $countProduct->id;
        $add_to_cart->product_qty = 1;
        $add_to_cart->discount= 0;
        $add_to_cart->product_price = $countProduct->price;
        $add_to_cart->user_id = auth()->user()->id;
        $add_to_cart->save();

        $this->product_code = '';
        $this->productInCart->push($add_to_cart);
        return $this->message = 'Product added to Cart Successfully';
    }

    public function IncrementQty($cartId)
    {   

        $carts = Cart::find($cartId);
        $carts->increment('product_qty',1);
        
        $updatePrice = $carts->product_qty * $carts->product->price * (1 - $carts->discount/100);
        $carts->update(['product_price' => $updatePrice]);
        $this->mount();
    }

    public function DecrementQty($cartId)
    {
        $carts = Cart::find($cartId);
            if ($carts->product_qty <= 1 ) {
                $carts->product_qty = 1;
                return $this->message = 'Product qty must have at least 1 stock in Cart';
            }
            $carts->decrement('product_qty',1);
            
            $updatePrice = $carts->product_qty * $carts->product->price * (1 - $carts->discount/100);
        $carts->update(['product_price' => $updatePrice]);
        $this->mount();
    }

    public function Discount($cartId,$discountValue) 
    {
        $carts = Cart::find($cartId);
        if ($carts->disount < 0) {
            return $this->message = "Discount mustn't be lower than 0";
        }
        $carts->discount = $discountValue;
        $updatePrice = $carts->product_qty * $carts->product->price * (1 - $carts->discount/100);
        $carts->update(['product_price' => $updatePrice]);
        $this->mount();

    }

    public function removeProduct($cartId) {
        $deleteCart = Cart::find($cartId);
        $deleteCart->delete();

        $this->productInCart = $this->productInCart->except($cartId);

        return $this->message = 'Product Deleted from Cart Successfully';
    }

    public function updateBalance()
    {   if ($this->pay_money != '') {
            $totalReturn = (int)$this->pay_money - $this->productInCart->sum('product_price');
            $this->balance = $totalReturn;
        }

    }

    public function render()
    {
        return view('livewire.order');
    }


}
