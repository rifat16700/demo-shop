<style>
/* ═══ ADMIN DASHBOARD — PREMIUM FLUID LAYOUT ═══ */
.dash-hero {
  background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
  padding: clamp(1.4rem, 3vw, 2.8rem) clamp(1.2rem, 3vw, 2.5rem);
  border-radius: clamp(16px, 2vw, 24px);
  margin-bottom: clamp(1rem, 2vw, 1.5rem);
  position: relative; overflow: hidden;
  color: #fff; box-shadow: 0 8px 40px rgba(99,102,241,.3);
}
.dash-hero::before { content:''; position:absolute; top:-50%; right:-5%; width:320px; height:320px; background:rgba(255,255,255,.07); border-radius:50%; pointer-events:none; }
.dash-hero::after { content:''; position:absolute; bottom:-50%; left:10%; width:240px; height:240px; background:rgba(255,255,255,.04); border-radius:50%; pointer-events:none; }
.dash-hero h2 { font-size:clamp(1.2rem,2.8vw,1.8rem); font-weight:900; margin:0 0 .4rem; position:relative; z-index:1; letter-spacing:-.5px; }
.dash-hero p { font-size:clamp(.85rem,1.2vw,.98rem); opacity:1; color: rgba(255,255,255,0.95); margin:0; position:relative; z-index:1; font-weight: 500; }

/* ── FLUID GRIDS ── */
.fluid-grid { display:grid; gap:clamp(10px,1.4vw,18px); margin-bottom:clamp(14px,2vw,22px); width:100%; box-sizing:border-box; }
.fluid-grid.cols-4 { grid-template-columns: repeat(2,1fr); }
@media(min-width:600px){ .fluid-grid.cols-4 { grid-template-columns: repeat(4,1fr); } }
.fluid-grid.cols-2 { grid-template-columns: repeat(2,1fr); }
.fluid-grid.cols-1 { grid-template-columns: 1fr; }
.fluid-grid.cols-split { grid-template-columns: 1fr; }
@media(min-width:768px){ .fluid-grid.cols-split { grid-template-columns: 2fr 1fr; } }

/* ══ PREMIUM STAT CARD — Icon centered top, text below ══ */
.s-card {
  background: linear-gradient(160deg, rgba(24,32,55,.95) 0%, rgba(15,21,37,.98) 100%);
  border: 1px solid rgba(255,255,255,.07);
  border-radius: clamp(16px,2vw,22px);
  padding: clamp(1.3rem,2.5vw,2rem) clamp(1rem,2vw,1.5rem) clamp(1rem,2vw,1.5rem);
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  gap: .35rem;
  transition: all .35s cubic-bezier(.4,0,.2,1);
  min-width: 0;
  position: relative;
  overflow: hidden;
}
.s-card::before {
  content: '';
  position: absolute; inset: 0;
  background: radial-gradient(ellipse at 50% 0%, rgba(99,102,241,.08) 0%, transparent 70%);
  pointer-events: none;
}
.s-card:hover {
  border-color: rgba(99,102,241,.4);
  transform: translateY(-5px);
  box-shadow: 0 16px 48px rgba(0,0,0,.45), 0 0 0 1px rgba(99,102,241,.2);
}

/* Icon — big, centered, glowing */
.s-icon {
  width: clamp(52px,6vw,64px);
  height: clamp(52px,6vw,64px);
  border-radius: clamp(14px,1.8vw,18px);
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  font-size: clamp(1.2rem,1.8vw,1.5rem);
  color: #fff;
  margin-bottom: .6rem;
  flex-shrink: 0;
  position: relative; z-index: 1;
}
.s-icon.i1 { background: linear-gradient(135deg,#6366f1,#8b5cf6); box-shadow: 0 8px 24px rgba(99,102,241,.5); }
.s-icon.i2 { background: linear-gradient(135deg,#10b981,#34d399); box-shadow: 0 8px 24px rgba(16,185,129,.5); }
.s-icon.i3 { background: linear-gradient(135deg,#f59e0b,#fbbf24); box-shadow: 0 8px 24px rgba(245,158,11,.5); }
.s-icon.i4 { background: linear-gradient(135deg,#3b82f6,#60a5fa); box-shadow: 0 8px 24px rgba(59,130,246,.5); }
.s-icon.i5 { background: linear-gradient(135deg,#ef4444,#f87171); box-shadow: 0 8px 24px rgba(239,68,68,.5); }
.s-icon.i6 { background: linear-gradient(135deg,#06b6d4,#22d3ee); box-shadow: 0 8px 24px rgba(6,182,212,.5); }

.s-lbl { color: #94a3b8; font-size:clamp(.68rem,.85vw,.78rem); font-weight:700; text-transform:uppercase; letter-spacing:1.2px; position:relative; z-index:1; }
.s-val { font-size:clamp(1.4rem,2.5vw,2rem); font-weight:900; color:#ffffff; line-height:1.1; word-break:break-word; position:relative; z-index:1; letter-spacing:-.8px; }
.s-sub { font-size:clamp(.7rem,.88vw,.82rem); color: #cbd5e1; position:relative; z-index:1; font-weight: 500; }
.s-sub .up { color:#34d399; font-weight:800; }
.s-sub .dn { color:#f87171; font-weight:800; }

/* ── CHART WRAPPER ── */
.chart-wrap {
  background: linear-gradient(160deg, rgba(24,32,55,.95) 0%, rgba(15,21,37,.98) 100%);
  border: 1px solid rgba(255,255,255,.07);
  border-radius: clamp(16px,2vw,22px); overflow:hidden;
}
.chart-hdr { padding:clamp(.9rem,1.6vw,1.3rem) clamp(1.1rem,2vw,1.6rem); border-bottom:1px solid rgba(255,255,255,.06); display:flex; justify-content:space-between; align-items:flex-start; flex-wrap:wrap; gap:.5rem; }
.chart-hdr h5 { font-size:clamp(.95rem,1.2vw,1.1rem); font-weight:800; color:#ffffff; margin:0; letter-spacing: -0.2px; }
.chart-hdr .sub { font-size:clamp(.72rem,.88vw,.82rem); color: #94a3b8; margin:.25rem 0 0; font-weight: 500; }

.period-pills { display:flex; gap:5px; flex-wrap:wrap; }
.period-pills .pp { padding:clamp(4px,.5vw,7px) clamp(9px,1.1vw,15px); border-radius:9px; font-size:clamp(.66rem,.82vw,.77rem); font-weight:600; background:rgba(255,255,255,.04); border:1px solid rgba(255,255,255,.07); color:rgba(100,116,139,.9); cursor:pointer; transition:all .2s; white-space:nowrap; }
.period-pills .pp:hover,.period-pills .pp.active { background:rgba(99,102,241,.18); border-color:rgba(99,102,241,.4); color:#818cf8; }

.sum-strip { display:grid; grid-template-columns:repeat(auto-fit,minmax(75px,1fr)); gap:1px; background:rgba(255,255,255,.06); }
.sum-item { background:rgba(15,21,37,.98); padding:clamp(.65rem,1.1vw,1.1rem); text-align:center; }
.sum-item .sv { font-size:clamp(1rem,1.3vw,1.25rem); font-weight:900; color:#ffffff; }
.sum-item .sl { font-size:clamp(.6rem,.72vw,.72rem); text-transform:uppercase; letter-spacing:1px; color:#94a3b8; margin-top:4px; font-weight: 700; }

/* ── PAYMENT METHOD CARDS ── */
.payment-method-card { background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.06); border-radius: 14px; padding: 1.2rem; display: flex; flex-direction: column; gap: 1rem; transition: transform 0.2s, background 0.2s; }
.payment-method-card:hover { transform: translateY(-3px); background: rgba(255,255,255,.05); border-color: rgba(99,102,241,.3); }
.pm-header { display: flex; align-items: center; gap: 1rem; }
.pm-logo { width: 48px; height: 48px; border-radius: 10px; object-fit: contain; background: #fff; padding: 4px; box-shadow: 0 4px 10px rgba(0,0,0,.2); }
.pm-name { font-size: 1.05rem; font-weight: 800; color: #fff; letter-spacing: -0.3px; }
.pm-count { font-size: 0.8rem; color: #94a3b8; font-weight: 500; }
.pm-stats { display: flex; justify-content: space-between; border-top: 1px dashed rgba(255,255,255,.08); padding-top: .8rem; }
.pm-stat-item { text-align: center; flex: 1; }
.pm-stat-item:first-child { border-right: 1px dashed rgba(255,255,255,.08); }
.pm-stat-value { font-size: 1.1rem; font-weight: 900; }
.pm-stat-label { font-size: 0.7rem; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; margin-top: 3px; font-weight: 700; }
.pm-progress { display: flex; height: 6px; border-radius: 10px; overflow: hidden; background: rgba(255,255,255,.06); margin-top: 0.5rem; }
.bar-success { background: linear-gradient(90deg, #10b981, #34d399); }
.bar-pending { background: linear-gradient(90deg, #f59e0b, #fbbf24); }

/* ── ACTIVE PLANS LIST ── */
.list-item-modern { display: flex; align-items: center; padding: 1rem 1.2rem; border-bottom: 1px solid rgba(255,255,255,.04); gap: 1rem; transition: background 0.2s; }
.list-item-modern:hover { background: rgba(255,255,255,.02); }
.list-item-modern:last-child { border-bottom: none; }
.list-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0; box-shadow: 0 4px 12px rgba(0,0,0,.15); }
.l-bg-blue { background: linear-gradient(135deg, #3b82f6, #60a5fa); }
.list-item-modern .text-dark { color: #fff !important; }
</style>

<section class="section">
  <!-- Hero -->
  <div class="dash-hero animate-in">
    <h2 id="greeting">Hello, Admin</h2>
    <p>Welcome back to Ekhoni Digital Dashboard. Here's what's happening today.</p>
  </div>

  <!-- Stats Row 1 -->
  <div class="fluid-grid cols-4">
    <div class="s-card animate-in animate-delay-1">
      <div class="s-icon i1"><i class="fas fa-users"></i></div>
      <div class="s-lbl">Active Users</div>
      <div class="s-val total_active_users">0</div>
      <div class="s-sub"><span class="up"><i class="fas fa-caret-up"></i> Total:</span> <span class="total_users">0</span></div>
    </div>
    <div class="s-card animate-in animate-delay-2">
      <div class="s-icon i2"><i class="fas fa-check-circle"></i></div>
      <div class="s-lbl">Success Transactions</div>
      <div class="s-val success_trx">0</div>
      <div class="s-sub"><span class="up"><i class="fas fa-check"></i> Total:</span> <span class="total_success_trx">0</span></div>
    </div>
    <div class="s-card animate-in animate-delay-3">
      <div class="s-icon i3"><i class="fas fa-hourglass-half"></i></div>
      <div class="s-lbl">Pending</div>
      <div class="s-val pending_trx">0</div>
      <div class="s-sub"><span class="dn"><i class="fas fa-exclamation-triangle"></i> Pending:</span> <span class="total_pending_trx">0</span></div>
    </div>
    <div class="s-card animate-in animate-delay-4">
      <div class="s-icon i4"><i class="fas fa-wallet"></i></div>
      <div class="s-lbl">Earnings</div>
      <div class="s-val earning">0</div>
      <div class="s-sub"><span class="up"><i class="fas fa-coins"></i> Total:</span> <span class="total_earning">0</span></div>
    </div>
  </div>

  <!-- Stats Row 2 -->
  <div class="fluid-grid cols-2">
    <div class="s-card">
      <div class="s-icon i6"><i class="fas fa-ticket-alt"></i></div>
      <div class="s-lbl">Pending Tickets</div>
      <div class="s-val total_pending_tickets">0</div>
      <div class="s-sub">Total: <span class="total_tickets">0</span></div>
    </div>
    <div class="s-card">
      <div class="s-icon i5"><i class="fas fa-file-invoice-dollar"></i></div>
      <div class="s-lbl">Pending Invoices</div>
      <div class="s-val total_pending_invoices">0</div>
      <div class="s-sub">Total: <span class="total_invoices">0</span></div>
    </div>
  </div>

  <!-- Analytics Chart -->
  <div class="fluid-grid cols-1">
    <div class="chart-wrap">
      <div class="chart-hdr">
        <div>
          <h5>Transaction Analytics</h5>
          <p class="sub">Revenue & transaction performance overview</p>
        </div>
        <div class="period-pills">
          <span class="pp mydrp active" data-period="today">Today</span>
          <span class="pp mydrp" data-period="7day">7D</span>
          <span class="pp mydrp" data-period="30day">30D</span>
          <span class="pp mydrp" data-period="week">Week</span>
          <span class="pp mydrp" data-period="month">Month</span>
          <span class="pp mydrp" data-period="year">Year</span>
        </div>
      </div>
      <div class="sum-strip">
        <div class="sum-item"><div class="sv total_success_trx_s">0</div><div class="sl">Success</div></div>
        <div class="sum-item"><div class="sv total_pending_trx_s">0</div><div class="sl">Pending</div></div>
        <div class="sum-item"><div class="sv total_earning_s">0</div><div class="sl">Revenue</div></div>
        <div class="sum-item"><div class="sv total_users_s">0</div><div class="sl">Users</div></div>
      </div>
      <div style="padding:clamp(1rem,2vw,1.5rem);">
        <div id="chartWrapper" style="height:clamp(200px,30vw,320px);">
          <canvas id="transactionChart"></canvas>
        </div>
      </div>
    </div>
  </div>

  <!-- Payment Methods & Plans -->
  <div class="fluid-grid cols-split">
    <div class="chart-wrap">
      <div class="chart-hdr">
        <div><h5>Payment Methods</h5><p class="sub">Breakdown by gateway</p></div>
      </div>
      <div style="padding:clamp(.8rem,1.5vw,1.2rem);">
        <div class="fluid-grid cols-2" id="type-list"></div>
      </div>
    </div>
    <div class="chart-wrap">
      <div class="chart-hdr">
        <div><h5>Active Plans</h5><p class="sub">Subscriptions</p></div>
      </div>
      <div style="max-height:400px; overflow-y:auto;" id="plan-list"></div>
    </div>
  </div>
</section>

<script>
var myChart = null;

function updateGreeting() {
  var hour = new Date().getHours();
  var greeting = "Hello, Admin";
  if (hour < 12) greeting = "Good Morning, Admin";
  else if (hour < 18) greeting = "Good Afternoon, Admin";
  else greeting = "Good Evening, Admin";
  $('#greeting').text(greeting);
}

function renderChart(data) {
  var container = $('#chartWrapper');
  if (!document.getElementById('transactionChart')) {
    container.html('<canvas id="transactionChart"></canvas>');
  }
  if (!data || !data.labels || data.labels.length === 0) {
    container.html('<div style="display:flex;flex-direction:column;align-items:center;justify-content:center;height:100%;color:var(--text-muted)"><i class="fas fa-chart-area fa-3x" style="opacity:.3;margin-bottom:12px"></i><div style="font-size:13px">Select a period with data for chart</div></div>');
    return;
  }
  var ctx = document.getElementById('transactionChart').getContext('2d');
  if (myChart) { myChart.destroy(); myChart = null; }

  myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: data.labels,
      datasets: [{
        label: 'Success', data: data.success,
        backgroundColor: 'rgba(99, 102, 241, 0.08)',
        borderColor: '#818cf8', borderWidth: 2.5,
        pointBackgroundColor: '#818cf8', pointBorderColor: '#1e293b',
        pointBorderWidth: 2, pointRadius: 4, pointHoverRadius: 6,
        tension: 0.4, fill: true
      }, {
        label: 'Pending', data: data.pending,
        backgroundColor: 'rgba(239, 68, 68, 0.06)',
        borderColor: '#f87171', borderWidth: 2.5,
        pointBackgroundColor: '#f87171', pointBorderColor: '#1e293b',
        pointBorderWidth: 2, pointRadius: 4, pointHoverRadius: 6,
        tension: 0.4, fill: true
      }]
    },
    options: {
      responsive: true, maintainAspectRatio: false,
      scales: {
        x: { grid: { color: 'rgba(255,255,255,.06)', display: true }, ticks: { color: '#94a3b8', font: { size: 12, weight: '600' } } },
        y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,.06)', borderDash: [4,4] }, ticks: { stepSize: 1, color: '#94a3b8', font: { size: 12, weight: '600' } } }
      },
      plugins: {
        legend: { display: false },
        tooltip: { backgroundColor: '#1e293b', titleFont: { size: 13, weight: '600' }, bodyFont: { size: 12 }, padding: 12, cornerRadius: 10, borderColor: 'rgba(255,255,255,.1)', borderWidth: 1 }
      },
      interaction: { intersect: false, mode: 'index' }
    }
  });
}

function get_dashboard_values(period) {
  $.post("<?= admin_url('dashboard-data') ?>", { token: token, period: period }, function(result) {
    var data = jQuery.parseJSON(result);
    $.each(data, function(index, element) {
      if (index !== 'chart_data' && index !== 'listItems' && index !== 'PlanlistItems') {
        $("." + index).fadeOut(150, function() { $(this).html(element).fadeIn(150); });
      }
    });
    $(".total_success_trx_s").text(data.total_success_trx || '0');
    $(".total_pending_trx_s").text(data.total_pending_trx || '0');
    $(".total_earning_s").text(data.total_earning || '0');
    $(".total_users_s").text(data.total_users || '0');
    $('#type-list').html(data.listItems);
    $('#plan-list').html(data.PlanlistItems);
    renderChart(data.chart_data);
  });
}

$(document).ready(function() {
  updateGreeting();
  var initialPeriod = $('.mydrp.active').data('period') || 'today';
  get_dashboard_values(initialPeriod);

  $(document).on('click', '.mydrp', function(e) {
    e.preventDefault();
    $('.mydrp').removeClass('active');
    $(this).addClass('active');
    get_dashboard_values($(this).data('period'));
  });
});
</script>