<?php
/*
Template Name: About
*/

$locale = get_locale();
?>

<?php get_header(); ?>

<main id="main" class="about">
    <div class="c-main-column">
        <div class="c-main-column__left">
            <a class="c-main-column__left-logo" href="<?php echo home_url('/'); ?>">
                <picture>
                    <source srcset="/assets/img/subpage-mv-logo_pc.svg" media="(min-width: 1024px)">
                    <img src="/assets/img/subpage-mv-logo_sp.svg" alt="美板" width="181" height="50">
                </picture>
            </a>
        </div>
        <div class="c-main-column__right">
            <div class="container">
                <h1 class="about-ttl">美板について</h1>
                <p class="about-txt">2025年秋、金沢市の景観を考える新たなオンラインプラットフォーム「美板（びばん）」を公開予定です。<br>
                本プロジェク
                    トは、金沢市役所の支援を受け、金沢美術工芸大学 坂野研究室との共同研究として進められている社会連携事業です。<br>
                    「美板」は、金沢のまちなかに存在する「魅力ある看板」に注目し、景観の質を高める事例として紹介、アーカイブして
                    いくウェブサイトです。看板は広告であると同時に、まちの表情や文化を映すメディアでもあります。学生たちが独自の
                    視点で取材した看板を通して、金沢にふさわしい広告のあり方を考え、景観都市としての金沢市の魅力向上を目指し
                    ます
                </p>
            </div>
        </div>
    </div>
</main>


<?php get_footer(); ?>