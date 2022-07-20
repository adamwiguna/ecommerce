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
      
          <li class="nav-item dropdown {{ request()->routeIs('back-office.super-admin.order.*')?'active':'' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-money-bill"></i> <span>Order</span></a>
            <ul class="dropdown-menu ">
              <li class="{{ request()->routeIs('back-office.super-admin.order.index')?'active':'' }}"><a class="nav-link" href="{{ route('back-office.super-admin.order.index') }}">On Process({{ \App\Models\Order::where('done', 0)->where('canceled', 0)->count() }})</a></li>
              <li class="{{ request()->routeIs('back-office.super-admin.order.done')?'active':'' }}"><a class="nav-link" href="{{ route('back-office.super-admin.order.done') }}">Done ({{ \App\Models\Order::where('done', 1)->count() }})</a></li>
              <li class="{{ request()->routeIs('back-office.super-admin.order.cancel')?'active':'' }}"><a class="nav-link" href="{{ route('back-office.super-admin.order.cancel') }}">Cancel ({{ \App\Models\Order::where('canceled', 1)->count() }})</a></li>
            </ul>
          </li>
          {{-- <li class="nav-item dropdown active">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i> <span>Bootstrap</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="bootstrap-card.html">Card</a></li>
              <li><a class="nav-link" href="bootstrap-carousel.html">Carousel</a></li>
              <li class="active"><a class="nav-link" href="bootstrap-collapse.html">Collapse</a></li>
              <li><a class="nav-link" href="bootstrap-dropdown.html">Dropdown</a></li>
              <li><a class="nav-link" href="bootstrap-form.html">Form</a></li>
              <li><a class="nav-link" href="bootstrap-list-group.html">List Group</a></li>
            </ul>
          </li> --}}
         
    </aside>
  </div>