
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="/dist/img/flosLogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Flos POS system</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <div style="color: #83a598" class="d-block">{{$user->name}} {{$user->surname}}</div>
            </div>
            <div class="info">
                <a class="btn btn-warning btn-sm" style="color: #0a0e14" href="{{route('home')}}">Logout</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="bg-white">
            ID zamówienia: {{$order->orderId}}
            @foreach($var as $product)
                <div name="product" style="border-bottom: #0a0e14; border-style: dotted">
                    <br>
                    <h2>{{$product->productName}}</h2>
                    <h4>{{$product->category}}</h4>
                    <h5>{{$product->productPrice}}</h5>
                    Quantity:
                    <br>
                    round: {{++$round}}
                    <br>
                    {{$user->id}}
                    {{$orderId}}
                    <form action="{{ url('/user', [$user->id, $orderId, $round]) }}" method="post">
                        @csrf
                        <input class="input invisible" type="text" name="deletedProductName" value="{{$product->productName}}"/>
                        <button class="btn btn-danger" type="submit">Delete</button>
                        @method('delete')
                    </form>
                </div>
            @endforeach
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
