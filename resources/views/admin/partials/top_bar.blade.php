 <nav class="navbar navbar-expand-lg main-navbar">
    
          <ul class="navbar-nav mr-auto">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
      
        <ul class="navbar-nav navbar-right">

     
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">{{auth()->guard('admin')->user()->username}}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="{{route('admin.profile')}}" class="dropdown-item has-icon">
                <i class="far fa-user"></i> @changeLang('Profile')
              </a>
              
              <div class="dropdown-divider"></div>
              <a href="{{route('admin.logout')}}" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> @changeLang('Logout')
              </a>
            </div>
          </li>
        </ul>
      </nav>