<div id="sidebar">
    <div class="inner">

        <!-- Search -->
        <section id="search" class="alt">

            <?php get_search_form() ?>
        </section>

        <?php if (has_nav_menu('primary')) : ?>
            <nav id="menu">
                <header class="major">
                    <h2>Menu</h2>
                </header>
                <?php
                wp_nav_menu(array(
                    'menu_class' => 'nav-menu',
                    'container' => false,
                    'theme_location' => 'primary',
                ));
                ?>
            </nav><!-- .main-navigation -->
        <?php endif; ?>
        <!-- Menu -->


        <!-- Section -->
        <section>
            <header class="major">
                <h2>Ante interdum</h2>
            </header>
            <div class="mini-posts">
                <article>
                    <a href="#" class="image"><img src="images/pic07.jpg" alt="" /></a>
                    <p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore aliquam.</p>
                </article>
                <article>
                    <a href="#" class="image"><img src="images/pic08.jpg" alt="" /></a>
                    <p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore aliquam.</p>
                </article>
                <article>
                    <a href="#" class="image"><img src="images/pic09.jpg" alt="" /></a>
                    <p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore aliquam.</p>
                </article>
            </div>
            <ul class="actions">
                <li><a href="#" class="button">More</a></li>
            </ul>
        </section>

        <!-- Section -->
        <section>
            <header class="major">
                <h2>Get in touch</h2>
            </header>
            <p>Sed varius enim lorem ullamcorper dolore aliquam aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin sed aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
            <ul class="contact">
                <li class="fa-envelope-o"><a href="#">information@untitled.tld</a></li>
                <li class="fa-phone">(000) 000-0000</li>
                <li class="fa-home">1234 Somewhere Road #8254<br />
                    Nashville, TN 00000-0000</li>
            </ul>
        </section>

        <!-- Footer -->
        <footer id="footer">
            <p class="copyright">&copy; Untitled. All rights reserved. Demo Images: <a href="https://unsplash.com">Unsplash</a>. Design: <a href="https://html5up.net">HTML5 UP</a>.</p>
        </footer>

    </div>
</div>