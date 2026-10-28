<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="container">
        <form action="book_reservation.php" method="post">

         <label>Full Name:</label>
        <input type="text" id="na" name="name" placeholder="Enter the name here">
        <br><br>

        <label>Membership Number:</label>
        <input type="text" id="member" name="member" placeholder="Enter the Membership Number">
        <br><br>

       <label> Email Address:</label>
        <input type="email" id="email" name="email" placeholder="abc123@gmail.com" required>
        <br><br>

        <label>Preferred Pickup Date:</label>
        <input type="date" name="date" id="date">
        <br><br>

        <label>Book Category:</label>
        <select id="category" name="category">
            <option value="Fiction">Fiction</option>
            <option value="Non-Fiction">Non-Fiction</option>
            <option value="Reference">Reference</option>
        </select>
        <br><br>
        
        <button type="submit" id="btn" name="submit">submit</button>

        </form>
        </div>

        <script>
            document.getElementById("btn").onclick=function(){
               let name1=document.getElementById("na").value.trim();
               let member=document.getElementById("member").value.trim();
               let email=document.getElementById("email").value.trim();
               let date=document.getElementById("date").value;
               let category=document.getElementById("category").value;
               
                if(name1===""){
                    alert("Name must not be empty");
                    return;
                }
                 if(member===""){
                    alert("Enter membership number");
                    return;
                }
                if(isNaN(member)){
                    alert("Membership number must be numeric");
                    return;
                }
               
                if(email==="" || !email.includes("@")){
                    alert("Email must be in a valid format");
                    return;
                }

                if(date===""){
                    alert("Pickup date must not be empty");
                    return;
                }
                if(category===""){
                    alert("A book category must be selected");
                    return;
                }

                alert("Form Submitted sucessfully");
               
            }
        </script>
    </body>

<div class="output">
<?php
$servername="localhost";
$username="root";
$password="";

$conn=new mysqli($servername,$username,$password);

if($conn->connect_error){
    die("Connection Failed:".$conn->connect_error);
}else{
    echo "Connection Sucessfuly <br>";
}

$sql="CREATE DATABASE IF NOT EXISTS library";

if($conn->query($sql)===TRUE){
    echo "library Database is created Sucessfuly <br>";
}else{
    echo "Error in creating database:".$conn->error;
}
mysqli_select_db($conn,"library");

$sql="CREATE TABLE IF NOT EXISTS resevations(
                                id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                names VARCHAR(30) NOT NULL,
                                membership_no INT(10),
                                email VARCHAR(50),
                                pickup_date DATE,
                                category VARCHAR(20)
                                )";


if($conn->query($sql)===TRUE){
    echo "Reservations Table created sucessfuly <br>";
}else{
    echo "Error in creating table reservation:".$conn->error;
}

if (isset($_POST['submit'])) {

    $name = $_POST['name'] ?? '';
    $member = $_POST['member'] ?? '';
    $email = $_POST['email'] ?? '';
    $date = $_POST['date'] ?? '';
    $category = $_POST['category'] ?? '';

    $sql = "INSERT INTO resevations
            (names, membership_no, email, pickup_date, category)
            VALUES
            ('$name', $member, '$email', '$date', '$category')";

    if ($conn->query($sql) === TRUE) {
        echo "New record added successfully<br>";
        echo "Member Name: <b>$name</b><br>";
        echo "Book Category: <b>$category</b><br>";
        exit();
    } else {
        echo "Error inserting data: " . $conn->error;
    }
}
?>
</div>
</html>


