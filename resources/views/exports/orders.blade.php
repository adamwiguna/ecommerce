@foreach ($orders as $order)
<table>
    <thead>
    <tr>
        <th colspan="3">{{ $order->id }} - {{ $order->user->name }} ({{ $order->user->email }})</th>
    </tr>
    <tr>
        <th>PRODUCT</th>
        <th>SIZE</th>
        <th>QUANTITY</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order->products as $product)
        <tr>
            <td>{{ $product->parent->name }}</td>
            <td>{{ $product->size }}</td>
            <td>{{ $product->pivot->quantity }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
    
@endforeach