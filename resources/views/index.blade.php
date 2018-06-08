<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Coalition Laravel Test</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <style>
    .my-card{
        padding:15px; margin-top:25px;
    }
</style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Laravel Test</a> <button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarSupportedContent" data-toggle="collapse" type="button"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="card my-card">
            <h3>Submit a product</h3>
            <hr>
            <div class="alert alert-primary" role="alert">
                Please provide the required information.
            </div>
            <div class="row">
                <div class="col-md-7">
                    <label for="product-name">Product Name</label> <input class="form-control" id="product-name" type="text">
                </div>
                <div class="col-md-3">
                    <label for="product-quantity">Quantity in stock</label> <input class="form-control" id="product-quantity" type="text" value="0">
                </div>
                <div class="col-md-2">
                    <label for="product-price">Price per item</label> <input class="form-control" id="product-price" type="text">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button id="submit-product" class="btn btn-primary mt-3">Submit</button>
                </div>
            </div>
        </div>
        <div class="card mt-5 my-card">
            <h4>Products</h4>
            <hr>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">Product Name</th>
                  <th scope="col">Quantity in stock</th>
                  <th scope="col">Price per item</th>
                  <th scope="col">Date/time submitted</th>
                  <th scope="col">Total value</th>
              </tr>
          </thead>
          <tbody id="products">
            <tr>
                <td>Field 1</td>
                <td>Field 2</td>
                <td>Field 3</td>
                <td>Field 4</td>
                <td>Field 5</td>
            </tr>
            <tr>
              <td>Total</td><td><b>// sigma total value</b></td>
          </tr>
      </tbody>
  </table>
</div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        getProducts();
        function getProducts(){
            $.ajax({
                type:'get',
                url: 'products',
                success: function(data){
                   let products = data.products;
                   console.log(products);
                   let html = "";
                   for(let i = 0; i < products.length; i++){
                    console.log("hey");
                    html += `<tr>
                    <td>${products[i].name}</td>
                    <td>${products[i].qty}</td>
                    <td>${products[i].price}</td>
                    <td>2018</td>
                    <td>${(Number(products[i].qty) * parseFloat(products[i].price))}</td>
                    </tr>`;
                    console.log(html);
                }
                $("#products").html(html);
            }
        })
        }

        $("#submit-product").click(function(){

            let product = {
                name: $("#product-name").val(),
                qty: $("#product-quantity").val(),
                price: $("#product-price").val()
            };

            $.ajax({
                type: 'post',
                url: 'store',
                data: {
                    product,
                    _token: "{{ csrf_token() }}",
                },

                success: function(data){
                   getProducts();
               },
               error: function(data){
                console.log("Something went wrong, see below:");
                console.log(data);
            }
        });
        });

    });
</script>
</html>