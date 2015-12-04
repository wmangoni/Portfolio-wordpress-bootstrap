<?php get_header(); ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<?php echo get_the_excerpt(); ?>
				<a href="<?php the_permalink(); ?>"><?php _e('leia mais'); ?></a></span>	
				</div>
			</article>
		<?php endwhile; ?>
		<div class="pagination">
          <?php 
            global $wp_query;
            $big = 999999999; // need an unlikely integer

            echo paginate_links( array(
              'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
              'format' => '?paged=%#%',
              'current' => max( 1, get_query_var('paged') ),
              'total' => $wp_query->max_num_pages,
              'prev_text'    => __(' <span class="prev">«</span> '),
              'next_text'    => __(' <span class="next">»</span> '),
              'Show_all'     => false,
              'end_size'     => 1,
              'mid_size'     => 2,
            ) );
          ?>
        </div>
<?php get_footer(); ?>