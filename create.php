<!DOCTYPE html>
<html>
<head>
    <title>Form Pendaftaran Peserta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php
    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $title=input($_POST["title"]);
        $slug=input($_POST["slug"]);
        $content=input($_POST["content"]);
        $image = isset($_POST["image"]) ? input($_POST["image"]) : '';
        $hits=input($_POST["hits"]);
        $aktif = isset($_POST['aktif']) ? $_POST['aktif'] : 'Y';
        $status = isset($_POST['status']) ? $_POST['status'] : 'publish';

        $sql = "INSERT INTO tbl_posts (title, slug, content, image, hits, aktif, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $kon->prepare($sql);
        $stmt->bind_param("ssssiss", $title, $slug, $content, $image, $hits, $aktif, $status);

        if ($stmt->execute()) {
            header("Location:index.php");
        } else {
            echo "Error: " . $stmt->error;
            
        }
        $stmt->close();

    }
    ?>
    <h2>Input Data</h2>


    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="form-group">
            <label>Title:</label>
            <input type="text" name="title" class="form-control" placeholder="Masukan Title" required />
        </div>
        <div class="form-group">
            <label>Slug:</label>
            <input type="text" name="slug" class="form-control" placeholder="Masukan Slug" required/>
        </div>
       <div class="form-group">
            <label>content:</label>
            <input type="text" name="content" class="form-control" placeholder="Masukan Konten" required/>
        </div>
        <div class="form-group">
            <label>Image:</label>
            <input type="text" name="image" class="form-control" placeholder="Masukan Gambar" required/>
        </div>
        <div class="form-group">
            <label>hits:</label>
            <input type="text" name="hits" class="form-control" placeholder="Masukan Hits" required/>
        </div>
        <div class="form-group">
            <label>Aktif:</label>
            <select name="aktif" class="form-control">
                <option value="Y" selected>Ya</option>
                <option value="N">Tidak</option>
            </select>
        </div>
        <div class="form-group">
            <label>Status:</label>
            <select name="status" class="form-control">
                <option value="publish" selected>Publish</option>
                <option value="draft">Draft</option>
            </select>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
