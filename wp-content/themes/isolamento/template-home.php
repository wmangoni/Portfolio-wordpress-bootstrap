	<?php /* Template Name: Modelo de Página Inicial */  ?>
	<?php get_header(); ?>
	
	<section class="home container-fluid" id="home">
		<div class="center">
			<div class="row">
				<?php $banner = get_field('itens_banner', $post->ID); ?>
				<?php if(count($banner) > 0 && is_array($banner)) : ?>
					<?php foreach ($banner as $key => $value) : ?>
						<div class="banner hidden-xs hidden-sm" style="background: url(<?php echo $value['imagem']['url'] ?>) center no-repeat;">
							<div class="title"><h1><?php echo $value['titulo'] ?></h1><h3><?php echo $value['descricao'] ?></h3></div>
						</div>
						<div class="banner_mobile visible-xs visible-sm" style="background: url(<?php echo $value['imagem']['url'] ?>) center no-repeat;">
							<div class="title"><h1><?php echo $value['titulo'] ?></h1><h3><?php echo $value['descricao'] ?></h3></div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
			
			<div class="busca hidden-xs"><?php get_search_form(); ?></div>
    		<div class="busca_mobile visible-xs"><?php get_search_form(); ?></div>
    		
			<div class="section">
				<?php $conteudos = get_field('itens_de_conteudo', $post->ID); ?>
				<?php if(count($conteudos) > 0 && is_array($conteudos)) : ?>
					<?php foreach ($conteudos as $key => $value) : ?>
					<a href="<?php echo $value['link_de_saiba_mais'] ?>">
						<div class="col-xs-12 col-xs-offset-0 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-0 box-info">
							<div class="block-info">
								<div class="<?php echo ($key == 0) ? 'content' : 'content' . ($key+1); ?>">
									<p><span><em><?php echo $value['titulo'] ?></em></span><br /> <?php echo $value['descricao'] ?></p>
									<span>SAIBA MAIS</span>
								</div>
								<div class="img"><img src="<?php echo $value['imagem']['sizes']['thumbnail'] ?>"></div>
							</div>
						</div>
					</a>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php get_footer(); ?>
