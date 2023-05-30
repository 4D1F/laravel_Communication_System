<div id="layoutSidenav">
  <div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
      <div class="sb-sidenav-menu">
        <div class="nav">
          <div class="sb-sidenav-menu-heading">Core</div>
          <a class="nav-link" href="{{route('dashboard')}}">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
            Dashboard
          </a>
          <a class="nav-link" href="/chatify">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
            Messenger
          </a>
          <a class="nav-link" href="{{route('user_profile')}}">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
            Profile
          </a>
          
          
          
        </div>
      </div>
      <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        {{Auth::user()->name}}
      </div>
    </nav>
  </div>
  <div id="layoutSidenav_content">
    <main class="col-md-9 ms-sm-auto col-lg-12 px-md-4">
      @yield('content')
    </main>
    <footer class="py-4 bg-light mt-auto">
      <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
          <div class="text-muted">Copyright &copy; Your Website 2022</div>
          <!-- <div>
            <a href="#">Privacy Policy</a>
            &middot;
            <a href="#">Terms &amp; Conditions</a>
          </div> -->
        </div>
      </div>
    </footer>
  </div>
</div>