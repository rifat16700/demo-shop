<style>
/* ═══ USER DASHBOARD — PREMIUM FLUID LAYOUT ═══ */
.u-hero {
  background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
  padding: clamp(1.4rem, 3vw, 2.8rem) clamp(1.2rem, 3vw, 2.5rem);
  border-radius: clamp(16px, 2vw, 24px);
  margin-bottom: clamp(1rem, 2vw, 1.5rem);
  position: relative; overflow: hidden;
  color: #fff; box-shadow: 0 8px 40px rgba(99,102,241,.3);
}
.u-hero::before { content:''; position:absolute; top:-50%; right:-5%; width:320px; height:320px; background:rgba(255,255,255,.07); border-radius:50%; pointer-events:none; }
.u-hero::after { content:''; position:absolute; bottom:-50%; left:10%; width:240px; height:240px; background:rgba(255,255,255,.04); border-radius:50%; pointer-events:none; }
.u-hero h2 { font-size:clamp(1.2rem,2.8vw,1.8rem); font-weight:900; margin:0 0 .4rem; position:relative; z-index:1; letter-spacing:-.5px; }
.u-hero p { font-size:clamp(.85rem,1.2vw,.98rem); opacity:1; color: rgba(255,255,255,0.95); margin:0 0 .8rem; position:relative; z-index:1; font-weight: 500; }
.u-balance { display:inline-flex; align-items:center; gap:8px; background:rgba(255,255,255,.15); backdrop-filter:blur(12px); padding:clamp(.4rem,.7vw,.6rem) clamp(1rem,2vw,1.4rem); border-radius:14px; font-size:clamp(.85rem,1.2vw,1rem); font-weight:700; position:relative; z-index:1; border:1px solid rgba(255,255,255,.1); }

/* ── FLUID GRIDS ── */
.fluid-grid { display:grid; gap:clamp(10px,1.4vw,18px); margin-bottom:clamp(14px,2vw,22px); width:100%; box-sizing:border-box; }
.fluid-grid.cols-4 { grid-template-columns: repeat(2,1fr); }
@media(min-width:600px){ .fluid-grid.cols-4 { grid-template-columns: repeat(4,1fr); } }
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

.period-pills { display:flex; gap:5px; flex-wrap:wrap; }
.period-pills .pp { padding:clamp(4px,.5vw,7px) clamp(9px,1.1vw,15px); border-radius:9px; font-size:clamp(.66rem,.82vw,.77rem); font-weight:600; background:rgba(255,255,255,.04); border:1px solid rgba(255,255,255,.07); color:rgba(100,116,139,.9); cursor:pointer; transition:all .2s; white-space:nowrap; }
.period-pills .pp:hover,.period-pills .pp.active { background:rgba(99,102,241,.18); border-color:rgba(99,102,241,.4); color:#818cf8; }

/* Legend */
.chart-legend { display:flex; justify-content:center; gap:1.5rem; padding:.8rem; flex-wrap:wrap; }
.chart-legend .dot { width:8px; height:8px; border-radius:50%; display:inline-block; margin-right:6px; }
.chart-legend span { font-size:clamp(.7rem,.9vw,.8rem); color:#94a3b8; font-weight:600; }
</style>

<section class="section">
  <!-- Hero -->
  <div class="u-hero animate-in">
    <h2 id="u-greeting">Welcome back</h2>
    <p>Your dashboard overview — Ekhoni Digital Payment Gateway</p>
    <div class="u-balance"><i class="fas fa-wallet"></i> Balance: <?= currency_format(current_user('balance')); ?></div>
  </div>

  <!-- Stats -->
  <div class="fluid-grid cols-4">
    <div class="s-card animate-in animate-delay-1">
      <div class="s-icon i1"><i class="fas fa-wallet"></i></div>
      <div class="s-lbl">Current Balance</div>
      <div class="s-val"><?= currency_format(current_user('balance')); ?></div>
      <div class="s-sub"><span class="up"><i class="fas fa-arrow-up"></i> Available</span></div>
    </div>
    <div class="s-card animate-in animate-delay-2">
      <div class="s-icon i2"><i class="fas fa-check-circle"></i></div>
      <div class="s-lbl">Successful</div>
      <div class="s-val success_trx">0</div>
      <div class="s-sub"><span class="up"><i class="fas fa-check"></i> Total:</span> <span class="total_success_trx">0</span></div>
    </div>
    <div class="s-card animate-in animate-delay-3">
      <div class="s-icon i3"><i class="fas fa-hourglass-half"></i></div>
      <div class="s-lbl">Pending</div>
      <div class="s-val pending_trx">0</div>
      <div class="s-sub"><span class="dn"><i class="fas fa-clock"></i> Pending:</span> <span class="total_pending_trx">0</span></div>
    </div>
    <div class="s-card animate-in animate-delay-4">
      <div class="s-icon i4"><i class="fas fa-money-bill-wave"></i></div>
      <div class="s-lbl">Total Payments</div>
      <div class="s-val earning">0</div>
      <div class="s-sub"><span class="up"><i class="fas fa-coins"></i> Earnings:</span> <span class="total_earning">0</span></div>
    </div>
  </div>

  <!-- Chart & Methods -->
  <div class="fluid-grid cols-split">
    <div class="chart-wrap">
      <div class="chart-hdr">
        <h5><i class="fas fa-chart-line" style="color:#818cf8;margin-right:8px"></i>Analytics</h5>
        <div class="period-pills">
          <span class="pp mydrp active" data-period="today">Today</span>
          <span class="pp mydrp" data-period="7day">7D</span>
          <span class="pp mydrp" data-period="30day">30D</span>
          <span class="pp mydrp" data-period="week">Week</span>
          <span class="pp mydrp" data-period="month">Month</span>
          <span class="pp mydrp" data-period="year">Year</span>
        </div>
      </div>
      <div style="padding:clamp(1rem,2vw,1.5rem);">
        <div id="chartWrapper" style="height:clamp(200px,28vw,300px);">
          <canvas id="transactionChart"></canvas>
        </div>
      </div>
      <div class="chart-legend">
        <div><span class="dot" style="background:#10b981"></span><span>Successful</span></div>
        <div><span class="dot" style="background:#ef4444"></span><span>Pending</span></div>
      </div>
    </div>
    <div class="chart-wrap">
      <div class="chart-hdr">
        <h5><i class="fas fa-exchange-alt" style="color:#818cf8;margin-right:8px"></i>Methods</h5>
      </div>
      <div style="max-height:380px; overflow-y:auto;" id="type-list">
        <div style="text-align:center;padding:2rem;color:var(--text-muted)">
          <i class="fas fa-spinner fa-spin fa-2x" style="margin-bottom:8px"></i>
          <div style="font-size:13px">Loading...</div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
var myChart = null;

function updateGreeting() {
  var hour = new Date().getHours();
  var name = '<?= current_user("first_name") ?>';
  var greeting = "Welcome back";
  if (hour < 12) greeting = "Good Morning";
  else if (hour < 18) greeting = "Good Afternoon";
  else greeting = "Good Evening";
  $('#u-greeting').text(greeting + ', ' + name + '!');
}

function renderChart(data) {
  var container = $('#chartWrapper');
  if (!document.getElementById('transactionChart')) {
    container.html('<canvas id="transactionChart"></canvas>');
  }
  if (!data || !data.labels || data.labels.length === 0) {
    container.html('<div style="display:flex;flex-direction:column;align-items:center;justify-content:center;height:100%;color:var(--text-muted)"><i class="fas fa-chart-area fa-3x" style="opacity:.3;margin-bottom:12px"></i><div style="font-size:13px">No data for this period</div></div>');
    return;
  }
  var ctx = document.getElementById('transactionChart').getContext('2d');
  if (myChart) { myChart.destroy(); myChart = null; }

  myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: data.labels,
      datasets: [{
        label: 'Successful', data: data.success,
        backgroundColor: 'rgba(16,185,129,0.06)',
        borderColor: '#10b981', borderWidth: 2.5,
        pointBackgroundColor: '#10b981', pointBorderColor: '#1e293b',
        pointBorderWidth: 2, pointRadius: 4, pointHoverRadius: 7,
        tension: 0.4, fill: true
      }, {
        label: 'Pending', data: data.pending,
        backgroundColor: 'rgba(239,68,68,0.04)',
        borderColor: '#ef4444', borderWidth: 2.5,
        pointBackgroundColor: '#ef4444', pointBorderColor: '#1e293b',
        pointBorderWidth: 2, pointRadius: 4, pointHoverRadius: 7,
        tension: 0.4, fill: true
      }]
    },
    options: {
      responsive: true, maintainAspectRatio: false,
      scales: {
        x: { grid: { color: 'rgba(255,255,255,.06)' }, ticks: { color: '#94a3b8', font: { size: 12, weight: '600' } } },
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
  $.post("<?= user_url('dashboard-data') ?>", { token: token, period: period }, function(result) {
    try {
      var data = (typeof result === 'object') ? result : jQuery.parseJSON(result);
      $.each(data, function(index, element) {
        if (index !== 'chart_data' && index !== 'listItems') {
          $("." + index).fadeOut(150, function() { $(this).html(element).fadeIn(150); });
        }
      });
      if (data.listItems) {
        $('#type-list').html(data.listItems || '<div style="text-align:center;padding:2rem;color:var(--text-muted)">No data</div>');
      }
      if (data.chart_data) { renderChart(data.chart_data); }
    } catch(e) { console.error('Dashboard error:', e); }
  }).fail(function(xhr) { console.error('Request failed:', xhr.status); });
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