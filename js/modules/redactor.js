define(['jquery','bootstrap','codemirror','xml','formatting','summernote'],function(){
    
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
});