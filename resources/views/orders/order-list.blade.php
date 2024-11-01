@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <section class="content">
        <div class="row ">
            <div class="col-lg-12 col-12">
                <div class="box">
                    <div class="box-header with-border d-flex justify-content-between">
                        <h3 class="box-title">Order List</h3>
                        <a href="{{route('menu-list')}}"><button class="waves-effect waves-light btn btn-primary ">Add Order</button></a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <div id="example_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <table id="example"
                                    class="table table-bordered table-hover display nowrap margin-top-10 w-p100 dataTable"
                                    role="grid" aria-describedby="example_info">
                                    <thead>
                                        <tr role="row">
                                            <th  style="width: 102.729px;">
                                                Order No. </th>
                                            <th  style="width: 102.729px;">
                                                Total Product </th>
                                            <th style="width: 102.729px;">
                                                Product Details</th>
                                            <th 
                                                style="width: 25.1042px;">Total Price</th>
                                            <th
                                                style="width: 25.1042px;">Order Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            @php
                                                $total_price = 0;
                                            @endphp
                                            <tr >
                                                <td >{{ $order->id }}</td>
                                                <td>{{ count($order->products) }}</td>
                                                <td>
                                                    @foreach ($order->products as $product)
                                                        @php
                                                            $total_price += $product->pivot->price * $product->pivot->quantity;
                                                        @endphp
                                                        <div class="card p-2 mb-2" style="margin-bottom: 5px !important;">
                                                            <p>
                                                                Product Name: {{ $product->product_name }}<br/>
                                                                Price: Rs. {{ $product->pivot->price }}<br/>
                                                                Quantity: {{ $product->pivot->quantity }}<br/>
                                                                Total Price: Rs. {{ $product->pivot->total_price }}
                                                            </p>
                                                        </div>        
                                                    @endforeach
                                                </td>
                                                <td>Rs. {{ $total_price }} Only</td>
                                                <td>{{ $order->created_at->format('( h:i A ) Y-m-d ') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    
                                    <tfoot>
                                        <tr>
                                            <th rowspan="1" colspan="1">Order No.</th>
                                            <th rowspan="1" colspan="1">Total Product</th>
                                            <th rowspan="1" colspan="1">Product Details</th>
                                            <th rowspan="1" colspan="1">Total Price</th>
                                            <th rowspan="1" colspan="1">Order Time</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>

    </section>

@endsection
