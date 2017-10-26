<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resources monitoring | <?php echo $_GET['table'];?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/load_info.js"></script>

    <script>
        $(document).ready(function() {
            $('#filters-button').click( function(){
                $('#filters-div').slideToggle('fast');
            });
        });
    </script>
</head>
<body>
    <header>
        Resources Monitoring
    </header>

    <div id="content" class="container">
        <div class="row">
            <form id="select-form" class="col-sm-12">
                <div class="form-group" class="col-sm-6">
                    <label for="table-input">Table: </label>
                    <select id="table-select" name="table" class="form-control">
                        <option value="">Select an option</option>
                        <?php
                            include('tables_list.php');
                        ?>
                        <!--<option value="network">Network</option>
                        <option value="os">Operating System</option>
                        <option value="usb">Usb</option>
                        <option value="product">Product</option>-->
                    </select>
                </div>
                <hr />
                <div class="col-sm-12 text-center">
                    <button id="filters-button" type="button" class="btn btn-warning">+ FILTERS</button>
                </div>
                <div id="filters-div" style="display: none;" class="form-group" class="col-sm-6">
                    <label for="filter-field">Field:</label>
                    <input id='filter-field' class="form-control" name="field" placeholder="Field to filter" />
                    <label for="filter-value">Value:</label>
                    <input id='filter-value' class="form-control" name="value" placeholder="Value" />
                </div>
                <div style="margin-top: 20px;" class="col-sm-12 text-center">
                    <button type="button" class="btn btn-danger" id="get-result-button">GET RESULTS</button>
                </div>
            </form>
        </div>
        <hr />
    </div>

    <footer>
        Davide Tonin, <a href="https://www.github.com/DavideTonin99/resourcesmonitoring" target="_blank">View the project on Github</a>
    </footer>
</body>
</html>
