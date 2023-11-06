function validForm()
{
    var result = true;

    var name = document.feedback_form.name;
    var email = document.feedback_form.email;
    var phone = document.feedback_form.phone;
    var dateOfFeedback = document.feedback_form.dateOfFeedback;
    var feedbackDesc = document.feedback_form.feedbackDesc;

    //Name Validation
    if(name.value == ""){
        name.nextElementSibling.style.display = "block";
        name.style.border = "2px solid #f00";
        document.getElementById("errName").innerHTML='<i class="bi bi-exclamation-circle-fill"></i>Please enter your name';
        result = false;
    }else{
        name.nextElementSibling.style.display = "none";
        name.style.border = "2px solid transparent";
        document.getElementById("errName").innerHTML='';
    }

    //Email Validation
    console.log(!email.value.includes("@"))
    if(!email.value.includes("@") || email.value == ""){
        console.log("in")
        email.nextElementSibling.style.display = "block";
        email.style.border = "2px solid #f00";
        document.getElementById("errEmail").innerHTML='<i class="bi bi-exclamation-circle-fill"></i>Please enter your email';
        result = false;
    }else{
        email.nextElementSibling.style.display = "none";
        email.style.border = "2px solid transparent";
        document.getElementById("errEmail").innerHTML='';
    }

    //Phone Validation
    if(phone.value == ""){
        phone.nextElementSibling.style.display = "block";
        phone.style.border = "2px solid #f00";
        document.getElementById("errPhone").innerHTML='<i class="bi bi-exclamation-circle-fill"></i>Please enter your phone number';
        result = false;
    }else if(isNaN(phone.value)){
        isbn.nextElementSibling.style.display = "block";
        isbn.style.border = "2px solid #f00";
        document.getElementById("errPhone").innerHTML='<i class="bi bi-exclamation-circle-fill"></i>Please enter Number ONLY';
        result = false;
    }else if(phone.value.length > 11){
        isbn.nextElementSibling.style.display = "block";
        isbn.style.border = "2px solid #f00";
        document.getElementById("errPhone").innerHTML='<i class="bi bi-exclamation-circle-fill"></i>Please enter exactly 10 or 11 Numbers ONLY';
        result = false;
    }else{
        phone.nextElementSibling.style.display = "none";
        phone.style.border = "2px solid transparent";
        document.getElementById("errPhone").innerHTML='';
    }

    //Feedback Date Validation
    if(dateOfFeedback.value == ""){
        dateOfFeedback.nextElementSibling.style.display = "block";
        dateOfFeedback.style.border = "1px solid #f00";
        document.getElementById("errdate").innerHTML='<i class="bi bi-exclamation-circle-fill"></i> Please enter your date of Feedback';
        result = false;
    }else{
        dateOfFeedback.nextElementSibling.style.display = "none";
        dateOfFeedback.style.border = "2px solid transparent";
        document.getElementById("errdate").innerHTML="";
    }

    //Feedback Description Validation
    if(feedbackDesc.value == ""){
        feedbackDesc.nextElementSibling.style.display = "block";
        feedbackDesc.style.border = "2px solid #f00";
        document.getElementById("errFeedDesc").innerHTML='<i class="bi bi-exclamation-circle-fill"></i>Please enter your message';
        result = false;
    }else{
        feedbackDesc.nextElementSibling.style.display = "none";
        feedbackDesc.style.border = "2px solid transparent";
        document.getElementById("errFeedDesc").innerHTML='';
    }

    return result;
}