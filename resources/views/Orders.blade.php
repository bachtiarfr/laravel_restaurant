@extends('layouts.app')

@section('content')

<div class="container">
    <div class="d-flex">
        <div class="col-md-6 table-menu">
            <div class="card">
                <div class="card-header">
                    Menu List
                    <div class="btn btn-primary float-right">Makanan</div>
                    <div class="btn btn-secondary mr-2 float-right">Minuman</div>
                </div>
                <div class="row text-center IsiMenu">
                  
                  @foreach ($items as $item)
                    <div class="col-sm-5 m-2">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">{{$item->name}} 
                            @if ($item->status == 'ready')
                              <div class="badge badge-success">
                                  {{$item->status}}
                              </div>                     
                            @else
                              <div class="badge badge-secondary">
                                      {{$item->status}}
                              </div>
                            @endif
                          </h5>
                          
                            <img class="col md-6" src="{{url('product/'.$item->image)}}" style="width: 200px" alt="{{$item->image}}">
                          <p>Rp. {{$item->price}} ,-</p>
                              @if ($item->status == 'not_ready')
                              <button type="button" href="#" class="btn btn-secondary" disabled>Order</button>

                              @else
                                  
                              <button href="#" class="btn btn-primary Order" id="addToCart" 
                              data-id="{{ $item->id }}" 
                              data-name="{{ $item->name }}"
                              data-price="{{ $item->price }}">Order</button>
                              @endif
                        </div>
                      </div>
                    </div>
                @endforeach
                  </div>
              </div>
        </div>

        <div class="col-md-6">
            <form action="{{url('/orders/add')}}" method="post">
              @csrf
            <div class="card">
              <div class="card-header">
                @if (Session::has('success'))
                <div class="alert alert-success">
                  {{Session::get('success')}}
                </div>
                @endif
                    Order List
                    <select name="table" class="form-control col-sm-3 float-right" required>
                      <option value="">Table</option>
                      @foreach ($table as $item)
                        <option value="{{$item->number}}">{{$item->number}}</option>
                            
                        @endforeach
                      </select>
                </div>
                <div class="row text-center">
                    <div class="col m-2">

                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">Item Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Qty</th>
                                <th scope="col">
                                  
                                </th>
                              </tr>
                            </thead>
                            <tbody class="isiOrder">
                              {{-- isi item yang di order --}}
                            </tbody>
                          </table>
                          
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary order">Process</b>
                    </div>
                    </div>
                  </form>
                  </div>
                </div>
              </div>

                  
<script>
    
    $(document).ready(function(){
        console.log('oke');
       
        
    })

</script>
@endsection
