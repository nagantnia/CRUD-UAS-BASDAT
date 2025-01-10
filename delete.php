<?php
include "koneksi.php";  // Include your database connection

// Check if 'id' is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];  // Get the id from the URL

    // Prepare a delete statement
    $stmt = $kon->prepare("DELETE FROM tbl_posts WHERE id = ?");
    $stmt->bind_param("i", $id);  // 'i' indicates the type of the parameter is integer

    // Execute the statement
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
        resetIDs($kon);  // Call the function to reset IDs
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
} else {
    echo "ID not provided.";
}

// Redirect to the index page
header("Location: index.php");
exit();

function resetIDs($kon) {
    // Get all data, ordered by ID
    $result = mysqli_query($kon, "SELECT id FROM tbl_posts ORDER BY id ASC");
    $ids = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Reset IDs
    $newID = 1;
    foreach ($ids as $row) {
        $currentID = $row['id'];
        if ($currentID != $newID) {
            mysqli_query($kon, "UPDATE tbl_posts SET id = $newID WHERE id = $currentID");
        }
        $newID++;
    }

    // Reset AUTO_INCREMENT
    mysqli_query($kon, "ALTER TABLE tbl_posts AUTO_INCREMENT = $newID");
}
?>
