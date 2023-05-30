<!-- This is the blade file for the Header -->


<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">IUBAT (STCS)</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-nav">

  </div>
  <div class="btn-group" >
    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
      <i class="fas fa-user fa-fw"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start" style="right: 0; left: auto; ">
    <li><a class="dropdown-item" href="{{route('admin_profile')}}">Profile</a></li>
      <li><a class="dropdown-item" href="#!">Activity Log</a></li>
      <li>
        <hr class="dropdown-divider" />
      </li>
      <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
    </ul>
  </div>
  
</header>

<script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>