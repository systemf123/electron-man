<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <meta name="viewport" content="width=device-width">
    <meta name="keywords" content="ключевые слова" />
    <meta name="description" content="описание" />
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body class="">
<div class="wrapper-main">
    <header class="header">
       <div class="container">
          <div class="header__container">
             <div class="header__logo">
                <img src="/assets/img/logo.png" alt="">
             </div>
             <div class="header__search search">
                <form action="" class="search__form">
                   <input type="text" name="search" placeholder="Поиск" class="search__input">
                </form>
             </div>
             <div class="header__user user-bar">
                <div id="user-box" class="user-bar__box">
                   <p class="user-bar__name">Электрон</p>
                   <div class="user-bar__ava">
                      <img src="/assets/img/user-ava.png" alt="" class="user-bar__ava-img">
                   </div>
                   <i class="user-bar__arrow"></i>
                   <ul class="user-bar-nav">
                      <li class="user-bar-nav__item"><a href="#">Моя страница</a></li>
                      <li class="user-bar-nav__item"><a href="#">Выйти</a></li>
                   </ul>
                </div>
             </div>
          </div>
       </div>
    </header>
    <main id="main">
        <section class="user-info">
           <div class="container">
              <div class="user-info__container">
                 <div class="user-info__box shadow-box">
                    <div id="user-status" class="user-info__header">
                       <div class="user-info__name">Электрон Вебов</div>
                       <button id="status-text" class="user-info__status"></button>
                       <div class="user-statua-form">
                          <input id="input-status" placeholder="введите статус" type="text" class="user-statua-form__input">
                          <button class="btn user-statua-form__btn">сохранить</button>
                       </div>
                    </div>
                    <div class="user-info__body">
                       <table class="user-info__params">
                          <tbody>
                          <tr>
                             <td>День рождения:</td>
                             <td>23 сентября 1988 г.</td>
                          </tr>
                          <tr>
                             <td>Семейное положение:</td>
                             <td>женат</td>
                          </tr>
                          <tr>
                             <td>Образование:</td>
                             <td>ИжГТУ им. М.Т. Калашникова (бывш. ИМИ) 12</td>
                          </tr>
                          <tr>
                             <td>Веб-сайт:</td>
                             <td>www.web-electron.ru</td>
                          </tr>
                          </tbody>
                       </table>
                       <div class="user-info__about">
                          <div class="user-info__about-note">
                             <span>Немного о себе:</span>
                          </div>
                          <div class="user-info__about-text">
                             <p>С другой стороны новая модель организационной деятельности влечет за собой процесс внедрения и
                                модернизации новых предложений. Товарищи! новая модель организационной деятельности в значительной
                                степени обуславливает создание новых предложений.</p>
                             <p>Не следует, однако забывать, что укрепление и развитие структуры в значительной степени
                                обуславливает
                                создание систем массового участия.</p>
                             <p>Идейные соображения высшего порядка, а также постоянное информационно-пропагандистское обеспечение
                                нашей деятельности требуют от нас анализа направлений прогрессивного развития.</p>
                             <p>Задача организации, в особенности же укрепление и развитие структуры позволяет оценить значение
                                направлений прогрессивного развития.</p>
                          </div>
                       </div>
                    </div>
                 </div>
                 <div class="user-info__ava shadow-box">
                    <img src="/assets/img/avatar.png" alt="">
                 </div>
              </div>
           </div>
        </section>
        <section class="photos">
            <div class="container">
                <div id="slider" class="photos__container shadow-box">
                    <p class="photos__caption">Фотографии Электрона</p>
                    <ul class="photos-slider">
                        <li class="photos-slider__item">
                            <img src="/assets/img/photo_1.jpg" alt="">
                        </li>
                        <li class="photos-slider__item">
                            <img src="/assets/img/photo_2.jpg" alt="">
                        </li>
                        <li class="photos-slider__item">
                            <img src="/assets/img/photo_3.jpg" alt="">
                        </li>
                        <li class="photos-slider__item">
                            <img src="/assets/img/photo_4.jpg" alt="">
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="posts">
           <div class="container">
              <div class="posts__container">
                 <p id="post-title" class="posts__caption">Записи на вашей стене</p>
                 <div id="post-list" class="post-list">
                    <!--<article class="post-item shadow-box">
                       <i class="post-item__close"></i>
                      <header class="post-item__header">
                         <div class="post-item__header-pictory">
                            <img src="/assets/img/deadpool.png" alt="">
                         </div>
                         <div class="post-item__header-inf">
                            <h2 class="post-item__header-name">Дэдпул Батькович</h2>
                            <time class="post-item__header-time">
                               Вчера в <span>16:06</span>
                            </time>
                         </div>
                      </header>
                       <div class="post-item__message">
                          Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее
                          осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных выступлений
                          в домашних условиях. При создании генератора мы использовали небезизвестный универсальный код речей.
                          Текст генерируется абзацами случайным образом от двух до десяти предложений в абзаце, что позволяет
                          сделать текст более привлекательным и живым для визуально-слухового восприятия.
                       </div>
                    </article>
                    <article class="post-item shadow-box">
                       <i class="post-item__close"></i>
                       <header class="post-item__header">
                         <div class="post-item__header-pictory">
                            <img src="/assets/img/logan.png" alt="">
                         </div>
                         <div class="post-item__header-inf">
                            <h2 class="post-item__header-name">Рассомаха Логинович</h2>
                            <time class="post-item__header-time">
                               Вчера в <span>16:06</span>
                            </time>
                         </div>
                      </header>
                       <div class="post-item__message">
                          Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее
                          осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных выступлений
                          в домашних условиях. При создании генератора мы использовали небезизвестный универсальный код речей.
                          Текст генерируется абзацами случайным образом от двух до десяти предложений в абзаце, что позволяет
                          сделать текст более привлекательным и живым для визуально-слухового восприятия.
                       </div>
                    </article>-->
                 </div>
                 <div class="posts-added">
                    <p class="posts-added__caption">Добавить запись</p>
                    <form id="posts-form" action="" class="posts-form">
                       <input required placeholder="Ваше имя" type="text" name="name" class="posts-form__input posts-form__field shadow-box">
                       <textarea required placeholder="Текст записи..." name="message" class="posts-form__textarea posts-form__field shadow-box"></textarea>
                       <button class="btn posts-form__submit">Отправить</button>
                    </form>
                 </div>
              </div>
           </div>
        </section>
    </main>
    <footer class="footer">
        <div class="container">
            <div class="footer__container">
                <span>elbook 2018</span>
            </div>
        </div>
    </footer>
</div>
<script src="/js/common.js"></script>
</body>
</html>