<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/favicon.ico">

    <title>JIET UNIVERSE | CANTEEN</title>
    
	<!-- Vendors Style-->
	<link rel="stylesheet" href="{{asset('admin/css/vendors_css.css')}}">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('admin/css/skin_color.css')}}">
    
	
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>

<body class="hold-transition light-skin sidebar-mini theme-danger fixed">
	
<div class="wrapper">
	<div id="loader"></div>
	
  <header class="main-header">
	<div class="d-flex align-items-center logo-box justify-content-start">
		<a href="#" class="waves-effect waves-light nav-link d-none d-md-inline-block mx-10 push-btn bg-transparent hover-primary" data-toggle="push-menu" role="button">
			<span class="icon-Align-left"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
		</a>	
		<a href="{{route('home')}}" class="logo">
		  <div class="logo-lg">
			  <span class="light-logo"><img src="{{asset('admin/images/logo.png')}}" class="fluid" width="100px" alt="logo"></span>
			  <span class="dark-logo"><img src="{{asset('admin/images/logo.png')}}" class="fluid" width="100px" alt="logo"></span>
		  </div>
		</a>	
	</div>  
    <nav class="navbar navbar-static-top">
	  <div class="app-menu">
		<ul class="header-megamenu nav">
			<li class="btn-group nav-item d-md-none">
				<a href="#" class="waves-effect waves-light nav-link push-btn btn-info-light" data-toggle="push-menu" role="button">
					<span class="icon-Align-left"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
			    </a>
			</li>
		</ul> 
	  </div>
		
      <div class="navbar-custom-menu r-side">
        <ul class="nav navbar-nav">	
			<li class="btn-group nav-item d-lg-inline-flex d-none">
				<a href="#" data-provide="fullscreen" class="waves-effect waves-light nav-link full-screen btn-info-light" title="Full Screen">
					<i class="icon-Expand-arrows"><span class="path1"></span><span class="path2"></span></i>
			    </a>
			</li>	
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle p-0 text-dark hover-primary ml-md-30 ml-10" data-toggle="dropdown" title="User">
				<span class="pl-30 d-md-inline-block d-none">Hello,</span> <strong class="d-md-inline-block d-none">{{auth()->user()->name}}</strong><img src="{{asset('admin/images/avatar/avatar-11.png')}}" class="user-image rounded-circle avatar bg-white mx-10" alt="User Image">
            </a>
            <ul class="dropdown-menu animated flipInX">
              <li class="user-body">
				 <a class="dropdown-item" href="#"><i class="ti-user text-muted mr-2"></i> Profile</a>
				 <a class="dropdown-item" href="#"><i class="ti-wallet text-muted mr-2"></i> My Wallet</a>
				 <a class="dropdown-item" href="#"><i class="ti-settings text-muted mr-2"></i> Settings</a>
				 <div class="dropdown-divider"></div>
				 <a class="dropdown-item" href="{{ route('logout') }}"
				 onclick="event.preventDefault();
							   document.getElementById('logout-form').submit();"><i class="ti-lock text-muted mr-2"></i> Logout</a>
				 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
					@csrf
				</form>
              </li>
            </ul>
          </li>	
			
        </ul>
      </div>
    </nav>
  </header>
  
  <aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">	
	  <div class="multinav">
		  <div class="multinav-scroll" style="height: 100%;">	
			  <!-- sidebar menu-->
			  <ul class="sidebar-menu" data-widget="tree">
				<li>
				  <a href="{{route('home')}}">
					<i class="icon-Home"></i>
					<span>Dashboard</span>
				  </a>
				</li>
				<li class="treeview">
					<a href="#">
						<i class="icon-Dinner"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
						<span>Menus</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-right pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li><a href="{{route('add-menu')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add New Menu</a></li>
						<li><a href="{{route('menu-list')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Menu List</a></li>
					</ul>
				</li>
				<li class="treeview">
				  <a href="#">
					<i class="icon-Clipboard-check"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
					<span>Order</span>
					<span class="pull-right-container">
					  <i class="fa fa-angle-right pull-right"></i>
					</span>
				  </a>
				  <ul class="treeview-menu">
					<li><a href="{{route('order-list')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Order List</a></li>
					<li><a href="{{route('invoice')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Invoice</a></li>
				  </ul>
				</li>
						     
			  </ul>	
			</div>
		</div>
    </section>
  </aside>

  <div class="content-wrapper">	
	  <div class="container-full">
        <main class="py-4">
            @yield('content')
        </main>
		
	  </div>
  </div>
  <!-- /.content-wrapper -->
 
	
  <footer class="main-footer">
    <div class="pull-right d-none d-sm-inline-block">
        Developed By <a href="http://sameerali.online/">Sameer Ali</a><br>
    </div>
		
	  &copy; 2024 <a href="https://www.jietjodhpur.ac.in/">JIET</a>. All Rights Reserved.
  </footer>


  
</div>
	
	
	<!-- Vendor JS -->
    
	<script src="{{asset('admin/js/vendors.min.js')}}"></script>
	<script src="{{asset('admin/js/pages/chat-popup.js')}}"></script>
	<script src="{{asset('admin/assets/vendor_components/apexcharts-bundle/dist/apexcharts.min.js')}}"></script>
    <script src="{{asset('admin/assets/icons/feather-icons/feather.min.js')}}"></script>	
	
	<script src="{{asset('admin/assets/vendor_components/OwlCarousel2/dist/owl.carousel.js')}}"></script>
	<script src="{{asset('admin/https://cdn.amcharts.com/lib/4/core.js')}}"></script>
	<script src="{{asset('admin/https://cdn.amcharts.com/lib/4/maps.js')}}"></script>
	<script src="{{asset('admin/https://cdn.amcharts.com/lib/4/geodata/worldLow.js')}}"></script>
	<script src="{{asset('admin/https://cdn.amcharts.com/lib/4/themes/kelly.js')}}"></script>
	<script src="{{asset('admin/https://cdn.amcharts.com/lib/4/themes/animated.js')}}"></script>

	<script src="{{asset('admin/assets/vendor_components/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('admin/assets/vendor_components/sweetalert/jquery.sweet-alert.custom.js')}}"></script>
	
	<script src="{{asset('admin/js/template.js')}}"></script>
	<script src="{{asset('admin/js/pages/dashboard.js')}}"></script>
    <script src="{{asset('admin/js/pages/toastr.js')}}"></script>
    <script src="{{asset('admin/js/pages/notification.js')}}"></script>
    <script src="{{asset('admin/assets/vendor_components/datatable/datatables.min.js')}}"></script>
	<script src="{{asset('admin/js/pages/data-table.js')}}"></script>
    <script src="{{asset('admin/assets/vendor_plugins/JqueryPrintArea/demo/jquery.PrintArea.js')}}"></script>
    <script src="{{asset('admin/js/pages/invoice.js')}}"></script>
</body>
</html>


