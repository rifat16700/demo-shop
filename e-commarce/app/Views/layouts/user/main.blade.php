<!DOCTYPE html>
<html lang="en">
<head>
  <title><?=!empty($title)?$title.' - '.site_config("site_title","author"):site_config("site_title","author")?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <meta name="author" content="<?=site_config('site_description','author')?>">
  <meta name="description" content="<?=site_config('site_description','Site desc')?>">
  <meta name="theme-color" content="#3f71e6">
  <meta property="og:url" content="<?= current_url(true)?>">
  <meta property="og:site_name" content="<?=site_config("site_name","My Site")?>">
  <link rel="shortcut icon" href="<?=get_logo(true);?>">

  <?=link_asset('blithe/css/app.min.css');?>
  <?=link_asset('blithe/css/style.css');?>
  <?= link_asset('js/jquery-toast/css/jquery.toast.css') ?>
  <?=link_asset('js/select2/css/select2.min.css')?>
  <?=link_asset('blithe/css/components.css');?>
  <?=link_asset('blithe/css/jqvmap.min.css');?>
  <link type="text/css" href="<?=base_url('public/assets/css/dashboard-theme.css')?>?v=<?=time()?>" rel="stylesheet"/>
  <?=script_asset("blithe/js/app.min.js");?>
  <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script type="text/javascript">
    var token = '<?= csrf_hash() ?>', PATH = '<?=base_url()?>', user='user';
    </script>
    <script type="text/javascript">
    /* PREMIUM DASHBOARD CORE SYSTEM - AGGRESSIVE FIX */
    window.openMobileSidebar = function(e) {
      if(e) { e.preventDefault(); e.stopPropagation(); }
      document.body.classList.add('mobile-sidebar-active');
      document.body.style.setProperty('overflow', 'hidden', 'important');
    };

    window.closeMobileSidebar = function(e) {
      if(e) { e.preventDefault(); e.stopPropagation(); }
      document.body.classList.remove('mobile-sidebar-active');
      document.body.style.removeProperty('overflow');
      document.body.style.overflow = '';
    };

    window.toggleMobileSidebar = function(e) {
      if(e) { e.preventDefault(); e.stopPropagation(); }
      if (document.body.classList.contains('mobile-sidebar-active')) {
        window.closeMobileSidebar(e);
      } else {
        window.openMobileSidebar(e);
      }
    };

    window.toggleTheme = function(e) {
      if (e) { e.preventDefault(); e.stopPropagation(); }
      const isLight = document.body.classList.toggle('light-mode');
      localStorage.setItem('theme-mode', isLight ? 'light' : 'dark');
      updateThemeIcon(isLight);
    };

    function updateThemeIcon(isLight) {
      const icons = document.querySelectorAll('.theme-toggle-btn i');
      icons.forEach(function(icon) {
        icon.className = isLight ? 'fas fa-moon' : 'fas fa-sun';
      });
    }

    /* Initialize Theme */
    const savedTheme = localStorage.getItem('theme-mode');
    if (savedTheme === 'light') {
      document.body.classList.add('light-mode');
      document.addEventListener('DOMContentLoaded', function() { updateThemeIcon(true); });
    }

    /* FORCE BIND TO DOCUMENT WITH JQUERY & VANILLA */
    document.addEventListener('DOMContentLoaded', function() {
      /* Vanilla Capturing Listener */
      document.addEventListener('click', function(e) {
        let target = e.target;
        if (!target) return;
        if (target.nodeType === 3) target = target.parentNode;
        if (!target || typeof target.closest !== 'function') return;
        
        if (target.closest('#sidebar-close-btn')) {
          window.closeMobileSidebar(e);
        }
        
        if (target.id === 'sidebar-overlay' || target.closest('#sidebar-overlay')) {
          window.closeMobileSidebar(e);
        }
        
        if (document.body.classList.contains('mobile-sidebar-active')) {
          if (!target.closest('.main-sidebar') && !target.closest('#mobile-menu-btn') && !target.closest('#sidebar-close-btn')) {
            window.closeMobileSidebar(e);
          }
        }
      }, true);

      /* jQuery Bubble Listener Fallback */
      if (typeof jQuery !== 'undefined') {
        $(document).on('click', '#sidebar-overlay, #sidebar-close-btn', function(e) {
            e.preventDefault();
            e.stopPropagation();
            window.closeMobileSidebar();
        });
      }
    });

    /* Swipe Gestures for Mobile */
    let touchStartX = 0;
    document.addEventListener('touchstart', function(e) { touchStartX = e.touches[0].clientX; }, { passive: true });
    document.addEventListener('touchend', function(e) {
      const dx = e.changedTouches[0].clientX - touchStartX;
      if (Math.abs(dx) > 70) {
        if (dx > 0 && touchStartX < 40) window.openMobileSidebar();
        else if (dx < 0 && document.body.classList.contains('mobile-sidebar-active')) window.closeMobileSidebar();
      }
    }, { passive: true });

    /* Keyboard support */
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') window.closeMobileSidebar();
    });
    </script>
</head>

<body>
  <!-- Sidebar overlay for mobile -->
  <div id="sidebar-overlay" onclick="window.closeMobileSidebar()"></div>

  <div id="app">
    <div class="main-wrapper main-wrapper-1">

      <!-- Navbar -->
      <?php include 'elements/navbar.php'; ?>

      <!-- Sidebar -->
      <?php include 'elements/sidebar.php'; ?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <?=view($view);?>
        </section>
      </div>

    </div>
  </div>

  <!-- Scripts -->
  <?=script_asset("blithe/js/scripts.js");?>
  <?=script_asset('js/notify.min.js')?>
  <?=script_asset('js/tinymce/tinymce.min.js')?>
  <?=script_asset('js/jquery-toast/js/jquery.toast.js')?>
  <?=script_asset('js/process2.js')?>
  <?=script_asset('js/general.js')?>
  <?=script_asset('js/select2/js/select2.full.min.js')?>
  <?=script_asset('js/admin.js')?>
  <?=script_asset('js/jquery-upload/js/vendor/jquery.ui.widget.js')?>
  <?=script_asset('js/jquery-upload/js/jquery.iframe-transport.js')?>
  <?=script_asset('js/jquery-upload/js/jquery.fileupload.js')?>

  <?php if ($msg = session()->getFlashdata('message')) : ?>
  <script type="text/javascript">
    notify('<?= esc($msg['message']) ?>', '<?= esc($msg['status']) ?>');
  </script>
  <?php endif; ?>

  <div id="modal-ajax" class="modal fade"></div>

  <?=script_asset('js/jquery-ui.min.js')?>
  <?=script_asset('js/blithe.js')?>

  <?php if (get_option('enable_panel_notification_popup') == 1 && get_cookie('panel_popup') != 1) : ?>
    <?php set_cookie("panel_popup", "1", 180); ?>
    <div class="modal zoom-in" id="notification" tabindex="-1" aria-labelledby="notificationLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content" style="border-radius:14px;border:1px solid var(--border);">
          <div class="modal-header">
            <h5 class="modal-title" id="notificationLabel">
              <i class="bi bi-megaphone"></i> Announcement
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <?= get_option('notification_popup_panel_content') ?>
          </div>
        </div>
      </div>
    </div>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
          var notificationModal = new bootstrap.Modal(document.getElementById('notification'));
          notificationModal.show();
        }, 500);
      });
    </script>
  <?php endif; ?>

  <?php echo htmlspecialchars_decode(get_option('embed_head_javascript', ''), ENT_QUOTES); ?>
</body>
</html>