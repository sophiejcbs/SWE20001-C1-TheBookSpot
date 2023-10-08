function increment() {
    var quantity = document.querySelector("#quantity");
    if(quantity) {
        quantity.setAttribute("value", parseInt(quantity.getAttribute("value")) + 1);
    }

    hiddenQty.value = quantity.value;
}

function decrement() {
    var quantity = document.querySelector("#quantity");
    if(quantity) {
        if(parseInt(quantity.getAttribute("value"))>1) {
            quantity.setAttribute("value", parseInt(quantity.getAttribute("value")) - 1);
        }
    }

    hiddenQty.value = quantity.value;
}
