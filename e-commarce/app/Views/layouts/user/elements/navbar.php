<nav class="navbar navbar-expand-lg main-navbar sticky">
   <div class="form-inline me-auto" style="display:flex;align-items:center;">
      <!-- Mobile hamburger (Hidden on Desktop via CSS) -->
      <button id="mobile-menu-btn" aria-label="Menu" onclick="window.toggleMobileSidebar(event)">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
      </button>
   </div>
   <ul class="navbar-nav navbar-right">
      <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
            <i data-feather="maximize"></i>
         </a></li>
      <li><a href="javascript:void(0)" class="nav-link nav-link-lg theme-toggle-btn" onclick="window.toggleTheme(event)">
            <i class="fas fa-sun"></i>
          </a></li>
      <li class="dropdown dropdown-list-toggle"><a href="#" data-bs-toggle="dropdown" class="nav-link nav-link-lg message-toggle"><i data-feather="bell" class="mailAnim"></i>
            <span class="badge headerBadge1">
            </span> </a>
         <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
            <div class="dropdown-header">
               Notifications
               <div class="float-right">
                  <a href="#">Mark All As Read</a>
               </div>
            </div>
            <div class="dropdown-list-content dropdown-list-message">
               <a href="#" class="dropdown-item">
                  <span class="dropdown-item-desc">
                     <span class="message-user">No Notification found</span>
                  </span>
               </a>

            </div>
            <div class="dropdown-footer text-center">
               <a href="#">View All <i class="fas fa-chevron-right"></i></a>
            </div>
         </div>
      </li>

      <li class="dropdown"><a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="<?= get_avatar('user') ?>" class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
         <div class="dropdown-menu dropdown-menu-right pullDown">
            <div class="dropdown-title">Hello <?= current_user('first_name'); ?></div>
            <a href="<?= user_url('profile') ?>" class="dropdown-item has-icon">
               <i class="far fa-user"></i> Profile
            </a>
            <a href="<?= user_url('affiliates') ?>" class="dropdown-item has-icon">
               <i class="fas fa-cog"></i> Affiliates
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?= user_url("logout") ?>" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
               Logout
            </a>
         </div>
      </li>
   </ul>
</nav>