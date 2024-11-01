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
                            <li class="breadcrumb-item" aria-current="page"><a href="{{route('menu-list')}}">Menu</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Update -> {{$product->product_name}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
            
        </div>
    </div>

    <!-- Main content -->
    <section class="content">

        <div class="row">
          <div class="col-12">
            <div class="box">
              <div class="box-body">
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-700 font-size-16">Product Name</label>
                                    <input type="text" name="product_name" class="form-control" placeholder="Product Name" value="{{ old('product_name', $product->product_name) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-700 font-size-16">Stock</label>
                                    <div class="input-group">
                                        <input type="number" name="stock" class="form-control" placeholder="Example 200" min="0" value="{{ old('stock', $product->stock) }}" required> 
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
                                        <input type="number" name="price" min="0" class="form-control" placeholder="40" value="{{ old('price', $product->price) }}" required> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <h4 class="box-title mt-20">Upload Image</h4>
                                <div class="product-img text-left overflow-hidden">
                                    @if ($product->image)
                                        <img src="{{ asset('images/products/' . $product->image) }}" alt="Product Image" class="mb-15">
                                    @else
                                        <img src="{{ asset('admin/images/product/product-9.png') }}" alt="" class="mb-15">
                                    @endif
                                    <div class="btn btn-info mb-20">
                                        <input type="file" name="image" class="upload"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions mt-10">
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-check"></i> Update</button>
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
            swal("Congrats!", "{{ session('success') }}", "success");
        });
    </script>
    @endif
@endsection
