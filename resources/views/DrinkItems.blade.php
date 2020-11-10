@foreach ($drink as $item)
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

<script>

$(document).ready(function () {

console.log('masuk');

$('.Order').click(function () {
    var id = $(this).data('id');
    var name = $(this).data('name');
    var price = $(this).data('price');
    var data = {
        id,
        name,
        price,
    };
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/cart/add",
        type: "post",
        data: data,
        success: function (data) {
            $('.tablerow').remove();
            viewData();
        },
        dataType: "json"
    });
    console.log(id, name, price);

})

})

</script>