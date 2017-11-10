$(document).ready(function() {
    $('#get-result-button').click(function() {
        var table= $('#table-select').val();

        var field = $('#filter-field').val();
        var value = $('#filter-value').val();

        $.get("load_info.php",
            {
                table: table,
                field: field,
                value: value,
                dataType: "json"
            }
            ).done(function(data) {
                if (data.error !== undefined & data.error !== "") {
                    alert('Error '+data.error);
                } else {
                    page_data = data;
                    processing_data(data);
                    create_field_filter_list(data);
                }
            })
            .fail(function() {
                alert("Failed");
            });
    });
});

function processing_data(data) {
    if ($('#table-container').length > 0) {
        $('#table-container').remove();
    }

    if (data.noresult !== undefined) {
        $('#content').append("<div class='row'>"+data.noresult+"</div>");
        return;
    }

    $('#content').append("<div class='row' id='table-container'><table id='result-table' class='table table-striped table-bordered'></table></div>");

    thead_columns = "";
    keys = [];
    for (key in data.rows[0]) {
        thead_columns += '<th>'+key.toUpperCase()+'</th>';
        keys.push(key);
    }

    $('#result-table').append('<tr>'+thead_columns+'</tr>');

    $(data.rows).each( function(index) {
        process_values = data.rows[index.toString()];
        row = "";
        for (i=0;i<keys.length;i++) {
            row += '<td>'+process_values[keys[i]]+'</td>';
        }
        $('#result-table').append('<tr>'+row+'</tr>');
    });

    if ($('#json-export').length > 0) {
        $('#json-export').parent('div').remove();
    }

    current_date = new Date();
    current_table = $('#table-select').val();
    json_export_conf(JSON.stringify(data, null, 4), current_table+"_"+current_date.getDay()+"_"+current_date.getMonth()+"_"+current_date.getFullYear()+'.json', 'text/plain');
}

function create_field_filter_list(data) {
    var fields = data.fields;
    if ($(fields).length > 0) {
        $('#filter-field').attr('list', 'fields-list');
        var datalist = "<datalist id='fields-list'></datalist>";
        $(datalist).insertAfter('#filter-field');

        $(fields).each(function(index, el) {
            $('#fields-list').append("<option value='"+el+"'>"+el+"</option>");
        });
    }
}

function json_export_conf(text, name, type) {
    var file = new Blob([text], {type: type});
    $("<div class='row text-center'><a id='json-export' href='"+URL.createObjectURL(file)+"' target='_blank' download='"+name+"'>EXPORT TO JSON</a></div>").insertAfter('#table-container');
}
