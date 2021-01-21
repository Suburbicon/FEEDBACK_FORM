"use strict";

$(function () {

    $('#tel-review-form').mask('+99999999999',{
        placeholder: '',
    })
    $('#tel-quiz-form').mask('+99999999999',{
        placeholder: '',
    })

  $('.js_check_placeholder').on('focusout', function () {
    if ($(this).val().length > 0) {
      $(this).siblings('.js_placeholder').addClass('hide');
    } else {
      $(this).siblings('.js_placeholder').removeClass('hide');
    }
  }); // INDEX RECOMMEND FORM

  $('#recommendation-form').on('submit', function (e) {
    e.preventDefault();
    e.stopPropagation(); // TODO AJAX
    let recomendation_rating = $(this).serialize().split('=')[1];

    localStorage.setItem('recomendation_rating',recomendation_rating)

      var paramsGET = {};

      if (window.location.href.match(/.*\?.*/)) {
          for (var i = 0; i < 3; i++) {
              var _tmp = window.location.href.replace(/.*\?/,'')
                  .split('&')[i]
                  .split('=');

              paramsGET[_tmp[0]] = _tmp[1];
          }
      }

      window.location.href = `/info?id_city=${paramsGET['id_city']}&id_department=${paramsGET['id_department']}&id_sector=${paramsGET['id_sector']}`

  }); // INFO PAGE (REVIEW FORM)

  $('#review-form').on('submit', function (e) {
    e.preventDefault();
  }).validate({
    rules: {
      name: {
        required: true
      },
      phone: {
        required: true,
          minlength: 12,
          maxlength: 12
      },
      comment: {
        required: true
      }
    },
    messages: {},
    submitHandler: function submitHandler(form) {
        // TODO AJAX

        let recomendation_rating = localStorage.getItem('recomendation_rating')

        let fetchForm = {};
        let fetchFormTest = {};

        $(form).find('input,textarea').each(function() {
            fetchFormTest[this.name] = $(this).val()
        });

        var paramsGET = {};

        if (window.location.href.match(/.*\?.*/)) {
            for (var i = 0; i < 3; i++) {
                var _tmp = window.location.href.replace(/.*\?/,'')
                    .split('&')[i]
                    .split('=');

                paramsGET[_tmp[0]] = _tmp[1];
            }
        }

        fetchForm['_token'] = fetchFormTest['_token']
        fetchForm['name'] = fetchFormTest['name']
        fetchForm['phone'] = fetchFormTest['phone']
        fetchForm['comment'] = fetchFormTest['comment']
        fetchForm['recomendation_rating'] = recomendation_rating
        fetchForm['id_city'] = paramsGET['id_city']
        fetchForm['id_department'] = paramsGET['id_department']
        fetchForm['id_sector'] = paramsGET['id_sector']

        // http://localhost:8000/info?id_city=1&id_department=1&id_sector=1
        console.log(fetchForm)

        $.ajax({
            url: "/info-fetch",
            type: "POST",
            data: fetchForm,
            dataType: "html",
            success: function(response) {
                console.log(response)
                if(response === 'error'){

                } else if (response === 'success'){

                    window.location = '/thanks-review'
                }
            },
            error: (response) => {
                $('result_form').html('Извините, повторите отправку заявки, так как произошёл сбой')
            }
        })

    },
    errorPlacement: function errorPlacement(error, element) {
        error.insertAfter('#invalid-' + element.attr('id'));
    }
  }); // INFO PAGE (QUIZ FORM)

  $('#quiz-form').on('submit', function (e) {
    e.preventDefault();
  }).validate({
    rules: {
      name: {
        required: true
      },
      phone: {
        required: true,
          minlength: 12,
          maxlength: 12
      }
    },
    messages: {},
    submitHandler: function submitHandler(form) {
        // TODO AJAX

        let recomendation_rating = localStorage.getItem('recomendation_rating')

        let fetchForm = {};
        let liked = '';
        let not_liked = '';

        for (let x = 0; x < $(form).serializeArray().length;x++){
            fetchForm[$(form).serializeArray()[x]['name']] = $(form).serializeArray()[x]['value']
        }

        $.each($(form).serializeArray(), function(key,data) {
            if (data['name'] === 'liked[]'){
                liked += data['value'] + '. '
            }
        })
        $.each($(form).serializeArray(), function(key,data) {
            if (data['name'] === 'not_liked[]'){
                not_liked += data['value'] + '. '
            }
        })

        var paramsGET = {};

        if (window.location.href.match(/.*\?.*/)) {
            for (var i = 0; i < 3; i++) {
                var _tmp = window.location.href.replace(/.*\?/,'')
                    .split('&')[i]
                    .split('=');

                paramsGET[_tmp[0]] = _tmp[1];
            }
        }

        fetchForm['liked'] = liked
        fetchForm['not_liked'] = not_liked
        fetchForm['recomendation_rating'] = recomendation_rating
        fetchForm['id_city'] = paramsGET['id_city']
        fetchForm['id_department'] = paramsGET['id_department']
        fetchForm['id_sector'] = paramsGET['id_sector']


        console.log(fetchForm);

        $.ajax({
            url: "/quiz-fetch",
            type: "POST",
            data: fetchForm,
            dataType: "html",
            success: function(response) {
                console.log(response)
                if(response === 'error'){

                } else if (response === 'success'){
                    window.location = '/thanks-review'
                }
            },
            error: (response) => {
                $('result_form').html('Извините, повторите отправку заявки, так как произошёл сбой')
            }
        })

    },
    errorPlacement: function errorPlacement(error, element) {}
  }); // INFO PAGES

  function checkPage(currentPage) {
    if (currentPage === 1) {
      $('.js_btn_prev_wrap').addClass('hide');
    } else {
      $('.js_btn_prev_wrap').removeClass('hide');
    }
  }

  function openPage(pageId) {
    $('.js_info_page').each(function () {
      if ($(this).data('page-id') === pageId) {
        $(this).removeClass('hide');
      } else {
        $(this).addClass('hide');
      }
    });
  }

  $('.js_open_info_page').on('click', function () {
    var pageId = $(this).data('page-id');
    openPage(pageId);
    checkPage(pageId);
  }); // QUIZ

  var currentQuizNumber = 1;

  function openQuiz(quizNumber) {
    $('.js_quiz').each(function () {
      if ($(this).data('quiz') === quizNumber) {
        $(this).removeClass('hide');
      } else {
        $(this).addClass('hide');
      }
    });
    currentQuizNumber = quizNumber;
  }

  function checkQuiz(currentQuiz) {
    if (currentQuiz === 1) {
      $('.js_page_prev_btn').removeClass('hide');
      $('.js_quiz_prev_btn').addClass('hide');
    } else {
      $('.js_page_prev_btn').addClass('hide');
      $('.js_quiz_prev_btn').removeClass('hide');
    }

    if (currentQuiz > 3) {
      $('.js_quiz_range_wrap').addClass('hide');
    } else {
      $('.js_quiz_range_wrap').removeClass('hide');
    }

    $('.js_current_quiz').text(currentQuiz);
  }

  checkQuiz(1);
  $('.js_quiz_checkbox').on('change', function () {
    var quiz = $(this).closest('.js_quiz'),
        checkboxes = quiz.find('.js_quiz_checkbox'),
        quizBtn = quiz.find('.js_quiz_btn'),
        checkedCheckboxesCounter = 0;
    checkboxes.each(function () {
      if ($(this).is(':checked')) {
        checkedCheckboxesCounter += 1;
      }
    });

    if (checkedCheckboxesCounter > 0 && checkedCheckboxesCounter < 4) {
      quizBtn.prop('disabled', false);
    } else {
      quizBtn.prop('disabled', true);
    }
  });
  $('.js_quiz_btn').on('click', function () {
    var nextQuizNumber = $(this).data('next-quiz');
    openQuiz(nextQuizNumber);
    checkQuiz(nextQuizNumber);
  });
  $('.js_quiz_prev_btn').on('click', function () {
    checkQuiz(currentQuizNumber - 1);
    openQuiz(currentQuizNumber - 1);
  }); // QUIZ RATING

  $('.js_quiz_rating').on('click', function () {
    var quiz = $(this).closest('.js_quiz'),
        radioBtns = quiz.find('.js_quiz_rating'),
        quizBtn = quiz.find('.js_quiz_btn'),
        currentRating = +$(this).val();
    quizBtn.prop('disabled', false);
    radioBtns.each(function (index) {
      if (index < currentRating) {
        $(this).siblings('.js_quiz_rating_star').addClass('active');
      } else {
        $(this).siblings('.js_quiz_rating_star').removeClass('active');
      }
    });
  }); // OTHER CHECKBOX

  $('.js_liked_other_textarea').on('input', function () {
    $('.js_liked_other_checkbox').val($(this).val());
  });
});
