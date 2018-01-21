<?php get_header(); ?>
<?php
$args = array(
    'category_name' => 'Tecnologia',
    'posts_per_page' => 1,
    'orderby' => 'rand',
);

$query = new WP_Query($args);

?>
<section id="banner">
    <?php if ($query->have_posts()): ?>
        <?php while ($query->have_posts()): $query->the_post() ?>
            <div class="content">
                <header>
                    <h1><?php echo get_the_title() ?></h1>
                </header>
                <p><?php the_content(); ?></p>
            </div>
            <span class="image object">
                <?php the_post_thumbnail('featured-post-thumb-feature', array('alt' => get_the_title())); ?>
            </span>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    <?php endif ?>
</section>
<!-- Banner -->


<!-- Section -->
<section>
    <?php if (have_posts()) : ?>
        <div class="posts">
            <?php while (have_posts()) : the_post(); ?>
                <article>
                    <a href="#" class="image">
                        <?php if (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('featured-post-thumb'); ?>
                        <?php endif; ?>
                    </a>
                    <h3><?php the_title() ?></h3>
                    <p><?php the_content() ?> </p>
                </article>
            <?php endwhile; ?>
        </div>
        <div><?php
            the_posts_pagination(array(
                'prev_text' => __('Previous page', 'northsouth'),
                'next_text' => __('Next page', 'northsouth'),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'northsouth') . ' </span>',
            ));

            ?></div>
    <?php endif; ?>
</section>


<?php get_footer() ?>
