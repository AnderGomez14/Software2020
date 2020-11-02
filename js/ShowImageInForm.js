function preview() {
    var archivo = $("#archivosubido").get(0).files[0];
    if (archivo) {
        var lector = new FileReader();
        lector.onload = function () {
            if ($('#preview').length) {
                $('#preview').attr('src', lector.result);
            } else {
                var img = $('<img id="preview">'); //Equivalent: $(document.createElement('img'))
                img.attr('src', lector.result);
                img.appendTo('#formDiv');
            }
        }
        lector.readAsDataURL(archivo);
    }

}