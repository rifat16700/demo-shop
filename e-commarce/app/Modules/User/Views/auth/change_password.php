<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Change Password — <?= site_config('site_name', 'Ekhoni Digital') ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
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
.orb-1{width:300px;height:300px;background:#6366f1;top:-60px;right:-60px;animation:orbFloat 8s ease-in-out infinite}
.orb-2{width:250px;height:250px;background:#a78bfa;bottom:-50px;left:20%;animation:orbFloat 10s ease-in-out infinite reverse}
@keyframes orbFloat{0%,100%{transform:translateY(0) scale(1)}50%{transform:translateY(-30px) scale(1.08)}}

.page{
  position:relative;z-index:2;
  min-height:100vh;display:flex;
  align-items:center;justify-content:center;
  padding:24px;
}

.auth-card{
  width:100%;max-width:460px;
  border-radius:24px;overflow:hidden;
  background:rgba(255,255,255,0.04);
  backdrop-filter:blur(20px);
  border:1px solid rgba(255,255,255,0.08);
  box-shadow:0 32px 64px rgba(0,0,0,0.4);
  padding:44px 36px;
}

.shield-icon{
  width:64px;height:64px;border-radius:18px;
  background:linear-gradient(135deg,rgba(16,185,129,0.2),rgba(52,211,153,0.1));
  display:flex;align-items:center;justify-content:center;
  font-size:1.5rem;color:#34d399;
  margin:0 auto 20px;
}

.auth-title{font-size:1.5rem;font-weight:700;text-align:center;margin-bottom:8px}
.auth-subtitle{
  font-size:0.85rem;color:rgba(255,255,255,0.4);
  text-align:center;margin-bottom:28px;
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
  border-color:rgba(16,185,129,0.6);
  box-shadow:0 0 0 3px rgba(16,185,129,0.15);
  background:rgba(255,255,255,0.08);
}

.password-field{position:relative}
.password-toggle{
  position:absolute;right:14px;top:50%;
  transform:translateY(-50%);cursor:pointer;
  color:rgba(255,255,255,0.4);font-size:1rem;
  background:none;border:none;padding:0;
}
.password-toggle:hover{color:rgba(255,255,255,0.7)}

.submit-btn{
  width:100%;height:50px;border:none;border-radius:14px;
  background:linear-gradient(135deg,#10b981,#34d399);
  color:#fff;font-size:0.95rem;font-weight:600;
  cursor:pointer;transition:all 0.3s;
  font-family:'Inter',sans-serif;
  margin-top:8px;
}
.submit-btn:hover{
  transform:translateY(-2px);
  box-shadow:0 12px 32px rgba(16,185,129,0.4);
}

.bottom-link{
  text-align:center;margin-top:24px;
  font-size:0.82rem;color:rgba(255,255,255,0.4);
}
.bottom-link a{color:#a78bfa;text-decoration:none;font-weight:600}

@media(max-width:480px){
  .page{padding:12px}
  .auth-card{padding:32px 24px}
  .auth-title{font-size:1.3rem}
}
</style>
</head>

<body>
<div class="bg-animation"></div>
<div class="orb orb-1"></div>
<div class="orb orb-2"></div>

<div class="page">
  <div class="auth-card">
    <div class="shield-icon">
      <i class="fas fa-shield-halved"></i>
    </div>
    <div class="auth-title">Set New Password</div>
    <div class="auth-subtitle">Create a strong password to secure your account</div>

    <?= form_open('', 'class="actionForm" data-redirect="user"') ?>

    <div class="form-group">
      <label class="form-label">New Password</label>
      <div class="password-field">
        <input class="form-input" type="password" id="password"
          name="password" placeholder="Min 5 characters" required>
        <button type="button" class="password-toggle" onclick="togglePw('password',this)">
          <i class="fas fa-eye"></i>
        </button>
      </div>
    </div>

    <div class="form-group">
      <label class="form-label">Confirm Password</label>
      <div class="password-field">
        <input class="form-input" type="password" id="c_password"
          name="c_password" placeholder="Re-enter password" required>
        <button type="button" class="password-toggle" onclick="togglePw('c_password',this)">
          <i class="fas fa-eye"></i>
        </button>
      </div>
    </div>

    <button type="submit" class="submit-btn">
      <i class="fas fa-check-circle me-2"></i> Update Password
    </button>

    <?= form_close(); ?>

    <div class="bottom-link">
      <a href="<?= base_url('sign-in') ?>"><i class="fas fa-arrow-left me-1"></i> Back to Sign In</a>
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
