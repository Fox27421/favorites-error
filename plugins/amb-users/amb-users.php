<?php
// Plugin Name: Amb-Express Users Plugin

function setup_user_roles() {
	add_role( 'magazine_editor', 'Редактор журнала', array(
		'read' => true,
		'edit_posts'   => true,
		'delete_posts' => true,
		'delete_published_posts' => true,
		'publish_posts' => true,
		'upload_files' => true,
		'edit_published_posts' => true,
		'manage_categories' => true ) );

	add_role( 'registered_client', 'Зарегистрированный пользователь', array(
		'read' => true) );

}
register_activation_hook( __FILE__, 'setup_user_roles' );
register_deactivation_hook( __FILE__, 'deinit_user_roles' );

function deinit_user_roles()
{
	if(get_role('registered_client'))
		remove_role('registered_client');
}

function users_add_caps(){
	$teacher = get_role( 'magazine_editor' );
	$teacher->add_cap( 'read_article' );
	$teacher->add_cap( 'read_private_article' );
	$teacher->add_cap( 'edit_article' );
	$teacher->add_cap( 'edit_articles' );
	$teacher->add_cap( 'edit_others_articles' );
	$teacher->add_cap( 'edit_published_articles' );
	$teacher->add_cap( 'edit_private_articles' );
	$teacher->add_cap( 'delete_articles' );
	$teacher->add_cap( 'delete_articles' );
	$teacher->add_cap( 'delete_others_articles' );
	$teacher->add_cap( 'delete_published_articles' );
	$teacher->add_cap( 'delete_private_article' );
	$teacher->add_cap( 'publish_articles' );
	$teacher->add_cap( 'moderate_article_comments' );
}
add_action( 'admin_init', 'users_add_caps');