<?php get_header(); ?>
<section class="news single">
	<div class="content">
	<div class="center">
		<div class="left">
			<h1>Novidades.</h1>
			<?php
			$args = array (
				'post_type'         => 'post',
				'post_status'       => 'publish',
				'posts_per_page'    => '4',
				'orderby'           => 'most_recent',
				);
			$lastposts = new WP_Query( $args );
			?>
			<?php if($lastposts->have_posts()) : ?>
			<div class="last-posts">           
                <?php if(ICL_LANGUAGE_CODE == 'en') : ?>
                <span class="tt-list">+ Latest</span>
            <?php elseif(ICL_LANGUAGE_CODE == 'es') : ?>
            <span class="tt-list">+ Último</span>
        <?php else : ?>
        <span class="tt-list">+ Ultimas</span>
    <?php endif; ?>
				<ul>
					<?php while ($lastposts->have_posts()): $lastposts->the_post(); ?>
					<li>
						<div class="text-post">
							<a href="<?php the_permalink(); ?>" class="see-more">
								<span><?php the_time("d/m/Y"); ?></span>|<h4><?php the_title(); ?></h4>
							</a>
						</div>
					</li>
				<?php endwhile;?>
			</ul>
		</div>
	<?php endif; ?>
	<div class="cat-list">
  <?php if(ICL_LANGUAGE_CODE == 'en') : ?>
  <span class="tt-list">+ Categories</span>
<?php elseif(ICL_LANGUAGE_CODE == 'es') : ?>
    <span class="tt-list">+ Categorías</span>
<?php else : ?>
    <span class="tt-list">+ Categorias</span>
<?php endif; ?>
		<?php wp_list_categories(); ?>
	</div>
	<?php if(ICL_LANGUAGE_CODE == 'en') : ?>
    <a href="#" class="tt-list">+ All News</a>
<?php elseif(ICL_LANGUAGE_CODE == 'es') : ?>
    <a href="#" class="tt-list">+ Todas Noticias</a>
<?php else : ?>
    <a href="#" class="tt-list">+ Todas Novidades</a>
<?php endif; ?>
</div>
<div class="right">
	<div class="last-posts">
		<?php if(have_posts()) : ?>
		<?php while(have_posts()) : the_post(); ?>
		<h1><?php the_title(); ?></h1>
		<?php the_content(); ?>
	<?php endwhile; ?>
<?php endif; ?>
</div>
</div>
</div>
</div>
</section>

<?php get_footer(); ?>