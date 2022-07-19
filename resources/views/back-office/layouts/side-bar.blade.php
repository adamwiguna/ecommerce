<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="{{ route('back-office.super-admin.dashboard') }}">{{ config('app.name') }}</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
      </div>
      <ul class="sidebar-menu">
          <li class="{{ request()->routeIs('back-office.super-admin.dashboard')?'active':'' }}"><a class="nav-link" href="{{ route('back-office.super-admin.dashboard') }}"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
          
          <li class="menu-header">Master-Data</li>
          <li class="{{ request()->routeIs('back-office.super-admin.category.*')?'active':'' }}"><a class="nav-link" href="{{ route('back-office.super-admin.category.index') }}"><i class="fas fa-sitemap"></i><span>Category</span></a></li>
          <li class="{{ request()->routeIs('back-office.super-admin.product.*')?'active':'' }}"><a class="nav-link" href="{{ route('back-office.super-admin.product.index') }}"><i class="fas fa-chess-knight"></i> <span>Product</span></a></li>
          <li class="{{ request()->routeIs('back-office.super-admin.customer.*')?'active':'' }}"><a class="nav-link" href="{{ route('back-office.super-admin.customer.index') }}"><i class="fas fa-coins"></i> <span>Customer</span></a></li>
          <li><a class="nav-link" href="layout-top-navigation.html"><i class="fas fa-users"></i></i><span>User</span></a></li>
          
          <li class="menu-header">Transaction</li>
          <li class="{{ request()->routeIs('back-office.super-admin.cart.*')?'active':'' }}"><a class="nav-link" href="{{ route('back-office.super-admin.cart.index') }}"><i class="fas fa-shopping-cart"></i><span>Cart</span></a></li>
          <li class="{{ request()->routeIs('back-office.super-admin.order.*')?'active':'' }}"><a class="nav-link" href="{{ route('back-office.super-admin.order.index') }}"><i class="fas fa-clipboard"></i><span>Booking</span></a></li>
          <li ><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a></li>
         
    </aside>
  </div>