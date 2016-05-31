$(function() {
    $('.list-history').on('click',function() {
        $('.active').removeClass('active');
        $(this).addClass("active");
        var ajaxSetup = {
            url: Routing.generate("Default_History"),
            type: "post",
            data: $('#name'),
            success: function (response) {
                if (response.error) {
                    $('#error-msg').html(response.msg);
                    $('#error-msg').show();
                } else {
                    $('.conteudo').html('');
                    $('.conteudo').html(response);
                }
            }
        }
        $.ajax(ajaxSetup);
    });
    $('.list-summoner').on('click',function() {
        $('.active').removeClass('active');
        $(this).addClass("active");
        var ajaxSetup = {
            url: Routing.generate("Default_Summoner"),
            type: "post",
            data: $('#name'),
            success: function (response) {
                if (response.error) {
                    $('#error-msg').html(response.msg);
                    $('#error-msg').show();
                } else {
                    $('.conteudo').html('');
                    $('.conteudo').html(response);
                }
            }
        }
        $.ajax(ajaxSetup);
    });
});