<?php 
// файл функций дочерней темы CityNews 3
	
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
function enqueue_parent_styles() {
wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}
 

// * * * * *  Если нужно добавить код, размещайте его под этой строкой  * * * * *  *// 

// Изменяем приоритет загрузки ядра из дочерней темы

add_action( 'after_setup_theme', 'remove_my_action' );
function remove_my_action() {
	remove_action( 'tf_create_options', 'cn3_create_options');
}

/**
 * Консоль для управления темой
 */

if (!defined('ABSPATH')) {
	exit;
}

add_action('tf_create_options', 'cn3_create_options');
function cn3_create_options()
{

	$option = TitanFramework::getInstance('cn3');
	$adminPanel = $option->createAdminPanel(array(
		'name' => 'CityNews 3',
	));

	$adminPanel->createOption(array(
		'name' => 'О теме',
		'type' => 'heading',
	));

	$adminPanel->createOption(array(
		'type' => 'note',
		'desc' => '<img src="/wp-content/themes/citynews-3/screenshot.png" style="width:500px; float:left; margin:0 40px 30px 0" alt="Скриншот темы">
	<p><br />"CityNews 3" это адаптивная быстрая настроечная тема 2023 года для статейного сайта или блога, развернутого на CMS WordPres.</p><br /><p> Среди опций темы - сетка постов, профили авторов, липкое меню, липкий сайдбар, хлебные крошки, микроразметка schema.org, готовый темный режим, пара встроенных виджетов, а также система оценки публикаций в виде лайков.</p><br /><p>Вы находитесь в консоли темы, где расположены все её настройки. Здесь вы можете установить, как выводить контент на сайте, перекрасить основные части, добавить статистику, социальные сети, включить / отключить разные элементы и т.п.</p>'
	));

	$adminPanel->createOption(array(
		'name' => 'Документация и помощь',
		'type' => 'heading',
	));

	$adminPanel->createOption(array(
		'type' => 'note',
		'desc' => '<p>Чтобы изучить все возможности "CityNews 3", ознакомьтесь с инструкцией. Документация предоставлена вместе с темой - скачайте ее в письме, которое получили после покупки. Распакуйте архив doc.zip и откройте файл readme.html при помощи любого браузера. В ней описаны все опции темы, рассказано, что и как настроить. </p><br /><p>Либо можете использовать онлайн-версию:  </p><br />
		
		<p><a class="button button-secondary" href="https://www.goodwinpress.ru/documents/cn3/readme.html" target="_blank">Открыть инструкцию</a> </p><br />
		
		<p>Для клиентов работает бесплатная техподдержка. Вы получаете ее все время, пока пользуетесь темой. Поддержка предоставляется без выходных, с 10:00 до 21:00 в будни, и с 12:00 до 20:00 в выходные и праздники. Время московское.</p><br />
		
		<p><a class="button button-secondary" href="https://www.goodwinpress.ru/contact/" target="_blank">Написать в техподдержку</a> </p><br />'
	));

	$adminPanel->createOption(array(
		'name' => 'Другие темы от GoodwinPress:',
		'type' => 'heading',
	));

	$adminPanel->createOption(array(
		'type' => 'note',
		'desc' => '<p>Если пожелаете приобрести какой-нибудь другой шаблон от GoodwinPress, помните - постоянным клиентам предоставляется скидка 25%.</p>
<br /><p>
<a href="https://www.goodwinpress.ru/universalnaya-biznes-tema-make-progress-3/" target="_blank"><img class="panel-img" src="/wp-content/themes/citynews-3/assets/img/demo/mp3.png" width="370" alt="Make Progress 3"></a>
<a href="https://www.goodwinpress.ru/wp-tema-blogpost-3/" target="_blank"><img class="panel-img" src="/wp-content/themes/citynews-3/assets/img/demo/bp3.jpg" width="370" alt="BlogPost 3"></a>
<a href="https://www.goodwinpress.ru/wp-tema-law-factory/" target="_blank"><img class="panel-img" src="/wp-content/themes/citynews-3/assets/img/demo/lawfactory.jpg" width="370" alt="Law Factory"></a>
 
</p>'
	));



	$normalPanel = $adminPanel->createAdminPanel(array(
		'name' => 'Общие настройки',
		'id' => 'general-options',
	));

	$normalPanel->createOption(array(
		'type' => 'note',
		'desc' => 'Здесь настроим элементы, общие для всего сайта - фавикон, персональные данные, статистику и т.д.',
	));

	$normalPanel->createOption(array(
		'name' => 'Favicon',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'name' => 'Favicon - установить',
		'id' => 'favicon',
		'type' => 'upload',
		'desc' => 'Создайте изображение с нужным рисунком, сохраните в формате png или svg и загрузите его здесь. Рекомендуемый размер - 192х192 пикс.',
		'default' => '/wp-content/themes/citynews-3/assets/img/demo/icon.svg',
	));


	$normalPanel->createOption(array(
		'name' => 'Верификация сайта в Яндекс и Google',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'name' => 'HTML-тэг для подтверждения прав на сайт',
		'id' => 'verification',
		'type' => 'textarea',
		'desc' => 'Если нужно подтвердить права на сайт в Яндексе и Гугле, это можно сделать здесь, разместив в данное поле код предложенных вам html метатэгов. Они будут выводиться в разделе head. <br />Также в это поле можно добавлять любой другой код, который требуется разместить на сайте в зоне head.',
	));

	$normalPanel->createOption(array(
		'name' => 'Cтатистика и аналитика',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'name' => 'Статистика Google Analytics',
		'id' => 'google-stat',
		'type' => 'textarea',
		'desc' => 'Если вы используете статистику от Google Analytics, вставьте код статистики в это поле. Другие счетчики сюда ставить не рекомендуется. Выводится в шапке в зоне head.',
	));

	$normalPanel->createOption(array(
		'name' => 'Статистика без кнопки - Яндекс.Метрика',
		'id' => 'yandex-stat',
		'type' => 'textarea',
		'desc' => 'Если вы используете статистику Яндекс.Метрика, вставьте код статистики в это поле.  Какие-либо другие счетчики сюда ставить не рекомендуется. Выводится внутри body, максимально высоко к открывающему тэгу.',
	));

	$normalPanel->createOption(array(
		'name' => 'Любая статистика с кнопкой',
		'id' => 'any-stat',
		'type' => 'textarea',
		'desc' => 'Если у вас имеется  счетчик  с кнопкой типа LiveInternet или Mail.ru, кнопка каталога, или Яндекс Метрика с кнопкой-информером,  поставьте их код в это поле. Выводится в подвале по центру.',
	));

	$normalPanel->createOption(array(
		'name' => 'Пиксель ВКонтакте или пиксель Facebook',
		'id' => 'pixel',
		'type' => 'textarea',
		'desc' => 'Если у вас есть код Пикселя ВКонтакте или Facebook, поставьте его / их в это поле. Выводится в шапке в зоне head.',
	));

	$normalPanel->createOption(array(
		'name' => '404 страница',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'name' => '404 - текст',
		'id' => 'text404',
		'type' => 'editor',
		'desc' => 'Впишите свой текст для 404 страницы или используйте текст по умолчанию.',
		'default' => 'Дорогой посетитель, вы попали на 404 страницу. Это значит, что документ, который раньше открывался по этому адресу, более не существует, либо был перемещен. Также есть вероятность, что вы использовали неправильную ссылку.',
	));


	$normalPanel->createOption(array(
		'name' => 'Поиск по сайту',
		'type' => 'heading',
	));


	$normalPanel->createOption(array(
		'name' => 'Подсказка для поиска',
		'id' => 'search-tip',
		'type' => 'text',
		'desc' => 'Впишите слово или фразу для установки в качестве примера или подсказки в поп-апе поиска.',
		'default' => 'Человек',
	));

	$normalPanel->createOption(array(
		'name' => 'Микроразметка',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'type' => 'note',
		'desc' => 'Тема оснащена микроразметкой по стандарту schema.org. Страницы записей описаны как Article. Микроразметка под Article требует, чтобы в свойстве publisher были указаны населенный пункт, к которому относится сайт, а также контактный телефон владельца. Заполните соответствующие поля, внесенные значения будут использованы в микроразметке. Данные значения могут быть как реальными, так и вымышленными, на ваше усмотрение.',
	));

	$normalPanel->createOption(array(
		'name' => 'Населенный пункт',
		'id' => 'mircodata-area',
		'type' => 'text',
		'desc' => 'Впишите название населенного пункта, к которому относится сайт.',
		'default' => 'Санкт-Петербург',
	));

	$normalPanel->createOption(array(
		'name' => 'Номер телефона',
		'id' => 'mircodata-tel',
		'type' => 'text',
		'desc' => 'Впишите номер телефона владельца или автора сайта.',
		'default' => '+7(123)456-78-90',
	));


	$normalPanel->createOption(array(
		'type' => 'save',
	));


	$normalPanel = $adminPanel->createAdminPanel(array(
		'name' => 'Социальные сети',
		'id' => 'social-options',
	));

	$normalPanel->createOption(array(
		'type' => 'note',
		'desc' => 'В теме имеется 3 набора кнопок соц. сетей. Первый для перехода в ваши аккаунты в соц. сетях - на ПК выводится в шапке сайта, а также в моб. меню и специальном поп-апе; второй  - чтобы посетители могли поделиться публикациями и продуктами сайта в соц. сетях или мессенджерах - выводится в каждой записи под текстом публикации; третий - соц. аккаунты авторов сайта, выводятся в архиве автора. <br />Первые два набора можно настроить здесь. Соц. кнопки автора у каждого свои, поэтому они настраиваются не здесь, а в профиле автора в админке. ',
	));

	$normalPanel->createOption(array(
		'name' => 'Ваши аккаунты в соц. сетях',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'name' => 'ВКонтакте - включить',
		'id' => 'vk-loc',
		'type' => 'enable',
		'default' => true,
		'desc' => 'Включить ссылку ВКонтакте',
	));

	$normalPanel->createOption(array(
		'name' => 'ВКонтакте - ссылка',
		'id' => 'vk-link',
		'type' => 'text',
		'desc' => 'Разместите адреc Вашей страницы ВКонтакте.',
		'default' => 'https://vk.com',
	));

	$normalPanel->createOption(array(
		'name' => 'Facebook - включить',
		'id' => 'fb-loc',
		'type' => 'enable',
		'default' => false,
		'desc' => 'Включить ссылку Facebook',
	));

	$normalPanel->createOption(array(
		'name' => 'Facebook - ссылка',
		'id' => 'fb-link',
		'type' => 'text',
		'desc' => 'Разместите адреc Вашей страницы на Facebook.',
		'default' => 'https://facebook.com',
	));

	$normalPanel->createOption(array(
		'name' => 'Instagram - включить',
		'id' => 'inst-loc',
		'type' => 'enable',
		'default' => true,
		'desc' => 'Включить ссылку Instagram',
	));

	$normalPanel->createOption(array(
		'name' => 'Instagram - ссылка',
		'id' => 'inst-link',
		'type' => 'text',
		'desc' => 'Разместите адреc Вашей страницы в Instagram',
		'default' => 'https://instagram.com',
	));

	$normalPanel->createOption(array(
		'name' => 'YouTube - включить',
		'id' => 'yt-loc',
		'type' => 'enable',
		'default' => true,
		'desc' => 'Включить ссылку YouTube',
	));

	$normalPanel->createOption(array(
		'name' => 'YouTube - ссылка',
		'id' => 'yt-link',
		'type' => 'text',
		'desc' => 'Разместите адреc Вашего канала  в YouTube',
		'default' => 'https://youtube.com',
	));

	$normalPanel->createOption(array(
		'name' => 'Twitter - включить',
		'id' => 'tw-loc',
		'type' => 'enable',
		'default' => false,
		'desc' => 'Включить ссылку Twitter',
	));

	$normalPanel->createOption(array(
		'name' => 'Twitter - ссылка',
		'id' => 'tw-link',
		'type' => 'text',
		'desc' => 'Разместите адреc Вашей страницы в Twitter.',
		'default' => 'https://twitter.com',
	));

	$normalPanel->createOption(array(
		'name' => 'Одноклассники - включить',
		'id' => 'od-loc',
		'type' => 'enable',
		'default' => false,
		'desc' => 'Включить ссылку Одноклассники',
	));

	$normalPanel->createOption(array(
		'name' => 'Одноклассники - ссылка',
		'id' => 'od-link',
		'type' => 'text',
		'desc' => 'Разместите адреc Вашего аккаунта в Одноклассниках',
		'default' => 'https://odnoklassniki.ru',
	));

	$normalPanel->createOption(array(
		'name' => 'Дзен - включить',
		'id' => 'zen-loc',
		'type' => 'enable',
		'default' => false,
		'desc' => 'Включить кнопку Яндекс Дзен',
	));

	$normalPanel->createOption(array(
		'name' => 'Дзен - ссылка',
		'id' => 'zen-link',
		'type' => 'text',
		'desc' => 'Разместите адреc Вашего аккаунта в Дзен',
		'default' => 'https://zen.yandex.ru',
	));

	$normalPanel->createOption(array(
		'name' => 'Telegram - включить',
		'id' => 'tg-loc',
		'type' => 'enable',
		'default' => true,
		'desc' => 'Включить ссылку Telegram',
	));

	$normalPanel->createOption(array(
		'name' => 'Telegram - ссылка',
		'id' => 'tg-link',
		'type' => 'text',
		'desc' => 'Разместите имя пользователя или название канала в Telegram. Например, goodwinpress',
		'default' => 'goodwinpress',
	));

	$normalPanel->createOption(array(
		'name' => 'Кнопки Поделиться',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'name' => 'Заголовок',
		'id' => 'share-title',
		'type' => 'text',
		'desc' => 'Разместите подзаголовок, призыв поделиться в соц. сетях.',
		'default' => 'Поделитесь с друзьями',
	));

	$normalPanel->createOption(array(
		'name' => 'Кнопки Поделиться',
		'id' => 'share-options',
		'type' => 'multicheck',
		'desc' => 'Выберите, какие кнопки желаете использовать. С их помощью посетитель сможет поделиться записью или продуктом в социальных сетях и мессенджерах.',
		'options' => array(
			'wh' => 'WhatsApp',
			'vk' => 'ВКонтакте',
			'fb' => 'Facebook',
			'tg' => 'Telegram',
			'tw' => 'Twitter',
			'od' => 'Одноклассники',
			'vb' => 'Viber',
		),
		'default' => array('wh', 'fb', 'tg')
	));

	$normalPanel->createOption(array(
		'type' => 'save',
	));

	$normalPanel = $adminPanel->createAdminPanel(array(
		'name' => 'Шапка сайта',
		'id' => 'header',
	));

	$normalPanel->createOption(array(
		'type' => 'note',
		'desc' => 'Настроим брендинг сайта, а также разные кнопки.',
	));

	$normalPanel->createOption(array(
		'name' => 'Заголовок / логотип',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'name' => 'Что разместить',
		'id' => 'site-title',
		'type' => 'select',
		'desc' => 'Выберите, текст или логотип. <br />Если выбран логотип, загрузите его ниже.<br />Если выбран текст, в шапке будет выводиться текстовый заголовок, заданный вами в <a target="_blank" href="options-general.php">настройках сайта</a>',
		'options' => array(
			'1' => 'Текст',
			'2' => 'Логотип',
		),
		'default' => '2',
	));

	$normalPanel->createOption(array(
		'name' => 'Логотип для светлого режима',
		'id' => 'site-logo',
		'type' => 'upload',
		'desc' => 'Загрузите здесь  логотип для обычного, светлого режима. <br />Размер любой, рекомендованный размер 300х75 пикселей. Тип любой - png, jpg или svg.',
		'default' => '/wp-content/themes/citynews-3/assets/img/demo/cn3-logo-light.svg'
	));

	$normalPanel->createOption(array(
		'name' => 'Логотип для темного режима',
		'id' => 'site-logo-dark',
		'type' => 'upload',
		'desc' => 'Загрузите здесь логотип для темного режима. <br />Размер любой, рекомендованный размер 300х75 пикселей. Тип любой - png, jpg или svg.',
		'default' => '/wp-content/themes/citynews-3/assets/img/demo/cn3-logo-dark.svg'
	));

	$normalPanel->createOption(array(
		'name' => 'Если логотип в svg',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'type' => 'note',
		'desc' => 'Если логотип в формате svg, здесь пропишите ширину и высоту этого логотипа - WordPress пока не может автоматически установить данные параметры, поскольку это векторная графика.<br />Если логотип в png, webp или jpg, WordPress сам определит его размеры и подставит их в код, никаких действий не требуется, оставьте поля пустыми.',
	));

	$normalPanel->createOption(array(
		'name' => 'Ширина',
		'id' => 'svg-logo-width',
		'type' => 'text',
		'desc' => 'Укажите ширину для svg логотипа в пикселях. Например, 300',
		'default' => '',
	));

	$normalPanel->createOption(array(
		'name' => 'Высота',
		'id' => 'svg-logo-height',
		'type' => 'text',
		'desc' => 'Укажите высоту для svg логотипа в пикселях. Например, 75',
		'default' => '',
	));

	$normalPanel->createOption(array(
		'name' => 'Социальные сети в шапке',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'name' => 'Добавить соц. сети?',
		'id' => 'header-socials-loc',
		'type' => 'enable',
		'desc' => 'Набор кнопок социальных сетей в шапке, слева от логотипа, вкл / выкл. Если кнопки выключены, лого получит размещение по левому краю. ',
		'default' => true,
	));

	$normalPanel->createOption(array(
		'name' => 'Кнопки в шапке',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'name' => 'Кнопка темного режима',
		'id' => 'dark-mode-loc',
		'type' => 'enable',
		'desc' => 'Кнопка включения темного режима, вкл / выкл. ',
		'default' => true,
	));

	$normalPanel->createOption(array(
		'name' => 'Кнопка и поп-ап поиска',
		'id' => 'search-btn-loc',
		'type' => 'enable',
		'desc' => 'Кнопка, открывающая поп-ап с формой поиска, вкл / выкл. Если кнопка выключена, вместе с ней скрыт и поп-ап. ',
		'default' => true,
	));

	$normalPanel->createOption(array(
		'name' => 'Кнопка и поп-ап соц. сетей (в моб. версии)',
		'id' => 'mob-socials-btn-loc',
		'type' => 'enable',
		'desc' => 'Кнопка, открывающая поп-ап с кнопками соц. сетей, вкл / выкл. Если кнопка выключена, вместе с ней скрыт и поп-ап. ',
		'default' => true,
	));


	$normalPanel->createOption(array(
		'type' => 'save',
	));



	$normalPanel = $adminPanel->createAdminPanel(array(
		'name' => 'Главная страница',
		'id' => 'homepage-options',
	));

	$normalPanel->createOption(array(
		'name' => 'Разделы Главной страницы',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'type' => 'note',
		'desc' => 'Если желаете создать журнальный, новостной сайт - включите все разделы, кроме Блога.<br />Если желаете создать блог, статейный сайт - включите раздел Блог, остальные отключите. <br /> Комбинируйте, как захотите. Например, можно включить Блог и добавить к нему Рубрику 1, Популярные и Избранные записи и т.п.',
	));


	$normalPanel->createOption(array(
		'name' => 'Из каких частей состоит Главная',
		'id' => 'sections',
		'type' => 'sortable',
		'desc' => 'Готовые разделы Главной страницы. Расположите их в нужном порядке. Комбинируйте. Ненужные отключите.<br /><br />',
		'options' => array(
			'section-1' => 'Рубрика 1',
			'section-2' => 'Свежие записи + Рубрика 2',
			'section-3' => 'Рубрика 3',
			'section-authors' => 'Авторы',
			'section-4' => 'Рубрика 4',
			'section-5' => 'Рубрика 5',
			'section-popular' => 'Популярные записи',
			'section-6' => 'Рубрика 6',
			'section-7' => 'Рубрика 7',
			'section-8' => 'Рубрика 8',
			'section-blog' => 'Блог',
			'section-featured' => 'Избранные записи',
		),

		'default' => array('section-blog')
	));

	$normalPanel->createOption(array(
		'name' => 'Даты и лайки на Главной',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'type' => 'note',
		'desc' => 'Здесь можно выключить отображение даты публикации записей и лайков во всех разделах Главной страницы - как в журнальном варианте, так и в блоге.',
	));

	$normalPanel->createOption(array(
		'name' => 'Показывать дату?',
		'id' => 'mag-date-loc',
		'type' => 'enable',
		'desc' => 'Дата публикации записи, вкл / выкл. ',
		'default' => true,
	));

	$normalPanel->createOption(array(
		'name' => 'Показывать лайки?',
		'id' => 'mag-likes-loc',
		'type' => 'enable',
		'desc' => 'Счетчик лайков записи, вкл / выкл. ',
		'default' => true,
	));

	$normalPanel->createOption(array(
		'type' => 'save',
	));


	$normalPanel = $adminPanel->createAdminPanel(array(
		'name' => 'Настройка рубрик и блога',
		'id' => 'homepage-categories-options',
	));

	$normalPanel->createOption(array(
		'type' => 'note',
		'desc' => 'Если используете тему как новостной сайт (когда публикации на Главной разбиты по рубрикам), здесь можно задать нужные рубрики. Откройте выпадающий список и установите для каждого раздела свою рубрику.',
	));


	$normalPanel->createOption(array(
		'name' => '1 рубрика (4 записи)',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'name' => 'Выбрать рубрику',
		'id' => 'cat1',
		'type' => 'select-categories',
		'desc' => '',
		'default' => '',
	));


	$normalPanel->createOption(array(
		'name' => '2 рубрика + Свежие записи',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'name' => 'Выбрать рубрику',
		'id' => 'cat2',
		'type' => 'select-categories',
		'desc' => '',
		'default' => '',
	));

	$normalPanel->createOption(array(
		'name' => 'Количество записей в рубрике',
		'id' => 'cat2-count',
		'type' => 'number',
		'desc' => 'Установите, сколько записей выводить в рубрике. Лучшее количество - кратное двум, например, 4, 6, 8 и т.д. <br /> Для создания гармоничного вида, следите за тем, чтобы у рубрики была такая же высота, как у Свежих записей слева.',
		'default' => '4',
		'min' => '1',
		'max' => '12',
		'step' => '1'
	));

	$normalPanel->createOption(array(
		'name' => 'Количество Свежих записей',
		'id' => 'cat2-recent-count',
		'type' => 'number',
		'desc' => 'Установите, сколько записей в колонке Свежих записей. <br /> Для создания гармоничного вида, следите за тем, чтобы у блока Свежих записей была такая же высота, как у рубрики справа.',
		'default' => '5',
		'min' => '1',
		'max' => '12',
		'step' => '1'
	));

	$normalPanel->createOption(array(
		'name' => '3 рубрика',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'name' => '3 рубрика',
		'id' => 'cat3',
		'type' => 'select-categories',
		'desc' => 'Выбрать рубрику.',
		'default' => '',
	));

	$normalPanel->createOption(array(
		'name' => 'Количество записей в рубрике',
		'id' => 'cat3-count',
		'type' => 'number',
		'desc' => 'Установите, сколько записей выводить в рубрике. Лучшее количество - кратное трем, например, 3, 6, 9 и т.д.',
		'default' => '3',
		'min' => '1',
		'max' => '12',
		'step' => '1'
	));

	$normalPanel->createOption(array(
		'name' => '4 рубрика',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'name' => '4 рубрика',
		'id' => 'cat4',
		'type' => 'select-categories',
		'desc' => '',
		'default' => '',
	));

	$normalPanel->createOption(array(
		'name' => 'Количество записей в рубрике',
		'id' => 'cat4-count',
		'type' => 'number',
		'desc' => 'Установите, сколько записей выводить в рубрике. Лучшее количество - кратное трем, например, 3, 6, 9 и т.д.',
		'default' => '3',
		'min' => '1',
		'max' => '12',
		'step' => '1'
	));

	$normalPanel->createOption(array(
		'name' => '5 рубрика',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'name' => '5 рубрика',
		'id' => 'cat5',
		'type' => 'select-categories',
		'desc' => '',
		'default' => '',
	));

	$normalPanel->createOption(array(
		'name' => 'Количество записей в рубрике',
		'id' => 'cat5-count',
		'type' => 'number',
		'desc' => 'Установите, сколько записей выводить в рубрике. Лучшее количество - кратное трем, например, 3, 6, 9 и т.д.',
		'default' => '3',
		'min' => '1',
		'max' => '12',
		'step' => '1'
	));

	$normalPanel->createOption(array(
		'name' => '6 рубрика',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'name' => '6 рубрика',
		'id' => 'cat6',
		'type' => 'select-categories',
		'desc' => ' ',
		'default' => '',
	));

	$normalPanel->createOption(array(
		'name' => 'Количество записей в рубрике',
		'id' => 'cat6-count',
		'type' => 'number',
		'desc' => 'Установите, сколько записей выводить в рубрике. Лучшее количество - кратное трем, например, 3, 6, 9 и т.д.',
		'default' => '3',
		'min' => '1',
		'max' => '12',
		'step' => '1'
	));

	$normalPanel->createOption(array(
		'name' => '7 рубрика',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'name' => '7 рубрика',
		'id' => 'cat7',
		'type' => 'select-categories',
		'desc' => ' ',
		'default' => '',
	));

	$normalPanel->createOption(array(
		'name' => 'Количество записей в рубрике',
		'id' => 'cat7-count',
		'type' => 'number',
		'desc' => 'Установите, сколько записей выводить в рубрике. Лучшее количество - кратное трем, например, 3, 6, 9 и т.д.',
		'default' => '3',
		'min' => '1',
		'max' => '12',
		'step' => '1'
	));

	$normalPanel->createOption(array(
		'name' => '8 рубрика',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'name' => '8 рубрика',
		'id' => 'cat8',
		'type' => 'select-categories',
		'desc' => ' ',
		'default' => '',
	));

	$normalPanel->createOption(array(
		'name' => 'Количество записей в рубрике',
		'id' => 'cat8-count',
		'type' => 'number',
		'desc' => 'Установите, сколько записей выводить в рубрике. Лучшее количество - кратное трем, например, 3, 6, 9 и т.д.',
		'default' => '3',
		'min' => '1',
		'max' => '12',
		'step' => '1'
	));

	$normalPanel->createOption(array(
		'name' => 'Популярные записи',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'type' => 'note',
		'desc' => 'Блок, в котором выводим список наиболее популярных записей. Популярность определяется на основе лайков темы, самые "залайканные" посты выводятся сверху.',
	));

	$normalPanel->createOption(array(
		'name' => 'Заголовок раздела',
		'id' => 'popular-title',
		'type' => 'text',
		'desc' => 'Укажите заголовок раздела.',
		'default' => 'Популярное',
	));

	$normalPanel->createOption(array(
		'name' => 'Количество записей',
		'id' => 'popular-count',
		'type' => 'number',
		'desc' => 'Установите, сколько популярных записей показывать. Лучшее количество - кратное двум, например, 2, 4, 6 и т.д.',
		'default' => '4',
		'min' => '1',
		'max' => '12',
		'step' => '1'
	));

	$normalPanel->createOption(array(
		'name' => 'Авторы',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'type' => 'note',
		'desc' => 'Блок, в котором представляем список авторов сайта. Вывод производится на основе количества публикаций. Автор, у которого больше публикаций, выводится первым.',
	));

	$normalPanel->createOption(array(
		'name' => 'Заголовок раздела',
		'id' => 'authors-title',
		'type' => 'text',
		'desc' => 'Укажите заголовок раздела.',
		'default' => 'Наши авторы',
	));

	$normalPanel->createOption(array(
		'name' => 'Исключить авторов',
		'id' => 'remove-author',
		'type' => 'text',
		'desc' => 'Если нужно исключить какого-либо автора, например, админа или кого-то другого, сделайте это здесь. Укажите ID этого автора, тогда он не будет выводиться в данном блоке. Если требуется исключить нескольких авторов сразу, укажите их ID через запятую.',
		'default' => '',
	));

	$normalPanel->createOption(array(
		'name' => 'Избранные записи',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'type' => 'note',
		'desc' => 'Блок, в котором выводим список так называемых избранных записей. Чтобы сделать запись избранной и вывести ее на Главной, поставьте галочку в ее настройках. <br />Количество избранных записей не ограничено. Вывод записей - стандартный, по дате публикации.',
	));

	$normalPanel->createOption(array(
		'name' => 'Заголовок раздела',
		'id' => 'featured-title',
		'type' => 'text',
		'desc' => 'Укажите заголовок раздела.',
		'default' => 'Избранное',
	));

	$normalPanel->createOption(array(
		'name' => 'Блог',
		'type' => 'heading',
	));
	
	$normalPanel->createOption(array(
		'name' => 'Тип навигации в Блоге',
		'id' => 'blog-nav-type',
		'type' => 'radio',
		'options' => array(
			'1' => 'Загрузка по клику на кнопку',
			'2' => 'Стандартная постраничная навигация с цифрами',
		),
		'default' => '1',
		'desc' => 'Выберите тип навигации в блоге - загружать новую порцию постов по клику на кнопку "Загрузить" или выводить стандартную постраничную навигация через номера страниц. '
	));

	$normalPanel->createOption(array(
		'type' => 'save',
	));



	$normalPanel = $adminPanel->createAdminPanel(array(
		'name' => 'Настройка записей',
		'id' => 'posts-options',
	));

	$normalPanel->createOption(array(
		'type' => 'note',
		'desc' => 'Настройка публикаций сайта.',
	));

	$normalPanel->createOption(array(
		'name' => 'Шапка записи',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'name' => 'Блок с датой и автором',
		'id' => 'single-date-author-loc',
		'type' => 'enable',
		'desc' => 'Показывать блок с датой и автором в шапке записи, вкл / выкл.',
		'default' => true,
	));

	$normalPanel->createOption(array(
		'name' => 'Показывать время на чтение',
		'id' => 'single-reading-loc',
		'type' => 'enable',
		'desc' => 'Показывать время на чтение в шапке записи, вкл / выкл.',
		'default' => true,
	));

	$normalPanel->createOption(array(
		'name' => 'Показывать количество комментариев',
		'id' => 'single-comments-loc',
		'type' => 'enable',
		'desc' => 'Показывать количество комментариев в шапке записи, вкл / выкл.',
		'default' => true,
	));


	$normalPanel->createOption(array(
		'name' => 'Показывать лайки',
		'id' => 'single-like-loc',
		'type' => 'enable',
		'desc' => 'Показывать лайки в шапке записи, вкл / выкл.',
		'default' => true,
	));


	$normalPanel->createOption(array(
		'name' => 'Содержимое записи',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'name' => 'Изображение внутри записи',
		'id' => 'featured-img-loc',
		'type' => 'enable',
		'desc' => 'Выводить Изображение записи внутри самой публикации, под шапкой, вкл / выкл ',
		'default' => false,
	));

	$normalPanel->createOption(array(
		'name' => 'Произвольный контент',
		'id' => 'custom-content-loc',
		'type' => 'enable',
		'desc' => 'Блок для размещения произвольного контента в нижней части записей, вкл / выкл ',
		'default' => false,
	));

	$normalPanel->createOption(array(
		'name' => 'Разместить контент',
		'id' => 'custom-content',
		'type' => 'editor',
		'desc' => 'Поставьте здесь любой контент, например - текст, рекламный баннер, форму подписки, изображение и т.п. Блок поддерживает вывод разметки и шорткодов. Обычный текст пишем на вкладке "Визуально". Какой-либо код добавляем на вкладке "Текст".',
		'default' => '',
	));

	$normalPanel->createOption(array(
		'name' => 'Подвал записи',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'name' => 'Метки',
		'id' => 'single-tags-loc',
		'type' => 'enable',
		'desc' => 'Показывать блок с метками (тэгами) в подвале записи, вкл / выкл ',
		'default' => true,
	));

	$normalPanel->createOption(array(
		'name' => 'Поделиться в соц. сетях',
		'id' => 'single-social-loc',
		'type' => 'enable',
		'desc' => 'Показывать блок c кнопками "Поделиться" в подвале записи, вкл / выкл ',
		'default' => true,
	));

	$normalPanel->createOption(array(
		'name' => 'Показывать лайки',
		'id' => 'single-footer-like-loc',
		'type' => 'enable',
		'desc' => 'Показывать лайки в подвале записи, вкл / выкл.',
		'default' => true,
	));


	$normalPanel->createOption(array(
		'name' => 'Обсуждение',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'name' => 'Комментарии в записях',
		'id' => 'comments-post-loc',
		'type' => 'enable',
		'default' => true,
		'desc' => 'Выключить показ комментариев и формы отправки во всех записях',
	));

	$normalPanel->createOption(array(
		'name' => 'Комментарии на страницах',
		'id' => 'comments-page-loc',
		'type' => 'enable',
		'default' => false,
		'desc' => 'Выключить показ комментариев и формы отправки на всех страницах.',
	));

	$normalPanel->createOption(array(
		'type' => 'note',
		'desc' => 'Если комментарии включены здесь, но на сайте не появились, это значит, что ранее вы отключили комментирование избирательно, вручную, через движок, в настройках самой записи или страницы.',
	));

	$normalPanel->createOption(array(
		'name' => 'Спойлер для комментариев',
		'id' => 'comments-spoiler-loc',
		'type' => 'radio',
		'desc' => 'Если комментарии включены, показывать их как есть или убрать в спойлер, под кнопку:',
		'options' => array(
			'1' => 'Убрать в спойлер',
			'2' => 'Оставить как есть',
		),
		'default' => '1',
	));


	$normalPanel->createOption(array(
		'name' => 'Персональные данные',
		'id' => 'agree-loc',
		'type' => 'radio',
		'options' => array(
			'1' => 'Включить подтверждение',
			'2' => 'Не включать',
		),
		'default' => '1',
		'desc' => 'Оповещение посетителя о том, что он дает согласие на сбор и обработку своих персональных данных при отправке комментариев. Выводится в форме комментариев для посетителей, для залогиненного админа не выводится.'
	));

	$normalPanel->createOption(array(
		'name' => 'Ссылка на текст соглашения',
		'id' => 'policy-url',
		'type' => 'text',
		'desc' => 'Если оповещение включено, здесь разместите  адрес страницы с вашей политикой конфиденциальности. Не забываем http:// или https://',
		'default' => '',
	));


	$normalPanel->createOption(array(
		'name' => 'Еще из той же рубрики',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'name' => 'Похожие записи',
		'id' => 'related-posts-loc',
		'type' => 'enable',
		'default' => false,
		'desc' => 'Записи из той же рубрики, на ту же тему, для удержания посетителя.',
	));

	$normalPanel->createOption(array(
		'name' => 'Количество записей',
		'id' => 'related-posts-count',
		'type' => 'number',
		'desc' => 'Установите, сколько выводить похожих записей. Лучшее количество - кратное двум, например, 2, 4, 6 и т.д.',
		'default' => '4',
		'min' => '1',
		'max' => '10',
		'step' => '1'
	));

	$normalPanel->createOption(array(
		'name' => 'Отключить подвал в ячейке',
		'id' => 'related-footer-loc',
		'type' => 'checkbox',
		'default' => false,
		'desc' => 'Поставьте галочку, чтобы выключить в ячейках похожих записей вывод подвала с датой и лайком. ',
	));

	$normalPanel->createOption(array(
		'name' => 'Что еще почитать',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'name' => 'Случайные записи',
		'id' => 'random-posts-loc',
		'type' => 'enable',
		'default' => false,
		'desc' => 'Публикации для дополнительного чтения и направления трафика не только к новым записям, выбранные в случайном порядке. Выводятся в нижней части, над подвалом. 3 на ПК, 4 на моб.',
	));

	$normalPanel->createOption(array(
		'name' => 'Отключить подвал в ячейке',
		'id' => 'random-footer-loc',
		'type' => 'checkbox',
		'default' => false,
		'desc' => 'Поставьте галочку, чтобы выключить в ячейках случайных записей вывод подвала с датой и лайком. ',
	));


	$normalPanel->createOption(array(
		'type' => 'save',
	));

	$normalPanel = $adminPanel->createAdminPanel(array(
		'name' => 'Подвал сайта',
		'id' => 'footer-options',
	));

	$normalPanel->createOption(array(
		'name' => 'Показывать подвал',
		'id' => 'footer-loc',
		'type' => 'enable',
		'default' => true,
		'desc' => 'Показывать подвал сайта, состоящий из блока "О сайте" и колонки виджетов, вкл / выкл. ',
	));

	$normalPanel->createOption(array(
		'name' => 'О сайте',
		'id' => 'footer-content',
		'type' => 'editor',
		'desc' => 'Разместите описание сайта, для людей или поисковых ботов, или контактную информацию. Блок поддерживает шорткоды.',
		'default' => 'Разместите описание сайта, для людей или поисковых ботов, или контактную информацию. Блок поддерживает шорткоды.',
	));

	$normalPanel->createOption(array(
		'name' => 'Социальные сети',
		'id' => 'footer-socials-loc',
		'type' => 'enable',
		'default' => true,
		'desc' => 'Показывать кнопки соц. сетей, вкл / выкл. ',
	));

	$normalPanel->createOption(array(
		'name' => 'Меню в подвале',
		'id' => 'footer-nav-loc',
		'type' => 'checkbox',
		'default' => false,
		'desc' => 'Поставьте галочку, чтобы показывать меню в блоке О сайте. <br />Если включено, создайте в админке новое короткое одноуровневое меню и там же назначьте его на вывод в подвале.',
	));

	$normalPanel->createOption(array(
		'type' => 'save',
	));

	$normalPanel = $adminPanel->createAdminPanel(array(
		'name' => 'Оформление',
		'id' => 'style-options',
	));

	$normalPanel->createOption(array(
		'type' => 'note',
		'desc' => 'Здесь вы можете изменить цвета компонентов темы, перекрасить под себя. Подробнее об оформлении см в инструкции.',
	));

	$normalPanel->createOption(array(
		'name' => 'Браузер',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'name' => 'Цвет темы браузера',
		'id' => 'browser-theme',
		'type' => 'color',
		'desc' => 'Цвет темы браузера, в котором просматривается сайт (функция поддерживается не во всех браузерах и не на всех устройствах!).',
		'default' => '#1c59bc',
	));

	$normalPanel->createOption(array(
		'name' => 'Общие',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'name' => 'Фон сайта',
		'id' => 'body-bg',
		'type' => 'color',
		'desc' => 'Цвет фона вокруг контейнера сайта',
		'default' => '#f2f2f5',
	));

	$normalPanel->createOption(array(
		'name' => 'Цвет шрифта сайта',
		'id' => 'body-color',
		'type' => 'color',
		'desc' => 'Цвет текстов сайта',
		'default' => '#333646',
	));

	$normalPanel->createOption(array(
		'name' => 'Ссылки при наведении мыши: цвет шрифта',
		'id' => 'hover',
		'type' => 'color',
		'desc' => 'Цвет ссылки при наведении мыши (hover).',
		'default' => '#1c59bc',
	));


	$normalPanel->createOption(array(
		'name' => 'Кнопки',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'name' => 'Фон кнопки',
		'id' => 'btn-bg',
		'type' => 'color',
		'desc' => 'Цвет фона кнопки.',
		'default' => '#1c59bc',
	));

	$normalPanel->createOption(array(
		'name' => 'Текст на кнопке',
		'id' => 'btn-color',
		'type' => 'color',
		'desc' => 'Цвет шрифта текста кнопки.',
		'default' => '#ffffff',
	));

	$normalPanel->createOption(array(
		'name' => 'Фон кнопки при наведении мыши',
		'id' => 'btn-bg-hov',
		'type' => 'color',
		'desc' => 'Цвет фона кнопки при наведении мыши.',
		'default' => '#152b8e',
	));

	$normalPanel->createOption(array(
		'name' => 'Меню',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'name' => 'Фон выпадающего меню',
		'id' => 'nav-drop-bg',
		'type' => 'color',
		'desc' => 'Цвет фона дочернего (выпадающего меню).',
		'default' => '#333646',
	));

	$normalPanel->createOption(array(
		'name' => 'Цвет текста в выпадающем меню',
		'id' => 'nav-drop-color',
		'type' => 'color',
		'desc' => 'Цвет текста в пунктах выпадающего меню.',
		'default' => '#ffffff',
	));

	$normalPanel->createOption(array(
		'name' => 'Цвет подсветки в выпадающем меню ',
		'id' => 'nav-drop-bg-hov',
		'type' => 'color',
		'desc' => 'Цвет фона подсветки пунктов выпадающего меню при наведении мыши (hover).',
		'default' => '#535770',
	));

	$normalPanel->createOption(array(
		'name' => 'Фон липкого меню',
		'id' => 'sticky-nav-bg',
		'type' => 'color',
		'desc' => 'Цвет фона липкого меню.',
		'default' => '#333646',
	));

	$normalPanel->createOption(array(
		'name' => 'Шрифт липкого меню',
		'id' => 'sticky-nav-color',
		'type' => 'color',
		'desc' => 'Цвет текста в пунктах липкого меню.',
		'default' => '#f7f6fb',
	));

	$normalPanel->createOption(array(
		'name' => 'Разделы Главной',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'name' => 'Фон разделов Авторы и Популярные',
		'id' => 'section-alt-bg',
		'type' => 'color',
		'desc' => 'Цвет фона разелов Авторы и Популярные записи, для контраста.',
		'default' => '#f4f6fb',
	));

	$normalPanel->createOption(array(
		'name' => 'Декор',
		'type' => 'heading',
	));

	$normalPanel->createOption(array(
		'name' => 'Бордюр цитаты',
		'id' => 'blquote-border',
		'type' => 'color',
		'desc' => 'Цвет бокового бордюра цитаты в тексте записи.',
		'default' => '#57e',
	));

	$normalPanel->createOption(array(
		'name' => 'Фон "наклеек" в виджете Популярные',
		'id' => 'pop-widget-bg',
		'type' => 'color',
		'desc' => 'Цвет фона "наклеек" с порядковыми номерами в виджете Популярные записи.',
		'default' => '#57e',
	));

	$normalPanel->createOption(array(
		'name' => 'Фон "наклеек" в виджете рубрики',
		'id' => 'feat-widget-bg',
		'type' => 'color',
		'desc' => 'Цвет фона "наклеек" с порядковыми номерами в виджете одной выбранной рубрики.',
		'default' => '#e7327d',
	));	

	$normalPanel->createOption(array(
		'type' => 'save',
	));
} 

// EOF
