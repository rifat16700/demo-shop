<style>
  .pricing-card {
    background: #1e1e2d;
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.05);
    transition: all 0.3s ease;
    height: 100%;
  }
  .pricing-card:hover {
    transform: translateY(-5px);
    border-color: rgba(99, 102, 241, 0.5);
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
  }
  .pricing-card.active-plan {
    border: 2px solid #28c76f;
    box-shadow: 0 0 20px rgba(40, 199, 111, 0.15);
    background: linear-gradient(180deg, #1e1e2d 0%, #15241b 100%);
  }
  .pricing-feature-list li {
    font-size: 14.5px;
    color: #a2a3b7;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
  }
  .pricing-feature-list li .badge {
    margin-right: 12px;
    background: rgba(99, 102, 241, 0.15) !important;
    color: #6366f1 !important;
    padding: 6px;
  }
  .pricing-card.active-plan .pricing-feature-list li .badge {
    background: rgba(40, 199, 111, 0.15) !important;
    color: #28c76f !important;
  }
  .price-display {
    color: #ffffff;
    font-weight: 700;
  }
</style>

<div class="overflow-hidden">
  <div class="pb-sm-5 pb-2 rounded-top">
    <div class="container py-5">
      <div class="row mx-0 gy-4 px-lg-2 justify-content-center">
        <?php if (!empty($items)) :
          foreach ($items as $item) :
            $isActive = (get_active_plan() && get_active_plan()->plan_id == $item['id']);
        ?>
            <div class="col-lg-4 col-md-6">
              <div class="card pricing-card <?= $isActive ? 'active-plan' : '' ?>">
                <div class="card-body p-4 p-xl-5 position-relative d-flex flex-column">

                  <h3 class="text-center text-capitalize mb-2 fw-bold <?= $isActive ? 'text-success' : 'text-white' ?>"><?= $item['name'] ?></h3>
                  <p class="text-center text-muted mb-4" style="font-size: 13.5px;"><?= $item['description'] ?></p>
                  
                  <div class="text-center mb-4 pb-2 border-bottom border-secondary">
                    <div class="d-flex justify-content-center align-items-baseline">
                      <sup class="h4 text-primary fw-bold mb-0 me-1"><?= get_option('currency_symbol') ?></sup>
                      <h1 class="price-display display-4 mb-0"><?= currency_format($item['final_price']) ?></h1>
                      <sub class="h6 text-muted fw-normal ms-1">/<?= duration_type($item['name'], $item['duration_type'], $item['duration']) ?></sub>
                    </div>
                  </div>

                  <ul class="pricing-feature-list list-unstyled mb-5 flex-grow-1">
                    <li>
                      <span class="badge rounded-pill"><i class="fas fa-check"></i></span>
                      <?= plan_message('brand', $item['brand']) ?>
                    </li>
                    <li>
                      <span class="badge rounded-pill"><i class="fas fa-check"></i></span>
                      <?= plan_message('device', $item['device']) ?>
                    </li>
                    <li>
                      <span class="badge rounded-pill"><i class="fas fa-check"></i></span>
                      <?= plan_message('transaction', $item['transaction']) ?>
                    </li>
                  </ul>
                  
                  <div class="mt-auto">
                    <?= plan_button($item['id']); ?>
                  </div>
                </div>
              </div>
            </div>
        <?php
          endforeach;
        endif;
        ?>
      </div>
    </div>
  </div>
</div>

<script>
  function updateCountdown(targetTime, countdownElement) {
    const currentTime = new Date();
    const timeDifference = targetTime - currentTime;
    if (timeDifference <= 0) {
      countdownElement.text("Expired");
    } else {
      const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
      const hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);
      countdownElement.text(`${days}d ${hours}h ${minutes}m ${seconds}s`);
    }
  }

  function updateCountdowns() {
    $(".countdown").each(function(index) {
      const targetTimeStr = $(this).siblings(".getExpire").text();
      const targetTime = new Date(targetTimeStr);
      updateCountdown(targetTime, $(this));
    });
  }
  setInterval(updateCountdowns, 1000);
  updateCountdowns();
</script>