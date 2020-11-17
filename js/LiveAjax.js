window.setInterval(function () {
    liveCounters();
}, 10000);

function liveCounters() {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "../php/LiveCountAjax.php",
        data: { email: $("#mail").val() },
        success: function (response) {
            var newData = JSON.stringify(response)
            var data = JSON.parse(newData);

            $('#nQuestions').html(data.nUsersQuestions + "/" + data.nQuestions);
            $('#nUsers').html(data.nUsers);
        }
    });
}
