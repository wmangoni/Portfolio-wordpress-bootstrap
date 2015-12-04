<?php get_header(); ?>
<section class="container-fluid">
	<div class="center">
		<div class="row">
			<div class="banner hidden-xs hidden-sm">
				<div class="title"><h1>PAINÉIS TERMOISOLANTES</h1><h3>A transformação começa por dentro.</h3></div>
			</div>
			<div class="banner_mobile visible-xs visible-sm"></div>
		</div>

		<div class="busca hidden-xs"><?php get_search_form(); ?></div>
		<div class="busca_mobile visible-xs"><?php get_search_form(); ?></div>

		<div>
			<ul class="breadcrumbs">
				<li><a href="<?php echo PAGE_HREF; ?>">Home</a>&nbsp;&nbsp;&nbsp;></li>
				<li id="busca_atual"></li>
			</ul>
		</div>
			
		<div class="center">
			<div class="row" id="center-search">
				<div class="row">
				<?php 
					if(have_posts()) : ?>
						<?php while(have_posts()) : the_post(); ?>
							<div class="col-sm-12 col-sm-offset-0 col-lg-9 col-lg-offset-3">
								<ul>
									<li><em><a href="<?php the_permalink(); ?>">
										<?php the_title(); ?>
									</a></em></li>
										<?php wp_reset_query(); ?>
								</ul>
							</div>
						<?php endwhile; ?>
					<?php else : ?>
						<div class="col-sm-12 col-sm-offset-0 col-lg-9 col-lg-offset-3">
							<p><?php _e('Nenhum resultado encontrado.'); ?></p>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>