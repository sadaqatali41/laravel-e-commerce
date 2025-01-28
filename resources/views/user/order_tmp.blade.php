@foreach ($orders as $item)
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
@endforeach