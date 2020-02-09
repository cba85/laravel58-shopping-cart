<table class="table">
    <tr>
        <td>Sub total</td>
        <td class="text-right">{{ number_format($basket->subtotal(), 2, ',', ' ') }} €</td>
    </tr>
    <tr>
        <td>Shipping</td>
        <td class="text-right">5.00 €</td>
    </tr>
    <tr>
        <td class="table-primary"><strong>TOTAL</strong></td>
        <td class="table-primary text-right"><strong>{{ number_format($basket->subtotal() + 5, 2, ',', ' ') }} €</strong></td>
    </tr>
</table>
