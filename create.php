<?php
global $pdo;
if($_SERVER["REQUEST_METHOD"]=="POST") {
    include $_SERVER['DOCUMENT_ROOT'] . "/config/connection_db.php";
    $name=$_POST["name"];
    $image_name="";
    if(isset($_FILES["krot_image"])) {
        $dir = "img";
        $image_name = uniqid().".".pathinfo($_FILES["krot_image"]["name"], PATHINFO_EXTENSION);
        $dir_save = $_SERVER["DOCUMENT_ROOT"]."/".$dir."/".$image_name;
        move_uploaded_file($_FILES["krot_image"]["tmp_name"], $dir_save);

    }
    $description=$_POST["description"];
    //echo "$name $image $description\n";
    // Insert query
    $sql = "INSERT INTO tbl_product (Name, Photo, Describtion) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    // Execute the query with the data
    $stmt->execute([$name, $image_name, $description]);
    header("Location: /");
    exit;
}

?>

<!doctype html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Додати</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/site.css">
</head>
<body>
<div class="container py-3">
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . "/_header.php";
    ?>

    <h1 class="text-center mt-5">Add product</h1>

    <form class="col-md-6 offset-md-3" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="name" >
        </div>


        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="description""></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Photo</label>
            <input type="file" class="form-control" name="krot_image" id="image" onchange="displayPhoto()">
        </div>
        <img id="previewImage" src="#" alt="Preview" style="display: none; max-width: 100%;">
        <button type="submit" class="btn btn-primary">Додати</button>
    </form>

</div>
<script src="/js/bootstrap.bundle.min.js"></script>
<script>
    function displayPhoto() {
        var input = document.getElementById('image');
        var preview = document.getElementById('previewImage');

        if (input.files && input.files[0]) {
            var reader = new FileReader();


            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
</body>
</html>