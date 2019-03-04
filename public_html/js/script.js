function send(id) {
    $.ajax({
       type: "POST",
       url: "?page=backet&func=addajax&id=" + id,
        success: function (date) {
            $('#bac').html(date);
        }
    });
}

