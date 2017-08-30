<html>
<head>
    <title>Product</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>

</head>
<body>

<div class="container">

    <div class="row">

        <div class="col-lg-8 col-lg-offset-2">

            <h1>Products</h1>

            <p class="lead">This is a demo app with Laravel PHP and AJAX.</p>

            <form id="product_add">

                <div class="messages"><span style="color:red" id="errormessage"></span></div>

                <div class="controls">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_name">Product name *</label>
                                <input id="form_name" type="text" name="name" class="form-control" placeholder="Please enter name of the product *" required="required" data-error="Product name is required.">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_quantity">Quantity *</label>
                                <input id="form_quantity" type="text" name="quantity" class="form-control" placeholder="Please enter quantity *" required="required" data-error="Quantity is required.">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_price">Price *</label>
                                <input id="form_price" type="number" name="price" class="form-control" placeholder="Please enter the price *" required="required" data-error="Valid number is required.">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="submit" class="btn btn-success btn-send" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-muted"><strong>*</strong> These fields are required.</p>
                        </div>
                    </div>
                </div>

            </form>

        </div>

    </div>
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <h1>List of Products</h1>
            <table class="table table-striped" id="product_table">
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

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <form id="product_add">

                    <div class="messages"><span style="color:red" id="errormessage"></span></div>

                    <div class="controls">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_name">Product name *</label>
                                    <input id="form_name" type="text" name="name" class="form-control" placeholder="Please enter name of the product *" required="required" data-error="Product name is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_quantity">Quantity *</label>
                                    <input id="form_quantity" type="text" name="quantity" class="form-control" placeholder="Please enter quantity *" required="required" data-error="Quantity is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_price">Price *</label>
                                    <input id="form_price" type="number" name="price" class="form-control" placeholder="Please enter the price *" required="required" data-error="Valid number is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-success btn-send" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-muted"><strong>*</strong> These fields are required.</p>
                            </div>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>




<script>

    $(document).ready(function() {
        loadTable();
    });

    function loadTable() {
        $.ajax({
            url: "{{route('products.index')}}",
            type: 'get',
            dataType: 'json',
            success: function (data) {
                $.each(data, function (k,v) {
                    $("#mydata").append("<tr><td>"+v.name+"</td><td>"+v.quantity+"</td><td>"+v.price+"</td>"+
                        "<td><button onclick='deleteData(this)' value='"+v.uid+"' ></td></tr> ");
                });
                console.log(data);
            }

        });
    }

    $("form#product_add").submit(function () {
        event.preventDefault();
        var data = $("#product_add").serializeArray();
        var jdata = {};
        for (var i = 0; i < data.length; i++) jdata[data[i].name] = data[i].value;
        //this.reset();
        console.log($("form#product_add").serialize());
        var frm = $("#product_add");
        console.log('sdf');
        $.ajax({
            url: "{{route('products.store')}}",
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            },
            type: 'post',
            //data: $("#product_add").serialize(),
            dataType: 'json',
            data: frm.serialize(),
            success: function (data) {

                $("#mydata").append("<tr><td>"+data.name+"</td><td>"+data.quantity+"</td><td>"+data.price+"</td>" +
                    "<td><button onclick='deleteData(this)' value='"+data.uid+"' ></td></tr> ");
                console.log(data);
            },
            error: function (xhr) {
                if(xhr.status==422)
                    $.each(JSON.parse(xhr.responseText), function (k, v) {
                        $('#errormessage').html(v[0]);
                    });
                else if(xhr.status==500)
                    $('#errormessage').html("error: "+xhr.responseText);

            }

        });

        return false;
    });


    function editData(buttondata) {
        $("#myModal").modal("show");
        $.ajax({
            url: "{{route('products.edit')}}",
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            },
            type: 'post',
            dataType: 'json',
            data: buttondata.value,
            success: function (data) {
                $("#mydata").html("");
                loadTable();
            },
            error: function (xhr) {
                    $('#errormessage').html("error: "+xhr.responseText);
            }
        });
    }


    function deleteData() {
        $.ajax({
            url: "{{route('products.edit')}}",
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            },
            type: 'post',
            dataType: 'json',
            data: buttondata.value,
            success: function (data) {
                console.log("aasd");
                $(buttondata).closest("tr").remove();
            },
            error: function (xhr) {
                $('#errormessage').html("error: "+xhr.responseText);

            }

        });
    }

</script>

</body>
</html>