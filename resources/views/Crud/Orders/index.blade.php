@extends('layouts.app')

@section('content')
<div class="col-md-12 m-2">
    <a href="{{url('order_transaction')}}" class="btn btn-primary">
        <i class="fa fa-plus"> Add New Order</i>

    </a>
    <table class="table table-bordered m-3 text-center">
      <thead>
        <tr>
          <th scope="col">Table Number</th>
          <th scope="col">Order Number</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($order as $order)
          <tr>
            <td>{{$order->table_number}}</td>
            <td>{{$order->order_number}}</td>
            <td class="text-center">
              @if ($order->status == 'aktif')
              <div class="badge badge-success">
                {{$order->status}}
              </div>              
              @else
              <div class="badge badge-secondary d-flex">
                  {{$order->status}}
              </div>
              @endif
              </div>
            </td>
            <td>
              @if (Auth::user()->posisi == 'pelayan')
              <a href="#" class="btn btn-primary">
                  <i class="fa fa-folder-open"></i>
              </a>
              @else
              <a href="{{url('/orders/edit',$order->id)}}" class="btn btn-primary">
                  <i class="fa fa-edit"></i>
              </a>
              
              <a href="{{url('/pay', $order->id)}}" class="btn btn-success">
                  <i class="fa fa-money"></i>
              </a>
              
              
              @endif
                
            </td>
           
          </tr>
          @endforeach
      </tbody>
    </table>    
</div>

<script>

$(document).ready(function(){
  var id = $(this).data('tambah');
  $('.tambah').click(function(){
    console.log(id);
    
  })
})
</script>
@endsection