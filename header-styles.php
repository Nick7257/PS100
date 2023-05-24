<?php

/**
 * Выводим на фронт стили, заданные в консоли темы в разделе Оформление,
 * а также некоторые критические стили для вывода на первом экране
 * Подключаем в зону <head>.
 */

if (!defined('ABSPATH')) {
  exit;
}

add_action('wp_head', 'styles_to_head', 3);
function styles_to_head()
{
  $option = TitanFramework::getInstance('cn3');

  // цвет фона вокруг контейнера сайта
  $bodyBg = $option->getOption('body-bg');

  // цвет шрифта
  $mainColor = $option->getOption('body-color');

  // цвет при наведении мыши
  $colorHover = $option->getOption('hover');

  // фон кнопок
  $buttonBg = $option->getOption('btn-bg');

  // цвет текста кнопок
  $buttonColor = $option->getOption('btn-color');

  // фон кнопок при наведении мыши
  $buttonBgHover = $option->getOption('btn-bg-hov');

  // фон выпадающего меню
  $navDropBg = $option->getOption('nav-drop-bg');

  // цвет пунктов выпадающего меню
  $navDropColor = $option->getOption('nav-drop-color');

  // цвет подсветки пунктов выпадающего меню
  $navDropHover = $option->getOption('nav-drop-bg-hov');

  // фон липкого меню
  $stickyNavBg = $option->getOption('sticky-nav-bg');

  // цвет пунктов липкого меню
  $stickyNavColor = $option->getOption('sticky-nav-color');

  // фон разделов Авторы и Популярное на Главной
  $sectionBg = $option->getOption('section-alt-bg');

  // лого для темного режима
  $logo_dark = $option->getOption('site-logo-dark');

  // показывать кнопки поделиться
  $postSharing = $option->getOption('single-social-loc');
  // включен ли спойлер
  $сommentsBtn = $option->getOption('comments-spoiler-loc');

  // включен ли подвал в ячейках похожих записей
  $postRelatedFooter = $option->getOption('related-footer-loc');

  // включен ли подвал в ячейках случайных записей
  $postRandomFooter = $option->getOption('random-footer-loc');

  // цвет бордюра цитаты
  $blquoteBorder = $option->getOption('blquote-border');

  // фон порядковых номеров в виджете Популярные записи
  $popWidgetBg = $option->getOption('pop-widget-bg');
  
  // фон меток в виджете Популярные записи
  $featWidgetBg = $option->getOption('feat-widget-bg');

?>

  <style media="screen">

:root {
      --mainColor: <?php echo esc_attr($mainColor); ?>;
      --bodyBg: <?php echo esc_attr($bodyBg); ?>;
      --hoverColor: <?php echo esc_attr($colorHover); ?>;
      --btnBg: <?php echo esc_attr($buttonBg); ?>;
      --btnColor: <?php echo esc_attr($buttonColor); ?>;
      --btnBgHover: <?php echo esc_attr($buttonBgHover); ?>;
      --navDropBg: <?php echo esc_attr($navDropBg); ?>;
      --navDropColor: <?php echo esc_attr($navDropColor); ?>;
      --navDropHover: <?php echo esc_attr($navDropHover); ?>;
      --stickyNavBg: <?php echo esc_attr($stickyNavBg); ?>;
      --stickyNavColor: <?php echo esc_attr($stickyNavColor); ?>;
      --sectionBg: <?php echo esc_attr($sectionBg); ?>;
    }

    :root[data-theme="light"] {
      color-scheme: light;
      --mainColor: <?php echo esc_attr($mainColor); ?>;
      --bodyBg: <?php echo esc_attr($bodyBg); ?>;
      --hoverColor: <?php echo esc_attr($colorHover); ?>;
      --btnBg: <?php echo esc_attr($buttonBg); ?>;
      --btnColor: <?php echo esc_attr($buttonColor); ?>;
      --btnBgHover: <?php echo esc_attr($buttonBgHover); ?>;
      --navDropBg: <?php echo esc_attr($navDropBg); ?>;
      --navDropColor: <?php echo esc_attr($navDropColor); ?>;
      --navDropHover: <?php echo esc_attr($navDropHover); ?>;
      --stickyNavBg: <?php echo esc_attr($stickyNavBg); ?>;
      --stickyNavColor: <?php echo esc_attr($stickyNavColor); ?>;
      --sectionBg: <?php echo esc_attr($sectionBg); ?>;
    }

    :root[data-theme="dark"] {
      color-scheme: dark;
      --placeholder: #a7a8ba;
      --bodyBg: rgb(25, 25, 37);
      --mainColor: #f7f6fb;
      --lightColor: #23232e;
      --greyColor: rgb(96, 100, 132);
      --greyBg: #222;
      --borderColor: #333;
      --hoverColor: rgb(101, 147, 233);
      --sectionBg: #292a37;
      --navDropBg: #333646;
      --navDropColor: #f7f6fb;
      --navDropHover: #23232e;
      --stickyNavBg: #333646;
      --stickyNavColor: #f7f6fb;
      --btnBg: <?php echo esc_attr($buttonBg); ?>;
      --btnColor: <?php echo esc_attr($buttonColor); ?>;
      --btnBgHover: <?php echo esc_attr($buttonBgHover); ?>;
    }

    <?php
    // если есть логотип для темного режима, используем его
    if ($logo_dark) : ?>
    .dark-mode-logo,
    .footer-content__img--dark {
      display: none
    }

    html[data-theme="dark"] .dark-mode-logo,
    html[data-theme="dark"] .footer-content__img--dark {
      display: block
    }

    html[data-theme="dark"] .light-mod-logo,
    html[data-theme="dark"] .footer-content__img--light {
      display: none
    }

    <?php endif; ?>
    
    <?php
      // выводим кнопку вверх либо слева, либо справа, по выбору
      if ($option->getOption('backtop-loc')) {
        echo '.back2top{left: 20px} @media only screen and (max-width:414px){.backtop{left: 10px}}';
      } else {
       echo '.back2top{right: 20px} @media only screen and (max-width:414px){.backtop{right: 10px}}';
      }
    ?>

    <?php
        // показывать / скрыть дату и лайки в режиме новостного сайта
        if (!$option->getOption('mag-date-loc')) {
          echo '.item-footer .item-footer__info, .item-footer .last-news__date {display: none} .home-category-item .item-footer {padding: 0 0 1.3rem 0 !important} .feat-article__caption, .related-item__caption, .top-section-article__caption {min-height: auto !important}';
        }

        if (!$option->getOption('mag-likes-loc')) {
          echo '.item-footer .sl-wrapper, .popular-footer .sl-wrapper {display: none}';
        }
        ?><?php
      // если юзер залогинился, убираем предупреждение о персональных данных из формы комментариев
      if (is_user_logged_in()) {
        echo '.comments__form .form-checkbox, .comment .form-checkbox {display: none !important}';
      }
      ?>
      
      <?php
      // если показывается админбар, добавляем несколько пикселей к контейнерам темы для корректировки отступов
      if (is_admin_bar_showing()) {
        echo '.headhesive {top: 30px !important} .mobile-nav-panel {padding-top: 80px !important} .mobile-nav-panel__close {top: 2rem !important}';
      }
    ?>
      
    <?php
    if (is_single()) :
      if (!$postSharing) {
        echo '.post-footer__wrap .post-info-likes {justify-content: center !important}';
      }
    endif;
    ?>
    
    <?php
      if ($postRelatedFooter) :
        echo '.related-posts-item__title {margin: 0; padding: 0 !important}';
      endif;
      ?>
      
      <?php
      if ($postRandomFooter) :
        echo '.random-item__caption { min-height: auto !important}';
      endif;
      ?>


  .top-section {
    margin-top: 0 !important;
  }

  .top-section:not(:first-child) {
    margin-top: 3rem;
  }

  @media (max-width:1100px) {
    .top-section {
      margin-bottom: 3rem !important
    }
  }

  .top-section__list {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    background-color: var(--greyColor);
  }


  @media (max-width:1160px) {
    .top-section__list {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  @media (max-width:500px) {
    .top-section__list {
      display: block;
    }
  }

  .top-section__item {
    position: relative;
  }


  .top-section-article {
    display: block;
    position: relative;
    z-index: 10;
    background-position: center center;
    background-repeat: no-repeat;
    background-size: cover;
    height: 360px;
  }

  @media (max-width:1160px) {
    .top-section-article {
      height: 260px;
    }
  }

  .top-section-article::before {
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1;
    width: 100%;
    height: 100%;
    content: "";
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, .45) 56%, rgba(0, 0, 0, .45) 100%);
    transition: opacity 400ms ease-in;
  }

  .top-section__item:hover .top-section-article::before {
    opacity: 0.8;
    transition: opacity 300ms ease-in;
  }

  .top-section-article__caption {
    min-height: 140px;
    padding: 0 2.5rem;
    position: absolute;
    bottom: 2rem;
    left: 0;
    z-index: 1;
    display: flex;
    flex-direction: column;
    width: 100%;
    height: auto;
    transform: translateY(0);
    transition: transform 400ms ease-in-out;
  }

  @media (max-width:1300px) {
    .top-section-article__caption {
      padding: 0 2rem;
      min-height: auto;
    }
  }

  @media (max-width:700px) {
    .top-section-article__caption {
      padding: 0 1.2rem;
      padding-bottom: 25px;
      bottom: 0;
    }
  }



  @media (max-width:500px) {
    .top-section-article__caption {
      padding: 0 2rem;
      padding-bottom: 35px;
    }
  }

  .top-section-article__title {
    margin-bottom: auto;
    padding-bottom: 1rem;
    display: block;
    font-size: 1.3rem;
    font-weight: var(--bold);
    line-height: 135%;
  }

  @media (max-width:1160px) {
    .top-section-article__title {
      font-size: 1.2rem;
    }
  }

  @media (max-width:600px) {
    .top-section-article__title {
      font-size: 1rem;
    }
  }

  @media (max-width:500px) {
    .top-section-article__title {
      font-size: 1.3rem;
    }
  }

  .top-section-article:hover .hover-bottom-border {
    background-size: 100% 100%;
    transition: background-size 800ms ease-in-out;
  }

  .top-section-article__link {
    color: var(--lightColor);
    text-decoration: none
  }

  .top-section-article__link:hover {
    color: var(--lightColor);
    text-decoration: none
  }

  html[data-theme="dark"] .top-section-article__link {
    color: var(--mainColor);
  }


  .site-header {
    padding-top: 1.2rem;
    border-bottom: 1px solid var(--borderColor);
  }

  .site-header__wrap {
    margin-bottom: 1.5rem !important;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
  }

  @media(max-width: 600px) {
    .site-header__wrap {
      flex-direction: column;
      justify-content: center;
    }
  }

  .site-header__btns {
    display: flex;
    justify-content: end;
  }

  .site-search-btn {
    margin-left: 1rem;
    width: 38px;
    height: 38px;
    background-color: var(--greyBg);
    color: var(--mainColor);
    border-radius: 50%;
  }

  .site-search-btn svg {
    width: 34px;
    height: 34px;
    fill: currentColor;
  }

  .site-header__socials,
  .site-header__btns {
    flex: 1;
  }

  .site-header__branding {
    margin: 0 auto;
    padding: 0 1rem;
    max-width: 300px;
    display: flex;
    justify-content: center;
    position: relative;
  }

  @media(max-width: 1100px) {
    .site-header__branding {
      padding: 0;
      max-width: 230px;
    }
  }

  @media(max-width: 600px) {
    .site-header__branding {
      margin-bottom: 1.2rem;
    }
  }


  .site-title {
    display: inline-flex;
    text-align: center;
    font-size: 1.4rem;
    font-weight: var(--bold);
    line-height: 115%;
  }

  .site-title__link {
    color: var(--mainColor);
    text-decoration: none;
  }

  .site-title__link:hover {
    color: var(--hoverColor);
    text-decoration: none;
  }

  .mobile-socials-btn {
    margin-right: 1rem;
    position: relative;
    z-index: 1;
    display: none;
    width: 38px;
    height: 38px;
    background-color: var(--greyBg);
    color: var(--mainColor);
    border-radius: 50%;
    overflow: hidden;
    transition: transform 800ms ease-in-out;
  }

  .mobile-socials-btn svg {
    width: 24px;
    height: 24px;
    fill: currentColor;
  }

  @media(max-width: 1100px) {
    .site-header__socials {
      display: none;
    }

    .mobile-socials-btn {
      display: block;
    }
  }

  

  html[data-theme="dark"] .site-search-btn,
  html[data-theme="dark"] .mobile-socials-btn,
  html[data-theme="dark"] .theme-switch,
  html[data-theme="dark"] .mobile-menu-btn,
  html[data-theme="dark"] .post-info-ellipses__wrap {
    background-color: #2849a3;
  }


<?php
    if (is_single() || is_page()) :
      switch ($сommentsBtn) {
        case 1:
    ?>
    
    .toggle-comments {
      margin-bottom: 2rem;
      padding: 1rem 0;
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      background-color: var(--btnBg);
      color: var(--btnColor);
      font-family: inherit;
      border-radius: 6px;
      font-size: 1rem;
      line-height: 1;
      font-weight: var(--medium);
      transition: background-color 300ms ease-in-out, color 300ms ease-in-out;
    }

    .toggle-comments:hover {
      background-color: var(--btnBgHover);
      color: var(--btnColor);
    }

    .toggle-comments svg {
      margin-right: 0.7rem;
      fill: currentColor;
      width: 1.5rem;
      height: 1.5rem;
      object-fit: cover;
    }

    .remove-toggle {
      display: none
    }

    .comments__wrapper {
      height: 0;
      display: none;
      overflow: hidden;
      opacity: 0;
    }

    <?php
          break;
        case 2:
          echo '.toggle-comments { display: none }';
          break;
      }
    endif;
    ?>
    
    blockquote{ border-color: <?php echo esc_attr($blquoteBorder); ?> !important}  
    .recent-list__item::before { background-color: <?php echo esc_attr($popWidgetBg); ?> !important}
    .featured-list__item::before { background-color: <?php echo esc_attr($featWidgetBg); ?> !important}

  </style>
<?php
}

//EOF  
