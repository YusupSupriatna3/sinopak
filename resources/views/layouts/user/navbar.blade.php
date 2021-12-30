<div class="container">
  <a class="navbar-brand" href="{{ url('home') }}">
  <img src="{{ url('assets/SINOPAK2.png') }}" width="30" height="30" alt="SINOPAK"> <strong>SINOPAK</strong></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="{{ url('home') }}"><i class="fa fa-home"></i> Home</span></a>
      </li>
      <li class="nav-item active dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-wrench"></i>  Tools
        </a>
        <!-- <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#"><i class="fa fa-search"></i> Search Account</a>
          <a class="dropdown-item" href="#"><i class="fa fa-envelope"></i> Surat Pembayaran</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Tutorial Bootstrap</a>
        </div> -->
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="{{ route('view-search-account') }}"><i class="fa fa-search"></i> Search Account</a></li>
          <li class="dropdown-submenu">
            <a class="dropdown-item dropdown-toggle" href="#"><i class="fa fa-envelope"></i> Surat Pembayaran</a></a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ route('view-cek-pembayaran') }}"><i class="fa fa-check"></i> Cek Pembayaran</a></li>
              <li><a class="dropdown-item" href="{{ route('cetak-pembayaran') }}"><i class="fa fa-pencil"></i> Create Surat Pembayaran</a></li>
            </ul>
          </li>
          <li class="dropdown-submenu">
            <a class="dropdown-item dropdown-toggle" href="#"><i class="fa fa-file-archive-o"></i> NPK</a></a>
            <ul class="dropdown-menu">
              <li class="dropdown-submenu">
                <a class="dropdown-item dropdown-toggle" href="#"><i class="fa fa-pencil"></i> Create NPK</a></a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{ route('view-create-npk') }}"><i class="fa fa-pencil"></i> AP Management</a></li>
                  <li><a class="dropdown-item" href="{{ route('view-create-npk-mkt') }}"><i class="fa fa-pencil"></i> Marketing Fee</a></li>
                  <!-- <li><a class="dropdown-item" href="#"><i class="fa fa-upload"></i> Upload From Excel</a></li> -->
                </ul>
              </li>
              <li class="dropdown-submenu">
                <a class="dropdown-item dropdown-toggle" href="#"><i class="fa fa-list"></i> Data NPK</a></a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{ route('view-data-npk') }}"><i class="fa fa-arrow-right"></i> AP Management</a></li>
                  <li><a class="dropdown-item" href="{{ route('view-data-npk-mkt') }}"><i class="fa fa-arrow-right"></i> Marketing Fee</a></li>
                </ul>
              </li>
              <li class="dropdown-submenu">
                <a class="dropdown-item dropdown-toggle" href="#"><i class="fa fa-download"></i> Download To Excel</a></a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{ route('export-to-excel') }}"><i class="fa fa-download"></i> AP Management</a></li>
                  <li><a class="dropdown-item" href="{{ route('export-to-excel-mkt') }}"><i class="fa fa-download"></i> Marketing Fee</a></li>
                </ul>
              </li>
            </ul>
          </li>
        </ul>
      </li>
      <li class="nav-item active dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-user"></i>  {{ Auth::user()->name }}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <!-- <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a> -->
          <a class="dropdown-item" href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> Logout</a>
        </div>
      </li>
    </ul>
  </div>
</div>