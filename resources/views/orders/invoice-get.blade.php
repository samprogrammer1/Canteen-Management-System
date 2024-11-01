@extends('layouts.dashboard')

@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Invoice</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Invoice</li>
                        <li class="breadcrumb-item active" aria-current="page">Invoice Sample</li>
                    </ol>
                </nav>
            </div>
        </div>
        
    </div>
</div>  

<!-- Main content -->
<section class="invoice printableArea">
  <div class="row">
    <div class="col-12">
      <div class="bb-1 clearFix">
        <div class="text-right pb-15">
            {{-- <button class="btn btn-success" type="button"> <span><i class="fa fa-print"></i> Save</span> </button> --}}
            <button id="print2" class="btn btn-warning" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
        </div>	
      </div>
    </div>
    <div class="col-12">
      <div class="page-header">
        <h2 class="d-inline"><span class="font-size-30">Invoice</span></h2>
        <div class="pull-right text-right">
          @php
              use Carbon\Carbon;
              $startDate = Carbon::parse($date['start_date'])->format('d F Y');
              $endDate = Carbon::parse($date['end_date'])->format('d F Y');
          @endphp
            <h3>({{$startDate}}) TO ({{$endDate}})</h3>
        </div>	
      </div>
    </div>
    <!-- /.col -->
  </div>
  <div class="row invoice-info">
    <div class="col-md-6 invoice-col">
      <strong>From</strong>	
      <address>
        <strong class="text-blue font-size-24">JIET CANTEEN</strong><br>
        <strong class="d-inline">JIET Universe, NH-62, Pali Road, Mogra, Jodhpur - 342802</strong><br>
        <strong>Phone: (+91) 8502003023 &nbsp;&nbsp;&nbsp;&nbsp; Email: samprogrammer@gmail.com</strong>  
      </address>
    </div>
  <!-- /.col -->
  </div>
  <div class="row">
    <div class="col-12 table-responsive">
      <table class="table table-bordered">
        <tbody>
        <tr>
          <th>#</th>
          <th>Product Details</th>
          <th class="text-right">Total Price</th>
        </tr>
        @foreach ($orders as $item)
          @php
              $totalPrice  = 0;
          @endphp
          <tr>
            <td>{{$item->id}}</td>
            <td>
              @foreach ($item->products as $product)
                  @php
                      $totalPrice += $product->pivot->total_price;
                  @endphp
                  {{$product->product_name}} <br/>
                  {{$product->price}} X {{$product->pivot->quantity}} = {{$product->pivot->total_price}} <br/>
                  @if (count($item->products) > 1 && !$loop->last)
                    <hr>
                  @endif
              @endforeach
            </td>
            <td class="text-right">₹ {{$totalPrice}}</td>
          </tr>
        @endforeach
        
        </tbody>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <div class="row">
    <div class="col-12 text-right">
        @php
              $totalPrice  = 0;
              $costPrice = 0;
        @endphp
        @foreach ($orders as $item)
              @foreach ($item->products as $product)
                  @php
                      $totalPrice += $product->pivot->total_price;
                      $costPrice += $product->cost_price * $product->pivot->quantity;
                  @endphp
              @endforeach
        @endforeach
        <div>
            <p>Cost Amount  : ₹ {{$costPrice}}</p>
            <p>Total Amount  : ₹ {{$totalPrice}}</p>
            <p>Margin Amount  : ₹ {{$totalPrice - $costPrice}}</p>
        </div>
        <div class="total-payment">
            <h3><b>Total :</b> Rs. {{$totalPrice}}</h3>
        </div>

    </div>
    <!-- /.col -->
  </div>
</section>



@endsection