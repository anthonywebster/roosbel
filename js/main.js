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
		codemirror:{
			deps:['jquery'],
			exports:'codemirror'
		},
		summernote:{
			deps:['jquery','codemirror'],
			exports:'summernote'
		}
	}
});

require(['../app']);
