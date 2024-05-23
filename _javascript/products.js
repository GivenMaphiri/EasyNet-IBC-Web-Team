var removeCartItemButtons = document.getElementsByClassName("btn_danger");

for (var i = 0; i < removeCartItemButtons.length; i++) {
  var button = removeCartItemButtons[i];
  button.addEventListener("click", function (event) {
    var buttonClicked = event.target;
    buttonClicked.parentElement.parentElement.remove();
    updateCartTotal();
  });
}

function updateCartTotal() {
  var cartItemContainer = document.getElementsByClassName("checkout_boxes")[0];
  var cartRows = cartItemContainer.getElementsByClassName("checkbox1");
  var total = 0;
  for (var i = 0; i < cartRows.length; i++) {
    var cartRow = cartRows[i];
    var priceElement = cartRow.getElementsByClassName("prod_prices")[0];
    var quantityElement = cartRow.getElementsByClassName("cart_quantity")[0];
    var price = parseFloat(priceElement.innerText.replace("R", ""));
    var quantity = quantityElement.value;
    total = total + price * quantity;
  }
  document.getElementsByClassName("cart_total_price")[0].innerText =
    "R" + total;
}
