
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/uploads/admin_profile/{{Auth::user()->image}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
            <a href="{{route('admin.includes.dashboard')}}">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-book"></i> <span>Category</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{route('admin.category.index') }}"><i class="fa fa-circle-o"></i>View Category</a></li>
              <li><a href="{{route('admin.category.create')}}"><i class="fa fa-circle-o"></i>Create Category</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-book"></i> <span>Products</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{route('admin.product.index') }}"><i class="fa fa-circle-o"></i>View Products</a></li>
              <li><a href="{{route('admin.product.create')}}"><i class="fa fa-circle-o"></i>Create Products</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-book"></i> <span>Transactions</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{route('admin.transaction.index') }}"><i class="fa fa-circle-o"></i>View Purchase</a></li>
              <li><a href="{{route('admin.transaction.create')}}"><i class="fa fa-circle-o"></i>Create Purchase</a></li>
              <li><a href="{{route('admin.sale.index')}}"><i class="fa fa-circle-o"></i>View Sale</a></li>
              <li><a href="{{route('admin.sale.create')}}"><i class="fa fa-circle-o"></i>Create Sale</a></li>
            </ul>
          </li>
        <li>
        <a href="{{route('admin.inventories.index')}}">
            <i class="fa fa-dashboard"></i> <span>Inventories</span>
        </a>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
