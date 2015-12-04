<?php

/**********************************************************

ARQUIVO DE CONFIGURAÇÕES DO TEMA
@author: santins

**********************************************************/

//local do css
define('CSS_PATH', get_template_directory_uri() . '/assets/stylesheets/' );	

//local do javascript
define('JS_PATH', get_template_directory_uri() . '/assets/javascripts/' );

//local das imagens	
define('IMG_PATH', get_template_directory_uri() . '/assets/images/' );

//local dos plugins do tema
define('PLUGINS_PATH', get_template_directory_uri() . '/assets/plugins/' );

//retorna a "raiz" do tema 
define('PAGE_HREF', esc_url( home_url( '/' ) ));

//local dos arquivos
define('INCLUDE_PATH', get_template_directory_uri() );

?>