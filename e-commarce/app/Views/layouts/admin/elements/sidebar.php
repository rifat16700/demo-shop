<div class="main-sidebar sidebar-style-2">
   <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
         <a href="<?= admin_url(); ?>"> <img alt="image" src="<?= get_logo() ?>" class="header-logo" />
         </a>
         <!-- Mobile Close Button -->
         <button id="sidebar-close-btn" aria-label="Close Menu" onclick="window.closeMobileSidebar(event)">
           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
         </button>
      </div>

      <ul class="sidebar-menu">
         <li class="menu-header">Main</li>
         <li class="dropdown">
            <a href="<?= admin_url('dashboard') ?>" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
         </li>
         <li class="dropdown">
            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="briefcase"></i><span>Transactions</span></a>
            <ul class="dropdown-menu">
               <li><a class="nav-link" href="<?= admin_url('transactions') ?>">Transactions</a></li>
               <li><a class="nav-link" href="<?= admin_url('bank_transactions') ?>">Bank Transactions</a></li>
            </ul>
         </li>
         <li class="dropdown">
            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="user"></i><span>Users</span></a>
            <ul class="dropdown-menu">
               <li><a class="nav-link" href="<?= admin_url('users') ?>">Users</a></li>
               <li><a class="nav-link ajaxModal" href="<?= admin_url('users/update') ?>">Add user</a></li>
               <li><a class="nav-link" href="<?= admin_url('user-plan') ?>">User Plans</a></li>
            </ul>
         </li>
         <li class="dropdown">
            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Staffs</span></a>
            <ul class="dropdown-menu">
               <li><a class="nav-link" href="<?= admin_url('staffs') ?>">Staffs</a></li>
               <li><a class="nav-link ajaxModal" href="<?= admin_url('staffs/update') ?>">Add staff</a></li>
            </ul>
         </li>

         <li class="dropdown">
            <a href="<?= admin_url('devices') ?>" class="nav-link"><i data-feather="smartphone"></i><span>Devices</span></a>
         </li>
         <li class="dropdown">
            <a href="<?= admin_url('brands') ?>" class="nav-link"><i data-feather="shopping-cart"></i><span>Brands</span></a>
         </li>


         <li class="dropdown">
            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="pie-chart"></i><span>Settings</span></a>
            <ul class="dropdown-menu">
               <li><a class="nav-link" href="<?= admin_url('settings') ?>">Settings</a></li>
               <li><a class="nav-link" href="<?= admin_url('blogs') ?>">Blogs</a></li>
               <li><a class="nav-link" href="<?= admin_url('faqs') ?>">Faqs</a></li>
               <li><a class="nav-link" href="<?= admin_url('plans') ?>">Plans</a></li>
               <li><a class="nav-link" href="<?= admin_url('coupon') ?>">Coupons</a></li>
            </ul>
         </li>



         <li class="menu-header">Others</li>
         <li class="dropdown">
            <a href="<?= admin_url('reviews') ?>" class="nav-link"><i data-feather="star"></i><span>Manage Reviews</span></a>
         </li>
         <li class="dropdown">
            <a href="<?= admin_url('payments') ?>" class="nav-link"><i data-feather="send"></i><span>Payment Methods</span></a>
         </li>
         <li class="dropdown">
            <a href="<?= admin_url('tickets') ?>" class="nav-link"><i data-feather="mail"></i><span>Tickets</span></a>
         </li>

         <li class="dropdown">
            <a href="<?= admin_url('addons') ?>" class="nav-link"><i data-feather="gift"></i><span>Addons</span></a>
         </li>

         

         <li class="dropdown">
            <a href="<?= admin_url('cache-clean') ?>" class="nav-link"><i data-feather="trash"></i><span>Cache Clean</span></a>
         </li>


<li>
          <a href="<?=base_url()?>" target="_blank"><i data-feather="globe"></i>Main Site</a>
        </li>

      </ul>
   </aside>
</div>