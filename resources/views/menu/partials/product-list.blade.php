<div class="row">
    @foreach ($products as $item)
    <div class="col-xxxl-3 col-xl-3 col-lg-3 col-12">
        <div class="box food-box">
            <div class="box-body text-center">
                <div class="menu-item"><img src="{{ asset('images/products/' . $item->image) }}" height="120px" width="auto" class="rounded" alt=""></div>
                <div class="menu-details text-center">
                    <h4 class="mt-20 mb-10">{{$item->product_name}}</h4>
                    <h5>₹ {{$item->price}}</h5>
                    <p>Stock ( <strong>{{$item->stock}}</strong> )</p>
                </div>
                <div class="act-btn d-flex justify-content-between">
                    <div class="text-center mx-5">
                        <a href="{{ route('menu-updateForm', $item->id) }}" class="waves-effect waves-circle btn btn-circle btn-danger-light btn-xs mb-5"><i class="fa fa-edit"></i></a>
                        <small class="d-block">Edit</small>
                    </div>
                    <div class="text-center mx-5">
                        <form action="{{ route('products.destroy', $item->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this product?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="waves-effect waves-circle btn btn-circle btn-primary-light btn-xs mb-5">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                        <small class="d-block">Delete</small>
                    </div>
                    <div class="text-center mx-5">
                        <a href="#" class="waves-effect waves-circle btn btn-circle btn-success btn-xs mb-5 add-to-cart" data-product='@json($item)'>
                        <i class="fa fa-shopping-cart"></i>
                        </a>
                        <small class="d-block">Buy</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
