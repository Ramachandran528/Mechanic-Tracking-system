<?php
include "config.php";

$sql = "SELECT * FROM mechanic_details ";

if (!empty($_POST['m_pincode']) || !empty($_POST['m_experience']) || !empty($_POST['m_city']))
    $sql .= "WHERE ";

if (isset($_POST['m_pincode']) && !empty($_POST['m_pincode'])) {
    $sql .= "m_pincode='{$_POST["m_pincode"]}'";
}

if (isset($_POST['m_experience']) && !empty($_POST['m_experience'])) {
    if (!empty($_POST['m_pincode']))
        $sql .= " AND";
    $sql .= " m_experience={$_POST["m_experience"]}";
}


if (isset($_POST['m_city']) && !empty($_POST['m_city'])) {
    if (!empty($_POST['m_experience']))
        $sql .= " AND";
    $sql .= " m_city='{$_POST["m_city"]}'";
}


$mechanics = mysqli_query($conn, $sql);
$mechanics = mysqli_fetch_all($mechanics, MYSQLI_ASSOC);



if (count($mechanics) > 0) {
    foreach ($mechanics as $mechanic) {
        echo "<div class='card'>";
        if ($mechanic["m_photo"] == "")
            echo "<img src='images/default-image.jpg' width='100'/>";
        else
            echo "<img src='{$mechanic["m_photo"]}' width='100'/>";
        $address = "Door No: {$mechanic['m_door_no']} {$mechanic['m_street_name']} {$mechanic['m_city']} {$mechanic['m_pincode']} {$mechanic['m_state']}";
        echo "<p>Name:{$mechanic['m_name']}</p>
              <p>Email:{$mechanic['m_email']}</p>
              <p>Contact:{$mechanic['m_phone_no']}</p>
              <p>Address:{$address}</p>
              <p>Landmark:{$mechanic['m_landmark']}</p>
              <p>Experience:{$mechanic['m_experience']} yrs</p>
              <p>Opening Time:{$mechanic['m_opening_time']}</p>
              <p>Closing Time:{$mechanic['m_closing_time']}</p>
              <input type='button' value='book' class='book_btn'/>
              </div>
              <hr/>
             ";
    }
} else
    echo "No results found";