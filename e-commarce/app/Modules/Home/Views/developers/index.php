<!-- Developer Docs Landing - Integrated with docs.php layout -->
<style>
  /* ===== HERO ===== */
  .dev-hero {
    background: linear-gradient(135deg, #1e1b4b 0%, #312e81 40%, #4338ca 100%);
    padding: 80px 0 60px;
    text-align: center;
    position: relative;
    overflow: hidden;
    margin-top: -20px;
  }
  .dev-hero::before {
    content: '';
    position: absolute;
    top: -30%; right: -10%;
    width: 500px; height: 500px;
    background: radial-gradient(circle, rgba(129,140,248,0.2), transparent 60%);
    border-radius: 50%;
  }
  .dev-hero::after {
    content: '';
    position: absolute;
    bottom: -40%; left: -5%;
    width: 400px; height: 400px;
    background: radial-gradient(circle, rgba(99,102,241,0.15), transparent 60%);
    border-radius: 50%;
  }
  .dev-hero h1 {
    font-size: clamp(1.8rem, 4vw, 2.8rem);
    font-weight: 800;
    color: #fff;
    margin-bottom: 12px;
    position: relative;
    z-index: 1;
    letter-spacing: -0.5px;
  }
  .dev-hero .hero-desc {
    font-size: clamp(0.9rem, 1.5vw, 1.1rem);
    color: rgba(255,255,255,0.75);
    max-width: 640px;
    margin: 0 auto 24px;
    line-height: 1.6;
    position: relative;
    z-index: 1;
  }
  /* Search */
  .hero-search {
    max-width: 520px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
  }
  .hero-search input {
    width: 100%;
    height: 52px;
    border-radius: 16px;
    border: 1px solid rgba(255,255,255,0.15);
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(8px);
    padding: 0 52px 0 20px;
    color: #fff;
    font-size: 0.95rem;
    font-family: inherit;
    transition: all 0.3s;
  }
  .hero-search input::placeholder { color: rgba(255,255,255,0.5); }
  .hero-search input:focus {
    outline: none;
    border-color: rgba(129,140,248,0.5);
    box-shadow: 0 0 0 3px rgba(99,102,241,0.2);
    background: rgba(255,255,255,0.12);
  }
  .hero-search button {
    position: absolute;
    right: 6px; top: 6px;
    width: 40px; height: 40px;
    border-radius: 12px;
    border: none;
    background: rgba(255,255,255,0.15);
    color: #fff;
    cursor: pointer;
    transition: background 0.2s;
  }
  .hero-search button:hover { background: rgba(255,255,255,0.25); }

  /* ===== DOCS CARDS ===== */
  .docs-section {
    padding: 50px 0 70px;
    background: #f8fafc;
  }
  .doc-card {
    background: #fff;
    border-radius: 18px;
    padding: 28px 24px;
    height: 100%;
    border: 1px solid #e2e8f0;
    transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
    position: relative;
    overflow: hidden;
    display: block;
    text-decoration: none;
    color: inherit;
  }
  .doc-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 4px;
    background: linear-gradient(90deg, #6366f1, #8b5cf6);
    opacity: 0;
    transition: opacity 0.3s;
  }
  .doc-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 50px rgba(0,0,0,0.08);
    border-color: rgba(99,102,241,0.2);
    color: inherit;
    text-decoration: none;
  }
  .doc-card:hover::before { opacity: 1; }

  .doc-card-icon {
    width: 52px; height: 52px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    margin-bottom: 16px;
    background: linear-gradient(135deg, rgba(99,102,241,0.1), rgba(139,92,246,0.08));
    color: #6366f1;
  }
  .doc-card h3 {
    font-size: 1.1rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 8px;
  }
  .doc-card p {
    font-size: 0.88rem;
    color: #64748b;
    line-height: 1.6;
    margin: 0;
  }
  .doc-card .arrow {
    position: absolute;
    bottom: 20px; right: 20px;
    color: #c7d2fe;
    font-size: 1rem;
    transition: all 0.3s;
  }
  .doc-card:hover .arrow { color: #6366f1; transform: translateX(4px); }

  /* ===== CTA ===== */
  .dev-cta {
    background: linear-gradient(135deg, #0f172a, #1e293b);
    padding: 60px 0;
    text-align: center;
    color: #fff;
  }
  .dev-cta h2 {
    font-size: 1.8rem;
    font-weight: 800;
    margin-bottom: 12px;
  }
  .dev-cta p {
    font-size: 1rem;
    color: rgba(255,255,255,0.6);
    max-width: 600px;
    margin: 0 auto 24px;
  }
  .cta-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 14px 32px;
    border-radius: 14px;
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    color: #fff;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s;
  }
  .cta-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 32px rgba(99,102,241,0.4);
    color: #fff;
  }

  @media (max-width: 768px) {
    .dev-hero { padding: 60px 0 40px; }
    .docs-section { padding: 30px 0 50px; }
    .doc-card { padding: 22px 18px; }
  }
</style>

<!-- Hero -->
<div class="dev-hero">
  <div class="container">
    <h1>Developer Documentation</h1>
    <p class="hero-desc">Accept payments from <?= htmlspecialchars(site_config("site_name")) ?> using our secure APIs. Everything you need to integrate payments into your application.</p>
    <form class="hero-search" action="<?= base_url('developers/docs') ?>" method="get">
      <input type="text" name="search" placeholder="Search the docs..." aria-label="Search documentation">
      <button type="submit"><i class="fas fa-search"></i></button>
    </form>
  </div>
</div>

<!-- Docs Cards -->
<section class="docs-section">
  <div class="container">
    <div class="row g-4">

      <div class="col-12 col-md-6 col-lg-4">
        <a href="<?= base_url('developers/docs') ?>#section-1" class="doc-card">
          <div class="doc-card-icon">
            <i class="fas fa-map-signs"></i>
          </div>
          <h3>Introduction</h3>
          <p><?= htmlspecialchars(site_config("site_name")) ?> Payment Gateway enables merchants to receive payments by securely redirecting customers through our PCI-compliant flow.</p>
          <i class="fas fa-arrow-right arrow"></i>
        </a>
      </div>

      <div class="col-12 col-md-6 col-lg-4">
        <a href="<?= base_url('developers/docs') ?>#section-2" class="doc-card">
          <div class="doc-card-icon">
            <i class="fas fa-key"></i>
          </div>
          <h3>API Reference</h3>
          <p>REST APIs for Sandbox and Live environments. Use Sandbox for testing, then switch to Live with your production API keys.</p>
          <i class="fas fa-arrow-right arrow"></i>
        </a>
      </div>

      <div class="col-12 col-md-6 col-lg-4">
        <a href="<?= base_url('developers/docs') ?>#section-3" class="doc-card">
          <div class="doc-card-icon">
            <i class="fas fa-cogs"></i>
          </div>
          <h3>Integration Guide</h3>
          <p>Step-by-step guides for PHP, Laravel, WordPress, WooCommerce. Complete with sample code and SDKs.</p>
          <i class="fas fa-arrow-right arrow"></i>
        </a>
      </div>

      <div class="col-12 col-md-6 col-lg-4">
        <a href="<?= base_url('developers/docs') ?>#section-5" class="doc-card">
          <div class="doc-card-icon">
            <i class="fas fa-mobile-alt"></i>
          </div>
          <h3>Mobile App</h3>
          <p>Download our Android app and connect with live API keys to verify and monitor transactions in real time.</p>
          <i class="fas fa-arrow-right arrow"></i>
        </a>
      </div>

      <div class="col-12 col-md-6 col-lg-4">
        <a href="<?= base_url('developers/docs') ?>#section-security" class="doc-card">
          <div class="doc-card-icon">
            <i class="fas fa-shield-alt"></i>
          </div>
          <h3>Security & Compliance</h3>
          <p>Industry best-practices: tokenization, TLS encryption, secure storage and comprehensive audit-ready logs.</p>
          <i class="fas fa-arrow-right arrow"></i>
        </a>
      </div>

      <div class="col-12 col-md-6 col-lg-4">
        <a href="<?= base_url('developers/docs') ?>" class="doc-card">
          <div class="doc-card-icon">
            <i class="fas fa-book-open"></i>
          </div>
          <h3>Full Documentation</h3>
          <p>Browse the complete documentation covering all endpoints, webhooks, error codes, and best practices.</p>
          <i class="fas fa-arrow-right arrow"></i>
        </a>
      </div>

    </div>
  </div>
</section>

<!-- CTA -->
<section class="dev-cta">
  <div class="container">
    <h2>Ready to Get Started?</h2>
    <p>Create your account and start accepting payments today with <?= htmlspecialchars(site_config("site_name")) ?>'s secure payment gateway.</p>
    <a href="<?= base_url('sign-up') ?>" class="cta-btn">
      Get Started <i class="fas fa-arrow-right"></i>
    </a>
  </div>
</section>
