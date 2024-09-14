<?php
session_start(); // Start the session
include "DBConn.php"; // Include your database connection
if (!isset($_SESSION['user_id'])) {
    // If the user is not logged in, redirect to the login page or show an appropriate message
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="shortcut icon" type="image/png" href="_images/_logos/easynet_icon.png">
    <link href="_styles/font-awesome.css" rel="stylesheet" />
    <link href="_styles/style.css" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php
    // Assuming you have a session that stores user ID
    $user_id = $_SESSION['user_id']; // Get the user ID from the session

    // Query to fetch shipping info
    $sql = "SELECT shipping_name, shipping_street, shipping_phone FROM shipping WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch shipping details
        $shipping = $result->fetch_assoc();

        // Encode shipping data to be passed to JavaScript
        echo "<script> var shippingInfo = " . json_encode($shipping) . "; </script>";
    } else {
        echo "<p>No shipping information found.</p>";
    }
    ?>
    <?php
    $user_id = $_SESSION['user_id']; // Assuming the user_id is stored in the session

    // PHP code to retrieve cart data for the logged-in user
    $sql = "SELECT prod_name, prod_price, quantity, cart_incTotal FROM cart WHERE user_id = ?";

    // Assuming you have a session variable for user ID
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id); // Assuming $user_ID is the logged-in user's ID
    $stmt->execute();
    $result = $stmt->get_result();

    $cartItems = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cartItems[] = [
                'prod_name' => $row['prod_name'],
                'prod_price' => $row['prod_price'],
                'quantity' => $row['quantity'],
                'cartIncVat' => $row['cart_incTotal']
            ];
        }
    }
    // Encode PHP array to JSON
    $cartItemsJson = json_encode($cartItems);
    ?>

    <!-- Add HTML to inform the user that the order was successfully placed -->
    <div id="placed_order">
        <img src="_images/_icons/check.png" width="70px" />
        <h1>Your order has been placed!</h1>
        <p>Thank you for your purchase. A receipt has been generated for your order.</p>
        <button onclick="generatePDF()" id="place_order">Place Order</button>
        <a id="view_cart_link" href="checkout.php"><button id="view_cart">View Cart</button></a>
    </div>


    <script src="https://unpkg.com/jspdf-invoice-template@1.4.0/dist/index.js"></script>
    <script>
        function generatePDF() {
            var pdfObject = jsPDFInvoiceTemplate.default(props);
            console.log("Object created: ", pdfObject);
        }
        var today = new Date(); // Get the current date
        var day = String(today.getDate()).padStart(2, '0'); // Add leading zero if necessary
        var month = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-based
        var year = today.getFullYear();
        var hours = today.getHours();
        var minutes = today.getMinutes();
        var seconds = today.getSeconds();

        // Format the date and time
        var currentDate = day + '/' + month + '/' + year;
        var currentTime = hours + ':' + minutes + ':' + seconds;


        var cartItems = <?php echo $cartItemsJson; ?>;

        // Construct the table data
        var tableData = cartItems.map((item, index) => [
            index + 1, // Index (starting from 1)
            item.prod_name, // Product name
            "R " + item.cartIncVat, // Product price
            item.quantity, // Quantity
            "R " + (item.cartIncVat * item.quantity) // Total including VAT
        ]);

        var props = {
            outputType: jsPDFInvoiceTemplate.OutputType.Save, //Allows for additional configuration prior to writing among others, adds support for different languages and symbols
            returnJsPDFDocObject: true,
            fileName: "Invoice 2021",
            orientationLandscape: false,
            compress: true,
            logo: {
                src: "_images/_logos/easynet.png",
                type: 'PNG', //optional, when src= data:uri (nodejs case)
                width: 35.33, //aspect ratio = width/height
                height: 26.66,
                margin: {
                    top: 0, //negative or positive num, from the current position
                    left: 0 //negative or positive num, from the current position
                }
            },
            stamp: {
                inAllPages: true, //by default = false, just in the last page
                src: "https://raw.githubusercontent.com/edisonneza/jspdf-invoice-template/demo/images/qr_code.jpg",
                type: 'JPG', //optional, when src= data:uri (nodejs case)
                width: 20, //aspect ratio = width/height
                height: 20,
                margin: {
                    top: 0, //negative or positive num, from the current position
                    left: 0 //negative or positive num, from the current position
                }
            },
            business: {
                name: "EasyNet In Business Communications",
                address: "570 Fehrsen Street, Brooklyn, Pretoria",
                phone: "012 433 6486",
                email: "sales@easynetbusiness.co.za",
                email_1: "dikeledi@easynetbusiness.co.za",
                website: "easynetbusiness.co.za",
            },
            contact: {
                label: "Invoice issued for:",
                name: shippingInfo.shipping_name,
                address: shippingInfo.shipping_street,
                phone: shippingInfo.shipping_phone.toString(),
            },
            invoice: {
                label: "Invoice #: ",
                num: 19,
                invDate: "Payment Date: 01/01/2021 18:12",
                invGenDate: "Invoice Date: " + currentDate + " " + currentTime,
                headerBorder: false,
                tableBodyBorder: false,
                header: [{
                        title: "#",
                        style: {
                            width: 10
                        }
                    },
                    {
                        title: "Product Name",
                        style: {
                            width: 50
                        }
                    },
                    {
                        title: "Price"
                    },
                    {
                        title: "Quantity"
                    },
                    {
                        title: "Total"
                    }
                ],
                table: tableData,
                invTotalLabel: "Total:",
                invTotal: cartItems.reduce((sum, item) => sum + parseFloat(item.cartIncVat * item.quantity), 0).toFixed(2),
                invCurrency: "R",
                row1: {
                    col1: 'VAT:',
                    col2: '20',
                    col3: '%',
                    style: {
                        fontSize: 10 //optional, default 12
                    }
                },
                row2: {
                    col1: 'SubTotal:',
                    col2: cartItems.reduce((sum, item) => sum + parseFloat(item.prod_price * item.quantity), 0).toFixed(2),
                    col3: 'R',
                    style: {
                        fontSize: 10 //optional, default 12
                    }
                },
                invDescLabel: "Banking Information",
                invDesc: "Bank Name: FNB\nAccount Number: 62790756426\nAccount Type: Business Account\nBranch Name: Carlswald\nBranch Code: 250177",
            },
            footer: {
                text: "The invoice is created on a computer and is valid without the signature and stamp.",
            },
            pageEnable: true,
            pageLabel: "Page ",
        };
    </script>

</body>

</html>