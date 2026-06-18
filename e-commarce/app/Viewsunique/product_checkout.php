<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= esc($product['product_name']) ?> — <?= get_option('site_name', 'Ekhoni Digital') ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= BASE_SITE . get_option('site_icon', BASE_SITE . "assets/images/favicon.png") ?>">
    <?= link_asset('css/stylev2.css') ?>
    <?= link_asset('toast/toastr.min.css') ?>
    <?= script_asset('js/jquery.js') ?>
    <?= script_asset('toast/toastr.min.js') ?>
    <style>
        :root { --bg1: #6366f1; --bg2: #8b5cf6; }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', -apple-system, sans-serif; background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%); min-height: 100vh; color: #e2e8f0; }
        .product-page { max-width: 480px; margin: 0 auto; min-height: 100vh; display: flex; flex-direction: column; }
        .brand-bar { display: flex; align-items: center; gap: 12px; padding: 16px 20px; background: rgba(255,255,255,0.04); border-bottom: 1px solid rgba(255,255,255,0.06); }
        .brand-bar img { width: 40px; height: 40px; border-radius: 50%; border: 2px solid rgba(255,255,255,0.15); object-fit: contain; background: #fff; }
        .brand-bar-info h4 { font-size: 14px; font-weight: 600; }
        .brand-bar-info span { font-size: 11px; color: rgba(255,255,255,0.5); }
        .product-card { margin: 20px 16px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; overflow: hidden; }
        .product-header { padding: 24px 20px; text-align: center; background: linear-gradient(135deg, rgba(99,102,241,0.15), rgba(139,92,246,0.1)); border-bottom: 1px solid rgba(255,255,255,0.06); }
        .product-icon { width: 64px; height: 64px; border-radius: 16px; background: linear-gradient(135deg, #6366f1, #8b5cf6); display: flex; align-items: center; justify-content: center; margin: 0 auto 12px; box-shadow: 0 8px 25px rgba(99,102,241,0.3); }
        .product-icon svg { width: 32px; height: 32px; }
        .product-name { font-size: 20px; font-weight: 700; margin-bottom: 6px; }
        .product-price { font-size: 28px; font-weight: 800; background: linear-gradient(135deg, #6366f1, #a78bfa); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .product-price span { font-size: 14px; font-weight: 400; -webkit-text-fill-color: rgba(255,255,255,0.5); }
        .product-desc { padding: 16px 20px; font-size: 13px; color: rgba(255,255,255,0.6); line-height: 1.7; border-bottom: 1px solid rgba(255,255,255,0.04); }
        .form-section { padding: 20px 16px; flex: 1; }
        .form-title { font-size: 14px; font-weight: 600; margin-bottom: 16px; color: rgba(255,255,255,0.7); display: flex; align-items: center; gap: 8px; }
        .form-group { margin-bottom: 14px; }
        .form-group label { display: block; font-size: 12px; font-weight: 500; color: rgba(255,255,255,0.5); margin-bottom: 6px; }
        .form-group input { width: 100%; padding: 14px 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; background: rgba(255,255,255,0.05); color: #e2e8f0; font-size: 14px; transition: all 0.25s ease; outline: none; }
        .form-group input:focus { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99,102,241,0.15); background: rgba(255,255,255,0.08); }
        .form-group input::placeholder { color: rgba(255,255,255,0.25); }
        .purchase-btn { width: 100%; padding: 16px; border: none; border-radius: 12px; background: linear-gradient(135deg, #6366f1, #8b5cf6); color: #fff; font-size: 16px; font-weight: 700; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; gap: 10px; margin-top: 8px; letter-spacing: 0.5px; }
        .purchase-btn:hover { filter: brightness(1.1); transform: translateY(-2px); box-shadow: 0 8px 25px rgba(99,102,241,0.35); }
        .purchase-btn:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }
        .footer-note { text-align: center; padding: 16px; font-size: 11px; color: rgba(255,255,255,0.2); }
        .footer-note a { color: #6366f1; }
        .secure-badge { display: flex; align-items: center; justify-content: center; gap: 6px; font-size: 11px; color: rgba(255,255,255,0.35); margin-top: 12px; }
        .secure-badge svg { width: 14px; height: 14px; }
    </style>
</head>
<body>
<div class="product-page">
    <div class="brand-bar">
        <?php if (!empty($product['brand_logo'])): ?>
            <img src="<?= BASE_SITE . $product['brand_logo'] ?>" alt="<?= esc($product['brand_name']) ?>">
        <?php endif; ?>
        <div class="brand-bar-info">
            <h4><?= esc($product['brand_name'] ?? 'Store') ?></h4>
            <span>Digital Product</span>
        </div>
    </div>
    <div class="product-card">
        <div class="product-header">
            <div class="product-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>
            </div>
            <h2 class="product-name"><?= esc($product['product_name']) ?></h2>
            <div class="product-price">৳<?= number_format($product['product_price'], 2) ?> <span>BDT</span></div>
        </div>
        <?php if (!empty($product['product_description'])): ?>
        <div class="product-desc"><?= nl2br(esc($product['product_description'])) ?></div>
        <?php endif; ?>
    </div>
    <div class="form-section">
        <div class="form-title">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            Customer Information
        </div>
        <div class="form-group">
            <label>Full Name</label>
            <input type="text" id="cus_name" placeholder="আপনার নাম লিখুন" required>
        </div>
        <div class="form-group">
            <label>Email Address</label>
            <input type="email" id="cus_email" placeholder="example@email.com" required>
        </div>
        <div class="form-group">
            <label>Phone Number</label>
            <input type="tel" id="cus_phone" placeholder="01XXXXXXXXX" required>
        </div>
        <button class="purchase-btn" id="purchaseBtn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
            Purchase — ৳<?= number_format($product['product_price'], 2) ?>
        </button>
        <div class="secure-badge">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
            Secured by <?= get_option('site_name', 'Ekhoni Digital') ?>
        </div>
    </div>
    <div class="footer-note">
        Powered by <a href="<?= BASE_SITE ?>"><?= get_option('site_name', 'Ekhoni Digital') ?></a>
    </div>
</div>
<script>
    var token = '<?= csrf_hash() ?>';
    $('#purchaseBtn').on('click', function() {
        var btn = $(this);
        var name = $('#cus_name').val().trim();
        var email = $('#cus_email').val().trim();
        var phone = $('#cus_phone').val().trim();
        if (!name || !email || !phone) { showToast('সকল তথ্য পূরণ করুন', 'error'); return; }
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { showToast('সঠিক ইমেইল দিন', 'error'); return; }
        btn.prop('disabled', true).html('⏳ Processing...');
        $.post('<?= base_url("api/productPurchase") ?>', {
            token: token, short_code: '<?= $shortCode ?>', cus_name: name, cus_email: email, cus_phone: phone
        }, function(res) {
            if (res.status === 'success' && res.redirect) { window.location.href = res.redirect; }
            else { showToast(res.message || 'Error occurred', 'error'); btn.prop('disabled', false).html('Purchase — ৳<?= number_format($product["product_price"], 2) ?>'); }
        }, 'json').fail(function() { showToast('Network error', 'error'); btn.prop('disabled', false).html('Purchase — ৳<?= number_format($product["product_price"], 2) ?>'); });
    });
</script>
</body>
</html>
