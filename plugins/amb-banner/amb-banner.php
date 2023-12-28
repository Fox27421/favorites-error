<?php
/*
Plugin Name: AB Banner placer
Description: Показ баннеров на сайте
Author: Simonov OG
Version: 1.0
*/

use Timber\Timber;

add_action( 'admin_menu', 'setup_banner_menu' );

function setup_banner_menu()
{
	add_menu_page( 'Размещение баннеров',
		'Размешение баннеров на сайте',
		'manage_options',
		'amb-banner-plugin',
		'banners_init',
		'dashicons-welcome-widgets-menus', 30 );
}

function banners_init()
{
	function my_enqueue_media_lib_uploader()
	{

		//Core media script
		wp_enqueue_media();

		// Your custom js file
		wp_register_script( 'media-lib-uploader-js', plugins_url( 'media-lib-uploader.js', __FILE__ ), array( 'jquery' ) );
		wp_enqueue_script( 'media-lib-uploader-js' );
	}

	add_action( 'admin_enqueue_scripts', 'my_enqueue_media_lib_uploader' );


	?>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $('#upload-button1').click(function (e) {
                e.preventDefault();
                // If the uploader object has already been created, reopen the dialog
                let mediaUploader;
                if (mediaUploader)
                {
                    mediaUploader.open();
                    return;
                }
                // Extend the wp.media object
                mediaUploader = wp.media.frames.file_frame = wp.media({
                    title: 'Выберете изображение баннера',
                    button: {
                        text: 'Выберете изображение баннера'
                    }, multiple: false
                });

                // When a file is selected, grab the URL and set it as the text field's value
                mediaUploader.on('select', function () {
                    let attachment = mediaUploader.state().get('selection').first().toJSON();
                    $('#image-url1').val(attachment.url);
                });
                // Open the uploader dialog
                mediaUploader.open();
            });

            $('#upload-button2').click(function (e) {
                e.preventDefault();
                // If the uploader object has already been created, reopen the dialog
                let mediaUploader;
                if (mediaUploader)
                {
                    mediaUploader.open();
                    return;
                }
                // Extend the wp.media object
                mediaUploader = wp.media.frames.file_frame = wp.media({
                    title: 'Выберете изображение баннера',
                    button: {
                        text: 'Выберете изображение баннера'
                    }, multiple: false
                });

                // When a file is selected, grab the URL and set it as the text field's value
                mediaUploader.on('select', function () {
                    let attachment = mediaUploader.state().get('selection').first().toJSON();
                    $('#image-url2').val(attachment.url);
                });
                // Open the uploader dialog
                mediaUploader.open();
            });

            $('#upload-button3').click(function (e) {
                e.preventDefault();
                // If the uploader object has already been created, reopen the dialog
                let mediaUploader;
                if (mediaUploader)
                {
                    mediaUploader.open();
                    return;
                }
                // Extend the wp.media object
                mediaUploader = wp.media.frames.file_frame = wp.media({
                    title: 'Выберете изображение баннера',
                    button: {
                        text: 'Выберете изображение баннера'
                    }, multiple: false
                });

                // When a file is selected, grab the URL and set it as the text field's value
                mediaUploader.on('select', function () {
                    let attachment = mediaUploader.state().get('selection').first().toJSON();
                    $('#image-url3').val(attachment.url);
                });
                // Open the uploader dialog
                mediaUploader.open();
            });

            $('#upload-button4').click(function (e) {
                e.preventDefault();
                // If the uploader object has already been created, reopen the dialog
                let mediaUploader;
                if (mediaUploader)
                {
                    mediaUploader.open();
                    return;
                }
                // Extend the wp.media object
                mediaUploader = wp.media.frames.file_frame = wp.media({
                    title: 'Выберете изображение баннера',
                    button: {
                        text: 'Выберете изображение баннера'
                    }, multiple: false
                });

                // When a file is selected, grab the URL and set it as the text field's value
                mediaUploader.on('select', function () {
                    let attachment = mediaUploader.state().get('selection').first().toJSON();
                    $('#image-url4').val(attachment.url);
                });
                // Open the uploader dialog
                mediaUploader.open();
            });

        });
    </script>
	<?php
	$context = [];

	if ( ! empty( $_POST['ban_nonce'] ) && wp_verify_nonce( $_POST['ban_nonce'], 'banners_update' ) )
	{

        $banner1 = [
            'name'       => empty( $_POST['banner1_name'] ) ? 'Баннер1' : $_POST['banner1_name'],
            'url'        => empty( $_POST['banner1_url'] ) ? '' : $_POST['banner1_url'],
            'enabled'    => ( isset( $_POST['banner1_enabled'] ) && ( $_POST['banner1_enabled'] === 'on' ) ) ? 1 : 0,
            'image'      => empty( $_POST['banner1_image'] ) ? '' : $_POST['banner1_image']
        ];
        update_option( 'banner1', $banner1, false );

        $banner2 = [
            'name'       => empty( $_POST['banner2_name'] ) ? 'Баннер2' : $_POST['banner2_name'],
            'url'        => empty( $_POST['banner2_url'] ) ? '' : $_POST['banner2_url'],
            'enabled'    => ( isset( $_POST['banner2_enabled'] ) && ( $_POST['banner2_enabled'] === 'on' ) ) ? 1 : 0,
            'image'      => empty( $_POST['banner2_image'] ) ? '' : $_POST['banner2_image']
        ];
        update_option( 'banner2', $banner2, false );

        $banner3 = [
            'name'       => empty( $_POST['banner3_name'] ) ? 'Баннер3' : $_POST['banner3_name'],
            'url'        => empty( $_POST['banner3_url'] ) ? '' : $_POST['banner3_url'],
            'enabled'    => ( isset( $_POST['banner3_enabled'] ) && ( $_POST['banner3_enabled'] === 'on' ) ) ? 1 : 0,
            'image'      => empty( $_POST['banner3_image'] ) ? '' : $_POST['banner3_image']
        ];
        update_option( 'banner3', $banner3, false );

        $banner4 = [
            'name'       => empty( $_POST['banner4_name'] ) ? 'Баннер4' : $_POST['banner4_name'],
            'url'        => empty( $_POST['banner4_url'] ) ? '' : $_POST['banner4_url'],
            'enabled'    => ( isset( $_POST['banner4_enabled'] ) && ( $_POST['banner4_enabled'] === 'on' ) ) ? 1 : 0,
            'image'      => empty( $_POST['banner4_image'] ) ? '' : $_POST['banner4_image']
        ];
        update_option( 'banner4', $banner4, false );
    }

	$banner1 = get_option( 'banner1' );
	if ( $banner1 === false )
	{
		$banner1 = [
			'name'       => 'Баннер 1',
			'url'        => '',
			'enabled'    => 1,
			'image'      => ''
		];
	}

	$banner2 = get_option( 'banner2' );
	if ( $banner2 === false )
	{
		$banner2 = [
			'name'       => 'Баннер 2',
			'url'        => '',
			'enabled'    => 1,
			'image'      => ''
		];
	}

	$banner3 = get_option( 'banner3' );
	if ( $banner3 === false )
	{
		$banner3 = [
			'name'       => 'Баннер 3',
			'url'        => '',
			'enabled'    => 1,
			'image'      => ''
		];
	}

	$banner4 = get_option( 'banner4' );
	if ( $banner4 === false )
	{
		$banner4 = [
			'name'       => 'Баннер 4',
			'url'        => '',
			'enabled'    => 1,
			'image'      => ''
		];
	}


	$context['nonce']  = wp_nonce_field( 'banners_update', 'ban_nonce', true, false );
	$context['banner1'] = $banner1;
	$context['banner2'] = $banner2;
	$context['banner3'] = $banner3;
	$context['banner4'] = $banner4;

	Timber::render( 'views/banner_admin.twig', $context );
}

