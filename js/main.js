require.config({
	baseUrl:"js/vendor",
	shim:{
		'bxslider': {
			deps:['jquery'],
			exports:'bxslider'
		},
		'jqueryui':{
			deps:['jquery'],
			exports:'jqueryui'
		},
		'bootstrap':{
			deps:['jquery'],
			exports:'bootstrap'
		}
	}
});

require(['jquery','bxslider'],function($,bxslider){

   $(function(){
	   	$('.bxslider').bxSlider({
	      mode: 'fade',
	      captions: true
	    });
   })

});