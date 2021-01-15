<!doctype html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>SmartComment</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="HandheldFriendly" content="true">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/quiz/quiz.css">
</head>

<body class="page container">


<main class="page__content">
    <div class="page__logo-wrap">
        <div class="page__btn-prev-wrap js_btn_prev_wrap hide">
            <button class="page__btn-prev js_page_prev_btn js_open_info_page" data-page-id="1">
                <img src="/images/quiz/arrow-l.svg" alt="arrow left" class="page__btn-prev-icon">
            </button>
            <button class="page__btn-prev js_quiz_prev_btn hide">
                <img src="/images/quiz/arrow-l.svg" alt="arrow left" class="page__btn-prev-icon">
            </button>
        </div>
        <img src="/images/quiz/logo.svg" alt="logo" class="page__logo">
    </div>
    <div class="page__info info">

        <div class="info__page js_info_page info-main" data-page-id="1">
            <p class="info-main__title">Уважаемый респондент!</p>
            <p class="info-main__desc">
                Предлагаем Вам выразить свое мнение по качеству оказания услуг в отделах по обслуживания населения Госкорпорации.
            </p>
            <div class="info-main__btn-wrap">
                <button class="info-main__btn btn js_open_info_page" data-page-id="2">Оставьте отзыв</button>
                <button class="info-main__btn btn btn--transparent js_open_info_page" data-page-id="3">Пройдите опрос</button>
            </div>
        </div>

        <div class="info__page js_info_page info-- hide" data-page-id="2">
            <p class="info-review__title">Оставьте отзыв</p>
            <form action="#" class="info-review__form" novalidate id="review-form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <label class="info-review__label field">
                    <input name="name" id="name-review-form" type="text" class="info-review__input input field__input js_check_placeholder">
                    <span class="info-review__placeholder field__placeholder js_placeholder">ФИО <span
                            class="field__placeholder--require">*</span></span>
                </label>
                <label class="info-review__label field">
                    <input name="phone" id="tel-review-form" type="tel" class="info-review__input input field__input js_check_placeholder">
                    <span class="info-review__placeholder field__placeholder js_placeholder">Телефон <span
                            class="field__placeholder--require">*</span></span>
                </label>
                <label class="info-review__label field">
                    <textarea name="comment" id="comment-review-form" type="text" class="info-review__input input input--textarea field__input js_check_placeholder"></textarea>
                    <span class="info-review__placeholder field__placeholder field__placeholder--textarea js_placeholder">Оставьте комментарий <span
                            class="field__placeholder--require">*</span></span>
                </label>
                <button type="submit" class="info-review__btn btn">Отправить отзыв</button>
            </form>
        </div>

        <div class="info__page js_info_page info-quiz hide" data-page-id="3">
            <p class="info-quiz__range js_quiz_range_wrap">
                Вопрос <span class="js_current_quiz">1</span><span class="info-quiz__range--minor">/3</span>
            </p>
            <form action="#" class="info-quiz__form" id="quiz-form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <ul class="info-quiz__list">


                    <li class="info-quiz__item box js_quiz" data-quiz="1">
                        <div class="box__top">
                            <p class="box__title">Что Вам понравилось при получении услуг в&nbsp;ООН (ЦОН)?</p>
                        </div>
                        <div class="box__bottom box__bottom--quiz">
                            <div class="box__quiz quiz">
                                <p class="quiz__warn">Укажите не более 3 ответов</p>
                                <ul class="quiz__list">
                                    <li class="quiz__item">
                                        <label class="quiz__label">
                                            <input name="liked[]" type="checkbox" class="quiz__checkbox-input js_quiz_checkbox" value="Легкость и простота процесса сбора и сдачи документов">
                                            <span class="quiz__checkbox"></span>
                                            <span class="quiz__text">
                        Легкость и простота процесса сбора и сдачи документов;
                      </span>
                                        </label>
                                    </li>
                                    <li class="quiz__item">
                                        <label class="quiz__label">
                                            <input name="liked[]" type="checkbox" class="quiz__checkbox-input js_quiz_checkbox" value="Вежливость и приветливость работников ООН (ЦОН)">
                                            <span class="quiz__checkbox"></span>
                                            <span class="quiz__text">
                        Вежливость и приветливость работников ООН (ЦОН);
                      </span>
                                        </label>
                                    </li>
                                    <li class="quiz__item">
                                        <label class="quiz__label">
                                            <input name="liked[]" type="checkbox" class="quiz__checkbox-input js_quiz_checkbox" value="Доступность и удобство получения информации о государственной услуге в ООН (ЦОН)">
                                            <span class="quiz__checkbox"></span>
                                            <span class="quiz__text">
                        Доступность и удобство получения информации о государственной услуге в ООН (ЦОН);
                      </span>
                                        </label>
                                    </li>
                                    <li class="quiz__item">
                                        <label class="quiz__label">
                                            <input name="liked[]" type="checkbox" class="quiz__checkbox-input js_quiz_checkbox" value="Чистота, удобство и комфорт в залах ожидания ООН (ЦОН)">
                                            <span class="quiz__checkbox"></span>
                                            <span class="quiz__text">
                        Чистота, удобство и комфорт в залах ожидания ООН (ЦОН);
                      </span>
                                        </label>
                                    </li>
                                    <li class="quiz__item">
                                        <label class="quiz__label">
                                            <input name="liked[]" type="checkbox" class="quiz__checkbox-input js_quiz_checkbox" value="Компетентность работника ООН (ЦОН) по интересующим Вас вопросам">
                                            <span class="quiz__checkbox"></span>
                                            <span class="quiz__text">
                        Компетентность работника ООН (ЦОН) по интересующим Вас вопросам;
                      </span>
                                        </label>
                                    </li>
                                    <li class="quiz__item">
                                        <label class="quiz__label">
                                            <input name="liked[]" type="checkbox" class="quiz__checkbox-input js_quiz_checkbox" value="Короткое время ожидания в очереди (до 15 минут)">
                                            <span class="quiz__checkbox"></span>
                                            <span class="quiz__text">
                        Короткое время ожидания в очереди (до 15 минут);
                      </span>
                                        </label>
                                    </li>
                                    <li class="quiz__item">
                                        <label class="quiz__label">
                                            <input name="liked[]" type="checkbox" class="quiz__checkbox-input js_quiz_checkbox js_liked_other_checkbox" value="">
                                            <span class="quiz__checkbox"></span>
                                            <span class="quiz__text">
                        Другое
                      </span>
                                        </label>
                                        <textarea name="comment" class="quiz__textarea input input--textarea js_liked_other_textarea" placeholder="Ваш ответ"></textarea>
                                    </li>
                                </ul>
                                <button type="button" class="quiz__btn btn js_quiz_btn" data-next-quiz="2" disabled>Далее</button>
                            </div>
                        </div>
                    </li>


                    <li class="info-quiz__item box hide js_quiz" data-quiz="2">
                        <div class="box__top">
                            <p class="box__title">Что Вам не понравилось при получении услуг в ООН?</p>
                        </div>
                        <div class="box__bottom box__bottom--quiz">
                            <div class="box__quiz quiz">
                                <p class="quiz__warn">Укажите не более 3 ответов</p>
                                <ul class="quiz__list">
                                    <li class="quiz__item">
                                        <label class="quiz__label">
                                            <input name="not_liked[]" type="checkbox" class="quiz__checkbox-input js_quiz_checkbox" value="Сложность  процесса сбора и сдачи документов">
                                            <span class="quiz__checkbox"></span>
                                            <span class="quiz__text">
                        Сложность  процесса сбора и сдачи документов;
                      </span>
                                        </label>
                                    </li>
                                    <li class="quiz__item">
                                        <label class="quiz__label">
                                            <input name="not_liked[]" type="checkbox" class="quiz__checkbox-input js_quiz_checkbox" value="Грубость и неотзывчивость работников ООН (ЦОН)">
                                            <span class="quiz__checkbox"></span>
                                            <span class="quiz__text">
                        Грубость и неотзывчивость работников ООН (ЦОН);
                      </span>
                                        </label>
                                    </li>
                                    <li class="quiz__item">
                                        <label class="quiz__label">
                                            <input name="not_liked[]" type="checkbox" class="quiz__checkbox-input js_quiz_checkbox" value="Отсутствие информации о государственной услуге в ООН (ЦОН)">
                                            <span class="quiz__checkbox"></span>
                                            <span class="quiz__text">
                        Отсутствие информации о государственной услуге в ООН (ЦОН);
                      </span>
                                        </label>
                                    </li>
                                    <li class="quiz__item">
                                        <label class="quiz__label">
                                            <input name="not_liked[]" type="checkbox" class="quiz__checkbox-input js_quiz_checkbox" value="Отсутствие удобства и комфорта  в залах ожидания ООН (ЦОН)">
                                            <span class="quiz__checkbox"></span>
                                            <span class="quiz__text">
                        Отсутствие удобства и комфорта  в залах ожидания ООН (ЦОН);
                      </span>
                                        </label>
                                    </li>
                                    <li class="quiz__item">
                                        <label class="quiz__label">
                                            <input name="not_liked[]" type="checkbox" class="quiz__checkbox-input js_quiz_checkbox" value="Некомпетентность работников ООН (ЦОН) по интересующим Вас вопросам">
                                            <span class="quiz__checkbox"></span>
                                            <span class="quiz__text">
                        Некомпетентность работников ООН (ЦОН) по интересующим Вас вопросам;
                      </span>
                                        </label>
                                    </li>
                                    <li class="quiz__item">
                                        <label class="quiz__label">
                                            <input name="not_liked[]" type="checkbox" class="quiz__checkbox-input js_quiz_checkbox" value="Длительное время ожидания в очереди (более 15 минут)">
                                            <span class="quiz__checkbox"></span>
                                            <span class="quiz__text">
                        Длительное время ожидания в очереди (более 15 минут);
                      </span>
                                        </label>
                                    </li>
                                    <li class="quiz__item">
                                        <label class="quiz__label">
                                            <input name="not_liked[]" type="checkbox" class="quiz__checkbox-input js_quiz_checkbox" value="Санитарные нормы">
                                            <span class="quiz__checkbox"></span>
                                            <span class="quiz__text">
                        Санитарные нормы;
                      </span>
                                        </label>
                                    </li>
                                </ul>
                                <button type="button" class="quiz__btn btn js_quiz_btn" data-next-quiz="3" disabled>Далее</button>
                            </div>
                        </div>
                    </li>


                    <li class="info-quiz__item box hide js_quiz" data-quiz="3">
                        <div class="box__top">
                            <p class="box__title">Просим Вас оценить удовлетворенность качеством оказания государственных услуг в ООНе
                            </p>
                        </div>
                        <div class="box__bottom box__bottom--quiz">
                            <div class="box__quiz-rating quiz-rating">
                                <p class="quiz-rating__title">Оцените по шкале от 1 до 5:</p>
                                <ul class="quiz-rating__list">
                                    <li class="quiz-rating__item">
                                        <label class="quiz-rating__label">
                                            <input name="rating" value="1" type="radio" class="quiz-rating__radio-input js_quiz_rating">
                                            <span class="quiz-rating__star js_quiz_rating_star"></span>
                                        </label>
                                    </li>
                                    <li class="quiz-rating__item">
                                        <label class="quiz-rating__label">
                                            <input name="rating" value="2" type="radio" class="quiz-rating__radio-input js_quiz_rating">
                                            <span class="quiz-rating__star js_quiz_rating_star"></span>
                                        </label>
                                    </li>
                                    <li class="quiz-rating__item">
                                        <label class="quiz-rating__label">
                                            <input name="rating" value="3" type="radio" class="quiz-rating__radio-input js_quiz_rating">
                                            <span class="quiz-rating__star js_quiz_rating_star"></span>
                                        </label>
                                    </li>
                                    <li class="quiz-rating__item">
                                        <label class="quiz-rating__label">
                                            <input name="rating" value="4" type="radio" class="quiz-rating__radio-input js_quiz_rating">
                                            <span class="quiz-rating__star js_quiz_rating_star"></span>
                                        </label>
                                    </li>
                                    <li class="quiz-rating__item">
                                        <label class="quiz-rating__label">
                                            <input name="rating" value="5" type="radio" class="quiz-rating__radio-input js_quiz_rating">
                                            <span class="quiz-rating__star js_quiz_rating_star"></span>
                                        </label>
                                    </li>
                                </ul>
                                <textarea name="comment_stars" class="quiz-rating__textarea input input--textarea" placeholder="Оставьте комментарий"></textarea>
                                <button type="button" class="quiz-rating__btn btn js_quiz_btn" data-next-quiz="4" disabled>Далее
                                </button>
                            </div>
                        </div>
                    </li>


                    <li class="info-quiz__item quiz-form hide js_quiz" data-quiz="4">
                        <p class="quiz-form__title">Заполните форму</p>
                        <div class="quiz-form__body">
                            <label class="quiz-form__label field">
                                <input name="name" type="text" class="quiz-form__input input field__input js_check_placeholder">
                                <span class="quiz-form__placeholder field__placeholder js_placeholder">ФИО <span
                                        class="field__placeholder--require">*</span></span>
                            </label>
                            <label class="quiz-form__label field">
                                <input name="phone" id="tel-quiz-form" type="tel" class="quiz-form__input input field__input js_check_placeholder">
                                <span class="quiz-form__placeholder field__placeholder js_placeholder">Телефон <span
                                        class="field__placeholder--require">*</span></span>
                            </label>
                        </div>
                        <button type="submit" class="quiz-form__btn btn">Отправить отзыв</button>
                    </li>


                </ul>
            </form>
        </div>

    </div>
</main>


<script src="/js/quiz/vendor.js"></script>
<script src="/js/quiz/jquery.mask.min.js"></script>
<script src="/js/quiz/script.js"></script>
</body>

</html>
