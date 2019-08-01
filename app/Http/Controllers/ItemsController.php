<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Item;
use App\Log;
use DB;

class ItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return view('Crud.Items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Crud.Items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|',
            'price' => 'required',
            'status' => 'required',
            'categorie' => 'required'
        ]);
        $item = new Item();
        $item->name = $request->input('name');
        $item->price = $request->input('price');
        $item->status = $request->input('status');
        $item->categorie = $request->input('categorie');
        $item->save();

        $request->file('image')->move(public_path('product'), $item->id . '.jpg');
        $item->image = $item->id . '.jpg';
        $item->save();

        Log::Log_activity('Menambahkan menu ' . $item->name);

        return redirect()->to('/items');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        return view('Crud.Items.update', compact('item'));
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
        $item = Item::find($id);
        $item->name = $request->input('name');
        $item->image = $request->input('image');
        $item->price = $request->input('price');
        $item->status = $request->input('status');
        $item->categorie = $request->input('categorie');

        $item->save();
        Log::Log_activity('Merubah menu ' . $item->name);

        return redirect()->to('/items');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::where('id', $id)->first();
        $item->delete();

        return back();
    }

    //API

    public function ApiAllItems()
    {
        $all_items = Item::all();
        // return view('Crud.Orders.AllItems', compact('all_items'));

        return response()->json($all_items);
    }

    public function ApiFoodItems()
    {
        $food = DB::table('items')->where('categorie', 'makanan')->get();
        // return view('Crud.Orders.FoodItems', compact('food'));

        return response()->json($food);
    }

    public function ApiDrinkItems()
    {
        $drink = DB::table('items')->where('categorie', 'minuman')->get();
        // return view('Crud.Orders.DrinkItems', compact('drink'));
        return response()->json($drink);
    }
}
