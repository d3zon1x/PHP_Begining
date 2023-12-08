<?php global $pdo; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
<?php include("_header.php")?>
<?php include("config/connection_db.php")?>

    <h1 class="text-center mt-5">Catalog</h1>
    <?php
        $n = 2;
        $list = array();
        $list[0] = [
            "id" => 1,
            "name"=> "iPhone 14 Pro Max 1TB Deep Purple",
            "image"=> "img/284924197.webp"
        ];
        $list[1] = [
            "id" => 2,
            "name"=> "Samsung Galaxy S23 Ultra 12/1TB Phantom Black",
            "image"=> "img/333315765.webp"
    ];
    ?>
    <table class="table mt-4">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Photo</th>
            <th scope="col">Name</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Select query
        $sql = "SELECT Id, Name, Photo, Describtion FROM tbl_product";
        $stmt = $pdo->query($sql);

        // Fetch the results
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Output the results
        foreach ($results as $row) {  ?>
        <tr>
            <th scope="row"><?php echo $row["Id"]; ?></th>
            <td><img src="/img/<?php echo $row["Photo"];?>" alt="photo" height="200"></td>
            <td class=""><?php echo $row["Name"]; ?></td>
            <td class=""><?php echo $row["Describtion"]; ?></td>
            <td>
                <a href="#" class="btn btn-info">View</a>
            </td>
            <td>
                <a href="#" data-delete="<?php echo $row["Id"] ?>" class="btn btn-danger">Delete</a>
            </td>
        </tr>
            <?php  } ?>
        </tbody>
    </table>
</div>

<div class="modal" tabindex="-1" role="dialog" id="modalDelete">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>You sure you want to delete this product?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="btnDeleteConfirm" class="btn btn-danger">Delete</button>
                <!-- Additional buttons if needed -->
            </div>
        </div>
    </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/axios.min.js"></script>
<script>
    let id  = 0;
    const list = document.querySelectorAll('[data-delete]');
    //console.log("List elements", list);
    // Convert NodeList to an array (optional)
    var myModal = new bootstrap.Modal(document.getElementById('modalDelete'));
    const elementsArray = Array.from(list);
    // Log the elements or perform further operations
    elementsArray.forEach(item => {
        item.addEventListener("click", (e) => {
            e.preventDefault();
            id=e.target.dataset.delete;
            myModal.show();
            //axios.post("");
            // console.log("delete item", id);
            // e.target.closest("tr").remove();
        });
        //console.log("item", item);
    });
    document.getElementById("btnDeleteConfirm").addEventListener("click", ()=>{
        console.log("Id for delete: ", id);
        myModel.hide();
    })
</script>
</body>
</html>