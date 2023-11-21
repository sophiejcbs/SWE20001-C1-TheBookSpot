function increment(stock) {
    var quantity = document.querySelector("#quantity");
    if(quantity && (quantity.value < stock)) {
        quantity.setAttribute("value", parseInt(quantity.getAttribute("value")) + 1);
    }
    else if(quantity.value >= stock) {
        alert("Invalid action! Maximum book stock is already in your cart.");
    }

    document.getElementById("hiddenQty").value = quantity.value;
}

function decrement() {
    var quantity = document.querySelector("#quantity");
    if(quantity) {
        if(parseInt(quantity.getAttribute("value"))>1) {
            quantity.setAttribute("value", parseInt(quantity.getAttribute("value")) - 1);
        }
    }

    document.getElementById("hiddenQty").value = quantity.value;
}
