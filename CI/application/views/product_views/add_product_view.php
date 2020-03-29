<!DOCTYPE html>
<html>
<head>
    <?php include 'header_files.php' ?>
    <title>Green Grapez</title>
</head>
<body>
    <?php include 'left_navbar.php' ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="container">
                <div class="white-box">
                    <h1>Product Configration</h1>
                    <p class="text-muted m-b-30"> These fields are mandatory <span style="color: red">*</span></p>
                    <p class="text-muted m-b-30">
                        <span style="color: green"><?php echo $this->session->flashdata('success');?></span>
                    </p>
                    <form data-toggle="validator" method="post" action="<?php echo base_url('/index.php/product/save')?>">
                        <div class="form-group">
                            <label for="inputName1" class="control-label">Product Name <span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="inputName1" name="prod_name" placeholder="Enter product name" required>
                        </div>
                        <div class="form-group">
                            <label for="inputName1" class="control-label">Unit Price <span style="color: red">*</span></label>
                            <input type="number" class="form-control" name="unit_price" id="inputName1" placeholder="Enter unit price" required>
                        </div>
                        <div class="form-group">
                            <label for="inputName1" class="control-label">Product Category <span style="color: red">*</span></label>
                            <input type="text" class="form-control" name="prod_cat" id="inputName1" placeholder="Enter catagory" required>
                        </div>
                        <div class="form-group">
                            <label for="textarea" class="control-label">Product Description <span style="color: red">*</span></label>
                            <textarea id="textarea" rows="7" name="prod_desc" placeholder="Give product description"  class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>
    <!-- /.row -->
    <?php include 'footer_files.php' ?>
</body>
</html>