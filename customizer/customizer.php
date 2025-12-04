<?php

/**
 * frondendie Theme Customizer
 *
 * @package frondendie
 */

// Подключаем файл с цветовыми константами
require_once get_template_directory() . '/customizer/constants/color-constants.php';

// Подключаем вспомогательные функции для Customizer
require_once get_template_directory() . '/customizer/helpers/customizer-helpers.php';

// Подключаем кастомные контролы
require_once get_template_directory() . '/customizer/controls/control-sortable-list.php';

add_action('customize_register', 'load_customize_controls', 0);

function load_customize_controls()
{
	require_once (get_template_directory()) . '/customizer/controls/control-checkbox-multiple.php';
}

add_action('customize_controls_enqueue_scripts', 'frondendie_customize_controls_scripts');

function frondendie_customize_controls_scripts()
{
	wp_enqueue_script('frondendie-customize', get_template_directory_uri() . '/customizer/js/customizer.js', array('jquery'), _S_VERSION, true);
	wp_enqueue_script('frondendie-customize-controls', get_template_directory_uri() . '/customizer/js/customize-controls.js', array('jquery', 'jquery-ui-sortable'), _S_VERSION, true);
	wp_enqueue_style('frondendie-customize-controls', get_template_directory_uri() . '/customizer/css/styles.css', array(), _S_VERSION);
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function frondendie_customize_register($wp_customize)
{
	// как обновлять превью сайта:
	// 'refresh'     - перезагрузкой фрейма (можно полностью отказаться от JavaScript)
	// 'postMessage' - отправкой AJAX запроса
	$transport = 'refresh';
	$wp_customize->get_setting('blogname')->transport         = $transport;
	$wp_customize->get_setting('blogdescription')->transport  = $transport;


	$customizer_config = array(
		'panels' => array(
			'settings_site_options' => array(
				'priority'       => 30,
				'title' => 'Настройки сайта',
				'description' => '',
				'theme_supports' => 'settings_site_options',
				'sections' => [
					'colors_options' => [
						'title' => 'Цвета',
						'description' => 'Настройка цветов сайта',
						'priority' => 1,
						'controls' => [
							'color_main'  => [
								'default' => PRIMARY_COLOR,
								'transport' => $transport,
								'control' => array(
									'label'   => 'Основной цвет текста',
									'type'	=> 'color',
								)
							],
							'color_second'  => [
								'default' => SECONDARY_COLOR,
								'transport' => $transport,
								'control' => array(
									'label'   => 'Дополнительный цвет текста',
									'type'	=> 'color',
								)
							],
							'bg_main'  => [
								'default' => MAIN_BG_COLOR,
								'transport' => $transport,
								'control' => array(
									'label'   => 'Цвет фона',
									'type'	=> 'color',
								)
							],
							'titles_color' => [
								'default' => PRIMARY_COLOR,
								'transport' => $transport,
								'control' => array(
									'label'   => 'Цвет заголовков',
									'type'	=> 'color',
								)
							],
							'links_color' => [
								'default' => PRIMARY_COLOR,
								'transport' => $transport,
								'control' => array(
									'label'   => 'Цвет ссылок',
									'type'	=> 'color',
								)
							],
							'links_color_hover' => [
								'default' => SECONDARY_COLOR,
								'transport' => $transport,
								'control' => array(
									'label'   => 'Цвет ссылок при наведении',
									'type'	=> 'color',
								)
							],
							'btn_bg' => [
								'default' => BTN_DEFAULT_BG,
								'transport' => $transport,
								'control' => array(
									'label'   => 'Цвет фона кнопки',
									'type'	=> 'color',
								)
							],
							'btn_bg_hover' => [
								'default' => BTN_DEFAULT_BG_HOVER,
								'transport' => $transport,
								'control' => array(
									'label'   => 'Цвет фона кнопки при наведении',
									'type'	=> 'color',
								)
							],
							'btn_color' => [
								'default' => BTN_DEFAULT_COLOR,
								'transport' => $transport,
								'control' => array(
									'label'   => 'Цвет текста кнопки',
									'type'	=> 'color',
								)
							],
							'btn_color_hover' => [
								'default' => BTN_DEFAULT_COLOR_HOVER,
								'transport' => $transport,
								'control' => array(
									'label'   => 'Цвет текста кнопки при наведении',
									'type'	=> 'color',
								)
							],
						],
					],
					'contacts_options_section' => array(
						'title' => 'Контакты',
						'description' => '',
						'priority' => 2,
						'controls' => array(
							'site_phone' => array(
								'default' => '',
								'transport' => $transport,
								'control' => array(
									'label' => 'Номер телефона',
									'type' => 'text',
								),
							),
							'site_email' => array(
								'default' => '',
								'transport' => $transport,
								'control' => array(
									'label' => 'Email',
									'type' => 'text',
								),
							),
							'site_address' => array(
								'default' => '',
								'transport' => $transport,
								'control' => array(
									'label' => 'Адрес',
									'type' => 'textarea',
								),
							),
							'site_job_time' => array(
								'default' => '',
								'transport' => $transport,
								'control' => array(
									'label' => 'Время работы',
									'type' => 'text',
								),
							),
						)
					),
					'header_options_section' => array(
						'title' => 'Шапка сайта',
						'description' => 'Отображение элементов шапки сайта и её поведение',
						'priority' => 5,
						'controls' => array(
							'sticked' => array(
								'default' => false,
								'transport' => $transport,
								'control' => array(
									'label' => 'Липкая шапка',
									'type' => 'checkbox',
								),
							),
							// 'top' => array(
							// 	'default' => true,
							// 	'transport' => $transport,
							// 	'control' => array(
							// 		'label' => 'Показывать панель с контактами',
							// 		'type' => 'checkbox',
							// 	),
							// ),
							'show_address' => array(
								'default' => false,
								'transport' => $transport,
								'control' => array(
									'label' => 'Показать адрес',
									'type' => 'checkbox',
								),
							),
							'show_phone' => array(
								'default' => false,
								'transport' => $transport,
								'control' => array(
									'label' => 'Показать номер телефона',
									'type' => 'checkbox',
								),
							),
							'show_email' => array(
								'default' => false,
								'transport' => $transport,
								'control' => array(
									'label' => 'Показать Email',
									'type' => 'checkbox',
								),
							),
							'show_job_time' => array(
								'default' => false,
								'transport' => $transport,
								'control' => array(
									'label' => 'Показать время работы',
									'type' => 'checkbox',
								),
							),
							'show_social' => array(
								'default' => false,
								'transport' => $transport,
								'control' => array(
									'label' => 'Показать социальные сети',
									'type' => 'checkbox',
								),
							),
							// 'show_account_link' => array(
							// 	'default' => true,
							// 	'transport' => $transport,
							// 	'control' => array(
							// 		'label' => 'Показать ссылку на аккаунт',
							// 		'type' => 'checkbox',
							// 	),
							// ),
							// 'show_callback_bth' => array(
							// 	'default' => true,
							// 	'transport' => $transport,
							// 	'control' => array(
							// 		'label' => 'Показать кнопку обратного звонка',
							// 		'type' => 'checkbox',
							// 	),
							// ),
							'show_callback_bth' => array(
								'default' => 'Оставить заявку',
								'transport' => $transport,
								'control' => array(
									'label' => 'Кнопку обратного звонка',
									'type' => 'text',
								),
							),
						)
					),
					'footer_options_section' => array(
						'title' => 'Подвал сайта',
						'description' => 'Настройка футера сайта',
						'priority' => 15,
						'controls' => array(
							'show_footer_logo' => array(
								'default' => true,
								'transport' => $transport,
								'control' => array(
									'label' => 'Показать логотип',
									'type' => 'checkbox',
								),
							),
							'show_footer_address' => array(
								'default' => false,
								'transport' => $transport,
								'control' => array(
									'label' => 'Показать адрес',
									'type' => 'checkbox',
								),
							),
							'show_footer_social' => array(
								'default' => false,
								'transport' => $transport,
								'control' => array(
									'label' => 'Показать социальные сети',
									'type' => 'checkbox',
								),
							),
							'show_footer_menu' => array(
								'default' => true,
								'transport' => $transport,
								'control' => array(
									'label' => 'Показать меню',
									'type' => 'checkbox',
								),
							),
							'show_footer_copyright' => array(
								'default' => true,
								'transport' => $transport,
								'control' => array(
									'label' => 'Показать копирайт',
									'type' => 'checkbox',
								),
							),
							// 'footer_contact_title' => array(
							// 	'default' => 'Контакты',
							// 	'transport' => $transport,
							// 	'control' => array(
							// 		'label' => 'Заголовок колонки с контактами',
							// 		'type' => 'text',
							// 	),
							// ),
							// 'footer_address_title' => array(
							// 	'default' => 'Ждём в гости',
							// 	'transport' => $transport,
							// 	'control' => array(
							// 		'label' => 'Заголовок с адресом и соцсетями',
							// 		'type' => 'text',
							// 	),
							// ),
							'footer_copyright_text' => array(
								'default' => '',
								'transport' => $transport,
								'control' => array(
									'label' => 'Текст копирайта (символ и год подставляются автоматически)',
									'type' => 'text',
								),
							),
							'show_footer_policy' => array(
								'default' => true,
								'transport' => $transport,
								'control' => array(
									'label' => 'Показать ссылку политики конфиденциальности',
									'type' => 'checkbox',
								),
							),
							'show_footer_accept_popup' => array(
								'default' => true,
								'transport' => $transport,
								'control' => array(
									'label' => 'Показать всплывающее окно с политикой конфиденциальности',
									'type' => 'checkbox',
								),
							),
							'footer_accept_popup_text' => array(
								'default' => '',
								'transport' => $transport,
								'control' => array(
									'label' => 'Текст всплывающего окна с политикой конфиденциальности',
									'type' => 'textarea',
								),
							),
							'show_sitemap' => array(
								'default' => true,
								'transport' => $transport,
								'control' => array(
									'label' => 'Показывать карту сайта',
									'type' => 'checkbox',
								),
							),
							'sitemap_link' => array(
								'default' => '/sitemap.xml',
								'transport' => $transport,
								'control' => array(
									'label' => 'Ссылка на карту сайта',
									'type' => 'text',
								),
							),
							'sitemap_text' => array(
								'default' => 'Карта сайта',
								'transport' => $transport,
								'control' => array(
									'label' => 'Текст ссылки на карту сайта',
									'type' => 'text',
								),
							),
						)
					),
					'socials_options_section' => array(
						'title' => 'Социальные сети',
						'description' => 'Ссылки на социальные сети',
						'priority' => 20,
						'controls' => array(
							'socials_list' => array(
								'default' => 'tg,vk',
								'transport' => $transport,
								'control' => array(
									'label' => 'Социальные сети',
									'type' => 'sortable-list',
									'choices' => array(
										'vk' => 'ВКонтакте',
										'tg' => 'Telegram',
										'ok' => 'Одноклассники',
										'max' => 'Max',
										'dzen' => 'Яндекс Дзен',
										'rutube' => 'Rutube',
										'wa' => 'WhatsApp',
										'tw' => 'Twitter',
										'yt' => 'YouTube',
										'inst' => 'Instagram',
										'fb' => 'Facebook',
									),
								),
							),
						)
					),
					'payment_methods_section' => array(
						'title' => 'Способы платежа',
						'description' => 'Выберите доступные способы оплаты',
						'priority' => 25,
						'controls' => array(
							'payment_methods' => array(
								'default' => array('mir', 'sbp'),
								'transport' => $transport,
								'control' => array(
									'label' => 'Способы оплаты',
									'type' => 'checkbox-multiple',
									'choices' => array(
										'mir' => 'МИР',
										'sbp' => 'СБП',
										'yoomoney' => 'Юмани',
										'visa' => 'Visa',
										'mc' => 'Master Card',
										'paypal' => 'PayPal',
										'bitcoin' => 'Bitcoin',
										'ethereum' => 'Ethereum',
									),
								),
							),
						)
					),
					'seo_section' => array(
						'title' => 'SEO настройки',
						'description' => '',
						'priority' => 30,
						'controls' => array(
							'show_google' => array(
								'default' => false,
								'transport' => $transport,
								'control' => array(
									'label' => 'Включить Google Analytics',
									'type' => 'checkbox',
								),
							),
							'google_metrica' => array(
								'default' => '',
								'transport' => $transport,
								'control' => array(
									'label' => 'Google Analytics',
									'type' => 'textarea',
								),
							),
							'show_yandex' => array(
								'default' => false,
								'transport' => $transport,
								'control' => array(
									'label' => 'Включить Yandex Metrika',
									'type' => 'checkbox',
								),
							),
							'yandex_metrica' => array(
								'default' => '',
								'transport' => $transport,
								'control' => array(
									'label' => 'Yandex Metrika',
									'type' => 'textarea',
								),
							),
						)
					),
				],
			),
		),
	);

	// Регистрируем панели и секции с помощью универсальной функции
	register_customizer_elements($wp_customize, $customizer_config);
}
add_action('customize_register', 'frondendie_customize_register');

add_action('wp_head', 'customizer_style_tag');

function customizer_style_tag()
{

	$style = [];

	$style[] = ':root { --color-main: ' . get_theme_mod('color_main', PRIMARY_COLOR) . '; --color-second: ' . get_theme_mod('color_second', SECONDARY_COLOR) . '; --bg-main: ' . get_theme_mod('bg_main', MAIN_BG_COLOR) . '; --titles-color: ' . get_theme_mod('titles_color', PRIMARY_COLOR) . '; --links-color: ' . get_theme_mod('links_color', PRIMARY_COLOR) . '; --links-color-hover: ' . get_theme_mod('links_color_hover', SECONDARY_COLOR) . '; --btn-bg: ' . get_theme_mod('btn_bg', BTN_DEFAULT_BG) . '; --btn-bg-hover: ' . get_theme_mod('btn_bg_hover', BTN_DEFAULT_BG_HOVER) . '; --btn-color: ' . get_theme_mod('btn_color', BTN_DEFAULT_COLOR) . '; --btn-color-hover: ' . get_theme_mod('btn_color_hover', BTN_DEFAULT_COLOR_HOVER) . '; }';


	echo "<style>\n" . implode("\n", $style) . "\n</style>\n";
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function frondendie_customize_partial_blogname()
{
	bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function frondendie_customize_partial_blogdescription()
{
	bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function frondendie_customize_preview_js()
{
	wp_enqueue_script('frondendie-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), _S_VERSION, true);
}
add_action('customize_preview_init', 'frondendie_customize_preview_js');
