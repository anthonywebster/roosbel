require.config({
	paths:{
		modules:'../modules',
	},
	shim:{
		'bxslider': {
			deps:['jquery'],
			exports:'bxslider'
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


require(['modules/app']);