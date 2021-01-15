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
      <img src="/images/quiz/logo.svg" alt="logo" class="page__logo">
    </div>
    <div class="page__box box">
      <div class="box__top">
        <p class="box__title">Рекомендуете ли ЦОН как оперативный центр для получения государственных услуг?</p>
      </div>
      <div class="box__bottom">
        <div class="box__scale scale">
          <p class="scale__title">Оцените по шкале от 1 до 10:</p>
          <form action="#" class="scale__form" id="recommendation-form">
{{--              <input type="hidden" name="_token" value="{{ csrf_token() }}" />--}}
            <ul class="scale__list">
              <li class="scale__item">
                <label class="scale__label">
                  <input name="recommendation_rating" value="1" type="radio" class="scale__radio-input js_recommendation_radio">
                  <span class="scale__radio-wrap">
                  <span class="scale__radio"></span>
                  </span>
                  <span class="scale__number">1</span>
                </label>
              </li>
              <li class="scale__item">
                <label class="scale__label">
                  <input name="recommendation_rating" value="2" type="radio" class="scale__radio-input js_recommendation_radio">
                  <span class="scale__radio-wrap">
                  <span class="scale__radio"></span>
                  </span>
                  <span class="scale__number">2</span>
                </label>
              </li>
              <li class="scale__item">
                <label class="scale__label">
                  <input name="recommendation_rating" value="3" type="radio" class="scale__radio-input js_recommendation_radio">
                  <span class="scale__radio-wrap">
                  <span class="scale__radio"></span>
                  </span>
                  <span class="scale__number">3</span>
                </label>
              </li>
              <li class="scale__item">
                <label class="scale__label">
                  <input name="recommendation_rating" value="4" type="radio" class="scale__radio-input js_recommendation_radio">
                  <span class="scale__radio-wrap">
                  <span class="scale__radio"></span>
                  </span>
                  <span class="scale__number">4</span>
                </label>
              </li>
              <li class="scale__item">
                <label class="scale__label">
                  <input name="recommendation_rating" value="5" type="radio" class="scale__radio-input js_recommendation_radio" checked>
                  <span class="scale__radio-wrap">
                  <span class="scale__radio"></span>
                  </span>
                  <span class="scale__number">5</span>
                </label>
              </li>
              <li class="scale__item">
                <label class="scale__label">
                  <input name="recommendation_rating" value="6" type="radio" class="scale__radio-input js_recommendation_radio">
                  <span class="scale__radio-wrap">
                  <span class="scale__radio"></span>
                  </span>
                  <span class="scale__number">6</span>
                </label>
              </li>
              <li class="scale__item">
                <label class="scale__label">
                  <input name="recommendation_rating" value="7" type="radio" class="scale__radio-input js_recommendation_radio">
                  <span class="scale__radio-wrap">
                  <span class="scale__radio"></span>
                  </span>
                  <span class="scale__number">7</span>
                </label>
              </li>
              <li class="scale__item">
                <label class="scale__label">
                  <input name="recommendation_rating" value="8" type="radio" class="scale__radio-input js_recommendation_radio">
                  <span class="scale__radio-wrap">
                  <span class="scale__radio"></span>
                  </span>
                  <span class="scale__number">8</span>
                </label>
              </li>
              <li class="scale__item">
                <label class="scale__label">
                  <input name="recommendation_rating" value="9" type="radio" class="scale__radio-input js_recommendation_radio">
                  <span class="scale__radio-wrap">
                  <span class="scale__radio"></span>
                  </span>
                  <span class="scale__number">9</span>
                </label>
              </li>
              <li class="scale__item">
                <label class="scale__label">
                  <input name="recommendation_rating" value="10" type="radio" class="scale__radio-input js_recommendation_radio">
                  <span class="scale__radio-wrap">
                  <span class="scale__radio"></span>
                  </span>
                  <span class="scale__number">10</span>
                </label>
              </li>
            </ul>
            <div class="scale__range">
              <div class="scale__range-elem">Не рекомендую</div>
              <div class="scale__range-elem scale__range-elem--right">Порекомендую</div>
            </div>
            <button type="submit" class="scale__btn btn">Оценить</button>
          </form>
        </div>
      </div>
    </div>
  </main>


  <script src="/js/quiz/vendor.js"></script>
  <script src="/js/quiz/jquery.mask.min.js"></script>
  <script src="/js/quiz/script.js"></script>
</body>

</html>
