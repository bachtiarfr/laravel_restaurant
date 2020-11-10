function viewData() {

    $.get('/Api/Cart', function (data) {
        Object.keys(data).forEach(function (orders) {
            // const tot = Math(data[cart].price * data[cart].qty);
            $('.isiOrder').append(

                '<tr class="tablerow">' +
                '<td>' + data[orders].items_name + '</td>' +
                '<td>' + data[orders].price + '</td>' +
                '<td>' + data[orders].qty + '</td>' +
                '<td><div class="btn btn-danger deleteTableData" data-cartid="' + data[orders].id + '">Delete</div></td>' +
                '</tr>' +
                'total :' +
                '<div class="total">' +
                '</div>'
            ) 


            // $('#tot').html(' Rp. ' + tot + ' ,- ');
        });

        $('.deleteTableData').click(function () {
            var id = $(this).data("cartid");
            var data = {
                id
            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/cart/delete/" + id,
                type: "delete",
                data: data,
                success: function () {

                    $('.tablerow').remove();
                    $('.items').remove();
                    viewData();
                    console.log(id + 'terhapus');

                },
                error: function (data) {
                    console.log('Error:', data);
                }
            })
        });


        $('.deleteCartItems').click(function () {
            var id = $(this).data("id");

            var data = {
                id
            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/cart/delete/" + id,
                type: "delete",
                data: data,
                success: function () {

                    $('.items').remove();
                    $('.tablerow').remove();
                    viewData()
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            })

        });
    });
}

//add to cart
$(document).ready(function () {

    viewData();
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