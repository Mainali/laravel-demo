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
    <div class="row main col-md-12">
        <h5>Add Product</h5>
        <div class="form-control col-md-6">

            <form id="product_add" align="center">
                <div class="form-group">
                    <label for="name" class="cols-sm-2 control-label">Product Name</label>
                    <div class="cols-sm-4">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-product fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="product_name" id="name"  placeholder="Enter Product Name"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="cols-sm-2 control-label">Quantity in stock</label>
                    <div class="cols-sm-4">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-count fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="quantity_in_stock"  placeholder="Enter Quantity"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="username" class="cols-sm-2 control-label">Price per item</label>
                    <div class="cols-md-4">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-dollar fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="price_per_item"  placeholder="Enter Price "/>
                        </div>
                    </div>
                </div>

                <div class="form-group ">
                    <div class="cols-sm-4">
                    <button type="submit"  class="btn btn-primary btn-lg btn-block login-button">Add</button>
                    </div>
                </div>

            </form>
        </div>

        <div class="row col-md-12 ">
            <div class="col-md-12">
                        <table class="table" id="product_table">
                            <thead class="text-primary">
                            <tr>
                                <th>Product name</th>
                                <th>Quantity</th>
                                <th>Price per unit</th>
                            </tr>

                            </thead>
                            <tbody id="mydata">

                            </tbody>
                        </table>

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

    $(document).ready(function() {
        $.ajax({
            url: "{{route('products.index')}}",
            type: 'get',
            dataType: 'json',
            success: function (data) {
                $.each(data, function (k,v) {
                    $("#mydata").append("<tr><td>"+v.product_name+"</td><td>"+v.quantity_in_stock+"</td><td>"+v.price_per_item+"</td></tr>");
                });
                console.log(data);
            }

        });
    });

    $("form#product_add").submit(function () {
        event.preventDefault();
        var data = $("#product_add").serializeArray();
        var jdata = {};
        for (var i = 0; i < data.length; i++) jdata[data[i].name] = data[i].value;
        this.reset();
        console.log( JSON.stringify(jdata) );

        $.ajax({
            url: "{{route('products.store')}}",
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            },
            type: 'post',
            dataType: 'json',
            success: function (data) {
                var row = "";
                    row +="<tr>";
                    row +="<td>"+data.product_name+"</td>";
                    row +="<td>"+data.quantity_in_stock+"</td>";
                    row +="<td>"+data.price_per_item+"</td>";
                    row +="</tr>";

                $('#mydata').append(row);
                console.log(data);
            },
            error: function (xhr) {
                if(xhr.status==422)
                    $.each(JSON.parse(xhr.responseText), function (k, v) {
                        console.log(v[0]);
                    });
                
            },
            data: jdata
        });

        return false;
    });




</script>


</body>
</html>


