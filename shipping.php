<?php
session_start(); // Start the session
include "DBConn.php"; // Include your database connection
if (!isset($_SESSION['user_id'])) {
    // If the user is not logged in, redirect to the login page or show an appropriate message
    header("Location: login.php");
    exit();
}

$user_ID = $_SESSION['user_id'];
// Function to check if the cart is empty
function isCartEmpty($user_ID, $conn)
{
    $query = "SELECT COUNT(*) AS item_count FROM cart WHERE user_ID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_ID);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    return $row['item_count'] == 0; // Return true if no items in cart
}

// If the cart is empty, redirect the user
if (isCartEmpty($user_ID, $conn)) {
    $_SESSION['error_message'] = "You need to have items in your cart to proceed to shipping.";
    header("Location: checkout.php"); // Redirect to the cart or any other relevant page
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyNet IBC | Shipping</title>
    <link rel="shortcut icon" type="image/png" href="_images/_logos/easynet_icon.png">
    <link href="_styles/style.css" rel="stylesheet" />
    <link href="_styles/font-awesome.css" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body id="body_ship">

    <div class="shipping">

        <div class="shipping_heading">
            <p id="backtocart"><a href='checkout.php' id='prod_back'>&#9664; Back to Cart</a></p>
            <h1>Shipping Information</h1>
        </div>
        <hr id="checkout_lines">

        <?php

        $user_ID = $_SESSION['user_id']; // Ensure user is logged in
        $sql = "SELECT * FROM shipping WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_ID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = $row['shipping_name'];
            $street = $row['shipping_street'];
            $city = $row['shipping_city'];
            $province = $row['shipping_province'];
            $zip = $row['shipping_zip'];
            $phone = $row['shipping_phone'];
        } else {
            $name = $street = $city = $province = $zip = $phone = '';
        }

        ?>

        <div id="shipping_con">

            <form method="post" action="shippinginfo.php" onsubmit="return validateForm()">
                <div id="shipping_info">
                    <label for="name">Name:</label>
                    <input type="text" name="name" class="ship_name" id="ship_text" value="<?php echo htmlspecialchars($name); ?>" required></input>
                    <label for="street">Street Address:</label>
                    <input type="text" name="street" class="ship_street" id="ship_text" value="<?php echo htmlspecialchars($street); ?>" required></input>
                    <label for="city">City:</label>
                    <input type="text" name="city" class="ship_city" id="ship_text" value="<?php echo htmlspecialchars($city); ?>" required></input>
                    <label for="province">Province:</label>
                    <input type="text" name="province" class="ship_province" id="ship_text" value="<?php echo htmlspecialchars($province); ?>" required></input>
                    <label for="zip">Zip Code:</label>
                    <input type="text" name="zip" class="ship_zip" pattern="[0-9]+" title="Please enter numbers only" id="ship_text" value="<?php echo htmlspecialchars($zip); ?>" required></input>
                    <label for="phone">Phone Number:</label>
                    <input type="text" name="phone" class="ship_phone" pattern="[0-9]+" title="Please enter numbers only" id="ship_text" value="<?php echo htmlspecialchars($phone); ?>" required></input>
                    <button type="submit" id="save_ship">Save Shipping Information</button>
                </div>
            </form>


            <div id="order_summary">
                <?php

                // Check if the user is logged in
                if (isset($_SESSION['user_id'])) {
                    $user_ID = $_SESSION['user_id'];

                    // SQL query to get the prices and quantities of the products in the user's cart
                    $sql = "SELECT prod_price, cart_incTotal, cart_VAT, quantity FROM cart WHERE user_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $user_ID);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    $subtotal = 0;
                    $totalprice = 0;
                    $cartvat = 0;

                    // Calculate subtotal
                    while ($row = $result->fetch_assoc()) {
                        $totalprice += $row['cart_incTotal'] * $row['quantity'];
                        $subtotal += $row['prod_price'] * $row['quantity'];
                        $cartvat += $row['cart_VAT'] * $row['quantity'];
                    }
                } else {
                    // If the user is not logged in, set subtotal to 0
                    $subtotal = 0;
                    $cartvat = 0;
                    $totalprice = 0;
                }
                ?>

                <div>
                    <h3>Order Summary</h3>
                    <p id="order_info">Subtotal: R<?php echo number_format($subtotal, 2); ?></p>
                    <p id="order_info">Delivery Fee: R0.00</p>
                    <p id="order_info">VAT: R<?php echo number_format($cartvat, 2); ?></p>
                    <hr id="order_line">
                    <p id="order_info">Total Price: R<?php echo number_format($totalprice, 2); ?></p>
                </div>
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

                <div id="order_buttons">
                    <form action="place_order.php" method="POST">

                        <button type="submit" onclick="handleOrder()" id="place_order">Place Order</button>
                    </form>
                    <a id="view_cart_link" href="checkout.php"><button id="view_cart">View Cart</button></a>
                </div>
            </div>
        </div>
        <script src="https://unpkg.com/jspdf-invoice-template@1.4.0/dist/index.js"></script>
        <script>
            function validateForm() {
                let zip = document.querySelector(".ship_zip").value;
                let phone = document.querySelector(".ship_phone").value;

                if (!/^[0-9]+$/.test(zip)) {
                    alert("Zip code must be numbers only.");
                    return false;
                }

                if (!/^[0-9]+$/.test(phone)) {
                    alert("Phone number must be numbers only.");
                    return false;
                }
                return true;
            }

            function handleOrder() {
                // Call the function to generate the PDF receipt
                generatePDF();

                // Once the receipt is generated, submit the form
                setTimeout(function() {
                    document.getElementById('placeOrderForm').submit();
                }, 2000); // Adjust this delay as needed to allow for PDF generation
            }

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
                fileName: "Invoice: " + shippingInfo.shipping_name + " " + currentDate,
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
    </div>
</body>

</html>