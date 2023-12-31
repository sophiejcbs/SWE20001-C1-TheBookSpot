function incrementFunc(book_id, stock) {
    var quantity = document.querySelector("#quantity_" + book_id);

    if(quantity && (quantity.value < stock)) {
        quantity.value = parseInt(quantity.value) + 1;
    }
    else if(quantity.value >= stock) {
        alert("Invalid action! Maximum book stock already reached.");
    }

    sendAjaxRequest('cart.php', { book_id: book_id, qty: quantity.value });
}

function decrementFunc(book_id) {
    console.log("Increment function called for book ID: ", book_id);
    var quantity = document.querySelector("#quantity_" + book_id);
    if(quantity) {
        if(parseInt(quantity.getAttribute("value"))>1) {
            quantity.value = parseInt(quantity.value) - 1;
        }
    }

    sendAjaxRequest('cart.php', { book_id: book_id, qty: quantity.value });
}

function sendAjaxRequest(url, data) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
        location.reload();
      }
    };
    xhr.send(JSON.stringify(data));
}

function displayBook(book_id) {
    window.location.href = "book_details.php?book_id="+book_id;
}

function bookCatalogue() {
    window.location.href = "book_catalogue.php?genre=Young%20Adult%20Fantasy";
}

function checkout() {
    window.location.href = "payment.php";
}
