<!DOCTYPE html>
<html>
<head>
    <?php include 'header_files.php' ?>
    <title>Green Grapez</title>
</head>
<body>
    <?php include 'left_navbar.php' ?>
    <!-- /row -->
<div class="row">
    <div class="col-sm-12">
        <div class="container">
            <div class="white-box">
                <h1>All Products</h1>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price per unit(Rs)</th>
                                <th>Catagory</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product) { ?>
                                <tr>
                                    <td><?= $product->name?></td>
                                    <td><?= $product->price?></td>
                                    <td><?= $product->catagory?></td>
                                    <td>
                                        <a href="<?php echo base_url('/index.php/product/edit/'.$product->id)?>" type="button"><i class="fa fa-edit"></i></a>
                                        <a href="" onclick="ajax_delete('<?=$product->id?>')" type="button"><i class="fa fa-trash" style="color: red"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
    <!-- /.row -->
    <?php include 'footer_files.php' ?>
    <script>
    function ajax_delete(id){
        confirm('Are you sure you want to delete this product ?');
        if(confirm){
            //send an ajax call to delete product
            $.ajax({
                url: '<?php echo base_url('/index.php/product/delete'); ?>',
                type: 'POST',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    if(data){
                        alert("delete");
                        location.reload();
                    }
                },
                error:function(data){
                    alert("Something went wrong. Please try again later.");
                    location.reload();
                }
            });
        }
    }    

    $(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
    });
    $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
    </script>
</body>
</html>