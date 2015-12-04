<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="<?php echo bloginfo( 'charset' ); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php if(is_home()) { echo bloginfo("name"); echo " | "; echo bloginfo("description"); } else { echo wp_title(" | ", false, right); } ?></title>
  <meta name="description" content="">
  <meta name="author" content="Santins">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,100italic,400italic,500,500italic,700,700italic,900,900italic|Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="pingback" href="<?php echo bloginfo( 'pingback_url' ); ?>">
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo IMG_PATH . 'favicon.ico' ?>" />
  <meta property="og:image" content="<?php echo IMG_PATH . 'logo-compartilhamento.jpg' ?>" />
  <link rel="stylesheet" href="<?php echo CSS_PATH . 'styles.css' ?>">
  <!-- Modernizr CDN -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js'></script>
  <!-- Modernizr local no fallback -->
  <script>window.Modernizr || document.write('<script src="<?php echo JS_PATH . "modernizr.min.js"; ?>"><\/script>')</script>
    <!--[if gte IE 9]>
<style>.gradient{filter: none;}</style>
<![endif]-->

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header>
<div class="center">

    <div class="modal fade" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3></h3>
          </div>
          <div class="modal-body base-video">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/watch?v=oAPdNKTrBYA" frameborder="0"></iframe>
          </div>
        </div>
      </div>
    </div>

    <div class="row content-header">
        <div class="col-md-12">

            <div class="row logos">

                <div id="dow" class="left col-xs-8 col-sm-5 col-md-4">
                    <a href="<?php echo PAGE_HREF;?>"><img src="<?php echo IMG_PATH.'icon-dow.jpg'; ?>"></a>
                    <?php $page = get_page($page->ID); ?>
                    <?php if ($page->post_title == "Home"): ?>
                      <div><img src="<?php echo IMG_PATH.'marca.png' ?>"></div>
                    <?php endif ?>
                </div>

                <div class="col-md-3 col-md-offset-5">

                    <a target="_blank" href="http://www.danicacorporation.com">
                        <div id="danica" class="logo col-md-4 hidden-xs">
                            <img src="<?php echo IMG_PATH.'danica.png'; ?>">
                        </div>
                    </a>

                    <a target="_blank" href="http://www.isoeste.com.br">
                        <div id="isoeste" class="logo col-md-4 hidden-xs">
                            <img src="<?php echo IMG_PATH.'isoeste.png'; ?>">
                        </div>
                    </a>

                    <a target="_blank" href="http://www.mbp.com.br">
                        <div id="isoblock" class="logo col-md-4 hidden-xs">
                            <img src="<?php echo IMG_PATH.'isoblock.png'; ?>">
                        </div>
                    </a>

                </div>

            </div>

        </div>

        <div class="col-md-12 menu-container">
                      <!-- <div class="col-xs-7 col-md-3 campanha">
                          <div class="col-md-10 col-md-offset-2"><span>COMPANHIA QUÍMICA OFICIAL</span></div>
                      </div> -->

            <div class="col-xs-8 col-sm-9 col-md-8 col-md-offset-3 menu">
                    <nav class="navbar-header right">

                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!--div class="marca hidden-md hidden-lg"></div-->

                    <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height:1px;">
                        <nav class="menu-container">
                          <?php
                          require_once "inc/wp_bootstrap_navwalker.php";
                          wp_nav_menu( array(
                             'menu'              => 'primary',
                             'theme_location'    => 'primary',
                             'depth'             => 2,
                             'container'         => '',
                             'container_class'   => '',
                             'container_id'      => '',
                             'menu_class'        => 'nav navbar-nav navbar-right',
                             'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                             'walker'            => new wp_bootstrap_navwalker())
                          );
                          ?>
                        </nav>
                    </div>
                </nav>
            </div>

            <div class="col-xs-4 col-sm-3 col-md-1 icons-menu right">
              <a id="icons-share" href="javascript:void(0)"><img class="right" src="<?php echo IMG_PATH.'icons-share.png'; ?>" alt="Social"></a>
              <a id="lupinha" href="javascript:void(0)"><img class="right" src="<?php echo IMG_PATH.'icons-lopa.png'; ?>" alt="Pesquisar"></a>

              <div class="share-buttons">
                <ul>
                  <li><a target="_blank" id="tw" href="https://twitter.com/DowChemical"></a></li>
                  <li><a target="_blank" id="pint" href="http://pinterest.com/dowchemical/"></a></li>
                  <li><a target="_blank" id="face" href="https://www.facebook.com/DowBrasil"></a></li>
                  <li><a target="_blank" id="li" href="http://www.linkedin.com/company/2562"></a></li>
                  <li><a target="_blank" id="youtube" href="http://www.youtube.com/dowchemicalcompany"></a></li>
                  <li><a target="_blank" id="google" href="https://plus.google.com/103155547656737587215/"></a></li>
                </ul>
              </div>

              <div id="srch">
                  <?php get_search_form(); ?>
              </div>

            </div>

        </div>
    </div>
</div>
</header>