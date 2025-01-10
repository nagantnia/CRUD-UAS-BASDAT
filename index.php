<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>

<body>

<div class="container">
    <br>
    <h4><center>DAFTAR POSTS</center></h4>
    <?php
    include "koneksi.php";
    $sql="SELECT * FROM tbl_posts ORDER BY id ASC";
    $hasil=mysqli_query($kon,$sql);
    ?>
    <table class="my-3 table table-bordered">
        <thead>
            <tr class="table-primary">
                <th>Id</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Content</th>
                <th>Image</th>
                <th>Hits</th>
                <th>Aktif</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th colspan='2'>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        while ($data = mysqli_fetch_array($hasil)) {
            ?>
            <tr>
                <td><?php echo htmlspecialchars($data["id"]); ?></td>
                <td><?php echo htmlspecialchars($data["title"]); ?></td>
                <td><?php echo htmlspecialchars($data["slug"]); ?></td>
                <td><?php echo htmlspecialchars($data["content"]); ?></td>
                <td><?php echo htmlspecialchars($data["image"]); ?></td>
                <td><?php echo htmlspecialchars($data["hits"]); ?></td>
                <td><?php echo htmlspecialchars($data["aktif"]); ?></td>
                <td><?php echo htmlspecialchars($data["status"]); ?></td>
                <td><?php echo date('d-m-Y H:i:s', strtotime($data["created_at"])); ?></td>
                <td><?php echo date('d-m-Y H:i:s', strtotime($data["updated_at"])); ?></td>
                <td>
                    <a href="update.php?id=<?php echo htmlspecialchars($data['id']); ?>" class="btn btn-warning" role="button">Update</a>
                    <a href="delete.php?id=<?php echo htmlspecialchars($data['id']); ?>" class="btn btn-danger" role="button" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Delete</a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <a href="create.php" class="btn btn-primary" role="button">Tambah Data</a>
</div>
</body>
</html>
