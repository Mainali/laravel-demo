<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Website CSS style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css" />

    <!-- Website Font style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

    <title>Admin</title>
</head>
<body>
<div class="container">
    <div class="row main">
        @yield('content')


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Products Table</h4>
                        <p class="category">Here is a subtitle for this table</p>
                    </div>
                    <div class="card-content table-responsive">
                        <table class="table" id="product_table">
                            <thead class="text-primary">
                            <th>Product Name</th>
                            <th>Product Quantity</th>

                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>


<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>



<script>

    $.ajax({
        url: "{{URL::to('/products/store')}}",
        data: {
            format: 'json'
        },
        error: function() {
            $('#info').html('<p>An error has occurred</p>');
        },
        dataType: 'jsonp',
        success: function(data) {
            var $title = $('<h1>').text(data.talks[0].talk_title);
            var $description = $('<p>').text(data.talks[0].talk_description);
            $('#info')
                .append($title)
                .append($description);
        },
        type: 'POST'
    });

    $('#product_add').submit(function() {
        // get all the inputs into an array.
        var $inputs = $('#myForm :input');
        $.ajax({
            url: "{{URL::to('/products/store')}}",
            data: {
                format: 'json'

            },
            error: function() {
                $('#info').html('<p>An error has occurred</p>');
            },
            dataType: 'jsonp',
            success: function(data) {
                var $title = $('<h1>').text(data.talks[0].talk_title);
                var $description = $('<p>').text(data.talks[0].talk_description);
                $('#info')
                    .append($title)
                    .append($description);
            },
            type: 'POST'
        });

    });

    $(document).ready(function() {
        $('#product_table').dataTable({
            "ajax": {
                "url": "{{URL::to('/products')}}",
                "type": "GET"
            }i
        });
    });


</script>
</body>
</html>


