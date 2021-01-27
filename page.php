<?php get_header(); ?>
<?php  if ( have_posts() ) : while ( have_posts() ) : the_post();  ?>
    <section class="content_flex block">
        <div class="cont row">

            <section class="content">
                <section class="page_head">
                    <?php dimox_breadcrumbs(); ?>

                    <h1 class="page_title"><?php the_title(); ?></h1>
                </section>


                <section class="post_info block">                  
                    <div class="text_block">
                        <?php the_content(); ?>
                        <?php endwhile; endif?>
                    </div>
                </section>

            </section>

            <?php get_sidebar(); ?>

        </div>
    </section>
<?php get_footer(); ?>