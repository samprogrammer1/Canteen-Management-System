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
                            <li class="breadcrumb-item" aria-current="page">Excel Menu</li>
                            <li class="breadcrumb-item active" aria-current="page">Add</li>
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
                <form action="{{ route('products.excelStore') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="box-title mt-20">Upload Product Excel</h4>
                                <p>Excel Required : product_name , stock , cost_price, price</p>
                                <div class="product-img text-left overflow-hidden">
                                    <div class="btn btn-info mb-20">
                                        <input type="file" name="excel_file" class="upload"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions mt-10">
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-check"></i>Add Products</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="box">
              <div class="box-body">
                <form action="{{ route('products.excelDestroy') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="box-title mt-20">Delete Product Excel</h4>
                                <p>Excel Required : product_name , stock , cost_price, price</p>
                                <div class="product-img text-left overflow-hidden">
                                    <div class="btn btn-info mb-20">
                                        <input type="file" name="excel_file" class="upload"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions mt-10">
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-check"></i>Delete</button>
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
