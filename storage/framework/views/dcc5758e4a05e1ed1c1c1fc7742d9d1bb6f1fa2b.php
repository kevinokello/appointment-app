 <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="<?php echo e(route('admin.dashboard')); ?>">APPOINTMENT BOOKING</a>
          </div>
          <ul class="sidebar-menu">
              <li class="nav-item dropdown <?php echo e(activeMenu('admin.dashboard')); ?>">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link"><i class="fas fa-home"></i><span> Dashboard </span></a>
              </li>
       
              <li class="nav-item dropdown <?php echo e(activeMenu('admin.dashboard')); ?>">
                <a href="<?php echo e(url('admin/bookings')); ?>" class="nav-link"><i class="fas fa-home"></i><span> Bookings </span></a>
              </li>
              <li class="nav-item dropdown <?php echo e(activeMenu('admin.dashboard')); ?>">
                <a href="<?php echo e(url('admin/business-hours')); ?>" class="nav-link"><i class="fas fa-home"></i><span> Business Hours </span></a>
              </li>
          
              <li class="nav-item dropdown <?php echo e(activeMenu('admin.provider*')); ?>">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user"></i> <span>Manage Doctors</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="<?php echo e(route('admin.provider')); ?>">All Doctors</a></li>
                 
                </ul>
              </li>  
              
              
              <li class="nav-item dropdown <?php echo e(activeMenu('admin.user*')); ?>">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user"></i> <span>Manage User</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="<?php echo e(route('admin.user')); ?>">All Users</a></li>
                  <li><a class="nav-link" href="<?php echo e(route('admin.user.disabled')); ?>">Disabled Users</a></li>
                 
                </ul>
              </li>  
    
     
          
          </ul>
        </aside><?php /**PATH C:\Users\kevin\OneDrive\Desktop\cyriz\mine\booking\resources\views/admin/partials/side_bar.blade.php ENDPATH**/ ?>