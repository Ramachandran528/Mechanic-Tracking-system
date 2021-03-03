<?php

session_start();
$email = $_SESSION["email"];
include "config.php";

$sql = "UPDATE mechanic_details
          SET m_name='{$_POST['m_name']}',
              m_phone_no={$_POST['m_phone_no']},
              m_door_no={$_POST['m_door_no']},
              m_pincode={$_POST['m_pincode']},
              m_city='{$_POST['m_city']}',
              m_state='{$_POST['m_state']}',
              m_landmark='{$_POST['m_landmark']}',
              m_experience={$_POST['m_experience']},
              m_opening_time='{$_POST['m_opening_time']}',
              m_closing_time='{$_POST['m_closing_time']}'
        WHERE m_email='$email'
              ";
$query_result = mysqli_query($conn, $sql);
if ($query_result)
    echo "1";
else
    echo "-1";
