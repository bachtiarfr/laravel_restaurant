@extends('layouts.app')

@section('content')
<div class="container">
        <div class="d-flex">
            <div class="col-md-12 table-menu">
                <div class="card w-75 float-left">
                    <div class="card-header">
                        <div class="float-right">
                        Order Number : <strong>{{$order->order_number}}</strong> <br/>
                        Order Number : <strong>{{$order->table_number}}</strong>
                        </div> 
                    </div>
                    
                    <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Item</th>
                                <th scope="col">QTY</th>
                                <th scope="col">Price</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->detail as $item)
                                <tr>
                                <td>{{$item->item->name}}</td>
                                <td>{{$item->qty}}</td>
                                <td>{{$item->price}}</td>
                            </tr>
                            
                            @endforeach
                            <tr>
                                <th scope="col">Total : {{$total->total}} </th>
                                <th scrope="col">
                                    <input type="number" placeholder="masukan uang" class="form-control">
                                </th>
                                <th>
                                    <a href="{{url('/payed', $order->id)}}" class="btn btn-success">bayar</a>
                                </th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
</div>


@endsection
