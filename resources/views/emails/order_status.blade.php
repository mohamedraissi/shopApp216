<html>
<head>
<title> </title>
</head>
<body>
    <table>
        <tr>
            <td> Dear {{$name}} ! </td>
</tr>
<tr>
    <td> Your order #{{ $order_id }} status has been updated to {{ $oreder_status }}. :</td>
</tr>
<tr>@if(!empty($courier_name) && !empty($tracking_number))
<td>&nbsp;</td>
<tr><td> Courier Name is {{$courier_name}} and tracking number is {{$tracking_number}} </td></tr>
@endif
<td>&nbsp;</td>
<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<table style="width: 95%" cellpadding="5" bgcolor="#f7f4f4">
<tr bgcolor="#cccccc">
    <td> Product Name</td>
    <td> Code</td>
    <td> Size</td>
    <td> Color</td>
    <td> Quantity</td>
    <td> Price</td>
</tr>
@foreach ($orderDetails['orders_products'] as $order)
<tr>
    <td> {{$order['product_name']}}</td>
    <td> {{$order['product_code']}}</td>
    <td> {{$order['product_size']}}</td>
    <td> {{$order['product_color']}}</td>
    <td> {{$order['product_qty']}}</td>
    <td> ${{$order['product_price']}}</td>
</tr>

@endforeach

<tr>
    <td colspan="5" align="right"> Shipping Charges</td>  
    <td> ${{$orderDetails['shipping_charges']}} </td>
</tr>
<tr>
    <td colspan="5" align="right"> Coupon Discount</td>  
    <td> $
    @if ($orderDetails['coupon_amount']>0)
    {{$orderDetails['coupon_amount']}} 
    @else 
        0
        @endif
    </td>
</tr>
<tr>
    <td colspan="5" align="right"> Grand Total</td>  
    <td> ${{$orderDetails['grand_total']}} </td>
</tr>
</table>
<tr><td>&nbsp;</td></tr>
<tr><td>
    <table>
    <tr>
    <td><strong>Delivery Address :  </strong> </td>
    </tr>
    <tr>
    <td>{{$orderDetails['name']}}</td>
    </tr>
    <tr>
    <td>{{$orderDetails['address']}}</td>
    </tr>
    <tr>
    <td>{{$orderDetails['city']}}</td>
    </tr>
    <tr>
    <td>{{$orderDetails['state']}}</td>
    </tr>
    <tr>
    <td>{{$orderDetails['country']}}</td>
    </tr>
    <tr>
    <td>{{$orderDetails['pincode']}}</td>
    <tr>
    <td>{{$orderDetails['mobile']}}</td>
    </tr>
    </tr>
    </table>
    <tr><td>&nbsp;</td></tr>
    <tr><td> For any problem, You can contact our support  <a href="mailto:support@shop216.tn">suppport@shop216.tn</a></td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>&nbsp;</td></tr>

    <tr>
    <td> Thanks for chosing shop216 </td>
</tr>
<tr>
    <td> Shop216 Website. </td>
</tr>
</body>
</html>
