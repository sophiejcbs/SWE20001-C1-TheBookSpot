"use strict";

function validForm()
{
    var result = true;

    var name = document.complaint_form.name;
    var email = document.complaint_form.email;
    var phone = document.complaint_form.phone;
    var dateOfComplaint = document.complaint_form.dateOfComplaint;
    var complaintReason = document.complaint_form.complaintReason;
    var complaintDesc = document.complaint_form.complaintDesc;
    
    //Name Validation
    if(name.value == ""){
        name.nextElementSibling.style.display = "block";
        name.style.border = "2px solid #f00";
        document.getElementById("errName").innerHTML='<i class="bi bi-exclamation-circle-fill"></i> Please enter your name';
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
        document.getElementById("errEmail").innerHTML='<i class="bi bi-exclamation-circle-fill"></i> Please enter your email';
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

    //Complaint Date Validation
    if(dateOfComplaint.value == ""){
        dateOfComplaint.nextElementSibling.style.display = "block";
        dateOfComplaint.style.border = "1px solid #f00";
        document.getElementById("errdate").innerHTML='<i class="bi bi-exclamation-circle-fill"></i> Please enter your date of complaint';
        result = false;
    }else{
        dateOfComplaint.nextElementSibling.style.display = "none";
        dateOfComplaint.style.border = "2px solid transparent";
        document.getElementById("errdate").innerHTML="";
    }

    //Complaint Reason Validation
    if(complaintReason.value == "none"){
        complaintReason.nextElementSibling.style.display = "block";
        complaintReason.style.border = "2px solid #f00";
        document.getElementById("errReason").innerHTML='<i class="bi bi-exclamation-circle-fill"></i> Please select your complaint reason';
        result = false;
    }else{
        complaintReason.nextElementSibling.style.display = "none";
        complaintReason.style.border = "2px solid transparent";
        document.getElementById("errReason").innerHTML='';
    }

    //Complaint Description Validation
    if(complaintDesc.value == ""){
        complaintDesc.nextElementSibling.style.display = "block";
        complaintDesc.style.border = "2px solid #f00";
        document.getElementById("errDesc").innerHTML='<i class="bi bi-exclamation-circle-fill"></i> Please enter your message';
        result = false;
    }else{
        complaintDesc.nextElementSibling.style.display = "none";
        complaintDesc.style.border = "2px solid transparent";
        document.getElementById("errDesc").innerHTML='';
    }

    return result;
}