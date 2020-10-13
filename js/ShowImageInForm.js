function preview() {
    var archivo = $("#archivosubido").get(0).files[0];
    if (archivo) {
        var lector = new FileReader();
        lector.onload = function () {
            $("#preview").attr("src", lector.result);
        }
        lector.readAsDataURL(archivo);
    }
}