@forelse ($orders as $item)
    <tr>
        <td class="order_id_td">
            <a href="{{ route('user.order.detail', $item->id) }}">
                {{ $item->id }}
            </a>
        </td>                                                
        <td>
            @if($item->order_status == 1)
                <span class="label label-warning">Placed</span>
            @elseif ($item->order_status == 2)
                <span class="label label-info">On the way</span>
            @else
                <span class="label label-success">Deliverd</span>
            @endif
        </td>
        <td>
            @if($item->payment_status == 'PENDING')
                <span class="label label-info">Pending</span>
            @elseif ($item->payment_status == 'SUCCESS')
                <span class="label label-success">Success</span>
            @else
                <span class="label label-danger">Failed</span>
            @endif
        </td>
        <td>
            @if($item->payment_type == 'GT')
                Online
            @else
                COD
            @endif
        </td>
        <td>{{ $item->total_amt }}</td>
        <td>{{ $item->txn_id }}</td>
        <td>{{ $item->created_at }}</td>
    </tr>
@empty
    <tr>
        <th colspan="7">Sorry! No Order found.</th>
    </tr>
@endforelse

{{-- <script>
    var ENDPOINT = "{{ route('posts.index') }}";

var page = 1;



$(".load-more-data").click(function(){

    page++;

    infinteLoadMore(page);

});



/*------------------------------------------

--------------------------------------------

call infinteLoadMore()

--------------------------------------------

--------------------------------------------*/

function infinteLoadMore(page) {

    $.ajax({

            url: ENDPOINT + "?page=" + page,

            datatype: "html",

            type: "get",

            beforeSend: function () {

                $('.auto-load').show();

            }

        })

        .done(function (response) {

            if (response.html == '') {

                $('.auto-load').html("We don't have more data to display :(");

                return;

            }

            $('.auto-load').hide();

            $("#data-wrapper").append(response.html);

        })

        .fail(function (jqXHR, ajaxOptions, thrownError) {

            console.log('Server error occured');

        });

}


</script> --}}