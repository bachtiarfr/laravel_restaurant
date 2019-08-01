@extends('layouts.app')

@section('content')
<div class="container">
        <div class="d-flex">
            <div class="col-md-12 table-menu">
                <div class="card w-75 float-left">
                    <div class="card-header">
                            Order Number : 
                            {{$order->order_number}}
                       <p class="float-right">
                           Table Number : {{$order->order_number}}</p>
                    </div>
                    <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Table Number</th>
                                <th scope="col">Items</th>
                                <th scope="col">Price</th>
                                <th scope="col">QTY</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td>{{$order->order_number}}</td>
                                <td>{{$order->table_number}}</td>
                                @foreach ($order->detail as $row)
                                <td>{{$row->item->name}}</td>
                                @endforeach
                                </tr>
                            
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
</div>


@endsection
