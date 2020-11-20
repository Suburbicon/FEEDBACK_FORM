<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('form/assets/styles/leaveReview.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.js"
            integrity="sha256-DrT5NfxfbHvMHux31Lkhxg42LY6of8TaYyK50jnxRnM=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('form/js/jquery.star-rating-svg.js') }}"></script>
    <script type="text/javascript" src="{{ asset('form/js/main.js') }}"></script>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/svg">
    <title>Форма обращения</title>
</head>
<body class="page">
<section class="review container">
    <h2 class="review__title">Оставьте обращение</h2>

    <form action="/test_result" class="review__wrap">
        <h2 class="review__subtitle">Опишите проблему с которой Вы сталкнулись</h2>

        <div class="review__stars">
            <input type="radio" name="rating" value="5" id="rating_5" class="review__input-star">
            <label for="rating_5" class="review__label-star"></label>
            <input type="radio" name="rating" value="4" id="rating_4" class="review__input-star">
            <label for="rating_4" class="review__label-star"></label>
            <input type="radio" name="rating" value="3" id="rating_3" class="review__input-star">
            <label for="rating_3" class="review__label-star"></label>
            <input type="radio" name="rating" value="2" id="rating_2" class="review__input-star">
            <label for="rating_2" class="review__label-star"></label>
            <input type="radio" name="rating" value="1" id="rating_1" class="review__input-star">
            <label for="rating_1" class="review__label-star"></label>
        </div>
        <div class="review__input-text">
            <textarea type="text" class="review__input" placeholder="Напишите, что вам понравилось..."></textarea>
{{--            <textarea type="text" class="review__input" placeholder="Напишите, что вам не понравилось..."></textarea>--}}
        </div>
        <button class="review__button">Отправить обращение</button>
    </form>
</section>
</body>
</html>
