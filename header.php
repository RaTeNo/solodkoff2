<!DOCTYPE html>
<html lang="ru-RU" prefix="og: http://ogp.me/ns# article: http://ogp.me/ns/article#  profile: http://ogp.me/ns/profile# fb: http://ogp.me/ns/fb#">
    <head>
		<meta name="yandex-verification" content="9678a6b476e600ca" />

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <!-- Адаптирование страницы для мобильных устройств -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <!-- Запрет распознования номера телефона -->
        <meta name="format-detection" content="telephone=no">
        <meta name="SKYPE_TOOLBAR" content ="SKYPE_TOOLBAR_PARSER_COMPATIBLE">

         <title><?php bloginfo('name'); ?><?php wp_title(); ?></title> 

        <!-- Традиционная иконка сайта, размер 16x16, прозрачность поддерживается. Рекомендуемый формат: .ico или .png -->
        <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/favicon.ico">

        <!-- Изменение цвета панели моб. браузера -->
        <meta name="msapplication-TileColor" content="#ff6f0f">
        <meta name="theme-color" content="#ff6f0f">

        <!-- Подключение шрифтов с гугла -->
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

        <!-- Подключение файлов стилей -->
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/styles.css">

        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/response_1179.css" media="(max-width: 1179px)">
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/response_1023.css" media="(max-width: 1023px)">
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/response_767.css" media="(max-width: 767px)">
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/response_479.css" media="(max-width: 479px)">
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/stylesnew.css">
        <?php wp_head(); ?>
		<meta name="google-site-verification" content="CqpjMkdajfuZM9V0laAtOC8PQrymm5dm_yXg3NxoTdo" />
    </head>

    <body>
        <div class="wrap">
            <div class="main">
                <header <?php if(is_front_page()) { ?> class="absolute11" <?php } ?>>
                    <div class="info">
                        <div class="cont row">

                            <a href="<?php bloginfo('siteurl'); ?>" class="logo">
                                <div>
                                    <div class="name">solodkofv.<span>ru</span></div>
                                    <div class="desc">блог о заработке в интернете</div>
                                </div>
                            </a>


                            <nav class="menu row">
                                <div class="menu-item">
                                    <a href="<?php bloginfo('siteurl'); ?>" class="active">Главная</a>
                                </div>

                                <div class="menu-item">
                                    <a href="<?php the_permalink(2); ?>">Об Авторе</a>
                                </div>

                                <div class="menu-item">
                                    <a href="<?php the_permalink(11); ?>">Содержание блога</a>
                                </div>
								
								  <div class="menu-item">
                                    <a href="https://solodkofv.ru/c-chego-nachat-zarabotok-v-internete/">С чего начать?</a>
                                </div>

                                <div class="menu-item">
                                    <a href="https://solodkofv.ru/rejting/">Сайты для ЗАРАБОТКА</a>
                                </div>
                            </nav>


                            <div class="search modal_cont">
                                <button class="btn mini_modal_link" data-modal-id="#search_modal">
                                    <img data-src="<?php bloginfo('template_url'); ?>/images/ic_search.svg" alt="" class="lozad">
                                </button>

                                <div class="mini_modal" id="search_modal">
                                    <form role="search"  method="get" id="searchform" action="<?php echo home_url( '/' ) ?>" >
                                        <input type="text" name="s" value="" class="input" placeholder="Поиск по блогу">

                                        <button type="submit" class="submit_btn">
                                            <img data-src="<?php bloginfo('template_url'); ?>/images/ic_search.svg" alt="" class="lozad">
                                        </button>

                                        <button type="button" class="close"></button>
                                    </form>
                                </div>
                            </div>


                            <button class="menu_btn">
                                <span></span>
                            </button>

                        </div>
                    </div>
                </header>


                <section id="menu">
                    <button class="close"></button>

                    <div class="search">
                        <form role="search"  method="get" id="searchform" action="<?php echo home_url( '/' ) ?>" >
                            <input type="text" name="s" value="" class="input" placeholder="Поиск по блогу">

                            <button type="submit" class="submit_btn">
                                <img data-src="<?php bloginfo('template_url'); ?>/images/ic_search.svg" alt="" class="lozad">
                            </button>
                        </form>
                    </div>

                    <?php wp_nav_menu ( array ( 'theme_location'  => 'header-menu',  
                        'menu'            => '',   
                        'container'       => '',   
                        'container_class' => '',   
                        'container_id'    => '',  
                        'menu_class'      => 'list',   
                        'menu_id'         => '',  
                        'echo'            => true,  
                        'fallback_cb'     => 'wp_page_menu',  
                        'before'          => '',  
                        'after'           => '',  
                        'link_before'     => '',  
                        'link_after'      => '',  
                        'depth'           => 0 ,
                        ) );  ?>     
                </section>
