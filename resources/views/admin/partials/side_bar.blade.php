 <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="{{route('admin.dashboard')}}">APPOINTMENT BOOKING</a>
          </div>
          <ul class="sidebar-menu">
              <li class="nav-item dropdown {{activeMenu('admin.dashboard')}}">
                <a href="{{route('admin.dashboard')}}" class="nav-link"><i class="fas fa-home"></i><span> @changeLang('Dashboard') </span></a>
              </li>
       
              <li class="nav-item dropdown {{activeMenu('admin.dashboard')}}">
                <a href="{{url('admin/bookings')}}" class="nav-link"><i class="fas fa-home"></i><span> @changeLang('Bookings') </span></a>
              </li>
              <li class="nav-item dropdown {{activeMenu('admin.dashboard')}}">
                <a href="{{url('admin/business-hours')}}" class="nav-link"><i class="fas fa-home"></i><span> @changeLang('Business Hours') </span></a>
              </li>
          
              <li class="nav-item dropdown {{activeMenu('admin.provider*')}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user"></i> <span>@changeLang('Manage Doctors')</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="{{route('admin.provider')}}">@changeLang('All Doctors')</a></li>
                 
                </ul>
              </li>  
              
              
              <li class="nav-item dropdown {{activeMenu('admin.user*')}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user"></i> <span>@changeLang('Manage user')</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="{{route('admin.user')}}">@changeLang('All users')</a></li>
                  <li><a class="nav-link" href="{{route('admin.user.disabled')}}">@changeLang('Disabled users')</a></li>
                 
                </ul>
              </li>  
    
     
          
          </ul>
        </aside>