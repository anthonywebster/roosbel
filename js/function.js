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

var saveFiles = function (event) {
    var files_thumb = event.target.files;
    var containerthumb = $('#containerthumb');

    $.each(files_thumb,function(index,value){
        // Aqui almaceno en el arreglo files las imagenes seleccionadas
        files.push(value);
        // Con este vericamos si es una imagen la que viene
        if (!value.type.match('image.*')) {
            Continue;
        }

        var reader = new FileReader();

        reader.onload = (function(theFile){
            return function(evt) {
                containerthumb.append(
                "<li class='thumb'><span class='remove x'>x</span>"+
                    "<img src='" + evt.target.result + "' class='test' /> " +                       
                    "<div class='description'><input type='text' name='description[]'/></div>" +
                "</li>");
            }
        })(value);
        reader.readAsDataURL(value);
    }); // fin del foreach
}

var DeleteToArray = function (position) {
    files.splice(position,1);
}

var uploadFiles = function (object) {
    event.preventDefault();

    var data = new FormData();

    files.forEach(function(value,index){
        data.append('img[]',value);
    })

    if (object.hasOwnProperty('inputs')) {

        object.inputs.forEach(function(value,index){
            data.append(index,$('#'+value).val());
        })
    };

    for (prop in object.config) {
        if (object.config.hasOwnProperty(prop)) {
            data.append(prop,object.config[prop]);
        }
    }        

    $.ajax({
        url: 'upload.img.php',
        type: 'post',
        data: data,
        dataType:'json',
        contentType: false,
        processData: false,
        xhr: function () {
            var myXhr = $.ajaxSettings.xhr();
            if (myXhr.upload) {
                myXhr.upload.addEventListener('progress',function(event){
                    var porcentaje = 0;
                    var posicion = event.loaded || event.position;
                    var total = event.total;

                    if (event.lengthComputable) {
                        porcentaje = Math.ceil(posicion/total * 100) + '%';
                        $('.barra').width(porcentaje);
                        $('.porcentaje').html(porcentaje);
                        if (porcentaje=="100%") {
                            //console.log("bien");
                        }
                    }
                },false);
            }
            return myXhr
        },
        success: function (data,status,test) {
            if (data.status==true) {
                location.reload();
                //location.href = "cms.slide.php?id="+data+"&sms=1#last";
            }
        }
    });
};



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

/*
Esto es para el auto complete de las url
*/
$('.auto').each(function(){
    self = $(this);

    return self.autocomplete({
        minLength:2,
        source:function(request,response) {
            console.log(request);
            term = request.term;
            return $.ajax({
                url: 'autocomplete.php',
                type: 'post',
                data: {term:term},
                success: function (data) {
                    console.log(data);
                }
            });
        }
    })
});

$('body').on('click','.remove',function(){
    var position = $(this).parent().index();
    if (confirm('Desea eliminar esta imagen')) {
        $(this).parent().slideDown(500,function(){
            DeleteToArray(position);
            $(this).remove();
        })
    } else{
        return false;
    }
})

$('.add-page').on('click',Template.templatePage);
$('.redactor').on('click','.fa-plus',Template.templateSub);
$('.redactor').on('click',".dinamic",Template.deletePage);
$('.btn-danger:not(.dinamic)').on('click',deletePage);