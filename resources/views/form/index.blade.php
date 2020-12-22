<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Smart Comment</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('form/assets/styles/main.css') }}">
    <script type="text/javascript" src="{{ asset('form/js/jquery-3.2.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('form/js/main.js') }}?=v3"></script>
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/svg">
</head>
<body>
<section class="content">
    <div class="content__wrap container">
        <div class="content__logo-wrap">
            <img src="{{ asset('form/assets/image/logo.svg') }}" alt="" class="content__logo">
        </div>
        <div class="content__info info js_content_step_1">
            <h2 class="info__title">Нажмите, если вы оказались недовольны сервисом</h2>
            <img src="{{ asset('form/assets/image/dis.png') }}" alt="" class="info__img js_dis">
        </div>
        <form action="" class="content__form form js_content_step_2">
            <input type="hidden" name="_token" class="token_js" value="{{ csrf_token() }}">
            <h1 class="form__title">Оставьте отзыв</h1>
            <div class="form__fields">
                <input type="text" class="form__filed" name="name" id="name" placeholder="Имя">
            </div>
            <div class="form__fields">
                <input type="tel" class="form__filed" name="tel" id="tel" placeholder="Телефон">
            </div>
            <div class="form__fields">
                <textarea  class="form__filed textarea" name="info" id="info" cols="20" rows="10" placeholder="Оставьте комментарий"></textarea>
            </div>
            <button class="content__button js_btn_form">
                <span class="content__button-title">Отправить отзыв</span>
            </button>
        </form>
        <div class="content__info info js_content_step_3">
            <h2 class="info__title">Спасибо за отзыв</h2>
            <img src="{{ asset('form/assets/image/like.png') }}" alt="" class="info__img">
        </div>
    </div>
</section>
<script type="text/javascript" src="https://smartcall.kz/js/smartcall.js?smartcall_code=z-x6tmWR7e9xy-6aiHjj_XFhAnH77VUz&v=1" charset="UTF-8"></script>
</body>
</html>
{{--<html lang="ru">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport"--}}
{{--          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--    <link rel="stylesheet" href="{{ asset('form/assets/styles/leaveReview.css') }}">--}}
{{--    <link rel="preconnect" href="https://fonts.gstatic.com">--}}
{{--    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500&display=swap" rel="stylesheet">--}}
{{--    <script src="https://code.jquery.com/jquery-3.5.1.slim.js"--}}
{{--            integrity="sha256-DrT5NfxfbHvMHux31Lkhxg42LY6of8TaYyK50jnxRnM=" crossorigin="anonymous"></script>--}}
{{--    <script type="text/javascript" src="{{ asset('form/js/jquery.star-rating-svg.js') }}"></script>--}}
{{--    <script type="text/javascript" src="{{ asset('form/js/jquery-3.2.1.min.js') }}"></script>--}}
{{--    <script type="text/javascript" src="{{ asset('form/js/main.js') }}"></script>--}}
{{--    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/svg">--}}
{{--    <title>Форма обращения</title>--}}
{{--</head>--}}
{{--<body class="page">--}}
{{--<section class="review container">--}}
{{--    <h2 class="review__title">Оставьте обращение</h2>--}}

{{--    <form class="review__wrap">--}}
{{--        <h2 class="review__subtitle">Опишите проблему с которой Вы сталкнулись</h2>--}}
{{--        <input type="hidden" name="_token" class="token_js" value="{{ csrf_token() }}">--}}
{{--        <input type="text" hidden value="1" name="id_city">--}}
{{--        <input type="text" hidden value="2" name="id_department">--}}
{{--        <input type="text" hidden value="3" name="id_sector">--}}

{{--        <div class="review__stars">--}}
{{--            <input type="radio" name="rating" value="5" id="rating_5" class="review__input-star">--}}
{{--            <label for="rating_5" class="review__label-star"></label>--}}
{{--            <input type="radio" name="rating" value="4" id="rating_4" class="review__input-star">--}}
{{--            <label for="rating_4" class="review__label-star"></label>--}}
{{--            <input type="radio" name="rating" value="3" id="rating_3" class="review__input-star">--}}
{{--            <label for="rating_3" class="review__label-star"></label>--}}
{{--            <input type="radio" name="rating" value="2" id="rating_2" class="review__input-star">--}}
{{--            <label for="rating_2" class="review__label-star"></label>--}}
{{--            <input type="radio" name="rating" value="1" id="rating_1" class="review__input-star">--}}
{{--            <label for="rating_1" class="review__label-star"></label>--}}
{{--        </div>--}}
{{--        <div class="review__input-text">--}}
{{--            <textarea name="info" type="text" class="review__input" id="info" placeholder="Опишите, проблему ..."></textarea>--}}
{{--            <textarea type="text" class="review__input" placeholder="Напишите, что вам не понравилось..."></textarea>--}}
{{--        </div>--}}
{{--        <button class="review__button form_post_js">Отправить обращение</button>--}}
{{--    </form>--}}
{{--</section>--}}
{{--</body>--}}
{{--</html>--}}
