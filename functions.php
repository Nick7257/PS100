<?php

/**
 * CN3 сет-ап
 */


/**
 * Подключаем лицензию, не удаляем эту строчку
 */
require_once('admin/license.php');


if (!defined('VERSION')) {
	// версия темы
	define('VERSION', '1.0.1');
}

if (!function_exists('theme_support')) :
	function theme_support() {

		// путь к директории локализации
		load_theme_textdomain('citynews-3', get_template_directory() . '/languages');

		// ссылки на фиды
		add_theme_support('automatic-feed-links');

		// title сайта
		add_theme_support('title-tag');

		// миниатюры  
		add_theme_support('post-thumbnails');

		// миниатюра в базовом шаблоне записи рубрик и блога
		add_image_size('post-thumb', 365, 215, true);

		// в разделе Популярные записи
		add_image_size('popular-thumb', 180, 180, true);

		// поддержка для full и wide align картинок
		add_theme_support('align-wide');


		// меню сайта
		register_nav_menus(
			array(
				'primary' => esc_html__('Главное, а также мобильное многоуровневое меню', 'citynews-3'),
				'secondary' => esc_html__('Дополнительное одноуровневое меню в подвале в блоке О сайте', 'citynews-3')
			)
		);

		/*
		* Поддержка HTML5
		*/
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Кастомный фон
		add_theme_support(
			'custom-background',
			apply_filters(
				'cn3_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// отключаем блочный редактор виджетов
		remove_theme_support('widgets-block-editor');

		//адаптивное видео
		add_theme_support('responsive-embeds');

		// стили для редактора
		add_theme_support('editor-styles');
		add_editor_style('style-editor.css');

		/**
		 * Кастомное лого в режиме превью
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 300,
				'width'       => 75,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}

endif;
add_action('after_setup_theme', 'theme_support');


/**
 * Виджеты
 */
function cn3_widgets_init()
{

	register_sidebar(
		array(
			'name'          => 'Боковая колонка (сайдбар)',
			'id'            => 'sidebar-1',
			'description'   => 'Добавьте виджеты.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<span class="widget__title widget-title">',
			'after_title'   => '</span>',
		)
	);

	register_sidebar(
		array(
			'name'          => 'Подвал (справа)',
			'id'            => 'footer',
			'description'   => 'Добавьте виджеты.',
			'before_widget' => '<div id="%1$s" class="footer__widget widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<span class="widget__title widget-title">',
			'after_title'   => '</span>',
		)
	);
}
add_action('widgets_init', 'cn3_widgets_init');


/**
 * Подключением стилей и скриптов
 */
function theme_scripts()
{
	wp_enqueue_style('cn3-style', get_stylesheet_uri(), array(), VERSION);
	wp_enqueue_script('cn3-dark-theme', get_template_directory_uri() . '/assets/js/dark.js', array('jquery'), VERSION, true);
	wp_enqueue_script('cn3-vendor-script', get_template_directory_uri() . '/assets/js/vendor.min.js', array('jquery'), VERSION, true);
	wp_enqueue_script('cn3-custom-script', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'theme_scripts');



/**
 * Функции темы
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Загрузка записей в блоге и архивах через AJAX
 */
require get_template_directory() . '/inc/ajax-pagination.php';

/**
 * Галочка для добавления в Избранные
 */
require get_template_directory() . '/inc/metabox/single-metabox.php';

/**
 * Добавление изображений для автора, а также соц сетей автора в профили
 */
require get_template_directory() . '/inc/metabox/profile-metabox.php';

/**
 * Меняем под себя комментарии и добавляем к ним микроразметку
 */
require get_template_directory() . '/inc/template-parts/comment-atts.php';

/**
 * Хлебные крошки
 */
require get_template_directory() . '/inc/template-parts/breadcrumbs.php';


/**
 * Встроенный виджет Популярные записи
 */
require get_template_directory() . '/inc/widgets/popular-posts-widget.php';

/**
 * Встроенный виджет Избранная рубрика
 */
require get_template_directory() . '/inc/widgets/featured-posts-widget.php';


/**
 * Система лайков для записей
 */
require get_template_directory() . '/inc/vendor/likes.php';


/**
 * Оптимизация
 */
require get_template_directory() . '/inc/optimize.php';


/**
 * Обновление темы
 */
require get_template_directory() . '/admin/plugin-update-checker/plugin-update-checker.php';


// проверяем, используется ли сайдбар в записи, для добавления соответствующих стилей
function is_sidebar_active($index) {
	global $wp_registered_sidebars;
	$widgetcolums = wp_get_sidebars_widgets();
	if ($widgetcolums[$index])
		return true;
	return false;
}

  
// EOF
