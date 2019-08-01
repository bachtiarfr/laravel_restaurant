<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Item;

use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        //load all variable categories to all method 
        // View::share('categories', Categorie::all());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function index()
    {
        $cart = [];
        // $user = Auth::user();
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::user()->id)->get();
            // $cart = Cart::all();
        }

        return response()->json($cart);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (Auth::check()) {
            $user = Auth::user();
            $item = $request->input("id");
            $cart = Cart::where("items_id", $item)->where("user_id", $user->id)->first();

            if ($cart) {
                $cart->qty = $cart->qty + 1;
                $cart->save();
            } else {
                $qty = 1;
                $items = Item::find($item);

                $cart = new Cart;
                $cart->user_id = $user->id;
                $cart->items_id = $item;
                $cart->items_name = $items->name;
                $cart->price = $items->price;
                $cart->qty = $qty;
                $cart->save();
            }
            return response()->json($cart);
        } else {
            return redirect('/login');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // if (Auth::check()) {
        //     $cart = Cart::all();
        // }

        //query


        // $product = DB::table('products')
        //     ->join('categories', 'categorie_id', '=', 'categories.id')
        //     ->get();

        $total = Cart::where('user_id', Auth::user()->id)->selectRaw('SUM((price * qty)) AS total')->first();


        //$sum = Cart::all()->sum('price');
        return view('templates.' . $this->template->folder . '.cart', compact('cart', 'total'));
        // return response()->json($cart);

        // $product = DB::table('products')
        //         ->join()

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        Cart::find($id)->delete();
    }
}
