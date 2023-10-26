<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="utf‐8" /> 
    <meta name="description" content="SWE20001 The Book Spot"/>
    <meta name="keywords" content="book, store"/> 
    <meta name="author"   content="The Flying Fish" />
    <title>The Book Spot</title>
    
    <link rel="icon" type="image/x-icon" href="images\logo.png">
    <!-- CSS -->
    <link href = "styles/style.css" rel="stylesheet">
    <link href = "styles/aboutUs.css" rel="stylesheet">
    <link href = "styles/responsive.css" rel="stylesheet" media ="screen and (max-width:1024px)"/>
    <link href = "styles/aboutUs_resp.css" rel="stylesheet" media ="screen and (max-width:1024px)"/>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    
    <!-- Header & Navigation Menu-->
    <?php
        include_once 'inc/header.inc';
        include_once 'inc/menu.inc';

    ?>

    <h1 class="heading">About Us</h1>
    <div class="aboutsec">
        <div class="imageContainer"><img src="images/Photo_Sophie.jpg" alt="Sophie's beautiful photo"></div>
        <div class="infoConatiner">
            <h3>Sophie Nadine Jacobs</h3>
            <h4>Leader</h4>
            <p>Hello, my name is Sophie! I am a 19 year old student that is studying in INTI International College Subang for my higher education. I am a Year 2 student in the 4th semester of my degree, and I previously completed a Diploma in Computer Science with a Data Analytics major in INTI Subang. Through this experience, I found Data Analytics a very interesting area to explore and learn more about, which is why I also chose Data Science as the major for my degree. </p>
        </div>
    </div>
    <div class="aboutsec">
        <div class="imageContainer"><img src="images/Photo_GohEnTing.jpg" alt="Goh En Ting's photo"></div>
        <div class="infoConatiner">
            <h3>Goh En Ting</h3>
            <h4>Frontend</h4>
            <p>Hello! I am currently a 19-year-old student pursuing my bachelor's degree at INTI International University & Colleges Subang. The university collaborates with Swinburne University of Technology, which provides me with a unique and enriching educational experience. In my free time, I enjoy exploring new programming projects that can enhance my skills. Additionally, I like to unwind by reading novels and watching YouTube videos.</p>
        </div>    
    </div>
    <div class="aboutsec">
        <div class="imageContainer"><img src="images/Photo_CheeKin.jpg" alt="Ho Chee Kin's photo"></div>
        <div class="infoConatiner">
            <h3>Ho Chee Kin</h3>
            <h4>Design</h4>
            <p>Hi there! I am a 21 year old student pursuing my higher education at INTI International College Subang. I'm a Year 2 student in my course which is the Bachelor Degree in Computer Science majoring in Software Development. I was attracted by the invention of new technologies around the world and that's the reason of taking up Software Development as my major.</p>
        </div>
    </div>
    <div class="aboutsec">
        <div class="imageContainer"><img src="images/Photo_HoePing.jpg" alt="Tan Hoe Ping's photo"></div>
        <div class="infoConatiner">
            <h3>Tan Hoe Ping</h3>
            <h4>Backend</h4>
            <p>Greetings, my name is Tan Hoe Ping, and I'm a 20-year-old student currently enrolled at INTI International College Subang for my higher education. I'm in my second year, currently in the fourth semester of my degree program, where I'm majoring in Software Development. Prior to this, I successfully completed my diploma in Computer Science with a specialization in Cybersecurity. My journey through the realm of computing, IT, and coding has left me genuinely fascinated and eager to explore this dynamic and ever-evolving field.</p>
        </div>
    </div>
    
    <?php
        // Footer
        include_once 'inc/footer.inc';
    ?>
</body>
</html>
