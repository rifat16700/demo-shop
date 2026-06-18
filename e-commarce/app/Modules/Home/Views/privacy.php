<style>
  .legal-hero { background: linear-gradient(135deg, #0f172a, #1e293b); padding: 100px 0 50px; text-align: center; }
  .legal-hero h1 { color: #fff; font-size: 2rem; font-weight: 800; }
  .legal-hero .breadcrumb-nav { display: flex; justify-content: center; gap: 8px; font-size: 0.9rem; color: rgba(255,255,255,0.5); margin-top: 10px; }
  .legal-hero .breadcrumb-nav a { color: rgba(255,255,255,0.7); text-decoration: none; }
  .legal-content { background: #f8fafc; padding: 50px 0 80px; }
  .legal-card { background: #fff; border-radius: 20px; padding: 40px 36px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); line-height: 1.8; color: #334155; font-size: 0.95rem; }
  .legal-card h2, .legal-card h3 { color: #0f172a; margin-top: 24px; }
  .legal-card a { color: #6366f1; }
  @media (max-width: 768px) { .legal-card { padding: 28px 20px; } .legal-hero { padding: 80px 0 40px; } }
</style>
<div class="legal-hero">
  <div class="container">
    <h1>Privacy Policy</h1>
    <div class="breadcrumb-nav">
      <a href="<?= base_url() ?>">Home</a><span>/</span><span>Privacy Policy</span>
    </div>
  </div>
</div>
<section class="legal-content">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-9">
        <div class="legal-card">
          <?= htmlspecialchars_decode(get_option('policy_content'), ENT_QUOTES) ?>
        </div>
      </div>
    </div>
  </div>
</section>