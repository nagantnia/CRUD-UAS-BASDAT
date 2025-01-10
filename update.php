<!DOCTYPE html>
<html>
<head>
    <title>Form Pendaftaran Anggota</title>
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
    //Cek apakah ada nilai yang dikirim menggunakan methos GET dengan nama id
    if (isset($_GET['id'])) {
        $id=input($_GET["id"]);

        $sql="select * from tbl_posts where id=$id";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_assoc($hasil);

    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $aktif = isset($_POST['aktif']) ? $_POST['aktif'] : 'Y';
        $status = isset($_POST['status']) ? $_POST['status'] : 'publish';

        $stmt = $kon->prepare("UPDATE tbl_posts SET title=?, slug=?, content=?, image=?, hits=?, aktif=?, status=? WHERE id=?");
        $stmt->bind_param("ssssissi", $title, $slug, $content, $image, $hits, $aktif, $status, $id);

        $title = input($_POST["title"]);
        $slug = input($_POST["slug"]);
        $content = input($_POST["content"]);
        $image = input($_POST["image"]);
        $hits = input($_POST["hits"]);
        $id = input($_POST["id"]);

        if ($stmt->execute()) {
            header("Location:index.php");
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan: " . $stmt->error . "</div>";
        }
        $stmt->close();

    }

    ?>
    <h2>Update Data</h2>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <div class="form-group">
            <label>Title:</label>
            <input type="text" name="title" class="form-control" placeholder="Masukan Title" required />
        </div>
        <div class="form-group">
            <label>Slug:</label>
            <input type="text" name="slug" class="form-control" placeholder="Masukan Slug" required/>
        </div>
        <div class="form-group">
            <label>Content:</label>
            <textarea name="content" class="form-control" rows="5" placeholder="Masukan Content" required></textarea>
        </div>
        <div class="form-group">
            <label>Image:</label>
            <input type="text" name="image" class="form-control" placeholder="Masukan Image" required/>
        </div>
        <div class="form-group">
            <label>Hits:</label>
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
