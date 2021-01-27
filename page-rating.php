<?php
/*
Template Name: Rating
*/
?>
<?php get_header(); ?>
    <section class="content_flex block">
        <div class="cont row">

            <section class="content">
                <section class="page_head">
                    <?php dimox_breadcrumbs(); ?>

                    <h1 class="page_title"><?php the_title(); ?></h1>

                    <div class="page_subtitle">рейтинг</div>
                    <div class="rating-navigation">
                        <ul class="rating-nav">                         
                            <?php $my_wp_query = new WP_Query(); $all_wp_pages = $my_wp_query->query(array('post_type' => 'page')); 
                            $children = get_page_children( 386, $all_wp_pages );?>
                            <li><a <?php if(is_page(386)) {?>class="active"<?php } ?> href="<?php the_permalink(386); ?>">Весь рейтинг</a></li>
                            <?php 
                            foreach ($children as $child) { 
                                 ?>
                                <li><a <?php if(get_the_ID()==$child->ID) {?>class="active"<?php } ?> href="<?php the_permalink($child->ID); ?>"><?php echo $child->post_title; ?></a></li> 
                            <?php } ?>
                        </ul>
                    </div>              

                </section>

                <section class="ratings">
                    <div class="rating-list">
                        <?php if( have_rows('rating') ): ?>                           
                            <?php while( have_rows('rating') ): the_row(); 
                                $logo = get_sub_field('logo');
                                $link1 = get_sub_field('link1');
                                $link2 = get_sub_field('link2');
                                $bonus = get_sub_field('bonus');
                                ?>  
                        <div class="rating__list">
                            <div class="rating-logo">
                                <img data-src="<?php echo $logo; ?>" alt="" class="lozad" >
                            </div>
                            <div class="rating-price"><?php echo $bonus; ?></div>
                            <div class="rating-links">
                                <a href="<?php echo $link1; ?>" class="rating-link">получить</a>
                                <a href="<?php echo $link2; ?>" target="_blank" class="rating-link-site">сайт</a>
                            </div>                                      
                        </div>
                        <?php endwhile; ?>                           
                        <?php endif; ?>
                    </div>
                </section>

                 <section class="post_info block">                  
                    <div class="text_block">
                        <?php  if ( have_posts() ) : while ( have_posts() ) : the_post();  ?>
                        <?php the_content(); ?>
                        <?php endwhile; endif?>
                    </div>
                </section>

            </section>

            <?php get_sidebar(); ?>

        </div>
    </section>
<?php get_footer(); ?>