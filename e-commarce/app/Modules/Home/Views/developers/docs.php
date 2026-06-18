<?php 
$G_PAYMENT_URL = getenv('PAYMENT_URL'); 
if(!defined('GLOBAL_PAYMENT_URL')) define('GLOBAL_PAYMENT_URL', $G_PAYMENT_URL);
?>

<style>
/* ═══════ DOCS PAGE ULTIMATE FIX ═══════ */
.docs-page { padding: 100px 0 80px; min-height: 100vh; background: #050811; color: #fff; font-family: 'Inter', sans-serif; }
.docs-grid { display: grid; grid-template-columns: 260px 1fr; gap: 40px; }

/* SIDEBAR */
.docs-side { position: sticky; top: 100px; height: fit-content; }
.docs-side-inner { background: rgba(15, 20, 35, 0.85); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 16px; padding: 20px; backdrop-filter: blur(15px); }
.docs-side a { display: block; padding: 10px 15px; border-radius: 10px; color: rgba(255,255,255,0.45); text-decoration: none; font-size: 13px; font-weight: 500; transition: 0.3s; margin-bottom: 5px; }
.docs-side a:hover, .docs-side a.active { color: #fff; background: rgba(99, 102, 241, 0.1); border: 1px solid rgba(99, 102, 241, 0.15); }

/* CONTENT */
.doc-card { background: rgba(15, 20, 35, 0.6); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 20px; padding: 35px; margin-bottom: 30px; }
.doc-card h2 { font-size: 26px; font-weight: 800; margin-bottom: 15px; color: #fff; letter-spacing: -0.02em; }
.doc-card h3 { font-size: 18px; font-weight: 700; color: #818cf8; margin: 25px 0 12px; display: flex; align-items: center; gap: 8px; }
.doc-card p { font-size: 15px; line-height: 1.8; color: rgba(255,255,255,0.55); margin-bottom: 15px; }

/* TABLES */
.doc-table { width: 100%; border-collapse: separate; border-spacing: 0; border-radius: 12px; overflow: hidden; border: 1px solid rgba(255, 255, 255, 0.06); margin: 15px 0 25px; }
.doc-table thead th { background: rgba(99, 102, 241, 0.12); color: rgba(167, 139, 250, 0.9); font-size: 11px; font-weight: 700; text-transform: uppercase; padding: 14px 16px; text-align: left; letter-spacing: 1px; }
.doc-table tbody td { padding: 12px 16px; font-size: 13px; color: rgba(255, 255, 255, 0.65); border-bottom: 1px solid rgba(255, 255, 255, 0.04); }
.doc-table tr:last-child td { border-bottom: none; }
.tag { padding: 2px 8px; border-radius: 4px; font-size: 10px; font-weight: 700; text-transform: uppercase; }
.tag-req { background: rgba(239, 68, 68, 0.15); color: #ef4444; }
.tag-opt { background: rgba(100, 116, 139, 0.15); color: #94a3b8; }

/* VERTICAL TABS */
.code-section { display: flex; background: #0a0e1a; border: 1px solid rgba(255,255,255,0.1); border-radius: 15px; overflow: hidden; margin: 20px 0; min-height: 380px; }
.lang-nav { width: 170px; background: rgba(255,255,255,0.02); border-right: 1px solid rgba(255,255,255,0.08); display: flex; flex-direction: column; padding: 15px 0; flex-shrink: 0; }
.lang-btn { background: none; border: none; color: rgba(255,255,255,0.4); padding: 12px 25px; text-align: left; font-size: 13px; font-weight: 600; cursor: pointer; border-left: 3px solid transparent; transition: 0.2s; }
.lang-btn.active { color: #818cf8; background: rgba(99,102,241,0.08); border-left-color: #818cf8; }

.code-display { flex-grow: 1; position: relative; background: #0a0e1a; overflow: hidden; }
.code-panel { display: none; padding: 30px; height: 100%; overflow: auto; }
.code-panel.active { display: block !important; }
.code-panel pre { margin: 0 !important; white-space: pre !important; display: block !important; color: #a5b4fc !important; font-family: 'JetBrains Mono', monospace !important; font-size: 13px !important; line-height: 1.8 !important; }
.copy-btn { position: absolute; top: 15px; right: 15px; padding: 6px 12px; border-radius: 8px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.1); color: #fff; font-size: 11px; cursor: pointer; z-index: 20; }

/* MODULE CARDS */
.dl-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; margin: 20px 0; }
.dl-card { display: flex; align-items: center; gap: 15px; padding: 15px 20px; border-radius: 15px; background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06); transition: 0.3s; text-decoration: none; color: inherit; }
.dl-card:hover { background: rgba(99, 102, 241, 0.08); border-color: rgba(99, 102, 241, 0.2); transform: translateY(-3px); }
.dl-icon { width: 42px; height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; }
.dl-name { font-weight: 600; font-size: 14px; color: #fff; }
.dl-sub { font-size: 11px; color: rgba(255,255,255,0.35); }

@media (max-width: 900px) {
    .docs-grid { grid-template-columns: 1fr; gap: 15px; }
    
    /* True horizontal scrolling sidebar for mobile */
    .docs-side { position: relative; top: 0; z-index: 10; margin-bottom: 10px; }
    .docs-side-inner { padding: 12px; display: flex; flex-direction: row; flex-wrap: nowrap; gap: 8px; overflow-x: auto; white-space: nowrap; border-radius: 12px; }
    .docs-side-inner::-webkit-scrollbar { display: none; }
    .docs-side-inner h4 { display: none; } /* Hide the 'Navigation' title to save space */
    .docs-side a { margin: 0; padding: 8px 16px; font-size: 13px; flex: 0 0 auto; border-radius: 50px; }
    
    /* Prevent doc-card from expanding page width */
    .doc-card { padding: 16px; border-radius: 16px; max-width: 100vw; overflow: hidden; }
    .doc-card h2 { font-size: 20px; }
    .doc-card h3 { font-size: 16px; }
    .doc-card p { font-size: 14px; }
    
    /* Fix table overflow properly */
    .doc-table { display: block; width: 100%; overflow-x: auto; white-space: nowrap; border: none; }
    .doc-table thead th, .doc-table tbody td { border: 1px solid rgba(255, 255, 255, 0.04); font-size: 12px; padding: 10px; }
    
    /* Force code section to fit screen */
    .code-section { flex-direction: column; width: 100%; max-width: 100vw; }
    .lang-nav { width: 100%; flex-direction: row; border-right: none; border-bottom: 1px solid rgba(255,255,255,0.1); overflow-x: auto; white-space: nowrap; padding: 0; }
    .lang-nav::-webkit-scrollbar { display: none; }
    .lang-btn { border-left: none; border-bottom: 3px solid transparent; padding: 12px 20px; flex: 0 0 auto; }
    .code-display { width: 100%; max-width: 100%; overflow: hidden; }
    .code-panel { padding: 16px; width: 100%; overflow-x: auto; }
    .code-panel pre { font-size: 12px !important; }
    
    .dl-grid { grid-template-columns: 1fr; gap: 10px; }
    .dl-card { padding: 12px 15px; }
}

/* New Download Styles */
.dl-card { position: relative; overflow: hidden; }
.dl-actions { display: flex; gap: 8px; margin-left: auto; }
.dl-btn { width: 34px; height: 34px; border-radius: 8px; display: flex; align-items: center; justify-content: center; transition: 0.2s; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: rgba(255,255,255,0.6); }
.dl-btn:hover { background: rgba(99, 102, 241, 0.2); border-color: rgba(99, 102, 241, 0.4); color: #fff; }
.dl-btn.dl-down { color: #34d399; }
.dl-btn.dl-video { color: #f87171; }
</style>

<section class="docs-page">
<div class="container">
<div class="docs-grid">

<aside class="docs-side">
  <div class="docs-side-inner">
    <h4>Navigation</h4>
    <a href="#intro" class="active">Introduction</a>
    <a href="#api-ops">API Endpoints</a>
    <a href="#params">Parameters</a>
    <a href="#create-payment">Create Payment</a>
    <a href="#verify-payment">Verify Payment</a>
    <a href="#modules">Downloads</a>
  </div>
</aside>

<div class="docs-main">
  <!-- Intro -->
  <div class="doc-card" id="intro">
    <h2>Introduction</h2>
    <p>The Ekhoni Digital Payment Gateway enables merchants to securely receive payments from their customers. Our PCI-compliant flow ensures that you can accept payments with minimal effort while maintaining the highest level of security.</p>
    <p>You can use our RESTful APIs to integrate into any environment (PHP, Node, Python, etc.) or use our pre-built plugins for popular platforms like WordPress.</p>
  </div>

  <!-- Endpoints -->
  <div class="doc-card" id="api-ops">
    <h2>API Endpoints</h2>
    <p>Base URL: <code><?= GLOBAL_PAYMENT_URL ?>api/</code></p>
    <div style="background:rgba(0,0,0,0.4); padding:15px; border-radius:12px; font-family:monospace; margin-bottom:12px; border:1px solid rgba(255,255,255,0.08)">
      <span style="color:#34d399; font-weight:bold; margin-right:10px">POST</span> payment/create
    </div>
    <div style="background:rgba(0,0,0,0.4); padding:15px; border-radius:12px; font-family:monospace; border:1px solid rgba(255,255,255,0.08)">
      <span style="color:#34d399; font-weight:bold; margin-right:10px">POST</span> payment/verify
    </div>
  </div>

  <!-- Parameters -->
  <div class="doc-card" id="params">
    <h2>Request Parameters</h2>
    <h3><i class="fas fa-list-ul"></i> Required Fields</h3>
    <table class="doc-table">
      <thead><tr><th>Field</th><th>Description</th><th>Constraint</th></tr></thead>
      <tbody>
        <tr><td><strong>API-KEY</strong></td><td>Your unique brand API key from dashboard</td><td><span class="tag tag-req">Required</span></td></tr>
        <tr><td><strong>amount</strong></td><td>Payment amount in decimal (e.g. 10.00)</td><td><span class="tag tag-req">Required</span></td></tr>
        <tr><td><strong>success_url</strong></td><td>The URL we redirect to after success</td><td><span class="tag tag-req">Required</span></td></tr>
        <tr><td><strong>cancel_url</strong></td><td>The URL we redirect to after cancellation</td><td><span class="tag tag-req">Required</span></td></tr>
      </tbody>
    </table>

    <h3><i class="fas fa-info-circle"></i> Metadata Fields</h3>
    <p>You can send custom metadata to track customer information. This will be returned in the response.</p>
    <table class="doc-table">
      <thead><tr><th>Field</th><th>Description</th></tr></thead>
      <tbody>
        <tr><td><strong>email</strong></td><td>Customer's email address</td></tr>
        <tr><td><strong>phone</strong></td><td>Customer's mobile number</td></tr>
        <tr><td><strong>order_id</strong></td><td>Your internal order reference ID</td></tr>
      </tbody>
    </table>
  </div>

  <!-- Create Payment -->
  <div class="doc-card" id="create-payment">
    <h2>Create Payment</h2>
    <p>Initiate a new payment request and receive a secure payment link.</p>
    <?= view('Home\Views\developers\integration'); ?>
  </div>

  <!-- Verify Payment -->
  <div class="doc-card" id="verify-payment">
    <h2>Verify Payment</h2>
    <p>Verify the status of a transaction using the transaction ID returned to your success URL.</p>
    <?= view('Home\Views\developers\integration2'); ?>
  </div>

  <!-- Downloads -->
  <div class="doc-card" id="modules">
    <h2>Downloads & Modules</h2>
    <p>Get started quickly with our pre-built plugins and SDKs.</p>
    <div class="dl-grid">
      
      <!-- WP -->
      <div class="dl-card">
        <div class="dl-icon" style="background:rgba(33,150,243,0.1); color:#2196f3"><i class="fab fa-wordpress"></i></div>
        <div style="flex-grow:1">
          <div class="dl-name"><?=get_option('dl_wp_name', 'WordPress Plugin')?></div>
          <div class="dl-sub"><?=get_option('dl_wp_ver', 'v1.2.0')?> • <?=get_option('dl_wp_sub', 'WooCommerce')?></div>
        </div>
        <div class="dl-actions">
          <?php if($video = get_option('dl_wp_video')): ?>
            <a href="<?=$video?>" target="_blank" class="dl-btn dl-video" title="Watch Video"><i class="fas fa-play"></i></a>
          <?php endif; ?>
          <a href="<?=base_url(get_option('dl_wp_file', '#'))?>" class="dl-btn dl-down" title="Download ZIP" download><i class="fas fa-download"></i></a>
        </div>
      </div>

      <!-- WHMCS -->
      <div class="dl-card">
        <div class="dl-icon" style="background:rgba(0,200,83,0.1); color:#00c853"><i class="fas fa-shopping-cart"></i></div>
        <div style="flex-grow:1">
          <div class="dl-name"><?=get_option('dl_whmcs_name', 'WHMCS Module')?></div>
          <div class="dl-sub"><?=get_option('dl_whmcs_ver', 'v2.0.1')?> • <?=get_option('dl_whmcs_sub', 'Automation')?></div>
        </div>
        <div class="dl-actions">
          <?php if($video = get_option('dl_whmcs_video')): ?>
            <a href="<?=$video?>" target="_blank" class="dl-btn dl-video" title="Watch Video"><i class="fas fa-play"></i></a>
          <?php endif; ?>
          <a href="<?=base_url(get_option('dl_whmcs_file', '#'))?>" class="dl-btn dl-down" title="Download ZIP" download><i class="fas fa-download"></i></a>
        </div>
      </div>

      <!-- SMM -->
      <div class="dl-card">
        <div class="dl-icon" style="background:rgba(233,30,99,0.1); color:#e91e63"><i class="fas fa-share-alt"></i></div>
        <div style="flex-grow:1">
          <div class="dl-name"><?=get_option('dl_smm_name', 'SMM Panel Script')?></div>
          <div class="dl-sub"><?=get_option('dl_smm_ver', 'v3.5.0')?> • <?=get_option('dl_smm_sub', 'Perfect Panel')?></div>
        </div>
        <div class="dl-actions">
          <?php if($video = get_option('dl_smm_video')): ?>
            <a href="<?=$video?>" target="_blank" class="dl-btn dl-video" title="Watch Video"><i class="fas fa-play"></i></a>
          <?php endif; ?>
          <a href="<?=base_url(get_option('dl_smm_file', '#'))?>" class="dl-btn dl-down" title="Download ZIP" download><i class="fas fa-download"></i></a>
        </div>
      </div>

      <!-- App -->
      <div class="dl-card">
        <div class="dl-icon" style="background:rgba(52,211,153,0.1); color:#34d399"><i class="fab fa-android"></i></div>
        <div style="flex-grow:1">
          <div class="dl-name"><?=get_option('dl_app_name', 'Mobile App')?></div>
          <div class="dl-sub"><?=get_option('dl_app_ver', 'v1.0.5')?> • <?=get_option('dl_app_sub', 'SDK Included')?></div>
        </div>
        <div class="dl-actions">
          <?php if($video = get_option('dl_app_video')): ?>
            <a href="<?=$video?>" target="_blank" class="dl-btn dl-video" title="Watch Video"><i class="fas fa-play"></i></a>
          <?php endif; ?>
          <a href="<?=base_url(get_option('dl_app_file', '#'))?>" class="dl-btn dl-down" title="Download APK" download><i class="fas fa-download"></i></a>
        </div>
      </div>

    </div>
  </div>
</div>

</div>
</div>
</section>

<script>
function switchTab(btn, tabId) {
    var section = btn.closest('.code-section');
    section.querySelectorAll('.lang-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    section.querySelectorAll('.code-panel').forEach(p => p.classList.remove('active'));
    var target = document.getElementById(tabId);
    if(target) target.classList.add('active');
}

function copyCode(btn) {
    var section = btn.closest('.code-section');
    var activePanel = section.querySelector('.code-panel.active code');
    if(!activePanel) return;
    var text = activePanel.innerText || activePanel.textContent;
    navigator.clipboard.writeText(text.trim()).then(function() {
        var old = btn.innerText;
        btn.innerText = 'Copied!';
        setTimeout(function(){ btn.innerText = old; }, 2000);
    });
}

document.addEventListener('DOMContentLoaded', function() {
  const links = document.querySelectorAll('.docs-side a');
  window.addEventListener('scroll', function() {
    let fromTop = window.scrollY + 120;
    links.forEach(link => {
      let section = document.querySelector(link.hash);
      if (section && section.offsetTop <= fromTop && section.offsetTop + section.offsetHeight > fromTop) {
        links.forEach(l => l.classList.remove('active'));
        link.classList.add('active');
      }
    });
  });
});
</script>
