<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Detail;
use App\Models\Header;
use App\Models\Ramen;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function showCart() {
        $userId = Auth::id();
        $data = Cart::all();

        return view('customer.cart', [
            'cart'=>$data,
            'userId'=>$userId,
        ]);
    }

    public function storeCart(Request $request, $id) {

        $cart = $request->all();
        $userId = Auth::id();

        $data = Cart::where('user_id', $userId)->
        where('ramen_id', $id)->first();

        if(Cart::where('user_id', $userId)->
        where('ramen_id', $id)->exists())
        {
            if($cart['quantity'] == 0)
            {
                $cartId = $data['id'];
                $data->destroy($cartId);
            }
            else
            {
                $quantity = $cart['quantity'] + $data['quantity'];
                if($quantity > 10)
                {
                    Cart::where('user_id', $userId)->
                    where('ramen_id', $id)->update([
                        'quantity'=>10,
                        'updated_at'=>Carbon::now(),
                    ]);

                    return redirect()->route('showCart.member')->with('error_message', 'You have reached the maximum quantity!');
                }
                else
                {
                    Cart::where('user_id', $userId)->
                    where('ramen_id', $id)->update([
                        'quantity'=>$quantity,
                        'updated_at'=>Carbon::now(),
                    ]);
                }
            }

            return redirect()->route('showCart.member')->with('success_message', 'Cart updated!');
        }
        else
        {
            Cart::create([
                'user_id'=>$userId,
                'ramen_id'=>$id,
                'quantity'=>$cart['quantity'],
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ]);

            return redirect()->route('showCart.member')->with('success_message', 'Cart updated!');
        }

        return redirect()->route('showCart.member')->with('error_message', 'Error updating cart.');
    }

    public function removeCart($id)
    {
        $userId = Auth::id();

        $data = Cart::where('user_id', $userId)->
        where('ramen_id', $id)->first();

        $data->destroy($data['id']);

        return redirect()->route('showCart.member')->with('success_message', 'Item removed!');
    }

    public function submitCart()
    {
        $userId = Auth::id();

        $data = Cart::where('user_id', $userId)->get();

        if(Cart::where('user_id', $userId)->exists())
        {
            $header_id = Header::create([
                'customer_id'=>$userId,
                'staff_id'=>0,
                'date'=>Carbon::now(),
            ]);
    
    
            foreach($data as $item)
            {
                Detail::create([
                    'header_id'=>$header_id['id'],
                    'ramen_id'=>$item['ramen_id'],
                    'quantity'=>$item['quantity'],
                ]);
            }
    
            $data = Cart::where('user_id', $userId)->get();
            foreach($data as $item)
            {
                $item->destroy($item['id']);
            }
            
            return redirect()->route('home.member')->with('success_message', 'Your order has been submitted!');
        }
        
        return redirect()->route('home.member')->with('error_message', 'There is an error while submitting your order.');
    }

}
