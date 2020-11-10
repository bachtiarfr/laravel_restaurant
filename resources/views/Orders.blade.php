@extends('layouts.app')

@section('content')

<div class="container">
    <div class="d-flex">
        <div class="col-md-6 table-menu">
            <div class="card">
                <div class="card-header">
                    Menu List
                    <div class="btn btn-warning all">All items</div>
                    <div class="btn btn-success float-right makanan">Makanan</div>
                    <div class="btn btn-primary mr-2 float-right minuman">Minuman</div>
                </div>
                <div class="row text-center IsiMenu">
                
                  {{-- //tampilkan item makanan atau minuman sesuai pilihan --}}
                
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
      $('.IsiMenu').load('/Api/AllItems');
      $('.all').hide();

      $('.makanan').click(function(){
        $('.IsiMenu').load('/Api/FoodItems');
        $('.all').show();
        console.log('makanan');
      })

      $('.minuman').click(function(){
        $('.IsiMenu').load('/Api/DrinkItems');
        $('.all').show();
        console.log('minuman');
      })

      $('.all').click(function(){
        $('.IsiMenu').load('/Api/AllItems');
      })
       
        
    })

</script>
@endsection
