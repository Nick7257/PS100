<?php

/*
Функции темы
*/

 
/*
Фавикон
*/
if (!function_exists('add_favicons')) {
  add_action('gp_header', 'add_favicons');
  function add_favicons() {

    $option = TitanFramework::getInstance('cn3');
    $favicon = $option->getOption('favicon');

    if (is_numeric($favicon)) {
      $imageAttachment = wp_get_attachment_image_src($favicon, $size = 'full', $icon = false);
      $imageSrc = $imageAttachment[0];
    } else {
      $imageSrc = $favicon;
    }

?>

    <link rel="icon" type="image/x-icon" href="<?php echo esc_url($imageSrc); ?>">
    <link rel="apple-touch-icon" href="<?php echo esc_url($imageSrc); ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo esc_url($imageSrc); ?>">
    <link rel="apple-touch-icon" sizes="192x192" href="<?php echo esc_url($imageSrc); ?>">
    <link rel="apple-touch-startup-image" href="<?php echo esc_url($imageSrc); ?>">

    <?php
  }
}


/* 
Cтатистика Гугл и пиксели 
*/
if (!function_exists('add_stat_tools')) {
  add_action('gp_header', 'add_stat_tools');
  function add_stat_tools () {

    $option = TitanFramework::getInstance('cn3');

    // статистика Google analytics, если есть
    $analytics = $option->getOption('google-stat');

    // код верификации сайта, если есть
    $verification = $option->getOption('verification');

    // пиксели Facebook или ВКонтакте, если есть
    $pixel = $option->getOption('pixel');


    // Google Analytics
    if ($analytics) {
      echo $analytics;
    }

    //верификация сайта
    if ($verification) {
      echo $verification;
    }

    //выводим пиксель вконтакте или facebook'a, если есть
    if ($pixel) {
      echo $pixel;
    }
  }
}

/* 
Изображение записи для расшаривания и предзагрузки
*/

if ( ! function_exists( 'add_og_imgs' ) ) {
  add_action('gp_header', 'add_og_imgs');
    function add_og_imgs() {

     if (has_post_thumbnail() ) {  

      $attachment_image = wp_get_attachment_url( get_post_thumbnail_id() );

      echo '<meta property="og:image" content="' . esc_attr( $attachment_image ) . '">';
      echo '<link rel="preload" as="image" href="' . esc_url( $attachment_image ) . '">';

     }
   }
 }

/*
Текстовый заголовок в шапке
*/
if (!function_exists('add_header_title')) {
  add_action('gp_header', 'add_header_title');
  function add_header_title() {
    $site_name = get_bloginfo('name');

    if (is_front_page()) { ?>
      <h1 class="site-title">
        <a class="site-title__link" href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html($site_name); ?>
        </a>
      </h1>
    <?php } else { ?>
      <span class="site-title">
        <a class="site-title__link" href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html($site_name); ?>
        </a>
      </span>
    <?php
    }
  }
}


/*
Логотип в шапке
*/
if (!function_exists('add_header_logo')) {
  add_action('gp_header', 'add_header_logo');
  function add_header_logo() {

    $option = TitanFramework::getInstance('cn3');
    
    // лого для светлого режима
    $logo_img = $option->getOption('site-logo');

    // лого для темного режима
    $logo_dark = $option->getOption('site-logo-dark');

    // ширина и высота svg лого
    $svgLogoWidth = $option->getOption('svg-logo-width');
    $svgLogoHeight = $option->getOption('svg-logo-height');

    $site_name = get_bloginfo('name');

    if (is_numeric($logo_img)) {
      $imageAttachment = wp_get_attachment_image_src($logo_img, $size = 'full', $icon = false);
      $imageSrc = $imageAttachment[0];
      $width = $imageAttachment[1];
      $height = $imageAttachment[2];
    } else {
      // лого по умолчанию
      $imageSrc = $logo_img;
      $width = 265;
      $height = 65;
    }

    if ($logo_dark) {
      if (is_numeric($logo_dark)) {
        $imageAttachment2 = wp_get_attachment_image_src($logo_dark, $size = 'full', $icon = false);
        $imageSrc2 = $imageAttachment2[0];
        $width = $imageAttachment2[1];
        $height = $imageAttachment2[2];
      } else {
        $imageSrc2 = $logo_dark;
      }
    }
    
    if ($svgLogoWidth) :
      $width = $svgLogoWidth;
    endif;

      if ($svgLogoHeight) :
        $height = $svgLogoHeight;
      endif;
    ?>

    <a class="site-title__link" href="<?php echo esc_url(home_url('/')); ?>">
      <img class="site-title__logo light-mod-logo" 
      src="<?php echo esc_url($imageSrc); ?>" 
      alt="<?php echo esc_attr($site_name); ?>" 
      width="<?php echo esc_attr($width); ?>" height="<?php echo esc_attr($height); ?>">

      <?php if ($logo_dark) : ?>

        <img class="site-title__logo dark-mode-logo" 
        src="<?php echo esc_url($imageSrc2); ?>" 
        alt="<?php echo esc_attr($site_name); ?>" 
        width="<?php echo esc_attr($width); ?>" height="<?php echo esc_attr($height); ?>">

      <?php endif;  ?>
    </a>

    <?php
    // если выбран логотип, добавим к нему заголовок h1
    if (is_front_page()) : ?>
      <h1 class="screen-reader-text"><?php echo esc_html($site_name); ?></h1>
    <?php endif; ?>

  <?php
  }
}


/*
Переключатель darkmode
*/
if (!function_exists('add_darkmode_switch')) {
  add_action('gp_header', 'add_darkmode_switch');
  function add_darkmode_switch() { ?>

    <div class="theme-switch">
      <label class="switch"><input type="checkbox" class="gp-checkbox" aria-label="<?php echo _e('Изменить режим - светлый или темный', 'citynews-3'); ?>"></label>
    </div>

    <?php
  }
}

 
/*
Десктопное меню 
Для экономии ресурсов, используется также как моб меню
*/
if (!function_exists('add_main_menu')) {
  add_action('gp_nav', 'add_main_menu');
  function add_main_menu() {
    $menu = wp_nav_menu(array(
      'theme_location' => 'primary',
      'container' => '',
      'container_class' => '',
      'menu_class' => 'nav-menu',
      'link_before'   => '<span itemprop="name">',
      'link_after'   => '</span>',
      'fallback_cb' => '',
    ));
    echo strip_tags($menu, '<ul><li><a>');
  }
}


/*
Доп. меню в подвале
*/
if (!function_exists('add_footer_menu')) {
  add_action('gp_footer', 'add_footer_menu');
  function add_footer_menu() {
    $menu = wp_nav_menu(array(
      'theme_location' => 'secondary',
      'container' => '',
      'container_class' => '',
      'menu_class' => 'footer-menu',
      'fallback_cb' => '',
    ));
    echo strip_tags($menu, '<ul><li><a>');
  }
}


/*
Панель мобильного меню 
*/
if (!function_exists('add_mobile_menu')) {
  add_action('gp_footer', 'add_mobile_menu');
  function add_mobile_menu() { 
    ?>

    <div class="mobile-nav-panel">

      <nav class="mobile-nav" itemscope itemtype="http://www.schema.org/SiteNavigationElement">
        <?php 
        // моб меню
          add_main_menu(); 
        ?>
      </nav>

      <button class="mobile-nav-panel__close" aria-label="<?php echo _e('Закрыть мобильное меню', 'citynews-3'); ?>"></button>

    </div><!-- // mobile-nav-panel -->

    <div class="mobile-overlay"></div>

    <?php
  }
}



/*
Текстовый анонс
*/
if (!function_exists('add_text_anons')) {
  add_action('gp_content', 'add_text_anons');
  function add_text_anons($count) {
    $content = get_the_content();
    $trimmed_content = wp_trim_words($content, $count, '...');
    return $trimmed_content;
  }
}


/*
Расчет чтения
*/
if (!function_exists('gp_read_time')) {
  function gp_read_time() {
    $text = get_the_content('');
    $words = str_word_count(strip_tags($text), 0, 'абвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ');
    if (!empty($words)) {
      $time_in_minutes = ceil($words / 200);
      return $time_in_minutes;
    }
    return false;
  }
}


/*
Аватар / фото автора
*/
if (!function_exists('get_author_foto')) {
  function get_author_foto() {
    global $post;
    $author_img = get_avatar_url($post, "size=46");
    $custom_img = get_the_author_meta('foto');
    // если нет локального фото, берем из gravatar.com
    $img_url = empty($custom_img) ? $author_img : $custom_img;

    return $img_url;
  }
}


/*
Шапка в шаблоне записи
*/
if (!function_exists('add_post_header')) {
  add_action('gp_content', 'add_post_header');
  function add_post_header() {
   
    $option = TitanFramework::getInstance('cn3');

    // включен ли блок с автором и датой
    $postDateAuthor = $option->getOption('single-date-author-loc');

    // показывать время на чтение
    $postReading = $option->getOption('single-reading-loc');

    // показывать количество комментариев
    $postCommCount = $option->getOption('single-comments-loc');

    // показывать лайки в шапке
    $postHeaderLikes = $option->getOption('single-like-loc');

    // id автора
    $author_id = get_the_author_meta('ID');
    // фото / аватар автора
    $img_url = get_author_foto();
    // ссылка на архив автора
    $author_link = get_the_author_posts_link();
    // дата публикации 
    $date = get_the_date('d F Y');

  ?>
    <div class="post-info">

      <?php
      if ($postDateAuthor) :
      ?>

        <div class="post-info__author">

          <div class="post-info__img">
            <a href="<?php echo esc_url(get_author_posts_url($author_id)); ?>">
              <img src="<?php echo esc_url($img_url); ?>" alt="<?php the_author(); ?>" width="46" height="46">
            </a>
          </div><!-- // post-info__img -->

          <div class="post-info__about">

            <?php
            printf('<span class="post-info__name">' . $author_link . '</span>');
            ?>


            <?php
            printf('<span class="post-info__date">' . esc_html($date) . '</span>');
            ?>

          </div><!-- // post-info__about -->
        </div><!-- // post-info__author -->

      <?php endif; ?>

      <div class="post-info__wrap">

        <?php
        if ($postReading) :
        ?>

          <span class="post-info__reading reading-time">
            <svg class="reading-time__icon">
              <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/sprite.svg#clock"></use>
            </svg>

            <?php _e('На чтение', 'citynews-3'); ?>:
            <?php plural_form(
              gp_read_time(),
              array('минута', 'минуты', 'минут')
            );
            ?>
          </span>

        <?php endif; ?>

        <?php 
          if (comments_open()) : 
        ?>

          <?php
          if ($postCommCount) {
          ?>

            <span class="post-info__comments comments-info">
            <svg class="comments-info__icon">
              <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/sprite.svg#comments"></use>
            </svg>
              <!--noindex-->
              <a href="#comments" rel="nofollow" class="post-info__link">
                <?php
                  plural_form(
                    get_comments_number(),
                    array(
                      __('комментарий', 'citynews-3'), 
                      __('комментария', 'citynews-3'), 
                      __('комментариев', 'citynews-3'),
                    )
                  );
                ?>
              </a>
              <!--/noindex-->
            </span>
          <?php } ?>

        <?php endif; ?>

        <?php
          if ($postHeaderLikes) :
        ?>

          <div class="post-info__likes post-info-likes">
            <span class="post-info-likes__title"><?php _e('Нравится', 'citynews-3'); ?>:</span>

            <?php
              // показываем лайки
              echo get_simple_likes_button(get_the_ID()); 
            ?>

          </div><!--// post-info__likes -->

          <?php endif; ?>

          </div><!--// post-info__wrap -->

        <div class="post-info-ellipses__wrap">
          <svg>
            <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/sprite.svg#ellipses"></use>
          </svg>
        </div>

    <div class="post-info-mobile"></div>

    </div><!--// post-info -->

  <?php
  }
}


/*
Подвал в шаблоне записи
*/
if (!function_exists('add_post_footer')) {
  add_action('gp_content', 'add_post_footer');
  function add_post_footer( ) {

    $option = TitanFramework::getInstance('cn3');
    // показывать метки
    $postTags = $option->getOption('single-tags-loc');

    // показывать кнопки поделиться
    $postSharing = $option->getOption('single-social-loc');

    // показывать кнопки поделиться
    $postFooterLikes = $option->getOption('single-footer-like-loc');

  ?>

    <div class="single-post__footer post-footer">

      <?php if (!empty($custom_descr)) : ?>
        <div class="single-post__custom">
          <?php
          // произвольный контент в подвале
          echo $custom_descr;
          ?>
        </div><!-- // single-post__custom -->
      <?php endif; ?>

      <?php
      // метки, если включены
      if ($postTags) :
        if (has_tag()) {
          echo '<div class="single-post__tags">';
          the_tags('', '');
          echo '</div>';
        }
      endif;
      ?>

      <div class="post-footer__wrap">
        <?php
        // кнопки Поделиться, если включены
        if ($postSharing) :
          get_template_part('inc/socials/share-btns');
        endif;
        ?>

        <?php
        // лайки в подвале, если включены
        if ($postFooterLikes) : ?>

          <div class="post-info-likes">
            <span class="post-info-likes__title"><?php _e('Нравится', 'citynews-3'); ?>:</span>
            <?php echo get_simple_likes_button(get_the_ID()); ?>
          </div><!--// post-info__likes -->
        <?php endif; ?>

      </div><!-- // post-footer__wrap -->
    </div><!-- // single-post__footer -->

  <?php
  }
}


/*
Получаем имя рубрики из её id для шапки рубрик
*/
function cat_id_to_name($id) {
  foreach ((array)(get_categories()) as $category) {
    if ($id == $category->cat_ID) {
      return $category->cat_name;
    }
  }
}

/*
Подвал записей в базовом шаблоне рубрик
*/
if (!function_exists('add_item_footer')) {
  add_action('gp_content', 'add_item_footer');
  function add_item_footer() {
    $date = get_the_date('d F Y');
  ?>

    <div class="item__footer item-footer">
      <?php printf('<span class="item-footer__info">' . esc_html($date) . '</span>'); ?>

      <?php echo get_simple_likes_button(get_the_ID()); ?>
    </div>

  <?php
  }
}

/*
Изображение в фоне записей рубрики 1 и избранных записей
*/
if (!function_exists('add_item_bg')) {
  add_action('gp_images', 'add_item_bg');
  function add_item_bg() {
    if (has_post_thumbnail()) :
      $thumb = get_post_thumbnail_id();
      $img_url = wp_get_attachment_url($thumb, 'home-cat-thumb');
      echo 'style="background-image: url(' . esc_url($img_url) . ');"';
    endif;
  }
}


/*
Шаблон записи в рубрике 1
*/
if (!function_exists('add_topcat_items')) {
  add_action('gp_topcat', 'add_topcat_items');
  function add_topcat_items() { ?>

    <li class="top-section__item">
      <article class="top-section-article" <?php add_item_bg(); ?>>
        <div class="top-section-article__caption">
          <?php
            // заголовок
            the_title(sprintf('<h3 class="top-section-article__title"><a class="top-section-article__link hover-bottom-border" href="%s">', esc_url(get_permalink())), '</a></h3>');
          ?>

          <?php
            // подвал записи
            add_item_footer();
          ?>
        </div><!-- // item__caption -->
      </article><!-- // top-section-article -->
    </li><!-- // item -->

  <?php
  }
}


/*
Шапка рубрики
*/
if (!function_exists('add_cat_header')) {
  add_action('gp_cats', 'add_cat_header');
  function add_cat_header($cat_id) {
  ?>

    <div class="cat-header">
      <div class="cat-header__wrap">
        <h2 class="cat-header__title">
          <a class="cat-header__link" href="<?php echo get_category_link($cat_id); ?>">
            <?php echo cat_id_to_name($cat_id); ?>
          </a>
        </h2>
      </div><!-- // cat-header__wrap -->

      <a class="cat-header__more" href="<?php echo get_category_link($cat_id); ?>" aria-label="<?php _e('Посмотреть все записи в этой рубрике', 'citynews-3'); ?>">
        <svg>
          <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/sprite.svg#arrow-next"></use>
        </svg>
      </a>
    </div>
    <!--// cat header -->

  <?php
  }
}


/*
Шаблон записей категории на главной
*/
if (!function_exists('add_cats_items')) {
  add_action('gp_cats', 'add_cats_items');
  function add_cats_items() {
  ?>

    <li class="home-category-list__item">
      <article class="home-category-item">

        <?php if(has_post_thumbnail()): ?>
          <div class="home-category-item__img zoom-img">
            <a href="<?php echo esc_url(get_permalink()); ?>">
              <?php
                the_post_thumbnail('post-thumb', array(
                  'alt' => the_title_attribute(array(
                    'echo' => false,
                  )),
                ));
              ?>
            </a>
          </div>
          <?php endif; ?>

          <div class="home-category-item__content">
            <?php the_title(sprintf('<h3 class="home-category-item__title"><a class="home-category-item__link" href="%s">', esc_url(get_permalink())), '</a></h3>'); ?>

            <?php
            // если нет миниатюры, выводим короткий анонс
            if( ! has_post_thumbnail()): ?>
            <div class="home-category-item__text"><?php echo add_text_anons(20); ?></div>
            <?php endif; ?>
          </div>
          <?php add_item_footer(); ?>
          
      </article>
    </li>

  <?php
  }
}



/* 
Карточки авторов на Главной
*/
if (!function_exists('add_author_card')) {
  add_action('gp_authors', 'add_author_card');
  function add_author_card($user) {

    // получаем id автора
    $user_id =  $user->ID;

    $gravatar = get_avatar_url($user_id, "size=80");
    $custom_img = get_the_author_meta('foto',  $user_id);
    // если нет кастомного локального фото, берем из gravatar.com
    $img_url = empty($custom_img) ? $gravatar : $custom_img;
    // декоративная картинка для фона
    $bg_img = get_the_author_meta('fotobg',  $user_id);

  ?>

    <li class="authors-list__item authors-item">

      <a href="<?php echo esc_url(get_author_posts_url($user_id)); ?>" class="authors-item__link">

        <div class="authors-item__bg" style="background-image:url('<?php echo esc_url($bg_img); ?>')">
          <div class="authors-item__post-count">
            <span class="authors-item__icon">
              <svg>
                <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/sprite.svg#pen"></use>
              </svg>
            </span>
            <p><?php echo count_user_posts($user_id); ?></p>
          </div>
          <img loading="lazy" class="authors-item__img" src="<?php echo esc_url($img_url); ?>" alt="<?php the_author_meta('display_name', $user_id); ?>">
        </div>

        <div class="authors-item__content">
          <span class="authors-item__name"><?php the_author_meta('display_name', $user_id); ?></span>
          <p class="authors-item__descr">
            <?php $descr = get_the_author_meta('user_description', $user_id);
            echo esc_html($descr);
            ?>
          </p>
        </div><!-- //  authors-item__content -->
      </a>
    </li><!-- // authors-list__item -->

  <?php
  }
}


/* 
Шаблон популярных записей
*/
if (!function_exists('add_popular_items')) {
  add_action('gp_popular', 'add_popular_items');
  function add_popular_items() { ?>

    <li class="popular-list__item">
      <article class="popular-item">
        <div class="popular-item__img zoom-img">
          <a href="<?php echo esc_url(get_permalink()); ?>">
            <?php
            // миниатюра
            the_post_thumbnail('popular-thumb', array(
              'alt' => the_title_attribute(
                array('echo' => false)
              ),
            ));
            ?>
          </a>
        </div>

        <div class="popular-item__content">
          <span class="popular-item__cats">
            <?php
            // рубрика записи
            add_popular_term();
            ?>
          </span>

          <?php
          // заголовок
          the_title(sprintf('<h3 class="popular-item__title"><a class="popular-item__link" href="%s">', esc_url(get_permalink())), '</a></h3>');
          ?>

          <?php
          // подвал в ячейках популярных записей
          add_popular_footer(); ?>

        </div><!-- popular-item__content -->
      </article><!-- popular-item__content -->
    </li>

  <?php
  }
}


/* 
Карточка в блоке Избранные записи
*/
if (!function_exists('add_featured_items')) {
  add_action('gp_featured', 'add_featured_items');
  function add_featured_items() { ?>

    <li class="feat-posts__item">
      <article class="feat-article">
        <div class="feat-article__wrapper" <?php add_item_bg(); ?>>
          <div class="feat-article__caption">

            <?php
              // заголовок
              the_title(sprintf('<h3 class="feat-article__title"><a class="feat-article__link hover-bottom-border" href="%s">', esc_url(get_permalink())), '</a></h3>');
            ?>

            <?php
            // стандартный подвал ячейки
            add_item_footer();
            ?>

          </div><!-- // item__caption -->
        </div><!-- // item__wrapper -->
      </article>
    </li>

  <?php
  }
}


/* 
Кнопка загрузки записей через ajax
*/
if (!function_exists('add_load_more_btn')) {
  add_action('gp_blog', 'add_load_more_btn');
  function add_load_more_btn() {

    global $wp_query;
    if ($wp_query->max_num_pages > 1)
      echo '<button class="load-more-posts" aria-label="' . __('Нажмите, чтобы загрузить больше записей', 'citynews-3') . '">' . __('Загрузить еще', 'citynews-3') . '</button>';
  }
}


/* 
Стандартная постраничная навигация с цифрами
*/
if (!function_exists('add_page_nav')) {
  add_action('gp_blog', 'add_page_nav');
  function add_page_nav() {
    $pagenav = get_the_posts_pagination(array(
      'mid_size' => 2,
      'prev_text' => __('Назад', 'citynews-3'),
      'next_text' => __('Вперёд', 'citynews-3'),
      'screen_reader_text' => __('Навигация', 'citynews-3')
    ));
    $pagenav = str_replace('<h2 class="screen-reader-text">' . __('Навигация', 'citynews-3') . '</h2>', '', $pagenav);
    $pagenav = str_replace('role="navigation"', '', $pagenav);
    echo $pagenav;
  }
}


/* 
Изображение внутри записи 
*/
if (!function_exists('add_single_thumbnail')) {
  add_action('gp_content', 'add_single_thumbnail');
  function add_single_thumbnail() {
    if (has_post_thumbnail()) :
      $thumb = get_post_thumbnail_id();
      $image_attributes = wp_get_attachment_image_src($thumb, 'full');
      echo '<figure class="single-post__img"><img src="' . $image_attributes[0] . '" alt="' . get_the_title() . '" width="' . $image_attributes[1] . '" height="' . $image_attributes[2] . '"></figure>';
    endif;
  }
}


 
/* 
Навигация внутри записей
*/
if (!function_exists('add_navigation')) {
  add_action('gp_service', 'add_navigation');
  function add_navigation() {

    if (is_singular('post')) {
      $next_label     = esc_html__('Следующая запись', 'citynews-3');
      $previous_label = esc_html__('Предыдущая запись', 'citynews-3');
    }

    the_post_navigation(
      array(
        'next_text' => '<span class="nav-links__label">' . $next_label .   '</span><p class="nav-links__title">%title</p>',
        'prev_text' => '<span class="nav-links__label">' .  $previous_label . '</span><p class="nav-links__title">%title</p>',
      )
    );
  }
}


/* 
Похожие записи (из той же рубрики) 
*/
if (!function_exists('add_related_posts')) {
  add_action('gp_posts', 'add_related_posts');
  function add_related_posts() {

    $option = TitanFramework::getInstance('cn3');

    // включен ли подвал в ячейках похожих записей
    $postRelatedFooter = $option->getOption('related-footer-loc');

    // количество похожих записей 
    $postRelatedCount = $option->getOption('related-posts-count');

    $current_id = get_the_ID();
    $categories = get_the_category();
    $cat_id = $categories[0]->cat_ID;
    $cat_name = $categories[0]->cat_name;

    $date = get_the_date('d F');
    $like_count = get_post_meta(get_the_ID(), '_post_like_count', true);
  ?>

    <div class="related-posts">
      <ul class="related-posts__list related-posts-list">

        <?php
        $query = new WP_Query(array('cat' => $cat_id, 'showposts' => $postRelatedCount,  'orderby' => 'date',  'post__not_in' => array($current_id), 'ignore_sticky_posts' => 1));
        while ($query->have_posts()) : $query->the_post(); ?>

          <li class="related-posts-list__item">
            <span class="related-posts-item__cats">
              Еще из&nbsp; «<?php echo esc_html($cat_name); ?>»
            </span>

            <?php
              // заголовок
              the_title(sprintf('<span class="related-posts-item__title"><a class="popular-item__link" href="%s">', esc_url(get_permalink())), '</a></span>');
            ?>

            <?php
              if (!$postRelatedFooter) :
            ?>

              <div class="popular-footer">
                <span class="popular-footer__date"><?php echo esc_html($date); ?></span>
                <?php 
                  // показываем лайки
                  echo get_simple_likes_button(get_the_ID()); 
                ?>
              </div>

            <?php endif; ?>

          </li>

        <?php
        endwhile;
        wp_reset_postdata();
        ?>

      </ul><!--// related-posts__list -->
    </div> <!--// related-posts -->

  <?php
  }
}


/* 
Несколько случайных записи 
*/
if (!function_exists('add_random_posts')) {
  add_action('gp_posts', 'add_random_posts');
  function add_random_posts() {

    $option = TitanFramework::getInstance('cn3');
    
    // включен ли подвал в ячейках случайных записей
    $postRandomFooter = $option->getOption('random-footer-loc');

    $current_id = get_the_ID();
  ?>

    <ul class="blog-content__random random-list">
      <?php
      $query = new WP_Query(array('showposts' => 4,  'ignore_sticky_posts' => 1, 'post__not_in' => array($current_id),  'orderby' => 'rand'));
      while ($query->have_posts()) : $query->the_post();
      ?>

        <li class="random-list__item random-item">

          <div class="random-item__wrapper" <?php add_item_bg(); ?>>
            <span class="random-item__label"><?php _e('Что еще почитать', 'citynews-3'); ?></span>
            <div class="random-item__caption">
              <?php
                // заголовок
                the_title(sprintf('<span class="random-item__title"><a class="random-item__link hover-bottom-border" href="%s">', esc_url(get_permalink())), '</a></span>');
              ?>

              <?php
              // подвал ячейки
              if (!$postRandomFooter) :
                add_item_footer();
              endif;
              ?>
            </div><!-- // random-item__caption -->
          </div><!-- // random-item__wrapper -->
        </li><!-- // random-item -->

      <?php
        endwhile;
        wp_reset_postdata();
      ?>
    </ul><!-- // blog-content__random -->

  <?php
  }
}


/* 
Выводим  текстовое поле комментариев по старинке, 
под полями автор, почта etc 
*/
add_filter('comment_form_fields', 'comment_form_fields', 99);
function comment_form_fields($fields)
{
  if (isset($fields['comment'])) {
    $comment_field = $fields['comment'];
    unset($fields['comment']);
    $fields['comment'] = $comment_field;
  }
  return $fields;
}


/* 
Название рубрики в разделе Популярные 
*/
if (!function_exists('add_popular_term')) {
  add_action('gp_popular', 'add_popular_term');
  function add_popular_term() {

    global $post;

    // массив категорий, чтобы получить id категории
    $cat = get_the_category($post->ID);

    // если записи присвоено несколько рубрик, выводим только первую, чтобы избежать переполнения
    if (!empty($cat)) {
      echo '<a href="' . esc_url(get_category_link($cat[0]->term_id)) . '">' . esc_html($cat[0]->name) . '</a>';
    }
  }
}


/*
Подвал записей в разделе Популярные
*/
if (!function_exists('add_popular_footer')) {
  add_action('gp_content', 'add_popular_footer');
  function add_popular_footer() {

    $author_id = get_the_author_meta('ID');
    $author_name = get_the_author_meta('display_name');
    $img_url = get_author_foto();
    $date = get_the_date('d M');
    $like_count = get_post_meta(get_the_ID(), '_post_like_count', true);
  ?>

    <div class="popular-footer">
      <div class="popular-footer__author popular-author">
        <a href="<?php echo esc_url(get_author_posts_url($author_id)); ?>" class="popular-author__link">
          <img class="popular-author__img" loading="lazy" src="<?php echo esc_url($img_url); ?>" alt="<?php echo _e('Изображение автора', 'citynews-3'); ?>">
          <?php printf('<span class="popular-author__name">' . esc_html($author_name) . '</span>'); ?>
        </a>
      </div>
      <?php echo get_simple_likes_button(get_the_ID()); ?>
    </div>

  <?php
  }
}


/*
Поиск по сайту
*/
if (!function_exists('add_site_search')) {
  add_action('gp_search', 'add_site_search');
  function add_site_search() { 
    
    $option = TitanFramework::getInstance('cn3');

    // передаем пример поискового запроса в скрипт
    $searchTerm = $option->getOption('search-tip');
    
    ?>

    <div class="search-panel">
      <?php
        get_search_form();
        printf('<p class="search-panel__text">' . __('Что будем искать? Например', 'citynews-3') . ',');
        printf('<span class="modal-search__hint">' . esc_html($searchTerm) . '</span></p>');
      ?>

      <button class="search-panel__close" aria-label="<?php echo _e('Закрыть поиск по сайту', 'citynews-3'); ?>"></button>
    </div><!-- // search-panel -->

    <div class="search-overlay"></div>

  <?php
  }
}


/*
Функция для склонения терминов (минут, статей)
*/
function plural_form($number, $after) {
  $cases = array(2, 0, 1, 1, 1, 2);
  echo $number . ' ' . $after[($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)]];
}

//  убираем скобки из виджета рубрик
function gp_categories_postcount_filter($variable) {
  $variable = str_replace('(', '<span class="cat-item__count"> ', $variable);
  $variable = str_replace(')', ' </span>', $variable);
  return $variable;
}

add_filter('wp_list_categories', 'gp_categories_postcount_filter');



/*
Убираем дочерний UL из виджета рубрик
*/
function gp_categories_child_filter($variable) {
  $variable = strip_tags($variable, '<li> <a> <span>');
  return $variable;
}

add_filter('wp_list_categories', 'gp_categories_child_filter');


/*
Изображение записи во встроенных виджетах
*/
if (!function_exists('add_widget_thumbnail')) {
  add_action('gp_widgets', 'add_widget_thumbnail');
  function add_widget_thumbnail() {  ?>

  <?php if(has_post_thumbnail()) { ?>
    <div class="recent-artice__img zoom-img">
      <a href="<?php echo esc_url(get_permalink()); ?>">
      <?php
            the_post_thumbnail('post-thumb', array(
              'alt' => the_title_attribute(array(
                'echo' => false,
              )),
            ));
            ?>
      </a>
    </div><!-- // recent-artice__img  -->
  <?php } else { ?>
    <span class="filler"></span>
  <?php } ?>
  <?php
  }
}


/*
Описание архива рубрики
*/
if (!function_exists('add_category_description')) {
  add_action('gp_category', 'add_category_description');
  function add_category_description() {

    $descr = get_the_archive_description();

    if ($descr) :
      echo '<div class="post-archive__content post-content">';

      echo wp_kses_post($descr);

      echo '</div><!-- // post-archive__content -->';
    endif;
  }
}


/*
Список дочерних рубрик в архиве рубрики
*/
if (!function_exists('add_child_categories')) {
  add_action('gp_archive', 'add_child_categories');
  function add_child_categories() {
    $term = get_queried_object();
    $children = get_terms($term->taxonomy, array(
      'parent'    => $term->term_id,
      'hide_empty' => false
    ));

    if (!empty($children)) {
      echo '<ul class="post-archive__child child-cat-list">';
      foreach ($children as $subcat) {
        echo '<li class="child-cat-list__item"><a class="child-cat-list__link" href="' . esc_url(get_term_link($subcat, $subcat->taxonomy)) . '">
    ' . esc_html($subcat->name) . '
    </a></li>';
      }
      echo '</ul>';
    }
  }
}


/*
Мобильные соц сети
*/
if (!function_exists('add_mob_socilals')) {
  add_action('gp_socials', 'add_mob_socilals');
  function add_mob_socilals() { ?>

    <div class="mob-socials-panel">
      <p class="mob-socials-panel__text"><?php echo _e('Мы в социальных сетях', 'citynews-3'); ?></p>
      <?php
       get_template_part('inc/socials/social-btns');
      ?>

      <button class="mob-socials-panel__close" 
      aria-label="<?php echo _e('Закрыть поиск по сайту', 'citynews-3'); ?>"></button>
    </div><!-- // search-panel -->

    <div class="mob-socials-overlay"></div>

  <?php
  }
}


/*
Кредитсы в подвале
*/
if (!function_exists('add_footer_credits')) {
  add_action('gp_footer', 'add_footer_credits');
  function add_footer_credits() { 

    $option = TitanFramework::getInstance('cn3');

    // метрика с информером, если есть, или любой другой счетчик с кнопкой
      $anyStat = $option->getOption('any-stat');
?>

    <div class="footer__credits credits">
      <p class="credits__copy" itemprop="name"><?php bloginfo('name'); ?> &copy; <span itemprop="copyrightYear"><?php echo date('Y'); ?></span></p>
      <span class="credits__counter">
        <?php
          // счетчик с кнопкой
          echo $anyStat;
        ?>
      </span>
      <span class="credits__site-descr" itemprop="description"><?php bloginfo('description'); ?></span>
    </div><!-- // footer-credits -->

  <?php
  }
}


/*
Скрипт подсказки в поисковой форме
*/
if (!function_exists('add_search_hint')) {
  add_action('gp_footer', 'add_search_hint');
  function add_search_hint() {

    $option = TitanFramework::getInstance('cn3');

    // передаем пример поискового запроса в скрипт
    $searchTerm = $option->getOption('search-tip');

  ?>

    <script>
      /* <![CDATA[ */
      
      const searchHint = document.querySelector('.modal-search__hint');
      const searchField = document.querySelector('.search-panel .search-field');

      searchHint.addEventListener('click', () => {
        searchField.setAttribute('value', '<?php echo esc_attr($searchTerm); ?>');
      });

      /* ]]> */
    </script>

<?php
  }
}


/*
Микроразметка schema.org для записей
*/
if (!function_exists('add_article_microdata')) {
  add_action('gp_article', 'add_article_microdata');
  function add_article_microdata() {

    $option = TitanFramework::getInstance('cn3');

        // id фавикона  для микроразметки
        $siteIcon = $option->getOption('favicon');

        // населенный пункт для микроразметки
        $area = $option->getOption('mircodata-area');

        // телефон для микроразметки
        $phone = $option->getOption('mircodata-tel');

    // используем фавикон для поля logo, чтобы не плодить сущности
    if (is_numeric($siteIcon)) {
      $imageAttachment = wp_get_attachment_image_src($siteIcon, $size = 'full');
      $imageSrc = $imageAttachment[0];
    } else {
      $imageSrc = $siteIcon;
    }

    // используем изображение записи для полей img
    if (has_post_thumbnail()) {
      $thumb = get_post_thumbnail_id();
      $image_attributes = wp_get_attachment_image_src($thumb, 'full');
      $micro_img = '<link itemprop="url image" href=" ' . $image_attributes[0] . '"> <meta itemprop="width" content="' . $image_attributes[1] . '"> <meta itemprop="height" content="' . $image_attributes[2] . '">';
    } else {
      $micro_img = '<link itemprop="url image" href=" ' . get_template_directory_uri() . '/assets/img/demo/icon.svg"> <meta itemprop="width" content="100"> <meta itemprop="height" content="100">';
    }

    $microdata = '<div style="display:none" class="microdata"> <meta itemprop="headline" content="' . get_the_title() . '">

      <div itemprop="author" itemscope itemtype="https://schema.org/Person">
        <meta itemprop="name" content="' . get_bloginfo('name') . '">
        <link itemprop="url" href="' . home_url() . '">
      </div><!-- // Person -->
    
      <meta itemprop="datePublished" content="' . get_the_time('c') . '">
      <meta itemprop="dateModified" content="' . get_the_time('Y-m-d') . '">
      <link itemscope itemprop="mainEntityOfPage" itemtype="https://schema.org/WebPage" href="' . get_permalink() . '">

      <div itemprop="image" itemscope itemtype="https://schema.org/ImageObject">' . $micro_img  . '</div>

      <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
      
        <meta itemprop="name" content="' . get_bloginfo('name') . '">
        <div itemprop="logo" itemscope  itemtype="https://schema.org/ImageObject">
          <link itemprop="url image" href="' . esc_url($imageSrc) . '">
          <meta itemprop="width" content="100">
          <meta itemprop="height" content="100">
        </div><!-- // ImageObject -->
      
      <div itemprop="image" itemscope itemtype="https://schema.org/ImageObject">' .  $micro_img  . '</div>
      
      <meta itemprop="telephone" content="' . esc_attr($phone) . '">
      <meta itemprop="address" content="' . esc_attr($area) . '"> 
      
    </div><!-- // Organization -->
    </div><!-- // microdata -->';

    echo $microdata;
  }
}

/*
* Снимаем блокировку кнопки каментов, если в консоли отключен
* показ политики конфиденциальности
* Добавлено в версии 1.0.1
*/
if (!function_exists('remove_comment_btn_disabled')) {
  add_action('gp_comments', 'remove_comment_btn_disabled');
  function remove_comment_btn_disabled()
  {

    $option = TitanFramework::getInstance('cn3');
    if (comments_open()) {
      if ($option->getOption('agree-loc') == 2) :
    ?>
        <script>
          /* <![CDATA[ */
          jQuery(document).ready(function($) {
          $(function() {
            var subBtn = $('.comment-form .submit');
            $(subBtn).removeAttr('disabled');
          });
        });
          /* ]]> */
        </script>
    <?php endif;
    }
  }
}

// EOF
