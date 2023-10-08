"use strict";

function infoValidation(){
    var image = document.bookInformation.image;
    var title = document.bookInformation.title;
    var author = document.bookInformation.author;
    var genre = document.bookInformation.genre;
    var type = document.bookInformation.type;
    var publisher = document.bookInformation.publisher;
    var pubDate = document.bookInformation.pubDate;
    var bookDesc = document.bookInformation.bookDesc;
    var isbn = document.bookInformation.isbn;
    var bookLang = document.bookInformation.bookLang;
    var price = document.bookInformation.price;
    var stock = document.bookInformation.stock;
    var amount = document.bookInformation.amount;
    
    //Image Validation
    if(image.value == ""){
        image.nextElementSibling.style.display = "block";
        image.style.border = "2px solid #f00";
        document.getElementById("errImage").innerHTML='<i class="bi bi-exclamation-circle-fill"></i>Please enter the Book Image Hyperlink';
        return false
    }else{
        image.nextElementSibling.style.display = "none";
        image.style.border = "2px solid transparent";
        document.getElementById("errImage").innerHTML='';
    }

    //Title Validation
    if(title.value == ""){
        title.nextElementSibling.style.display = "block";
        title.style.border = "2px solid #f00";
        document.getElementById("errTitle").innerHTML='<i class="bi bi-exclamation-circle-fill"></i>Please enter the Book Title';
        return false
    }else{
        title.nextElementSibling.style.display = "none";
        title.style.border = "2px solid transparent";
        document.getElementById("errTitle").innerHTML="";
    }

    //Author Validation
    if(author.value == ""){
        author.nextElementSibling.style.display = "block";
        author.style.border = "2px solid #f00";
        document.getElementById("errAuthor").innerHTML='<i class="bi bi-exclamation-circle-fill"></i>Please enter the Name of the Book Author';
        return false
    }else{
        author.nextElementSibling.style.display = "none";
        author.style.border = "2px solid transparent";
        document.getElementById("errAuthor").innerHTML="";
    }
    
    //Genre Validation
    if(genre.value == "NA"){
        genre.nextElementSibling.style.display = "block";
        genre.style.border = "2px solid #f00";
        document.getElementById("errGenre").innerHTML='<i class="bi bi-exclamation-circle-fill"></i>Please select the Book Genre';
        return false
    }else{
        genre.nextElementSibling.style.display = "none";
        genre.style.border = "2px solid transparent";
        document.getElementById("errGenre").innerHTML='';
    }

    //Type Validation
    if(type.value == "NA"){
        type.nextElementSibling.style.display = "block";
        type.style.border = "2px solid #f00";
        document.getElementById("errType").innerHTML='<i class="bi bi-exclamation-circle-fill"></i>Please select the Book Type';
        return false
    }else{
        type.nextElementSibling.style.display = "none";
        type.style.border = "2px solid transparent";
        document.getElementById("errType").innerHTML="";
    }

    //Publisher Validation
    if(publisher.value == ""){
        publisher.nextElementSibling.style.display = "block";
        publisher.style.border = "2px solid #f00";
        document.getElementById("errPublisher").innerHTML='<i class="bi bi-exclamation-circle-fill"></i>Please enter the Name of the Book Publisher';
        return false
    }else{
        publisher.nextElementSibling.style.display = "none";
        publisher.style.border = "2px solid transparent";
        document.getElementById("errPublisher").innerHTML="";
    }

    //Publication Date Validation
    if(pubDate.value == ""){
        pubDate.nextElementSibling.style.display = "block";
        pubDate.style.border = "2px solid #f00";
        document.getElementById("errPubDate").innerHTML='<i class="bi bi-exclamation-circle-fill"></i>Please select the Book Publication Date';
        return false
    }else{
        pubDate.nextElementSibling.style.display = "none";
        pubDate.style.border = "2px solid transparent";
        document.getElementById("errPubDate").innerHTML='';
    }

    //Description Validation
    if(bookDesc.value == ""){
        bookDesc.nextElementSibling.style.display = "block";
        bookDesc.style.border = "2px solid #f00";
        document.getElementById("errBookDesc").innerHTML='<i class="bi bi-exclamation-circle-fill"></i>Please enter the Book Description';
        return false
    }else{
        bookDesc.nextElementSibling.style.display = "none";
        bookDesc.style.border = "2px solid transparent";
        document.getElementById("errBookDesc").innerHTML="";
    }

    //ISBN Validation
    if(isbn.value == ""){
        isbn.nextElementSibling.style.display = "block";
        isbn.style.border = "2px solid #f00";
        document.getElementById("errISBN").innerHTML='<i class="bi bi-exclamation-circle-fill"></i>Please enter the Book ISBN Number';
        return false
    }else if(isNaN(isbn.value)){
        isbn.nextElementSibling.style.display = "block";
        isbn.style.border = "2px solid #f00";
        document.getElementById("errISBN").innerHTML='<i class="bi bi-exclamation-circle-fill"></i>Please enter Number ONLY';
        return false
    }else if(isbn.value.length != 13){
        isbn.nextElementSibling.style.display = "block";
        isbn.style.border = "2px solid #f00";
        document.getElementById("errISBN").innerHTML='<i class="bi bi-exclamation-circle-fill"></i>Please enter exactly 13 Numbers';
        return false
    }else{
        isbn.nextElementSibling.style.display = "none";
        isbn.style.border = "2px solid transparent";
        document.getElementById("errISBN").innerHTML="";
    }

    //Language Validation
    if(bookLang.value == ""){
        bookLang.nextElementSibling.style.display = "block";
        bookLang.style.border = "2px solid #f00";
        document.getElementById("errBookLang").innerHTML='<i class="bi bi-exclamation-circle-fill"></i>Please enter the Book Language';
        return false
    }else{
        bookLang.nextElementSibling.style.display = "none";
        bookLang.style.border = "2px solid transparent";
        document.getElementById("errBookLang").innerHTML='';
    }

    //Price Validation
    if(price.value == ""){
        price.nextElementSibling.style.display = "block";
        price.style.border = "2px solid #f00";
        document.getElementById("errPrice").innerHTML='<i class="bi bi-exclamation-circle-fill"></i>Please enter the Book Selling Price';
        return false
    }else if(!price.value.match(/^\$?[0-9]+(\.[0-9]{2})?$/)){
        price.nextElementSibling.style.display = "block";
        price.style.border = "2px solid #f00";
        document.getElementById("errPrice").innerHTML='<i class="bi bi-exclamation-circle-fill"></i>Please enter the Price following this Format(xx.xx)';
        return false
    }else{
        price.nextElementSibling.style.display = "none";
        price.style.border = "2px solid transparent";
        document.getElementById("errPrice").innerHTML="";
    }

    //Stock Validation
    if(stock.value == ""){
        stock.nextElementSibling.style.display = "block";
        stock.style.border = "2px solid #f00";
        document.getElementById("errStock").innerHTML='<i class="bi bi-exclamation-circle-fill"></i>Please enter the Available Stock of the Book';
        return false
    }else if(isNaN(stock.value)){
        stock.nextElementSibling.style.display = "block";
        stock.style.border = "2px solid #f00";
        document.getElementById("errStock").innerHTML='<i class="bi bi-exclamation-circle-fill"></i>Please enter Number ONLY';
        return false
    }else{
        stock.nextElementSibling.style.display = "none";
        stock.style.border = "2px solid transparent";
        document.getElementById("errStock").innerHTML="";
    }

    //Amount Validation
    if(amount.value == ""){
        amount.nextElementSibling.style.display = "block";
        amount.style.border = "2px solid #f00";
        document.getElementById("errAmount").innerHTML='<i class="bi bi-exclamation-circle-fill"></i>Please enter the Amount Sold for the Book';
        return false
    }else if(isNaN(amount.value)){
        amount.nextElementSibling.style.display = "block";
        amount.style.border = "2px solid #f00";
        document.getElementById("errAmount").innerHTML='<i class="bi bi-exclamation-circle-fill"></i>Please enter Number ONLY';
        return false
    }else{
        amount.nextElementSibling.style.display = "none";
        amount.style.border = "2px solid transparent";
        document.getElementById("errAmount").innerHTML='';
    }
}