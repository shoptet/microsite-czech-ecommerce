<?php
//Remove sensitive data from REST API
function sk_remove_sensitive_data_from_rest( $response ) {

	if ( !current_user_can('list_users') ) {

		//get WP_REST_Response
		$data = $response->get_data();
		//unset sensitive fields
		if ( preg_replace('/[\W]+/', '', $data['name'] ) == preg_replace( '/[\W]+/', '', $data['slug'] ) )
			$data['name'] = "Author";

		unset($data['link']);
		unset($data['slug']);
		unset($data['avatar_urls']);
		//set data back
		$response->set_data($data);
	}

	return $response;

}
add_filter( 'rest_prepare_user', 'sk_remove_sensitive_data_from_rest' );

?>
