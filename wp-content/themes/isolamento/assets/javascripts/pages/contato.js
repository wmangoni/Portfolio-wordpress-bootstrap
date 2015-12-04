(function($, window, document, undefined) {
	'use strict';

	var contato = {
	mascara: function(){

			$('.your-phone input').mask("(99) 9999-99999");
			$('.your-celphone input').mask("(99) 9999-99999");
		}
	}

	contato.mascara();

	



}(jQuery, window, document));