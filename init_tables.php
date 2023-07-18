<?php
include "config.php";

$sqlQueries = array(
    "CREATE TABLE HOTEL(
        Hotel_id INT(10),
        H_contact_no INT(11),
        FOREIGN KEY (Hotel_id) REFERENCES HOTEL_INFO(Hotel_id),
        PRIMARY KEY (Hotel_id,H_contactno)
    )",
    "CREATE TABLE HOTEL_INFO(
        Hotel_id INT(10) PRIMARY KEY,
        Hotel_name VARCHAR(50) NOT NULL,
        H_address VARCHAR(50) NOT NULL,
        facilities VARCHAR(50)
    )",
    "CREATE TABLE CLASSIC(
        room_no INT(3) PRIMARY KEY,
        Hotel_id INT(10),
        price VARCHAR(5) NOT NULL,
        status VARCHAR(10) NOT NULL,
        capacity INT(2),
        FOREIGN KEY (Hotel_id) REFERENCES HOTEL_INFO(Hotel_id)
    )",
    "CREATE TABLE DELUXE(
        room_no INT(3) PRIMARY KEY,
        Hotel_id INT(10),
        price VARCHAR(5) NOT NULL,
        status VARCHAR(10) NOT NULL,
        capacity INT(2),
        FOREIGN KEY (Hotel_id) REFERENCES HOTEL_INFO(Hotel_id)
    )",
    "CREATE TABLE RESERVATION(
        res_id INT(5) PRIMARY KEY,
        check_out_date VARCHAR(10) NOT NULL,
        check_in_date VARCHAR(10) NOT NULL,
        no_of_guests INT(2) NOT NULL,
        payment_status VARCHAR(10) NOT NULL
    )",
    "CREATE TABLE GUEST_INFO (
        cust_id INT(5) PRIMARY KEY,
        F_name VARCHAR(50) NOT NULL,
        L_name VARCHAR(50) NOT NULL,
        payment_info VARCHAR(50) NOT NULL,
        DOB VARCHAR(10),
        CNIC INT(13) NOT NULL,
        FOREIGN KEY (DOB) REFERENCES DOB_G(DOB)
    )",
    "CREATE TABLE GUEST(
        phoneno BIGINT(11),
        cust_id INT(5),
        FOREIGN KEY (cust_id) REFERENCES GUEST_INFO(cust_id),
        PRIMARY KEY (phoneno,cust_id)
    )",
    "CREATE TABLE DOB_G(
        DOB VARCHAR(10) PRIMARY KEY,
        age INT(2)
    )",
    "CREATE TABLE BUSINESS_GUEST_INFO(
        cust_id INT(5) PRIMARY KEY,
        F_name VARCHAR(50) NOT NULL,
        L_name VARCHAR(50) NOT NULL,
        payment_info VARCHAR(50) NOT NULL,
        DOB VARCHAR(10),
        NTN VARCHAR(9) NOT NULL,
        FOREIGN KEY (DOB) REFERENCES DOB_G(DOB)
    )",
    "CREATE TABLE BUSINESS_GUEST(
        phoneno BIGINT(11),
        cust_id INT(5),
        FOREIGN KEY (cust_id) REFERENCES GUEST_INFO(cust_id),
        PRIMARY KEY (phoneno,cust_id)
    )",
    "CREATE TABLE DOB_BG(
        DOB VARCHAR(10) PRIMARY KEY,
        age INT(2)
    )",
    "CREATE TABLE EMPLOYEE_INFO(
        emp_id INT(3) PRIMARY KEY,
        e_name VARCHAR(50),
        position VARCHAR(10),
        salary VARCHAR(10)
    )",
    "CREATE TABLE EMPLOYEE(
        emp_id INT(3),
        e_contact VARCHAR(11),
        FOREIGN KEY (emp_id) REFERENCES EMPLOYEE_INFO(emp_id),
        PRIMARY KEY(emp_id,e_contact)
    )",
    "CREATE TABLE ROOM_INFO(
       room_id INT(11),
       room_type VARCHAR(20),
    )",
    "CREATE TABLE SERVICE(
        res_id INT(5),
        service_id INT(5),
        s_name INT(5),
        s_price VARCHAR(10),
        availability VARCHAR(10),
        des VARCHAR(50),
        FOREIGN KEY (res_id) REFERENCES RESERVATION(res_id),
        PRIMARY KEY(res_id,service_id)
    )"
);

// Create a PDO connection
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Execute each SQL query
    foreach ($sqlQueries as $query) {
        $conn->exec($query);
        echo "Table created successfully: $query<br>";
    }
} catch(PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}
echo "just checkin";
// Close the connection
$conn = null;
?>