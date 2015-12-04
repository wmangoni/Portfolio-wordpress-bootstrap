<?php /* Template Name: Videos */  ?>
<?php get_header(); ?>

<section class="videos container-fluid" id="videos">
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
					<li><a href="#">Downloads</a></li>
				</ul>
			</div>
		</div> 
	
		<div class="section">
			<div class="row">

				<?php $sub_video = get_field('subtitle_videos', $post->ID);
				$videos = get_field('videos', $post->ID);
				$sub_downloads = get_field('subtitle_downloads', $post->ID);
				$downloads = get_field('downloads', $post->ID);
				//echo'<pre>'; var_dump($downloads); echo '</pre>';
				?>

				<div class="col-xs-1 visible-xs visible-sm"></div>

				<!-- <div class="col-xs-10 col-md-12 description">
					<h2>Vídeos</h2>
					<?php if($sub_video) : ?>
						<p class="description"><?php echo $sub_video; ?></p>
					<?php endif; ?>
				</div>
				
				<div class="col-xs-10 col-sm-10 col col-md-12 painel-videos">
					<?php if (count($videos) > 1 && is_array($videos)): ?>	
					<?php foreach ($videos as $key => $value): ?>
				
						<?php if ($key == 0): ?>
				
							<div class="row">
								<div class="col-xs-11 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-3 col-md-offset-0 container-video">
									<a data-toggle="modal" data-target="#myModal" href="javascript:void(0)" data-src="<?php echo $value['link'] ?>"><img src="<?php echo $value['imagem-video']['sizes']['thumbnail']; ?>"></a>
									<p><?php echo $value['description']; ?></p>
								</div>
				
						<?php elseif ($key % 4 != 0): ?>
							
								<div class="col-xs-11 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-3 col-md-offset-0 container-video">
									<a data-toggle="modal" data-target="#myModal" href="javascript:void(0)" data-src="<?php echo $value['link'] ?>"><img src="<?php echo $value['imagem-video']['sizes']['thumbnail']; ?>"></a>
									<p><?php echo $value['description']; ?></p>
								</div>
						
						<?php elseif (($key % 4) == 0): ?>
				
							</div>
							<div class="row">
								<div class="col-xs-11 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-3 col-md-offset-0 container-video">
									<a data-toggle="modal" data-target="#myModal" href="javascript:void(0)" data-src="<?php echo $value['link'] ?>"><img src="<?php echo $value['imagem-video']['sizes']['thumbnail']; ?>"></a>
									<p><?php echo $value['description']; ?></p>
								</div>
				
						<?php endif; ?>
					
					<?php endforeach ?>
						</div>
					<?php endif ?>
				</div> -->

				<div class="col-xs-1 visible-xs"></div>
				<div class="col-xs-11 col-xs-offset-1 col-md-12 col-md-offset-0 description">

					<h2>Downloads</h2>
					<?php if($sub_video) : ?>
						<p class="description"><?php echo $sub_downloads; ?></p>
					<?php endif; ?>

						
					<ul class="left">
						<?php if (is_array($downloads)): ?>	
							<?php foreach ($downloads as $k => $v): ?>
								<li><a target="_blank" href="<?php echo $v['pdf']['url']; ?>"><em><?php echo $v['texto']; ?></em></a></li>
							<?php endforeach ?>
						<?php endif ?>
					</ul>

				</div>

				
			</div>
		</div>
	</div>	
</section>

<?php get_footer(); ?>