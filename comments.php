
                <?php if ( have_comments() ) : ?>
                <section class="comments block" id="comments">
                    <div class="block_title">Комментариев к статье (<?php comments_number("0", "1", "%"); ?>)</div>

                    <ul class="commentlist">
                         <?php wp_list_comments('type=comment&callback=mytheme_comment&style=ul'); ?> 
                    </ul>
                </section>
                <?php else :  ?>                       
                <?php endif; ?>

                <?php if ('open' == $post->comment_status) : ?>
                <section id="respond" class="comment-respond">
                    <div class="block_title">Оставить комментарий <span><?php cancel_comment_reply_link("Отменить ответ"); ?></span></div>

                    <form id="commentform" class="comment-form form" method="post" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php">
                        <div class="columns row">
                            <div class="line width1of3">
                                <div class="field">
                                    <input type="text" name="author" value="" class="input" placeholder="Ваше имя *">
                                </div>
                            </div>

                            <div class="line width1of3">
                                <div class="field">
                                    <input type="email" name="email" value="" class="input" placeholder="Email">
                                </div>
                            </div>

                            <div class="line width1of3">
                                <div class="field">
                                    <input type="url" name="url" value="" class="input" placeholder="Сайт">
                                </div>
                            </div>

                            <div class="line width3of3">
                                <div class="field">
                                    <textarea id="comment" class="comment-form" tabindex="1" aria-required="true" name="comment" placeholder="Комментарий:"></textarea>
                                </div>
                            </div>

                           <!--  <div class="line subscribe">
                               <div class="field">
                                   <input type="checkbox" name="subscribe" id="subscribe_check" checked>
                                   <label for="subscribe_check">Хочу получать обновления на почту</label>
                               </div>
                           </div>
                           
                           <div class="line smiles">
                               <div class="field">
                                   <img src="images/tmp/smiles.png" alt="">
                               </div>
                           </div> -->
                        </div>


                        <div class="submit">
                            <button type="submit" class="submit_btn">ОТПРАВИТЬ</button>
                        </div>
                        <?php comment_id_fields(); ?> <?php do_action('comment_form', $post->ID); ?>
                    </form>
                </section>   
                <?php else : // comments are closed ?>                            
                <?php endif; ?>         
