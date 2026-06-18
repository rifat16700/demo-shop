<?php
$is_mobile = ($setting['t_type'] == 'mobile');
$gateway_type = $setting['g_type'];

$brand_colors = [
    'bkash' => ['bg' => '#e2125b', 'accent' => '#cf2772', 'dial' => '*247#', 'name' => 'bKash'],
    'nagad' => ['bg' => '#a61c20', 'accent' => '#de3a26', 'dial' => '*167#', 'name' => 'Nagad'],
    'rocket' => ['bg' => '#8A288F', 'accent' => '#a743b0', 'dial' => '*322#', 'name' => 'Rocket'],
    'upay' => ['bg' => '#ffc500', 'accent' => '#002d57', 'dial' => '*268#', 'name' => 'Upay', 'text' => '#002d57'],
    'surecash' => ['bg' => '#008444', 'accent' => '#f26522', 'dial' => '*495#', 'name' => 'SureCash'],
    'cellfin' => ['bg' => '#0288d1', 'accent' => '#03a9f4', 'dial' => 'App', 'name' => 'CellFin'],
    'tap' => ['bg' => '#0d47a1', 'accent' => '#1565c0', 'dial' => '*259#', 'name' => 'tap'],
];

$gateway_info = $brand_colors[$gateway_type] ?? [
    'bg' => '#1e293b', 
    'accent' => '#334155', 
    'dial' => 'App', 
    'name' => ucfirst($gateway_type)
];

$brand_bg = $gateway_info['bg'];
$brand_accent = $gateway_info['accent'];
$brand_dial = $gateway_info['dial'];
$brand_name = $gateway_info['name'];
$brand_text_color = $gateway_info['text'] ?? '#ffffff';

$acc_tp = decrypt(service('request')->getGet('acc_tp')) ?? 'personal';
$acc_tp_text = 'Send Money';
if ($acc_tp == 'agent') {
    $acc_tp_text = 'Cash Out';
} elseif ($acc_tp == 'payment' || $acc_tp == 'payment_number' || $acc_tp == 'merchant') {
    $acc_tp_text = 'Payment';
}

$target_number = '';
if ($acc_tp == 'personal') {
    $target_number = get_value($setting['params'], 'personal_number');
} else {
    $target_number = get_value($setting['params'], 'agent_number') ?? get_value($setting['params'], 'personal_number');
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Secure Payment - <?= get_option('site_name', 'Your Site') ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= BASE_SITE . get_option('site_icon', BASE_SITE . "assets/images/favicon.png") ?>">
    <?= link_asset('css/stylev2.css') ?>
    <?= link_asset('toast/toastr.min.css') ?>
    <?= script_asset('js/jquery.js') ?>
    <?= script_asset('toast/toastr.min.js') ?>
    <?php if ($is_mobile && $acc_tp != 'merchant') : ?>
        <style>
            body {
                background-color: #f3f4f6 !important;
                margin: 0 !important;
                padding: 12px !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                min-height: 100vh !important;
            }
            .container {
                background: transparent !important;
                box-shadow: none !important;
                padding: 0 !important;
                margin: 0 auto !important;
                border: none !important;
                width: 100% !important;
                max-width: 100% !important;
                min-width: unset !important;
                display: flex !important;
                justify-content: center !important;
                align-items: center !important;
            }
            .main, .inner {
                padding: 0 !important;
                margin: 0 !important;
                background: transparent !important;
                width: 100% !important;
                display: flex !important;
                justify-content: center !important;
                align-items: center !important;
            }
            .zp-hide-on-mobile-pay {
                display: none !important;
            }
        </style>
    <?php endif; ?>
</head>

<body>
    <div id="loader">
        <div class="loader"></div>
    </div>

    <div class="container">
        <div class="h-full relative">
            <div class="head zp-hide-on-mobile-pay">
                <div class="top-bar flex items-center justify-between">
                    <div class="brand-logo flex items-center justify-center m-5">
                        <img src="<?= BASE_SITE . $all_info['brand_logo'] ?>" alt="" id="company_logo" />
                    </div>
                    <button onclick="window.location.href='<?= base_url("api/execute/" . $all_info['tmp_ids']); ?>'">
                        <svg width="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.5 1C4.80558 1 1 4.80558 1 9.5C1 14.1944 4.80558 18 9.5 18C14.1944 18 18 14.1944 18 9.5C18 4.80558 14.1944 1 9.5 1Z" stroke="#6D7F9A" stroke-width="1.5"></path>
                            <path d="M10.7749 12.9L7.3749 9.50002L10.7749 6.10002" stroke="#94A9C7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </button>
                </div>
                <div class="brand-logo flex items-center justify-center m-5">
                    <img src="<?= BASE_SITE . $all_info['brand_logo'] ?>" alt="" id="company_logo" />
                </div>
                <div class="card flex items-center justify-center m-5">
                    <div class="brand-logo m-5">
                        <img src="<?= BASE_SITE . payment_option($setting['g_type']) ?>" alt="<?= $setting['g_type'] ?>" />
                    </div>
                    <div class="brand-info">
                        <h2><?= $all_info['brand_name'] ?></h2>
                        <p>Transaction ID : <span class="bg2-t"><?= $all_info['transaction_id'] ?></span></p>
                    </div>
                </div>

            </div>
            
            <!-- Legacy hidden fields -->
            <input type="hidden" id="transaction_id">

            <div class="main">
                <div class="inner">
                    <?php if ($is_mobile && $acc_tp != 'merchant') : ?>
                        <!-- bKash Theme Layout -->
                        <?php if ($gateway_type == 'bkash') : ?>
                            <style>
                                /* General overrides when bkash layout is active */
                                body {
                                    background: #828282 !important;
                                    margin: 0 !important;
                                    padding: 0 !important;
                                    display: flex !important;
                                    align-items: center !important;
                                    justify-content: center !important;
                                    min-height: 100vh !important;
                                }
                                .up-container {
                                    background: transparent !important;
                                    box-shadow: none !important;
                                    border: none !important;
                                    padding: 0 !important;
                                    margin: 0 auto !important;
                                    min-width: unset !important;
                                    max-width: 100% !important;
                                    width: auto !important;
                                }
                                .zp-hide-on-mobile-pay {
                                    display: none !important;
                                }
                                .bkash-theme-container {
                                    background: #ffffff;
                                    border-radius: 4px;
                                    overflow: hidden;
                                    color: #333;
                                    box-shadow: 0 4px 25px rgba(0,0,0,0.3);
                                    font-family: Arial, sans-serif;
                                    width: 370px;
                                    max-width: 100%;
                                    min-height: 480px;
                                    margin: 0 auto;
                                    text-align: center;
                                    display: flex;
                                    flex-direction: column;
                                    justify-content: space-between;
                                }
                                .bkash-header {
                                    background: #fff;
                                    height: 60px;
                                    display: flex;
                                    justify-content: center;
                                    align-items: center;
                                    border-bottom: 1px solid #e2e8f0;
                                }
                                .bkash-logo {
                                    height: 38px;
                                    width: auto;
                                    object-fit: contain;
                                }
                                .bkash-merchant-bar {
                                    background: #fff;
                                    padding: 10px 20px;
                                    display: flex;
                                    justify-content: space-between;
                                    align-items: center;
                                }
                                .bkash-merchant-left {
                                    display: flex;
                                    align-items: center;
                                    text-align: left;
                                }
                                .bkash-merchant-logo {
                                    width: 36px;
                                    height: 36px;
                                    border-radius: 50%;
                                    margin-right: 10px;
                                    object-fit: contain;
                                    border: 1px solid #f0f0f0;
                                }
                                .bkash-merchant-details {
                                    display: flex;
                                    flex-direction: column;
                                }
                                .bkash-merchant-name {
                                    font-size: 13px;
                                    font-weight: 700;
                                    color: #333;
                                }
                                .bkash-invoice-id {
                                    font-size: 10px;
                                    color: #666;
                                }
                                .bkash-amount-box {
                                    text-align: right;
                                }
                                .bkash-amount {
                                    font-size: 18px;
                                    font-weight: 700;
                                    color: #333;
                                }
                                .bkash-body {
                                    background: #e2125b;
                                    padding: 24px 20px;
                                    color: #fff;
                                    flex-grow: 1;
                                    display: flex;
                                    flex-direction: column;
                                    justify-content: center;
                                }
                                .bkash-label {
                                    display: block;
                                    font-size: 16px;
                                    margin-bottom: 15px;
                                    color: #ffffff;
                                    font-weight: normal;
                                }
                                .bkash-input {
                                    width: 100%;
                                    padding: 12px;
                                    font-size: 20px;
                                    border: none;
                                    border-radius: 4px;
                                    text-align: center;
                                    outline: none;
                                    color: #333;
                                    background: #ffffff;
                                }
                                .bkash-input::placeholder {
                                    color: #a9a9a9;
                                }
                                .bkash-terms {
                                    margin-top: 15px;
                                    font-size: 12px;
                                    color: #ffffff;
                                }
                                .bkash-terms a {
                                    color: #fff;
                                    text-decoration: underline;
                                }
                                .bkash-footer {
                                    background: #ffffff;
                                    padding: 15px 20px;
                                    display: flex;
                                    gap: 15px;
                                    justify-content: space-between;
                                    border-top: 1px solid #f0f0f0;
                                }
                                .bkash-btn {
                                    width: 48%;
                                    height: 40px;
                                    font-size: 14px;
                                    font-weight: 500;
                                    border: none;
                                    cursor: pointer;
                                    border-radius: 3px;
                                    text-transform: none;
                                    display: inline-flex;
                                    align-items: center;
                                    justify-content: center;
                                    transition: all 0.2s ease;
                                }
                                .bkash-btn-close {
                                    background: #ffffff;
                                    color: #7b7b7b;
                                    border: 1px solid #c5c5c5;
                                }
                                .bkash-btn-close:hover {
                                    background: #f5f5f5;
                                }
                                .bkash-btn-confirm {
                                    background: #e2125b;
                                    color: #fff;
                                }
                                .bkash-btn-confirm:disabled {
                                    background: #e0e0e0;
                                    color: #a0a0a0;
                                    cursor: not-allowed;
                                }
                                .bkash-sub-footer {
                                    background: #ffffff;
                                    padding: 10px 0 15px;
                                    font-size: 11px;
                                }
                                .bkash-phone-link {
                                    color: #e2125b;
                                    font-weight: 700;
                                    text-decoration: none;
                                    font-size: 14px;
                                    display: inline-flex;
                                    align-items: center;
                                    justify-content: center;
                                    margin-bottom: 5px;
                                }
                                .bkash-phone-icon {
                                    display: inline-flex;
                                    align-items: center;
                                    justify-content: center;
                                    width: 18px;
                                    height: 18px;
                                    background-color: #e2125b;
                                    color: white;
                                    border-radius: 50%;
                                    margin-right: 6px;
                                }
                                .bkash-phone-icon svg {
                                    fill: white;
                                }
                                .bkash-copyright {
                                    font-size: 10px;
                                    color: #8c8c8c;
                                    margin-top: 4px;
                                }
                            </style>
                            <div class="bkash-theme-container">
                                <div>
                                    <div class="bkash-header">
                                        <img src="/bKash-logo.png" onerror="this.src='<?= BASE_SITE . payment_option('bkash') ?>'" class="bkash-logo" alt="bKash">
                                    </div>
                                    <div class="bkash-merchant-bar">
                                        <div class="bkash-merchant-left">
                                            <img src="<?= BASE_SITE . $all_info['brand_logo'] ?>" class="bkash-merchant-logo" alt="logo">
                                            <div class="bkash-merchant-details">
                                                <span class="bkash-merchant-name"><?= $all_info['brand_name'] ?></span>
                                                <span class="bkash-invoice-id">Inv No: <?= $all_info['transaction_id'] ?></span>
                                            </div>
                                        </div>
                                        <div class="bkash-amount-box">
                                            <span class="bkash-amount"><?= currency_format($all_info['total_amount']) ?></span>
                                        </div>
                                    </div>
                                    <div class="bkash-body">
                                        <!-- Stage 1 -->
                                        <div id="bkash-stage-1">
                                            <label class="bkash-label">Your bKash Account Number</label>
                                            <input type="tel" class="bkash-input zp-phone-generic" placeholder="e.g 01XXXXXXXXX" maxlength="11" autocomplete="off" autofocus>
                                            <p class="bkash-terms">Confirm and proceed, <a href="#" style="text-decoration: underline; color: #fff;">terms & conditions</a></p>
                                        </div>
                                        <!-- Stage 2 -->
                                        <div id="bkash-stage-2" style="display:none;">
                                            <div class="bkash-steps-card" style="text-align: left;">
                                                <p class="bkash-step-desc">প্রেরক নম্বর: <strong style="color:#ffd700;" class="zp-phone-display"></strong></p>
                                                <hr style="border: 0; border-top: 1px solid rgba(255,255,255,0.2); margin: 8px 0 12px;">
                                                <ol class="bkash-ol" style="padding-left: 15px; font-size: 13px; line-height: 1.6;">
                                                    <li style="margin-bottom: 8px;">বিকাশ অ্যাপ অথবা <strong>*২৪৭#</strong> ডায়াল করুন।</li>
                                                    <li style="margin-bottom: 8px;"><strong>"<?= $acc_tp_text ?>"</strong> অপশন সিলেক্ট করুন।</li>
                                                    <li style="margin-bottom: 8px;">নিচের নাম্বারে টাকা পাঠান:
                                                        <div class="bkash-copy-box" style="display: flex; align-items: center; background: rgba(0,0,0,0.2); border-radius: 4px; padding: 4px 8px; margin-top: 4px; justify-content: space-between;">
                                                            <span><?= $target_number ?></span>
                                                            <button type="button" class="bkash-copy-btn copy" data-clipboard-text="<?= $target_number ?>" style="background: rgba(255,255,255,0.25); border: none; color: #fff; padding: 2px 8px; border-radius: 3px; font-size: 11px; cursor: pointer;">Copy</button>
                                                        </div>
                                                    </li>
                                                    <li style="margin-bottom: 8px;">টাকার পরিমাণ লিখুন: <strong><?= currency_format($all_info['total_amount']) ?></strong></li>
                                                    <li style="margin-bottom: 8px;">পেমেন্ট শেষ হলে নিচে <strong>Verify</strong> চাপুন।</li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="bkash-footer">
                                        <div class="zp-stage-1-btns w-full text-center flex gap-[15px] justify-between">
                                            <button type="button" class="bkash-btn bkash-btn-close" onclick="window.location.href='<?= base_url("api/execute/" . $all_info['tmp_ids']); ?>'">Cancel</button>
                                            <button type="button" class="bkash-btn bkash-btn-confirm zp-btn-proceed-generic" disabled>Confirm</button>
                                        </div>
                                        <div class="zp-stage-2-btns w-full text-center flex gap-[15px] justify-between" style="display:none;">
                                            <button type="button" class="bkash-btn bkash-btn-close" onclick="showStage1Generic()">Back</button>
                                            <button type="button" class="bkash-btn bkash-btn-confirm payment_submit_done" id="payment_submit_done" data-tmp_id="<?= session('tmp_ids') ?>" data-href="<?= base_url('api/save_payment/bkash?acc_tp=' . (service('request')->getGet('acc_tp') ?? '')) ?>">Verify</button>
                                        </div>
                                    </div>
                                    <div class="bkash-sub-footer">
                                        <a href="tel:16247" class="bkash-phone-link">
                                            <span class="bkash-phone-icon">
                                                <svg width="10" height="10" viewBox="0 0 24 24"><path d="M20 15.5c-1.2 0-2.4-.2-3.6-.6-.3-.1-.7 0-1 .2l-2.2 2.2c-2.8-1.4-5.1-3.8-6.6-6.6l2.2-2.2c.3-.3.4-.7.2-1-.3-1.1-.5-2.3-.5-3.5 0-.6-.4-1-1-1H4c-.6 0-1 .4-1 1 0 9.4 7.6 17 17 17 .6 0 1-.4 1-1v-3.5c0-.6-.4-1-1-1z"/></svg>
                                            </span>
                                            16247
                                        </a>
                                        <div class="bkash-copyright">© 2026 bKash, All Rights Reserved</div>
                                    </div>
                                </div>
                            </div>

                        <!-- Nagad Theme Layout -->
                        <?php elseif ($gateway_type == 'nagad') : ?>
                            <style>
                                /* General overrides when nagad layout is active */
                                body {
                                    background: #828282 !important;
                                    margin: 0 !important;
                                    padding: 0 !important;
                                    display: flex !important;
                                    align-items: center !important;
                                    justify-content: center !important;
                                    min-height: 100vh !important;
                                }
                                .up-container {
                                    background: transparent !important;
                                    box-shadow: none !important;
                                    border: none !important;
                                    padding: 0 !important;
                                    margin: 0 auto !important;
                                    min-width: unset !important;
                                    max-width: 100% !important;
                                    width: auto !important;
                                }
                                .zp-hide-on-mobile-pay {
                                    display: none !important;
                                }
                                .nagad-theme-container {
                                    background: linear-gradient(to bottom, #7e1215 0%, #b21c22 45%, #b21c22 55%, #7e1215 100%);
                                    border-radius: 4px;
                                    overflow: hidden;
                                    color: #fff;
                                    box-shadow: 0 4px 25px rgba(0,0,0,0.3);
                                    font-family: Arial, sans-serif;
                                    width: 370px;
                                    max-width: 100%;
                                    min-height: 480px;
                                    margin: 0 auto;
                                    text-align: center;
                                    display: flex;
                                    flex-direction: column;
                                    justify-content: space-between;
                                    padding: 24px 20px;
                                    position: relative;
                                }
                                .nagad-lang-switcher {
                                    position: absolute;
                                    top: 15px;
                                    right: 15px;
                                    display: flex;
                                    border: 1px solid rgba(255, 255, 255, 0.8);
                                    border-radius: 4px;
                                    overflow: hidden;
                                }
                                .nagad-lang-btn {
                                    background: transparent;
                                    color: #ffffff;
                                    border: none;
                                    padding: 2px 8px;
                                    font-size: 11px;
                                    cursor: pointer;
                                    font-weight: 500;
                                    text-decoration: none;
                                    outline: none;
                                }
                                .nagad-lang-btn.active {
                                    background: #e25c27;
                                    color: #ffffff;
                                }
                                .nagad-merchant-info {
                                    margin-top: 15px;
                                    margin-bottom: 15px;
                                }
                                .nagad-top-icon {
                                    display: flex;
                                    justify-content: center;
                                    margin-bottom: 6px;
                                }
                                .nagad-merchant-name {
                                    font-size: 18px;
                                    font-weight: bold;
                                    color: #ffffff;
                                }
                                .nagad-payment-infos {
                                    background: rgba(0, 0, 0, 0.15);
                                    border-radius: 6px;
                                    padding: 10px 15px;
                                    margin-bottom: 20px;
                                    text-align: left;
                                }
                                .nagad-payment-info {
                                    display: flex;
                                    justify-content: space-between;
                                    margin: 4px 0;
                                    font-size: 13px;
                                    color: rgba(255, 255, 255, 0.9);
                                }
                                .nagad-payment-info strong {
                                    font-weight: 500;
                                }
                                .nagad-label {
                                    font-size: 15px;
                                    font-weight: bold;
                                    display: block;
                                    margin-bottom: 12px;
                                    color: #ffffff;
                                }
                                .nagad-digits-container {
                                    display: flex;
                                    justify-content: center;
                                    align-items: center;
                                    gap: 4px;
                                    margin: 20px 0;
                                }
                                .nagad-digit-input {
                                    width: 24px;
                                    height: 32px;
                                    background: #ffffff;
                                    border: none;
                                    border-radius: 4px;
                                    text-align: center;
                                    font-size: 18px;
                                    font-weight: bold;
                                    color: #333;
                                    outline: none;
                                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                                }
                                .nagad-digit-input:focus {
                                    box-shadow: 0 0 0 2px #f59e0b;
                                }
                                .nagad-digit-divider {
                                    color: #ffffff;
                                    font-weight: bold;
                                    font-size: 18px;
                                    margin: 0 2px;
                                }
                                .nagad-terms {
                                    font-size: 12px;
                                    color: rgba(255, 255, 255, 0.85);
                                    margin: 15px 0;
                                    line-height: 1.4;
                                    text-align: center;
                                }
                                .nagad-terms strong, .nagad-terms a {
                                    color: #ffffff;
                                    font-weight: bold;
                                    text-decoration: underline;
                                }
                                .nagad-btn-row {
                                    display: flex;
                                    justify-content: center;
                                    gap: 15px;
                                    margin-top: 20px;
                                }
                                .nagad-btn {
                                    flex: 1;
                                    background: #ffffff;
                                    color: #b21c22;
                                    border: none;
                                    border-radius: 8px;
                                    font-size: 16px;
                                    font-weight: bold;
                                    padding: 10px 20px;
                                    cursor: pointer;
                                    transition: background 0.2s ease, transform 0.1s ease;
                                    box-shadow: 0 4px 6px rgba(0,0,0,0.15);
                                    outline: none;
                                }
                                .nagad-btn:hover {
                                    background: #f8f9fa;
                                    transform: translateY(-1px);
                                }
                                .nagad-btn:active {
                                    transform: translateY(1px);
                                }
                                .nagad-btn:disabled {
                                    background: #cbd5e1 !important;
                                    color: #94a3b8 !important;
                                    cursor: not-allowed !important;
                                    box-shadow: none !important;
                                    transform: none !important;
                                }
                                .nagad-btn-secondary {
                                    background: transparent !important;
                                    color: #ffffff !important;
                                    border: 2px solid #ffffff !important;
                                    box-shadow: none !important;
                                }
                                .nagad-btn-secondary:hover {
                                    background: rgba(255,255,255,0.15) !important;
                                }
                                .nagad-steps-card {
                                    background: rgba(0, 0, 0, 0.25);
                                    border-radius: 8px;
                                    padding: 15px;
                                    text-align: left;
                                    font-size: 13px;
                                    line-height: 1.6;
                                    margin-bottom: 10px;
                                }
                                .nagad-ol {
                                    padding-left: 18px;
                                    margin: 0;
                                }
                                .nagad-ol li {
                                    margin-bottom: 6px;
                                    color: rgba(255,255,255,0.95);
                                }
                                .nagad-copy-box {
                                    display: flex;
                                    align-items: center;
                                    background: rgba(0,0,0,0.3);
                                    border-radius: 4px;
                                    padding: 4px 8px;
                                    margin-top: 4px;
                                    justify-content: space-between;
                                }
                                .nagad-copy-btn {
                                    background: rgba(255,255,255,0.2);
                                    border: 1px solid #fff;
                                    color: #fff;
                                    padding: 2px 8px;
                                    border-radius: 3px;
                                    font-size: 11px;
                                    cursor: pointer;
                                    transition: background 0.2s;
                                }
                                .nagad-copy-btn:hover {
                                    background: rgba(255,255,255,0.35);
                                }
                                .nagad-footer-logo-container {
                                    display: flex;
                                    justify-content: center;
                                    margin-top: 20px;
                                    margin-bottom: 5px;
                                }
                                .nagad-bottom-logo {
                                    height: 38px;
                                    object-fit: contain;
                                    filter: brightness(0) invert(1);
                                }
                            </style>

                            <div class="nagad-theme-container">
                                <div class="nagad-lang-switcher">
                                    <button id="nagad-btn-bn" type="button" class="nagad-lang-btn">বাং</button>
                                    <button id="nagad-btn-en" type="button" class="nagad-lang-btn active">Eng</button>
                                </div>

                                <div>
                                    <div class="nagad-merchant-info">
                                        <div class="nagad-top-icon">
                                            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="color: #ffffff; opacity: 0.9;">
                                                <circle cx="9" cy="21" r="1"></circle>
                                                <circle cx="20" cy="21" r="1"></circle>
                                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                            </svg>
                                        </div>
                                        <div class="nagad-merchant-name"><?= $all_info['brand_name'] ?></div>
                                    </div>

                                    <div class="nagad-payment-infos">
                                        <p class="nagad-payment-info">
                                            <strong class="nagad-translate" data-key="invoice">Invoice No:</strong>
                                            <span><?= $all_info['transaction_id'] ?></span>
                                        </p>
                                        <p class="nagad-payment-info">
                                            <strong class="nagad-translate" data-key="total">Total Amount:</strong>
                                            <span>BDT <?= number_format($all_info['total_amount'], 2) ?></span>
                                        </p>
                                        <p class="nagad-payment-info">
                                            <strong class="nagad-translate" data-key="charge">Charge:</strong>
                                            <span>BDT 0.00</span>
                                        </p>
                                    </div>

                                    <!-- Stage 1 -->
                                    <div id="nagad-stage-1">
                                        <label class="nagad-label nagad-translate" data-key="acc_label">Your Nagad Account Number</label>
                                        
                                        <div class="nagad-digits-container">
                                            <input type="tel" class="nagad-digit-input" maxlength="1" pattern="[0-9]*" inputmode="numeric" autofocus>
                                            <input type="tel" class="nagad-digit-input" maxlength="1" pattern="[0-9]*" inputmode="numeric">
                                            <input type="tel" class="nagad-digit-input" maxlength="1" pattern="[0-9]*" inputmode="numeric">
                                            <span class="nagad-digit-divider">-</span>
                                            <input type="tel" class="nagad-digit-input" maxlength="1" pattern="[0-9]*" inputmode="numeric">
                                            <input type="tel" class="nagad-digit-input" maxlength="1" pattern="[0-9]*" inputmode="numeric">
                                            <input type="tel" class="nagad-digit-input" maxlength="1" pattern="[0-9]*" inputmode="numeric">
                                            <input type="tel" class="nagad-digit-input" maxlength="1" pattern="[0-9]*" inputmode="numeric">
                                            <span class="nagad-digit-divider">-</span>
                                            <input type="tel" class="nagad-digit-input" maxlength="1" pattern="[0-9]*" inputmode="numeric">
                                            <input type="tel" class="nagad-digit-input" maxlength="1" pattern="[0-9]*" inputmode="numeric">
                                            <input type="tel" class="nagad-digit-input" maxlength="1" pattern="[0-9]*" inputmode="numeric">
                                            <input type="tel" class="nagad-digit-input" maxlength="1" pattern="[0-9]*" inputmode="numeric">
                                        </div>

                                        <input type="hidden" id="nagad-merged-phone" class="zp-phone-generic" name="phone">

                                        <p class="nagad-terms nagad-translate" data-key="terms">By clicking/tapping "Proceed" you are agreeing to our <strong>Terms and Conditions</strong></p>
                                        
                                        <div class="nagad-btn-row">
                                            <button type="button" class="nagad-btn zp-btn-proceed-generic nagad-translate" data-key="proceed" disabled>Proceed</button>
                                            <button type="button" class="nagad-btn nagad-translate" data-key="close" onclick="window.location.href='<?= base_url("api/execute/" . $all_info['tmp_ids']); ?>'">Close</button>
                                        </div>
                                    </div>

                                    <!-- Stage 2 -->
                                    <div id="nagad-stage-2" style="display:none;">
                                        <div class="nagad-steps-card">
                                            <p style="font-size: 15px; margin-bottom: 12px; font-weight: bold; text-align: center;">প্রেরক নম্বর: <span class="zp-phone-display" style="color: #f59e0b; text-decoration: underline;"></span></p>
                                            <hr style="border: 0; border-top: 1px dashed rgba(255, 255, 255, 0.3); margin: 10px 0;">
                                            <ol class="nagad-ol">
                                                <li>আপনার নগদ অ্যাপ অথবা <strong>*১৬৭#</strong> ডায়াল করুন।</li>
                                                <li><strong>"<?= $acc_tp_text ?>"</strong> অপশন সিলেক্ট করুন।</li>
                                                <li>নিচের নাম্বারে টাকা পাঠান:
                                                    <div class="nagad-copy-box">
                                                        <span style="font-family: monospace; font-size: 15px; font-weight: bold; color: #ffffff;"><?= $target_number ?></span>
                                                        <button type="button" class="nagad-copy-btn copy" data-clipboard-text="<?= $target_number ?>">Copy</button>
                                                    </div>
                                                </li>
                                                <li>টাকার পরিমাণ লিখুন: <strong style="color: #f59e0b;">BDT <?= number_format($all_info['total_amount'], 2) ?></strong></li>
                                                <li>পেমেন্ট শেষ হলে নিচে <strong>Verify</strong> চাপুন।</li>
                                            </ol>
                                        </div>
                                        <div class="nagad-btn-row">
                                            <button type="button" class="nagad-btn payment_submit_done nagad-translate" id="payment_submit_done" data-tmp_id="<?= session('tmp_ids') ?>" data-href="<?= base_url('api/save_payment/nagad?acc_tp=' . (service('request')->getGet('acc_tp') ?? '')) ?>" data-key="verify">Verify</button>
                                            <button type="button" class="nagad-btn nagad-btn-secondary nagad-translate" data-key="back" onclick="showStage1Generic()">Back</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="nagad-footer-logo-container">
                                    <img src="<?= BASE_SITE . payment_option('nagad') ?>" onerror="this.src='/img/logo.png'" class="nagad-bottom-logo" alt="Nagad">
                                </div>
                            </div>

                            <script>
                                $(document).ready(function() {
                                    var currentLang = 'en';
                                    var translations = {
                                        en: {
                                            acc_label: "Your Nagad Account Number",
                                            terms: 'By clicking/tapping "Proceed" you are agreeing to our <strong>Terms and Conditions</strong>',
                                            proceed: "Proceed",
                                            close: "Close",
                                            verify: "Verify",
                                            back: "Back",
                                            invoice: "Invoice No:",
                                            total: "Total Amount:",
                                            charge: "Charge:"
                                        },
                                        bn: {
                                            acc_label: "আপনার নগদ অ্যাকাউন্ট নম্বর",
                                            terms: 'পরবর্তী ধাপে যাওয়ার মাধ্যমে আপনি আমাদের <strong>শর্তাবলীর</strong> সাথে সম্মতি প্রকাশ করছেন',
                                            proceed: "পরবর্তী",
                                            close: "বন্ধ করুন",
                                            verify: "যাচাই করুন",
                                            back: "ফিরে যান",
                                            invoice: "ইনভয়েস নম্বর:",
                                            total: "মোট পরিমাণ:",
                                            charge: "সার্ভিস চার্জ:"
                                        }
                                    };

                                    window.changeNagadLanguage = function(lang) {
                                        currentLang = lang;
                                        $('.nagad-lang-btn').removeClass('active');
                                        $('#nagad-btn-' + lang).addClass('active');

                                        $('.nagad-translate').each(function() {
                                            var key = $(this).data('key');
                                            if (translations[lang][key]) {
                                                $(this).html(translations[lang][key]);
                                            }
                                        });
                                    };

                                    $('#nagad-btn-en').on('click', function() { changeNagadLanguage('en'); });
                                    $('#nagad-btn-bn').on('click', function() { changeNagadLanguage('bn'); });

                                    var $digits = $('.nagad-digit-input');
                                    var $hiddenPhone = $('#nagad-merged-phone');

                                    function updateHiddenPhone() {
                                        var phone = '';
                                        $digits.each(function() {
                                            phone += $(this).val();
                                        });
                                        $hiddenPhone.val(phone).trigger('input');
                                    }

                                    $digits.on('input', function(e) {
                                        var $this = $(this);
                                        var val = $this.val().replace(/[^0-9]/g, '');
                                        $this.val(val);

                                        if (val.length > 0) {
                                            var $next = $this.nextAll('.nagad-digit-input').first();
                                            if ($next.length) {
                                                $next.focus();
                                            }
                                        }
                                        updateHiddenPhone();
                                    });

                                    $digits.on('keydown', function(e) {
                                        var $this = $(this);
                                        if (e.key === 'Backspace' && $this.val().length === 0) {
                                            var $prev = $this.prevAll('.nagad-digit-input').first();
                                            if ($prev.length) {
                                                $prev.focus().val('');
                                                updateHiddenPhone();
                                            }
                                        }
                                    });

                                    $digits.on('paste', function(e) {
                                        e.preventDefault();
                                        var pasteData = (e.originalEvent || e).clipboardData.getData('text');
                                        var digitsOnly = pasteData.replace(/[^0-9]/g, '');
                                        if (digitsOnly.length > 11) {
                                            digitsOnly = digitsOnly.substring(0, 11);
                                        }
                                        
                                        $digits.each(function(index) {
                                            if (index < digitsOnly.length) {
                                                $(this).val(digitsOnly[index]);
                                            } else {
                                                $(this).val('');
                                            }
                                        });
                                        
                                        updateHiddenPhone();
                                        
                                        var focusIndex = Math.min(digitsOnly.length, $digits.length - 1);
                                        if (focusIndex >= 0 && focusIndex < $digits.length) {
                                            $digits.eq(focusIndex).focus();
                                        }
                                    });
                                });
                            </script>

                        <!-- Upay Theme Layout -->
                        <?php elseif ($gateway_type == 'upay') : ?>
                            <style>
                                /* General overrides when upay layout is active */
                                body {
                                    background: radial-gradient(circle, #fffbee 0%, #fff7ce 100%) !important;
                                    margin: 0 !important;
                                    padding: 0 !important;
                                    display: flex !important;
                                    align-items: center !important;
                                    justify-content: center !important;
                                    min-height: 100vh !important;
                                }
                                .up-container {
                                    background: transparent !important;
                                    box-shadow: none !important;
                                    border: none !important;
                                    padding: 0 !important;
                                    margin: 0 auto !important;
                                    min-width: unset !important;
                                    max-width: 100% !important;
                                    width: auto !important;
                                }
                                .zp-hide-on-mobile-pay {
                                    display: none !important;
                                }
                                .upay-theme-container {
                                    background: #ffc500;
                                    border-radius: 16px;
                                    overflow: hidden;
                                    color: #002d57;
                                    box-shadow: 0 4px 25px rgba(0,0,0,0.15);
                                    font-family: Arial, sans-serif;
                                    width: 370px;
                                    max-width: 100%;
                                    min-height: 480px;
                                    margin: 0 auto;
                                    text-align: center;
                                    display: flex;
                                    flex-direction: column;
                                    justify-content: space-between;
                                    position: relative;
                                }
                                .upay-header {
                                    padding: 20px 20px 10px;
                                    position: relative;
                                    display: flex;
                                    flex-direction: column;
                                    align-items: center;
                                }
                                .upay-header::before {
                                    content: '';
                                    position: absolute;
                                    top: 40px;
                                    left: -10px;
                                    width: 120%;
                                    height: 80px;
                                    background: rgba(255, 255, 255, 0.15);
                                    border-radius: 50%;
                                    transform: rotate(-10deg);
                                    z-index: 0;
                                    pointer-events: none;
                                }
                                .upay-logo-badge {
                                    width: 84px;
                                    height: 84px;
                                    background: #ffffff;
                                    border-radius: 50%;
                                    display: inline-flex;
                                    align-items: center;
                                    justify-content: center;
                                    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
                                    border: 2px solid #ffffff;
                                    z-index: 1;
                                    margin-bottom: 12px;
                                }
                                .upay-logo-img {
                                    width: 68px;
                                    height: 68px;
                                    object-fit: contain;
                                }
                                .upay-merchant-card {
                                    background: #eef2f3;
                                    border-radius: 12px;
                                    padding: 12px 15px;
                                    width: 90%;
                                    margin: 0 auto 5px;
                                    text-align: center;
                                    font-size: 13px;
                                    box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
                                    z-index: 1;
                                }
                                .upay-merchant-name {
                                    font-size: 15px;
                                    font-weight: 700;
                                    color: #002d57;
                                    margin-bottom: 4px;
                                }
                                .upay-invoice-no {
                                    color: #002d57;
                                    font-size: 12px;
                                    margin-bottom: 4px;
                                }
                                .upay-amount {
                                    font-size: 13px;
                                    color: #002d57;
                                }
                                .upay-amount strong {
                                    font-size: 15px;
                                    font-weight: 700;
                                }
                                .upay-body {
                                    padding: 10px 20px 20px;
                                    flex-grow: 1;
                                    display: flex;
                                    flex-direction: column;
                                    justify-content: center;
                                    align-items: center;
                                }
                                .upay-label {
                                    font-size: 14px;
                                    font-weight: 700;
                                    color: #002d57;
                                    margin-bottom: 12px;
                                }
                                .upay-input {
                                    width: 90%;
                                    padding: 12px 20px;
                                    font-size: 18px;
                                    border: none;
                                    border-radius: 25px;
                                    background: #eef2f3;
                                    color: #002d57;
                                    text-align: center;
                                    outline: none;
                                    margin-bottom: 15px;
                                    font-weight: 600;
                                    box-shadow: inset 0 1px 3px rgba(0,0,0,0.08);
                                }
                                .upay-input::placeholder {
                                    color: #8fa0a8;
                                    font-weight: normal;
                                }
                                .upay-terms {
                                    font-size: 11px;
                                    color: #002d57;
                                    line-height: 1.4;
                                    width: 90%;
                                    margin: 0 auto;
                                }
                                .upay-terms strong {
                                    font-weight: 700;
                                }
                                .upay-terms a {
                                    color: #002d57;
                                    text-decoration: underline;
                                    font-weight: 700;
                                }
                                .upay-footer {
                                    background: #eef2f3;
                                    padding: 15px 20px 10px;
                                    border-top: 1px solid rgba(0,0,0,0.05);
                                }
                                .upay-btn-row {
                                    display: flex;
                                    gap: 15px;
                                    justify-content: center;
                                    margin-bottom: 5px;
                                }
                                .upay-btn {
                                    width: 45%;
                                    height: 38px;
                                    font-size: 14px;
                                    font-weight: 700;
                                    border: none;
                                    cursor: pointer;
                                    border-radius: 20px;
                                    transition: all 0.2s ease;
                                    outline: none;
                                }
                                .upay-btn-close {
                                    background: #ffffff;
                                    color: #002d57;
                                    border: 1.5px solid #002d57;
                                }
                                .upay-btn-close:hover {
                                    background: #f8f9fa;
                                }
                                .upay-btn-confirm {
                                    background: #002d57;
                                    color: #ffffff;
                                }
                                .upay-btn-confirm:disabled {
                                    background: #aab5be !important;
                                    color: #ffffff !important;
                                    cursor: not-allowed !important;
                                }
                                .upay-btn-confirm:not(:disabled):hover {
                                    background: #001f3d;
                                }
                                .upay-helpline-strip {
                                    background: #ffffff;
                                    padding: 8px 0;
                                    font-size: 13px;
                                    font-weight: 700;
                                    color: #002d57;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    gap: 6px;
                                    border-top: 1px solid rgba(0,0,0,0.05);
                                }
                                .upay-helpline-strip a {
                                    color: #002d57;
                                    text-decoration: none;
                                    display: flex;
                                    align-items: center;
                                    gap: 6px;
                                }
                                .upay-helpline-icon {
                                    width: 14px;
                                    height: 14px;
                                    fill: #002d57;
                                }
                                .upay-steps-card {
                                    background: rgba(255,255,255,0.8);
                                    border-radius: 12px;
                                    padding: 15px;
                                    text-align: left;
                                    font-size: 13px;
                                    line-height: 1.6;
                                    width: 90%;
                                    color: #002d57;
                                    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
                                }
                                .upay-ol {
                                    padding-left: 18px;
                                    margin: 0;
                                }
                                .upay-ol li {
                                    margin-bottom: 6px;
                                }
                                .upay-copy-box {
                                    display: flex;
                                    align-items: center;
                                    background: #eef2f3;
                                    border-radius: 6px;
                                    padding: 4px 8px;
                                    margin-top: 4px;
                                    justify-content: space-between;
                                    border: 1px solid rgba(0,45,87,0.1);
                                }
                                .upay-copy-btn {
                                    background: #002d57;
                                    color: #fff;
                                    border: none;
                                    padding: 2px 8px;
                                    border-radius: 3px;
                                    font-size: 11px;
                                    cursor: pointer;
                                    transition: background 0.2s;
                                }
                                .upay-copy-btn:hover {
                                    background: #001f3d;
                                }
                            </style>
                            <div class="upay-theme-container">
                                <div class="upay-header">
                                    <div class="upay-logo-badge">
                                        <img src="<?= BASE_SITE . payment_option('upay') ?>" onerror="this.src='/assets/images/upay.png'" class="upay-logo-img" alt="Upay">
                                    </div>
                                    <div class="upay-merchant-card">
                                        <div class="upay-merchant-name"><?= $all_info['brand_name'] ?></div>
                                        <div class="upay-invoice-no">Invoice Number: <?= $all_info['transaction_id'] ?></div>
                                        <div class="upay-amount">Amount: <strong>BDT <?= (float)$all_info['total_amount'] == (int)$all_info['total_amount'] ? number_format($all_info['total_amount']) : number_format($all_info['total_amount'], 2) ?></strong></div>
                                    </div>
                                </div>

                                <div class="upay-body">
                                    <!-- Stage 1 -->
                                    <div id="upay-stage-1" style="width: 100%;">
                                        <label class="upay-label">Enter Your upay Account Number</label>
                                        <input type="tel" class="upay-input zp-phone-generic" placeholder="e.g 01XXXXXXXXX" maxlength="11" autocomplete="off" autofocus>
                                        <p class="upay-terms">By clicking on <strong>Confirm</strong>, you are agreeing to the <a href="#">terms & conditions</a></p>
                                    </div>

                                    <!-- Stage 2 -->
                                    <div id="upay-stage-2" style="display:none; width: 100%;">
                                        <div class="upay-steps-card">
                                            <p style="text-align: center; font-weight: bold; margin-bottom: 8px;">প্রেরক নম্বর: <strong style="text-decoration:underline;" class="zp-phone-display"></strong></p>
                                            <hr style="border:0; border-top:1px solid rgba(0,45,87,0.2); margin:8px 0 12px;">
                                            <ol class="upay-ol">
                                                <li>উপায় অ্যাপ অথবা <strong>*২৬৮#</strong> ডায়াল করুন।</li>
                                                <li><strong>"<?= $acc_tp_text ?>"</strong> অপশন সিলেক্ট করুন।</li>
                                                <li>নিচের নাম্বারে টাকা পাঠান:
                                                    <div class="upay-copy-box">
                                                        <span style="font-family: monospace; font-weight: bold;"><?= $target_number ?></span>
                                                        <button type="button" class="upay-copy-btn copy" data-clipboard-text="<?= $target_number ?>">Copy</button>
                                                    </div>
                                                </li>
                                                <li>টাকার পরিমাণ লিখুন: <strong>BDT <?= (float)$all_info['total_amount'] == (int)$all_info['total_amount'] ? number_format($all_info['total_amount']) : number_format($all_info['total_amount'], 2) ?></strong></li>
                                                <li>পেমেন্ট শেষ হলে নিচে <strong>Verify</strong> চাপুন।</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div class="upay-footer">
                                        <div class="zp-stage-1-btns upay-btn-row">
                                            <button type="button" class="upay-btn upay-btn-close" onclick="window.location.href='<?= base_url("api/execute/" . $all_info['tmp_ids']); ?>'">Close</button>
                                            <button type="button" class="upay-btn upay-btn-confirm zp-btn-proceed-generic" disabled>Confirm</button>
                                        </div>
                                        <div class="zp-stage-2-btns upay-btn-row" style="display:none;">
                                            <button type="button" class="upay-btn upay-btn-close" onclick="showStage1Generic()">Back</button>
                                            <button type="button" class="upay-btn upay-btn-confirm payment_submit_done" id="payment_submit_done" data-tmp_id="<?= session('tmp_ids') ?>" data-href="<?= base_url('api/save_payment/upay?acc_tp=' . (service('request')->getGet('acc_tp') ?? '')) ?>">Verify</button>
                                        </div>
                                    </div>
                                    <div class="upay-helpline-strip">
                                        <a href="tel:16268">
                                            <svg class="upay-helpline-icon" viewBox="0 0 24 24"><path d="M20 15.5c-1.2 0-2.4-.2-3.6-.6-.3-.1-.7 0-1 .2l-2.2 2.2c-2.8-1.4-5.1-3.8-6.6-6.6l2.2-2.2c.3-.3.4-.7.2-1-.3-1.1-.5-2.3-.5-3.5 0-.6-.4-1-1-1H4c-.6 0-1 .4-1 1 0 9.4 7.6 17 17 17 .6 0 1-.4 1-1v-3.5c0-.6-.4-1-1-1z"/></svg>
                                            16268
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div style="text-align:center; margin-top:8px;">
                                <span style="font-size:10px; color:#94a9c7;">📞 16268</span>
                            </div>

                <!-- Rocket Theme Layout -->
                <?php elseif ($gateway_type == 'rocket') : ?>
                    <style>
                        /* General overrides when rocket layout is active */
                        body {
                            background: #828282 !important;
                            margin: 0 !important;
                            padding: 0 !important;
                            display: flex !important;
                            align-items: center !important;
                            justify-content: center !important;
                            min-height: 100vh !important;
                        }
                        .up-container {
                            background: transparent !important;
                            box-shadow: none !important;
                            border: none !important;
                            padding: 0 !important;
                            margin: 0 auto !important;
                            min-width: unset !important;
                            max-width: 100% !important;
                            width: auto !important;
                        }
                        .zp-hide-on-mobile-pay {
                            display: none !important;
                        }
                        .rocket-theme-container {
                            background: #ffffff;
                            border-radius: 4px;
                            overflow: hidden;
                            color: #333;
                            box-shadow: 0 4px 25px rgba(0,0,0,0.3);
                            font-family: Arial, sans-serif;
                            width: 370px;
                            max-width: 100%;
                            min-height: 480px;
                            margin: 0 auto;
                            text-align: center;
                            display: flex;
                            flex-direction: column;
                            justify-content: space-between;
                        }
                        .rocket-header {
                            background: #fff;
                            height: 60px;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            border-bottom: 1px solid #e2e8f0;
                        }
                        .rocket-logo {
                            height: 38px;
                            width: auto;
                            object-fit: contain;
                        }
                        .rocket-merchant-bar {
                            background: #fff;
                            padding: 10px 20px;
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                        }
                        .rocket-merchant-left {
                            display: flex;
                            align-items: center;
                            text-align: left;
                        }
                        .rocket-merchant-logo {
                            width: 36px;
                            height: 36px;
                            border-radius: 50%;
                            margin-right: 10px;
                            object-fit: contain;
                            border: 1px solid #f0f0f0;
                        }
                        .rocket-merchant-details {
                            display: flex;
                            flex-direction: column;
                        }
                        .rocket-merchant-name {
                            font-size: 13px;
                            font-weight: 700;
                            color: #333;
                        }
                        .rocket-invoice-id {
                            font-size: 10px;
                            color: #666;
                        }
                        .rocket-amount-box {
                            text-align: right;
                        }
                        .rocket-amount {
                            font-size: 18px;
                            font-weight: 700;
                            color: #333;
                        }
                        .rocket-body {
                            background: #8A288F;
                            padding: 24px 20px;
                            color: #fff;
                            flex-grow: 1;
                            display: flex;
                            flex-direction: column;
                            justify-content: center;
                        }
                        .rocket-label {
                            display: block;
                            font-size: 16px;
                            margin-bottom: 15px;
                            color: #ffffff;
                            font-weight: normal;
                        }
                        .rocket-input {
                            width: 100%;
                            padding: 12px;
                            font-size: 20px;
                            border: none;
                            border-radius: 4px;
                            text-align: center;
                            outline: none;
                            color: #333;
                            background: #ffffff;
                        }
                        .rocket-input::placeholder {
                            color: #a9a9a9;
                        }
                        .rocket-terms {
                            margin-top: 15px;
                            font-size: 12px;
                            color: #ffffff;
                        }
                        .rocket-terms a {
                            color: #fff;
                            text-decoration: underline;
                        }
                        .rocket-footer {
                            background: #ffffff;
                            padding: 15px 20px;
                            display: flex;
                            gap: 15px;
                            justify-content: space-between;
                            border-top: 1px solid #f0f0f0;
                        }
                        .rocket-btn {
                            width: 48%;
                            height: 40px;
                            font-size: 14px;
                            font-weight: 500;
                            border: none;
                            cursor: pointer;
                            border-radius: 3px;
                            text-transform: none;
                            display: inline-flex;
                            align-items: center;
                            justify-content: center;
                            transition: all 0.2s ease;
                        }
                        .rocket-btn-close {
                            background: #ffffff;
                            color: #7b7b7b;
                            border: 1px solid #c5c5c5;
                        }
                        .rocket-btn-close:hover {
                            background: #f5f5f5;
                        }
                        .rocket-btn-confirm {
                            background: #8A288F;
                            color: #fff;
                        }
                        .rocket-btn-confirm:disabled {
                            background: #e0e0e0;
                            color: #a0a0a0;
                            cursor: not-allowed;
                        }
                        .rocket-sub-footer {
                            background: #ffffff;
                            padding: 10px 0 15px;
                            font-size: 11px;
                        }
                        .rocket-phone-link {
                            color: #8A288F;
                            font-weight: 700;
                            text-decoration: none;
                            font-size: 14px;
                            display: inline-flex;
                            align-items: center;
                            justify-content: center;
                            margin-bottom: 5px;
                        }
                        .rocket-phone-icon {
                            display: inline-flex;
                            align-items: center;
                            justify-content: center;
                            width: 18px;
                            height: 18px;
                            background-color: #8A288F;
                            color: white;
                            border-radius: 50%;
                            margin-right: 6px;
                        }
                        .rocket-phone-icon svg {
                            fill: white;
                        }
                        .rocket-copyright {
                            font-size: 10px;
                            color: #8c8c8c;
                            margin-top: 4px;
                        }
                        .rocket-steps-card {
                            text-align: left;
                            font-size: 13px;
                            line-height: 1.6;
                        }
                        .rocket-ol {
                            padding-left: 15px;
                        }
                        .rocket-ol li {
                            margin-bottom: 8px;
                        }
                        .rocket-copy-box {
                            display: flex;
                            align-items: center;
                            background: rgba(0,0,0,0.2);
                            border-radius: 4px;
                            padding: 4px 8px;
                            margin-top: 4px;
                            justify-content: space-between;
                        }
                        .rocket-copy-btn {
                            background: rgba(255,255,255,0.25);
                            border: none;
                            color: #fff;
                            padding: 2px 8px;
                            border-radius: 3px;
                            font-size: 11px;
                            cursor: pointer;
                        }
                    </style>
                    <div class="rocket-theme-container">
                        <div>
                            <div class="rocket-header">
                                <img src="/rocket-logo.png" onerror="this.src='<?= BASE_SITE . payment_option('rocket') ?>'" class="rocket-logo" alt="Rocket">
                            </div>
                            <div class="rocket-merchant-bar">
                                <div class="rocket-merchant-left">
                                    <img src="<?= BASE_SITE . $all_info['brand_logo'] ?>" class="rocket-merchant-logo" alt="logo">
                                    <div class="rocket-merchant-details">
                                        <span class="rocket-merchant-name"><?= $all_info['brand_name'] ?></span>
                                        <span class="rocket-invoice-id">Inv No: <?= $all_info['transaction_id'] ?></span>
                                    </div>
                                </div>
                                <div class="rocket-amount-box">
                                    <span class="rocket-amount"><?= currency_format($all_info['total_amount']) ?></span>
                                </div>
                            </div>
                            <div class="rocket-body">
                                <!-- Stage 1 -->
                                <div id="rocket-stage-1">
                                    <label class="rocket-label">Your Rocket Account Number</label>
                                    <input type="tel" class="rocket-input zp-phone-generic" placeholder="e.g 01XXXXXXXXX" maxlength="11" autocomplete="off" autofocus>
                                    <p class="rocket-terms">Confirm and proceed, <a href="#" style="text-decoration: underline; color: #fff;">terms & conditions</a></p>
                                </div>
                                <!-- Stage 2 -->
                                <div id="rocket-stage-2" style="display:none;">
                                    <div class="rocket-steps-card">
                                        <p class="rocket-step-desc">প্রেরক নম্বর: <strong style="color:#ffd700;" class="zp-phone-display"></strong></p>
                                        <hr style="border: 0; border-top: 1px solid rgba(255,255,255,0.2); margin: 8px 0 12px;">
                                        <ol class="rocket-ol">
                                            <li>রকেট অ্যাপ অথবা <strong>*৩২২#</strong> ডায়াল করুন।</li>
                                            <li><strong>"<?= $acc_tp_text ?>"</strong> অপশন সিলেক্ট করুন।</li>
                                            <li>নিচের নাম্বারে টাকা পাঠান:
                                                <div class="rocket-copy-box">
                                                    <span><?= $target_number ?></span>
                                                    <button type="button" class="rocket-copy-btn copy" data-clipboard-text="<?= $target_number ?>">Copy</button>
                                                </div>
                                            </li>
                                            <li>টাকার পরিমাণ লিখুন: <strong><?= currency_format($all_info['total_amount']) ?></strong></li>
                                            <li>পেমেন্ট শেষ হলে নিচে <strong>Verify</strong> চাপুন।</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="rocket-footer">
                                <div class="zp-stage-1-btns w-full text-center flex gap-[15px] justify-between">
                                    <button type="button" class="rocket-btn rocket-btn-close" onclick="window.location.href='<?= base_url("api/execute/" . $all_info['tmp_ids']); ?>'">Cancel</button>
                                    <button type="button" class="rocket-btn rocket-btn-confirm zp-btn-proceed-generic" disabled>Confirm</button>
                                </div>
                                <div class="zp-stage-2-btns w-full text-center flex gap-[15px] justify-between" style="display:none;">
                                    <button type="button" class="rocket-btn rocket-btn-close" onclick="showStage1Generic()">Back</button>
                                    <button type="button" class="rocket-btn rocket-btn-confirm payment_submit_done" id="payment_submit_done" data-tmp_id="<?= session('tmp_ids') ?>" data-href="<?= base_url('api/save_payment/rocket?acc_tp=' . (service('request')->getGet('acc_tp') ?? '')) ?>">Verify</button>
                                </div>
                            </div>
                            <div class="rocket-sub-footer">
                                <a href="tel:16216" class="rocket-phone-link">
                                    <span class="rocket-phone-icon">
                                        <svg width="10" height="10" viewBox="0 0 24 24"><path d="M20 15.5c-1.2 0-2.4-.2-3.6-.6-.3-.1-.7 0-1 .2l-2.2 2.2c-2.8-1.4-5.1-3.8-6.6-6.6l2.2-2.2c.3-.3.4-.7.2-1-.3-1.1-.5-2.3-.5-3.5 0-.6-.4-1-1-1H4c-.6 0-1 .4-1 1 0 9.4 7.6 17 17 17 .6 0 1-.4 1-1v-3.5c0-.6-.4-1-1-1z"/></svg>
                                    </span>
                                    16216
                                </a>
                                <div class="rocket-copyright">© 2026 Rocket, All Rights Reserved</div>
                            </div>
                        </div>
                    </div>

                        <script>
                            var retryInterval = null;
                            var retryPollInterval = null;
                            var stage2PollInterval = null;

                            function clearAllIntervals() {
                                if (retryInterval) { clearInterval(retryInterval); retryInterval = null; }
                                if (retryPollInterval) { clearInterval(retryPollInterval); retryPollInterval = null; }
                                if (stage2PollInterval) { clearInterval(stage2PollInterval); stage2PollInterval = null; }
                            }

                            function startStage2Polling(el) {
                                clearAllIntervals();
                                stage2PollInterval = setInterval(function() {
                                    doVerify(el, true);
                                }, 3000);
                            }

                            $(document).ready(function() {
                                // Handle input logic for phone inputs generically
                                $('.zp-phone-generic').on('input', function() {
                                    var val = $(this).val().replace(/[^0-9]/g, '');
                                    $(this).val(val);
                                    var proceedBtn = $(this).closest('.bkash-theme-container, .nagad-theme-container, .upay-theme-container, .rocket-theme-container').find('.zp-btn-proceed-generic');
                                    if (val.length === 11 && val.startsWith('01')) {
                                        proceedBtn.prop('disabled', false);
                                    } else {
                                        proceedBtn.prop('disabled', true);
                                    }
                                });

                                // Proceed button handler generically
                                $('.zp-btn-proceed-generic').on('click', function() {
                                    var container = $(this).closest('.bkash-theme-container, .nagad-theme-container, .upay-theme-container, .rocket-theme-container');
                                    var phone = container.find('.zp-phone-generic').val();
                                    container.find('.zp-phone-display').text(phone);
                                    $('#transaction_id').val(phone); // Sync with legacy hidden input
                                    
                                    // Show loader and switch to stage 2
                                    $("#loader").css("display", "flex");
                                    setTimeout(function() {
                                        $("#loader").css("display", "none");
                                        container.find('[id$="stage-1"]').hide();
                                        container.find('.zp-stage-1-btns').hide();
                                        container.find('[id$="stage-2"]').fadeIn();
                                        container.find('.zp-stage-2-btns').fadeIn();

                                        // Start automatic silent verification polling immediately
                                        var verifyBtn = container.find('.payment_submit_done');
                                        if (verifyBtn.length) {
                                            doVerify(verifyBtn, true); // Trigger once immediately
                                            startStage2Polling(verifyBtn); // Poll every 3 seconds
                                        }
                                    }, 500);
                                });
                            });

                            function showStage1Generic() {
                                clearAllIntervals();
                                var container = $('.zp-phone-generic').closest('.bkash-theme-container, .nagad-theme-container, .upay-theme-container, .rocket-theme-container');
                                container.find('[id$="stage-2"]').hide();
                                container.find('.zp-stage-2-btns').hide();
                                container.find('[id$="stage-1"]').fadeIn();
                                container.find('.zp-stage-1-btns').fadeIn();
                            }
                        </script>
                    <?php else : ?>
                        <!-- Fallback legacy layout for Bank, Binance, etc. -->
                        <div class="transaction">
                            <h2 class="mb-4 text-center">ট্রান্সজেকশন আইডি দিন</h2>
                            <script>$('#transaction_id').attr('type', 'text').addClass('mb-5').attr('placeholder', 'ট্রান্সজেকশন আইডি দিন').attr('autocomplete', 'off').attr('autofocus', 'true'); $('.transaction').append($('#transaction_id'));</script>
                        </div>
                        <?php
                        if ($setting['t_type'] == 'bank' && $setting['g_type'] != 'binance') {
                            $file = __DIR__ . '/methods/bank.php';
                            include $file;
                        } else {
                            $file = __DIR__ . '/methods/' . $setting['g_type'] . '.php';
                            if (file_exists($file)) {
                                include $file;
                            }
                        }
                        ?>
                    <?php endif; ?>

                </div>
            </div>
            
            <?php if (!$is_mobile || $acc_tp == 'merchant') : ?>
                <button class="w-full absolute bottom-0 btn btn-bottom" id="payment_submit_done" data-tmp_id="<?= session('tmp_ids') ?>" data-href="<?= base_url('api/save_payment/' . $setting['g_type'] . '?acc_tp=' . (service('request')->getGet('acc_tp') ?? '')) ?>">VERIFY</button>
            <?php endif; ?>
        </div>
    </div>

    <!-- ═══ Retry Popup Modal ═══ -->
    <div id="retryModal" style="display:none; position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(15,23,42,0.85); backdrop-filter:blur(6px); z-index:9999; align-items:center; justify-content:center;">
        <div style="background:rgba(30,27,75,0.95); border:1px solid rgba(255,255,255,0.1); border-radius:16px; padding:28px 24px; max-width:340px; width:90%; text-align:center; box-shadow:0 20px 60px rgba(0,0,0,0.5); animation:retryBounce 0.4s ease;">
            <!-- Animated Clock Icon -->
            <div style="width:72px; height:72px; border-radius:50%; background:rgba(251,191,36,0.12); display:flex; align-items:center; justify-content:center; margin:0 auto 16px;">
                <div style="width:52px; height:52px; border-radius:50%; background:linear-gradient(135deg,#fbbf24,#f59e0b); display:flex; align-items:center; justify-content:center; box-shadow:0 4px 20px rgba(251,191,36,0.3);">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="#fff" stroke-width="2"/><path d="M12 7v5l3 3" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg>
                </div>
            </div>
            <h3 style="color:#fbbf24; font-size:18px; font-weight:700; margin-bottom:6px;">ভেরিফিকেশন অসম্পূর্ণ</h3>
            <p style="color:#94a3b8; font-size:13px; line-height:1.6; margin-bottom:16px;">
                পেমেন্ট এখনো প্রসেস হচ্ছে।<br>
                <span id="retryCountdownText" style="color:#fbbf24; font-weight:600;"><span id="retrySeconds">10</span> সেকেন্ড</span> অপেক্ষা করে আবার চেষ্টা করুন।
            </p>
            <!-- Countdown Progress -->
            <div style="width:100%; height:4px; background:rgba(255,255,255,0.06); border-radius:10px; overflow:hidden; margin-bottom:16px;">
                <div id="retryProgress" style="height:100%; width:100%; background:linear-gradient(90deg,#fbbf24,#f59e0b); border-radius:10px; transition:width 1s linear;"></div>
            </div>
            <button id="retryVerifyBtn" disabled style="width:100%; padding:14px; border:none; border-radius:10px; font-size:14px; font-weight:700; cursor:not-allowed; background:rgba(251,191,36,0.2); color:rgba(251,191,36,0.5); transition:all 0.3s ease; letter-spacing:0.5px;">
                ⏳ অপেক্ষা করুন...
            </button>
        </div>
    </div>

    <style>
        @keyframes retryBounce {
            0% { transform: scale(0.8); opacity: 0; }
            60% { transform: scale(1.05); }
            100% { transform: scale(1); opacity: 1; }
        }
        #retryVerifyBtn:not(:disabled) {
            background: linear-gradient(135deg, #fbbf24, #f59e0b) !important;
            color: #000 !important;
            cursor: pointer !important;
            box-shadow: 0 4px 15px rgba(251,191,36,0.3);
        }
        #retryVerifyBtn:not(:disabled):hover {
            filter: brightness(1.1);
            transform: translateY(-1px);
        }
    </style>

    <script>
        var token = '<?= csrf_hash() ?>';
        var failAttempts = 0;

        $('#payment_submit_done').on("click", function(event) {
            event.preventDefault();
            doVerify($(this));
        });

        // Bind for newly added premium checkout selectors as well
        $(document).on("click", ".payment_submit_done", function(event) {
            event.preventDefault();
            // Only trigger if it wasn't already triggered by ID selector
            if (this.id !== "payment_submit_done") {
                doVerify($(this));
            }
        });

        function doVerify(element, isSilent) {
            isSilent = isSilent || false;
            var url = element.attr("data-href"),
                tmp_id = element.attr("data-tmp_id"),
                t_type = "<?= $setting['t_type'] ?>",
                transaction_id = $('#transaction_id').val(),
                acc_tp = "<?= service('request')->getGet('acc_tp') ?? '' ?>",
                data = $.param({
                    token: token,
                    tmp_id: tmp_id,
                    transaction_id: transaction_id,
                    t_type: t_type,
                    acc_tp: acc_tp
                });

            if (!isSilent) {
                element.prop("disabled", true);
                element.html('<span style="display:flex;align-items:center;justify-content:center;gap:8px;"><span class="loader" style="width:18px;height:18px;border-width:2px;display:inline-block;"></span> যাচাই হচ্ছে...</span>');
                $("#loader").css("display", "flex");
            }

            var delay = isSilent ? 0 : 1000;
            setTimeout(function() {
                $.post(url, data, function(_result) {
                    if (_result.status === 'success' || _result.status === 'warning') {
                        clearAllIntervals();
                        showToast(_result.message, _result.status);
                        if (_result.redirect) {
                            setTimeout(function() {
                                window.location.replace(_result.redirect);
                            }, 1000);
                        }
                    } else {
                        if (!isSilent) {
                            failAttempts++;
                            if (failAttempts === 1) {
                                $("#loader").css("display", "none");
                                element.prop("disabled", false);
                                element.html('Verify');
                                showRetryModal(element);
                            } else {
                                showToast(_result.message, _result.status);
                                if (_result.redirect) {
                                    setTimeout(function() {
                                        window.location.replace(_result.redirect);
                                    }, 1500);
                                } else {
                                    element.prop("disabled", false);
                                    element.html('Verify');
                                    $("#loader").css("display", "none");
                                }
                            }
                        }
                    }
                }, 'json').fail(function() {
                    if (!isSilent) {
                        showToast('নেটওয়ার্ক সমস্যা, আবার চেষ্টা করুন', 'error');
                        element.prop("disabled", false);
                        element.html('Verify');
                        $("#loader").css("display", "none");
                    }
                });
            }, delay);
        }

        function showRetryModal(verifyElement) {
            clearAllIntervals();
            var modal = $('#retryModal');
            var retryBtn = $('#retryVerifyBtn');
            var countdown = 10;
            var total = 10;

            modal.css('display', 'flex');
            retryBtn.prop('disabled', true).css({'cursor':'not-allowed'}).html('⏳ অপেক্ষা করুন...');
            $('#retrySeconds').text(countdown);
            $('#retryProgress').css('width', '100%');

            // Poll silently every 2.5 seconds
            retryPollInterval = setInterval(function() {
                doVerify(verifyElement, true);
            }, 2500);

            retryInterval = setInterval(function() {
                countdown--;
                $('#retrySeconds').text(countdown);
                $('#retryProgress').css('width', ((countdown / total) * 100) + '%');

                if (countdown <= 0) {
                    clearAllIntervals();
                    retryBtn.prop('disabled', false).css({'cursor':'pointer'}).html('🔄 আবার ভেরিফাই করুন');
                    $('#retryCountdownText').html('<span style="color:#34d399;">✅ এখন আবার চেষ্টা করতে পারেন!</span>');
                }
            }, 1000);

            retryBtn.off('click').on('click', function() {
                if (!$(this).prop('disabled')) {
                    modal.css('display', 'none');
                    doVerify(verifyElement);
                }
            });
        }

        $(document).on("click", ".copy", function() {
            let vl = $(this).attr('data-clipboard-text'),
                params = { 'type': 'text', 'value': vl };
            copyToClipBoard(params, 'toast')
        });
    </script>

    <?php if (!empty($setting['t_type']) && $setting['t_type'] == 'bank') { ?>
        <script type="text/javascript">
            $('.transaction').css('display', 'none');
            $(document).ready(function() {
                $(document).on('change', '#ajaxUpload', function() {
                    var property = document.getElementById('ajaxUpload').files[0];
                    var _that = $(this),
                        _action = "<?= base_url('api/upload_files'); ?>";

                    var form_data = new FormData();
                    form_data.append("files[]", property);
                    $.ajax({
                        url: _action,
                        method: 'POST',
                        dataType: 'JSON',
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function() {
                            $("#loader").css("display", "flex");
                        },
                        success: function(response) {
                            $("#loader").css("display", "none");
                            if (response.status == 'success') {
                                $('#transaction_id').val(response.link);
                            }
                            showToast(response.message, response.status);
                        }
                    });
                });
            });
        </script>
    <?php } ?>
</body>

</html>