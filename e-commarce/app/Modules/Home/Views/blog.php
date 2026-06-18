<!-- Blog Single - Premium Design -->
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
    top: -40%; right: -15%;
    width: 500px; height: 500px;
    background: radial-gradient(circle, rgba(99,102,241,0.12), transparent 60%);
    border-radius: 50%;
  }
  .blog-hero h1 {
    font-size: 2rem;
    font-weight: 800;
    color: #fff;
    max-width: 700px;
    margin: 0 auto 14px;
    line-height: 1.3;
    position: relative;
    z-index: 1;
  }
  .blog-hero .breadcrumb-nav {
    display: flex;
    justify-content: center;
    gap: 8px;
    font-size: 0.88rem;
    color: rgba(255,255,255,0.5);
    position: relative;
    z-index: 1;
  }
  .blog-hero .breadcrumb-nav a {
    color: rgba(255,255,255,0.7);
    text-decoration: none;
  }
  .blog-hero .breadcrumb-nav a:hover { color: #fff; }

  .blog-detail-section {
    background: #f8fafc;
    padding: 50px 0 80px;
  }

  /* Article Card */
  .article-card {
    background: #fff;
    border-radius: 22px;
    overflow: hidden;
    box-shadow: 0 4px 24px rgba(0,0,0,0.06);
  }
  .article-cover {
    width: 100%;
    max-height: 420px;
    object-fit: cover;
  }
  .article-body {
    padding: 36px 32px 40px;
  }
  .article-meta {
    display: flex;
    align-items: center;
    gap: 20px;
    font-size: 0.85rem;
    color: #94a3b8;
    margin-bottom: 24px;
    padding-bottom: 20px;
    border-bottom: 1px solid #f1f5f9;
  }
  .article-meta i { color: #6366f1; margin-right: 4px; }
  .article-content {
    font-size: 1rem;
    line-height: 1.85;
    color: #334155;
  }
  .article-content h2, .article-content h3 {
    font-weight: 700;
    color: #0f172a;
    margin-top: 28px;
    margin-bottom: 12px;
  }
  .article-content img {
    max-width: 100%;
    height: auto;
    border-radius: 14px;
    margin: 20px 0;
  }
  .article-content p { margin-bottom: 16px; }
  .article-content a { color: #6366f1; }
  .article-content code {
    background: #f1f5f9;
    padding: 2px 8px;
    border-radius: 6px;
    font-size: 0.9em;
    color: #e11d48;
  }
  .article-content pre {
    background: #1e293b;
    color: #e2e8f0;
    padding: 20px;
    border-radius: 14px;
    overflow-x: auto;
    font-size: 0.88rem;
  }
  .article-content pre code {
    background: transparent;
    color: inherit;
    padding: 0;
  }

  /* Share */
  .article-share {
    margin-top: 32px;
    padding-top: 24px;
    border-top: 1px solid #f1f5f9;
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
  }
  .article-share span {
    font-weight: 600;
    color: #64748b;
    font-size: 0.88rem;
  }
  .share-btn {
    width: 40px; height: 40px;
    border-radius: 12px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    font-size: 1rem;
    transition: all 0.2s;
  }
  .share-btn:hover { transform: translateY(-3px); }
  .share-fb { background: #e8f0fe; color: #1877f2; }
  .share-tw { background: #e8f6fd; color: #1da1f2; }
  .share-wa { background: #e7f7ee; color: #25d366; }

  /* Sidebar */
  .blog-sidebar { position: sticky; top: 100px; }
  .sidebar-card {
    background: #fff;
    border-radius: 18px;
    padding: 24px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.05);
  }
  .sidebar-title {
    font-size: 1.05rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 18px;
    padding-bottom: 12px;
    border-bottom: 2px solid #f1f5f9;
  }
  .sidebar-post {
    display: flex;
    gap: 12px;
    padding: 10px 0;
    border-bottom: 1px solid #f1f5f9;
    transition: padding 0.2s;
  }
  .sidebar-post:last-child { border-bottom: none; }
  .sidebar-post:hover { padding-left: 4px; }
  .sidebar-post img {
    width: 60px; height: 48px;
    object-fit: cover;
    border-radius: 10px;
    flex-shrink: 0;
  }
  .sidebar-post-title {
    font-size: 0.82rem;
    font-weight: 600;
    color: #334155;
    line-height: 1.4;
    margin-bottom: 4px;
  }
  .sidebar-post-title a { color: inherit; text-decoration: none; }
  .sidebar-post-title a:hover { color: #6366f1; }
  .sidebar-post-time { font-size: 0.72rem; color: #94a3b8; }

  @media (max-width: 768px) {
    .blog-hero { padding: 60px 0 40px; }
    .blog-hero h1 { font-size: 1.5rem; }
    .article-body { padding: 24px 20px 28px; }
    .article-cover { max-height: 280px; }
  }
</style>

<!-- Hero -->
<div class="blog-hero">
  <div class="container">
    <h1><?= esc($blog->title) ?></h1>
    <div class="breadcrumb-nav">
      <a href="<?= base_url() ?>">Home</a>
      <span>/</span>
      <a href="<?= base_url('blogs') ?>">Blog</a>
      <span>/</span>
      <span>Article</span>
    </div>
  </div>
</div>

<!-- Blog Detail -->
<section class="blog-detail-section">
  <div class="container">
    <div class="row g-4">

      <!-- Article -->
      <div class="col-lg-8">
        <article class="article-card">
          <?php if (!empty($blog->thumbnail)): ?>
          <img src="<?= base_url($blog->thumbnail) ?>" alt="<?= esc($blog->title) ?>" class="article-cover">
          <?php endif; ?>

          <div class="article-body">
            <div class="article-meta">
              <span><i class="bi bi-person-fill"></i> Admin</span>
              <span><i class="bi bi-calendar3"></i> <?= time_format($blog->created_at) ?></span>
            </div>

            <div class="article-content">
              <?= htmlspecialchars_decode($blog->description, ENT_QUOTES) ?>
            </div>

            <!-- Share -->
            <div class="article-share">
              <span>Share:</span>
              <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(current_url()) ?>" target="_blank" class="share-btn share-fb" title="Share on Facebook">
                <i class="bi bi-facebook"></i>
              </a>
              <a href="https://twitter.com/intent/tweet?url=<?= urlencode(current_url()) ?>&text=<?= urlencode($blog->title) ?>" target="_blank" class="share-btn share-tw" title="Share on Twitter">
                <i class="bi bi-twitter"></i>
              </a>
              <a href="https://api.whatsapp.com/send?text=<?= urlencode($blog->title . ' ' . current_url()) ?>" target="_blank" class="share-btn share-wa" title="Share on WhatsApp">
                <i class="bi bi-whatsapp"></i>
              </a>
            </div>
          </div>
        </article>
      </div>

      <!-- Sidebar -->
      <div class="col-lg-4">
        <div class="blog-sidebar">
          <div class="sidebar-card">
            <h3 class="sidebar-title">Related Posts</h3>
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