<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    
    <?php wp_head(); ?>
</head>

<body>
    <header class="header">
        <div class="container">
            <?php the_custom_logo( ); ?>
            <nav class="nav header__nav">
                <?php 
                wp_nav_menu([
                    'theme_location' => 'top', 
                    'container' => 'nav', 
                    'container_class' => 'nav__list', 
                    'menu_class' => 'nav__list', 
                    'menu_id' => '', 
                ]);
                ?>
                
                 <!-- <ul class="nav__list">
                    <li class="nav__item">
                        <a href="<?= get_home_url(); ?>" class="nav__link current">Главная</a>
                    </li>
                    <li class="nav__item">
                        <a href="#" class="nav__link">О нас</a>
                    </li>
                    <li class="nav__item">
                        <a href="#" class="nav__link">Контакты</a>
                    </li>
                    <li class="nav__item">
                        <a href="#" class="nav__link search-link">Поиск</a>
                    </li>

                </ul>  -->
            </nav>
            <a href="tel:+798788787" class="phone">
                <svg width="14" height="15" viewBox="0 0 14 15" fill="#5D71DD" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M13.6189 10.7746L11.6652 8.82085C10.9674 8.12308 9.7812 8.40222 9.50209 9.30928C9.29276 9.9373 8.595 10.2862 7.96701 10.1466C6.57148 9.79772 4.68752 7.98353 4.33863 6.51822C4.1293 5.89021 4.54796 5.19244 5.17595 4.98314C6.08305 4.70403 6.36215 3.51783 5.66439 2.82007L3.71064 0.866327C3.15243 0.377891 2.31511 0.377891 1.82668 0.866327L0.500926 2.19208C-0.824828 3.58761 0.640479 7.28576 3.91997 10.5653C7.19947 13.8448 10.8976 15.3799 12.2932 13.9843L13.6189 12.6586C14.1074 12.1003 14.1074 11.263 13.6189 10.7746Z"
                        fill="none" />
                </svg>
                +7 (987) 887-87
            </a>
            <div class="hamburger visible-mobile-s" id="hamburger">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
              </div>
        </div>
    </header>