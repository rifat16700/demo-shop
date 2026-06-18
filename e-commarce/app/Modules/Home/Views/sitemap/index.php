<?php
// সাইটম্যাপ আউটপুট XML হিসেবে সেট করা ভালো অভ্যাস
header('Content-Type: application/xml; charset=UTF-8');

// XML declaration
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";

// XSL (স্টাইল) যোগ করা
echo '<?xml-stylesheet href="' . base_url('public/assets/style.xsl') . '" type="text/xsl"?>' . "\n";
?>

<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php if (!empty($sitemaps)) : ?>
        <?php foreach ($sitemaps as $sitemapItem): ?>
            <sitemap>
                <loc><?= htmlspecialchars($sitemapItem['loc'], ENT_QUOTES | ENT_XML1, 'UTF-8') ?></loc>

                <?php if (!empty($sitemapItem['lastmod'])): ?>
                    <lastmod><?= date('Y-m-d\TH:i:sP', strtotime($sitemapItem['lastmod'])) ?></lastmod>
                <?php endif; ?>
            </sitemap>
        <?php endforeach; ?>
    <?php endif; ?>
</sitemapindex>
