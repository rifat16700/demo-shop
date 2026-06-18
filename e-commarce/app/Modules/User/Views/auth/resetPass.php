<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Password Reset — <?= site_config('site_name', 'Ekhoni Digital') ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Reset your <?= site_config('site_name', 'Ekhoni Digital') ?> account password">
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

.orb{position:fixed;border-radius:50%;filter:blur(80px);opacity:0.25;z-index:0}
.orb-1{width:350px;height:350px;background:#6366f1;top:-80px;left:-80px;animation:orbFloat 9s ease-in-out infinite}
.orb-2{width:280px;height:280px;background:#a78bfa;bottom:-60px;right:-60px;animation:orbFloat 11s ease-in-out infinite reverse}
@keyframes orbFloat{0%,100%{transform:translateY(0) scale(1)}50%{transform:translateY(-35px) scale(1.08)}}

.page{
  position:relative;z-index:2;
  min-height:100vh;display:flex;
  align-items:center;justify-content:center;
  padding:24px;
}

.auth-container{
  width:100%;max-width:960px;
  display:flex;border-radius:24px;overflow:hidden;
  background:rgba(255,255,255,0.03);
  backdrop-filter:blur(20px);
  border:1px solid rgba(255,255,255,0.08);
  box-shadow:0 32px 64px rgba(0,0,0,0.4);
}

.auth-left{
  flex:1.1;
  background:linear-gradient(135deg,rgba(99,102,241,0.15),rgba(139,92,246,0.1));
  display:flex;flex-direction:column;
  align-items:center;justify-content:center;
  padding:48px 36px;position:relative;overflow:hidden;
}
.auth-left::before{
  content:'';position:absolute;top:10%;right:-15%;
  width:250px;height:250px;
  background:radial-gradient(circle,rgba(99,102,241,0.2),transparent);
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
.auth-illustration{
  margin-top:28px;width:100%;max-width:300px;
  animation:floatIllu 6s ease-in-out infinite;
}
@keyframes floatIllu{0%,100%{transform:translateY(0)}50%{transform:translateY(-14px)}}

.auth-right{
  flex:1;padding:48px 40px;
  display:flex;flex-direction:column;justify-content:center;
}

.lock-icon{
  width:64px;height:64px;border-radius:18px;
  background:linear-gradient(135deg,rgba(99,102,241,0.2),rgba(139,92,246,0.15));
  display:flex;align-items:center;justify-content:center;
  font-size:1.5rem;color:#a78bfa;margin-bottom:20px;
}

.auth-title{font-size:1.6rem;font-weight:700;margin-bottom:8px;color:#fff}
.auth-subtitle{
  font-size:0.88rem;color:rgba(255,255,255,0.4);
  margin-bottom:28px;line-height:1.6;
}

.form-group{margin-bottom:18px}
.form-label{display:block;font-size:0.82rem;font-weight:500;color:rgba(255,255,255,0.5);margin-bottom:6px}
.form-input{
  width:100%;height:50px;
  border:1px solid rgba(255,255,255,0.1);
  border-radius:14px;padding:0 16px;
  background:rgba(255,255,255,0.05);
  color:#fff;font-size:0.92rem;
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

.submit-btn{
  width:100%;height:50px;border:none;border-radius:14px;
  background:linear-gradient(135deg,#6366f1,#8b5cf6);
  color:#fff;font-size:0.95rem;font-weight:600;
  cursor:pointer;transition:all 0.3s;
  font-family:'Inter',sans-serif;
  margin-top:4px;
}
.submit-btn:hover{
  transform:translateY(-2px);
  box-shadow:0 12px 32px rgba(99,102,241,0.4);
}

.bottom-links{
  display:flex;flex-direction:column;
  gap:8px;margin-top:24px;
  text-align:center;font-size:0.85rem;
  color:rgba(255,255,255,0.4);
}
.bottom-links a{color:#a78bfa;text-decoration:none;font-weight:600}
.bottom-links a:hover{color:#c4b5fd}

@media(max-width:900px){
  .auth-container{flex-direction:column;max-width:480px}
  .auth-left{display:none}
}
@media(max-width:480px){
  .page{padding:12px}
  .auth-right{padding:32px 24px}
  .auth-title{font-size:1.3rem}
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
      <img src="<?= base_url('public/assets/img/Password-Reset.png') ?>" class="auth-illustration" alt="Password Reset">
    </div>

    <!-- Right -->
    <div class="auth-right">
      <div class="lock-icon">
        <i class="fas fa-lock"></i>
      </div>
      <div class="auth-title">Forgot Password?</div>
      <div class="auth-subtitle">
        No worries! Enter the email address associated with your account and we'll send you a link to reset your password.
      </div>

      <?= form_open(url_to('password-reset'), 'class="actionForm" data-redirect="user"') ?>

      <div class="form-group">
        <label class="form-label">Email Address</label>
        <input class="form-input" type="email" name="email"
          placeholder="you@example.com" required autofocus>
      </div>

      <button type="submit" class="submit-btn">
        <i class="fas fa-paper-plane me-2"></i> Send Reset Link
      </button>

      <?= form_close(); ?>

      <div class="bottom-links">
        <div>Remember your password? <a href="<?= base_url('sign-in') ?>">Sign In</a></div>
        <div>Don't have an account? <a href="<?= base_url('sign-up') ?>">Create Account</a></div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
