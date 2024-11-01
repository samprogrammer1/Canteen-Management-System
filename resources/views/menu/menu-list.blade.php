@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Menu List</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Menu</li>
                        <li class="breadcrumb-item active" aria-current="page">Menu list</li>
                    </ol>
                </nav>
            </div>
        </div>				
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div id="product-list">
        @include('menu.partials.product-list', ['products' => $products])
    </div>
</section>

<!-- Modal -->
<div class="modal modal-right fade" id="modal-right" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cart</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body d-flex flex-column justify-content-between">
                <div id="cart-items" ></div>
                <div class="d-flex justify-content-between mt-3">
                    <h5>Total Payment:</h5>
                    <h5 id="total-payment">₹ 0.00</h5>
                </div>
            </div>
            <div class="modal-footer modal-footer-uniform">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary float-right">Buy</button>
            </div>
        </div>
    </div>
</div>
<button id="fixed-button" class="fixed-bottom-right waves-effect waves-light btn-success">
    <i class="fa fa-shopping-cart"><span class="path1"></span><span class="path2"></span></i>
</button>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var cart = [];

    function updateCart() {
        var cartItemsContainer = document.getElementById('cart-items');
        var totalPayment = 0;
        cartItemsContainer.innerHTML = '';

        cart.forEach(function(item, index) {
            var itemTotal = item.price * item.quantity;
            totalPayment += itemTotal;

            cartItemsContainer.innerHTML += `
                <div class="row border-top border-bottom py-2">
                    <div class="col-12 main align-items-center">
                        <div class="col d-flex justify-content-between">
                            <div>
                                <h6>${item.product_name}</h6>
                                <p>Price: Rs.${item.price}</p>
                            </div>
                            <div>
                                <a href="#"><span class="close remove-from-cart cursor-pointer" data-index="${index}">&#10005;</span></a>
                            </div>
                        </div>
                        <div class="col d-flex justify-content-between">
                            <div>
                                <input type="number" class="form-control quantity-input" data-index="${index}" value="${item.quantity}" min="1" max="${item.stock}">
                            </div>
                            <div>RS. ${itemTotal.toFixed(2)}</div>
                        </div>
                    </div>
                </div>`;
        });

        document.getElementById('total-payment').innerText = `RS. ${totalPayment.toFixed(2)}`;
        attachEventListeners(); // Reattach event listeners for dynamically added elements
    }

    function attachEventListeners() {
        document.querySelectorAll('.quantity-input').forEach(function(input) {
            input.addEventListener('change', handleQuantityChange);
        });

        document.querySelectorAll('.remove-from-cart').forEach(function(button) {
            button.addEventListener('click', handleRemoveFromCart);
        });

        document.querySelectorAll('.add-to-cart').forEach(function(button) {
            button.addEventListener('click', handleAddToCart);
        });
    }

    function handleQuantityChange(event) {
        var index = event.target.getAttribute('data-index');
        var newQuantity = parseInt(event.target.value);
        if (newQuantity > 0 && newQuantity <= cart[index].stock) {
            cart[index].quantity = newQuantity;
            updateCart();
        } else {
            event.target.value = cart[index].quantity;
        }
    }

    function handleRemoveFromCart(event) {
        var index = event.target.getAttribute('data-index');
        cart.splice(index, 1);
        updateCart();
    }

    function handleAddToCart(event) {
        event.preventDefault();
        var button = event.currentTarget;
        var productData = button.getAttribute('data-product');

        console.log('Raw Product Data:', productData); // Debugging log
        if (!productData) {
            console.error('Product data is null or undefined:', button);
            return;
        }

        try {
            var product = JSON.parse(productData);
            console.log('Parsed Product Data:', product); // Debugging log

            if (!product || !product.id) {
                console.error('Invalid product data:', product);
                return;
            }

            var existingProductIndex = cart.findIndex(function(item) {
                return item.id === product.id;
            });

            if (existingProductIndex !== -1) {
                if (cart[existingProductIndex].quantity < product.stock) {
                    cart[existingProductIndex].quantity++;
                }
            } else {
                product.quantity = 1;
                cart.push(product);
            }

            updateCart();
            $('#modal-right').modal('show');
        } catch (error) {
            console.error('Error parsing product data:', error);
        }
    }

    // Handle order submission
    document.querySelector('.btn-primary.float-right').addEventListener('click', function() {
        var cartData = cart.map(function(item) {
            return {
                id: item.id,
                product_name: item.product_name,
                quantity: item.quantity
            };
        });

        fetch('{{ route('orders.store') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ cart: cartData })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                swal("Congrats!", data.message, "success");
                $('#modal-right').modal('hide'); // Close the modal

                cart = []; // Clear the cart
                updateCart(); // Update the cart display

                reloadProductList(); // Reload product list after purchase
            } else {
                swal("Error", data.message, "error");
            }
        })
        .catch(error => {
            console.error('Error:', error);
            swal("Error", "An error occurred while processing your order.", "error");
        });
    });

    // Function to reload the product list
    function reloadProductList() {
        fetch('{{ route('menu-list.reload') }}')
        .then(response => response.text())
        .then(html => {
            document.getElementById('product-list').innerHTML = html;
            attachEventListeners(); // Reattach event listeners after reload
        })
        .catch(error => {
            console.error('Error reloading product list:', error);
        });
    }

    // Initial attachment of event listeners
    setTimeout(function() {
        attachEventListeners();
    }, 100); // 100ms delay to ensure all elements are rendered

    document.getElementById('fixed-button').addEventListener('click', function() {
        $('#modal-right').modal('show');
    });
});

</script>

</script>
@endsection
