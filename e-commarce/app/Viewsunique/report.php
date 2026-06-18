<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment <?= ucfirst($status ?? 'Status') ?> - <?= get_option('site_name', 'Your Site') ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= BASE_SITE . get_option('site_icon', BASE_SITE . "assets/images/favicon.png") ?>">
    <?= link_asset('css/stylev2.css') ?>
    <?= link_asset('toast/toastr.min.css') ?>
    <?= script_asset('js/jquery.js') ?>
    <?= script_asset('toast/toastr.min.js') ?>
    <style>
        :root {
            --bg1: <?= $bg ?>;
            --bg2: <?= $bg ?>;
        }

        /* ─── Status-specific overrides ─── */
        <?php if ($type == '2'): ?>
        .status-icon-ring { background: rgba(52, 211, 153, 0.12); }
        .status-icon-inner { background: linear-gradient(135deg, #34d399, #10b981); }
        .status-badge { background: rgba(52, 211, 153, 0.15); color: #34d399; border: 1px solid rgba(52, 211, 153, 0.3); }
        .status-title { color: #34d399; }
        <?php elseif ($type == '1'): ?>
        .status-icon-ring { background: rgba(251, 191, 36, 0.12); }
        .status-icon-inner { background: linear-gradient(135deg, #fbbf24, #f59e0b); }
        .status-badge { background: rgba(251, 191, 36, 0.15); color: #fbbf24; border: 1px solid rgba(251, 191, 36, 0.3); }
        .status-title { color: #fbbf24; }
        <?php else: ?>
        .status-icon-ring { background: rgba(248, 113, 113, 0.12); }
        .status-icon-inner { background: linear-gradient(135deg, #f87171, #ef4444); }
        .status-badge { background: rgba(248, 113, 113, 0.15); color: #f87171; border: 1px solid rgba(248, 113, 113, 0.3); }
        .status-title { color: #f87171; }
        <?php endif; ?>

        @keyframes checkmark-draw {
            0% { stroke-dashoffset: 60; }
            100% { stroke-dashoffset: 0; }
        }
        @keyframes scale-bounce {
            0% { transform: scale(0); opacity: 0; }
            60% { transform: scale(1.15); }
            100% { transform: scale(1); opacity: 1; }
        }
        @keyframes confetti-fall {
            0% { transform: translateY(-10px) rotate(0deg); opacity: 1; }
            100% { transform: translateY(60px) rotate(360deg); opacity: 0; }
        }

        .status-icon-ring { width: 96px; height: 96px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; animation: scale-bounce 0.6s ease forwards; }
        .status-icon-inner { width: 72px; height: 72px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 30px rgba(0,0,0,0.2); }
        .status-icon-inner svg { width: 36px; height: 36px; }
        .checkmark-path { stroke-dasharray: 60; stroke-dashoffset: 60; animation: checkmark-draw 0.5s ease 0.4s forwards; }
        .status-badge { display: inline-flex; align-items: center; gap: 6px; padding: 6px 16px; border-radius: 20px; font-size: 12px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 8px; }
        .status-badge .dot { width: 6px; height: 6px; border-radius: 50%; background: currentColor; animation: pulse 1.5s infinite; }
        @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.4; } }
        .status-title { font-size: 22px; font-weight: 700; margin-bottom: 6px; }
        .status-subtitle { font-size: 13px; color: var(--text-secondary); margin-bottom: 20px; line-height: 1.5; }
        .details-card { background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 12px; padding: 0; overflow: hidden; margin-bottom: 16px; }
        .details-header { padding: 12px 16px; background: rgba(255,255,255,0.04); border-bottom: 1px solid rgba(255,255,255,0.06); font-size: 13px; font-weight: 600; color: var(--text-secondary); display: flex; align-items: center; gap: 8px; }
        .detail-row { display: flex; justify-content: space-between; align-items: center; padding: 12px 16px; border-bottom: 1px solid rgba(255,255,255,0.04); }
        .detail-row:last-child { border-bottom: none; }
        .detail-label { font-size: 13px; color: var(--text-secondary); }
        .detail-value { font-size: 13px; font-weight: 600; color: var(--text-primary); }
        .detail-value.amount { font-size: 16px; font-weight: 700; }
        .action-buttons { display: flex; gap: 10px; margin-top: 16px; }
        .btn-primary-action { flex: 1; padding: 14px; border: none; border-radius: 10px; font-size: 14px; font-weight: 600; cursor: pointer; transition: all 0.25s ease; text-align: center; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 8px; }
        .btn-go-back { background: linear-gradient(135deg, var(--bg1), var(--bg2)); color: #fff; }
        .btn-go-back:hover { filter: brightness(1.1); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(0,0,0,0.3); }
        .btn-secondary-action { flex: 1; padding: 14px; border: 1px solid rgba(255,255,255,0.12); border-radius: 10px; background: rgba(255,255,255,0.05); font-size: 14px; font-weight: 600; color: var(--text-secondary); cursor: pointer; transition: all 0.25s ease; text-align: center; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 8px; }
        .btn-secondary-action:hover { background: rgba(255,255,255,0.1); color: var(--text-primary); border-color: rgba(255,255,255,0.2); }
        .countdown-bar { margin-top: 16px; text-align: center; }
        .countdown-text { font-size: 12px; color: var(--text-secondary); }
        .countdown-num { font-weight: 700; color: var(--text-accent); }
        .progress-track { width: 100%; height: 3px; background: rgba(255,255,255,0.06); border-radius: 10px; margin-top: 8px; overflow: hidden; }
        .progress-fill { height: 100%; border-radius: 10px; transition: width 1s linear; }
        .support-section { text-align: center; margin-top: 16px; padding-top: 12px; border-top: 1px solid rgba(255,255,255,0.06); }
        .support-section p { font-size: 11px; color: rgba(255,255,255,0.3); }
        .support-section a { color: var(--text-accent); font-weight: 500; }
        .confetti-container { position: absolute; top: 0; left: 0; right: 0; height: 120px; overflow: hidden; pointer-events: none; }
        .confetti { position: absolute; width: 6px; height: 6px; border-radius: 2px; animation: confetti-fall 2s ease forwards; }
        .report-content { flex: 1; padding: 20px 16px; overflow-y: auto; text-align: center; }
        .brand-bar { display: flex; align-items: center; gap: 12px; padding: 12px 16px; background: rgba(255,255,255,0.04); border-bottom: 1px solid rgba(255,255,255,0.06); }
        .brand-bar img { width: 40px; height: 40px; border-radius: 50%; border: 2px solid rgba(255,255,255,0.15); object-fit: contain; background: #fff; }
        .brand-bar-info h4 { font-size: 14px; font-weight: 600; color: var(--text-primary); }
        .brand-bar-info span { font-size: 11px; color: var(--text-secondary); }
    </style>
</head>

<body>
    <div class="container">
        <div class="h-full" style="display:flex;flex-direction:column;">
            <div class="brand-bar">
                <img src="<?= BASE_SITE . $business_logo ?>" alt="<?= $business_name ?>">
                <div class="brand-bar-info">
                    <h4><?= $business_name ?></h4>
                    <span>ID: <?= $temp_transaction_id ?></span>
                </div>
            </div>

            <div class="report-content">
                <?php if ($type == '2'): ?>
                <div class="confetti-container" id="confettiBox"></div>
                <div class="status-icon-ring"><div class="status-icon-inner"><svg viewBox="0 0 24 24" fill="none"><path class="checkmark-path" d="M5 13l4 4L19 7" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div></div>
                <div class="status-badge"><span class="dot"></span> COMPLETED</div>
                <h2 class="status-title">পেমেন্ট সফল!</h2>
                <p class="status-subtitle">আপনার পেমেন্ট সফলভাবে সম্পন্ন হয়েছে।<br>ধন্যবাদ আপনার লেনদেনের জন্য।</p>

                <?php elseif ($type == '1'): ?>
                <div class="status-icon-ring"><div class="status-icon-inner"><svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="#fff" stroke-width="2"/><path d="M12 7v5l3 3" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg></div></div>
                <div class="status-badge"><span class="dot"></span> PENDING</div>
                <h2 class="status-title">অপেক্ষা করুন</h2>
                <p class="status-subtitle">আপনার পেমেন্ট রিকোয়েস্ট প্রসেস হচ্ছে।<br>অনুগ্রহ করে ব্রাউজার বন্ধ করবেন না।</p>

                <?php else: ?>
                <div class="status-icon-ring"><div class="status-icon-inner"><svg viewBox="0 0 24 24" fill="none"><path d="M18 6L6 18M6 6l12 12" stroke="#fff" stroke-width="2.5" stroke-linecap="round"/></svg></div></div>
                <div class="status-badge"><span class="dot"></span> <?= strtoupper($status) ?></div>
                <h2 class="status-title">পেমেন্ট ব্যর্থ!</h2>
                <p class="status-subtitle">দুঃখিত, আপনার পেমেন্ট সম্পন্ন করা যায়নি।<br>পুনরায় চেষ্টা করুন অথবা সাপোর্টে যোগাযোগ করুন।</p>
                <?php endif; ?>

                <div class="details-card">
                    <div class="details-header">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/></svg>
                        Transaction Details
                    </div>
                    <div class="detail-row"><span class="detail-label">Payment Method</span><span class="detail-value"><?= ucwords($temp_method) ?></span></div>
                    <div class="detail-row"><span class="detail-label">Transaction ID</span><span class="detail-value"><?= $temp_transaction_id ?></span></div>
                    <div class="detail-row"><span class="detail-label">Amount</span><span class="detail-value amount"><?= currency_format($temp_amount) ?></span></div>
                    <?php if (!empty($fees_amount) && $fees_amount > 0): ?>
                    <div class="detail-row"><span class="detail-label">Fee</span><span class="detail-value"><?= currency_format($fees_amount) ?></span></div>
                    <?php endif; ?>
                    <div class="detail-row"><span class="detail-label">Status</span><span class="detail-value status-title"><?= strtoupper($status) ?></span></div>
                </div>

                <?php if ($type == '2' || $type == '1'): ?>
                <div class="action-buttons">
                    <a href="<?= $redirect_url ?>" class="btn-primary-action btn-go-back">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                        Continue
                    </a>
                </div>
                <?php else: ?>
                <div class="action-buttons">
                    <a href="<?= $redirect_url ?>" class="btn-primary-action btn-go-back">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12l7-7v4h11v6H10v4z"/></svg>
                        হোমে ফিরে যান
                    </a>
                    <a href="mailto:<?= get_option('support_email', 'support@ekhonidigital.com') ?>" class="btn-secondary-action">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        সাপোর্ট
                    </a>
                </div>
                <?php endif; ?>

                <div class="countdown-bar">
                    <p class="countdown-text"><span class="countdown-num" id="redirect_countdown">5</span> সেকেন্ডে রিডাইরেক্ট হবে</p>
                    <div class="progress-track"><div class="progress-fill" id="progressFill" style="width: 100%; background: linear-gradient(90deg, var(--bg1), var(--bg2));"></div></div>
                </div>

                <div class="support-section"><p>Powered by <a href="<?= BASE_SITE ?>"><?= get_option('site_name', 'Ekhoni Digital') ?></a></p></div>
            </div>
        </div>
    </div>

    <script>
        showToast('<?= addslashes($message) ?>', '<?= $status ?>');
        var totalTime = 5, timeleft = 5;
        var redirectUrl = "<?= $redirect_url; ?>";
        var progressFill = document.getElementById('progressFill');
        var downloadTimer = setInterval(function() {
            timeleft--;
            if (timeleft <= 0) { clearInterval(downloadTimer); document.getElementById('redirect_countdown').innerHTML='0'; progressFill.style.width='0%'; window.location.replace(redirectUrl); }
            else { document.getElementById('redirect_countdown').innerHTML = timeleft; progressFill.style.width = ((timeleft/totalTime)*100)+'%'; }
        }, 1000);
        <?php if ($type == '2'): ?>
        (function(){var b=document.getElementById('confettiBox'),c=['#34d399','#6366f1','#fbbf24','#f87171','#a78bfa','#38bdf8'];for(var i=0;i<30;i++){var d=document.createElement('div');d.className='confetti';d.style.left=(Math.random()*100)+'%';d.style.background=c[Math.floor(Math.random()*c.length)];d.style.animationDelay=(Math.random()*1.5)+'s';d.style.animationDuration=(1.5+Math.random())+'s';d.style.width=(4+Math.random()*6)+'px';d.style.height=(4+Math.random()*6)+'px';b.appendChild(d);}})();
        <?php endif; ?>
    </script>
</body>
</html>
