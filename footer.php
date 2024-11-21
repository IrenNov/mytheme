<footer class="footer">
            <div class="container footer__container">
            <?php the_custom_logo( ); ?>
                <nav class="nav">
                <?php 
                wp_nav_menu([
                    'theme_location' => 'bottom', 
                    'container' => '', 
                    'container_class' => 'nav__list', 
                    'menu_class' => 'nav__list', 
                    'menu_id' => '', 
                ]);
                ?>
    
                </nav>
                <small>ООО “Организация” 2020. Все права защищены</small>
            </div>
        </footer>
        
        <?php wp_footer(); ?>
</body>

</html>