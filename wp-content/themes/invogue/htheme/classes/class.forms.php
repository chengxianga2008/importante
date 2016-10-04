<?php
/**
 * THEME - InVogue
 * AUTHOR - HEROPLUGINS
 */

// HERO FORMS CLASS
class htheme_forms{

	#CONSTRUCT
	public function __construct(){
		#INSTANTIATE HERO CHECK CLASS
		$this->check = new htheme_check();
	}

	#GET SESSION SIGNUP
	public function htheme_set_signup_session(){

		if(isset($_COOKIE['show_signup']) && $_COOKIE['show_signup'] == 'show'){

			setcookie( 'show_signup', 'hide', time()+3600*24*100, COOKIEPATH, COOKIE_DOMAIN, false );
			echo json_encode('success');
			exit();

		} else {

			echo json_encode('error');
			exit();

		}

	}

	#GET OPTIONS
	public function htheme_check_forms(){

		#GET FORM DATA
		$form_data = array();
		parse_str($_POST['data'], $form_data);

		switch($_POST['type']){
			case 'contact':
				$this->htheme_check_contact($form_data, $_POST['subject']);
			break;
			case 'signup':
				$this->htheme_check_signup($form_data);
			break;
		}

	}

	#CHECK CONTACT
	public function htheme_check_contact($form_data, $subjectLine){

		#VALIDATE DATA
		$status = true;

		#NAME
		if(isset($form_data['user_name']) && $this->check->htheme_checkString($form_data['user_name'])){
			$user_name = true;
		}else{
			$user_name = false;
			$status = false;
		}

		#LAST
		if(isset($form_data['user_last']) && $this->check->htheme_checkString($form_data['user_last'])){
			$user_last = true;
		}else{
			$user_last = false;
			$status = false;
		}

		#EMAIL
		if(isset($form_data['user_email']) && $this->check->htheme_checkEmail($form_data['user_email'])){
			$user_email = true;
		}else{
			$user_email = false;
			$status = false;
		}

		#MESSAGE TYPE
		if(isset($form_data['user_message']) && $this->check->htheme_checkString($form_data['user_message'])){
			$user_message = true;
		}else{
			$user_message = false;
			$status = false;
		}

		#RESPOND
		if($status){

			#VARIABLES
			$subject = $subjectLine;
			$admin_email = get_option( 'admin_email' );
			$user_name = $form_data['user_name'];
			$user_last = $form_data['user_last'];
			$user_email = $form_data['user_email'];
			$user_message = $form_data['user_message'];

			#HEADERS
			$headers = array(
				"From:" .$user_name. " " .$user_last. " <".$form_data['user_email'].'>',
				"Bcc:".$admin_email,
			);

			#SEND EMAIL
			wp_mail($user_email, $subject, $user_message, $headers, array());

			#RETURN ARRAY
			$return_array = array(
				'status' => $status,
				'insert_msg' => 'Message sent!',
			);

			#NO ERRORS
			echo json_encode($return_array);
			exit();

		}else{

			#ERROR ARRAY
			$error_array = array(
				'status' => $status,
				'insert_msg' => 'Your form has erros\'s!',
				'fields' => array(
					'user_name' => $user_name,
					'user_last' => $user_last,
					'user_email' => $user_email,
					'user_message' => $user_message,
				),
			);

			#RETURN
			echo json_encode($error_array);
			exit();

		}

	}

	#CHECK CONTACT
	public function htheme_check_signup($form_data){

		#VALIDATE DATA
		$status = true;

		#EMAIL
		if(isset($form_data['user_signup_email']) && $this->check->htheme_checkEmail($form_data['user_signup_email'])){
			$user_signup_email = true;
		}else{
			$user_signup_email = false;
			$status = false;
		}

		#RESPOND
		if($status){

			$args = array(
				'post_type' => 'signup',
				'post_status' => 'publish',
				'orderby' => 'post-date',
				'order' => 'DESC',
				'numberposts' => -1
			);

			//get query data
			$signups = get_posts( $args );

			$my_error = true;

			if(!empty($signups)){
				foreach($signups as $s){
					$saved_newsletter_email = get_post_meta($s->ID, 'htheme_meta_user_signup_email', true);
					if ( $form_data['user_signup_email'] == $saved_newsletter_email ) {
						$my_error = false;
					}
				}
			}

			if ( $my_error == true ) {

				// insert test
				$signup_query_post = array(
					'post_status'		=> 'publish',
					'post_type'			=> 'signup',
					'post_title'		=> $form_data['user_signup_email']
				);

				$signup_post_id = wp_insert_post($signup_query_post);

				add_post_meta($signup_post_id, 'htheme_meta_user_signup_email', $form_data['user_signup_email']);

				$email_status = true;
				echo json_encode(array('status' => $status, 'email_status' => $email_status, 'insert_msg' => 'Signup successful!' ));
				exit();

			} else {
				$email_status = false;
				echo json_encode(array('status' => $status, 'email_status' => $email_status, 'insert_msg' => 'Email already used!' ));
				exit();
			}

		}else{

			#ERROR ARRAY
			$error_array = array(
				'status' => $status,
				'fields' => array(
					'user_signup_email' => $user_signup_email,
				)
			);

			#RETURN
			echo json_encode($error_array);
			exit();

		}

	}

}