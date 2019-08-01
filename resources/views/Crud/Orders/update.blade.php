@extends('layouts.app')

@section('content')

<div class="container">
    <div class="d-flex flex-row-reverse">
        <div class="col-md-8 table-menu">
            <div class="card w-75 float-left">
                <div class="card-header">
                    New Menu
                </div>
                <div class="card-body">
                  <form action="{{url('/orders/update')}}/{{$order->id}}" method="post" class="needs-validation" >
                      @csrf
                      @method('PUT')
                      <div class="form-group w-10">
                        <label for="formGroupExampleInput">Table Number</label>
                        <select name="table" class="form-control w-10" disabled>
                          <option value="{{$order->table_number}}">{{$order->table_number}}</option>
                        </select>
                      </div>
                      <div class="form-group w-10">
                        <label for="formGroupExampleInput">Order Number</label>
                        <input type="text" class="form-control w-10" name="number_order" 
                        placeholder="Table Number" value="{{$order->order_number}}" disabled>
                      </div>
                      @foreach ($order->detail as $row)
                      <div class="form-group w-10">
                          <label for="formGroupExampleInput">Items</label>
                          <select name="name" class="form-control w-10">
                            <option value="{{$row->item_id}}">{{$row->item->name}}</option>
                          </select>
                        </div>
                        <div class="form-group w-10">
                            <label for="formGroupExampleInput">Price</label>
                            <input type="number" class="form-control w-5" name="price" 
                            placeholder="Table Number" value="{{$row->item->price}}">
                          </div>
                      <div class="form-group w-10">
                          <label for="formGroupExampleInput">Quantity</label>
                          <input type="number" class="form-control w-5" name="qty" 
                          placeholder="Table Number" value="{{$row->qty}}">
                        </div>
                      @endforeach
                      <button class="btn btn-primary" type="submit">Update</button>
                    </form>
                  </div>
            </div>
        </div>
    </div>
</div>


@endsection
