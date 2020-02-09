<table class="table mb-4">
    <thead>
        <tr>
            <th>Product</th>
            <th class="text-right">Quantity</th>
        </tr>
    </thead>
    @foreach ($basket->all() as $product)
        <tr>
            <td>{{ $product->title }}</td>
            <td class="text-right">{{ $product->quantity }}</td>
        </tr>
    @endforeach
</table>
