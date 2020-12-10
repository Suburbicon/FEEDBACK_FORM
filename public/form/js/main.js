$(document).ready(function () {

    $('.js_content_step_2').hide();
    $('.js_content_step_3').hide();

    $('.js_dis').click( function (e){
        $('.js_content_step_1').hide();
        $('.js_content_step_2').show();
    });

    // $('#phone_reg').mask('+7 (000) 000 00 00', {placeholder: "+7 (___) ___ __ __"});
    // $('#phone_login').mask('+7 (000) 000 00 00', {placeholder: "+7 (___) ___ __ __"});
    //
    // $('form[id="reg_form"]').validate({
    //     rules: {
    //         phone: 'required',
    //         password: 'required',
    //         password_confirmation: 'required',
    //         captcha: 'required',
    //     },
    //     messages: {
    //         // name_company: 'Введите наименование компании',
    //         // fio: 'Введите Ф.И.О.',
    //         // email: 'Неверный Email',
    //         // tel: 'Введите мобильный телефон',
    //         // iin: 'Неверный ИИН/БИН',
    //         // captcha: 'Введите код с картинки',
    //         // agreement: 'Подтвердите согласие на сбор персональных данных',
    //     },
    //     errorPlacement: function(error, element) {
    //         error.insertAfter('#invalid-' + element.attr('id'));
    //     },
    //     submitHandler: function(form) {
    //         sendAjaxForm('result_form', 'reg_form', 'https://www.sberbank.kz/ru/auto_deposits_cabinet_reg');
    //     }
    // });

    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : sParameterName[1];
            }
        }
    };

    var id_city = getUrlParameter('id_city');
    var id_department = getUrlParameter('id_department');
    var id_sector = getUrlParameter('id_sector');
    var _token = $('.token_js').val();

    $('.js_btn_form').click( function (e){
            e.preventDefault();
        // console.log($('#info').val());
            sendAjaxForm('result_form',
                'form',
                '/form_post?_token=' + _token + '&id_city=' + id_city + '&id_department=' + id_department + '&id_sector=' + id_sector + '&info=' + $('#info').val() + '&name=' + $('#name').val()+ '&tel=' + $('#tel').val()
            )
    });

    function sendAjaxForm(result_form, ajax_form, url) {
        $.ajax({
            url:      url,
            type:     "GET",
            // dataType: "html",
            // data: $("#"+ajax_form).serialize(),
            success: function(response) {
                var id = response.id;
                $('.js_content_step_3').show();
                $('.js_content_step_2').hide();
                // window.location = "/test_result"
                // console.log(response);
                //
                // if(id.length){
                //     window.location = "/test_result"
                // }

                // if(message == 'pass_error'){
                //     console.log(response);
                // } else if (message == 'success') {
                //     window.location = "https://www.sberbank.kz/ru/auto_deposits"
                // } else if (message == 'validate_error') {
                //     console.log(response);
                //     // $('#invalid-captcha').html('Неверно введен код с картинки');
                // }
            },
            error: function(response) {
                console.log(response);
                // $('#result_form').html('Извините, повторите отправку заявки, так как произошёл сбой');
            }
        });
    }
});
