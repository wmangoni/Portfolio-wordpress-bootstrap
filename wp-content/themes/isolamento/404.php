<?php get_header(); ?>

<section class="container-fluid">

	<div class="center">

		<div class="row">
			<div class="banner hidden-xs hidden-sm">
				<div class="title"><h1>PAINÉIS TERMOISOLANTES</h1><h3>A transformação começa por dentro</h3></div>
			</div>
			<div class="banner_mobile visible-xs visible-sm"></div>
		</div>

		<div class="busca hidden-xs"><?php get_search_form(); ?></div>
	    <div class="busca_mobile visible-xs"><?php get_search_form(); ?></div>

		<center>
		<h1><?php _e('Desculpe'); ?><br /><span class="glyphicon glyphicon-alert" aria-hidden="true"></span></h1>

		<p><?php _e( 'não encontramos a página informada.'); ?></p>
		</center>
	
	</div>

</section>
<?php get_footer(); ?>