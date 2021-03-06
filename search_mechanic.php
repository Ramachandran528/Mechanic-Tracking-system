<?php
include "config.php";

$sql = "SELECT * FROM mechanic_details ";

if (!empty($_POST['m_area']) || !empty($_POST['m_experience']) || !empty($_POST['m_city']))
    $sql .= "WHERE ";

if (isset($_POST['m_area']) && !empty($_POST['m_area'])) {
    $sql .= "m_area='{$_POST["m_area"]}'";
}

if (isset($_POST['m_experience']) && !empty($_POST['m_experience'])) {
    if (!empty($_POST['m_area']))
        $sql .= " AND";
    $sql .= " m_experience={$_POST["m_experience"]}";
}


if (isset($_POST['m_city']) && !empty($_POST['m_city'])) {
    if (!empty($_POST['m_experience']))
        $sql .= " AND";
    $sql .= " m_city='{$_POST["m_city"]}'";
}


if (empty($_POST['m_area']) && empty($_POST['m_experience']) && empty($_POST['m_city']))
    $sql .= " WHERE m_email  not in (SELECT m_email from booking_details WHERE booking_status='accepted' or booking_status='request for payment' or booking_status='booked')";
else
    $sql .= " AND m_email  not in (SELECT m_email from booking_details WHERE booking_status='accepted' or booking_status='request for payment' or booking_status='booked')";



$mechanics = mysqli_query($conn, $sql);
$mechanics = mysqli_fetch_all($mechanics, MYSQLI_ASSOC);



if (count($mechanics) > 0) {
    foreach ($mechanics as $mechanic) {
        echo "<div class='card'>";
        echo "<div class='card-img'><img src='{$mechanic["m_photo"]}' width='100'/></div>";
        $address = "Door No: {$mechanic['m_door_no']} {$mechanic['m_street_name']} {$mechanic['m_area']} {$mechanic['m_city']} {$mechanic['m_pincode']} {$mechanic['m_state']} {$mechanic['m_landmark']}";
        echo "<div class='card-content'>
              <p>Name:{$mechanic['m_name']}</p>
              <p>Email:{$mechanic['m_email']}</p>
              <p>Contact:{$mechanic['m_phone_no']}</p>
              <p>Address:{$address}</p>";
        echo "<p>Experience:{$mechanic['m_experience']} yrs</p>
              </div>
              <div class='buttons'>
                <input type='button' value='book' class='book_btn' data-email='{$mechanic['m_email']}'/>
              </div>
              </div>
             ";
    }
} else
    echo "
    <div class='no_results_found_container'>
        <img src='images/no_results_found.png'/>
    </div>";
