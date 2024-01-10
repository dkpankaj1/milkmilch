$(document).ready(function () {
    $("body").append(
        '<div class="modal fade " id="modelHolder" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog modal-dialog-centered"></div></div>'
    );
});
$(document).on("click", ".delete-btn", function (o) {
    o.preventDefault();
    let t = $(this).attr("data-attr");
    $.ajax({
        url: t,
        beforeSend: function () {
            $('#loading-wrapper').show();
        },
        success: function (o) {
            $("#modelHolder").modal("show"),
                $("#modelHolder .modal-dialog").html(o).show();
        },
        complete: function () {
            $('#loading-wrapper').hide();
        },
        error: function (o, e, n) {
            $('#loading-wrapper').hide();
        },
        timeout: 8e3,
    });
});