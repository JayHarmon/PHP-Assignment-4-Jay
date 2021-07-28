<?php
session_start();

$conn = new SQLite3("db") or die ("unable to open database");

function createTable($sqlStmt, $tableName)
{
    global $conn;
    $stmt = $conn->prepare($sqlStmt);
    if ($stmt->execute()) {
        echo "<p style='color: green'>".$tableName. ": Table Created Successfully</p>";
    } else {
        echo "<p style='color: red'>".$tableName. ": Table Created Failure</p>";
    }
}
function addUser($username, $unhashedPassword, $name, $profilePic, $accessLevel) {
    global $conn;
    $hashedPassword = password_hash($unhashedPassword, PASSWORD_DEFAULT);
    $sqlstmt = $conn->prepare("INSERT INTO user (username, password, name, profilePic, accessLevel) VALUES (:userName, :hashedPassword, :name, :profilePic, :accessLevel)");
    $sqlstmt->bindValue(':userName', $username);
    $sqlstmt->bindValue(':hashedPassword', $hashedPassword);
    $sqlstmt->bindValue(':name', $name);
    $sqlstmt->bindValue(':profilePic', $profilePic);
    $sqlstmt->bindValue(':accessLevel', $accessLevel);
    if ($sqlstmt->execute()) {
        echo "<p style='color: green'>User: ".$username. ": Created Successfully</p>";
    } else {
        echo "<p style='color: red'>User: ".$username. ": Created Failure</p>";
    }
}


$query = file_get_contents("sql/create-user.sql");
createTable($query, "User");
$query = file_get_contents("sql/create-products.sql");
createTable($query, "products");

$query= $conn->query("SELECT COUNT(*) as count FROM user");
$rowCount = $query->fetchArray();
$userCount = $rowCount["count"];

if ($userCount == 0) {
    addUser("admin", "admin", "Administrator", "admin.jpg", "Administrator");
    addUser("user", "user", "User", "user.jpg", "User");
    addUser("ryan", "ryan", "Ryan", "ryan.jpg", "User");
}

function add_product($productName, $productCategory, $productQuantity, $productPrice, $productImage, $productCode) {
    global$conn;
    $sqlstmt = $conn->prepare("INSERT INTO products (productName, category, quantity, price, image, code) VALUES (:name, :category, :quantity, :price, :image, :code)");
    $sqlstmt->bindValue(':name', $productName);
    $sqlstmt->bindValue(':category', $productCategory);
    $sqlstmt->bindValue(':quantity', $productQuantity);
    $sqlstmt->bindValue(':price', $productPrice);
    $sqlstmt->bindValue(':image', $productImage);
    $sqlstmt->bindValue(':code', $productCode);

    if($sqlstmt->execute()) {
        echo"<p style='color: green'>Product:".$productName.": Created Successfully</p>";
    }else{
        echo"<p style='color: red'>Product:".$productName.": Created Failure</p>";
    }
}

$query= $conn->query("SELECT COUNT(*) as count FROM products");
$rowCount = $query->fetchArray();
$productCount = $rowCount["count"];

if($productCount == 0) {
    add_product('Fishing Rod','Fishing', 32, 70,'fishing-rod.jpg','a4d84470');
    add_product('Kayak','Boating', 25, 150,'kayak.jpg','qqw1rr24');
    add_product('Hiking Boots','Hiking', 100, 110,'fishing-rod.jpg','8ja8qa89');
    add_product('Camping Pot','Camping', 50, 60,'camping-pot.jpg','ajaj111a');
    add_product('Recovery Shackles','4WD', 200, 30,'recovery-shackles.jpg','lapoama11');
    add_product('Shower Tent','Camping', 100, 50,'shower-tent.jpg','yuauauah1');
    add_product('Winch','4WD', 50, 400,'winch.jpg','p469a2wwx');
    add_product('Tent','Camping', 70, 110,'tent.jpg','yy11ffsax');
    add_product('Solar Shower','Camping', 90, 80,'solar-shower.jpg','11xxss223');
    add_product('First Aid Kit','Camping', 200, 50,'first-aid-kit.jpg','ppoaoajaj');

}
?>


