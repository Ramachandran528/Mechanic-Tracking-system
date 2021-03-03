CREATE DATABASE IF NOT EXISTS mechanic_tracking_system;

USE mechanic_tracking_system;

CREATE TABLE IF NOT EXISTS customer_details
(
    c_name VARCHAR(100) NOT NULL,
    c_email VARCHAR(100),
    c_password VARCHAR(100) NOT NULL,
    c_phone_no INT(10) NOT NULL,
    c_door_no VARCHAR(10) NOT NULL,
    c_street_name VARCHAR(100) NOT NULL,
    c_city VARCHAR(100) NOT NULL,
    c_pincode INT(6) NOT NULL,
    c_state VARCHAR(100) NOT NULL,
    c_photo TEXT,
    c_vehicle_name VARCHAR(100),
    c_vehicle_model VARCHAR(100),
    c_vehicle_type VARCHAR(50),
    PRIMARY KEY(c_email)
);

CREATE TABLE IF NOT EXISTS mechanic_details
(
    m_name VARCHAR(100) NOT NULL,
    m_email VARCHAR(100),
    m_password VARCHAR(100) NOT NULL,
    m_phone_no INT(10) NOT NULL,
    m_door_no VARCHAR(10) NOT NULL,
    m_street_name VARCHAR(100) NOT NULL,
    m_city VARCHAR(100) NOT NULL,
    m_pincode INT(6) NOT NULL,
    m_state VARCHAR(100) NOT NULL,
    m_landmark TEXT,
    m_photo TEXT,
    m_exprience INT(3) NOT NULL,
    m_opening_time VARCHAR(20) NOT NULL,
    m_closng_time VARCHAR(20) NOT NULL,
    m_available_at VARCHAR(100) NOT NULL,
    PRIMARY KEY (m_email)
);

CREATE TABLE IF NOT EXISTS login_details
(
    email VARCHAR(100),
    password VARCHAR(100) NOT NULL,
    role VARCHAR(50) NOT NULL,
    PRIMARY KEY(email)
);

CREATE TABLE IF NOT EXISTS booking_details
(
    booking_id INT AUTO_INCREMENT,
    c_email VARCHAR(100),
    m_email VARCHAR(100),
    booking_address VARCHAR(100) NOT NULL,
    vehicle_name VARCHAR(100) NOT NULL,
    vehicle_model VARCHAR(100) NOT NULL,
    vehicle_type VARCHAR(100) NOT NULL,
    repair_description VARCHAR(100) NOT NULL,
    booking_time TIMESTAMP NOT NULL,
    booking_status VARCHAR(20) NOT NULL,
    PRIMARY KEY(booking_id)
);

ALTER TABLE booking_details
ADD CONSTRAINT FOREIGN KEY(c_email) REFERENCES customer_details(c_email);

ALTER TABLE booking_details
ADD CONSTRAINT FOREIGN KEY(m_email) REFERENCES mechanic_details(m_email);