<?php include dirname(__DIR__) . "/merchant/settings/sidebar.php"; ?>

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4><?= esc($title) ?></h4>
            </div>
            <div class="card-body">
                
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>
                
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <div class="row">
                    <div class="col-md-6">
                        <!-- User Profile Preview -->
                        <div class="d-flex align-items-center mb-4 p-3" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06); border-radius: 12px;">
                            <img src="<?= get_avatar('user') ?>" alt="Profile" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 14px; border: 2px solid rgba(99,102,241,0.3);">
                            <div>
                                <strong style="font-size: 15px;"><?= current_user('first_name') ?> <?= current_user('last_name') ?></strong>
                                <br><small class="text-muted">Your review will be posted as this name</small>
                            </div>
                        </div>

                        <form method="post" action="<?= user_url('reviews/submit') ?>">
                            <div class="form-group">
                                <label style="font-weight: 600; margin-bottom: 10px;">Your Rating</label>
                                
                                <!-- Hidden input for rating value -->
                                <input type="hidden" name="rating" id="rating-value" value="5">
                                
                                <div class="mb-3">
                                    <div id="star-rating-box">
                                        <span class="rv-star" onclick="pickStar(1)">★</span>
                                        <span class="rv-star" onclick="pickStar(2)">★</span>
                                        <span class="rv-star" onclick="pickStar(3)">★</span>
                                        <span class="rv-star" onclick="pickStar(4)">★</span>
                                        <span class="rv-star" onclick="pickStar(5)">★</span>
                                    </div>
                                    <div id="rating-label" style="font-size:13px; margin-top:6px; color:#94a3b8;">Awesome (5/5)</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label style="font-weight: 600;">Your Review</label>
                                <textarea name="comment" class="form-control" style="height: 120px;" placeholder="What do you think about our service?..." required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg mt-2"><i class="fas fa-paper-plane"></i> Submit Review</button>
                        </form>
                    </div>

                    <div class="col-md-6 mt-4 mt-md-0">
                        <h5>Your Previous Reviews</h5>
                        <hr>
                        <?php if(!empty($my_reviews)): ?>
                            <div class="list-group">
                                <?php foreach($my_reviews as $r): ?>
                                    <div class="list-group-item list-group-item-action flex-column align-items-start mb-2" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); border-radius: 8px;">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1" style="color: #fbbf24 !important;">
                                                <?= str_repeat('★', $r['rating']) . str_repeat('☆', 5 - $r['rating']) ?>
                                            </h6>
                                            <small class="text-muted"><?= date('d M Y', strtotime($r['created_at'])) ?></small>
                                        </div>
                                        <p class="mb-1 text-muted">"<?= esc($r['comment']) ?>"</p>
                                        <small>Status: 
                                            <?php if($r['status'] == 1): ?>
                                                <span class="badge badge-success">Approved (Visible)</span>
                                            <?php else: ?>
                                                <span class="badge badge-warning text-dark">Pending Approval</span>
                                            <?php endif; ?>
                                        </small>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p class="text-muted">You haven't submitted any reviews yet.</p>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
#star-rating-box {
    display: inline-flex;
    gap: 6px;
}
.rv-star {
    font-size: 36px !important;
    color: #fbbf24 !important;
    cursor: pointer !important;
    line-height: 1 !important;
    transition: transform 0.15s ease !important;
    user-select: none !important;
    -webkit-user-select: none !important;
}
.rv-star:hover {
    transform: scale(1.2) !important;
}
.rv-star.empty {
    color: #334155 !important;
}
</style>

<script>
var currentRating = 5;
var labels = ['', 'Poor (1/5)', 'Fair (2/5)', 'Good (3/5)', 'Very Good (4/5)', 'Awesome (5/5)'];

function pickStar(val) {
    currentRating = val;
    document.getElementById('rating-value').value = val;
    document.getElementById('rating-label').textContent = labels[val];
    renderStars(val);
}

function renderStars(val) {
    var allStars = document.querySelectorAll('.rv-star');
    for (var i = 0; i < allStars.length; i++) {
        if (i < val) {
            allStars[i].textContent = '★';
            allStars[i].className = 'rv-star';
        } else {
            allStars[i].textContent = '☆';
            allStars[i].className = 'rv-star empty';
        }
    }
}

// Initialize with 5 stars
renderStars(5);
</script>
