$(function () {

    $('html').on('submit', 'form:not(.ajax_off)', function (e) {
        e.preventDefault();

        var form = $(this);
        var load = $(".ajax_load");
        $(".ajax_trigger").fadeOut("fast");

        form.ajaxSubmit({
            url: form.attr("action"),
            type: "POST",
            dataType: "json",
            beforeSend: function () {
                load.fadeIn(200).css("display", "flex");
            },
            success: function (response) {

                load.fadeOut(200);
                if (response.ajax_response) {
                    $(".ajax_response").html(response.ajax_response).fadeIn();
                }

                if (response.trigger) {
                    $(".ajax_trigger").html(response.trigger).fadeIn();
                }

            }
        });
    });

    $(document).ready(function () {
        $('input[name=visibility]').change(function () {
            $('form[name=visibility]').submit();
        });
    });

    $(document).ready(function () {
        $('input[name=direction]').change(function () {
            $('form[name=direction]').submit();
        });
    });
});