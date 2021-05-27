@extends('layouts.Client_layout.Client_layout')
@section ('content')
<!-- Register Section Begin -->

<div style="margin:auto; display:block;">
                        <h2>Orders</h2>
                        <div class="">
                            <div class="span8">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <th> Order Id </th>
                                        <th> Order Products </th>
                                        <th> Payment Method </th>
                                        <th> Grand total </th>
                                        <th> Created on  </th>
                                        <th></th>
                        </tr>
                        @foreach($orders as $order)
                        <tr>
                                        <td><a href="{{ url('orders/'.$order['id']) }}" > 
                                        {{ $order['id'] }} </a> </td>
                                        <td> 
                                            @foreach($order['orders_products'] as $pro)
                                                    {{ $pro['product_code']  }}<br>
                                            @endforeach
                                        </td>
                                        <td> {{ $order['payment_method'] }} </td>
                                        <td> ${{ $order['grand_total'] }} </td>
                                        <td> {{ date('d-m-Y', strtotime($order['created_at'])) }}
                                        <td><a style="text-decoration: underline;" href="{{ url('orders/'.$order['id']) }}">View Details </a></td> 
                                        </td>
                        </tr>

                        @endforeach
                    </table>        
                </div >

              
                        
                 
                   
        </div>
</div>
    
    <!-- Register Form Section End -->


@endsection