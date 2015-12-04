<?php /* Template Name: Contato */  ?>
<?php get_header(); ?>

<section class="contato container-fluid" id="contato">
	<div class="center">
		<div class="row">
			<?php $banner = get_field('banner', $post->ID); ?>
			<?php if(count($banner) > 0 && is_array($banner)) : ?>
				<?php foreach ($banner as $key => $value) : ?>
					<div class="banner hidden-xs hidden-sm" style="background: url(<?php echo $value['imagem_banner']['url'] ?>) center no-repeat;">
						<div class="title"><h1><?php echo $value['titulo'] ?></h1><h3><?php echo $value['descricao'] ?></h3></div>
					</div>
					<div class="banner_mobile visible-xs visible-sm" style="background: url(<?php echo $value['imagem_banner']['url'] ?>) center no-repeat;">
						<div class="title"><h1><?php echo $value['titulo'] ?></h1><h3><?php echo $value['descricao'] ?></h3></div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
		
	  	<div class="busca hidden-xs"><?php get_search_form(); ?></div>
	    <div class="busca_mobile visible-xs"><?php get_search_form(); ?></div>

		<div class="breadcrumbs">
	    	<div class="section">
	    		<ul>
					<li><a href="<?php echo PAGE_HREF; ?>">Home</a>&nbsp;&nbsp;&nbsp;></li>
					<li><a href="#">Contato</a></li>
	    		</ul>
			</div>
		</div>
		
		<div class="section">
			<div class="row">
				<div class="col-xs-11 col-xs-offset-1 col-md-12 col-md-offset-0 form-contact">
					<?php echo do_shortcode('[contact-form-7 id="20" title="Formulário de contato 1"]'); ?>
				</div>
			</div>
		</div>
	</div>	
</section>

<?php get_footer(); ?>