require(['jquery','modules/redactor','modules/menu'],function($,redactor,Template){

var files=[];

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
            data.append(value,$('#'+value).val());
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
            if (data.type == "Gallery") {
                location.href = "cms.gallery.php?id="+data.id+"&sms=1#last";
            } else if(data.type == 'slide') {
                location.reload();
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
            term = request.term;
            return $.ajax({
                url: 'autocomplete.php',
                type: 'post',
                dataType:'json',
                data: {term:term},
                success: function (data) {
                    response(data);
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

$('.fa-pencil').on('click',function(){
    var url = $(this).data('url');
    window.location.href = url;
});

$('input[name="images[]"]').on('change',saveFiles);

    $('.upload').on('submit',function(){        
        // Este objeto contine los datos que se va a enviar en el post
        // input = son los nombre de los inputs y a dicho inputs se le debe de poner un id con el mismo nombre,config es para otro parametros que necesitas en el php
        
        var object = {
            //inputs :['title'],
            config:{
                slide:true,
            }
        }
        uploadFiles(object);
    }); 

    $('.upload_gallery').on('submit',function(){        
        // Este objeto contine los datos que se va a enviar en el post
        // input = son los nombre de los inputs y a dicho inputs se le debe de poner un id con el mismo nombre,config es para otro parametros que necesitas en el php
        
        var object = {
            inputs :['id','title'],
            config:{
                gallery:true,
            }
        }
        uploadFiles(object);
    }); 

function calHeight (argument) {    
    setTimeout(function() {
        content_tab = $('.content-tab').height();

        if (content_tab <= 650) {
            $('html,body').css({'height':'100%','min-height':'auto'});
        } else if(content_tab > 650) { 
            $('html,body').css({'min-height':'100%','height':'auto'});
        } 
    }, 1);
};

function currentHash (argument) {
    this.hash = window.location.hash.split("#")[1];
    return hash;
}

function tabActive (hash) {
    $('.tab').removeClass('active');
    $('span.tab.'+hash).addClass('active');
}

tabActive(currentHash());
calHeight();

function changeHash (nameHash) {
    window.location.hash ="#"+nameHash;
}

$('span.tab').on('click',function(){
    nameHash = $(this).data('namehash');
    changeHash(nameHash);
    $('.tab').removeClass('active');
    $(this).addClass('active');
    calHeight();
});


$('.enlace').on('click',function(){
    calHeight();
    tabActive(hash);
});

/*
Esto es para ocultar algunos inputs del login cuando se va a loguear la persona
 */

});