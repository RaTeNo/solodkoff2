<?php
/*
Template Name: New
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


                <section class="money-internet">
                    <div class="money-internet__items">
                        <div class="money-internet__item money-internet__item1">
                            <div class="money-internet__item-title">заработать <br>вконтакте</div>
                            <div class="money-internet__item-link">
                                <a href="<?php echo get_category_link(1); ?>">узнать как</a>
                            </div>
                        </div>
                        <div class="money-internet__item money-internet__item2">
                            <div class="money-internet__item-title">Заработать <br>Youtube</div>
                            <div class="money-internet__item-link">
                                <a href="<?php echo get_category_link(2); ?>">узнать как</a>
                            </div>
                        </div>                              
                        <div class="money-internet__item money-internet__item3">
                            <div class="money-internet__item-title">заработать <br>instagram</div>
                            <div class="money-internet__item-link">
                                <a href="<?php echo get_category_link(3); ?>">узнать как</a>
                            </div>
                        </div>                              
                        <div class="money-internet__item money-internet__item4">
                            <div class="money-internet__item-title">заработать <br>тик ток</div>
                            <div class="money-internet__item-link">
                                <a href="<?php echo get_category_link(12); ?>">узнать как</a>
                            </div>
                        </div>                              
                        <div class="money-internet__item money-internet__item5">
                            <div class="money-internet__item-title">заработать <br>на ставках</div>
                            <div class="money-internet__item-link">
                                <a href="<?php echo get_category_link(7); ?>">узнать как</a>
                            </div>
                        </div>                              
                        <div class="money-internet__item money-internet__item6">
                            <div class="money-internet__item-title">заработать <br>на сайтах</div>
                            <div class="money-internet__item-link">
                                <a href="<?php echo get_category_link(9); ?>">узнать как</a>
                            </div>
                        </div>                              
                        <div class="money-internet__item money-internet__item7">
                            <div class="money-internet__item-title">заработать <br>на телефоне</div>
                            <div class="money-internet__item-link">
                                <a href="<?php echo get_category_link(4); ?>">узнать как</a>
                            </div>
                        </div>                              
                        <div class="money-internet__item money-internet__item8">
                            <div class="money-internet__item-title">заработать <br>на биржах</div>
                            <div class="money-internet__item-link">
                                <a href="<?php echo get_category_link(1); ?>">узнать как</a>
                            </div>
                        </div>                              
                        <div class="money-internet__item money-internet__item9">
                            <div class="money-internet__item-title">инвестиции</div>
                            <div class="money-internet__item-link">
                                <a href="<?php echo get_category_link(1); ?>">узнать как</a>
                            </div>
                        </div>                              
                        <div class="money-internet__item money-internet__item10">
                            <div class="money-internet__item-title">заработать <br>на криптовалюте</div>
                            <div class="money-internet__item-link">
                                <a href="<?php echo get_category_link(1); ?>">узнать как</a>
                            </div>
                        </div>
                    </div>
                </section>

            </section>

            <?php get_sidebar(); ?>

        </div>
    </section>
<?php get_footer(); ?>