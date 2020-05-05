<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;


class WishlistComponent extends Component
{

    public function  removeFromWishlist($product_id)
    {

        foreach (Cart::instance('wishlist')->content() as  $witem) {
            if ($witem->id == $product_id) {
                Cart::instance('wishlist')->remove($witem->rowId);
                $this->emitTo('wishlist-count-component', 'refreshComponent'); //for auto refreshing wishlist count
                return;
            }
        }
    }

    //moving product to cart from wishlist
    public function moveProductFromWishlistToCart($rowId)
    {
        $item = Cart::instance('wishlist')->get($rowId);
        Cart::instance('wishlist')->remove($rowId); //first remove the product from wishlist
        $this->emitTo('wishlist-count-component','refreshComponent');

        Cart::instance('cart')->add($item->id, $item->name, 1, $item->price)->associate('App\Models\Product'); //then add to the cart
        $this->emitTo('cart-count-component', 'refreshComponent');

    }

    public function render()
    {
        return view('livewire.wishlist-component')->layout('layouts.base');
    }

}
