define(['jquery'],function($){

	var Template;

	return Template = (function() {

	    Template = function(args) {}

	    Template.prototype.templatePage = function(first_argument) {
	        var template = $('<div>',{
	        'class':'col-md-6',
	        });
	        template.html('<label>Título</label>'
	            +'<input type="text" name ="page[new][]" class="form-control" placeholder="Título de página" required autofocus>'
	            +'<i class="fa fa-minus btn btn-danger dinamic"></i>'
	        );
	        $('.template-page').append(template);
	    };


	    Template.prototype.templateSub = function(first_argument) {
	        var id_parent = $(this).parent().find('input').data('id');
	        var template = $('<div>',{
	            'class':'col-md-10',
	        });
	        template.html('<label>Título</label>'
	            +'<input type="text" name ="subpage[new]['+id_parent+']" class="form-control" placeholder="Título de Sub-Página" required autofocus>'
	            +'<i class="fa fa-minus btn btn-danger dinamic"></i>'
	        );
	        $(this).parent().append(template);
	    };

	    Template.prototype.deletePage = function(first_argument) {
	        $(this).parent().remove();
	    };

	    return Template;

	}());
});