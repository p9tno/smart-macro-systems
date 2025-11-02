jQuery(document).ready(function($) {
    // Функция для обновления доступных опций
    function updateSelectOptions() {
        var selectedValues = [];
        
        // Собираем все выбранные значения
        $('select[name*="section_name"]').each(function() {
            var value = $(this).val();
            if (value) {
                selectedValues.push(value);
            }
        });
        
        // Обновляем опции для каждого select
        $('select[name*="section_name"]').each(function() {
            var currentValue = $(this).val();
            $(this).find('option').each(function() {
                var optionValue = $(this).val();
                if (optionValue && optionValue !== currentValue && selectedValues.includes(optionValue)) {
                    $(this).prop('disabled', true).hide();
                } else {
                    $(this).prop('disabled', false).show();
                }
            });
        });
    }
    
    // Обработчик изменения select
    $(document).on('change', 'select[name*="section_name"]', function() {
        updateSelectOptions();
    });
    
    // Обработчик для повторяющихся полей (если они добавляются динамически)
    $(document).on('scf-added-repeatable-group', function() {
        setTimeout(updateSelectOptions, 100);
    });
    
    // Обработчик для удаления повторяющихся полей
    $(document).on('scf-removed-repeatable-group', function() {
        setTimeout(updateSelectOptions, 100);
    });
    
    // Обработчик сортировки (перетаскивания)
    $(document).on('scf-sorted-repeatable-group', function() {
        setTimeout(updateSelectOptions, 100);
    });
    
    // Инициализация при загрузке
    updateSelectOptions();
});