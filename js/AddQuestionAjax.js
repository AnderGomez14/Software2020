function insertarPreguntas(){
    $formu = $('#fquestion').get(0);
    $.ajax({
        processData : false,
        data: new FormData($formu),
        type: "POST",
        url:"../php/AddQuestionWithImageAjax.php",
        success: function(response){
            $('#mensaje').html(response)
        }
    });
}