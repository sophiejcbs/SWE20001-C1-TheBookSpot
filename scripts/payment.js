function incrementFunc(book_id) {
    var quantity = document.querySelector("#quantity_" + book_id);
    if(quantity) {
        quantity.value = parseInt(quantity.value) + 1;
    }

    sendAjaxRequest('payment.php', { book_id: book_id, qty: quantity.value });
    console.log(book_id);
}

function decrementFunc(book_id) {
    console.log("Increment function called for book ID: ", book_id);
    var quantity = document.querySelector("#quantity_" + book_id);
    if(quantity) {
        if(parseInt(quantity.getAttribute("value"))>1) {
            quantity.value = parseInt(quantity.value) - 1;
        }
    }

    sendAjaxRequest('payment.php', { book_id: book_id, qty: quantity.value });
    console.log(book_id);
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

function validate() {
    var result = true;

    var fname = document.paymentForm.fname;
    var lname = document.paymentForm.lname;
    var email = document.paymentForm.email;
    var phoneNumber = document.paymentForm.phoneNumber;
    var address = document.paymentForm.shipmentAddress;
    var city = document.paymentForm.city;
    var state = document.paymentForm.state;
    var postCode = document.paymentForm.postCode;

    var ccType = document.getElementsByName("ccType");
    var ccName = document.paymentForm.ccName;
    var ccNum = document.paymentForm.ccNum;
    var expDate = document.paymentForm.expDate;
    var cvv = document.paymentForm.cvv;

    var typeSelect = false;
    var ccTypeVal;

    // Validation for First Name
    if (fname.value == "") {
        document.getElementById("errFname").innerHTML = '<i class="bi bi-exclamation-circle-fill"></i> Your first name cannot be empty.';
        fname.style.border = "1.5px solid #f00";
        result = false;
    } else if (!fname.value.match(/^[a-zA-Z ]{2,40}$/)) { // Allow spaces with " [a-zA-Z ]"
        document.getElementById("errFname").innerHTML = '<i class="bi bi-exclamation-circle-fill"></i> Your first name can only have alphabets and be between 2 and 40 characters.';
        fname.style.border = "1.5px solid #f00";
        result = false;
    } else {
        document.getElementById("errFname").innerHTML = "";
        fname.style.border = "1.5px solid rgb(133, 133, 133)";
    }

    // Validation for Last Name
    if (lname.value == "") {
        document.getElementById("errLname").innerHTML = '<i class="bi bi-exclamation-circle-fill"></i> Your last name cannot be empty.';
        lname.style.border = "1.5px solid #f00";
        result = false;
    } else if (!lname.value.match(/^[a-zA-Z ]{2,40}$/)) { // Allow spaces with " [a-zA-Z ]"
        document.getElementById("errLname").innerHTML = '<i class="bi bi-exclamation-circle-fill"></i> Your last name can only have alphabets and be between 2 and 40 characters.';
        lname.style.border = "1.5px solid #f00";
        result = false;
    } else {
        document.getElementById("errLname").innerHTML = "";
        lname.style.border = "1.5px solid rgb(133, 133, 133)";
    }

    // Validation for Email
    if (email.value == "") {
        document.getElementById("errEmail").innerHTML = '<i class="bi bi-exclamation-circle-fill"></i> Your email cannot be empty.';
        email.style.border = "1.5px solid #f00";
        result = false;
    } else if (!email.value.match(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/)) {
        document.getElementById("errEmail").innerHTML = '<i class="bi bi-exclamation-circle-fill"></i> Please enter a valid email address.';
        email.style.border = "1.5px solid #f00";
        result = false;
    } else {
        document.getElementById("errEmail").innerHTML = "";
        email.style.border = "1.5px solid rgb(133, 133, 133)";
    }

    // Validation for Phone Number
    if (phoneNumber.value == "") {
        document.getElementById("errPhoneNum").innerHTML = '<i class="bi bi-exclamation-circle-fill"></i> Your phone number cannot be empty.';
        phoneNumber.style.border = "1.5px solid #f00";
        result = false;
    } else if (!phoneNumber.value.match(/^\d{8,10}$/)) {
        document.getElementById("errPhoneNum").innerHTML = '<i class="bi bi-exclamation-circle-fill"></i> Please enter a valid phone number (8-10 digits).';
        phoneNumber.style.border = "1.5px solid #f00";
        result = false;
    } else {
        document.getElementById("errPhoneNum").innerHTML = "";
        phoneNumber.style.border = "1.5px solid rgb(133, 133, 133)";
    }

    // Validation for Address (formerly Shipment Address)
    if (address.value == "") {
        document.getElementById("errAddr").innerHTML = '<i class="bi bi-exclamation-circle-fill"></i> Your address cannot be empty.';
        address.style.border = "1.5px solid #f00";
        result = false;
    } else if (!address.value.match(/^.{5,125}$/)) {
        document.getElementById("errAddr").innerHTML = '<i class="bi bi-exclamation-circle-fill"></i> Your address should be between 5 and 40 characters.';
        address.style.border = "1.5px solid #f00";
        result = false;
    } else {
        document.getElementById("errAddr").innerHTML = "";
        address.style.border = "1.5px solid rgb(133, 133, 133)";
    }

    // Validation for City
    if (city.value == "") {
        document.getElementById("errCity").innerHTML = '<i class="bi bi-exclamation-circle-fill"></i> Your city cannot be empty.';
        city.style.border = "1.5px solid #f00";
        result = false;
    } else if (!city.value.match(/^[a-zA-Z ]{2,100}$/)) {
        document.getElementById("errCity").innerHTML = '<i class="bi bi-exclamation-circle-fill"></i> Please enter a valid city name (2-20 characters).';
        city.style.border = "1.5px solid #f00";
        result = false;
    } else {
        document.getElementById("errCity").innerHTML = "";
        city.style.border = "1.5px solid rgb(133, 133, 133)";
    }

    // Validation for State
    if (state.value == "") {
        document.getElementById("errState").innerHTML = '<i class="bi bi-exclamation-circle-fill"></i> Please select a state.';
        state.style.border = "1.5px solid #f00";
        result = false;
    } else {
        document.getElementById("errState").innerHTML = "";
        state.style.border = "1.5px solid rgb(133, 133, 133)";
    }

    // Validation for Postcode
    if (postCode.value == "") {
        document.getElementById("errPostcode").innerHTML = '<i class="bi bi-exclamation-circle-fill"></i> Your postcode cannot be empty.';
        postCode.style.border = "1.5px solid #f00";
        result = false;
    } else {
        var state = document.getElementById("state").value;
        var validPostcode = validatePostcode(state, postCode.value);
        if (!validPostcode) {
            document.getElementById("errPostcode").innerHTML = '<i class="bi bi-exclamation-circle-fill"></i> Please enter a valid postcode for the selected state.';
            postCode.style.border = "1.5px solid #f00";
            result = false;
        } else {
            document.getElementById("errPostcode").innerHTML = "";
            postCode.style.border = "1.5px solid rgb(133, 133, 133)";
        }
    }

    // Function to validate postcode based on state
    function validatePostcode(state, postcode) {
        switch (state) {
            case "Johor":
                return (parseInt(postcode) >= 80000 && parseInt(postcode) <= 81760);
            case "Kedah":
                return (parseInt(postcode) >= 5000 && parseInt(postcode) <= 9990);
            case "Kelantan":
                return (parseInt(postcode) >= 15000 && parseInt(postcode) <= 19650);
            case "Malacca":
                return (parseInt(postcode) >= 75000 && parseInt(postcode) <= 78200);
            case "Negeri Sembilan":
                return (parseInt(postcode) >= 70000 && parseInt(postcode) <= 73990);
            case "Pahang":
                return (parseInt(postcode) >= 25000 && parseInt(postcode) <= 28700);
            case "Penang":
                return (parseInt(postcode) >= 10000 && parseInt(postcode) <= 14490);
            case "Perlis":
                return (parseInt(postcode) >= 1000 && parseInt(postcode) <= 2800);
            case "Sabah":
                return (parseInt(postcode) >= 88000 && parseInt(postcode) <= 91309);
            case "Sarawak":
                return (parseInt(postcode) >= 93000 && parseInt(postcode) <= 98859);
            case "Selangor":
                return (parseInt(postcode) >= 40000 && parseInt(postcode) <= 48300);
            case "Terengganu":
                return (parseInt(postcode) >= 20000 && parseInt(postcode) <= 24300);
            default:
                return false;
        }
    }


    //credit card type validation (check if there is a selection)
    for(var i = 0; i<ccType.length; i++) {
        if(ccType[i].checked) {
            ccTypeVal = ccType[i].value;
            typeSelect = true;
        }
    }

    if(typeSelect == false) {
        document.getElementById("errCCType").innerHTML = '<i class="bi bi-exclamation-circle-fill"></i> Your credit card type cannot be empty.';
        var ccTypeElements = document.getElementsByClassName("ccType");
        for (var i = 0; i < ccTypeElements.length; i++) {
            ccTypeElements[i].style.border = "1.5px solid #f00";
        }
        result = false;
    }
    else {
        document.getElementById("errCCType").innerHTML = '';
        var ccTypeElements = document.getElementsByClassName("ccType");
        for (var i = 0; i < ccTypeElements.length; i++) {
            ccTypeElements[i].style.border = "1.5px solid rgb(185, 183, 183)";
        }
    }

    if (ccName.value == "") {
        document.getElementById("errCCName").innerHTML = '<i class="bi bi-exclamation-circle-fill"></i> Your credit card name cannot be empty.';
        ccName.style.border = "1.5px solid #f00";
        result = false;
    } else if (!ccName.value.match(/^[a-zA-Z\s]{2,40}$/)) {
        document.getElementById("errCCName").innerHTML = '<i class="bi bi-exclamation-circle-fill"></i> Your credit card name can only have alphabets/spaces and be 40 characters or less.';
        ccName.style.border = "1.5px solid #f00";
        result = false;
    } else {
        document.getElementById("errCCName").innerHTML = "";
        ccName.style.border = "1.5px solid rgb(133, 133, 133)";
    }


    if(typeSelect != false) {
        if (ccNum.value == "") {
            document.getElementById("errCCNum").innerHTML = '<i class="bi bi-exclamation-circle-fill"></i> Your credit card number cannot be empty.';
            ccNum.style.border = "1.5px solid #f00";
            result = false;
        } else if (!ccNum.value.match(/^4\d{15}$/) && ccTypeVal == "Visa") {
            document.getElementById("errCCNum").innerHTML = '<i class="bi bi-exclamation-circle-fill"></i> Your Visa card number has to have 16 digits and start with a 4.';
            ccNum.style.border = "1.5px solid #f00";
            result = false;
        } else if (!ccNum.value.match(/^(5[1-5])\d{14}$/) && ccTypeVal == "Mastercard") {
            document.getElementById("errCCNum").innerHTML = '<i class="bi bi-exclamation-circle-fill"></i> Your Mastercard card number has to have 16 digits and start with 51-55.';
            ccNum.style.border = "1.5px solid #f00";
            result = false;
        } else if (!ccNum.value.match(/^(34|37)\d{13}$/) && ccTypeVal == "American Express") {
            document.getElementById("errCCNum").innerHTML = '<i class="bi bi-exclamation-circle-fill"></i> Your American Express card number has to have 15 digits and start with 34 or 37.';
            ccNum.style.border = "1.5px solid #f00";
            result = false;
        } else {
            document.getElementById("errCCNum").innerHTML = "";
            ccNum.style.border = "1.5px solid rgb(133, 133, 133)";
        }
    }
    else {
        ccNum.style.border = "1.5px solid #f00";
        result = false;
        document.getElementById("errCCNum").innerHTML = '<i class="bi bi-exclamation-circle-fill"></i> Your credit card type cannot be empty.';
    }
    
    // Validation for Credit Card Expiry Date (MM-YY format)
    const currentDate = new Date();
    const currentYear = currentDate.getFullYear() % 100; // Get last two digits of the current year
    const currentMonth = currentDate.getMonth() + 1; // Current month (1-12)

    if (expDate.value == "") {
        document.getElementById("errExpDate").innerHTML = '<i class="bi bi-exclamation-circle-fill"></i> Your credit card expiry date cannot be empty.';
        expDate.style.border = "1.5px solid #f00";
        result = false;
    } else if (!expDate.value.match(/^(0[1-9]|1[0-2])-(\d{2})$/)) {
        document.getElementById("errExpDate").innerHTML = '<i class="bi bi-exclamation-circle-fill"></i> Your expiry date needs to be in MM-YY format (e.g., 01-23).';
        expDate.style.border = "1.5px solid #f00";
        result = false;
    } else {
        const [expMonth, expYear] = expDate.value.split('-');
        if (Number(expYear) < currentYear || (Number(expYear) === currentYear && Number(expMonth) < currentMonth)) {
            document.getElementById("errExpDate").innerHTML = '<i class="bi bi-exclamation-circle-fill"></i> Your credit card has already expired.';
            expDate.style.border = "1.5px solid #f00";
            result = false;
        } else {
            document.getElementById("errExpDate").innerHTML = "";
            expDate.style.border = "1.5px solid rgb(133, 133, 133)";
        }
    }
    
    if (cvv.value == "") {
        document.getElementById("errCVV").innerHTML = '<i class="bi bi-exclamation-circle-fill"></i> Your CVV cannot be empty.';
        cvv.style.border = "1.5px solid #f00";
        result = false;
    } else if (!cvv.value.match(/^\d{3,4}$/)) {
        document.getElementById("errCVV").innerHTML = '<i class="bi bi-exclamation-circle-fill"></i> Your CVV needs to be 3-4 digits long.';
        cvv.style.border = "1.5px solid #f00";
        result = false;
    } else {
        document.getElementById("errCVV").innerHTML = "";
        cvv.style.border = "1.5px solid rgb(133, 133, 133)";
    }
    
    return result;
}

function displayBook(book_id) {
    window.location.href = "book_details.php?book_id="+book_id;
}
