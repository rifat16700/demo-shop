<!-- ═══════ LIVE TRANSACTION FEED ═══════ -->
<div id="txFeed" style="position:fixed;top:0;left:0;right:0;bottom:0;pointer-events:none;z-index:998;overflow:hidden"></div>
<style>
.tx-fly{position:absolute;right:-320px;padding:10px 16px;border-radius:12px;background:rgba(10,15,30,.92);backdrop-filter:blur(16px);border:1px solid rgba(99,102,241,.15);display:flex;align-items:center;gap:10px;font-size:12px;color:var(--t2);white-space:nowrap;box-shadow:0 8px 32px rgba(0,0,0,.4);animation:txSlide 6s ease-in-out forwards}
.tx-fly .tx-dot{width:7px;height:7px;border-radius:50%;background:var(--green);box-shadow:0 0 8px rgba(52,211,153,.5);animation:txPulse 1s infinite}
.tx-fly .tx-amt{color:var(--green);font-weight:700}
@keyframes txSlide{0%{right:-320px;opacity:0}10%{right:24px;opacity:1}80%{right:24px;opacity:1}100%{right:-320px;opacity:0}}
@keyframes txPulse{0%,100%{opacity:1}50%{opacity:.4}}
</style>

<!-- ═══════ HERO — SPLIT SCREEN ═══════ -->
<section class="hero" id="hero">
  <div class="grid-bg"></div>
  <div class="orb orb-1"></div>
  <div class="orb orb-2"></div>
  <div class="container">
    <div class="hero-grid">
      <!-- LEFT — Content -->
      <div class="hero-left reveal">
        <div class="pill"><i class="fas fa-bolt"></i> Smart Payment Automation Platform</div>
        <h1>Automate Your<br><span class="gr">Payment Gateway</span><br>in Minutes</h1>
        <p class="sub">Enterprise-grade payment infrastructure with automatic verification, real-time SMS detection, and instant merchant settlement.</p>
        <div class="hero-btns">
          <a href="#" class="btn btn-p" onclick="openAuth('signup');return false">Start Free <i class="fas fa-arrow-right"></i></a>
          <a href="<?= base_url('docs') ?>#section-2" class="btn btn-o"><i class="fas fa-code"></i> API Docs</a>
        </div>
        <div class="hero-trust">
          <span>Trusted by <?= number_format($total_users ?? 0) ?>+ merchants</span>
          <div class="hero-trust-icons">
            <i class="fas fa-shield-halved"></i>
            <i class="fas fa-lock"></i>
            <i class="fas fa-bolt"></i>
          </div>
        </div>
      </div>

      <!-- RIGHT — Dashboard Mockup + Floating Cards -->
      <div class="hero-right reveal reveal-delay-2">
        <div class="mock">
          <div class="mock-top"><span class="mock-dot"></span><span class="mock-dot"></span><span class="mock-dot"></span><span style="margin-left:auto;font-size:10px;color:var(--t3)"><?= site_config('site_name', 'Ekhoni Digital') ?> Dashboard</span></div>
          <div class="mock-body">
            <div class="mock-row">
              <div class="mc"><div class="lbl">Total Users</div><div class="val v1"><?= number_format($total_users ?? 0) ?></div></div>
              <div class="mc"><div class="lbl">Transactions</div><div class="val v2"><?= number_format($total_tx ?? 0) ?></div></div>
              <div class="mc"><div class="lbl">Success</div><div class="val v3"><?= number_format($total_success ?? 0) ?></div></div>
            </div>
            <div class="mock-chart">
              <div class="mock-bar" style="height:35%"></div><div class="mock-bar" style="height:58%"></div><div class="mock-bar" style="height:42%"></div>
              <div class="mock-bar" style="height:78%"></div><div class="mock-bar" style="height:52%"></div><div class="mock-bar" style="height:92%"></div>
              <div class="mock-bar" style="height:68%"></div><div class="mock-bar" style="height:85%"></div><div class="mock-bar" style="height:55%"></div>
              <div class="mock-bar" style="height:95%"></div><div class="mock-bar" style="height:72%"></div><div class="mock-bar" style="height:88%"></div>
            </div>
          </div>
        </div>
        <!-- Floating Cards -->
        <div class="float-card fc-1">
          <div class="fc-icon green"><i class="fas fa-check"></i></div>
          <div><div class="fc-text">Payment Received</div><div class="fc-sub">৳500 — Just now</div></div>
        </div>
        <div class="float-card fc-2">
          <div class="fc-icon blue"><i class="fas fa-plug"></i></div>
          <div><div class="fc-text">API Active</div><div class="fc-sub">Webhook connected</div></div>
        </div>
        <div class="float-card fc-3">
          <div class="fc-icon purple"><i class="fas fa-chart-line"></i></div>
          <div><div class="fc-text">Live Analytics</div><div class="fc-sub">+24% this week</div></div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ═══════ FEATURES ═══════ -->
<section class="sec" id="features" style="background:var(--bg2);overflow:hidden">
  <div class="orb orb-3"></div>
  <div class="container" style="position:relative;z-index:1">
    <div class="sh text-center reveal">
      <div class="badge"><i class="fas fa-sparkles"></i> Features</div>
      <h2>Everything You Need to<br><span class="gr">Accept Payments</span></h2>
      <p>Built for speed, reliability and scale. Enterprise-grade security for millions of transactions.</p>
    </div>
    <div class="grid g3">
      <div class="gc reveal"><div class="ico i1"><i class="fas fa-check-double"></i></div><h3>Auto Payment Verification</h3><p>Real-time SMS detection verifies payments instantly. No manual checking required.</p></div>
      <div class="gc reveal reveal-delay-1"><div class="ico i2"><i class="fas fa-plug"></i></div><h3>Instant API Integration</h3><p>Simple REST API with webhooks. Accept payments with just a few lines of code.</p></div>
      <div class="gc reveal reveal-delay-2"><div class="ico i3"><i class="fas fa-wallet"></i></div><h3>Wallet Automation</h3><p>Connect multiple mobile banking wallets. Payments route automatically.</p></div>
      <div class="gc reveal reveal-delay-3"><div class="ico i4"><i class="fas fa-truck-fast"></i></div><h3>Auto Product Delivery</h3><p>Automatic delivery upon payment confirmation. Zero manual intervention.</p></div>
      <div class="gc reveal reveal-delay-4"><div class="ico i5"><i class="fas fa-bell"></i></div><h3>Real-time Notifications</h3><p>Webhook notifications and email alerts for every transaction change.</p></div>
      <div class="gc reveal reveal-delay-5"><div class="ico i1"><i class="fas fa-chart-line"></i></div><h3>Analytics Dashboard</h3><p>Revenue tracking, transaction graphs, and detailed performance insights.</p></div>
      <div class="gc reveal reveal-delay-6"><div class="ico i2"><i class="fas fa-mobile-screen-button"></i></div><h3>Multi-Wallet Support</h3><p>bKash, Nagad, Rocket, bank transfer — all payment methods supported.</p></div>
      <div class="gc reveal"><div class="ico i3"><i class="fas fa-shield-halved"></i></div><h3>Secure Transactions</h3><p>End-to-end encryption and fraud detection protect every payment.</p></div>
      <div class="gc reveal reveal-delay-1"><div class="ico i4"><i class="fas fa-file-invoice-dollar"></i></div><h3>Smart Invoicing</h3><p>Generate payment links via email. No website needed to collect payments.</p></div>
    </div>
  </div>
</section>

<!-- ═══════ DEVELOPER / API ═══════ -->
<section class="sec" id="developer" style="overflow:hidden">
  <div class="grid-bg"></div>
  <div class="container" style="position:relative;z-index:1">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:64px;align-items:center">
      <div class="reveal">
        <div class="badge" style="display:inline-flex;align-items:center;gap:6px;padding:7px 18px;border-radius:99px;background:rgba(99,102,241,.06);border:1px solid rgba(99,102,241,.15);color:var(--blue2);font-size:11px;font-weight:700;letter-spacing:1px;text-transform:uppercase;margin-bottom:20px"><i class="fas fa-code"></i> Developers</div>
        <h2 style="font-size:clamp(30px,4vw,46px);font-weight:800;line-height:1.1;letter-spacing:-.04em;margin-bottom:18px">Build With Our<br><span class="gr">Powerful API</span></h2>
        <p style="color:var(--t2);margin-bottom:32px;font-size:15px;line-height:1.7">Simple REST API. Start accepting payments with just a few lines of code. Full documentation included.</p>
        <div style="display:flex;flex-direction:column;gap:14px;margin-bottom:32px">
          <div style="display:flex;align-items:center;gap:12px"><div class="ico i1" style="width:36px;height:36px;border-radius:10px;font-size:15px"><i class="fas fa-key"></i></div><span style="font-size:13px;font-weight:500">API Key Management</span></div>
          <div style="display:flex;align-items:center;gap:12px"><div class="ico i2" style="width:36px;height:36px;border-radius:10px;font-size:15px"><i class="fas fa-bolt"></i></div><span style="font-size:13px;font-weight:500">Webhook Notifications</span></div>
          <div style="display:flex;align-items:center;gap:12px"><div class="ico i3" style="width:36px;height:36px;border-radius:10px;font-size:15px"><i class="fas fa-flask"></i></div><span style="font-size:13px;font-weight:500">Sandbox Testing</span></div>
          <div style="display:flex;align-items:center;gap:12px"><div class="ico i4" style="width:36px;height:36px;border-radius:10px;font-size:15px"><i class="fas fa-book"></i></div><span style="font-size:13px;font-weight:500">Complete Documentation</span></div>
        </div>
        <a href="<?= base_url('docs') ?>#section-2" class="btn btn-p">Read API Docs <i class="fas fa-arrow-right"></i></a>
      </div>
      <div class="cw reveal reveal-delay-2">
        <div class="cw-bar"><span class="mock-dot"></span><span class="mock-dot"></span><span class="mock-dot"></span><span style="margin-left:auto;font-size:10px;color:var(--t3);font-family:monospace">payment.js</span></div>
        <div class="cw-body" id="codeBlock"></div>
      </div>
      <script>
      (function(){
        var c = document.getElementById('codeBlock');
        if(!c) return;
        var lines = [
          {n:' 1', t:'<span class="cc">// <?= site_config("site_name","Ekhoni Digital") ?> — Payment API</span>'},
          {n:' 2', t:'<span class="ck">const</span> <span class="cv">response</span> = <span class="ck">await</span> <span class="cf">fetch</span>(<span class="cs">\'<?= base_url("api/payment/create") ?>\'</span>, {'},
          {n:' 3', t:'  <span class="cv">method</span>: <span class="cs">\'POST\'</span>,'},
          {n:' 4', t:'  <span class="cv">headers</span>: { <span class="cs">\'API-KEY\'</span>: <span class="cv">YOUR_KEY</span> },'},
          {n:' 5', t:'  <span class="cv">body</span>: <span class="cf">JSON.stringify</span>({'},
          {n:' 6', t:'    <span class="cv">amount</span>: <span class="cs">500</span>,'},
          {n:' 7', t:'    <span class="cv">cus_name</span>: <span class="cs">\'John Doe\'</span>,'},
          {n:' 8', t:'    <span class="cv">success_url</span>: <span class="cs">\'/success\'</span>'},
          {n:' 9', t:'  })'},
          {n:'10', t:'});'},
          {n:'11', t:''},
          {n:'12', t:'<span class="ck">const</span> { <span class="cv">payment_url</span> } = <span class="ck">await</span> <span class="cv">response</span>.<span class="cf">json</span>();'},
          {n:'13', t:'<span class="cc">// Redirect user → payment_url ✓</span>'}
        ];
        var html = '';
        for(var i=0;i<lines.length;i++){
          html += '<div class="code-line"><span class="ln">'+lines[i].n+'</span>'+lines[i].t+'</div>';
        }
        html += '<span class="cw-cursor"></span>';
        c.innerHTML = html;
      })();
      </script>
    </div>
  </div>
</section>
<style>@media(max-width:900px){#developer .container>div{grid-template-columns:1fr!important}}</style>

<!-- ═══════ SECURITY ═══════ -->
<section class="sec" id="security" style="background:var(--bg2);overflow:hidden">
  <div class="orb orb-1" style="top:auto;bottom:-30%;left:60%"></div>
  <div class="container" style="position:relative;z-index:1">
    <div class="sh text-center reveal">
      <div class="badge"><i class="fas fa-shield-halved"></i> Security</div>
      <h2>Enterprise-Grade<br><span class="gr">Security</span></h2>
      <p>Military-grade encryption and real-time fraud detection protect every transaction.</p>
    </div>
    <div class="grid g3">
      <div class="gc reveal"><div class="ico i1"><i class="fas fa-lock"></i></div><h3>Encrypted API</h3><p>TLS 1.3 encryption on all API communications. Data always protected.</p></div>
      <div class="gc reveal reveal-delay-1"><div class="ico i2"><i class="fas fa-user-shield"></i></div><h3>Fraud Detection</h3><p>Real-time fraud analysis prevents unauthorized transactions.</p></div>
      <div class="gc reveal reveal-delay-2"><div class="ico i3"><i class="fas fa-fingerprint"></i></div><h3>Device Verification</h3><p>Multi-factor device auth ensures only authorized devices process payments.</p></div>
    </div>
  </div>
</section>

<!-- ═══════ SOLUTIONS ═══════ -->
<section class="sec" id="solutions">
  <div class="container">
    <div class="sh text-center reveal">
      <div class="badge"><i class="fas fa-rocket"></i> Solutions</div>
      <h2>Powerful Solutions<br>For <span class="gr">Every Business</span></h2>
      <p>From startups to enterprise — our platform scales with your needs.</p>
    </div>
    <div class="grid g3">
      <div class="gc reveal"><div class="ico i1"><i class="fas fa-bolt"></i></div><h3>Instant Settlement</h3><p>Payments verified and settled in real-time. No waiting, no delays.</p></div>
      <div class="gc reveal reveal-delay-1"><div class="ico i2"><i class="fas fa-arrows-rotate"></i></div><h3>Lifetime Updates</h3><p>Continuous improvements and features at no extra cost.</p></div>
      <div class="gc reveal reveal-delay-2"><div class="ico i3"><i class="fas fa-infinity"></i></div><h3>Unlimited Transactions</h3><p>No limits, no hidden fees. Complete pricing transparency.</p></div>
      <div class="gc reveal reveal-delay-3"><div class="ico i4"><i class="fas fa-headset"></i></div><h3>24/7 Support</h3><p>Dedicated support via live chat, email, and WhatsApp.</p></div>
      <div class="gc reveal reveal-delay-4"><div class="ico i5"><i class="fas fa-credit-card"></i></div><h3>All Payment Methods</h3><p>bKash, Nagad, Rocket, bank transfer, and international methods.</p></div>
      <div class="gc reveal reveal-delay-5"><div class="ico i1"><i class="fas fa-eye"></i></div><h3>Real-time Monitoring</h3><p>Advanced monitoring protects your business from fraud.</p></div>
    </div>
  </div>
</section>

<!-- ═══════ PRICING ═══════ -->
<section class="sec" id="pricing" style="background:var(--bg2)">
  <div class="container">
    <div class="sh text-center reveal">
      <div class="badge"><i class="fas fa-tags"></i> Pricing</div>
      <h2>Simple,<br><span class="gr">Transparent Pricing</span></h2>
      <p>Choose the plan that fits your business. No hidden fees.</p>
    </div>
    
    <style>
      .pricing-grid {
        display: flex;
        gap: 24px;
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 16px 20px;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        -webkit-overflow-scrolling: touch;
        scroll-behavior: smooth;
        scrollbar-width: none;
      }
      .pricing-grid::-webkit-scrollbar { display: none; }
      
      .pricing-grid .pc {
        flex: 0 0 300px;
        max-width: 85vw;
        scroll-snap-align: center;
        margin: 0;
      }

      /* On Desktop: Show as Grid (No scrolling) */
      @media(min-width: 900px) {
        .pricing-grid {
          display: grid;
          grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
          overflow-x: visible;
          padding-bottom: 0;
        }
        .pricing-grid .pc {
          width: 100%;
          max-width: 380px;
          margin: 0 auto;
          flex: none;
        }
      }
    </style>
    <div class="pricing-grid">
      <?php if (!empty($plans)) : $i = 0; foreach ($plans as $plan) : $i++; ?>
      <div class="pc reveal <?= $i == 2 ? 'pop' : '' ?>">
        <div class="pn"><?= $plan['name'] ?></div>
        <div class="pp"><?= currency_format($plan['final_price']) ?></div>
        <div class="pd"><?= duration_type($plan['name'], $plan['duration_type'], $plan['duration'], false) ?></div>
        <ul>
          <li><?= plan_message('brand', $plan['brand']) ?></li>
          <li><?= plan_message('device', $plan['device']) ?></li>
          <li><?= plan_message('transaction', $plan['transaction']) ?></li>
        </ul>
        <a href="<?= user_url('plans') ?>" class="btn btn-p" style="width:100%;justify-content:center">Get Started</a>
      </div>
      <?php endforeach; endif; ?>
    </div>

<!-- ═══════ TESTIMONIALS ═══════ -->
<section class="sec" id="testimonials">
  <div class="container">
    <div class="sh text-center reveal">
      <div class="badge"><i class="fas fa-quote-left"></i> Testimonials</div>
      <h2>Trusted by<br><span class="gr">Thousands</span></h2>
    </div>
    <div class="grid g3">
      <?php if (!empty($reviews)): ?>
        <?php $delay = 0; foreach($reviews as $review): 
            $stars = str_repeat('★', $review['rating']) . str_repeat('☆', 5 - $review['rating']);
            $initial = strtoupper(substr($review['name'] ?? 'U', 0, 1));
            $avatarUrl = (!empty($review['avatar']) && file_exists(ROOTPATH . $review['avatar'])) ? base_url($review['avatar']) : base_url('public/assets/img/avatar.png');
        ?>
        <div class="tc reveal <?= $delay > 0 ? 'reveal-delay-'.$delay : '' ?>"><div class="stars"><?= $stars ?></div><p class="qt">"<?= esc($review['comment']) ?>"</p><div class="au"><img src="<?= $avatarUrl ?>" alt="<?= esc($review['name'] ?? 'User') ?>" style="width:40px;height:40px;border-radius:50%;object-fit:cover;flex-shrink:0"><div><div class="nm"><?= esc($review['name'] ?? 'User') ?></div><div class="rl">Customer</div></div></div></div>
        <?php $delay++; endforeach; ?>
      <?php else: ?>
        <div class="tc reveal"><div class="stars">★★★★★</div><p class="qt">"Auto-verification saves hours every day. Best payment gateway for Bangladesh."</p><div class="au"><div class="av">A</div><div><div class="nm">Arif Rahman</div><div class="rl">E-commerce Owner</div></div></div></div>
        <div class="tc reveal reveal-delay-1"><div class="stars">★★★★★</div><p class="qt">"API integration took just one afternoon. Simple, powerful, reliable."</p><div class="au"><div class="av">S</div><div><div class="nm">Sakib Hasan</div><div class="rl">SaaS Developer</div></div></div></div>
        <div class="tc reveal reveal-delay-2"><div class="stars">★★★★★</div><p class="qt">"Dashboard analytics are incredibly detailed. The best in the market."</p><div class="au"><div class="av">N</div><div><div class="nm">Nusrat Jahan</div><div class="rl">Digital Agency</div></div></div></div>
      <?php endif; ?>

    </div>
  </div>
</section>

<!-- ═══════ FAQ ═══════ -->
<section class="sec" id="faq" style="background:var(--bg2)">
  <div class="container">
    <div class="sh text-center reveal">
      <div class="badge"><i class="fas fa-circle-question"></i> FAQ</div>
      <h2>Frequently Asked<br><span class="gr">Questions</span></h2>
    </div>
    <div style="max-width:700px;margin:0 auto">
      <?php if (!empty($items)) : foreach ($items as $item) : ?>
      <div class="fq reveal">
        <button class="fq-q" onclick="toggleFaq(this)"><span><?= esc($item['question']) ?></span></button>
        <div class="fq-a"><p><?= esc($item['answer']) ?></p></div>
      </div>
      <?php endforeach; endif; ?>
    </div>
  </div>
</section>

<!-- ═══════ CONTACT ═══════ -->
<section class="sec" id="contact">
  <div class="container">
    <div class="sh text-center reveal">
      <div class="badge"><i class="fas fa-envelope"></i> Contact</div>
      <h2>Get In <span class="gr">Touch</span></h2>
      <p>Have questions? We're here to help 24/7.</p>
    </div>
    <div class="grid g4" style="max-width:960px;margin:0 auto">
      <div class="gc reveal text-center"><div class="ico i1" style="margin:0 auto 14px"><i class="fas fa-location-dot"></i></div><h3 style="font-size:13px">Address</h3><p style="font-size:12px"><?= site_config('address') ?></p></div>
      <div class="gc reveal reveal-delay-1 text-center"><div class="ico i2" style="margin:0 auto 14px"><i class="fas fa-phone"></i></div><h3 style="font-size:13px">Phone</h3><p style="font-size:12px"><?= site_config('contact_tel') ?></p></div>
      <div class="gc reveal reveal-delay-2 text-center"><div class="ico i3" style="margin:0 auto 14px"><i class="fas fa-envelope"></i></div><h3 style="font-size:13px">Email</h3><p style="font-size:12px"><?= site_config('contact_email') ?></p></div>
      <div class="gc reveal reveal-delay-3 text-center"><div class="ico i4" style="margin:0 auto 14px"><i class="fas fa-clock"></i></div><h3 style="font-size:13px">Hours</h3><p style="font-size:12px"><?= site_config('contact_work_hour') ?></p></div>
    </div>
  </div>
</section>



<!-- ═══════ LIVE TRANSACTION FEED SCRIPT ═══════ -->
<script>
(function(){
  const txData = <?= json_encode($recent_tx ?? []) ?>;
  const feed = document.getElementById('txFeed');
  if(!feed || !txData.length) return;
  let idx = 0;
  function showTx(){
    const tx = txData[idx % txData.length];
    const el = document.createElement('div');
    el.className = 'tx-fly';
    const name = tx.username ? tx.username.substring(0,3)+'***' : 'User';
    const amt = parseFloat(tx.amount || 0).toLocaleString();
    const top = 80 + Math.random() * (window.innerHeight - 200);
    el.style.top = top + 'px';
    el.innerHTML = '<span class="tx-dot"></span><span>'+name+' paid</span><span class="tx-amt">৳'+amt+'</span>';
    feed.appendChild(el);
    setTimeout(()=>el.remove(), 6500);
    idx++;
  }
  setTimeout(showTx, 3000);
  setInterval(showTx, 5000 + Math.random()*3000);
})();
</script>
