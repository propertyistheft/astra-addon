<?php
/**
 * Users rules table
 *
 * @package Astra Addon
 */

?>

<script type="text/html" id="tmpl-ast-advanced-headers-saved-user-rule">
	<div class="ast-advanced-headers-saved-user-rule ast-advanced-headers-saved-rule">
		<div class="ast-advanced-headers-saved-rule-select">
			<select name="ast-advanced-headers-user-rule[]"  class="ast-advanced-headers-user-rule">
				<option value=""><?php esc_html_e( 'Choose...', 'astra-addon' ); ?></option>
				<?php foreach ( $rules as $astra_addon_group_key => $astra_addon_group_data ) { ?>
					<optgroup label="<?php echo esc_attr( $astra_addon_group_data['label'] ); ?>">
						<?php foreach ( $astra_addon_group_data['rules'] as $astra_addon_rule_key => $astra_addon_rule_data ) { ?>
							<option value='<?php echo wp_json_encode( $astra_addon_rule_data ); ?>' data-rule="<?php echo esc_attr( $astra_addon_rule_data['type'] . ':' . $astra_addon_rule_data['id'] ); ?>"><?php echo esc_html( $astra_addon_rule_data['label'] ); ?></option>
						<?php } ?>
					</optgroup>
				<?php } ?>
			</select>
		</div>
		<div class="ast-advanced-headers-remove-rule-button">
			<i class="ast-advanced-headers-remove-user-rule ast-advanced-headers-remove-rule dashicons dashicons-dismiss"></i>
		</div>
	</div>
</script>
