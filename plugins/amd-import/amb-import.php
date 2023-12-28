<?php
/*
Plugin Name: AMB Importer
Description: Импорт записей с предыдущего сайта
Author: Simonov OG
Version: 1.0
*/

require 'Importer.php';

add_action('admin_menu', 'setup_importer_menu');

function setup_importer_menu()
{
    add_menu_page('Импорт журналов, статей, рубрик сайта',
        'Импорт записей с сайта',
        'manage_options',
        'amb-import-plugin',
        'import_init',
        'dashicons-upload');
}

function import_init()
{
    echo "<h1>Импорт записей</h1>";

    echo '<form ' . esc_url(admin_url('admin-post.php')) . '" method="POST" name="importer">';
    //echo wp_nonce_field( 'records_json_upload', 'fjson_nonce' );
    echo '<input type="hidden" name="action" value="import_data">';
    echo '<input type="hidden" name="proc_start" value="true">';
    echo "<br>";
    echo "<button type='submit'>Импортировать записи</button>";
    echo '</form>';

    if (!empty($_POST)) {

        $json = file_get_contents(plugin_dir_path(__FILE__) . 'data/data_1.json');
        $importer = new Importer($json);

        echo '<br><br> Импортирование статей началось...';
        echo '<br>';

        $importer->Import();

        echo 'Файл doc_json импортирован';

    }
}

