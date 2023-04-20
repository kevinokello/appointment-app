 <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="{{route('user.dashboard')}}">{{__(@$general->sitename)}}</a>
          </div>
          <ul class="sidebar-menu">
              <li class="nav-item dropdown {{activeMenu('user.dashboard')}}">
                <a href="{{route('user.dashboard')}}" class="nav-link"><i class="fas fa-home"></i><span>{{$navbar['Dashboard']}}</span></a>
              </li> 
              

              @if(auth()->user()->user_type == 2)
        

               <li class="nav-item dropdown {{activeMenu('user.provider.booking*')}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-luggage-cart"></i> <span>{{$navbar['Bookings']}}</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="{{route('user.provider.booking')}}">{{$navbar['All Bookings']}}</a></li>
                </ul>
              </li>
              
            
              
              @else


              <li class="nav-item dropdown {{activeMenu('user.bookings*')}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-luggage-cart"></i> <span>{{$navbar['Bookings']}}</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="{{route('user.bookings')}}">{{$navbar['All Bookings']}}</a></li>
                </ul>
              </li>
              @endif

             
          </ul>
        </aside>