<?php
// XML হিসেবে আউটপুট
header('Content-Type: application/xml; charset=UTF-8');

// XML declaration
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";

// XSL স্টাইলশীট লিঙ্ক
echo '<?xml-stylesheet href="' . base_url('public/assets/xml.xsl') . '" type="text/xsl"?>' . "\n";
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
        xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">

    <?php if (!empty($items)) : ?>
        <?php foreach ($items as $item) : ?>
            <url>
                <!-- মূল URL -->
                <loc><?= htmlspecialchars($item['loc'], ENT_QUOTES | ENT_XML1, 'UTF-8') ?></loc>

                <!-- ভাষা অনুযায়ী alternate URL -->
                <?php if (!empty($item['translations'])) : ?>
                    <?php foreach ($item['translations'] as $translation) : ?>
                        <xhtml:link
                            rel="alternate"
                            hreflang="<?= htmlspecialchars($translation['language'] ?? '', ENT_QUOTES | ENT_XML1, 'UTF-8') ?>"
                            href="<?= htmlspecialchars($translation['url'] ?? '', ENT_QUOTES | ENT_XML1, 'UTF-8') ?>" />
                    <?php endforeach; ?>
                <?php endif; ?>

                <!-- device / media অনুযায়ী alternate -->
                <?php if (!empty($item['alternates'])) : ?>
                    <?php foreach ($item['alternates'] as $alternate) : ?>
                        <xhtml:link
                            rel="alternate"
                            media="<?= htmlspecialchars($alternate['media'] ?? '', ENT_QUOTES | ENT_XML1, 'UTF-8') ?>"
                            href="<?= htmlspecialchars($alternate['url'] ?? '', ENT_QUOTES | ENT_XML1, 'UTF-8') ?>" />
                    <?php endforeach; ?>
                <?php endif; ?>

                <!-- Priority -->
                <?php if (isset($item['priority'])) : ?>
                    <priority><?= htmlspecialchars($item['priority'], ENT_QUOTES | ENT_XML1, 'UTF-8') ?></priority>
                <?php endif; ?>

                <!-- Last modified -->
                <?php if (!empty($item['lastmod'])) : ?>
                    <lastmod><?= date('Y-m-d\TH:i:sP', strtotime($item['lastmod'])) ?></lastmod>
                <?php endif; ?>

                <!-- Change frequency -->
                <?php if (!empty($item['freq'])) : ?>
                    <changefreq><?= htmlspecialchars($item['freq'], ENT_QUOTES | ENT_XML1, 'UTF-8') ?></changefreq>
                <?php endif; ?>

                <!-- Images -->
                <?php if (!empty($item['images'])) : ?>
                    <?php foreach ($item['images'] as $image) : ?>
                        <image:image>
                            <image:loc><?= htmlspecialchars($image['url'], ENT_QUOTES | ENT_XML1, 'UTF-8') ?></image:loc>

                            <?php if (!empty($image['title'])) : ?>
                                <image:title><?= htmlspecialchars($image['title'], ENT_QUOTES | ENT_XML1, 'UTF-8') ?></image:title>
                            <?php endif; ?>

                            <?php if (!empty($image['caption'])) : ?>
                                <image:caption><?= htmlspecialchars($image['caption'], ENT_QUOTES | ENT_XML1, 'UTF-8') ?></image:caption>
                            <?php endif; ?>

                            <?php if (!empty($image['geo_location'])) : ?>
                                <image:geo_location><?= htmlspecialchars($image['geo_location'], ENT_QUOTES | ENT_XML1, 'UTF-8') ?></image:geo_location>
                            <?php endif; ?>

                            <?php if (!empty($image['license'])) : ?>
                                <image:license><?= htmlspecialchars($image['license'], ENT_QUOTES | ENT_XML1, 'UTF-8') ?></image:license>
                            <?php endif; ?>
                        </image:image>
                    <?php endforeach; ?>
                <?php endif; ?>

                <!-- Videos -->
                <?php if (!empty($item['videos'])) : ?>
                    <?php foreach ($item['videos'] as $video) : ?>
                        <video:video>

                            <?php if (!empty($video['thumbnail_loc'])) : ?>
                                <video:thumbnail_loc><?= htmlspecialchars($video['thumbnail_loc'], ENT_QUOTES | ENT_XML1, 'UTF-8') ?></video:thumbnail_loc>
                            <?php endif; ?>

                            <?php if (!empty($video['title'])) : ?>
                                <video:title><![CDATA[<?= $video['title'] ?>]]></video:title>
                            <?php endif; ?>

                            <?php if (!empty($video['description'])) : ?>
                                <video:description><![CDATA[<?= $video['description'] ?>]]></video:description>
                            <?php endif; ?>

                            <?php if (!empty($video['content_loc'])) : ?>
                                <video:content_loc><?= htmlspecialchars($video['content_loc'], ENT_QUOTES | ENT_XML1, 'UTF-8') ?></video:content_loc>
                            <?php endif; ?>

                            <?php if (!empty($video['duration'])) : ?>
                                <video:duration><?= (int)$video['duration'] ?></video:duration>
                            <?php endif; ?>

                            <?php if (!empty($video['expiration_date'])) : ?>
                                <video:expiration_date><?= htmlspecialchars($video['expiration_date'], ENT_QUOTES | ENT_XML1, 'UTF-8') ?></video:expiration_date>
                            <?php endif; ?>

                            <?php if (!empty($video['rating'])) : ?>
                                <video:rating><?= htmlspecialchars($video['rating'], ENT_QUOTES | ENT_XML1, 'UTF-8') ?></video:rating>
                            <?php endif; ?>

                            <?php if (!empty($video['view_count'])) : ?>
                                <video:view_count><?= (int)$video['view_count'] ?></video:view_count>
                            <?php endif; ?>

                            <?php if (!empty($video['publication_date'])) : ?>
                                <video:publication_date><?= htmlspecialchars($video['publication_date'], ENT_QUOTES | ENT_XML1, 'UTF-8') ?></video:publication_date>
                            <?php endif; ?>

                            <?php if (!empty($video['family_friendly'])) : ?>
                                <video:family_friendly><?= htmlspecialchars($video['family_friendly'], ENT_QUOTES | ENT_XML1, 'UTF-8') ?></video:family_friendly>
                            <?php endif; ?>

                            <?php if (!empty($video['requires_subscription'])) : ?>
                                <video:requires_subscription><?= htmlspecialchars($video['requires_subscription'], ENT_QUOTES | ENT_XML1, 'UTF-8') ?></video:requires_subscription>
                            <?php endif; ?>

                            <?php if (!empty($video['live'])) : ?>
                                <video:live><?= htmlspecialchars($video['live'], ENT_QUOTES | ENT_XML1, 'UTF-8') ?></video:live>
                            <?php endif; ?>

                            <?php if (!empty($video['player_loc']['player_loc'])) : ?>
                                <video:player_loc
                                    allow_embed="<?= htmlspecialchars($video['player_loc']['allow_embed'] ?? '', ENT_QUOTES | ENT_XML1, 'UTF-8') ?>"
                                    autoplay="<?= htmlspecialchars($video['player_loc']['autoplay'] ?? '', ENT_QUOTES | ENT_XML1, 'UTF-8') ?>">
                                    <?= htmlspecialchars($video['player_loc']['player_loc'], ENT_QUOTES | ENT_XML1, 'UTF-8') ?>
                                </video:player_loc>
                            <?php endif; ?>

                            <?php if (!empty($video['restriction']['restriction'])) : ?>
                                <video:restriction
                                    relationship="<?= htmlspecialchars($video['restriction']['relationship'] ?? '', ENT_QUOTES | ENT_XML1, 'UTF-8') ?>">
                                    <?= htmlspecialchars($video['restriction']['restriction'], ENT_QUOTES | ENT_XML1, 'UTF-8') ?>
                                </video:restriction>
                            <?php endif; ?>

                            <?php if (!empty($video['gallery_loc']['gallery_loc'])) : ?>
                                <video:gallery_loc
                                    title="<?= htmlspecialchars($video['gallery_loc']['title'] ?? '', ENT_QUOTES | ENT_XML1, 'UTF-8') ?>">
                                    <?= htmlspecialchars($video['gallery_loc']['gallery_loc'], ENT_QUOTES | ENT_XML1, 'UTF-8') ?>
                                </video:gallery_loc>
                            <?php endif; ?>

                            <?php if (!empty($video['price']['price'])) : ?>
                                <video:price currency="<?= htmlspecialchars($video['price']['currency'] ?? '', ENT_QUOTES | ENT_XML1, 'UTF-8') ?>">
                                    <?= htmlspecialchars($video['price']['price'], ENT_QUOTES | ENT_XML1, 'UTF-8') ?>
                                </video:price>
                            <?php endif; ?>

                            <?php if (!empty($video['uploader']['uploader'])) : ?>
                                <video:uploader info="<?= htmlspecialchars($video['uploader']['info'] ?? '', ENT_QUOTES | ENT_XML1, 'UTF-8') ?>">
                                    <?= htmlspecialchars($video['uploader']['uploader'], ENT_QUOTES | ENT_XML1, 'UTF-8') ?>
                                </video:uploader>
                            <?php endif; ?>

                        </video:video>
                    <?php endforeach; ?>
                <?php endif; ?>

            </url>
        <?php endforeach; ?>
    <?php endif; ?>

</urlset>
