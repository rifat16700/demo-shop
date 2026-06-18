<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Secure Payment-<?= get_option('site_name', 'Your Site') ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= BASE_SITE . get_option('site_icon', BASE_SITE . "assets/images/favicon.png") ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *{margin:0;padding:0;box-sizing:border-box;}
        body{
            font-family:'Inter',sans-serif;
            background:linear-gradient(160deg,#0f172a 0%,#1e1b4b 50%,#312e81 100%);
            min-height:100vh;
            display:flex;align-items:center;justify-content:center;
            padding:16px;
        }
        .zp-wrap{
            background:rgba(30,27,75,.6);
            backdrop-filter:blur(20px);
            border:1px solid rgba(255,255,255,.08);
            border-radius:18px;
            box-shadow:0 8px 40px rgba(0,0,0,.3);
            max-width:540px;width:100%;
            padding:22px 24px 24px;position:relative;
        }
        .zp-top{
            display:flex;justify-content:space-between;align-items:center;
            background:rgba(255,255,255,.05);border-radius:12px;
            padding:12px 16px;border:1px solid rgba(255,255,255,.08);
            margin-bottom:22px;
        }
        .zp-top a,.zp-top button{
            color:#94a3b8;background:none;border:none;
            cursor:pointer;display:flex;align-items:center;text-decoration:none;
        }
        .zp-brand{text-align:center;margin-bottom:18px;}
        .zp-brand-img{
            width:74px;height:74px;border-radius:50%;
            background:#fff;
            display:flex;align-items:center;justify-content:center;
            margin:0 auto 10px;overflow:hidden;
            border:2px solid rgba(255,255,255,.15);
            box-shadow:0 2px 10px rgba(0,0,0,0.2);
        }
        .zp-brand-img img{width:100%;height:100%;object-fit:contain;padding:4px;border-radius:50%;}
        .zp-brand h2{font-size:18px;font-weight:700;color:#e2e8f0;margin-bottom:6px;}
        .zp-vd{
            display:inline-block;padding:4px 16px;
            border:1.5px solid #818cf8;border-radius:20px;
            color:#818cf8;font-size:12px;font-weight:600;
            text-decoration:none;cursor:pointer;transition:.2s;
        }
        .zp-vd:hover{background:#818cf8;color:#fff;}
        .zp-sup{display:flex;justify-content:center;gap:14px;margin-bottom:22px;}
        .zp-si{
            width:44px;height:44px;border-radius:50%;
            border:1.5px solid rgba(255,255,255,.12);
            display:flex;align-items:center;justify-content:center;
            text-decoration:none;transition:.2s;background:rgba(255,255,255,.05);
        }
        .zp-si:hover{border-color:#818cf8;background:rgba(129,140,248,.15);}
        .zp-si svg{width:20px;height:20px;}
        .zp-tabs{
            display:flex;
            background:linear-gradient(135deg,#6366f1,#8b5cf6);
            border-radius:25px;overflow:hidden;margin-bottom:18px;
        }
        .zp-tb{
            flex:1;padding:11px 6px;text-align:center;
            color:rgba(255,255,255,.6);font-size:13px;font-weight:600;
            cursor:pointer;text-decoration:none;border-radius:25px;transition:.25s;
        }
        .zp-tb.active{background:rgba(255,255,255,.2);color:#fff;}
        .zp-grid{
            display:none;
            grid-template-columns:repeat(4,1fr);gap:12px;
            margin-bottom:18px;padding:2px;
        }
        .zp-grid.active{display:grid;}
        .zp-gc{
            background:rgba(255,255,255,.06);
            border:1.5px solid rgba(255,255,255,.08);border-radius:12px;
            padding:14px 6px;cursor:pointer;text-align:center;
            transition:.25s;display:flex;align-items:center;justify-content:center;
            min-height:72px;
        }
        .zp-gc:hover{
            border-color:#818cf8;
            box-shadow:0 6px 20px rgba(129,140,248,.2);
            transform:translateY(-2px);
            background:rgba(255,255,255,.1);
        }
        .zp-gc img{max-width:90%;max-height:42px;object-fit:contain;}
        .zp-pay{
            background:rgba(99,102,241,.2);border-radius:25px;
            padding:14px;text-align:center;
            color:#a5b4fc;font-size:16px;font-weight:700;
        }
        .zp-ov{
            display:none;position:fixed;
            top:0;left:0;right:0;bottom:0;
            background:rgba(15,23,42,.7);backdrop-filter:blur(6px);
            z-index:100;align-items:center;justify-content:center;
        }
        .zp-ov.show{display:flex;}
        .zp-modal{
            background:#1e1b4b;border:1px solid rgba(255,255,255,.1);
            border-radius:18px;padding:24px;
            max-width:420px;width:92%;
            box-shadow:0 20px 60px rgba(0,0,0,.4);
            position:relative;animation:modalIn .25s ease;
        }
        @keyframes modalIn{from{opacity:0;transform:scale(.95) translateY(10px);}to{opacity:1;transform:scale(1) translateY(0);}}
        .zp-mx{
            position:absolute;top:16px;right:16px;
            width:34px;height:34px;border-radius:50%;
            border:1px solid rgba(255,255,255,.1);background:rgba(255,255,255,.05);
            display:flex;align-items:center;justify-content:center;
            cursor:pointer;color:#94a3b8;font-size:16px;transition:.2s;
        }
        .zp-mx:hover{background:rgba(255,255,255,.1);}
        .zp-modal h3{font-size:18px;font-weight:700;color:#e2e8f0;margin-bottom:6px;}
        .zp-modal p.desc{font-size:13px;color:#94a3b8;line-height:1.6;margin-bottom:18px;}
        .zp-mo{
            display:flex;align-items:center;
            padding:14px 16px;background:rgba(255,255,255,.05);
            border:1.5px solid rgba(255,255,255,.08);border-radius:12px;
            margin-bottom:10px;cursor:pointer;transition:.2s;text-decoration:none;
        }
        .zp-mo:hover{border-color:#818cf8;background:rgba(129,140,248,.1);}
        .zp-mo img{width:38px;height:38px;object-fit:contain;margin-right:14px;flex-shrink:0;}
        .zp-mo svg{width:28px;height:28px;margin-right:14px;flex-shrink:0;}
        .zp-ml{font-size:15px;font-weight:600;color:#e2e8f0;}
        .zp-ms{font-size:12px;color:#94a3b8;margin-top:1px;}
        .zp-tl{list-style:none;padding:0;}
        .zp-tl li{display:flex;justify-content:space-between;padding:9px 0;font-size:14px;color:#94a3b8;}
        .zp-tl li:last-child{font-weight:600;color:#818cf8;}
        .zp-tl hr{border:none;border-top:1px solid rgba(255,255,255,.06);margin:0;}
        .zp-loader{
            display:none;position:fixed;top:0;left:0;right:0;bottom:0;
            background:rgba(15,23,42,.85);z-index:200;
            align-items:center;justify-content:center;
        }
        .zp-spin{
            width:42px;height:42px;
            border:4px solid rgba(255,255,255,.1);border-top-color:#818cf8;
            border-radius:50%;animation:spin .7s linear infinite;
        }
        @keyframes spin{to{transform:rotate(360deg);}}
        @media(max-width:520px){
            body{padding:0;align-items:flex-start;}
            .zp-wrap{border-radius:0;min-height:100vh;padding:16px 16px 20px;}
            .zp-grid{grid-template-columns:repeat(3,1fr);}
            .zp-tb{font-size:11px;padding:10px 4px;}
        }
    </style>
</head>

<body>
    <div class="zp-loader" id="loader"><div class="zp-spin"></div></div>

    <div class="zp-wrap">
        <div class="zp-top">
            <a href="<?= BASE_SITE; ?>">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="M12 19l-7-7 7-7"/></svg>
            </a>
            <button class="cancel_btn" data-url="<?= base_url('api/checkout/undetected/' . $all_info['tmp_ids'] . '/' . encodeParams('0')) ?>" style="background:none;border:none;cursor:pointer;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>

        <div class="zp-brand">
            <div class="zp-brand-img">
                <img src="<?= BASE_SITE . $all_info['brand_logo'] ?>" alt="<?= $all_info['brand_name'] ?>">
            </div>
            <h2><?= $all_info['brand_name'] ?></h2>
            <a href="#" class="zp-vd" id="viewDetailsBtn">View Details</a>
        </div>

        <div class="zp-sup">
            <a href="#" class="zp-si" id="supportBtn" title="Support">
                <svg viewBox="0 0 24 24" fill="none" stroke="#818cf8" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 18v-6a9 9 0 0118 0v6"/><path d="M21 19a2 2 0 01-2 2h-1a2 2 0 01-2-2v-3a2 2 0 012-2h3zM3 19a2 2 0 002 2h1a2 2 0 002-2v-3a2 2 0 00-2-2H3z"/></svg>
            </a>
            <a href="https://wa.me/<?= $all_info['whatsapp_number'] ?>" target="_blank" class="zp-si" title="WhatsApp">
                <svg viewBox="0 0 24 24" fill="#25D366"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            </a>
            <a href="tel:<?= $all_info['mobile_number'] ?>" class="zp-si" title="Call">
                <svg viewBox="0 0 24 24" fill="none" stroke="#818cf8" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
            </a>
        </div>

        <div class="zp-tabs">
            <?php if (!empty($mobile_s)) { ?>
                <a href="#" class="zp-tb" data-target="tab_mobile">Mobile Banking</a>
            <?php }
            if (!empty($bank_s)) { ?>
                <a href="#" class="zp-tb" data-target="tab_bank">Bank Transfer</a>
            <?php }
            if (!empty($int_b_s)) { ?>
                <a href="#" class="zp-tb" data-target="tab_int">Others</a>
            <?php } ?>
        </div>

        <?php
        $method_labels = [
            'personal' => 'Send Money',
            'agent'    => 'Cash Out',
            'payment'  => 'Payment',
            'merchant' => 'Payment',
            'live'     => 'Auto Payment',
        ];
        $grouped_mobile = [];
        if (!empty($mobile_s)) { foreach ($mobile_s as $mb) { $grouped_mobile[$mb->g_type][] = $mb; } }
        $grouped_bank = [];
        if (!empty($bank_s)) { foreach ($bank_s as $mb) { $grouped_bank[$mb->g_type][] = $mb; } }
        $grouped_int = [];
        if (!empty($int_b_s)) { foreach ($int_b_s as $mb) { $grouped_int[$mb->g_type][] = $mb; } }
        ?>

        <?php if (!empty($grouped_mobile)) { ?>
            <div id="tab_mobile" class="zp-grid">
                <?php foreach ($grouped_mobile as $gtype => $methods) :
                    $mj = [];
                    foreach ($methods as $m) {
                        $mj[] = ['label' => $method_labels[$m->active_payment] ?? ucfirst($m->active_payment), 'type' => $m->active_payment, 'url' => base_url('api/execute_payment/' . $m->g_type . '/' . $all_info['tmp_ids'] . '?acc_tp=' . encrypt($m->active_payment))];
                    }
                ?>
                    <div class="zp-gc" data-gtype="<?= $gtype ?>" data-methods='<?= json_encode($mj) ?>'>
                        <img src="<?= BASE_SITE . payment_option($gtype) ?>" alt="<?= $gtype ?>">
                    </div>
                <?php endforeach; ?>
            </div>
        <?php }
        if (!empty($grouped_bank)) { ?>
            <div id="tab_bank" class="zp-grid">
                <?php foreach ($grouped_bank as $gtype => $methods) :
                    $mj = [];
                    foreach ($methods as $m) {
                        $mj[] = ['label' => 'Bank Transfer', 'type' => $m->active_payment ?? 'bank', 'url' => base_url('api/execute_payment/' . $m->g_type . '/' . $all_info['tmp_ids'])];
                    }
                ?>
                    <div class="zp-gc" data-gtype="<?= $gtype ?>" data-methods='<?= json_encode($mj) ?>'>
                        <img src="<?= BASE_SITE . payment_option($gtype) ?>" alt="<?= $gtype ?>">
                    </div>
                <?php endforeach; ?>
            </div>
        <?php }
        if (!empty($grouped_int)) { ?>
            <div id="tab_int" class="zp-grid">
                <?php foreach ($grouped_int as $gtype => $methods) :
                    $mj = [];
                    foreach ($methods as $m) {
                        $mj[] = ['label' => ($m->active_payment == 'live' ? 'Crypto' : ($method_labels[$m->active_payment] ?? ucfirst($m->active_payment))), 'type' => $m->active_payment, 'url' => base_url('api/execute_payment/' . $m->g_type . '/' . $all_info['tmp_ids'] . '?acc_tp=' . encrypt($m->active_payment))];
                    }
                ?>
                    <div class="zp-gc" data-gtype="<?= $gtype ?>" data-methods='<?= json_encode($mj) ?>'>
                        <img src="<?= BASE_SITE . payment_option($gtype) ?>" alt="<?= $gtype ?>">
                    </div>
                <?php endforeach; ?>
            </div>
        <?php } ?>

        <div class="zp-pay">Pay <?= currency_format($all_info['total_amount']) ?></div>
    </div>

    <!-- Method Modal -->
    <div class="zp-ov" id="methodModal">
        <div class="zp-modal">
            <div class="zp-mx" id="closeMethod">✕</div>
            <h3>Select Payment Method</h3>
            <p class="desc">This merchant offers multiple options for this gateway. Please choose one to continue.</p>
            <div id="methodList"></div>
        </div>
    </div>

    <!-- Details Modal -->
    <div class="zp-ov" id="detailsModal">
        <div class="zp-modal">
            <div class="zp-mx" id="closeDetails">✕</div>
            <h3>Transaction Details</h3>
            <ul class="zp-tl" style="margin-top:16px;">
                <li><span>Invoice To:</span><span><?= ucfirst($all_info['brand_name']) ?></span></li><hr>
                <li><span>Trx Id:</span><span><?= $all_info['transaction_id'] ?></span></li><hr>
                <li><span>Amount:</span><span><?= currency_format($all_info['amount']) ?></span></li><hr>
                <li><span>Total Payable:</span><span><?= currency_format($all_info['total_amount']) ?></span></li>
            </ul>
        </div>
    </div>

    <!-- Support Modal -->
    <div class="zp-ov" id="supportModal">
        <div class="zp-modal">
            <div class="zp-mx" id="closeSupport">✕</div>
            <h3>Contact Support</h3>
            <p class="desc">Need help? Reach out to us through any of these channels.</p>
            <a href="tel:<?= $all_info['mobile_number'] ?>" class="zp-mo">
                <svg viewBox="0 0 24 24" fill="none" stroke="#818cf8" stroke-width="2" width="28" height="28"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
                <div><div class="zp-ml">Call Us</div><div class="zp-ms"><?= $all_info['mobile_number'] ?></div></div>
            </a>
            <a href="https://wa.me/<?= $all_info['whatsapp_number'] ?>" target="_blank" class="zp-mo">
                <svg viewBox="0 0 24 24" fill="#25D366" width="28" height="28"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                <div><div class="zp-ml">WhatsApp</div><div class="zp-ms"><?= $all_info['whatsapp_number'] ?></div></div>
            </a>
            <a href="mailto:<?= $all_info['support_mail'] ?>" class="zp-mo">
                <svg viewBox="0 0 24 24" fill="none" stroke="#818cf8" stroke-width="2" width="28" height="28"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                <div><div class="zp-ml">Email</div><div class="zp-ms"><?= $all_info['support_mail'] ?></div></div>
            </a>
        </div>
    </div>

    <?= script_asset('js/jquery.js') ?>
    <script>
    $(function(){
        $(".zp-tb:first").addClass("active");
        $(".zp-grid:first").addClass("active");
        $(".zp-tb").click(function(e){
            e.preventDefault();var t=$(this).data("target");
            $(".zp-tb").removeClass("active");$(this).addClass("active");
            $(".zp-grid").removeClass("active");$("#"+t).addClass("active");
        });
        $(".zp-gc").click(function(){
            var methods=$(this).data("methods"),gtype=$(this).data("gtype"),img=$(this).find("img").attr("src");
            if(methods.length===1){$("#loader").css("display","flex");window.location.href=methods[0].url;}
            else{
                var h='';
                methods.forEach(function(m){
                    h+='<a href="'+m.url+'" class="zp-mo gw-link"><img src="'+img+'"><div><div class="zp-ml">'+m.label+'</div><div class="zp-ms">'+gtype.charAt(0).toUpperCase()+gtype.slice(1)+'</div></div></a>';
                });
                $("#methodList").html(h);$("#methodModal").addClass("show");
            }
        });
        $("#viewDetailsBtn").click(function(e){e.preventDefault();$("#detailsModal").addClass("show");});
        $("#supportBtn").click(function(e){e.preventDefault();$("#supportModal").addClass("show");});
        $("#closeMethod").click(function(){$("#methodModal").removeClass("show");});
        $("#closeDetails").click(function(){$("#detailsModal").removeClass("show");});
        $("#closeSupport").click(function(){$("#supportModal").removeClass("show");});
        $(".zp-ov").click(function(e){if(e.target===this)$(this).removeClass("show");});
        $(".cancel_btn").click(function(){window.location.href=$(this).data("url");});
        $(document).on("click",".gw-link",function(){$("#loader").css("display","flex");});
    });
    </script>
</body>

</html>