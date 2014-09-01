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
		},
		summernote:{
			deps:['jquery'],
			exports:'summernote'
		}
	}
});

require(['../app']);
