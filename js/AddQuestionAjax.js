function insertarPreguntas() {
    var form_data = new FormData($("#fquestion").get(0));
    $.ajax({
        processData: false,
        data: form_data,
        type: "POST",
        url: "../php/AddQuestionWithImageAjax.php",
        contentType: false,
        processData: false,
        success: function (response) {
            $('#mensaje').html(response)
            verPreguntas();
        }
    });
}