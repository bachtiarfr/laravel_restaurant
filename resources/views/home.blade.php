@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-12 table-menu">
        <div class="card">
            <div class="card-header">
                Menu List
                @if (Auth::user()->posisi == 'pelayan')
                <a href="{{url('/order_transaction')}}" class="btn btn-warning float-right addItems">
                    Lets Order !
                </a>
            @endif
            </div>
                <div class="row text-center">
                    @foreach ($items as $item)
                    <div class="col-sm-3 m-1">
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
                            
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <p>Rp. {{$item->price}} ,-</p>
                        </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<script>
    
    $(document).ready(function(){
        console.log('oke');
    
    })

</script>
@endsection
