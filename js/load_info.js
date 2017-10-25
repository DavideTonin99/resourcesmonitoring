$(document).ready(function() {
    $('#get-result-button').on("click change", function() {
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
                    processing_data(data);
                }
            })
            .fail(function() {
                alert("Failed");
            });
    });
});

function processing_data(data) {
    console.log(data);
    if ($('#table-container').length > 0) {
        $('#table-container').remove();
    }
    $('#content').append("<div class='row' id='table-container'><table id='result-table' class='table table-striped table-bordered'></table></div>");
    
    if (data.fields !== undefined) {
        var table_row = "<tr>";
        $('#result-table').append("<tr>");
        $(data.fields).each( function(index, element){
            table_row += "<th>"+element+"</th>";
        });
        table_row += "</tr>"
        $('#result-table').append(table_row);
    }

    if (data.rows !== undefined) {
        $(data.rows).each( function(i, row) {
            var table_row = "<tr>";
            $(row).each( function(index, value) {
               table_row += "<td>"+value+"</td>";
            });
            table_row += "</tr>";
            $('#result-table').append(table_row);
        });
    }
}
