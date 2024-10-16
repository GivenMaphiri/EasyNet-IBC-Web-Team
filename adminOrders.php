<?php

include 'DBConn.php';

session_start();

$sql = "SELECT order_ID, order_total, placed_on, user_ID, payment_status, status FROM orders";
$result = $conn->query($sql);

$sql = "SELECT prod_ID, prod_name, prod_code, prod_description, prod_price, prod_image, prod_manufacturer, prod_type FROM products";
$result = $conn->query($sql);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- DataTables -->
    <link rel="stylesheet" href="_lib/datatables/dataTables.css"> 
    

</head>
<body>

<style>
    td {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        max-width: 110px;
    }

    #prodTable {
              border: 1px solid #ddd;
              margin-bottom: 20px;
              border-collapse: collapse;
              width: 100%; /* Adjust width as needed */
              padding: 10px;

          }

          #prodTable thead th {
              background-color: #312f2f;
              color: white;
              font-weight: bold;
            }

            th, td {
              border: 1px solid black;
              padding: 8px;
              text-align: left;
          }

          td {
            text-align: left;
          }
</style>

    <table id="prodTable" class="display">
        <thead>
            <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Code</th>
                  <th>Description</th>
                  <th>Price</th>
                  <th>Image</th>
                  <th>Manufacturer</th>
                  <th>Type</th>
                  <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["prod_ID"] . "</td>";
                        echo "<td>" . $row["prod_name"] . "</td>";
                        echo "<td>" . $row["prod_code"] . "</td>";
                        echo "<td>" . $row["prod_description"] . "</td>";
                        echo "<td>R" . $row["prod_price"] . "</td>";
                        echo "<td>" . $row["prod_image"] . "</td>";
                        echo "<td>" . $row["prod_manufacturer"] . "</td>";
                        echo "<td>" . $row["prod_type"] . "</td>";

                        echo "<td>";
                        // echo "<a href='ecommerceEdit.php?id=" . $row["prod_ID"] . "'><span class='fa-light fa-pen-to-square'></span></a>";
                        // echo "<a href='ecommerceDelete.php?id=" . $row["prod_ID"] . "'><span class='fa-solid fa-delete-left'></span></a>";
                        echo "<a class='btn btn-danger btn-sm' href='ecommerceDelete.php?id=" .$row["prod_ID"] ."'>Delete</a>";
                        echo "</td>";

                        echo "</tr>";
                    }
                } else {
                    echo "0 results";
                }


                $conn->close();

            ?>
        </tbody>
    </table>

    <!-- JQuery -->
    <script src="_lib/jquery/jquery-3.7.1.min.js"></script>

    <!-- DataTables -->
     <script src="_lib/datatables/dataTables.js"></script>

     <script>
        $(document).ready( function () {
            $('#prodTable').DataTable();
        } );
     </script>
    
</body>
</html>