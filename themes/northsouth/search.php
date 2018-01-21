<?php get_header(); ?>
<section>
    <?php if (have_posts()) : ?>
        <div class="posts">
            <?php while (have_posts()) : the_post(); ?>
                <article>
                    <h3><?php the_title() ?></h3>
                    <a href="#" class="image">
                        <?php if (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('featured-post-thumb'); ?>
                        <?php endif; ?>
                    </a>

                    <p><?php the_content() ?> </p>
                </article>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</section>
<?php get_footer() ?>
