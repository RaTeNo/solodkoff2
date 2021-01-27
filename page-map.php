<?php
/*
Template Name: Карта сайта
*/
?>
<?php get_header(); ?>
    <section class="content_flex block">
        <div class="cont row">

            <section class="content">
                <section class="page_head">
                    <?php dimox_breadcrumbs(); ?>

                    <h1 class="page_title"><?php the_title(); ?></h1>
                </section>


                <section class="post_info block">                  
                    <div class="text_block">
                        <?php map(); ?>
                        <h2>Страницы</h2>
                        <ul>
                            <?php
                            $myposts = get_posts('numberposts=-1&post_type=page&offset='.$debut);
                            foreach($myposts as $post) :
                              ?>
                                 <li class="sitemap"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        
                    </div>
                </section>

            </section>

            <?php get_sidebar(); ?>

        </div>
    </section>
<?php get_footer(); ?>