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
			deps:['jquery','jqueryui'],
			exports:'bootstrap'
		},
		'codemirror':{
			deps:['jquery'],
			exports:'codemirror'
		},
		'xml':{
			deps:['jquery','codemirror'],
			exports:'xml'
		},
		'formatting':{
			deps:['jquery','xml'],
			exports:'formatting'
		},
		'summernote':{
			deps:['jquery','codemirror'],
			exports:'summernote'
		}
	}
});

require(['../app']);
