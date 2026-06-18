<style>
    .transaction,
    .payment_submit_done {
        display: block; 
    }
</style>

<?php
$acc_tp = decrypt(service('request')->getGet('acc_tp'));

// Determine dollar rate
$rate = 1;
if (!empty(get_value($setting['params'], 'dollar_rate'))) {
    $rate = 1 / get_value($setting['params'], 'dollar_rate');
} elseif (get_option('currency_code') != 'USD') {
    $new_currency_rate = get_option('new_currecry_rate');
    if ($new_currency_rate !== null && $new_currency_rate != 0) {
        $rate = 1 / $new_currency_rate;
    }
}
$amount_usdt = round($all_info['total_amount'] * $rate, 2);

if ($acc_tp == 'personal') :
?>
<!-- ═══════════════════════════════════════════════ -->
<!-- PERSONAL MODE — Pay ID + Screenshot Upload     -->
<!-- ═══════════════════════════════════════════════ -->
<style>
    .transaction { display: none !important; }
</style>
<div class="text-center">
    <h2 class="mb-3 font-semibold text-white font-bangla">পেমেন্ট স্লিপ বা স্ক্রিনশট আপলোড করুন।</h2>
    <input type="file" id="ajaxUpload" name="payment_slip" accept="image/png, image/jpg, image/jpeg" required="">
</div>
<div class="font-bangla mb-20">
    <ul class="mt-5 text-slate-200">
        <li class="flex text-sm">
            <div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span></div>
            <div class="w-full flex justify-between">
                <p>বাইনান্স পে আইডি (Pay ID): <span class="text-yellow-300 font-semibold ml-1"><?= get_value($setting['params'], 'personal_pay_id') ?></span></p>
                <a href="javascript:void(0)" class="px-2 py-0.5 mx-2 rounded-md bg-[#00000040] copy" data-clipboard-text="<?= get_value($setting['params'], 'personal_pay_id') ?>">&#x2398;Copy</a>
            </div>
        </li>
        <hr class="brand-hr my-3">
        <li class="flex text-sm">
            <div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span></div>
            <div class="w-full flex justify-between">
                <p>টাকার পরিমাণ (USDT): <span class="text-yellow-300 font-semibold ml-1"><?= $amount_usdt ?> USDT</span></p>
                <a href="javascript:void(0)" class="px-2 py-0.5 mx-2 rounded-md bg-[#00000040] copy" data-clipboard-text="<?= $amount_usdt ?>">&#x2398;Copy</a>
            </div>
        </li>
        <hr class="brand-hr my-3">
        <li class="flex text-sm">
            <div class="mr-2">
                <svg width="15" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.5 3.64V6.72M4.08 1H8.92L12 4.08V8.92L8.92 12H4.08L1 8.92V4.08L4.08 1Z" stroke="#FFED47" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <circle cx="6.5" cy="8.5625" r="0.6875" fill="#FFED47"></circle>
                </svg>
            </div>
            <p>উপরের উল্লেখিত তথ্য অনুযায়ী আপনার বাইনান্স পেমেন্ট সম্পন্ন করুন। তারপর পেমেন্ট স্ক্রিনশটটি আপলোড করুন এবং নিচের <span class="text-yellow-300 font-semibold ml-1">VERIFY</span> বাটনে ক্লিক করুন।</p>
        </li>
    </ul>
</div>

<?php elseif ($acc_tp == 'live') : ?>
<!-- ═══════════════════════════════════════════════ -->
<!-- LIVE MODE — Crypto Deposit + Full Auto Verify  -->
<!-- ═══════════════════════════════════════════════ -->
<style>
    .transaction,
    .payment_submit_done { display: none !important; }
</style>

<?php
// Auto-verify via Binance API (server-side check on page load)
$apiKey = get_value($setting['params'], 'api_key');
$secretKey = get_value($setting['params'], 'secret_key');
$coin = get_value($setting['params'], 'accepted_coin') ?: 'USDT';
$deposit_verified = false;

// Calculate USDT amount
$live_rate = 1;
if (!empty(get_value($setting['params'], 'live_dollar_rate'))) {
    $live_rate = 1 / get_value($setting['params'], 'live_dollar_rate');
}
$live_amount_usdt = round($all_info['total_amount'] * $live_rate, 4);

// Check deposits on every page load / refresh
if (!empty($apiKey) && !empty($secretKey)) {
    $timestamp = round(microtime(true) * 1000);
    $params_api = [
        'coin' => $coin,
        'limit' => 50,
        'startTime' => (int)((time() - 7200) * 1000), // last 2 hours
        'timestamp' => $timestamp,
        'recvWindow' => 10000,
    ];
    $queryString = http_build_query($params_api);
    $signature = hash_hmac('sha256', $queryString, $secretKey);
    $queryString .= '&signature=' . $signature;
    
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => 'https://api.binance.com/sapi/v1/capital/deposit/hisrec?' . $queryString,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 15,
        CURLOPT_HTTPHEADER => ['X-MBX-APIKEY: ' . $apiKey],
    ]);
    $response = curl_exec($ch);
    curl_close($ch);
    
    $deposits = json_decode($response, true);
    
    if (is_array($deposits)) {
        foreach ($deposits as $deposit) {
            if (abs((float)$deposit['amount'] - $live_amount_usdt) < 0.01 && in_array($deposit['status'], [0, 1, 6])) {
                $deposit_verified = true;
                break;
            }
        }
    }
    
    if ($deposit_verified) {
        $redi = base_url("api/checkout/binance/" . encrypt($data['all_info']['tmp_ids']) . '/' . encodeParams('2'));
        header("Location: " . $redi);
        exit();
    }
}

$deposit_address = get_value($setting['params'], 'deposit_address');
$deposit_network = get_value($setting['params'], 'deposit_network') ?: 'TRC20';
$accepted_coin = get_value($setting['params'], 'accepted_coin') ?: 'USDT';
?>

<div class="font-bangla" style="padding: 0 5px;">
    <!-- Header -->
    <div class="text-center" style="margin-bottom: 20px;">
        <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(240,185,11,0.15); padding: 8px 20px; border-radius: 30px; border: 1px solid rgba(240,185,11,0.3);">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="#F0B90B"><circle cx="12" cy="12" r="12"/><path d="M12 6l3.5 2v4L12 14l-3.5-2V8L12 6z" fill="#1a1a2e"/><path d="M12 14l3.5-2v4L12 18l-3.5-2v-4L12 14z" fill="#1a1a2e"/></svg>
            <span style="color: #F0B90B; font-weight: 600; font-size: 14px;">Crypto Auto-Verify</span>
        </div>
    </div>

    <!-- QR Code -->
    <div class="text-center" style="margin-bottom: 16px;">
        <div style="background: white; display: inline-block; padding: 10px; border-radius: 14px; box-shadow: 0 4px 20px rgba(0,0,0,0.15);">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?= urlencode($deposit_address) ?>" 
                 alt="QR Code" width="150" height="150" style="border-radius: 8px;">
        </div>
    </div>

    <!-- Info Cards -->
    <div style="background: rgba(255,255,255,0.08); border-radius: 14px; padding: 16px; border: 1px solid rgba(255,255,255,0.12); margin-bottom: 12px;">
        <!-- Address -->
        <div style="margin-bottom: 12px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
                <span style="color: rgba(255,255,255,0.5); font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">Deposit Address</span>
                <a href="javascript:void(0)" class="copy" data-clipboard-text="<?= $deposit_address ?>" style="color: #F0B90B; font-size: 12px; text-decoration: none; background: rgba(240,185,11,0.15); padding: 3px 10px; border-radius: 6px;">Copy</a>
            </div>
            <p style="color: #fff; font-size: 12px; word-break: break-all; font-family: monospace; line-height: 1.5; background: rgba(0,0,0,0.2); padding: 8px 10px; border-radius: 8px;"><?= $deposit_address ?></p>
        </div>

        <!-- Network & Coin -->
        <div style="display: flex; gap: 10px; margin-bottom: 12px;">
            <div style="flex: 1; background: rgba(0,0,0,0.2); padding: 10px 12px; border-radius: 10px;">
                <span style="color: rgba(255,255,255,0.5); font-size: 10px; text-transform: uppercase;">Network</span>
                <p style="color: #4ade80; font-weight: 700; font-size: 15px; margin-top: 2px;"><?= $deposit_network ?></p>
            </div>
            <div style="flex: 1; background: rgba(0,0,0,0.2); padding: 10px 12px; border-radius: 10px;">
                <span style="color: rgba(255,255,255,0.5); font-size: 10px; text-transform: uppercase;">Coin</span>
                <p style="color: #F0B90B; font-weight: 700; font-size: 15px; margin-top: 2px;"><?= $accepted_coin ?></p>
            </div>
        </div>

        <!-- Amount -->
        <div style="background: rgba(240,185,11,0.1); border: 1px solid rgba(240,185,11,0.25); padding: 12px 14px; border-radius: 10px; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <span style="color: rgba(255,255,255,0.5); font-size: 10px; text-transform: uppercase;">পরিমাণ পাঠান</span>
                <p style="color: #F0B90B; font-weight: 800; font-size: 22px; margin-top: 2px;"><?= $live_amount_usdt ?> <small style="font-size: 13px;"><?= $accepted_coin ?></small></p>
            </div>
            <a href="javascript:void(0)" class="copy" data-clipboard-text="<?= $live_amount_usdt ?>" style="color: #F0B90B; font-size: 12px; text-decoration: none; background: rgba(240,185,11,0.2); padding: 6px 14px; border-radius: 8px; font-weight: 600;">Copy</a>
        </div>
    </div>

    <!-- Warning -->
    <div style="background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.2); border-radius: 10px; padding: 10px 14px; margin-bottom: 16px;">
        <p style="color: #fca5a5; font-size: 12px; line-height: 1.5;">
            ⚠️ শুধু <strong style="color: #fff;"><?= $deposit_network ?></strong> নেটওয়ার্ক ব্যবহার করুন। ভুল নেটওয়ার্কে পাঠালে ফান্ড হারাতে পারেন।
        </p>
    </div>

    <!-- Auto-checking status -->
    <div class="text-center" style="margin-bottom: 8px;">
        <div id="autoCheckStatus" style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 24px; border-radius: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
            <div style="width: 10px; height: 10px; border-radius: 50%; background: #4ade80; animation: pulse 1.5s infinite;"></div>
            <span style="color: rgba(255,255,255,0.7); font-size: 13px;" id="checkText">পেমেন্ট চেক করা হচ্ছে...</span>
        </div>
        <p style="color: rgba(255,255,255,0.35); font-size: 11px; margin-top: 8px;">পেমেন্ট পাঠানোর পর স্বয়ংক্রিয়ভাবে ভেরিফাই হবে</p>
    </div>

    <style>
        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(0.8); }
        }
    </style>

    <!-- Auto-refresh script — checks every 20 seconds -->
    <script>
        let seconds = 0;
        let checkCount = 0;
        
        setInterval(function() {
            seconds++;
            document.getElementById('checkText').innerText = 'পেমেন্ট চেক করা হচ্ছে... (' + seconds + 's)';
        }, 1000);

        setInterval(function() {
            checkCount++;
            document.getElementById('checkText').innerText = 'ভেরিফাই করা হচ্ছে... (#' + checkCount + ')';
            
            // Reload the page to trigger server-side deposit check
            window.location.reload();
        }, 20000);
    </script>
</div>

<?php else: ?>
<!-- No valid payment type -->
<style>
    .transaction, .payment_submit_done { display: none !important; }
</style>
<div class="text-center text-white p-4">
    <p>Invalid payment type. Please go back and try again.</p>
</div>
<?php endif; ?>
