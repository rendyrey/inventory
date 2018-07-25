<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->

      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="{{url('dashboard')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Persediaan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i>Menu 1</a></li>
            <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i>Menu 2</a></li>
            <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i>Menu 3</a></li>
            <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i>Menu 4</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Produksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="header"><font color="gray">Pemotong-Pola (Pattern-Cutter)</font></li>
            <li><a href="{{url('list_order')}}"></i>List Order</a></li>
            <li><a href="{{url('order')}}"></i>Buat Order</a></li>
            <li><a href="{{url('terima_pola')}}">Terima Hasil Potong Pola</a></li>
            <li><a href="pages/UI/buttons.html">Pembayaran ke Pemotong-Pola</a></li>
            <li><a href="pages/UI/sliders.html">Retur Hasil Potong Pola</a></li>
            <li class="header"><font color="gray">Penjahit (Taylor)</font></li>
            <li><a href="pages/UI/timeline.html">Terima Hasil Jahitan</a></li>
            <li><a href="pages/UI/modals.html">Pembayaran ke Penjahit</a></li>
            <li><a href="pages/UI/modals.html">Retur Hasil Jahitan</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i>Menu 1</a></li>
            <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i>Menu 2</a></li>
            <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i>Menu 3</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Pemeliharaan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i>Menu 1</a></li>
            <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i>Menu 2</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Master Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('gudang')}}"><i class="fa fa-circle-o"></i>Gudang</a></li>
            <li><a href="{{url('bahan')}}"><i class="fa fa-circle-o"></i>Bahan</a></li>
            <li><a href="{{url('label')}}"><i class="fa fa-circle-o"></i>Label</a></li>
            <li><a href="{{url('model')}}"><i class="fa fa-circle-o"></i>Model</a></li>
            <li><a href="{{url('pola')}}"><i class="fa fa-circle-o"></i>Pola</a></li>
            <li><a href="{{url('warna')}}"><i class="fa fa-circle-o"></i>Warna</a></li>
            <li><a href="{{url('pemotong_pola')}}"><i class="fa fa-circle-o"></i>Pemotong Pola</a></li>
            <li><a href="{{url('produksi')}}"><i class="fa fa-circle-o"></i>Produksi</a></li>
          </ul>
        </li>
        <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
        {{-- <li class="header">LABELS</li> --}}
        {{-- <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li> --}}
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
