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
          
          <li class="menu-header">Transaction</li>
          <li class="{{ request()->routeIs('back-office.super-admin.cart.*')?'active':'' }}"><a class="nav-link" href="{{ route('back-office.super-admin.cart.index') }}"><i class="fas fa-shopping-cart"></i><span>Cart</span></a></li>
      
          <li class="nav-item dropdown {{ request()->routeIs('back-office.super-admin.order.*')?'active':'' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-money-bill"></i> <span>Order</span></a>
            <ul class="dropdown-menu ">
              <li class="{{ request()->routeIs('back-office.super-admin.order.index')?'active':'' }}"><a class="nav-link" href="{{ route('back-office.super-admin.order.index') }}">On Process({{ \App\Models\Order::whereNull('done')->whereNull('canceled')->count() }})</a></li>
              <li class="{{ request()->routeIs('back-office.super-admin.order.done')?'active':'' }}"><a class="nav-link" href="{{ route('back-office.super-admin.order.done') }}">Done ({{ \App\Models\Order::whereNotNull('done')->count() }})</a></li>
              <li class="{{ request()->routeIs('back-office.super-admin.order.cancel')?'active':'' }}"><a class="nav-link" href="{{ route('back-office.super-admin.order.cancel') }}">Cancel ({{ \App\Models\Order::whereNotNull('canceled')->count() }})</a></li>
            </ul>
          </li>
          <li class="menu-header">Website Manager</li>
          <li class="{{ request()->routeIs('back-office.super-admin.slider.*')?'active':'' }}"><a class="nav-link" href="{{ route('back-office.super-admin.slider.index') }}"><i class="fas fa-image"></i> <span>Slider</span></a></li>
          {{-- <li class="{{ request()->routeIs('back-office.super-admin.best-seller.*')?'active':'' }}"><a class="nav-link" href="{{ route('back-office.super-admin.best-seller.product.index') }}"><i class="fas fa-sitemap"></i><span>Best Seller</span></a></li>
          <li class="{{ request()->routeIs('back-office.super-admin.new-arrival.*')?'active':'' }}"><a class="nav-link" href="{{ route('back-office.super-admin.new-arrival.product.index') }}"><i class="fas fa-sitemap"></i><span>New Arrival</span></a></li> --}}
          <li class="menu-header">Master-Data</li>
          <li class="{{ request()->routeIs('back-office.super-admin.category.*')?'active':'' }}"><a class="nav-link" href="{{ route('back-office.super-admin.category.index') }}"><i class="fas fa-sitemap"></i><span>Category</span></a></li>
          <li class="{{ request()->routeIs('back-office.super-admin.product.*')?'active':'' }}"><a class="nav-link" href="{{ route('back-office.super-admin.product.index') }}"><i class="fas fa-chess-knight"></i> <span>Product</span></a></li>
          <li class="{{ request()->routeIs('back-office.super-admin.customer.*')?'active':'' }}"><a class="nav-link" href="{{ route('back-office.super-admin.customer.index') }}"><i class="fas fa-coins"></i> <span>Customer</span></a></li>
          <li><a class="nav-link" href="layout-top-navigation.html"><i class="fas fa-users"></i></i><span>User</span></a></li>
                  
    </aside>
  </div>