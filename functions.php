<?php
require 'vendor/autoload.php';
define('API_USER_ID', '5d359f117a7cad304c6fdd56c335bd5a');
define('API_SECRET', '2fa0a9824eee59314435a65e1ffadea1');
define('PATH_TO_ATTACH_FILE', __FILE__);

use Sendpulse\RestApi\ApiClient;
use Sendpulse\RestApi\Storage\FileStorage;


add_theme_support('menus');

add_theme_support( 'post-thumbnails' );
function peepsakes_custom_excerpt_length( $length ) {
	return 40;
}

function plural_form($number,$before) {
  $cases = array(2,0,1,1,1,2);
  echo $before[($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)]].'  '.$after[($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)]];
}

function artabr_opengraph_fix_yandex($lang) {
 $lang_prefix = 'prefix="og: http://ogp.me/ns# article: http://ogp.me/ns/article#  profile: http://ogp.me/ns/profile# fb: http://ogp.me/ns/fb#"';
 $lang_fix = preg_replace('!prefix="(.*?)"!si', $lang_prefix, $lang);
 return $lang_fix;
 }
add_filter( 'language_attributes', 'artabr_opengraph_fix_yandex',20,1);

add_filter( 'disable_wpseo_json_ld_search', '__return_true' );
remove_action('wp_head','feed_links_extra', 3); // ссылки на дополнительные rss категорий
remove_action('wp_head','feed_links', 2); //ссылки на основной rss и комментарии
remove_action('wp_head','rsd_link');  // для сервиса Really Simple Discovery
remove_action('wp_head','wlwmanifest_link'); // для Windows Live Writer
remove_action('wp_head','wp_generator');  // убирает версию wordpress

remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
 
// убираем разные ссылки при отображении поста - следующая, предыдущая запись, оригинальный url и т.п.
remove_action('wp_head','start_post_rel_link',10,0);
remove_action('wp_head','index_rel_link');
remove_action('wp_head','rel_canonical');
remove_action( 'wp_head','adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head','wp_shortlink_wp_head', 10, 0 );


add_filter('rest_enabled', '__return_false');
remove_action('xmlrpc_rsd_apis', 'rest_output_rsd');
remove_action('wp_head', 'rest_output_link_wp_head', 10, 0);
remove_action('template_redirect', 'rest_output_link_header', 11, 0);
remove_action('auth_cookie_malformed', 'rest_cookie_collect_status');
remove_action('auth_cookie_expired', 'rest_cookie_collect_status');
remove_action('auth_cookie_bad_username', 'rest_cookie_collect_status');
remove_action('auth_cookie_bad_hash', 'rest_cookie_collect_status');
remove_filter('rest_authentication_errors', 'rest_cookie_check_errors', 100);
remove_action('init', 'rest_api_init');
remove_action('parse_request', 'rest_api_loaded');
remove_action('rest_api_init', 'rest_api_default_filters', 10, 1);
remove_action('rest_api_init', 'wp_oembed_register_route');
remove_filter('rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4);
remove_action('auth_cookie_valid', 'rest_cookie_collect_status');

function new_excerpt_more2($more) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more2');


if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}

function my_revisions_to_keep( $revisions ) {
    return 0;
}
add_filter( 'wp_revisions_to_keep', 'my_revisions_to_keep' );


function new_excerpt_length($length) {
	return 10; }
add_filter('excerpt_length', 'new_excerpt_length');

function new_excerpt_more($excerpt) {
	return str_replace('[...]', '', $excerpt); }
add_filter('wp_trim_excerpt', 'new_excerpt_more');

register_sidebar(array(
	'name'=>'Sidebar',
	'before_widget' => '<div class="banner block">',
	'after_widget' => '</div>',
	'id' => 'left',
	'before_title' => '<div class="block_title">',
	'after_title' => '</div>',
));

function peepsakes_register_my_menus() 
{
    register_nav_menus
    (
        array( 'header-menu' => 'Header-menu', 'footer-menu' => 'Footer-menu', 'footer-menu-1' => 'footer-menu-1', 'footer-menu-2' => 'footer-menu-2', 'footer-menu-3' => 'footer-menu-3')
    );
}

/*function enqueue_comment_reply() {
		wp_enqueue_script('comment-reply');
}
add_action( 'wp_enqueue_scripts', 'enqueue_comment_reply' );
*/
if (function_exists('register_nav_menus'))
{
	add_action( 'init', 'peepsakes_register_my_menus' );
}

add_filter( 'the_content_more_link', 'peepsakes_my_more_link', 10, 2 );

function peepsakes_my_more_link( $more_link, $more_link_text ) {
	return str_replace( $more_link_text, "$more_link_text", $more_link_text );
}

function nofollow_ext($matches){
 $a = $matches[0];
 $site_url = site_url();
 if (strpos($a, 'rel') === false){
 $a = preg_replace("%(href=\S(?!$site_url))%i", 'rel="nofollow" $1', $a);
 } elseif (preg_match("%href=\S(?!$site_url)%i", $a)){
 $a = preg_replace('/rel=S(?!nofollow)\S*/i', 'rel="nofollow"', $a);
 }
 return $a;
}
 
function nofollow_ext_links($content) {
 return preg_replace_callback('/<a[^>]+/', 'nofollow_ext', $content);
}
 
add_filter('the_content', 'nofollow_ext_links');


function mytheme_comment($comment, $args, $depth){  
   $GLOBALS['comment'] = $comment; ?>  
            
        


                        <li class="comment"   id="comment-<?php comment_ID() ?>">
                            <div class="comment-body">
                                <div class="avatar color">
                                    <?php echo get_avatar( $comment, $size = '53'); ?>
                                    <!-- <div class="sticker author">Автор</div> -->
                                </div>

                                <div class="name"><?php $url = get_comment_author_url(); 
                                      $author = get_comment_author(); 
                                      $author = explode(" ", $author);  $author = explode("+", $author[0]); 
                                  $url = mb_substr($url, 7); ?><?php echo $author[0]; ?></div>

                                <div class="date"><?php comment_date('d.m.Y в H:i') ?></div>

                                <div class="text_block">
                                    <?php if ($comment->comment_approved == '0') : ?>
                                          <em>Ваш комментарий ожидает проверки.</em>
                                          <br />
                                        <?php endif; ?>
                                      <?php comment_text(); ?>
                                </div>

                                <?php   comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                            </div>

  						
<?php  
}  




/* Подсчет количества посещений страниц 
---------------------------------------------------------- */  
add_action('wp_head', 'kama_postviews');  
function kama_postviews() {  
  
/* ------------ Настройки -------------- */  
$meta_key       = 'views';  // Ключ мета поля, куда будет записываться количество просмотров.  
$who_count      = 1;            // Чьи посещения считать? 0 - Всех. 1 - Только гостей. 2 - Только зарегистрированых пользователей.  
$exclude_bots   = 1;            // Исключить ботов, роботов, пауков и прочую нечесть :)? 0 - нет, пусть тоже считаются. 1 - да, исключить из подсчета.  
/* СТОП настройкам */  
  
global $user_ID, $post;  
    if(is_singular()) {  
        $id = (int)$post->ID;  
        static $post_views = false;  
        if($post_views) return true; // чтобы 1 раз за поток  
        $post_views = (int)get_post_meta($id,$meta_key, true);  
        $should_count = false;  
        switch( (int)$who_count ) {  
            case 0: $should_count = true;  
                break;  
            case 1:  
                if( (int)$user_ID == 0 )  
                    $should_count = true;  
                break;  
            case 2:  
                if( (int)$user_ID > 0 )  
                    $should_count = true;  
                break;  
        }  
        if( (int)$exclude_bots==1 && $should_count ){  
            $useragent = $_SERVER['HTTP_USER_AGENT'];  
            $notbot = "Mozilla|Opera"; //Chrome|Safari|Firefox|Netscape - все равны Mozilla  
            $bot = "Bot/|robot|Slurp/|yahoo"; //Яндекс иногда как Mozilla представляется  
            if ( !preg_match("/$notbot/i", $useragent) || preg_match("!$bot!i", $useragent) )  
                $should_count = false;  
        }  
  
        if($should_count)  
            if( !update_post_meta($id, $meta_key, ($post_views+1)) ) add_post_meta($id, $meta_key, 1, true);  
    }  
    return true;  
}  


/** Функция для вывода записей по произвольному полю содержащему числовое значение. 
------------------------------------- 
Параметры передаваемые функции (в скобках дефолтное значение): 
num (10) - количество постов. 
key (views) - ключ произвольного поля, по значениям которого будет проходить выборка. 
order (DESC) - порядок вывода записей. Чтобы вывести сначала менее просматириваемые устанавливаем order=1 
format(0) - Формат выводимых ссылок. По дефолту такой: ({a}{title}{/a}). Можно использовать, например, такой: {date:j.M.Y} - {a}{title}{/a} ({views}, {comments}). 
days(0) - число последних дней, записи которых нужно вывести по количеству просмотров. Если указать год (2011,2010), то будут отбираться популярные записи за этот год. 
cache (0) - использовать кэш или нет. Варианты 1 - кэширование включено, 0 - выключено (по дефолту). 
echo (1) - выводить на экран или нет. Варианты 1 - выводить (по дефолту), 0 - вернуть для обработки (return). 
Пример вызова: kama_get_most_viewed("num=5 &key=views &cache=1 &format={a}{title}{/a} - {date:j.M.Y} ({views}) ({comments})"); 
*/  
function kama_get_most_viewed($args=''){  
    parse_str($args, $i);  
    $num    = isset($i['num']) ? $i['num']:10;  
    $key    = isset($i['key']) ? $i['key']:'views';  
    $order  = isset($i['order']) ? 'ASC':'DESC';  
    $cache  = isset($i['cache']) ? 1:0;  
    $days   = isset($i['days']) ? (int)$i['days']:0;  
    $echo   = isset($i['echo']) ? 0:1;  
    $format = isset($i['format']) ? stripslashes($i['format']):0;  
    global $wpdb,$post;  
    $cur_postID = $post->ID;  
  
    if( $cache ){ $cache_key = (string) md5( __FUNCTION__ . serialize($args) );  
        if ( $cache_out = wp_cache_get($cache_key) ){ //получаем и отдаем кеш если он есть  
            if ($echo) return print($cache_out); else return $cache_out;  
        }  
    }  
  
    if( $days ){  
        $AND_days = "AND post_date > CURDATE() - INTERVAL $days DAY";  
        if( strlen($days)==4 )  
            $AND_days = "AND YEAR(post_date)=" . $days;  
    }  
  
    $sql = "SELECT p.ID, p.post_title, p.post_date, p.guid, p.comment_count, (pm.meta_value+0) AS views  
    FROM $wpdb->posts p  
        LEFT JOIN $wpdb->postmeta pm ON (pm.post_id = p.ID)  
    WHERE pm.meta_key = '$key' $AND_days  
        AND p.post_type = 'post'  
        AND p.post_status = 'publish'  
    ORDER BY views $order LIMIT $num";  
    $results = $wpdb->get_results($sql);  
    if( !$results ) return false;  
  
    $out= '';  
    preg_match( '!{date:(.*?)}!', $format, $date_m );  
    foreach( $results as $pst ){  
        $x == 'li1' ? $x = 'li2' : $x = 'li1';  
        if ( (int)$pst->ID == (int)$cur_postID ) $x .= " current-item";  
        $Title = $pst->post_title;  
        $a1 = "<a href='". get_permalink($pst->ID) ."' title='{$pst->views} просмотров: $Title'>";  
        $a2 = "</a>";  
        $comments = $pst->comment_count;  
        $views = $pst->views;  
        if( $format ){  
            $date = apply_filters('the_time', mysql2date($date_m[1],$pst->post_date));  
            $Sformat = str_replace ($date_m[0], $date, $format);  
            $Sformat = str_replace(array('{a}','{title}','{/a}','{comments}','{views}'), array($a1,$Title,$a2,$comments,$views), $Sformat);  
        }  
        else $Sformat = $a1.$Title.$a2;  
        $out .= "<li>$Sformat</li>";  
    }  
  
    if( $cache ) wp_cache_add($cache_key, $out);  
  
    if( $echo )  
        return print $out;  
    else  
        return $out;  
}  


function wp_corenavi() {
  global $wp_query;
  $pages = '';
  $max = $wp_query->max_num_pages;
  if (!$current = get_query_var('paged')) $current = 1;
  $a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
  $a['total'] = $max;
  $a['current'] = $current;

  $total = 0; //1 - выводить текст "Страница N из N", 0 - не выводить
  $a['mid_size'] = 3; //сколько ссылок показывать слева и справа от текущей
  $a['end_size'] = 1; //сколько ссылок показывать в начале и в конце
  $a['prev_text'] = '<span></span>'; //текст ссылки "Предыдущая страница"
  $a['next_text'] = '<span></span>'; //текст ссылки "Следующая страница"

  if ($max > 1) echo '<div class="pagination">';
  if ($total == 1 && $max > 1) $pages = '<span class="pages">Страница ' . $current . ' из ' . $max . '</span>'."\r\n";
  $pa =  $pages . paginate_links($a);

  $pa = str_replace("page/1/", "", $pa);
  echo $pa;
  if ($max > 1) echo '</div>';
}


function dimox_breadcrumbs() {

  /* === ОПЦИИ === */
  $text['home'] = 'Главная'; // текст ссылки "Главная"
  $text['category'] = '%s'; // текст для страницы рубрики
  $text['search'] = ''; // текст для страницы с результатами поиска
  $text['tag'] = 'Записи с тегом "%s"'; // текст для страницы тега
  $text['author'] = 'Статьи автора %s'; // текст для страницы автора
  $text['404'] = 'Ошибка 404'; // текст для страницы 404
  $text['page'] = 'Страница %s'; // текст 'Страница N'
  $text['cpage'] = 'Страница комментариев %s'; // текст 'Страница комментариев N'

  $wrap_before = '<div class="breadcrumbs">'; // открывающий тег обертки
  $wrap_after = '</div><!-- .breadcrumbs -->'; // закрывающий тег обертки
  $sep =  '<span class="sep"></span>'; // разделитель между "крошками"
  $sep_before = ''; // тег перед разделителем
  $sep_after = ''; // тег после разделителя
  $show_home_link = 1; // 1 - показывать ссылку "Главная", 0 - не показывать
  $show_on_home = 0; // 1 - показывать "хлебные крошки" на главной странице, 0 - не показывать
  $show_current = 0; // 1 - показывать название текущей страницы, 0 - не показывать
  $before = ''; // тег перед текущей "крошкой"
  $after = ''; // тег после текущей "крошки"
  /* === КОНЕЦ ОПЦИЙ === */

  global $post;
  $home_link = home_url('/');
  $link_before = '';
  $link_after = '';
  $link_attr = ' itemprop="url"';
  $link_in_before = '';
  $link_in_after = '';
  $link = $link_before . '<a href="%1$s"' . $link_attr . '>' . $link_in_before . '%2$s' . $link_in_after . '</a>' . $link_after;
  $frontpage_id = get_option('page_on_front');
  $parent_id = $post->post_parent;
  $sep = ' ' . $sep_before . $sep . $sep_after . ' ';

  if (is_home() || is_front_page()) {

    if ($show_on_home) echo $wrap_before . '<a href="' . $home_link . '" class="home">' . $text['home'] . '</a>' . $wrap_after;

  } else {

    echo $wrap_before;
    if ($show_home_link) echo sprintf($link, $home_link, $text['home']);

    if ( is_category() ) {
      $cat = get_category(get_query_var('cat'), false);
      if ($cat->parent != 0) {
        $cats = get_category_parents($cat->parent, TRUE, $sep);
        $cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
        $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
        if ($show_home_link) echo $sep;
        echo $cats;
      }
      if ( get_query_var('paged') ) {
        $cat = $cat->cat_ID;
        echo $sep . sprintf($link, get_category_link($cat), get_cat_name($cat)) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
      } else {
        if ($show_current) echo $sep . $before . sprintf($text['category'], single_cat_title('', false)) . $after;
      }

    } elseif ( is_search() ) {
      if (have_posts()) {
        if ($show_home_link && $show_current) echo $sep;
        if ($show_current) echo $before . sprintf($text['search'], get_search_query()) . $after;
      } else {
        if ($show_home_link) echo $sep;
        echo $before . sprintf($text['search'], get_search_query()) . $after;
      }

    } elseif ( is_day() ) {
      if ($show_home_link) echo $sep;
      echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $sep;
      echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F'));
      if ($show_current) echo $sep . $before . get_the_time('d') . $after;

    } elseif ( is_month() ) {
      if ($show_home_link) echo $sep;
      echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y'));
      if ($show_current) echo $sep . $before . get_the_time('F') . $after;

    } elseif ( is_year() ) {
      if ($show_home_link && $show_current) echo $sep;
      if ($show_current) echo $before . get_the_time('Y') . $after;

    } elseif ( is_single() && !is_attachment() ) {
      if ($show_home_link) echo $sep;
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        printf($link, $home_link . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
        if ($show_current) echo $sep . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, $sep);
        if (!$show_current || get_query_var('cpage')) $cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
        $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
        echo $cats;
        if ( get_query_var('cpage') ) {
          echo $sep . sprintf($link, get_permalink(), get_the_title()) . $sep . $before . sprintf($text['cpage'], get_query_var('cpage')) . $after;
        } else {
          if ($show_current) echo $before . get_the_title() . $after;
        }
      }

    // custom post type
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      if ( get_query_var('paged') ) {
        echo $sep . sprintf($link, get_post_type_archive_link($post_type->name), $post_type->label) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
      } else {
        if ($show_current) echo $sep . $before . $post_type->label . $after;
      }

    } elseif ( is_attachment() ) {
      if ($show_home_link) echo $sep;
      $parent = get_post($parent_id);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      if ($cat) {
        $cats = get_category_parents($cat, TRUE, $sep);
        $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
        echo $cats;
      }
      printf($link, get_permalink($parent), $parent->post_title);
      if ($show_current) echo $sep . $before . get_the_title() . $after;

    } elseif ( is_page() && !$parent_id ) {
      if ($show_current) echo $sep . $before . get_the_title() . $after;

    } elseif ( is_page() && $parent_id ) {
      if ($show_home_link) echo $sep;
      if ($parent_id != $frontpage_id) {
        $breadcrumbs = array();
        while ($parent_id) {
          $page = get_page($parent_id);
          if ($parent_id != $frontpage_id) {
            $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
          }
          $parent_id = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        for ($i = 0; $i < count($breadcrumbs); $i++) {
          echo $breadcrumbs[$i];
          if ($i != count($breadcrumbs)-1) echo $sep;
        }
      }
      if ($show_current) echo $sep . $before . get_the_title() . $after;

    } elseif ( is_tag() ) {
      if ( get_query_var('paged') ) {
        $tag_id = get_queried_object_id();
        $tag = get_tag($tag_id);
        echo $sep . sprintf($link, get_tag_link($tag_id), $tag->name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
      } else {
        if ($show_current) echo $sep . $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
      }

    } elseif ( is_author() ) {
      global $author;
      $author = get_userdata($author);
      if ( get_query_var('paged') ) {
        if ($show_home_link) echo $sep;
        echo sprintf($link, get_author_posts_url($author->ID), $author->display_name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
      } else {
        if ($show_home_link && $show_current) echo $sep;
        if ($show_current) echo $before . sprintf($text['author'], $author->display_name) . $after;
      }

    } elseif ( is_404() ) {
      if ($show_home_link && $show_current) echo $sep;
      if ($show_current) echo $before . $text['404'] . $after;

    } elseif ( has_post_format() && !is_singular() ) {
      if ($show_home_link) echo $sep;
      echo get_post_format_string( get_post_format() );
    }

    echo $wrap_after;

  }
} // end of dimox_breadcrumbs()


function sp_top_commentator(){
    global $wpdb;
    $length = 0;        // Максимальная длинна имени в символах, если стоит 0, то имя не обрезается   
    $comment = true;    // показывать количество комментариев   
    $avatarSize = 70;   // размер аватара
    $blog_email_admin = get_bloginfo('admin_email');
    $blog_email_admin2 = get_bloginfo('template_url'); 
    $results = $wpdb->get_results('
        SELECT
            COUNT(comment_author_email) AS comments_count, comment_author_email, comment_author, comment_author_url
        FROM
            (select * from '.$wpdb->comments.' order by comment_ID desc) as pc
        WHERE
            comment_author_email != "" AND  comment_author_email != "'.$blog_email_admin.'" AND
            comment_type = "" AND
            comment_approved = 1  AND month(comment_date) = month(now()) AND year(comment_date) = year(now())
       GROUP BY
            comment_author_email
        ORDER BY
            comments_count DESC
        LIMIT 9'
    );

    $output = "";
    $i = 0;
	 
    foreach($results as $result){
								$url = $result->comment_author_url;
								$url = mb_substr($url, 7);	
								$author = $result->comment_author; 
								$author = explode(" ", $author);	
								$author = explode("+", $author[0]);	
								if($url){ $i++;
								 $output .= '	
                           

                          <div class="item">
                              <div class="foto">
                                '.get_avatar($result->comment_author_email,$avatarSize).'

                                <div class="count">'.$result->comments_count.'</div>
                              </div>

                              <div class="name">'.$author[0].'</div>
                            </div>


                         

												';	
								} else {
									$output .= ' 
                            <div class="item">
                              <div class="foto">
                                '.get_avatar($result->comment_author_email,$avatarSize).'

                                <div class="count">'.$result->comments_count.'</div>
                              </div>

                              <div class="name">'.$author[0].'</div>
                            </div>

												';	
								}
				
    }   
    echo $output;
}


/* замена ссылок на боки span */
function replaсe_link($content) {
 $pattern = '/\[urlspan\](.*?)<a (.*?)href=[\"\']([a-zA-Z]+:\/\/)?(.*?)[\"\'](.*?)>(.*?)<\/a>(.*?)\[\/urlspan\]/i';
 $content = preg_replace($pattern, "$1<span class='spanlink' onclick=\"GoTo('_$4')\"><span>$6</span></span>$7", $content);
 return $content;
}
add_filter('the_content', 'replaсe_link');

require_once(TEMPLATEPATH . '/urlspan/urlspan.php');


/*Новая аватарка*/
add_filter( 'avatar_defaults', 'newgravatar' ); 
function newgravatar ($avatar_defaults) {
    $myavatar = get_bloginfo('template_directory') . '/images/avatar-example.png';
    $avatar_defaults[$myavatar] = "wwwa";
    return $avatar_defaults;
}



// Задаем новое расположение изображений по-умолчанию
function classic_smilies_src( $old, $img ) {
	$mythemes = get_template();
	return site_url( "/wp-content/themes/$mythemes/Julianus/{$img}", __FILE__ );
}
 
// Возвращаем сопоставление символов файлам
add_action( 'init', 'classic_smilies_init', 1 );
function classic_smilies_init() {
	global $wpsmiliestrans;
	$wpsmiliestrans = array(
  ':p'        => '20x20-adore.png',
                                                  ':-p'        => '20x20-after_boom.png',  
                                                    '8)'        => '20x20-ah.png',
                                                  '8-)'        => '20x20-amazed.png', 
                                                  ':lang:'      => '20x20-angry.png',
                                                    ':lol:'      => '20x20-bad_smelly.png',
                                                          ':-pp'        => 'smile1.png',  

	);
	add_filter( 'smilies_src', 'classic_smilies_src', 10, 2 );
 
// Отключаем загрузку скриптов и стилей Emoji
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );	
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
add_filter( 'tiny_mce_plugins', 'classic_smilies_rm_tinymce_emoji' );
add_filter( 'the_content', 'classic_smilies_rm_additional_styles', 11 );
add_filter( 'the_excerpt', 'classic_smilies_rm_additional_styles', 11 );
add_filter( 'comment_text', 'classic_smilies_rm_additional_styles', 21 );
}
 
// Отключаем Emoji в визуальном редакторе TinyMCE
function classic_smilies_rm_tinymce_emoji( $plugins ) {
	return array_diff( $plugins, array( 'wpemoji' ) );
}
 
// Убираем размеры смайликов равные 1em (новые задаются для класса .wp-smiley)
function classic_smilies_rm_additional_styles( $content ) {
	return str_replace( 'class="wp-smiley" style="height: 1em; max-height: 1em;"', 'class="wp-smiley"', $content );
}

function searchExcludePages($query) {
	if ($query->is_search) {
		$query->set('post_type', 'post');
	}
 
	return $query;
}
 
add_filter('pre_get_posts','searchExcludePages');


function micro_image($content) {
global $post;
$pattern = "<img";
$replacement = '<img itemprop="image"';
$content = str_replace($pattern, $replacement, $content);
return $content;
}

add_filter('the_content', 'micro_image');


function wp_comments_corenavi() {
  $pages = '';
  $max = get_comment_pages_count();
  $page = get_query_var('cpage');
  if (!$page) $page = 1;
  $a['current'] = $page;
  $a['echo'] = false;

  $total = 0; //1 - выводить текст "Страница N из N", 0 - не выводить
  $a['mid_size'] = 3; //сколько ссылок показывать слева и справа от текущей
  $a['end_size'] = 1; //сколько ссылок показывать в начале и в конце
  $a['prev_text'] = ''; //текст ссылки "Предыдущая страница"
  $a['next_text'] = ''; //текст ссылки "Следующая страница"

  if ($max > 1) echo '<div class="pagination">';
  if ($total == 1 && $max > 1) $pages = '<span class="pages">Страница ' . $page . ' из ' . $max . '</span>'."\r\n";
  echo $pages . paginate_comments_links($a);
  if ($max > 1) echo '</div>';
}

/*Подключаем файлик виджетов*/

require_once('widget/widget.php');

function map($cat_id=0){
	$cats = get_categories("parent=$cat_id&hierarchical=false"); 
	if($cats)
	{
		if($cat_id!=0){
			echo "<div class='sub_category'>";
		}	
		foreach ($cats as $cat) 
		{ 												
			echo '<p><strong>Категория:</strong> <a class="title_cat" href="'.get_category_link($cat->cat_ID).'">'.$cat->cat_name.'</a><br></p>';
			$args = array( 'posts_per_page' => -1, 'category__in' => $cat->cat_ID);   $query1 = new WP_Query($args);
			while($query1->have_posts()) {$query1->the_post();
				echo '<p><a href="'.get_permalink().'">'.get_the_title().'</a></p>';
			 } wp_reset_postdata(); 			
			echo "<br>";												
			map($cat->cat_ID);
		}
		if($cat_id!=0){
			echo "</div>";
		}	
	}
	
}

add_action('admin_menu', 'peepsakes_add_global_custom_options');

function peepsakes_add_global_custom_options()
	{
		
		add_submenu_page( 'options-general.php', 'Дополнительные настройки', 'Дополнительные настройки', 'manage_options', 'my-custom-submenu-page', 'peepsakes_global_custom_options' );
	}

function peepsakes_global_custom_options()
{
?>
	<div class="wrap">
		<h2>Опции</h2>
		
		
		<form method="post" action="options.php">
			<?php wp_nonce_field('update-options') ?>			
			<p><strong>Баннеры</strong></p>
			<p>Вcтавьте код баннера</p>			
			<p><textarea value="" name="banner" rows="10" cols="100"><?php echo get_option('banner'); ?></textarea>

			<p>&nbsp;</p>

    		<p><input type="submit" name="Submit" value="Сохранить" /></p>
			<input type="hidden" name="action" value="update" />
			<input type="hidden" name="page_options" value="banner" />
			
		</form>
	</div>
<?php
}


require_once('BFI_Thumb.php'); 




function tuts_custom_img( $thumb_size, $image_width, $image_height ) {  
    global $post, $posts;
    $params = array(
        'width' => $image_width,
        'height' => $image_height
    );

    $imgsrc = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID, '') , $thumb_size);

    if ($imgsrc)
    {
        $custom_img_src = bfi_thumb($imgsrc[0], $params);
    }
    else
    {
        $first_img = '';
        ob_start();
        ob_end_clean();
        $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches); // выдираем первый имагес
        $first_img = $matches[1][0];

        if (empty($first_img))
        { 
			$template_url  = get_bloginfo("template_url");
            $custom_img_src = $template_url."/images/default.jpg";
        }
        else
        {
            $custom_img_src = bfi_thumb($first_img, $params);
        }

    }
    return $custom_img_src;    
}

add_action( 'wp_enqueue_scripts', 'my_scripts_method' );
function my_scripts_method() {
	// отменяем зарегистрированный jQuery
	wp_deregister_script('jquery-core');
	wp_deregister_script('jquery');

	// регистрируем
	wp_register_script('jquery-core', '//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js', false, null, true);
	wp_register_script('jquery', false, array('jquery-core'), null, true);

	// подключаем
	wp_enqueue_script( 'jquery' );
}    

 /* ноиндекс страницы пагинации */
function my_meta_noindex () {
		if (
			is_paged() // Все и любые страницы пагинации
		) {echo "".'<meta name="robots" content="noindex,nofollow" />'."\n";}
	}
add_action('wp_head', 'my_meta_noindex', 3); //



/*Обработка контактной формы */

add_action( 'wp_enqueue_scripts', 'myajax_data', 99 );
function myajax_data(){

	wp_localize_script('jquery', 'myajax', 
		array(
			'url' => admin_url('admin-ajax.php')
		)
	);  
}

add_action('wp_ajax_my_action', 'my_action_callback');
add_action('wp_ajax_nopriv_my_action', 'my_action_callback');
function my_action_callback() {
	
$is_valid = apply_filters('google_invre_is_valid_request_filter', true);
if(!$is_valid )
{

}
else
{
        $from          = 'no-repeat@mail.com';
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $comments = trim($_POST['comment']);
        $title = trim($_POST['title']);
        
        //$emailTo = get_option("admin_email"); 
        $emailTo = "rateno@mail.ru"; 
       
        $subject = "Сообщение с сайта с темой: ".$title;
        $body = "Имя: $name \n\nE-mail: $email \n\nСообщение: $comments";
        $headers = 'From: '.$name.' <'.$from.'>' . "\r\n" . 'Reply-To: ' . $email;
        $emailSent =  wp_mail($emailTo, $subject, $body, $headers); 

        if($emailSent == true){
            echo 1; //Ваша заявка принята. Менеджер свяжется с Вами в ближайшее время.
        }
        else
        {
            echo 2; //Сообщение не отправлено...
        }
}		    

	// выход нужен для того, чтобы в ответе не было ничего лишнего, только то что возвращает функция
	wp_die();
}



function prefix_send_email_to_admin() {
   $is_valid = apply_filters('google_invre_is_valid_request_filter', true);
   if(!$is_valid )
   {

   }
   else
   {
          $from          = 'no-repeat@mail.com';
          $name = trim($_POST['contactForm_name']);
          $email = trim($_POST['contactForm_email']);
          $comments = trim($_POST['contactForm_comment']);
          $title = trim($_POST['contactForm_title']);
          $url = trim($_POST['url']);
          
          $emailTo = get_option("admin_email"); 
          //$emailTo = "rateno@mail.ru"; 
         
          $subject = "Сообщение с сайта с темой: ".$title;
          $body = "Имя: $name \n\nE-mail: $email \n\nСообщение: $comments";
          $headers = 'From: '.$name.' <'.$from.'>' . "\r\n" . 'Reply-To: ' . $email;
          $emailSent =  wp_mail($emailTo, $subject, $body, $headers); 

          if($emailSent == true){
             // echo 1; //Ваша заявка принята. Менеджер свяжется с Вами в ближайшее время.
          }
          else
          {
              //echo 2; //Сообщение не отправлено...
          }
   }   
   wp_redirect($url.'?success=true');
   //wp_die();    
}
add_action( 'admin_post_nopriv_contact_form', 'prefix_send_email_to_admin' );
add_action( 'admin_post_contact_form', 'prefix_send_email_to_admin' );


/* Добавляем адаптивный контейнер для видео */
function alx_embed_html( $html ) {
return '<div class="video-container">' . $html . '</div>';
}
add_filter( 'embed_oembed_html', 'alx_embed_html', 10, 3 );
add_filter( 'video_embed_html', 'alx_embed_html' ); // Поддержка Jetpack



// canonical для пагинации
function return_canon () {
	$canon_page = get_pagenum_link(0);
	return $canon_page;
}
 
function canon_paged() {
	if (is_paged()) {
		add_filter( 'wpseo_canonical', 'return_canon' );
	}
} 
add_filter('wpseo_head','canon_paged');

function wpshop_enqueue_plugin_scripts( $plugin_array ) {
    //enqueue TinyMCE plugin script with its ID.
    $plugin_array["blockquote_button_plugin"] =  get_template_directory_uri() . '/js/tinymce-plugin.js';
    return $plugin_array;
}
add_filter("mce_external_plugins", "wpshop_enqueue_plugin_scripts");

function wpshop_register_buttons_editor( $buttons ) {
    //register buttons with their id.
    array_push(
        $buttons,
        //'col_6',
        //'col_4',
        'blockquote_warning',
        'blockquote_info',
        'blockquote_danger',
        'blockquote_check',
        'blockquote_quote'
    );
    return $buttons;
}
add_filter("mce_buttons_3", "wpshop_register_buttons_editor");


function root_add_editor_style() {
    add_editor_style( 'css/editor-styles.min.css' );
}
add_action( 'current_screen', 'root_add_editor_style' );




function misha_my_load_more_scripts() {
 
  global $wp_query;  
  wp_enqueue_script('jquery');
  wp_localize_script( 'jquery', 'misha_loadmore_params', array(
    'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', 
    'posts' => json_encode( $wp_query->query_vars ), 
    'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
    'max_page' => $wp_query->max_num_pages
  )); 
  wp_enqueue_script( 'my_loadmore' );
}
 
add_action( 'wp_enqueue_scripts', 'misha_my_load_more_scripts' );                  


function misha_loadmore_ajax_handler(){ 
  $args = json_decode( stripslashes( $_POST['query'] ), true );
  $args['paged'] = $_POST['page'] + 1; 
  $args['post_status'] = 'publish'; 
  query_posts( $args );
 
  if( have_posts() ) : 
    while( have_posts() ): the_post(); 
      get_template_part( 'all-type');  
    endwhile; 
  endif;
  die; 
} 
 
add_action('wp_ajax_loadmore', 'misha_loadmore_ajax_handler'); 
add_action('wp_ajax_nopriv_loadmore', 'misha_loadmore_ajax_handler'); 




add_action('wp_ajax_my_action2', 'my_action_callback2');
add_action('wp_ajax_nopriv_my_action2', 'my_action_callback2');
function my_action_callback2() {	
  	   $SPApiClient = new ApiClient(API_USER_ID, API_SECRET, new FileStorage());
          $bookID = 1924311;
          $emails = array(
    			array(
    				'email' => $_POST['email'],
            'variables' => array(
                'name' => $_POST['email'],
            )    				  
    			)
    		);
        $additionalParams = array(
           'confirmation' => 'force',
           'sender_email' => 'admin@solodkofv.ru',
        );
       
        $SPApiClient->addEmails($bookID, $emails, $additionalParams);
      	wp_die();
}

if ( ! function_exists( 'gp_read_time' ) ) {
  function gp_read_time() {
    $text = get_the_content( '' );
    $words = str_word_count( strip_tags( $text ), 0, 'абвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ' );
    if ( !empty( $words ) ) {
    $time_in_minutes = ceil( $words / 200 );
    return $time_in_minutes;
    }
  return false;
  }
}

add_shortcode( 'button', 'baztag_func' );
function baztag_func( $atts, $content ) {
    return '<div class="text_link">'.$content.'</div>';
}



function bonus_new_func( $atts ){    
    ob_start(); ?>
    <section class="ratings">
        <div class="rating-list">                
    <?php while( have_rows('bonus', 'option') ): the_row(); 
        $rating = get_sub_field('rating');
        $name = get_sub_field('name');       
        if($atts['name']==$name)
        { ?>

            <?php foreach ($rating as $item): ?>
            <div class="rating__list">
                <div class="rating-logo">
                    <img data-src="<?php echo $item["logo"]; ?>" alt="" class="lozad" >
                </div>
                <div class="rating-price"><?php echo $item["bonus"]; ?></div>
                <div class="rating-links">
                    <a href="<?php echo $item["link1"]; ?>" class="rating-link">получить</a>
                    <a href="<?php echo $item["link2"]; ?>" target="_blank" class="rating-link-site">сайт</a>
                </div>                                      
            </div>
            <?php endforeach ?>            
        <?php }  
    endwhile;  ?>  
    </div>
    </section>
    <?php return ob_get_clean();   
}
add_shortcode('bonus', 'bonus_new_func');  