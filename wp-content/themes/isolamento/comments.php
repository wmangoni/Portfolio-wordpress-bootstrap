<?php
// Do not delete these lines
    if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
        die ('Please do not load this page directly. Thanks!');
 
    if ( post_password_required() ) { ?>
        <p class="nocomments">Este artigo está protegido por senha. Insira-a para ver os comentários.</p>
    <?php
        return;
    }
?>
 
<div id="comments">
	<?php if ( comments_open() ) : ?>
    	<div id="respond">
            <h3>Deixe um comentário</h3>
 
            <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
            <fieldset>

                <?php if ( $user_ID ) : ?>
 					
                <p class="user_identity"><?php echo $user_identity; ?> [ <a href="<?php echo wp_logout_url(); ?>" title="Sair desta conta">sair desta conta</a> ]</p>
 				<div class="avatar">
					<?php echo change_avatar_css(get_avatar($user_ID, 60)); ?>
				</div>
                <?php else : ?>
                		<div id="new_comment_l">
 							<img src="<?php echo IMG_PATH .  'no_avatar.png'; ?>" width="62" height="62" id="no_avatar" />
 						</div>
 						<div id="new_comment_r">
			                <input type="text" name="author" id="author" placeholder="Nome" value="<?php echo $comment_author; ?>" />
			 
			                <input type="text" name="email" id="email" placeholder="Email" value="<?php echo $comment_author_email; ?>" />
			 
			                <input type="text" name="url" id="url" placeholder="Site" value="<?php echo $comment_author_url; ?>" />
			            </div>
 					
                <?php endif; ?>
                <textarea name="comment" id="comment" rows="" cols=""></textarea>
                <input type="submit" class="commentsubmit" value="COMENTE" />
 
                <?php comment_id_fields(); ?>
                <?php do_action('comment_form', $post->ID); ?>
            </fieldset>
        </form>
        <p class="cancel"><?php cancel_comment_reply_link('Cancelar Resposta'); ?></p>
        </div>
    <?php else : ?>
        <h3>Os comentários estão fechados.</h3>
	<?php endif; ?>
	<div class="nro_comments"><?php comments_number('0 Comentários', '1 Comentário', '% Comentários' );?></div>
    <?php if ( have_comments() ) : ?>
    <ol class="commentlist">
        <?php wp_list_comments('avatar_size=64&type=comment'); ?>
    </ol>
	    <?php if ($wp_query->max_num_pages > 1) : ?>
	        <div class="pagination">
		        <ul>
		            <li class="older"><?php previous_comments_link('Anteriores'); ?></li>
		            <li class="newer"><?php next_comments_link('Novos'); ?></li>
		        </ul>
	    	</div>
	    <?php endif; ?>
    <?php endif; ?>
    
</div>