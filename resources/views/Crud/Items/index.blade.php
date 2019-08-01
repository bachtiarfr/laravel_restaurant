@extends('layouts.app')

@section('content')
<div class="col-md-12 m-2">
    <a href="{{url('items/create')}}" class="btn btn-primary">
        <i class="fa fa-plus"> Add New Menu</i>

    </a>
    <table class="table table-bordered m-3">
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Image</th>
          <th scope="col">Price</th>
          <th scope="col">Categorie</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($items as $item)
              
          <tr>
            <td>{{$item->name}}</td>
            <td>
                <img src="{{url('product/'.$item->image)}}" style="width: 200px" alt="{{$item->image}}">
              </td>
            <td>{{$item->price}}</td>
            <td>{{$item->categorie}}</td>
            <td>{{$item->status}}</td>
            <td>
                
                <a href="{{url('/items/edit',$item->id)}}" class="btn btn-warning">
                    <i class="fa fa-edit"></i>
                    
                </a>
                <a href="{{url('/items/delete',$item->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
           
          </tr>
          @endforeach
      </tbody>
    </table>    
</div>
@endsection