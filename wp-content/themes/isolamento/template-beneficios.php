<?php /* Template Name: Beneficios */  ?>
<?php get_header(); ?>

<section class="beneficios container-fluid" id="beneficios">
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
					<li><a href="#">Benefícios</a></li>
				</ul>
			</div>
		</div> 
		
		<div class="section">
			<div class="row">
				<div class="col-xs-11 col-sm-11 col-sm-offset-1 col-md-5 col-md-offset-0 box-left">
					<div class="row">
						<?php $beneficios = get_field('conteudo_baneficios', $post->ID);
						//echo'<pre>'; var_dump($beneficios); echo '</pre>';
						?>
						<?php if($beneficios && is_array($beneficios)) : ?>

						<div class="col-xs-10 col-md-11 col-md-offset-0 col-lg-12 col-lg-offset-0">
							<h2>O que é?</h2>
							<p><?php echo $beneficios[0]['o_que_e']; ?></p>
						</div>
						<div class="col-xs-10 col-md-11 col-md-offset-0 col-lg-12 col-lg-offset-0">
							<h2>Tecnologia</h2>
							<p><?php echo $beneficios[0]['tecnologia']; ?></p>
						</div>
						<div class="col-xs-10 col-md-11 col-md-offset-0 col-lg-12 col-lg-offset-0">
							<h4>Espumas de Poliuretano (PUR) / Poliisocianurato (PIR)</h4>
							<p>Espuma rígida termofixa. Alto poder de isolamento térmico (19-21mW/m.K), baixa densidade moldada (36-44 kg/m&sup3;), retardante à chama atendendo a diversas normas internacionais (DIN, ISO, ASTM, LPS, Euroclass e Factory Mutual) e nacionais (NBR 7358 e NBR 15366).</p>
						</div>
						<div class="col-xs-10 col-md-11 col-md-offset-0 col-lg-12 col-lg-offset-0">
							<h2>Aplicações</h2>
							<p><?php echo $beneficios[0]['aplicacoes']; ?></p>
						</div>
						<div class="col-xs-10 col-md-11 col-md-offset-0 col-lg-12 col-lg-offset-0 list_beneficios">
							<?php echo $beneficios[0]['lista_beneficios']; ?>
						</div>
							<?php endif; ?>
					</div>
				</div>

				<div class="col-md-1 hidden-xs"></div>

				<div class="col-xs-11 col-sm-11 col-sm-offset-1 col-md-5 col-md-offset-0 box-right">
					<div class="row">
						<?php if($beneficios && is_array($beneficios)) : ?>
							<?php $x = 1; foreach ($beneficios[0]['vantagens'] as $k => $v) : ?>
								<div class="col-xs-10 col-md-11 col-md-offset-0 col-lg-12 col-lg-offset-0">
									<?php if($x == 1) : ?>
										<h2>Vantagens</h2>
									<?php endif; ?>
									<p><?php echo $v['texto']; ?></p>
								</div>
								<div class="col-xs-10 col-md-11 col-md-offset-0 col-lg-12 col-lg-offset-0 list_beneficios">
									<?php echo $v['lista']; ?>
								</div>
							<?php $x++; endforeach; ?>
						<?php endif ?>
					</div>
				</div>
			</div>
		</div>
	</div>	
</section>

<?php get_footer(); ?>