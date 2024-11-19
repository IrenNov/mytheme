<footer class="footer">
            <div class="container footer__container">
            <?php the_custom_logo( ); ?>
                <nav class="nav">
                    <ul class="nav__list">
                        <li class="nav__item">
                            <a href="<?php get_home_url(); ?>" class="nav__link current">Главная</a>
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
    
                    </ul>
                </nav>
                <small>ООО “Организация” 2020. Все права защищены</small>
            </div>
        </footer>
        
        <?php wp_footer(); ?>
</body>

</html>