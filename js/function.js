var files=[];
  
function sendFile(file,editor,welEditable) {
    data = new FormData();
    data.append("file", file);
    $.ajax({
        data: data,
        type: "POST",
        url: "imgredactor.php",
        cache: false,
        contentType: false,
        processData: false,
        success: function(url) {
            editor.insertImage(welEditable,url);
        }
  });
}          

if ($('.summernote').length > 0) {

    $('.summernote').summernote({
      focus: true,
      codemirror: { // codemirror options
        theme: 'monokai'
      },
      onImageUpload:function(files,editor,welEditable){
        sendFile(files[0],editor,welEditable);
      },

      onkeyup:function(e){
        
      }    
    });
};

var Template = (function() {
    'use strict';

    var instance;

    Template = function(args) {}


    Template.prototype.templatePage = function(first_argument) {
        var template = $('<div>',{
        'class':'col-md-6',
        });
        template.html('<label>Título</label>'
            +'<input type="text" name ="page[new]" class="form-control" placeholder="Título de página" required autofocus>'
            +'<i class="fa fa-plus btn btn-info"></i>'
            +'<i class="fa fa-minus btn btn-danger"></i>'
        );
        $('.template-page').append(template);
    };


    Template.prototype.templateSub = function(first_argument) {
        var id_parent = $(this).parent().find('input').data('id');
        var template = $('<div>',{
            'class':'col-md-10',
        });
        template.html('<label>Título</label>'
            +'<input type="text" name ="subpage['+id_parent+']" class="form-control" placeholder="Título de Sub-Página" required autofocus>'
            +'<i class="fa fa-minus btn btn-danger"></i>'
        );
        $(this).parent().append(template);
    };

    return Template;

}());

Template = new Template();

$('.add-page').on('click',Template.templatePage);
$('.redactor').on('click','.fa-plus',Template.templateSub);
