<?php
$google_login = get_option('google_login', 0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Create Account — <?= site_config('site_name', 'Ekhoni Digital') ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Create your <?= site_config('site_name', 'Ekhoni Digital') ?> account">
<link rel="icon" type="image/png" href="<?= get_logo(true) ?>">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<style>
*{box-sizing:border-box;margin:0;padding:0}
body{
  font-family:'Inter',sans-serif;
  background:#0f0f23;
  min-height:100vh;
  overflow-x:hidden;
  color:#fff;
}

.bg-animation{
  position:fixed;inset:0;z-index:0;
  background:linear-gradient(125deg,#0f0f23 0%,#1a1a3e 25%,#2d1b69 50%,#1a1a3e 75%,#0f0f23 100%);
  background-size:400% 400%;
  animation:gradientShift 15s ease infinite;
}
@keyframes gradientShift{0%{background-position:0% 50%}50%{background-position:100% 50%}100%{background-position:0% 50%}}

.orb{position:fixed;border-radius:50%;filter:blur(80px);opacity:0.3;z-index:0}
.orb-1{width:400px;height:400px;background:#6366f1;top:-100px;right:-100px;animation:orbFloat 8s ease-in-out infinite}
.orb-2{width:300px;height:300px;background:#8b5cf6;bottom:-50px;left:-50px;animation:orbFloat 10s ease-in-out infinite reverse}
@keyframes orbFloat{0%,100%{transform:translateY(0) scale(1)}50%{transform:translateY(-40px) scale(1.1)}}

.page{
  position:relative;z-index:2;
  min-height:100vh;display:flex;
  align-items:center;justify-content:center;
  padding:24px;
}

.auth-container{
  width:100%;max-width:1100px;
  display:flex;border-radius:24px;overflow:hidden;
  background:rgba(255,255,255,0.03);
  backdrop-filter:blur(20px);
  border:1px solid rgba(255,255,255,0.08);
  box-shadow:0 32px 64px rgba(0,0,0,0.4);
}

/* Left */
.auth-left{
  flex:1;
  background:linear-gradient(135deg,rgba(99,102,241,0.15),rgba(139,92,246,0.1));
  display:flex;flex-direction:column;
  align-items:center;justify-content:center;
  padding:48px 36px;position:relative;overflow:hidden;
}
.auth-left::before{
  content:'';position:absolute;bottom:-20%;left:-20%;
  width:300px;height:300px;
  background:radial-gradient(circle,rgba(139,92,246,0.2),transparent);
  border-radius:50%;
}

.brand-logo{
  width:56px;height:56px;border-radius:14px;
  background:linear-gradient(135deg,#6366f1,#8b5cf6);
  display:flex;align-items:center;justify-content:center;
  font-size:26px;font-weight:700;margin-bottom:16px;
  box-shadow:0 8px 24px rgba(99,102,241,0.4);
}
.brand-name{
  font-size:1.4rem;font-weight:700;margin-bottom:8px;
  background:linear-gradient(135deg,#c7d2fe,#fff);
  -webkit-background-clip:text;-webkit-text-fill-color:transparent;
}
.brand-tagline{
  font-size:0.85rem;color:rgba(255,255,255,0.5);
  text-align:center;line-height:1.6;max-width:260px;
}
.auth-illustration{
  margin-top:28px;width:100%;max-width:300px;
  animation:floatIllu 6s ease-in-out infinite;
}
@keyframes floatIllu{0%,100%{transform:translateY(0)}50%{transform:translateY(-14px)}}

/* Right */
.auth-right{
  flex:1.1;padding:40px 36px;
  display:flex;flex-direction:column;justify-content:center;
}

.auth-title{font-size:1.6rem;font-weight:700;margin-bottom:4px;color:#fff}
.auth-subtitle{font-size:0.85rem;color:rgba(255,255,255,0.4);margin-bottom:24px}

/* Google */
.google-btn{
  width:100%;height:48px;border-radius:14px;
  border:1px solid rgba(255,255,255,0.12);
  background:rgba(255,255,255,0.06);
  color:#fff;font-size:0.9rem;font-weight:600;
  cursor:pointer;display:flex;align-items:center;
  justify-content:center;gap:10px;
  transition:all 0.3s;text-decoration:none;
}
.google-btn:hover{
  background:rgba(255,255,255,0.12);
  border-color:rgba(255,255,255,0.2);
  transform:translateY(-2px);
  box-shadow:0 8px 24px rgba(0,0,0,0.2);
  color:#fff;
}
.google-btn svg{width:20px;height:20px}

.divider{
  display:flex;align-items:center;margin:18px 0;
  gap:12px;color:rgba(255,255,255,0.3);
  font-size:0.78rem;font-weight:500;
}
.divider::before,.divider::after{content:'';flex:1;height:1px;background:rgba(255,255,255,0.1)}

/* Form */
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px}
.form-full{grid-column:1/3}

.form-group{margin-bottom:0}
.form-label{display:block;font-size:0.78rem;font-weight:500;color:rgba(255,255,255,0.5);margin-bottom:5px}
.form-input{
  width:100%;height:46px;
  border:1px solid rgba(255,255,255,0.1);
  border-radius:12px;padding:0 14px;
  background:rgba(255,255,255,0.05);
  color:#fff;font-size:0.88rem;
  font-family:'Inter',sans-serif;
  transition:all 0.3s;
}
.form-input::placeholder{color:rgba(255,255,255,0.2)}
.form-input:focus{
  outline:none;
  border-color:rgba(99,102,241,0.6);
  box-shadow:0 0 0 3px rgba(99,102,241,0.15);
  background:rgba(255,255,255,0.08);
}

.password-field{position:relative}
.password-toggle{
  position:absolute;right:12px;top:50%;
  transform:translateY(-50%);cursor:pointer;
  color:rgba(255,255,255,0.4);font-size:0.9rem;
  background:none;border:none;padding:0;
}
.password-toggle:hover{color:rgba(255,255,255,0.7)}

.terms{
  margin:16px 0;font-size:0.8rem;
  color:rgba(255,255,255,0.45);
}
.terms label{display:flex;align-items:center;gap:8px;cursor:pointer}
.terms input[type="checkbox"]{accent-color:#6366f1;width:15px;height:15px}
.terms a{color:#a78bfa;text-decoration:none}

.submit-btn{
  width:100%;height:50px;border:none;border-radius:14px;
  background:linear-gradient(135deg,#6366f1,#8b5cf6);
  color:#fff;font-size:0.92rem;font-weight:600;
  cursor:pointer;transition:all 0.3s;
  font-family:'Inter',sans-serif;
}
.submit-btn:hover{
  transform:translateY(-2px);
  box-shadow:0 12px 32px rgba(99,102,241,0.4);
}

.bottom-link{
  text-align:center;margin-top:20px;
  font-size:0.82rem;color:rgba(255,255,255,0.4);
}
.bottom-link a{color:#a78bfa;text-decoration:none;font-weight:600}
.bottom-link a:hover{color:#c4b5fd}

@media(max-width:900px){
  .auth-container{flex-direction:column;max-width:500px}
  .auth-left{display:none}
}
@media(max-width:480px){
  .page{padding:12px}
  .auth-right{padding:28px 20px}
  .auth-title{font-size:1.3rem}
  .form-grid{grid-template-columns:1fr}
  .form-full{grid-column:auto}
}
</style>
</head>

<body>
<div class="bg-animation"></div>
<div class="orb orb-1"></div>
<div class="orb orb-2"></div>

<div class="page">
  <div class="auth-container">

    <!-- Left -->
    <div class="auth-left">
      <div class="brand-logo">E</div>
      <div class="brand-name"><?= site_config('site_name', 'Ekhoni Digital') ?></div>
      <div class="brand-tagline">Start accepting payments in minutes with our secure gateway</div>
      <img src="<?= base_url('public/assets/img/sign-up-home.png') ?>" class="auth-illustration" alt="Create Account">
    </div>

    <!-- Right -->
    <div class="auth-right">
      <div class="auth-title">Create Account</div>
      <div class="auth-subtitle">Join <?= site_config('site_name', 'Ekhoni Digital') ?> today</div>

      <?php if ($google_login == 1): ?>
      <a href="<?= base_url('auth/google_process') ?>" class="google-btn">
        <svg viewBox="0 0 48 48">
          <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
          <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
          <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
          <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
        </svg>
        Continue with Google
      </a>
      <div class="divider">or create account with email</div>
      <?php endif; ?>

      <?= form_open(base_url('sign-up'), 'class="actionForm" data-redirect="user"') ?>

      <div class="form-grid">
        <div class="form-group">
          <label class="form-label">First Name</label>
          <input class="form-input" name="first_name" placeholder="John" required>
        </div>
        <div class="form-group">
          <label class="form-label">Last Name</label>
          <input class="form-input" name="last_name" placeholder="Doe" required>
        </div>

        <div class="form-group form-full">
          <label class="form-label">Email Address</label>
          <input class="form-input" type="email" name="email" placeholder="you@example.com" required>
        </div>

        <div class="form-group form-full">
          <label class="form-label">Phone Number</label>
          <input class="form-input" name="phone" placeholder="+880 1XXXXXXXXX" required>
        </div>

        <div class="form-group">
          <label class="form-label">Password</label>
          <div class="password-field">
            <input class="form-input" type="password" id="password" name="password" placeholder="Min 5 characters" required>
            <button type="button" class="password-toggle" onclick="togglePw('password',this)"><i class="fas fa-eye"></i></button>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Confirm Password</label>
          <div class="password-field">
            <input class="form-input" type="password" id="c_password" name="c_password" placeholder="Re-enter password" required>
            <button type="button" class="password-toggle" onclick="togglePw('c_password',this)"><i class="fas fa-eye"></i></button>
          </div>
        </div>
      </div>

      <div class="terms">
        <label>
          <input type="checkbox" name="agree" required>
          I agree with the <a href="<?= base_url('page/terms-and-conditions') ?>">Terms & Conditions</a>
        </label>
      </div>

      <button type="submit" class="submit-btn">Create Account</button>

      <?= form_close(); ?>

      <div class="bottom-link">
        Already have an account? <a href="<?= base_url('sign-in') ?>">Sign In</a>
      </div>
    </div>
  </div>
</div>

<script>
function togglePw(id, el){
  const i = document.getElementById(id);
  if(i.type === "password"){
    i.type = "text";
    el.innerHTML = '<i class="fas fa-eye-slash"></i>';
  } else {
    i.type = "password";
    el.innerHTML = '<i class="fas fa-eye"></i>';
  }
}
</script>

</body>
</html>
