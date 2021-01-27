<?php $k=0;
$categories = get_the_category($post->ID);
if ($categories) {
	$category_ids = array();
	foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
 
		$args=array(
			'category__in' => $category_ids, 
			'post__not_in' => array($post->ID), //Не выводить текущую запись
			'showposts'=>3, // Указываем сколько похожих записей выводить
			'caller_get_posts'=>1
		);
		$my_query = new wp_query($args);
		if( $my_query->have_posts() ) {		?> 				 		

       <section class="posts view2 block">
                    <div class="block_head center">
                        <div class="title">Статьи по теме</div>
                    </div>

                    <div class="row">

		<?php 	while ($my_query->have_posts()) {
				$my_query->the_post(); $k++;		?>
			 <div class="post">
                <div class="thumb">
                    <a href="<?php the_permalink(); ?>">
                        <img data-src="<?php echo tuts_custom_img('full', 220, 130);?>" alt="" class="lozad">
                    </a>
                </div>

                <div class="info">
                    <div class="name">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </div>

                    <div class="desc"><?php the_content(""); ?></div>
                </div>
            </div>  				

		<?php     }?>     
   </div>
                </section>
<?php }  wp_reset_query(); } ?>


