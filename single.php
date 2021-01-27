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
                    <div class="head">
                        <div class="date"><?php the_time("d.m.Y") ?></div>
                        <div class="author">Александр солодков</div>

                        <img data-src="<?php echo tuts_custom_img('full', 720, 0);?>" alt="" class="lozad">

                        <div class="information">
                            <div class="information__author inform">
                                <div class="information__author-icon icon">
                                    <img src="<?php bloginfo('template_url'); ?>/images/post/author.png" alt="">
                                </div>
                                <div class="information__descript">
                                    <div class="information__descript-title">Aвтор</div>
                                    <div class="information__descript-text">Александр солодков</div>
                                </div>
                            </div>
                            <div class="information__time inform">
                                <div class="information__time-icon icon">
                                    <img src="<?php bloginfo('template_url'); ?>/images/post/time.png" alt="">
                                </div>
                                <div class="information__descript">
                                    <div class="information__descript-title">На чтение</div>
                                    <div class="information__descript-text"><?php echo gp_read_time(); ?> мин.</div>
                                </div>
                            </div>
                            <div class="information__viewing inform">
                                <div class="information__viewing-icon icon">
                                    <img src="<?php bloginfo('template_url'); ?>/images/post/viewing.png" alt="">
                                </div>
                                <div class="information__descript">
                                    <div class="information__descript-title">Просмотры</div>
                                    <div class="information__descript-text"><?php if(get_post_meta( $post->ID, 'views', true )) {echo get_post_meta( $post->ID, 'views', true ); } else {echo "0"; } ?></div>
                                </div>
                            </div>
                            <div class="information__rating inform">
                                <div class="information__rating-icon">
                                    <img src="<?php bloginfo('template_url'); ?>/images/post/star.png" alt="">
                                    <img src="<?php bloginfo('template_url'); ?>/images/post/star.png" alt="">
                                    <img src="<?php bloginfo('template_url'); ?>/images/post/star.png" alt="">
                                    <img src="<?php bloginfo('template_url'); ?>/images/post/star.png" alt="">
                                    <img src="<?php bloginfo('template_url'); ?>/images/post/star.png" alt="">                                             
                                </div>
                                <div class="information__rating-text">
                                    <?php echo rmp_get_avg_rating(); ?> / 5 
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="text_block">
                        <?php the_content(); ?>
                        <?php endwhile; endif?>
                        <?php echo do_shortcode("[ratemypost]"); ?>
                    </div>

                    <div class="share">
                        <div class="title">Понравилась статья? Поделитесь с друзьями!</div>

                        <script async src="https://usocial.pro/usocial/usocial.js?v=6.1.4" data-script="usocial" charset="utf-8"></script>
                        <div class="uSocial-Share" data-pid="8cefc772ee27a1bc7b8f2eac7012391b" data-type="share" data-options="round,style1,default,absolute,horizontal,size48,eachCounter0,counter0,nomobile" data-social="vk,fb,twi,ok,telegram"></div>
                    </div>
                </section>

                <?php include_once( 'related_posts.php' ); ?>                
                <?php comments_template(); ?>

            </section>

            <?php get_sidebar(); ?>

        </div>
    </section>
<?php get_footer(); ?>
