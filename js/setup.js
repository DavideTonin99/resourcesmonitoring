$(document).ready(function() {
    $('#filters-button').click( function(){
        $('#filters-div').slideToggle('fast');
    });

    var fields = $('th');
    if ($(fields).length > 0) {
        $('#filter-field').attr('list', 'fields-list');
        var datalist = "<datalist id='fields-list'></datalist>";
        $(datalist).insertAfter('#filter-field');

        $(fields).each(function(index, el) {
            $('#fields-list').append("<option value='"+$(el).text()+"'>"+$(el).text()+"</option>");
        });
    }
});
