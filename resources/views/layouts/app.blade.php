<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Anwarul Islam & Sons</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link href="{{ asset('vali/css/jquery-ui.css') }}" type="text/css" rel="stylesheet" />
    <!-- Styles -->
    <!-- <link href="{{ asset('vali/css/bootstrap.min.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('vali/css/toastr.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet">
    <link href="{{ asset('vali/css/select2-bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vali/css/filter-table.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/pm/gijgo@1.9.4/combined/css/gijgo.min.css" rel="stylesheet" type="text/css" /> -->
    <link rel="stylesheet" href="{{ asset('vali/css/table.css')}}">
    <link rel="stylesheet" href="{{ asset('vali/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('vali/css/main.css')}}">
    <link rel="stylesheet" href="{{ asset('vali/css/responsive.css')}}">
</head>
<body class="app sidebar-mini rtl">
    <div id="app">
    <header class="app-header">
        <a class="app-header__logo" href="{{ url('/admin/home') }}">
            Anwarul Islam & Sons 
        </a>
        <!-- Sidebar toggle button-->
        <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"><i class="fas fa-bars"></i></a>
        <!-- Navbar Right Menu-->
        <ul class="app-nav">
            @guest
                <li><a class="" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                <li><a class="" href="{{ route('register') }}">{{ __('Register') }}</a></li>
            @else
            <!-- User Menu-->
            <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i>{{('')}}</a>
                <ul class="dropdown-menu settings-menu dropdown-menu-right">
                    <!-- <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-cog fa-lg"></i> Settings</a></li> -->
                    <!-- <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-user fa-lg"></i> Profile</a></li> -->
                    <li>
                        <a class="dropdown-item" href="{{ route('profile') }}"><i class="fa fa-sign-out fa-lg"></i> Profile</a>

                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-lg"></i> Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        
                    </li>
                </ul>
            </li>
            @endguest
        </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="app-sidebar__user">
            <img class="app-sidebar__user-avatar img-fluid" src="{{ asset(Auth::user()->user_image) }}" alt="User Image">
            <div>
                <p class="app-sidebar__user-name">{{ Auth::user()->name }}</p>
                <p class="app-sidebar__user-designation">
                    @if(Auth::user()->admin)
                        Admin
                    @else
                        Manager
                    @endif    
                </p>
            </div>
        </div>
        <ul class="app-menu">
            <li>
                <a class="app-menu__item" href="{{ route('home') }}">
                    <i class="app-menu__icon fas fa-dove"></i>
                    <span class="app-menu__label">Dashboard</span>
                </a>
            </li>
            @if(!Auth::user()->admin)
            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fab fa-angellist"></i><span class="app-menu__label">Sale</span><i class="treeview-indicator fa fa-angle-right"></i></a>

                <ul class="treeview-menu">
                    <li>
                        <a class="treeview-item" href="{{ route('addInvoice') }}">
                            <i class="icon"></i> Add Invoice
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item" href="{{ route('return') }}">
                            <i class="icon"></i> Return
                        </a>
                    </li>
                </ul>
            </li>
            @endif
            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fab fa-angellist"></i><span class="app-menu__label">Cash</span><i class="treeview-indicator fa fa-angle-right"></i></a>

                <ul class="treeview-menu">
                    <li>
                        <a class="treeview-item" href="{{ route('cashInOuts') }}">
                            <i class="icon"></i> Cash In Outs
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item" href="{{ route('receivePayments') }}">
                            <i class="icon"></i> All Receive Payments
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item" href="{{ route('expenses') }}">
                            <i class="icon"></i> All Expenses
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item" href="{{ route('expenseFields') }}">
                            <i class="icon"></i> Expense Fields
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fab fa-angellist"></i><span class="app-menu__label">Product</span><i class="treeview-indicator fa fa-angle-right"></i></a>

                <ul class="treeview-menu">
                    <li>
                        <a class="treeview-item" href="{{ route('productTypes') }}">
                            <i class="icon"></i> All Product Types
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item" href="{{ route('productType.create') }}">
                            <i class="icon"></i> Add New Product Type
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item" href="{{ route('showInventory') }}">
                            <i class="icon"></i> Show Inventory
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item" href="{{ route('product.create') }}">
                            <i class="icon"></i> Add New Product
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item" href="{{ route('stock.create') }}">
                            <i class="icon"></i> Add Product to Stock
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fab fa-angellist"></i><span class="app-menu__label">Shops</span><i class="treeview-indicator fa fa-angle-right"></i></a>

                <ul class="treeview-menu">

                    <li>
                        <a class="treeview-item" href="{{ route('shops') }}">
                            <i class="icon"></i> All Shops
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item" href="{{ route('shop.create') }}">
                            <i class="icon"></i> Add New Shop
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fab fa-angellist"></i><span class="app-menu__label">Accounts</span><i class="treeview-indicator fa fa-angle-right"></i></a>

                <ul class="treeview-menu">
                    <li>
                        <a class="treeview-item" href="{{ route('debitNotes') }}">
                            <i class="icon"></i> All Debit Notes
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item" href="{{ route('debitNote.create') }}">
                            <i class="icon"></i> Add New Debit Note
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fab fa-angellist"></i><span class="app-menu__label">Clients</span><i class="treeview-indicator fa fa-angle-right"></i></a>

                <ul class="treeview-menu">

                    <li>
                        <a class="treeview-item" href="{{ route('clients') }}">
                            <i class="icon"></i> All Clients
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item" href="{{ route('client.create') }}">
                            <i class="icon"></i> Add New Client
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fab fa-angellist"></i><span class="app-menu__label">Suppliers</span><i class="treeview-indicator fa fa-angle-right"></i></a>

                <ul class="treeview-menu">

                    <li>
                        <a class="treeview-item" href="{{ route('suppliers') }}">
                            <i class="icon"></i> All Suppliers
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item" href="{{ route('supplier.create') }}">
                            <i class="icon"></i> Add New Supplier
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item" href="{{ route('supplier.allSupplierExpenses') }}">
                            <i class="icon"></i> All Supplier Expenses
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item" href="{{ route('supplier.supplierExpense') }}">
                            <i class="icon"></i> Add Supplier Expense
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item" href="{{ route('supplier.allSupplierBills') }}">
                            <i class="icon"></i> All Supplier Bills
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item" href="{{ route('supplier.supplierBill') }}">
                            <i class="icon"></i> Add Supplier Bill
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fab fa-angellist"></i><span class="app-menu__label">Reports</span><i class="treeview-indicator fa fa-angle-right"></i></a>

                <ul class="treeview-menu">

                    <li>
                        <a class="treeview-item" href="{{ route('salesReport') }}">
                            <i class="icon"></i> Sale Report
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item" href="{{ route('returnReport') }}">
                            <i class="icon"></i> Return Report
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item" href="{{ route('productEntryReport') }}">
                            <i class="icon"></i> Product Entry Report
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item" href="{{ route('financialInsight') }}">
                            <i class="icon"></i> Financial Insight
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="app-menu__item" href="{{ route('barcode.create') }}">
                    <i class="app-menu__icon fas fa-dove"></i>
                    <span class="app-menu__label">Print Barcode</span>
                </a>
            </li>
            @if(Auth::user()->admin)
                <li class="treeview">
                    <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fas fa-user"></i><span class="app-menu__label">Manager</span><i class="treeview-indicator fa fa-angle-right"></i></a>

                    <ul class="treeview-menu">

                        <li><a class="treeview-item" href="{{ route('managers') }}"><i class="icon"></i> All Managers </a></li>
                        <li><a class="treeview-item" href="{{ route('manager.create') }}"><i class="icon"></i> Add Manager </a></li>
                    </ul>
                </li>
            @endif
            </ul>
    </aside>
    <main class="app-content">
        
        @yield('content')
    </main>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('vali/js/jquery-3.3.1.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('vali/js/popper.min.js') }}" defer></script>
    <script type="text/javascript" language="javascript" src="{{ asset('vali/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('vali/js/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('vali/js/toastr.min.js') }}"></script>
    <script src="{{ asset('vali/js/table.js') }}"></script>
    <!-- =========New JS Files======== -->
    <script src="{{ asset('vali/js/plugins/bootstrap-notify.min.js')}}"></script>
    <script src="{{ asset('vali/js/plugins/moment.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
    <script src="{{ asset('vali/js/plugins/sweetalert.min.js')}}"></script>
    <script src="{{ asset('vali/js/plugins/fullcalendar.min.js')}}"></script>
    <script src="{{ asset('vali/js/plugins/pace.min.js')}}"></script>
    <!-- =========New JS Files======== -->
    <script src="{{ asset('vali/js/main.js')}}"></script>
    <script>
        @if(Session::has('success'))
            toastr.success("{{Session::get('success')}}");
        @endif

        @if(Session::has('error'))
            toastr.error("{{Session::get('error')}}");
        @endif
    </script>
</body>
</html>
