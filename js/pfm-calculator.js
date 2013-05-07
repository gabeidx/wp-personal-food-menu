// Global namespace
var PFM = PFM || {}

;(function($, window, undefined){

    $(document)
    // Calculator
    .on('keypress change', '.pfm-select, input[data-pfm-col="quantity"]', function(e) {
        var scope = $(this).parent().parent(),
            index = scope.find('select.pfm-select').val(),
            quantity = scope.find('input[data-pfm-col="quantity"]').val() / 100,
            carbs = parseFloat(PFM.foods[index].carbohydrates.replace(',', '.')),
            lipids = parseFloat(PFM.foods[index].lipids.replace(',', '.')),
            kcal = parseFloat(PFM.foods[index].energy_kcal.replace(',', '.')),
            food = PFM.foods[index];

        scope.find('input[data-pfm-col="carbohydrates"]').val(carbs * quantity);
        scope.find('input[data-pfm-col="lipids"]').val(lipids * quantity);
        scope.find('input[data-pfm-col="energy_kcal"]').val(kcal * quantity);
    })
    // Add button
    .on('click', '.pfm-add-row', function(e){
        e.preventDefault();
        var scope = $(this).parent().parent().parent().parent(),
            row = scope.find('.pfm-row:last').clone()

        row.find('input:not(.pfm-quantity-input)').val('0')

        scope.find('tbody').append(row);
    });

})(jQuery, this);