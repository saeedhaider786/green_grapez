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
                    <h1>Product Update
                    </h1>
                    <p class="text-muted m-b-30">
                        <strong style="color: green"><?php echo $this->session->flashdata('update');?></strong>
                    </p>
                    <?php if(isset($product_data)) { ?>
                        <form data-toggle="validator" method="post" action="<?php echo base_url('/index.php/product/update')?>"> 
                            <div class="form-group">
                                <label for="inputName1" class="control-label">Product Name <span style="color: red">*</span></label>
                                <input type="text" name="prod_name" value="<?=$product_data->name?>" class="form-control" id="inputName1" placeholder="Enter product name" required>
                            </div>
                            <div class="form-group">
                                <label for="inputName1" class="control-label">Unit Price <span style="color: red">*</span></label>
                                <input type="number" name="unit_price" value="<?=$product_data->price?>" class="form-control" id="inputName1" placeholder="Enter unit price" required>
                            </div>
                            <div class="form-group">
                                <label for="inputName1" class="control-label">Product Category <span style="color: red">*</span></label>
                                <input type="text" name="prod_cat" value="<?=$product_data->catagory?>" class="form-control" id="inputName1" placeholder="Enter catagory" required>
                            </div>
                            <div class="form-group">
                                <label for="textarea" class="control-label">Product Description <span style="color: red">*</span></label>
                                <textarea id="textarea" name="prod_desc" rows="7" placeholder="Give product description"  class="form-control" required><?=$product_data->description?></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    <?php } ?>
                </div>
        </div>
    </div>
</div>
    <!-- /.row -->
    <?php include 'footer_files.php' ?>
</body>
</html>