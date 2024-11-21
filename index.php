<?php 
/*Tempelate Name: Главная*/
get_header(); ?>
    <main class="main">
        <section class="banner">
            <h1 class="visually-hidden">Блог</h1>

            <?php 
                    $banner_url = CFS()->get('baner');
                if ($banner_url): ?>
                    <img src="<?= esc_url($banner_url); ?>" alt="banner" width="1920" height="1092" loading="lazy">
            <?php endif; ?>
              
        </section>

        <section class="content">
            <h2 class="visually-hidden">Статьи</h2>
            <div class="content__container container">
                <div class="articles">
                    
    <?php 
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => -1, 
        'orderby'        => 'date',
        'order'          => 'DESC',
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) : ?>
        <ul class="articles__list"> 
        <?php
        $index = 0;
        while ($query->have_posts()) : $query->the_post(); 
        $index++;
        $position_in_group = $index % 11;
        $has_image = ($position_in_group === 4 || $position_in_group === 9);
        $article_img = CFS()->get('article_fon'); 
        $background_image = $has_image ? esc_url($article_img) : 'none';
        
        $article_text = CFS()->get('article_text');  

        
        $article_title = get_the_title(); 

        
        $article_text = $article_text ? $article_text : get_the_excerpt();  
        ?>
        <li class="article-container" <?php if ($background_image): ?>
    style="background-image: url('<?= $background_image ?>');"
<?php endif; ?>>
            <article class="articles__item" >
                <a class="category"><?= esc_html(get_the_category()[0]->name); ?></a>
                <a class="title">
                    <h3><?= esc_html($article_title); ?></h3>
                </a>
                <p class="text"><?= esc_html($article_text); ?></p>
                <time class="date"><?= get_the_date('j F Y'); ?></time>
            </article>
        </li>
    <?php 
    endwhile; ?>
    </ul> 
    <?php
    wp_reset_postdata();
else : 
    echo '<p>Записей пока нет.</p>';
endif;
?>

                    
                    <div id="pagination" class="articles-pagination"></div>
                    <button class="show-more-btn form-btn visible-mobile">
                        <span class="button-text">Показать еще 6</span>
                        <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.6979 2.72857V4.56969C17.5656 4.3404 17.4232 4.11641 17.2701 3.89865C16.7343 3.13649 16.0853 2.46569 15.341 1.90484C14.5878 1.33731 13.7549 0.895974 12.8655 0.593121C11.9456 0.279898 10.9823 0.121094 10.0025 0.121094C8.97945 0.121094 7.97595 0.29393 7.02006 0.634823C6.09624 0.964249 5.23765 1.44268 4.46812 2.05685C3.7062 2.66494 3.05309 3.38874 2.527 4.20812C1.99106 5.04286 1.60195 5.95383 1.37049 6.91571C1.22177 7.53378 1.60224 8.1554 2.22033 8.30412C2.31084 8.32589 2.40141 8.33633 2.49056 8.33633C3.0103 8.33633 3.4818 7.98186 3.60874 7.4543C3.94793 6.04469 4.76313 4.76687 5.90418 3.85618C6.47425 3.40121 7.10982 3.04694 7.79325 2.80325C8.50032 2.55111 9.24362 2.42326 10.0025 2.42326C11.4424 2.42326 12.8094 2.87979 13.9556 3.74346C14.7312 4.3279 15.3707 5.08443 15.8223 5.93806H14.547C13.9113 5.93806 13.3959 6.45342 13.3959 7.08914C13.3959 7.72486 13.9113 8.24021 14.547 8.24021H18.8489C19.4847 8.24021 20 7.72486 20 7.08914V2.72857C20 2.09285 19.4847 1.5775 18.8489 1.5775C18.2132 1.5775 17.6979 2.09285 17.6979 2.72857Z" fill="white" />
                            <path d="M1.15107 16.4212C1.78679 16.4212 2.30214 15.9059 2.30214 15.2701V13.4212C2.98785 14.6148 3.94261 15.6347 5.10098 16.4029C6.55344 17.3662 8.24543 17.876 9.9946 17.8775L9.99745 17.8776L9.99977 17.8775L10.0025 17.8776L10.0061 17.8775C11.0262 17.8765 12.0267 17.7038 12.9799 17.3638C13.9037 17.0344 14.7623 16.556 15.5318 15.9418C16.2938 15.3338 16.9469 14.6099 17.473 13.7906C18.0089 12.9558 18.398 12.0449 18.6295 11.083C18.7782 10.4649 18.3978 9.8433 17.7796 9.69458C17.1615 9.54586 16.54 9.92633 16.3912 10.5444C16.052 11.954 15.2368 13.2319 14.0958 14.1425C13.5257 14.5975 12.8902 14.9518 12.2067 15.1954C11.5004 15.4473 10.7579 15.5751 9.99979 15.5754C8.70283 15.5749 7.44888 15.1976 6.37341 14.4844C5.44598 13.8693 4.69477 13.0372 4.18074 12.0606H5.45301C6.08876 12.0606 6.60409 11.5453 6.60409 10.9096C6.60409 10.2738 6.08873 9.75849 5.45301 9.75849H1.15107C0.515351 9.75849 0 10.2738 0 10.9096V15.2701C0 15.9059 0.515351 16.4212 1.15107 16.4212Z" fill="white" />
                          </svg>
                    </button>
                </div>

                <aside class="content__aside aside">
                    <h3 class="aside__title">
                        Популярные новости
                    </h3>

                    <ul class="aside__list">
    <?php
   $args = array(
    'post_type'      => 'post',
    'posts_per_page' => -1, 
    'orderby'        => 'date',
    'order'          => 'DESC',
);

$query = new WP_Query($args);

$popular_articles = array();

if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();

        
        $is_popular = CFS()->get('article_popular');

        if ($is_popular) { 
            $popular_articles[] = array(
                'title' => get_the_title(),
                'link'  => get_permalink(),
                'date'  => get_the_date('j F Y'),
            );
        }

    endwhile;

    
    $popular_articles = array_slice($popular_articles, -3);

    foreach (array_reverse($popular_articles) as $article) {
        ?>
        <li class="aside__item">
            <a href="<?= esc_url($article['link']); ?>">
                <h4 class="aside__item-title"><?= esc_html($article['title']); ?></h4>
                <time class="aside__item-date date"><?= esc_html($article['date']); ?></time>
            </a>
        </li>
        <hr>
        <?php
    }

    wp_reset_postdata();
else :
    echo '<p>Нет доступных популярных статей</p>';
endif;

    ?>
</ul>

                    <div class="subscribe subscribe-container">
                        <h3 class="subscribe__title blog-title">Подписка на рассылку</h3>
                        <?php
                            $button_text = 'Подписаться';
                            $button_class = 'form-btn';

                            if (isset($_GET['subscribed'])) {
                                if ($_GET['subscribed'] === 'true') {
                                    $button_text = 'Вы подписаны!';
                                    $button_class .= ' form-btn--success';
                                } elseif ($_GET['subscribed'] === 'already') {
                                    $button_text = 'Вы уже подписаны!';
                                    $button_class .= ' form-btn--warning';
                                }
                            }
                        ?>
                            <form action="#" class="subscribe__form" method="POST">
                                <input type="email" class="subscribe__form-input form-input" placeholder="Email@gmail.com" name="email" required>
                                <button class="subscribe__form-btn btn-reset <?= esc_attr($button_class); ?>" type="submit">
                                    <span><?= esc_html($button_text); ?></span>
                                    <svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19.5857 8.85046L1.01474 0.279244C0.719033 0.144962 0.366184 0.22496 0.160475 0.479239C-0.046663 0.733519 -0.0538057 1.09494 0.143332 1.35636L6.25033 9.49902L0.143332 17.6417C-0.0538057 17.9031 -0.046663 18.2659 0.159046 18.5188C0.297614 18.6917 0.504752 18.7845 0.714747 18.7845C0.816173 18.7845 0.917599 18.7631 1.01331 18.7188L19.5843 10.1476C19.8386 10.0304 20 9.77758 20 9.49902C20 9.22045 19.8386 8.9676 19.5857 8.85046Z" fill="white" />
                                    </svg>
                                </button>
                            </form>

                    </div>
                </aside>
            </div>

        </section>
 <?php get_footer(); ?>