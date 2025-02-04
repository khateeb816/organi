<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{

    public function Wishlist()
    {
        $wishlistItems = Wishlist::where('user_id', Auth::id())->with('product')->get();
        return view('frontend.wishlist.index', compact('wishlistItems'));
    }

    public function addToWishlist($id)
    {
        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $id,
        ]);

        return redirect()->back();
    }


    public function moveToCart($id)
    {
        $wishlistItem = Wishlist::find($id);

        if (!$wishlistItem) {
            return redirect()->back()->with('error', 'Item not found in wishlist.');
        }

        // Move to Cart
        Cart::create([
            'user_id' => auth()->id(),
            'product_id' => $wishlistItem->product_id,
            'quantity' => 1 // Default quantity
        ]);

        // Remove from Wishlist
        $wishlistItem->delete();

        return redirect()->back()->with('success', 'Item moved to cart successfully!');
    }

    public function remove($id)
    {
        Wishlist::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Item removed from wishlist.');
    }
    public function removeItem($product_id)
    {
        $wishlistItem = \App\Models\Wishlist::where('user_id', auth()->user()->id)
            ->where('product_id', $product_id)
            ->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            return redirect()->back()->with('success', 'Item removed from wishlist!');
        } else {
            return redirect()->back()->with('error', 'Item not found in wishlist!');
        }
    }
}
