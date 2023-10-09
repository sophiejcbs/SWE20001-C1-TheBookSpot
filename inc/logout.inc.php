<?php
//Log out users & administrators
session_start(); //not necessary to start session again, session already started when user logs in, but I do it anyway
session_unset(); //clears session data (user id for the session)
session_destroy(); //end the session and clears session data
header("location: ../index.php"); //redirect to home page
exit();