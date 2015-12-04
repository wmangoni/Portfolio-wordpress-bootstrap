<?php /* Template Name: Parcerias */  ?>
<?php get_header(); ?>

<section class="parcerias container-fluid" id="parcerias">
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
					<li><a href="#">Parcerias</a></li>
				</ul>
			</div>
		</div> 
		
		
		<div class="section">
			<div class="row">
				<div class="col-md-12">
					<?php $descricao = get_field('descricao_da_pagina', $post->ID);	?>
					<?php if($descricao) : ?>
						<div class="description"><p><?php echo $descricao ?></p></div>
					<?php endif; ?>
				</div>
			</div>
			<?php $conteudos = get_field('parceiros', $post->ID); ?>
			<?php if(count($conteudos) > 0 && is_array($conteudos)) : ?>
				<?php foreach ($conteudos as $key => $value) : ?>
					<div class="row box-parceiros">
						<div class="col-xs-1 visible-xs"></div>
						<div class="col-xs-10 col-sm-7 col-sm-offset-1 col-md-4 col-md-offset-0"><a href="<?php echo $value['links'][0]['link'] ?>" target="_blank"><img src="<?php echo $value['logo']['url']; ?>"></a></div>
						<div class="col-xs-11 col-md-8">
							<p><?php echo $value['description']; ?>
							<br /><br /><br /><a target="_blank" href="<?php echo $value['links'][0]['link'] ?>" target="_blank"><?php echo $value['links'][0]['site'] ?></a></p>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>	
</section>

<?php get_footer(); ?>