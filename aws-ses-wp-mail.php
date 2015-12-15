<?php
/**
 * Plugin Name:  AWS SES wp_mail drop-in
 * Plugin URI:   https://github.com/humanmade/aws-ses-wp-mail
 * Description:  Drop-in replacement for wp_mail using the AWS SES.
 * Version:      0.0.1
 * Author:       Joe Hoyle | Human Made
 * Author URI:   https://github.com/humanmade
 * License:      GPL-2.0+
 * License URI:  http://www.gnu.org/licenses/gpl-2.0.html
 */

namespace AWS_SES_WP_Mail;

if ( ( ! defined( 'AWS_SES_WP_MAIL_KEY' ) || ! defined( 'AWS_SES_WP_MAIL_SECRET' ) || ! defined( 'AWS_SES_WP_MAIL_REGION' ) ) && ! defined( 'AWS_SES_WP_MAIL_USE_INSTANCE_PROFILE' ) ) {
	return;
}

require_once dirname( __FILE__ ) . '/inc/class-ses.php';

if ( defined( 'WP_CLI' ) && WP_CLI ) {
	require_once dirname( __FILE__ ) . '/inc/class-wp-cli-command.php';
	\WP_CLI::add_command( 'aws-ses', __NAMESPACE__  . '\\WP_CLI_Command' );
}

if ( ! function_exists( 'wp_mail' ) ) :
function wp_mail( $to, $subject, $message, $headers = '', $attachments = array() ) {
	$result = SES::get_instance()->send_wp_mail( $to, $subject, $message, $headers, $attachments );

	if ( is_wp_error( $result ) ) {
		return false;
	}

	return $result;
}
endif;