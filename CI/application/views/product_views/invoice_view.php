<!DOCTYPE html>
<html>
<head>
    <!-- including header files -->
    <?php include 'header_files.php' ?>
    <title>Green Grapez</title>
</head>
<body>
    <!-- including left navbar -->
    <?php include 'left_navbar.php' ?>
    <div class="row">
        <div class="container">
            <div class="white-box">
                <h1>Invoices</h1>
                <p class="text-muted m-b-30">
                    <strong style="color: green"><?php echo $this->session->flashdata('success');?></strong>
                </p>
                <h5 class="m-t-30 m-b-10">Select product to enter in invoice</h5>
                <select class="selectpicker" data-style="form-control" id="prod_select">
                    <option>-- Select Product --</option>
                    <?php foreach ($products as $product) {?>
                        <option value="<?=$product->id?>"><?=$product->name?></option>
                    <?php } ?>
                </select>
                <h3><b>INVOICE</b> <span class="pull-right">Green Grapez</span></h3>
                <hr>
                <form data-toggle="validator" method="post" action="<?php echo base_url('/index.php/product/save_invoice')?>">
                    <div class="table-responsive m-t-40" style="clear: both;">
                        <table class="table table-hover" id="invoice_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Code</th>
                                    <th>Product Name</th>
                                    <th>Unit Price(Rs)</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="invoice_body">
                            </tbody>
                        </table>
                    </div>
                    <h4>
                        <b>Total (Rs) :</b>
                        <input type="number" name="amount" id="amount" value="">
                    </h4>
                    <button class="btn btn-danger fa fa-save" type="submit"> Save </button>
                </form>
            </div>
        </div>
    </div>
    
    <!-- including footer file -->
    <?php include 'footer_files.php' ?>

    <!-- Page specific javascript -->
    <script>
        $("#prod_select").change(function(){
            let id = $(this).val();
            $.ajax({
                url: '<?php echo base_url('/index.php/product/get_product'); ?>',
                type: 'POST',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    if(data){
                        console.log(data);
                        append_invoice_table(data);
                    }
                },
                error:function(data){
                    alert("Something went wrong. Please try again later.");
                    location.reload();
                }
            });
        });

        function append_invoice_table(data){
            var totalRows = $("#invoice_body tr").length;
            totalRows = totalRows + 1;
            var row = '<tr>';
                    row += '<td><input style="padding:3px;" type="number" name="count" id="count" value="'+totalRows+'"></td>';
                    row += '<td><input style="padding:3px;" type="number" name="codes[]" id="codes" value="'+data.id+'"></td>';
                    row += '<td><input style="padding:3px;" type="text" name="names[]" id="name" value="'+data.name+'"></td>';
                    row += '<td><input style="padding:3px;" type="number" name="price[]" id="price" value="'+data.price+'"></td>';
                    row += '<td><input style="padding:5px;" type="number" name="total[]" id="total" value="'+data.price+'""></td>';
                row += '</tr>';
            $('#invoice_body').append(row);

            let amount = $('#amount').val();
            amount = +amount + +data.price;
            $('#amount').val(amount) // Set the value to the amount
        }
    </script>
</body>
</html>