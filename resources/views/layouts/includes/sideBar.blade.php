<aside id="sidebar">
    <div class="h-100">
        <div class="sidebar-logo">
            <a class="navbar-brand" href="{{ url('/home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Shop Logo" width="80" height="70">
            </a>
        </div>
        {{-- sidebar navigation --}}
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                {{ config('app.name', 'Laravel') }}
            </li>
            <li class="sidebar-item {{ Route::currentRouteName() === 'home' ? 'active' : '' }}">
                <a href="{{ route('home')}}" class="sidebar-link">
                    <i class="fa-fw fa-solid fa-chart-line pe-2"></i>
                    Dashboard
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#peoples" aria-expanded="false" aria-controls="peoples">
                    <i class="fa-fw fa-solid fa-users-line pe-2"></i>
                    Peoples
                </a>
                <ul id="peoples" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item {{ Route::currentRouteName() === 'users.index' ? 'active' : '' }}">
                        <a href={{ route('users.index') }} class="sidebar-link">
                            <i class=" fa-fw fa-solid fa-user pe-2"></i>
                            Users List
                        </a>
                    </li>
                    <li class="sidebar-item {{ Route::currentRouteName() === 'users.create' ? 'active' : '' }}">
                        <a href={{ route('users.create') }} class="sidebar-link">
                            <i class=" fa-fw fa-solid fa-user-plus pe-2"></i>
                            Create Users
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class=" fa-fw fa-solid fa-users pe-2"></i>
                            Customers
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class=" fa-fw fa-solid fa-users-viewfinder pe-2"></i>
                            Create Customers
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#products" aria-expanded="false" aria-controls="products">
                    <i class="fa-fw fa-solid fa-boxes-stacked pe-2"></i>
                    Products
                </a>
                <ul id="products" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item {{ Route::currentRouteName() === 'products.index' ? 'active' : '' }}">
                        <a href={{ route('products.index') }} class="sidebar-link">
                            <i class=" fa-fw fa-solid fa-box-open pe-2"></i>
                            Products List
                        </a>
                    </li>
                    <li class="sidebar-item {{ Route::currentRouteName() === 'products.create' ? 'active' : '' }}">
                        <a href={{ route('products.create') }} class="sidebar-link">
                            <i class=" fa-fw fa-solid fa-square-plus pe-2"></i>
                            Create Product
                        </a>
                    </li>
                    <li class="sidebar-item {{ Route::currentRouteName() === 'categories.index' ? 'active' : '' }}">
                        <a href={{ route('categories.index') }} class="sidebar-link">
                            <i class=" fa-fw fa-solid fa-layer-group pe-2"></i>
                            Category
                        </a>
                    </li>
                    <li class="sidebar-ite{{ Route::currentRouteName() === 'categories.create' ? 'active' : '' }}m ">
                        <a href={{ route('categories.create') }} class="sidebar-link">
                            <i class=" fa-fw fa-solid fa-square-plus pe-2"></i>
                            Create Category
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#sales" aria-expanded="false" aria-controls="sales">
                    <i class="fa-fw fa-solid fa-comments-dollar pe-2"></i>
                    Sales
                </a>
                <ul id="sales" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item {{ Route::currentRouteName() === 'orders.index' ? 'active' : '' }}">
                        <a href={{ route('orders.index') }} class="sidebar-link">
                            <i class=" fa-fw fa-solid fa-desktop pe-2"></i>
                            POS Counter
                        </a>
                    </li>
                    <li class="sidebar-item {{ Route::currentRouteName() === 'transactions.index' ? 'active' : '' }}">
                        <a href={{ route('transactions.index') }} class="sidebar-link">
                            <i class=" fa-fw fa-solid fa-clipboard pe-2"></i>
                            Sale Records
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class=" fa-fw fa-solid fa-file pe-2"></i>
                            Sale Report
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="fa-fw fa-solid fa-address-card pe-3"></i>
                    Profile
                </a>
            </li>
        </ul>
    </div>
</aside>
