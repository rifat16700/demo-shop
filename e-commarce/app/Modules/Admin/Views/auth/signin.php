<?php
$cookie_email = !empty(get_cookie("a_cookie_email")) ? encrypt_decode(get_cookie("a_cookie_email")) : "";
$cookie_pass  = !empty(get_cookie("a_cookie_pass")) ? encrypt_decode(get_cookie("a_cookie_pass")) : "";
$redirect     = session('ref_url') ?? admin_url();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login — <?= site_config("site_title", "Ekhoni Digital") ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="<?= get_logo(true) ?>">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<style>
*{box-sizing:border-box;margin:0;padding:0}
body{
  font-family:'Inter',sans-serif;
  background:#080816;
  min-height:100vh;
  display:flex;
  align-items:center;
  justify-content:center;
  color:#fff;
  overflow:hidden;
}

/* Background */
.bg-glow{
  position:fixed;inset:0;z-index:0;
  background:
    radial-gradient(ellipse at 20% 50%, rgba(99,102,241,0.15), transparent 50%),
    radial-gradient(ellipse at 80% 20%, rgba(56,189,248,0.1), transparent 40%),
    radial-gradient(ellipse at 60% 80%, rgba(139,92,246,0.08), transparent 40%);
}

.grid-overlay{
  position:fixed;inset:0;z-index:0;
  background-image:
    linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
  background-size:60px 60px;
}

/* Login Card */
.admin-login{
  position:relative;z-index:1;
  width:100%;max-width:420px;
  background:rgba(255,255,255,0.04);
  backdrop-filter:blur(24px);
  border-radius:20px;
  padding:40px 34px;
  border:1px solid rgba(255,255,255,0.06);
  box-shadow:0 40px 80px rgba(0,0,0,0.5);
}

/* Header */
.login-header{text-align:center;margin-bottom:32px}

.admin-badge{
  display:inline-flex;align-items:center;gap:6px;
  background:rgba(99,102,241,0.15);
  border:1px solid rgba(99,102,241,0.2);
  color:#a5b4fc;
  padding:6px 14px;border-radius:20px;
  font-size:0.72rem;font-weight:600;
  text-transform:uppercase;letter-spacing:1px;
  margin-bottom:16px;
}

.login-header .logo{
  height:44px;margin-bottom:12px;
  filter:drop-shadow(0 4px 12px rgba(99,102,241,0.3));
}

.login-header h2{
  font-size:1.35rem;font-weight:700;margin-bottom:4px;
}
.login-header p{
  font-size:0.82rem;color:rgba(255,255,255,0.4);
}

/* Form */
.form-group{margin-bottom:16px}
.form-label{
  display:block;font-size:0.78rem;font-weight:500;
  color:rgba(255,255,255,0.5);margin-bottom:5px;
}
.form-input{
  width:100%;height:48px;
  border:1px solid rgba(255,255,255,0.08);
  border-radius:12px;padding:0 14px;
  background:rgba(255,255,255,0.04);
  color:#fff;font-size:0.9rem;
  font-family:'Inter',sans-serif;
  transition:all 0.3s;
}
.form-input::placeholder{color:rgba(255,255,255,0.2)}
.form-input:focus{
  outline:none;
  border-color:rgba(99,102,241,0.5);
  box-shadow:0 0 0 3px rgba(99,102,241,0.12);
  background:rgba(255,255,255,0.06);
}

.password-field{position:relative}
.password-toggle{
  position:absolute;right:12px;top:50%;
  transform:translateY(-50%);cursor:pointer;
  color:rgba(255,255,255,0.35);font-size:0.9rem;
  background:none;border:none;padding:0;
}
.password-toggle:hover{color:rgba(255,255,255,0.6)}

.options-row{
  display:flex;justify-content:space-between;
  align-items:center;margin-bottom:20px;
  font-size:0.8rem;
}
.options-row label{
  display:flex;align-items:center;gap:6px;
  color:rgba(255,255,255,0.45);cursor:pointer;
}
.options-row input[type="checkbox"]{accent-color:#6366f1;width:15px;height:15px}
.options-row a{color:#a5b4fc;text-decoration:none;font-weight:500}
.options-row a:hover{color:#c7d2fe}

.submit-btn{
  width:100%;height:48px;border:none;border-radius:12px;
  background:linear-gradient(135deg,#6366f1,#4f46e5);
  color:#fff;font-size:0.92rem;font-weight:600;
  cursor:pointer;transition:all 0.3s;
  font-family:'Inter',sans-serif;
}
.submit-btn:hover{
  transform:translateY(-2px);
  box-shadow:0 12px 32px rgba(99,102,241,0.35);
}

.footer{
  margin-top:24px;text-align:center;
  font-size:0.72rem;color:rgba(255,255,255,0.25);
}

@media(max-width:480px){
  .admin-login{margin:12px;padding:32px 24px}
}
</style>
</head>

<body>
<div class="bg-glow"></div>
<div class="grid-overlay"></div>

<div class="admin-login">
  <div class="login-header">
    <div class="admin-badge">
      <i class="fas fa-shield-halved"></i> Admin Panel
    </div>
    <br>
    <img src="<?= get_logo() ?>" alt="Admin" class="logo">
    <h2>Admin Sign In</h2>
    <p>Secure access to administration panel</p>
  </div>

  <?php $flash = get_flashdata('message'); if (!empty($flash)): ?>
  <div style="background:<?= $flash['status']==='error' ? 'rgba(239,68,68,0.15)' : 'rgba(16,185,129,0.15)' ?>;border:1px solid <?= $flash['status']==='error' ? 'rgba(239,68,68,0.3)' : 'rgba(16,185,129,0.3)' ?>;color:<?= $flash['status']==='error' ? '#fca5a5' : '#6ee7b7' ?>;padding:12px 16px;border-radius:10px;font-size:0.82rem;margin-bottom:16px;text-align:center;">
    <?= $flash['status']==='error' ? '❌' : '✅' ?> <?= $flash['message'] ?>
  </div>
  <?php endif; ?>

  <?= form_open(
    url_to('admin.attempt_signin'),
    'class="loginForm" data-redirect="'.$redirect.'"'
  ) ?>

  <div class="form-group">
    <label class="form-label">Email Address</label>
    <input class="form-input" type="email" name="email"
      placeholder="admin@example.com"
      value="<?= $cookie_email ?: set_value('email') ?>"
      required autofocus>
  </div>

  <div class="form-group">
    <label class="form-label">Password</label>
    <div class="password-field">
      <input class="form-input" type="password" name="password" id="password"
        placeholder="Enter your password"
        value="<?= $cookie_pass ?: set_value('password') ?>"
        required>
      <button type="button" class="password-toggle" id="togglePass">
        <i class="fas fa-eye"></i>
      </button>
    </div>
  </div>

  <div class="options-row">
    <label>
      <input type="checkbox" name="remember"
      <?= !empty($cookie_email) ? 'checked' : '' ?>> Remember me
    </label>
    <a href="<?= base_url('password-reset') ?>">Forgot Password?</a>
  </div>

  <button type="submit" class="submit-btn">
    <i class="fas fa-right-to-bracket me-2"></i> Sign In
  </button>

  <?= form_close(); ?>

  <div class="footer">
    © <?= date('Y') ?> <?= site_config('site_name', 'Ekhoni Digital') ?> • Administration
  </div>
</div>

<script>
/* ── Password Toggle ── */
const pass = document.getElementById("password");
const toggle = document.getElementById("togglePass");
toggle.addEventListener('click', function(){
  if(pass.type === "password"){
    pass.type = "text";
    toggle.innerHTML = '<i class="fas fa-eye-slash"></i>';
  } else {
    pass.type = "password";
    toggle.innerHTML = '<i class="fas fa-eye"></i>';
  }
});

/* ── Toast Notification ── */
var toastStyle = document.createElement('style');
toastStyle.textContent = '@keyframes toastIn{from{opacity:0;transform:translateX(-50%) translateY(-20px)}to{opacity:1;transform:translateX(-50%) translateY(0)}}@keyframes toastOut{from{opacity:1;transform:translateX(-50%) translateY(0)}to{opacity:0;transform:translateX(-50%) translateY(-20px)}}';
document.head.appendChild(toastStyle);

function showToast(msg, type) {
  var old = document.getElementById('login-toast');
  if (old) old.remove();

  var bg = type === 'success' ? 'linear-gradient(135deg,#10b981,#059669)' 
         : 'linear-gradient(135deg,#ef4444,#dc2626)';
  var icon = type === 'success' ? '✅' : '❌';

  var t = document.createElement('div');
  t.id = 'login-toast';
  t.innerHTML = icon + ' ' + msg;
  t.style.cssText = 'position:fixed;top:24px;left:50%;transform:translateX(-50%);background:' + bg + ';color:#fff;padding:14px 28px;border-radius:12px;font-size:0.88rem;font-weight:500;z-index:9999;box-shadow:0 8px 32px rgba(0,0,0,0.3);animation:toastIn 0.4s ease;max-width:90%;text-align:center;';
  document.body.appendChild(t);
  setTimeout(function(){ if(t.parentNode){ t.style.animation='toastOut 0.3s ease'; setTimeout(function(){t.remove()},300); }}, 3500);
}

/* ── Login Form Submit (Pure Vanilla JS — No jQuery) ── */
var loginForm = document.querySelector('form');
var submitBtn = loginForm.querySelector('.submit-btn');
var originalBtnHTML = submitBtn.innerHTML;

loginForm.addEventListener('submit', function(e) {
  e.preventDefault();

  // Disable & show spinner
  submitBtn.disabled = true;
  submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Signing In...';

  // Build form data
  var formData = new URLSearchParams(new FormData(loginForm));

  fetch(loginForm.getAttribute('action'), {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded', 'X-Requested-With': 'XMLHttpRequest' },
    body: formData.toString(),
    credentials: 'same-origin'
  })
  .then(function(res) { return res.text(); })
  .then(function(text) {
    try {
      var result = JSON.parse(text);

      if (result.status === 'success') {
        showToast(result.message || 'Login Successful!', 'success');
        submitBtn.innerHTML = '<i class="fas fa-check"></i> Success!';
        submitBtn.style.background = 'linear-gradient(135deg,#10b981,#059669)';

        var redirect = loginForm.getAttribute('data-redirect') || '<?= admin_url("dashboard") ?>';
        setTimeout(function() { window.location.href = redirect; }, 1000);
      } else {
        showToast(result.message || 'Login failed. Please try again.', 'error');
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnHTML;
      }
    } catch(ex) {
      showToast('Server error — please try again', 'error');
      submitBtn.disabled = false;
      submitBtn.innerHTML = originalBtnHTML;
    }
  })
  .catch(function(err) {
    showToast('Connection error — check your internet', 'error');
    submitBtn.disabled = false;
    submitBtn.innerHTML = originalBtnHTML;
  });
});
</script>

</body>
</html>

