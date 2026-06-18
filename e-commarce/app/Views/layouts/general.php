<!doctype html>
<html lang="en">
<head>
    <title><?= !empty($title) ? $title . ' - ' . site_config("site_title", "author") : site_config("site_title", "author") ?></title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="author" content="<?= esc(site_config('site_description', 'author')) ?>">
    <meta name="description" content="<?= esc(site_config('site_description', 'Site desc')) ?>">
    <meta name="theme-color" content="#050816">
    <meta name="keywords" content="<?= esc(site_config('site_keywords', "keywords")) ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= !empty($title) ? $title . ' - ' . site_config("site_title", "author") : site_config("site_title", "author") ?>">
    <meta property="og:description" content="<?= esc(site_config('site_description', 'Site desc')) ?>">
    <meta property="og:image" content="<?= $og_image ?? get_logo() ?>">
    <meta property="og:url" content="<?= current_url(true) ?>">
    <link rel="icon" type="image/png" href="<?= get_logo(true) ?>">
    <link rel="canonical" href="<?= base_url() ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/home.css') ?>?v=<?= time() ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script>
    function scrollToSection(id) {
      const target = document.querySelector(id);
      if (target) {
        const container = target.querySelector('.container') || target;
        const navHeight = document.getElementById('mainNav')?.offsetHeight || 75;
        const targetPos = container.getBoundingClientRect().top + window.pageYOffset - navHeight;
        window.scrollTo({ top: targetPos, behavior: 'smooth' });
        document.getElementById('navMobile')?.classList.remove('open');
      } else {
        if (id === '#hero') {
          window.location.href = '<?= base_url() ?>';
        } else {
          window.location.href = '<?= base_url() ?>' + id;
        }
      }
    }

    function toggleFaq(btn) {
      const item = btn.closest('.fq');
      const answer = item.querySelector('.fq-a');
      const wasOpen = item.classList.contains('open') || item.classList.contains('active');

      document.querySelectorAll('.fq').forEach(f => {
        f.classList.remove('open', 'active');
      });

      if (!wasOpen) {
        item.classList.add('open', 'active');
      }
    }
    </script>
</head>
<body>

<nav class="nav" id="mainNav" style="z-index: 999999 !important; pointer-events: auto !important;">
  <div class="container">
    <div class="nav-inner">
      <a href="<?= base_url(); ?>" class="logo">
        <img src="<?= get_logo() ?>" alt="<?= site_config('site_name') ?>">
      </a>

      <ul class="nav-menu">
        <li><a href="javascript:void(0)" onclick="scrollToSection('#hero')" class="nav-link active">Home</a></li>
        <li><a href="javascript:void(0)" onclick="scrollToSection('#features')" class="nav-link">Features</a></li>
        <li><a href="javascript:void(0)" onclick="scrollToSection('#solutions')" class="nav-link">Solutions</a></li>
        <li><a href="javascript:void(0)" onclick="scrollToSection('#developer')" class="nav-link">API</a></li>
        <li><a href="javascript:void(0)" onclick="scrollToSection('#pricing')" class="nav-link">Pricing</a></li>
        <li><a href="javascript:void(0)" onclick="scrollToSection('#security')" class="nav-link">Security</a></li>
        <li><a href="<?= base_url('blogs') ?>" class="nav-link">Blog</a></li>
      </ul>

      <div class="nav-btns">
        <?php if (session('uid')) { ?>
          <a href="<?= base_url('user/dashboard') ?>" class="btn btn-p"><i class="fas fa-grid-2"></i> Dashboard</a>
        <?php } else { ?>
          <a href="<?= base_url() ?>#hero" class="btn btn-o" onclick="openAuth('login');return false">Log in</a>
          <a href="<?= base_url() ?>#hero" class="btn btn-p" onclick="openAuth('signup');return false">Get Started <i class="fas fa-arrow-right" style="font-size:11px"></i></a>
        <?php } ?>
      </div>

      <button class="mob-tog" id="navToggle" onclick="document.getElementById('navMobile').classList.toggle('open')" aria-label="Toggle Menu"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg></button>
    </div>
  </div>

  <!-- Mobile Menu Overlay -->
  <div class="nav-mobile" id="navMobile">
    <button class="mob-cls" id="navClose" onclick="document.getElementById('navMobile').classList.remove('open')">✕</button>
    <a href="javascript:void(0)" onclick="scrollToSection('#hero')">Home</a>
    <a href="javascript:void(0)" onclick="scrollToSection('#features')">Features</a>
    <a href="javascript:void(0)" onclick="scrollToSection('#solutions')">Solutions</a>
    <a href="javascript:void(0)" onclick="scrollToSection('#developer')">API</a>
    <a href="javascript:void(0)" onclick="scrollToSection('#pricing')">Pricing</a>
    <a href="javascript:void(0)" onclick="scrollToSection('#security')">Security</a>
    <a href="<?= base_url('blogs') ?>">Blog</a>
    <div class="mob-cta">
      <?php if (session('uid')) { ?>
        <a href="<?= base_url('user/dashboard') ?>" class="btn btn-p">Dashboard</a>
      <?php } else { ?>
        <a href="#" class="btn btn-o" onclick="openAuth('login');document.getElementById('navMobile').classList.remove('open');return false">Log in</a>
        <a href="#" class="btn btn-p" onclick="openAuth('signup');document.getElementById('navMobile').classList.remove('open');return false">Get Started</a>
      <?php } ?>
    </div>
  </div>
</nav>


<?= view($view); ?>

<footer class="ft" style="padding: 60px 0 30px; border-top: 1px solid rgba(255, 255, 255, 0.04); background: linear-gradient(180deg, var(--bg2) 0%, #030610 100%); font-family: 'Inter', sans-serif;">
  <div class="container">
    <!-- Top Row: Brand & Info + Links -->
    <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 40px; flex-wrap: wrap; margin-bottom: 40px;">
      <!-- Brand, Desc & Socials -->
      <div style="max-width: 360px;">
        <a href="<?= base_url(); ?>" class="logo" style="display: flex; align-items: center; margin-bottom: 16px;">
          <img src="<?= get_logo() ?>" alt="<?= site_config('site_name') ?>" style="height: 32px; filter: drop-shadow(0 0 10px rgba(99,102,241,.15));">
        </a>
        <p style="font-size: 13.5px; color: var(--t3); line-height: 1.7; margin-bottom: 24px;">
          <?= esc(site_config('site_description')) ?>
        </p>
        <!-- Social Profiles -->
        <div class="ft-soc" style="display: flex; gap: 12px;">
          <?php if (site_config('social_facebook_link') && site_config('social_facebook_link') !== '#') : ?>
            <a href="<?= site_config('social_facebook_link') ?>" target="_blank" class="soc-fb" title="Facebook" style="width: 36px; height: 36px; border-radius: 8px; background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.06); display: flex; align-items: center; justify-content: center; color: var(--t3); font-size: 14px; transition: all 0.3s;"><i class="fab fa-facebook-f"></i></a>
          <?php endif; ?>
          <?php if (site_config('social_twitter_link') && site_config('social_twitter_link') !== '#') : ?>
            <a href="<?= site_config('social_twitter_link') ?>" target="_blank" class="soc-tw" title="Twitter" style="width: 36px; height: 36px; border-radius: 8px; background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.06); display: flex; align-items: center; justify-content: center; color: var(--t3); font-size: 14px; transition: all 0.3s;"><i class="fab fa-x-twitter"></i></a>
          <?php endif; ?>
          <?php if (site_config('social_youtube_link') && site_config('social_youtube_link') !== '#') : ?>
            <a href="<?= site_config('social_youtube_link') ?>" target="_blank" class="soc-yt" title="YouTube" style="width: 36px; height: 36px; border-radius: 8px; background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.06); display: flex; align-items: center; justify-content: center; color: var(--t3); font-size: 14px; transition: all 0.3s;"><i class="fab fa-youtube"></i></a>
          <?php endif; ?>
          <?php if (site_config('social_instagram_link') && site_config('social_instagram_link') !== '#') : ?>
            <a href="<?= site_config('social_instagram_link') ?>" target="_blank" class="soc-ig" title="Instagram" style="width: 36px; height: 36px; border-radius: 8px; background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.06); display: flex; align-items: center; justify-content: center; color: var(--t3); font-size: 14px; transition: all 0.3s;"><i class="fab fa-instagram"></i></a>
          <?php endif; ?>
          <?php if (site_config('social_github_link') && site_config('social_github_link') !== '#') : ?>
            <a href="<?= site_config('social_github_link') ?>" target="_blank" class="soc-gh" title="GitHub" style="width: 36px; height: 36px; border-radius: 8px; background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.06); display: flex; align-items: center; justify-content: center; color: var(--t3); font-size: 14px; transition: all 0.3s;"><i class="fab fa-github"></i></a>
          <?php endif; ?>
        </div>
      </div>

      <!-- Quick Links Grouped -->
      <div style="display: flex; gap: 60px; flex-wrap: wrap;">
        <!-- Platform Links -->
        <div style="display: flex; flex-direction: column; gap: 12px;">
          <h4 style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--t2); margin-bottom: 4px;">Platform</h4>
          <a href="javascript:void(0)" onclick="scrollToSection('#hero')" style="font-size: 13.5px; color: var(--t3); transition: color 0.3s;" onmouseover="this.style.color='var(--t1)'" onmouseout="this.style.color='var(--t3)'">Home</a>
          <a href="javascript:void(0)" onclick="scrollToSection('#features')" style="font-size: 13.5px; color: var(--t3); transition: color 0.3s;" onmouseover="this.style.color='var(--t1)'" onmouseout="this.style.color='var(--t3)'">Features</a>
          <a href="javascript:void(0)" onclick="scrollToSection('#solutions')" style="font-size: 13.5px; color: var(--t3); transition: color 0.3s;" onmouseover="this.style.color='var(--t1)'" onmouseout="this.style.color='var(--t3)'">Solutions</a>
          <a href="javascript:void(0)" onclick="scrollToSection('#pricing')" style="font-size: 13.5px; color: var(--t3); transition: color 0.3s;" onmouseover="this.style.color='var(--t1)'" onmouseout="this.style.color='var(--t3)'">Pricing</a>
        </div>
        
        <!-- Resources Links -->
        <div style="display: flex; flex-direction: column; gap: 12px;">
          <h4 style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--t2); margin-bottom: 4px;">Resources</h4>
          <a href="<?= base_url('docs') ?>" style="font-size: 13.5px; color: var(--t3); transition: color 0.3s;" onmouseover="this.style.color='var(--t1)'" onmouseout="this.style.color='var(--t3)'">Documentation</a>
          <a href="<?= base_url('blogs') ?>" style="font-size: 13.5px; color: var(--t3); transition: color 0.3s;" onmouseover="this.style.color='var(--t1)'" onmouseout="this.style.color='var(--t3)'">Blog</a>
          <a href="javascript:void(0)" onclick="scrollToSection('#security')" style="font-size: 13.5px; color: var(--t3); transition: color 0.3s;" onmouseover="this.style.color='var(--t1)'" onmouseout="this.style.color='var(--t3)'">Security</a>
        </div>

        <!-- Contact Links -->
        <div style="display: flex; flex-direction: column; gap: 12px;">
          <h4 style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--t2); margin-bottom: 4px;">Contact</h4>
          <a href="mailto:<?= site_config('contact_email') ?>" style="font-size: 13.5px; color: var(--t3); display: flex; align-items: center; gap: 8px; transition: color 0.3s;" onmouseover="this.style.color='var(--t1)'" onmouseout="this.style.color='var(--t3)'"><i class="fas fa-envelope" style="color: var(--blue2);"></i> <?= site_config('contact_email') ?></a>
          <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', site_config('contact_tel')) ?>" target="_blank" style="font-size: 13.5px; color: var(--t3); display: flex; align-items: center; gap: 8px; transition: color 0.3s;" onmouseover="this.style.color='var(--t1)'" onmouseout="this.style.color='var(--t3)'"><i class="fab fa-whatsapp" style="color: #25d366;"></i> <?= site_config('contact_tel') ?></a>
        </div>
      </div>
    </div>

    <!-- Divider Line -->
    <div style="height: 1px; background: rgba(255, 255, 255, 0.05); margin-bottom: 28px;"></div>

    <!-- Bottom Row: Copyright, Terms & Live status -->
    <div class="ft-bot" style="display: flex; align-items: center; justify-content: space-between; gap: 24px; flex-wrap: wrap; padding-top: 0;">
      <div style="display: flex; align-items: center; gap: 24px; flex-wrap: wrap;">
        <p style="font-size: 13px; color: var(--t3); margin: 0;"><?= site_config('copy_right_content') ?> &copy; <script>document.write(new Date().getFullYear())</script>. All rights reserved.</p>
        <div class="ft-bot-links" style="display: flex; gap: 18px;">
          <a href="<?= base_url('terms-condition') ?>" style="font-size: 13px; color: var(--t3); transition: color 0.3s;" onmouseover="this.style.color='var(--t1)'" onmouseout="this.style.color='var(--t3)'">Terms</a>
          <a href="<?= base_url('privacy-policy') ?>" style="font-size: 13px; color: var(--t3); transition: color 0.3s;" onmouseover="this.style.color='var(--t1)'" onmouseout="this.style.color='var(--t3)'">Privacy</a>
        </div>
      </div>
      
      <div class="ft-status" style="display: flex; align-items: center; gap: 8px; font-size: 11.5px; color: var(--t3); padding: 6px 14px; border-radius: 99px; background: rgba(52,211,153,.04); border: 1px solid rgba(52,211,153,.1); transition: all .3s;">
        <span class="status-dot"></span>
        <?= get_option('footer_status_text', 'All Systems Operational') ?>
      </div>
    </div>
  </div>
</footer>

<script>
// Navbar scroll
window.addEventListener('scroll',()=>document.getElementById('mainNav').classList.toggle('scrolled',scrollY>40));

// Mobile menu
document.getElementById('navToggle')?.addEventListener('click',()=>document.getElementById('navMobile').classList.add('open'));
document.getElementById('navClose')?.addEventListener('click',()=>document.getElementById('navMobile').classList.remove('open'));

// Global scroll logic handled in head

// Active nav on scroll
const sections=document.querySelectorAll('section[id]');
const navLinks=document.querySelectorAll('.nav-menu .nav-link');
window.addEventListener('scroll',()=>{
  let cur='';
  sections.forEach(s=>{if(scrollY>=s.offsetTop-200)cur=s.getAttribute('id')});
  navLinks.forEach(l=>{
    l.classList.remove('active');
    const onclick = l.getAttribute('onclick') || '';
    if(onclick.includes('#'+cur)) l.classList.add('active');
  });
});

// FAQ Toggle handled in head via onclick

// Scroll Reveal (Intersection Observer)
const revealEls=document.querySelectorAll('.reveal:not(.hero .reveal)');
revealEls.forEach(el=>el.classList.add('reveal-init'));
const ro=new IntersectionObserver((entries)=>{
  entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('visible');ro.unobserve(e.target)}})
},{threshold:0.05,rootMargin:'0px 0px -10px 0px'});
revealEls.forEach(el=>ro.observe(el));

// Counter animation
function animC(){document.querySelectorAll('[data-c]').forEach(el=>{const t=+el.dataset.c,s=el.dataset.s||'';let c=0;const step=t/50,tm=setInterval(()=>{c+=step;if(c>=t){c=t;clearInterval(tm)}el.textContent=Math.floor(c).toLocaleString()+s},25)})}
const so=new IntersectionObserver(e=>e.forEach(x=>{if(x.isIntersecting){animC();so.unobserve(x.target)}}),{threshold:.2});
const ss=document.querySelector('.stats');if(ss)so.observe(ss);
</script>

<?php if (!session('uid')) : ?>
<!-- Auth Modal Overlay -->
<div class="auth-overlay" id="authOverlay" onclick="if(event.target===this)closeAuth()">
  <div class="auth-modal">
    <button class="auth-modal-close" onclick="closeAuth()">&times;</button>
    <div id="authMsg" class="auth-msg"></div>

    <!-- LOGIN FORM -->
    <div id="authLogin">
      <h2>Welcome Back</h2>
      <div class="auth-sub">Sign in to your <?= site_config('site_name','Ekhoni Digital') ?> account</div>
      <?php if(get_option('google_login',0)==1): ?>
      <a href="<?= base_url('auth/google_process') ?>" class="auth-google">
        <svg width="18" height="18" viewBox="0 0 48 48"><path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/><path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/><path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/><path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/></svg>
        Continue with Google
      </a>
      <div class="auth-divider">or sign in with email</div>
      <?php endif; ?>
      <form id="loginForm" onsubmit="submitAuth(event,'login')">
        <div class="auth-field">
          <label class="auth-label">Email Address</label>
          <input class="auth-input" type="email" name="email" placeholder="you@example.com" required>
        </div>
        <div class="auth-field">
          <label class="auth-label">Password</label>
          <div class="pw-wrap">
            <input class="auth-input" type="password" name="password" id="mPw" placeholder="Enter password" required>
            <button type="button" class="pw-toggle" onclick="var p=document.getElementById('mPw');p.type=p.type==='password'?'text':'password'"><i class="fas fa-eye"></i></button>
          </div>
        </div>
        <div class="auth-row">
          <label><input type="checkbox" name="remember"> Remember me</label>
          <a onclick="switchAuth('reset')" style="cursor:pointer">Forgot Password?</a>
        </div>
        <button type="submit" class="auth-submit" id="loginBtn">Sign In</button>
      </form>
      <div class="auth-footer">Don't have an account? <a onclick="switchAuth('signup')">Create Account</a></div>
    </div>

    <!-- SIGNUP FORM -->
    <div id="authSignup" style="display:none">
      <h2>Create Account</h2>
      <div class="auth-sub">Join <?= site_config('site_name','Ekhoni Digital') ?> today</div>
      <?php if(get_option('google_login',0)==1): ?>
      <a href="<?= base_url('auth/google_process') ?>" class="auth-google">
        <svg width="18" height="18" viewBox="0 0 48 48"><path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/><path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/><path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/><path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/></svg>
        Continue with Google
      </a>
      <div class="auth-divider">or create with email</div>
      <?php endif; ?>
      <form id="signupForm" onsubmit="submitAuth(event,'signup')">
        <div class="form-grid">
          <div class="auth-field"><label class="auth-label">First Name</label><input class="auth-input" name="first_name" placeholder="John" required></div>
          <div class="auth-field"><label class="auth-label">Last Name</label><input class="auth-input" name="last_name" placeholder="Doe" required></div>
        </div>
        <div class="auth-field" style="margin-top:14px"><label class="auth-label">Email</label><input class="auth-input" type="email" name="email" placeholder="you@example.com" required></div>
        <div class="auth-field"><label class="auth-label">Phone</label><input class="auth-input" type="tel" name="phone" inputmode="numeric" placeholder="+880 1XXXXXXXXX" required></div>
        <div class="form-grid">
          <div class="auth-field"><label class="auth-label">Password</label><input class="auth-input" type="password" name="password" placeholder="Min 5 chars" required></div>
          <div class="auth-field"><label class="auth-label">Confirm</label><input class="auth-input" type="password" name="c_password" placeholder="Re-enter" required></div>
        </div>
        <div class="auth-row" style="margin-top:12px"><label><input type="checkbox" name="agree" required> I agree to <a href="<?= base_url('terms-condition') ?>" target="_blank">Terms</a></label></div>
        <button type="submit" class="auth-submit" id="signupBtn">Create Account</button>
      </form>
      <div class="auth-footer">Already have an account? <a onclick="switchAuth('login')">Sign In</a></div>
    </div>

    <!-- PASSWORD RESET FORM -->
    <div id="authReset" style="display:none">
      <h2>Reset Password</h2>
      <div class="auth-sub">Enter your email and we'll send you a reset link</div>
      <form id="resetForm" onsubmit="submitAuth(event,'reset')">
        <div class="auth-field">
          <label class="auth-label">Email Address</label>
          <input class="auth-input" type="email" name="email" placeholder="you@example.com" required>
        </div>
        <button type="submit" class="auth-submit" id="resetBtn">Send Reset Link</button>
      </form>
      <div class="auth-footer">Remember your password? <a onclick="switchAuth('login')">Sign In</a></div>
      <div class="auth-footer" style="margin-top:8px">Don't have an account? <a onclick="switchAuth('signup')">Create Account</a></div>
    </div>
  </div>
</div>

<script>
var AUTH_URLS={login:'<?= base_url('sign-in') ?>',signup:'<?= base_url('sign-up') ?>',reset:'<?= base_url('password-reset') ?>'};
var AUTH_LABELS={login:'Sign In',signup:'Create Account',reset:'Send Reset Link'};
var AUTH_LOADING={login:'Signing in...',signup:'Creating...',reset:'Sending...'};
function openAuth(type){
  document.getElementById('authMsg').className='auth-msg';
  document.getElementById('authMsg').textContent='';
  document.getElementById('authLogin').style.display=type==='login'?'':'none';
  document.getElementById('authSignup').style.display=type==='signup'?'':'none';
  document.getElementById('authReset').style.display=type==='reset'?'':'none';
  document.getElementById('authOverlay').classList.add('active');
  document.body.style.overflow='hidden';
}
function closeAuth(){
  document.getElementById('authOverlay').classList.remove('active');
  document.body.style.overflow='';
}
function switchAuth(type){
  document.getElementById('authMsg').className='auth-msg';
  document.getElementById('authMsg').textContent='';
  document.getElementById('authLogin').style.display=type==='login'?'':'none';
  document.getElementById('authSignup').style.display=type==='signup'?'':'none';
  document.getElementById('authReset').style.display=type==='reset'?'':'none';
}
function submitAuth(e,type){
  e.preventDefault();
  var form=e.target,btn=form.querySelector('.auth-submit'),msg=document.getElementById('authMsg');
  btn.textContent=AUTH_LOADING[type]||'Processing...';
  btn.style.opacity='.7';
  var fd=new FormData(form);
  /* ── CSRF Token Fix ── */
  var csrfName='<?= csrf_token() ?>';
  var csrfHash='<?= csrf_hash() ?>';
  fd.append(csrfName, csrfHash);
  fetch(AUTH_URLS[type],{method:'POST',body:new URLSearchParams(fd),headers:{'X-Requested-With':'XMLHttpRequest'}}).then(r=>{
    /* Update CSRF token from response cookie for next request */
    return r.text();
  }).then(t=>{
    btn.style.opacity='1';
    btn.textContent=AUTH_LABELS[type]||'Submit';
    try{
      var j=JSON.parse(t);
      if(j.status==='success'){
        msg.className='auth-msg success';msg.textContent=j.message||'Success!';
        if(type==='reset'){
          form.reset();
        } else {
          setTimeout(()=>{window.location.href=j.redirect||'<?= base_url('user/dashboard') ?>'},800);
        }
      } else {
        msg.className='auth-msg error';msg.innerHTML=j.message||'Something went wrong';
      }
    }catch(ex){
      console.error('Auth parse error:', ex, 'Response:', t);
      msg.className='auth-msg error';msg.textContent='Something went wrong. Please try again.';
    }
  }).catch((err)=>{
    console.error('Auth network error:', err);
    btn.style.opacity='1';btn.textContent=AUTH_LABELS[type]||'Submit';
    msg.className='auth-msg error';msg.textContent='Network error. Please try again.';
  });
}
document.addEventListener('keydown',e=>{if(e.key==='Escape')closeAuth()});
</script>
<?php endif; ?>

<?php if (get_option('enable_notification_popup') == 1 && get_cookie('home_popup') != 1) : ?>
<?php set_cookie("home_popup", "1", 180); ?>
<div style="position:fixed;inset:0;z-index:9999;display:flex;align-items:center;justify-content:center;background:rgba(0,0,0,.75);backdrop-filter:blur(6px)" id="popM">
  <div style="background:var(--bg2);border:1px solid var(--glass-b);border-radius:18px;max-width:460px;width:92%;padding:36px">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:18px"><h3 style="font-size:17px">📢 Announcement</h3><button onclick="document.getElementById('popM').remove()" style="background:0;border:0;color:#fff;font-size:28px;cursor:pointer">&times;</button></div>
    <div style="color:var(--t2);font-size:14px;line-height:1.8"><?= get_option('notification_popup_content') ?></div>
  </div>
</div>
<?php endif; ?>
<?php echo htmlspecialchars_decode(get_option('embed_javascript', ''), ENT_QUOTES); ?>
</body>
</html>