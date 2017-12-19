<?php
require('./wp-load.php');
require_once( ABSPATH . WPINC . '/class-http.php' );
require_once( ABSPATH . 'wp-admin/includes/image.php' );

/**
* User Avatar
*/
class UserAvatar
{

	protected $http;

	function __construct()
	{
		$this->http = new WP_Http();
	}

	public function crb_insert_attachment_from_url($url, $user_id, $post_id = null) {

		$image = $this->import_image($url);
		if (!$image) {
			return false;
		}

		$file_path = $upload['file'];
		$file_name = basename( $file_path );
		$file_type = wp_check_filetype( $file_name, null );
		$attachment_title = sanitize_file_name( pathinfo( $file_name, PATHINFO_FILENAME ) );
		$wp_upload_dir = wp_upload_dir();

		$post_info = [
			'guid'				=> $wp_upload_dir['url'] . '/' . $file_name, 
			'post_mime_type'	=> $file_type['type'],
			'post_title'		=> $attachment_title,
			'post_content'		=> '',
			'post_status'		=> 'inherit',
		];

		// CRIANDO METADATA DA IMAGEM
		$attach_id = wp_insert_attachment( $post_info, $file_path, $post_id );

		// CRIANDO METADATA PARA A NOVA IMAGEM ADICIONADA
		$attach_data = wp_generate_attachment_metadata( $attach_id, $file_path );

		// CRIANDO METADATA PARA A NOVA IMAGEM ADICIONADA
		wp_update_attachment_metadata( $attach_id,  $attach_data );

		//DELETA METADA EXISTENTE
		delete_metadata('post', null, '_wp_attachment_wp_user_avatar', $user_id, true);

	    // CRIA POSTMETA USER AVATAR E RELACIONA PARA O USUÁRIO
	    update_post_meta($attach_id, '_wp_attachment_wp_user_avatar', $user_id);

	    // ATUALIZA O USER META DO AVATAR DO USUÁRIO
	    update_user_meta($user_id, 'intra_stag_user_avatar', $attach_id);

		return $attach_id;
	}

	protected funcion import_image($url)
	{
		$response = $this->http->request( $url );
		if ( $response['response']['code'] != 200 ) {
			return false;
		}

		$upload = wp_upload_bits( basename($url), null, $response['body'] );
		if ( !empty( $upload['error'] ) ) {
			return false;
		}

		return $upload;
	}
}

$url = $_GET['image_url'];
$user_id   = $_GET['user_id'];

crb_insert_attachment_from_url($url, $user_id );