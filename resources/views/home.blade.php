@extends('layouts.dashboard')

@section('content')
<section class="content">
    <h3>Today Orders</h3>
    <div class="row">
        <div class="col-xxxl-3 col-lg-4 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-start">
                        <div>
                            <img src="{{asset('admin/images/food/online-order-1.png')}}" class="w-80 mr-20" alt="" />
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">{{$data['today']['total']}}</h2>
                            <p class="text-fade mb-0">Total Order</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxxl-3 col-lg-4 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-start">
                        <div>
                            <img src="{{asset('admin/images/food/online-order-2.png')}}" class="w-80 mr-20" alt="" />
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">{{$data['today']['product_order']}}</h2>
                            <p class="text-fade mb-0">Total Product Delivered</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxxl-3 col-lg-4 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-start">
                        <div>
                            <img src="{{asset('admin/images/food/online-order-4.png')}}" class="w-80 mr-20" alt="" />
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700"><span class="small font-weight-400">Rs.</span> {{number_format($data['today']['product_rev'], 0, '.', ',')}}</h2>
                            <p class="text-fade mb-0">Total Revenue</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <h3>Week Orders</h3>
    <div class="row">
        <div class="col-xxxl-3 col-lg-4 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-start">
                        <div>
                            <img src="{{asset('admin/images/food/online-order-1.png')}}" class="w-80 mr-20" alt="" />
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">{{$data['week']['total']}}</h2>
                            <p class="text-fade mb-0">Total Order</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxxl-3 col-lg-4 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-start">
                        <div>
                            <img src="{{asset('admin/images/food/online-order-2.png')}}" class="w-80 mr-20" alt="" />
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">{{$data['week']['product_order']}}</h2>
                            <p class="text-fade mb-0">Total Product Delivered</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxxl-3 col-lg-4 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-start">
                        <div>
                            <img src="{{asset('admin/images/food/online-order-4.png')}}" class="w-80 mr-20" alt="" />
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700"><span class="small font-weight-400">Rs.</span> {{number_format($data['week']['product_rev'], 0, '.', ',')}}</h2>
                            <p class="text-fade mb-0">Total Revenue</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <h3>Month Orders</h3>
    <div class="row">
        <div class="col-xxxl-3 col-lg-4 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-start">
                        <div>
                            <img src="{{asset('admin/images/food/online-order-1.png')}}" class="w-80 mr-20" alt="" />
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">{{$data['month']['total']}}</h2>
                            <p class="text-fade mb-0">Total Order</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxxl-3 col-lg-4 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-start">
                        <div>
                            <img src="{{asset('admin/images/food/online-order-2.png')}}" class="w-80 mr-20" alt="" />
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">{{$data['month']['product_order']}}</h2>
                            <p class="text-fade mb-0">Total Product Delivered</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxxl-3 col-lg-4 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-start">
                        <div>
                            <img src="{{asset('admin/images/food/online-order-4.png')}}" class="w-80 mr-20" alt="" />
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700"><span class="small font-weight-400">Rs.</span> {{number_format($data['month']['product_rev'], 0, '.', ',')}}</h2>
                            <p class="text-fade mb-0">Total Revenue</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <h3>Year Orders</h3>
    <div class="row">
        <div class="col-xxxl-3 col-lg-4 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-start">
                        <div>
                            <img src="{{asset('admin/images/food/online-order-1.png')}}" class="w-80 mr-20" alt="" />
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">{{$data['year']['total']}}</h2>
                            <p class="text-fade mb-0">Total Order</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxxl-3 col-lg-4 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-start">
                        <div>
                            <img src="{{asset('admin/images/food/online-order-2.png')}}" class="w-80 mr-20" alt="" />
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">{{$data['year']['product_order']}}</h2>
                            <p class="text-fade mb-0">Total Product Delivered</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxxl-3 col-lg-4 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-start">
                        <div>
                            <img src="{{asset('admin/images/food/online-order-4.png')}}" class="w-80 mr-20" alt="" />
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700"><span class="small font-weight-400">Rs.</span> {{number_format($data['year']['product_rev'], 0, '.', ',')}}</h2>
                            <p class="text-fade mb-0">Total Revenue</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <h3>Total Orders</h3>
    <div class="row">
        <div class="col-xxxl-3 col-lg-4 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-start">
                        <div>
                            <img src="{{asset('admin/images/food/online-order-1.png')}}" class="w-80 mr-20" alt="" />
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">{{$data['total']['total']}}</h2>
                            <p class="text-fade mb-0">Total Order</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxxl-3 col-lg-4 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-start">
                        <div>
                            <img src="{{asset('admin/images/food/online-order-2.png')}}" class="w-80 mr-20" alt="" />
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">{{$data['total']['product_order']}}</h2>
                            <p class="text-fade mb-0">Total Product Delivered</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxxl-3 col-lg-4 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-start">
                        <div>
                            <img src="{{asset('admin/images/food/online-order-4.png')}}" class="w-80 mr-20" alt="" />
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700"><span class="small font-weight-400">Rs.</span> {{number_format($data['total']['product_rev'], 0, '.', ',')}}</h2>
                            <p class="text-fade mb-0">Total Revenue</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
