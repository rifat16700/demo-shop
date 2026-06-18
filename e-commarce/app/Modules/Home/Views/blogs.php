<!-- Blog Listing - Premium Design -->
<style>
  .blog-hero {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
    padding: 80px 0 60px;
    text-align: center;
    position: relative;
    overflow: hidden;
  }
  .blog-hero::before {
    content: '';
    position: absolute;
    top: -50%; right: -20%;
    width: 600px; height: 600px;
    background: radial-gradient(circle, rgba(99,102,241,0.15), transparent 60%);
    border-radius: 50%;
  }
  .blog-hero::after {
    content: '';
    position: absolute;
    bottom: -30%; left: -10%;
    width: 400px; height: 400px;
    background: radial-gradient(circle, rgba(56,189,248,0.1), transparent 60%);
    border-radius: 50%;
  }
  .blog-hero h1 {
    font-size: 2.5rem;
    font-weight: 800;
    color: #fff;
    margin-bottom: 12px;
    position: relative;
    z-index: 1;
  }
  .blog-hero .breadcrumb-nav {
    display: flex;
    justify-content: center;
    gap: 8px;
    font-size: 0.9rem;
    color: rgba(255,255,255,0.5);
    position: relative;
    z-index: 1;
  }
  .blog-hero .breadcrumb-nav a {
    color: rgba(255,255,255,0.7);
    text-decoration: none;
    transition: color 0.2s;
  }
  .blog-hero .breadcrumb-nav a:hover { color: #fff; }

  .blog-section {
    background: #f8fafc;
    padding: 60px 0 80px;
  }

  /* Blog Card */
  .blog-card {
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
    transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
    height: 100%;
    display: flex;
    flex-direction: column;
  }
  .blog-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 50px rgba(0,0,0,0.12);
  }
  .blog-card-img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    transition: transform 0.4s;
  }
  .blog-card:hover .blog-card-img {
    transform: scale(1.05);
  }
  .blog-card-img-wrapper {
    overflow: hidden;
    position: relative;
  }
  .blog-card-body {
    padding: 24px;
    flex: 1;
    display: flex;
    flex-direction: column;
  }
  .blog-card-meta {
    display: flex;
    align-items: center;
    gap: 16px;
    font-size: 0.8rem;
    color: #94a3b8;
    margin-bottom: 12px;
  }
  .blog-card-meta i { color: #6366f1; }
  .blog-card-title {
    font-size: 1.15rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 10px;
    line-height: 1.4;
  }
  .blog-card-title a {
    color: inherit;
    text-decoration: none;
    transition: color 0.2s;
  }
  .blog-card-title a:hover { color: #6366f1; }
  .blog-card-excerpt {
    font-size: 0.88rem;
    color: #64748b;
    line-height: 1.7;
    flex: 1;
  }
  .blog-card-footer {
    padding-top: 16px;
    margin-top: auto;
  }
  .read-more-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.85rem;
    font-weight: 600;
    color: #6366f1;
    text-decoration: none;
    transition: all 0.2s;
  }
  .read-more-btn:hover {
    color: #4f46e5;
    gap: 10px;
  }

  /* Sidebar */
  .blog-sidebar {
    position: sticky;
    top: 100px;
  }
  .sidebar-card {
    background: #fff;
    border-radius: 18px;
    padding: 24px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.05);
  }
  .sidebar-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 2px solid #f1f5f9;
  }
  .sidebar-post {
    display: flex;
    gap: 14px;
    padding: 12px 0;
    border-bottom: 1px solid #f1f5f9;
    transition: all 0.2s;
  }
  .sidebar-post:last-child { border-bottom: none; }
  .sidebar-post:hover { padding-left: 6px; }
  .sidebar-post img {
    width: 64px;
    height: 50px;
    object-fit: cover;
    border-radius: 10px;
    flex-shrink: 0;
  }
  .sidebar-post-title {
    font-size: 0.85rem;
    font-weight: 600;
    color: #334155;
    line-height: 1.4;
    margin-bottom: 4px;
  }
  .sidebar-post-title a {
    color: inherit;
    text-decoration: none;
  }
  .sidebar-post-title a:hover { color: #6366f1; }
  .sidebar-post-time {
    font-size: 0.75rem;
    color: #94a3b8;
  }

  @media (max-width: 768px) {
    .blog-hero { padding: 60px 0 40px; }
    .blog-hero h1 { font-size: 1.8rem; }
    .blog-card-img { height: 180px; }
  }
</style>

<!-- Hero -->
<div class="blog-hero">
  <div class="container">
    <h1>Blog & Updates</h1>
    <div class="breadcrumb-nav">
      <a href="<?= base_url() ?>">Home</a>
      <span>/</span>
      <span>Blog</span>
    </div>
  </div>
</div>

<!-- Blog Content -->
<section class="blog-section">
  <div class="container">
    <div class="row g-4">

      <!-- Blog Posts -->
      <div class="col-lg-8">
        <div class="row g-4">
          <?php if (!empty($items)): foreach ($items as $item): ?>
          <div class="col-md-6">
            <article class="blog-card">
              <div class="blog-card-img-wrapper">
                <img src="<?= base_url($item->thumbnail) ?>" alt="<?= esc($item->title) ?>" class="blog-card-img">
              </div>
              <div class="blog-card-body">
                <div class="blog-card-meta">
                  <span><i class="bi bi-person-fill"></i> Admin</span>
                  <span><i class="bi bi-calendar3"></i> <?= time_format($item->created_at) ?></span>
                </div>
                <h2 class="blog-card-title">
                  <a href="<?= base_url('blog/' . $item->uri) ?>"><?= esc($item->title) ?></a>
                </h2>
                <p class="blog-card-excerpt"><?= shorten_string(strip_tags($item->description), 120) ?></p>
                <div class="blog-card-footer">
                  <a href="<?= base_url('blog/' . $item->uri) ?>" class="read-more-btn">
                    Read More <i class="bi bi-arrow-right"></i>
                  </a>
                </div>
              </div>
            </article>
          </div>
          <?php endforeach; else: ?>
          <div class="col-12 text-center py-5">
            <i class="bi bi-journal-text" style="font-size: 3rem; color: #cbd5e1;"></i>
            <p class="mt-3 text-muted">No blog posts available yet.</p>
          </div>
          <?php endif; ?>
        </div>
      </div>

      <!-- Sidebar -->
      <div class="col-lg-4">
        <div class="blog-sidebar">
          <div class="sidebar-card">
            <h3 class="sidebar-title">Recent Posts</h3>
            <?php if (!empty($items)): foreach ($items as $item): ?>
            <div class="sidebar-post">
              <img src="<?= base_url($item->thumbnail) ?>" alt="<?= esc($item->title) ?>">
              <div>
                <div class="sidebar-post-title">
                  <a href="<?= base_url('blog/' . $item->uri) ?>"><?= esc($item->title) ?></a>
                </div>
                <div class="sidebar-post-time"><?= time_ago($item->created_at) ?></div>
              </div>
            </div>
            <?php endforeach; endif; ?>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>