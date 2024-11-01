@extends('layouts.dashboard')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Menu</li>
                            <li class="breadcrumb-item active" aria-current="page">Add</li>
                        </ol>
                    </nav>
                </div>
            </div>
            
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="d-flex justify-content-center my-3">
            <a href="{{route('menu.excel')}}">
                <button class="btn btn-primary">Products Excel Action</button>
            </a>
        </div>
        <div class="row">
            
          <div class="col-12">
            <div class="box">
              <div class="box-body">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-700 font-size-16">Product Name</label>
                                    <input type="text" name="product_name" class="form-control" placeholder="Product Name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-700 font-size-16">Stock</label>
                                    <div class="input-group">
                                        <input type="number" name="stock" class="form-control" placeholder="Example 200" min="0" required> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-700 font-size-16">Price</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">₹</div>
                                        <input type="number" name="price" min="0" class="form-control" placeholder="40" required> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-700 font-size-16">Cost Price</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">₹</div>
                                        <input type="number" name="cost_price" min="0" class="form-control" placeholder="40" required> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <h4 class="box-title mt-20">Upload Image</h4>
                                <div class="product-img text-left overflow-hidden">
                                    <img src="{{asset('admin/images/product/product-9.png')}}" alt="" class="mb-15">
                                    <div class="btn btn-info mb-20">
                                        <input type="file" name="image" class="upload"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-md-3">
                                <h4 class="box-title mt-20">Upload Excel</h4>
                                <div class="product-img text-left overflow-hidden">
                                    <div class="btn btn-info mb-20">
                                        <input type="file" name="excel_file" class="upload"> 
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="form-actions mt-10">
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-check"></i>Add</button>
                    </div>
                </form>
              </div>
            </div>
          </div>		  
      </div>

    </section>
    
    @if(session('success'))
    <script>
        $(document).ready(function() {
            swal("Success", "{{ session('success') }}", "success");
        });
    </script>
    @endif
@endsection
