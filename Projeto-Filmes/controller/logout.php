<?php

if(!isset($_SESSION)){
    session_start();
}
session_destroy();

header("Location: ../views/pages/login.php");