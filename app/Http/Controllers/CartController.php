<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request)
    {
        try {
            // التحقق من صحة البيانات المدخلة
            $validated = $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1',
            ]);
            
            // العثور على المنتج
            $product = Product::find($validated['product_id']);
            $totalPrice = $product->price * $validated['quantity'];

            // إضافة أو تحديث المنتج في السلة
            $cart = Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'total_price' => $totalPrice,
            ]);
            
            // إرجاع استجابة JSON
            return response()->json([
                'message' => 'Product added to cart successfully',
                'cart_count' => auth()->user()->cartItems->count() // اجلب عدد العناصر في السلة
            ], 200);

        } catch (\Exception $e) {
            // في حال حدوث خطأ، أرجع رسالة خطأ مع التفاصيل
            return response()->json([
                'error' => 'Error adding product to cart',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show()
    {
        $user = auth()->user();
        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();

        return view('cart.index', compact('cartItems'));
    }

    public function remove($cartId)
    {
        $cartItem = Cart::findOrFail($cartId);
        $cartItem->delete();

        return redirect()->route('cart.show')->with('success', 'Product removed from cart');
    }

    public function checkout(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Remove all items from the user's cart
        Cart::where('user_id', $user->id)->delete();

        // Redirect with a success message
        return redirect()->route('cart.show')->with('success', 'Your order checked out successfully');
    }
}
