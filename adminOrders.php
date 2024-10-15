<?php

include 'DBConn.php';

session_start();

$sql = "SELECT order_ID, order_total, placed_on, user_ID, payment_status, status FROM orders";
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

    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Total</th>
                <th>Placed on</th>
                <th>user_ID</th>
                <th>payment status</th>
                <th>status</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            <?php 

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["order_ID"] . "</td>";
                    echo "<td>" . $row["order_total"] . "</td>";
                    echo "<td>" . $row["placed_on"] . "</td>";
                    echo "<td>" . $row["user_ID"] . "</td>";
                    echo "<td>" . $row["payment_status"] . "</td>";
                    echo "<td>" . $row["status"] . "</td>";
                    echo "<td><a class='btn btn-dark' href='ordersDelete.php?id=" .$row["order_ID"] ."'>Delete</a></td>";

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
            $('#myTable').DataTable();
        } );
     </script>
    
</body>
</html>