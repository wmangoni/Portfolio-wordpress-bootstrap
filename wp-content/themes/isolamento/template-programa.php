<?php /* Template Name: Programa */  ?>
<?php get_header(); ?>

<section class="programa container-fluid" id="programa">
	<div class="center">
		<div class="row">
			<!-- <div class="banner hidden-xs hidden-sm">
				<div class="title"><h1>PROGRAMA DE MITIGAÇÃO DE CARBONO RIO 2016</h1><h3></h3></div>
			</div>
					    <div class="banner_mobile visible-xs visible-sm">
					    	<div class="title"><h1>PROGRAMA DE MITIGAÇÃO DE CARBONO RIO 2016</h1><h3></h3></div>
					    </div> -->
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
					<li><a href="#">Rio 2016</a></li>
				</ul>
			</div>
		</div> 
		
		<div class="section">
			<div class="row">

				<?php $programa = get_field('conteudo', $post->ID);	?>
				<?php $links = get_field('links', $post->ID);	?>
				<?php if($programa) : ?>

				<div class="col-xs-1 visible-xs"></div>
				<div class="col-xs-10 col-sm-10 col-sm-offset-1 col-md-12 col-md-offset-0 description">
					<h2><?php echo $programa[0]['description']; ?></h2>
				</div>

				<div class="col-xs-10 col-sm-10 col-sm-offset-1 col col-md-6 col-md-offset-0 box-left">
					<p><?php echo $programa[0]['texto_1']; ?></p>
				</div>

				<div class="col-xs-10 col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-0 box-right">
					<p><?php echo $programa[0]['texto_2']; ?></p>
					<p>Para saber mais, acesse <a target="_blank" href="<?php echo $links[0]['link']; ?>"><?php echo $links[0]['site']; ?></a> e <a target="_blank" href="<?php echo $links[1]['link']; ?>"><?php echo $links[1]['site']; ?></a></p>
				</div>

				<?php endif; ?>

			</div>
		</div>
	</div>	
</section>

<?php get_footer(); ?>