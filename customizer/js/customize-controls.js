/**
 * Customizer controls script
 *
 * @package frondendie
 */

jQuery(document).ready(function($) {
	// Sortable list control
	$('.sortable-list-control').each(function() {
		var $control = $(this);
		var $list = $control.find('.sortable-list');
		var $input = $control.find('input[type="hidden"]');
		
		// Make list sortable
		$list.sortable({
			handle: '.dashicons-move',
			update: function() {
				updateSortableListValues($control);
			}
		});
		
		// Handle checkbox changes
		$control.on('change', 'input[type="checkbox"]', function() {
			updateSortableListValues($control);
		});
		
		// Handle text input changes
		$control.on('input', '.sortable-list-item-link', function() {
			updateSortableListValues($control);
		});
		
		// Initialize values
		updateSortableListValues($control);
	});
	
	// Checkbox multiple control
	$('.customize-control-multy-choice').each(function() {
		var $control = $(this);
		var $checkboxes = $control.find('input[type="checkbox"]');
		var $hiddenInput = $control.find('input[type="hidden"]');
		
		// Handle checkbox changes
		$checkboxes.on('change', function() {
			updateCheckboxMultipleValues($control, $hiddenInput);
		});
		
		// Initialize values
		updateCheckboxMultipleValues($control, $hiddenInput);
	});
	
	/**
	 * Update sortable list values
	 */
	function updateSortableListValues($control) {
		var $list = $control.find('.sortable-list');
		var $input = $control.find('input[type="hidden"]');
		var items = [];
		
		// Get checked values in correct order
		$list.find('input[type="checkbox"]:checked').each(function() {
			var value = $(this).val();
			var label = $(this).siblings('label').text().trim();
			
			// Get link for this item
			var $linkInput = $(this).closest('.sortable-list-item').find('.sortable-list-item-link');
			var link = $linkInput.length ? $linkInput.val() : '';
			
			items.push({
				key: value,
				label: label,
				url: link
			});
		});
		
		// Update hidden input with items data
		var itemsJson = JSON.stringify(items);
		$input.val(itemsJson).trigger('change');
		
		// Also update the data attribute for compatibility
		$input.attr('data-customize-setting-link', $input.attr('name'));
		
		// Trigger change event for compatibility
		$input.trigger('change');
	}
	
	/**
	 * Update checkbox multiple values
	 */
	function updateCheckboxMultipleValues($control, $hiddenInput) {
		var values = [];

		// Get checked values with labels
		$control.find('input[type="checkbox"]:checked').each(function() {
			values.push({
				key: $(this).val(),
				label: $(this).data('label')
			});
		});
		
		// Update hidden input with values as JSON
		var valuesJson = JSON.stringify(values);
		$hiddenInput.val(valuesJson).trigger('change');
	}
});