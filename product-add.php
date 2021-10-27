<?php include "template.php"; ?>
<title>Create New Product</title>
<h1 class='text-primary'>Create New Product</h1>

<?php
$query = $conn->query("SELECT DISTINCT category FROM products");
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <div class="container-fluid">
        <div class="row">
            <!--Product Details-->

            <div class="col-md-6">
                <h2>Product Details</h2>
                <p>Product Name<input type="text" name="prodName" class="form-control" required="required"></p>
                <p>Product Category
                    <select name="prodCategory">
                        <?php
                        while ($row = $query->fetchArray()) {
                            echo '<option>'.$row[0].'</option>';
                        }
                        ?>
                    </select>
                </p>

                <p>Quantity<input type="number" name="username" class="form-control" required="required"></p></p>
            </div>
            <div class="col-md-6">
                <h2>More Details</h2>
                <!--Product List-->
                <p>Price<input type="number" step="0.01" name="prodPrice" class="form-control" required="required"></p>
                <p>Product Code<input type="text" name="prodCode" class="form-control" required="required"></p>
                <p>Product Picture <input type="file" name="prodImage" class="form-control" required="required"></p>
            </div>
        </div>
    </div>
    <input type="submit" name="formSubmit" value="Submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
//    Customer Details
    $prodName = sanitise_data($_POST['prodName']);
    $prodCategory = sanitise_data($_POST['prodCategory']);
    $prodQuantity = sanitise_data($_POST['prodQuantity']);
    $prodPrice = sanitise_data($_POST['prodPrice']);
    $prodCode = sanitise_data($_POST['prodCode']);

//check if product exists.
    $query = $conn->query("SELECT COUNT(*) FROM products WHERE username='$prodCode'");
    $data = $query->fetchArray();
    $numberOfProducts = (int)$data[0];

    if ($numberOfProducts > 0) {
        echo "Sorry, product already taken";
    } else {
// Product Registration commences


//for the image table.
        $file = $_FILES['file'];

//Variable Names
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

//defining what type of file is allowed
// We seperate the file, and obtain the end.
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
//We ensure the end is allowable in our thing.
        $allowed = array('jpg', 'jpeg', 'png', 'pdf');

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                //File is smaller than yadda.
                if ($fileSize < 10000000000) {
                    //file name is now a unique ID based on time with IMG- precedding it, followed by the file type.
                    $fileNameNew = uniqid('IMG-', True) . "." . $fileActualExt;
                    //upload location
                    $fileDestination = 'images/profilePic/' . $fileNameNew;
                    //command to upload.
                    move_uploaded_file($fileTmpName, $fileDestination);
                    $sql = "INSERT INTO user (username, password, name, profilePic, accessLevel) VALUES (:newUsername, :newPassword, :newName, :newImage, :newAccessLevel)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindValue(':newUsername', $username);
                    $stmt->bindValue(':newPassword', $hashed_password);
                    $stmt->bindValue(':newName', $name);
                    $stmt->bindValue(':newImage', $fileNameNew);
                    $stmt->bindValue(':newAccessLevel', $accessLevel);
                    $stmt->execute();
                    header("location:index.php");
                } else {
                    echo "Your image is too big!";
                }
            } else {
                echo "there was an error uploading your image!";
            }
        } else {
            echo "You cannot upload files of this type!";
        }
    }
}

?>

</body>
</html>