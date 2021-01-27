<?php get_header(); ?>
<section class="content_flex block">
    <div class="cont row">

        <section class="content">
            <section class="page_head">
                <?php dimox_breadcrumbs(); ?>

                <h1 class="page_title"><?php single_cat_title(); ?></h1>
            </section>


            <section class="posts">
                <div class="row">
                    <?php  if ( have_posts() ) : while ( have_posts() ) : the_post();  ?>
                     <div class="post">
                        <div class="thumb">
                            <a href="<?php the_permalink(); ?>">
                                <img data-src="<?php echo tuts_custom_img('full', 350, 201);?>" alt="" class="lozad">
                            </a>

                            <div class="cat">
                                <?php the_category(', '); ?>
                            </div>
                        </div>

                        <div class="info">
                            <div class="date"><?php the_time("d.m.Y") ?></div>
                            <div class="author">Александр солодков</div>

                            <div class="name">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </div>

                            <div class="desc"><?php the_content(""); ?></div>

                            <a href="<?php the_permalink(); ?>#comments" class="add_comment_link">Оставить комментарий</a>

                            <a href="<?php the_permalink(); ?>#comments" class="comments_count">
                                <span class="icon"></span><?php comments_number("0", "1", "%"); ?>
                            </a>
                        </div>
                    </div>
                    <?php endwhile; else: ?><?php endif; ?>                 
                </div>


                <?php wp_corenavi(); ?>
            </section>
        </section>

        <?php get_sidebar(); ?>    
        

    </div>
</section>
<?php get_footer(); ?>
