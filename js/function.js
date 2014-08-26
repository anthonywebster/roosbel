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

Template = new Template();

function deletePage() {
    self = $(this);
    var $id = self.data('id');
    $.ajax({
        url: location.href,
        type: 'GET',
        data: {delete:$id},
        success: function (data) {
            if (data == "true") {
                self.parent().fadeOut(500,function(){
                    self.remove();
                })
            }
        }
    });
}

$('.add-page').on('click',Template.templatePage);
$('.redactor').on('click','.fa-plus',Template.templateSub);
$('.redactor').on('click',".dinamic",Template.deletePage);
$('.btn-danger:not(.dinamic)').on('click',deletePage);