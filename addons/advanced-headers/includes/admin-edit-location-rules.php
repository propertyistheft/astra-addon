<?php
/**
 * Locations rules table
 *
 * @package Astra Addon
 */

?>

<table class="ast-advanced-headers-locations-form ast-advanced-headers-table widefat">
	<tr class="ast-advanced-headers-row ast-advanced-headers-location-rules">
		<td  class="ast-advanced-headers-row-heading">
			<label><?php esc_html_e( 'Display On', 'astra-addon' ); ?></label>
			<i class="ast-advanced-headers-heading-help dashicons dashicons-editor-help" title="<?php /* translators: %s: singular  post name; */ echo esc_attr( sprintf( __( 'Add locations for where this %s should appear.', 'astra-addon' ), $post_type->labels->singular_name ) ); ?>"></i>
		</td>
		<td class="ast-advanced-headers-row-content">
			<div class="ast-advanced-headers-saved-locations ast-advanced-headers-saved-rules"></div>
			<div class="ast-advanced-headers-add-location ast-advanced-headers-add-rule">
				<a href="javascript:void(0);" class="ast-advanced-headers-add-location ast-advanced-headers-add-rule button"><?php esc_html_e( 'Add Location Rule', 'astra-addon' ); ?></a>
			</div>
			<div class="ast-advanced-headers-add-exclusion ast-advanced-headers-add-rule">
				<a href="javascript:void(0);" class="ast-advanced-headers-add-exclusion ast-advanced-headers-add-rule button"><?php esc_html_e( 'Add Exclusion Rule', 'astra-addon' ); ?></a>
			</div>
		</td>
	</tr>
	<tr class="ast-advanced-headers-row ast-advanced-headers-location-rules ast-advanced-headers-exclusion-rules">
		<td class="ast-advanced-headers-row-heading">
			<label><?php esc_html_e( 'Exclude On', 'astra-addon' ); ?></label>
			<i class="ast-advanced-headers-heading-help dashicons dashicons-editor-help" title="<?php /* translators: %s: singular  post name; */ echo esc_attr( sprintf( __( 'This %s will not appear at these locations.', 'astra-addon' ), $post_type->labels->singular_name ) ); ?>"></i>
		</td>
		<td class="ast-advanced-headers-row-content">
			<div class="ast-advanced-headers-saved-locations ast-advanced-headers-saved-rules"></div>
			<div class="ast-advanced-headers-add-location ast-advanced-headers-add-rule">
				<a href="javascript:void(0);" class="ast-advanced-headers-add-location ast-advanced-headers-add-rule button"><?php esc_html_e( 'Add Exclusion Rule', 'astra-addon' ); ?></a>
			</div>
		</td>
	</tr>
</table>

<script type="text/html" id="tmpl-ast-advanced-headers-saved-location">
	<div class="ast-advanced-headers-saved-location ast-advanced-headers-saved-rule">
		<div class="ast-advanced-headers-saved-rule-select">
			<select name="ast-advanced-headers-{{data.type}}[]" class="ast-advanced-headers-locations">
				<option value=""><?php esc_html_e( 'Choose...', 'astra-addon' ); ?></option>
				<?php foreach ( $locations['by_post_type'] as $astra_addon_group ) { ?>
					<optgroup label="<?php echo esc_attr( $astra_addon_group['label'] ); ?>">
						<?php foreach ( $astra_addon_group['locations'] as $astra_addon_location ) { ?>
							<option value='<?php echo wp_json_encode( $astra_addon_location ); ?>' data-type="<?php echo esc_attr( $astra_addon_location['type'] ); ?>" data-location="<?php echo esc_attr( $astra_addon_location['type'] . ':' . $astra_addon_location['id'] ); ?>"><?php echo esc_html( $astra_addon_location['label'] ); ?></option>
						<?php } ?>
					</optgroup>
				<?php } ?>
			</select>
			<select name="ast-advanced-headers-{{data.type}}-objects[]" class="ast-advanced-headers-location-objects ast-advanced-headers-rule-objects">
				<option value=""><?php esc_html_e( 'Choose...', 'astra-addon' ); ?></option>
			</select>
		</div>
		<div class="ast-advanced-headers-remove-rule-button">
			<i class="ast-advanced-headers-remove-location ast-advanced-headers-remove-rule dashicons dashicons-dismiss"></i>
		</div>
	</div>
</script>
