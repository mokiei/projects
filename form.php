<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    
</body>
</html>
<!-- Save button-->
 <?php
 $con = mysqli_connect("localhost", "root", "", "phptutorials");
 if ($_SERVER["REQUEST_METHOD"] == "POST"){
 if(isset($_POST['save-button'])){
     //if(! empty($_POST['sku']) && ! empty($_POST['name']) && ! empty($_POST['price']) && ! empty($_POST['type']) && !($_POST['attribute']))
     $type = intval($_POST['input_type']);
     if (in_array([1,2,3]))
     {
        
       
       
        $sku = filter_var ($_POST['input_sku'], FILTER_SANITIZE_STRING);
        $name = filter_var ($_POST['input_name'], FILTER_SANITIZE_STRING);
        $price = filter_var ($_POST['input_price'], FILTER_SANITIZE_STRING);
        $type = filter_var ($_POST['input_type'], FILTER_SANITIZE_STRING);
        $attribute = filter_var ($_POST['input_attribute'], FILTER_SANITIZE_STRING);
        

        $query = "INSERT INTO products ('sku', 'name', 'price', 'type', 'attribute') VALUES ('$sku', '$name', '$price', $type', '$attribute')";
        $run = mysqli_query($con, $query);
     }
     
 }
}

?>
<div class="container p-7">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-body">
                <!--INPUT FORM
                it will contains the form to add new product to the database:
                Fields: SKU / NAME / PRICE / PROD_TYPE / DVD / BOOK / FUR_H / FUR_W / FUR_L -->
                <style>
                    select {
                        width: 20%;
                        padding: 5px;
                        border-radius:10px;
}
    input[type=text] {
                        width: 20%;
                        padding: 5px;
                        border-radius:10px;
}

                </style>
                <h1>Product Add</h1>
    <form action="form.php" method="POST">
    <button type="submit" name="save-button" <?php echo $type; ?>>SAVE</button>
    <button type="submit" id="delete-product-button">CANCEL</button>
    <hr>
  
    
                    <div class="form-group">
                        SKU <input type="text" name="sku" class="form-control" placeholder="Enter SKU Code">
                        <br><br>
                        Name <input type="text" name="name" class="form-control" placeholder="Enter Product Name">
                        <br><br>
                        Price <input type="text" name="price" class="form-control" placeholder="Enter Price">
                        <br><br>
                        <label id="productType">Type Switcher</label>
                    
                        <select id="prod_type" name="prod_type" class="form-control" >
                            <option value="1">DVD</option>
                            <option value="2">BOOK</option>
                            <option value="3">FURNITURE</option>
                        </select>

    <br>

    <script>
  function toggleFields() {
    var productType = document.getElementById('prod_type').value;
    var fields = document.querySelectorAll('[data-if-prod-type]');
    
    fields.forEach(function (field) {
        if (field.dataset.ifProdType === productType) {
            field.style.display = '';
        } else {
            field.style.display = 'none';
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('prod_type').addEventListener('change', toggleFields);
    
    // Run the toggle function when the DOM is ready loading,
    // so that fields that are not relevant to #prod_type's
    // initial value are hidden.
    toggleFields();
});
</script>
<script>
    $(document).ready(() => {
    $('#type').change(function() {
        switch (this.value) {
            case '1':
                $('#attributes').html(`
                <input type="text" name="dvdsize" class="form-control" placeholder="Enter DVD Size" data-if-prod-type="1">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                        It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. 
                        It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
                        and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    </p>
                `);
                break;
            case '2':
                $('#attributes').html(`
                    <label for="weight">Weight</label>
                    <input type="number" step="0.01" class="form-control" name="weight" required>
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                        It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. 
                        It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
                        and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    </p>
                `);
                break;

            case '3':
                $('#attributes').html(`
                    <label for="height">Height</label>
                    <input type="number" step="0.01" class="form-control" name="height" required>
                    <label for="width">Width</label>
                    <input type="number" step="0.01" class="form-control" name="width" required>
                    <label for="length">Length</label>
                    <input type="number" step="0.01" class="form-control" name="length" required>
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                        It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. 
                        It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
                        and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    </p>
                `);
                break;
        }
    });

    $('form').submit(function(e) 
    {
        e.preventDefault();

        let inputs = {};
        $(this).find(':input').each(function() {
            inputs[$(this).attr("name")] = $(this).val();
        });

        $.post('/products/add', inputs, function(data, status) {
            $('#message').show().removeClass('alert-success alert-danger').addClass(`alert-${data.status}`).html(data.message);
        });
    });
});
</script>
                        <!-- <hr/> -->
                        <!-- if the select(prod_type) option = DVD, then show the following fields:
                        Fields: DVD_SIZE
                        if the select(prod_type) option = BOOK, then show the following fields:
                        Fields: BOOK_WEIGHT
                        if the select(prod_type) option = FUR, then show the following fields:
                        Fields: FUR_H / FUR_W / FUR_L? -->
                        
                       
                        <!-- <hr/>     -->
                        <br>
                        <br>
           <!-- Printsout error message    -->              
<?php
$dvdsize = '';
$bookweight = '';
$furh = '';

if (empty($dvdsize)) { 
    $errordvdsize= '<div class="isa_error">Please,provide size in MB</div>'; 
} 
if (empty($bookweight)) { 
    $errorbookweight = '<div class="isa_error">Please, provide weight in KG</div>'; 
} 
if (empty($furh)) { 
    $errorfurh = '<div class="isa_error">Please provide dimensions</div>'; 
} 
        
?>

<?php if(isset($errordvdsize)) { echo $errordvdsize; } ?><input type="text" name="dvdsize" class="form-control" placeholder="Enter DVD Size" id ="attributes" data-if-prod-type="1">

<?php if(isset($errorbookweight)) { echo $errorbookweight; } ?>        <input type="text" name="bookweight" class="form-control" placeholder="Enter Book Weight"  id ="attributes" data-if-prod-type="2">
                            
<div id ="attributes" data-if-prod-type="3">
    <br>
    <br>
    <?php if(isset($errorfurh)) { echo $errorfurh; } ?>   <input type="text" name="furh" class="form-control" placeholder="Enter Furniture Height">
    <br>
    <br>
    <input type="text" name="furw" class="form-control" placeholder="Enter Furniture Width">
    <br>
    <br>
    <input type="text" name="furl" class="form-control" placeholder="Enter Furniture Length">
  
</div>
                        </div>

            
              </form>
            </div>
        </div>

        <div class="col-md-8">
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <!-- Insert form value into database -->
           
        
            

            <hr>
        <footer>
        <p>Scandiweb Test Assignment</p>
</footer>
        </div>
    </div>
                    </div>
                    