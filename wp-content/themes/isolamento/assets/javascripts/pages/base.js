(function($, window, document, undefined) {
	'use strict';

	var main = {
		abrirModal: function(){
			$('#modal-video').hide();

	    	$('.painel-videos a').on('click', function(){
	    		var src = $(this).data('src');
	    		var newSrc = src.replace("watch?v=","embed/");
	    		var offset = $(this).offset().top;
	    		
	    		$('.base-video iframe').attr('src',newSrc + '?rel=0&autoplay=1');
	    	});
	    	console.log('abrirModal '+window.innerWidth);
		},

		pageCurrent: function(){

	    	var y = window.location.pathname;

	    	var x = y.replace("/isolamento/","");

	    	console.log('pageCurrent - '+y);
	    	console.log('pageCurrent - '+x);

	    	$('nav li').each(function(){
	    		if($(this).attr('id') == "menu-item-24" && y == '/beneficios/'){
	    			console.log('entrou no if');
	    			$(this).css( {"background":"url(" + $('body').data('src') + "wp-content/themes/isolamento/assets/images/arrow-page.jpg) 9px 32px no-repeat", "background-size":" 65px 17px"} );
	    		}
	    		if($(this).attr('id') == "menu-item-30" && y == '/videos-e-downloads/'){

	    			$(this).css( {"background":"url(" + $('body').data('src') + "wp-content/themes/isolamento/assets/images/arrow-page.jpg) 14px 32px no-repeat", "background-size":" 65px 17px"} );
	    		}
	    		if($(this).attr('id') == "menu-item-25" && y == '/contato/'){
	
	    			$(this).css( {"background":"url(" + $('body').data('src') + "wp-content/themes/isolamento/assets/images/arrow-page.jpg) 5px 32px no-repeat", "background-size":" 65px 17px"} );
	    		}
	    		if($(this).attr('id') == "menu-item-28" && y == '/parcerias/'){
	
	    			$(this).css( {"background":"url(" + $('body').data('src') + "wp-content/themes/isolamento/assets/images/arrow-page.jpg) 9px 32px no-repeat", "background-size":" 65px 17px"} );
	    		}
	    		if($(this).attr('id') == "menu-item-27" && y == '/rio-2016/'){

	    			$(this).css( {"background":"url(" + $('body').data('src') + "wp-content/themes/isolamento/assets/images/arrow-page.jpg) 5px 32px no-repeat", "background-size":" 65px 17px"} );
	    		}
	    	});
		},

		search: function(){
			$('.search-submit').val('');
			$('.search-field').attr("placeholder", "BUSCA");
		},

		iconsShare: function(){
			$('#icons-share').on('click', function(event){
				$('.share-buttons').show('slow');

				$('html').on('click', function(){
					$('.share-buttons').hide('slow');
				});

				event.stopPropagation();
			});
		},

		searchClick: function(){
			$('#lupinha').on('click', function(){
				$('#srch span').hide();
				$('#srch input').css('border','none');
				$('#srch input').attr("placeholder", "");
				$('#srch').show('slow');
				$('#srch .search-field').focus();

				$('#srch .search-field').on('blur', function(){
					$('#srch').hide('slow');
				});
			});
		},

		hoverIconsMenu: function(){
			var src = $('body').data('src') + 'wp-content/themes/isolamento/assets/images/icons-share-dark.png';
			var src2 = $('body').data('src') + 'wp-content/themes/isolamento/assets/images/icons-share.png';
			var src3 = $('body').data('src') + 'wp-content/themes/isolamento/assets/images/icons-lopa-dark.png';
			var src4 = $('body').data('src') +  'wp-content/themes/isolamento/assets/images/icons-lopa.png';
			$('#icons-share img').hover(function(){
				$('#icons-share img').attr('src',src);
			},function(){
				$('#icons-share img').attr('src',src2);
			});
			$('#lupinha img').hover(function(){
				$('#lupinha img').attr('src',src3);
			},function(){
				$('#lupinha img').attr('src',src4);
			});
		},

		migalha: function(){
			var a = $('.search-field').val();
			$('#busca_atual').text(a);
		}
	}

	main.abrirModal();

	if(window.innerWidth > 780){
		main.pageCurrent();
	}

	main.search();
	main.iconsShare();
	main.searchClick();
	main.hoverIconsMenu();
	main.migalha();

	



}(jQuery, window, document));