<html>
    <body>
        <table id="table1" border="1">
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Membership Number</th>
                <th>Email Address</th>
                <th>Preferred Pickup Date</th>
                <th>Book Category</th>
                <td>Action</td>
            </tr>
        

 <?php
 $conn=new mysqli("localhost","root","","library");

 $sql="SELECT * FROM resevations";

 $result=$conn->query($sql);

 while($row=$result->fetch_assoc()){
    echo "<tr>
              <td>".$row['id']."</td>
              <td>".$row['names']."</td>
              <td>".$row['membership_no']."</td>
              <td>".$row['email']."</td>
              <td>".$row['pickup_date']."</td>
              <td>".$row['category']."</td>
              <td>
                <a href='?delete_id={$row['id']}'
                   onclick=\"return confirm('Delete?')\">Delete</a>
              </td>
</tr> ";

 }
//delete
 if(isset($_GET["delete_id"])){

    $id = $_GET["delete_id"];
    mysqli_query($conn,"DELETE FROM resevations WHERE id=$id");

    header("Location: manage_reservations.php");
}

?>
</table>

<button id="btn1">Sortby Name</button><br><br>
<button id="btn2">Sortby Date</button><br><br>

<script>
 //sort by name
 document.getElementById("btn1").onclick=function(){

 let table = document.getElementById("table1");
let rows = Array.from(table.rows).slice(1);

  rows.sort(function (a, b) {
    return a.cells[1].innerText.localeCompare(b.cells[1].innerText);
  });

  for(let i = 0; i < rows.length; i++){
        table.appendChild(rows[i]);
    }
   }
    

   //sort by date
 document.getElementById("btn2").onclick=function(){

  let table = document.getElementById("table1");
  let rows = Array.from(table.rows).slice(1);

  rows.sort(function (a, b) {
   
    return new Date(b.cells[4].innerText) - new Date(a.cells[4].innerText);
  });

  rows.forEach(row => table.appendChild(row));
}

</script>

</body>
</html>
