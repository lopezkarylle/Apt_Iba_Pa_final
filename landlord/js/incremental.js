function incrementValue(e) {
    e.preventDefault();
    var fieldName = $(e.target).data('field');
    var parent = $(e.target).closest('div');
    var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);
    var propertyId = parent.find('#property-id').val(); 
    var unitId = parent.find('#unit-id').val();

    if (!isNaN(currentVal)) {
        parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
    } else {
        parent.find('input[name=' + fieldName + ']').val(0);
    }

    occupyUnit({
        property_id: propertyId,
        unit_id: unitId,
        available_units: currentVal + 1
    })
}

function decrementValue(e) {
    e.preventDefault();
    var fieldName = $(e.target).data('field');
    var parent = $(e.target).closest('div');
    var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);
    var propertyId = parent.find('#property-id').val(); 
    var unitId = parent.find('#unit-id').val(); 

    if (!isNaN(currentVal) && currentVal > 0) {
        parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
    } else {
        parent.find('input[name=' + fieldName + ']').val(0);
    }

    occupyUnit({
        property_id: propertyId,
        unit_id: unitId,
        available_units: currentVal - 1
    })
}

$('.input-group').on('click', '.button-plus', function(e) {
    incrementValue(e);
});

$('.input-group').on('click', '.button-minus', function(e) {
    decrementValue(e);
});

function occupyUnit(data){
    $.ajax({
        url: 'occupy',
        type: 'POST',
        data: data,
        success: function (response) {
        }
    });
}