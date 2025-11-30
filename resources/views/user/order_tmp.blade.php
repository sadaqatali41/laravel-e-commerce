@foreach ($orders as $item)
    <tr>
        <td class="order_id_td">
            <a href="{{ route('user.order.detail', $item->id) }}">
                {{ $item->id }}
            </a>
        </td>                                                
        <td>
            <span class="label {{ $item->order_status->color() }}">{{ $item->order_status->label() }}</span>
        </td>
        <td>
            <span class="label {{ $item->payment_status->color() }}">{{ $item->payment_status->label() }}</span>            
        </td>
        <td>{{ $item->payment_type->label() }}</td>
        <td>{{ $item->total_amt }}</td>
        <td>{{ $item->txn_id }}</td>
        <td>{{ $item->created_at }}</td>
    </tr>
@endforeach