@extends('master')

@section("content")

<div class="main-login main-center">
    <h5>Add Product</h5>
    {!!Form::open(['method'=>'POST','route'=>'product.create'])!!}

        <div class="form-group">
            <label for="name" class="cols-sm-2 control-label">Product Name</label>
            <div class="cols-sm-10">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="product_name" id="name"  placeholder="Enter Product Name"/>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="cols-sm-2 control-label">Quantity in stock</label>
            <div class="cols-sm-10">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="quantity_in_stock"  placeholder="Enter Quantity"/>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="username" class="cols-sm-2 control-label">Price per item</label>
            <div class="cols-sm-10">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="price_per_item"  placeholder="Enter Price "/>
                </div>
            </div>
        </div>




        <div class="form-group ">
            <button type="submit"  class="btn btn-primary btn-lg btn-block login-button">Add</button>
        </div>

    {!!Form::close() !!}
</div>


@stop