<?php
/**
 * Reset control.
 *
 * @package xts
 */

namespace XTS\Admin\Modules\Options\Controls;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

use XTS\Admin\Modules\Options\Field;

/**
 * Textarea field control.
 */
class Reset extends Field {
	/**
	 * Displays the field control HTML.
	 *
	 * @since 1.0.0
	 *
	 * @return void.
	 */
	public function render_control() {
		?>
		<button class="xts-reset-options-btn xts-i-round-right xts-btn" name="xts-woodmart-options[reset-defaults]" value="1"><?php esc_html_e( 'Reset all settings', 'woodmart' ); ?></button>
		<?php
	}
}


