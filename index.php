<?php get_header(); ?>
<!-- <section class="first_section">
    <div class="cont">

        <div class="info">
            <div class="title">solodkofv.<span>ru</span></div>

            <div class="sub_title">блог о заработке в интернете </div>

            <div class="desc">Привет. Меня зовут Александр :) Я заработал свой первый миллион в сети к 19 годам. Многие задаются вопросом, как? Ответ ищите на моем ресурсе и в социальных сетях. Погнали!</div>
        </div>

        <div class="mob_socials">
            <div class="title">Поключайтесь ко мне в соц. сети</div>

            <div class="desc">Самая актуальная информация тут</div>

            <a href="/" target="_blank" rel="noopener nofollow">
                <img src="<?php bloginfo('template_url'); ?>/images/ic_soc1.png" alt="">
            </a>

            <a href="https://vk.com/footballsanyy" target="_blank" rel="noopener nofollow">
                <img src="<?php bloginfo('template_url'); ?>/images/ic_soc2.png" alt="">
            </a>

            <a href="https://www.instagram.com/solodkofv/" target="_blank" rel="noopener nofollow">
                <img src="<?php bloginfo('template_url'); ?>/images/ic_soc3.png" alt="">
            </a>
        </div>

        <div class="photo">
            <img src="<?php bloginfo('template_url'); ?>/images/first_section_photo.png" alt="" class="lozad">
        </div>

        <img src="<?php bloginfo('template_url'); ?>/images/bg_first_section2.png" alt="" class="img lozad">

    </div>

    <div class="bg lozad" data-background-image="<?php bloginfo('template_url'); ?>/images/bg_first_section.jpg"></div>

    <div class="lines">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</section> -->


<section class="promo_blocks">
    <div class="cont row">

        <div class="top5_sites">
            <div class="block_head center">
                <div class="title">топ 5 сайтов для заработка</div>
                <div class="sub_title">топ 5</div>
            </div>

            <div class="list">
                <?php $ids = get_field('page', "option"); ?>
                <?php 
                $query2 = new WP_Query(array(
                   'post__in'      => $ids,
                   'post_type' => 'page'
                ));
               $args = array( 'posts_per_page' => 5, 'cat' => 10);   $query1 = new WP_Query($args);
               $query = new WP_Query();  $query->posts = array_merge($query1->posts, $query2->posts); $query->post_count = count($query->posts);
                while($query->have_posts()) {$query->the_post(); ?> 
                <div class="item">
                    <div class="logo">
                        <img data-src="<?php the_field("logo"); ?>" alt="" class="lozad">
                    </div>

                    <div class="rating">
                        <div class="active"></div>
                        <div class="active"></div>
                        <div class="active"></div>
                        <div class="active"></div>
                        <div class="active"></div>
                    </div>

                    <div class="links">
                        <a href="<?php the_permalink(); ?>" class="review_link">обзор</a>
                        <a href="<?php the_field("link"); ?>" target="_blank" rel="noopener nofollow" class="site_link">сайт</a>
                    </div>
                </div>
                <?php } wp_reset_postdata(); ?>

            </div>

            <div class="all_link">
                <a href="https://solodkofv.ru/rejting/">Все сайты</a>
            </div>
        </div>


        <div class="subscribe">
            <div class="block_head">
                <div class="title">Подпишитесь на новые статьи</div>

                <div class="desc">Введите свой e-mail и будьте в курсе всех обновлений</div>
            </div>


            <form action="">
                <div class="line">
                    <div class="field">
                        <input type="email" name="email" value="" class="input required" placeholder="Ваш Email">
                    </div>
                </div>

                <div class="submit">
                    <button type="submit" class="submit_btn">отправить</button>
                </div>

                <div class="exp">Ваш Email не будет опубликован</div>

                <div class="bg lozad" data-background-image="<?php bloginfo('template_url'); ?>/images/bg_subscribe.jpg"></div>

                <img data-src="<?php bloginfo('template_url'); ?>/images/subscribe_img.png" alt="" class="img lozad">
            </form>


            <div class="socials">
                <div class="name">Давайте дружить</div>

                <a href="/" target="_blank" rel="noopener nofollow">
                    <img src="<?php bloginfo('template_url'); ?>/images/ic_soc1.png" alt="">
                </a>

                <a href="/" target="_blank" rel="noopener nofollow">
                    <img src="<?php bloginfo('template_url'); ?>/images/ic_soc2.png" alt="">
                </a>

                <a href="/" target="_blank" rel="noopener nofollow">
                    <img src="<?php bloginfo('template_url'); ?>/images/ic_soc3.png" alt="">
                </a>
            </div>
        </div>

    </div>
</section>


<section class="categories block">
    <div class="head">
        <div class="cont">
            <div class="title">Рубрики</div>
        </div>

        <div class="lines">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>

        <div class="bg lozad" data-background-image="<?php bloginfo('template_url'); ?>/images/bg_categories_head.jpg"></div>
    </div>


    <div class="cont">
        <div class="row">
            <a href="<?php echo get_category_link(1); ?>" class="cat">
                <div class="icon icon1">
                    <img data-src="<?php bloginfo('template_url'); ?>/images/ic_cat1.png" alt="" class="lozad">
                </div>
                <div class="name">Как заработать в<br> Вконтакте</div>
            </a>

            <a href="<?php echo get_category_link(2); ?>" class="cat">
                <div class="icon icon2">
                    <img data-src="<?php bloginfo('template_url'); ?>/images/ic_cat2.png" alt="" class="lozad">
                </div>
                <div class="name">Как заработать на<br> YouTube</div>
            </a>

            <a href="<?php echo get_category_link(3); ?>" class="cat">
                <div class="icon icon3">
                    <img data-src="<?php bloginfo('template_url'); ?>/images/ic_cat3.png" alt="" class="lozad">
                </div>
                <div class="name">Заработок в<br> Инстаграм</div>
            </a>

            <a href="<?php echo get_category_link(4); ?>" class="cat">
                <div class="icon icon4">
                    <img data-src="<?php bloginfo('template_url'); ?>/images/ic_cat4.png" alt="" class="lozad">
                </div>
                <div class="name">Как заработать денег<br> на Телефоне</div>
            </a>

            <a href="<?php echo get_category_link(5); ?>" class="cat">
                <div class="icon icon5">
                    <img data-src="<?php bloginfo('template_url'); ?>/images/ic_cat5.png" alt="" class="lozad">
                </div>
                <div class="name">Обзоры на сервисы и<br> Заработок</div>
            </a>

            <a href="<?php echo get_category_link(6); ?>" class="cat">
                <div class="icon icon6">
                    <img data-src="<?php bloginfo('template_url'); ?>/images/ic_cat6.png" alt="" class="lozad">
                </div>
                <div class="name">Заработок на<br> Написании</div>
            </a>

            <a href="<?php echo get_category_link(7); ?>" class="cat">
                <div class="icon icon7">
                    <img data-src="<?php bloginfo('template_url'); ?>/images/ic_cat7.png" alt="" class="lozad">
                </div>
                <div class="name">Заработок на<br> Ставках</div>
            </a>

            <a href="<?php echo get_category_link(8); ?>" class="cat">
                <div class="icon icon8">
                    <img data-src="<?php bloginfo('template_url'); ?>/images/ic_cat8.png" alt="" class="lozad">
                </div>
                <div class="name">Как зарабатывать на<br> сайтах</div>
            </a>

            <a href="<?php echo get_category_link(9); ?>" class="cat">
                <div class="icon icon9">
                    <img data-src="<?php bloginfo('template_url'); ?>/images/ic_cat9.png" alt="" class="lozad">
                </div>
                <div class="name">Лучшие сервисы для<br> Заработка в интернете</div>
            </a>
        </div>
    </div>
</section>


<section class="posts bg_block">
    <div class="cont">

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

    </div>
</section>


<section class="posts view2 block">
    <div class="head">
        <div class="cont">
            <div class="block_head center">
                <div class="title">популярные статьи</div>
                <div class="sub_title">интересное</div>
            </div>
        </div>
    </div>

    <div class="cont">
        <div class="row">
            <?php $k=0; $args = array( 'posts_per_page' => 4, 'orderby' => 'rand');   $query1 = new WP_Query($args);
            while($query1->have_posts()) {$query1->the_post();$k++; ?>   

            <div class="post">
                <div class="thumb">
                    <a href="<?php the_permalink(); ?>">
                        <img data-src="<?php echo tuts_custom_img('full', 263, 154);?>" alt="" class="lozad">
                    </a>
                </div>

                <div class="info">
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
            <?php  } wp_reset_postdata(); ?>                    

        </div>
    </div>
</section>

<?php get_footer(); ?>

