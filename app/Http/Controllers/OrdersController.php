<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tables;
use App\Item;
use App\Order;
use App\Log;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Cart;
use App\DetailOrders;
use Session;

class OrdersController extends Controller
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
        $order = Order::all();
        // $orders = DB::table('orders')->paginate(5);

        $item = Item::all();

        return view('Crud.Orders.index', compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $table = Tables::all();
        $items = Item::all();

        return view('Crud.Orders.Orders', compact('table', 'items'));
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
            'table' => 'required'
        ]);
        // $cart = $request->input("id");
        $user = Auth::user();

        $order = new Order();
        $order->id_user = $user->id;
        $order->table_number = $request->input('table');
        $order->order_number = 0;
        $order->save();

        $newOrder = Order::find($order->id);
        $newOrder->order_number = ('ERP' . date('dmY') . '-' . $order->id);
        $newOrder->save();

        $newCart = Cart::where('user_id', $user->id)->get();

        foreach ($newCart as $cart) {
            $detail = new DetailOrders();
            $detail->order_id = $order->id;
            $detail->item_id = $cart->items_id;
            $detail->price = $cart->price;
            $detail->qty = $cart->qty;
            $detail->save();
        }
        //hapus cart yang udah diorder di db
        $oldCart = Cart::where('user_id', $user->id);
        $oldCart->delete();

        Log::Log_activity('Menambahkan Pesanan ' . $order->item_name);

        Session::flash("success", "pesanan telah diproses, silahkan menunggu");
        return redirect('/order_transaction');
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

        $order = Order::find($id);
        return view('Crud.Orders.update', compact('order'));
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
        $this->validate($request, [
            'pay' => 'required|integer',
        ]);
        $order = Order::find($id);
        $order->status = "tidak aktif";
        $order->save();

        Log::desc('menerima pembayaran order '  . $order->order_number);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::where('id', $id)->first();
        $order->delete();

        return back();
    }

    public function view()
    {

        $table = Tables::all();
        $order = Order::all();
        return view('Crud.Orders.ViewOrder', compact('order', 'table'));
    }

    public function api()
    {
        $order = Order::all();

        return response()->json($order);
    }

    public function transaction()
    {
        $orders = DB::table('orders')->paginate(5);
        $table = Tables::all();
        $items = Item::all();
        $order = Order::all();

        return view('Orders', ['orders' => $orders], compact('table', 'items', 'order'));
    }

    public function payment($id)
    {
        $order = Order::find($id);

        $total = DetailOrders::where('order_id', $order->id)->selectRaw('SUM((price * qty)) AS total')->first();
        return view('Payment', compact('order', 'total'));
    }

    public function payed($id)
    {
        $order = Order::where('id', $id)->first();
        $order->delete();

        return redirect()->to('/orders');
    }
}
