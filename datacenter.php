<!DOCTYPE html>
<html lang="vn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./mainstyle.css"/>
    <title>ATN data center</title>
</head>
<body>
        <?php
        ini_set('display_errors', 1);
        if (empty(getenv("DATABASE_URL"))){
            $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=postgres', 'postgres', '123456');
        }  else {
            echo getenv("dbname");
        $db = parse_url(getenv("DATABASE_URL"));
        $pdo = new PDO("pgsql:" . sprintf(
                "host=ec2-34-197-141-7.compute-1.amazonaws.com;port=5432;user=swlkkbqcrglzzg;password=65232542ac11465842a449d6a73c2a81eba57efff6d6cfae29c2f688246681ca;dbname=d13sqb8ctk5ua3",
                $db["host"],
                $db["port"],
                $db["user"],
                $db["pass"],
                ltrim($db["path"], "/")
        ));
        }  

        $sql = "SELECT * FROM product ORDER BY product_id";
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $resultSet = $stmt->fetchAll();
    ?>
    <h1>ATN cơ sở dữ liệu</h1>
    <button onclick="location.href='index.php'">Trờ về trang chủ</button>
    <div class="container">
        <div class="grid-view">
            <div class="grid-item">
                <img src="./database.png"/>
                <a href="#" onClick="displayData()"><b>Xem dữ liệu SP</b></a>
            </div>
            <div class="grid-item">
                <img src="./database.png" />
                <a href="./InsertData.php" target="framename"><b>Thêm DL</b></a>
            </div>
            <div class="grid-item">
                <img src="./database.png"/>
                <a href="./DeleteData.php" target="framename"><b>Xóa DL</b></a>
            </div>
            <div class="grid-item">
                <img src="./database.png"/>
                <a href="UpdateData.php" target="framename"><b>Cập nhật DL</b></a>
            </div>
            <div id ="displaychange" class="grid-item">
                <table class="table table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th>Product_ID</th>
                        <th>Product_name</th>
                        <th>NSX</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    // tạo vòng lặp 
                        //while($r = mysql_fetch_array($result)){
                            foreach ($resultSet as $row) {
                    ?>
                    
                    <tr>
                        <td scope="row"><?php echo $row['product_id'] ?></td>
                        <td><?php echo $row['product_name'] ?></td>
                        <td><?php echo $row['nsx'] ?></td>     
                    </tr>
                    
                    <?php
                            }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="./data.js"></script>
</body>
</html>