<?php
session_start();
if (session_unset() && session_destroy())
    header("Location:index.php");
