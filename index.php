
<form method="post"enctype="multipart/form-data" action="index2.php" >
Name:<input type="text" name="name" 
placeholder="Enter name">
<br><br>
<?php
$con= new mysqli ('localhost','root','','office');
$result= $con->query("SELECT COUNT(DISTINCT
 department)AS
 department FROM employee")->fetch_all(1);
$con->close();
?>
Department: <?php  print_r($result[0]['department'])?>
<select name="Department">
<option>HR</option>
<option>IT</option>
<option>FINANCE</option>
<option>MARKETING</option>
<option>SALES</option>
<option>OPERATIONS</option>

</select>
<br><br>
Salary:<input type="number" name="Salray"
 placeholder="Enter salary" >
<br><br>
Gender:male<input type="radio" name="gender">
female<input type="radio" name="gender">
<br><br>
<?php
$con= new mysqli ('localhost','root','','office');
$result= $con->query("SELECT COUNT(DISTINCT city)AS
 city FROM employee")->fetch_all(1);
$con->close();
?>
city:<?php echo ($result[0]['city']) ?>
<select name="city">
<option>Mumbai</option>
<option>bikaner</option>
<option>udaipur</option>
<option>kota</option>
<option>surat</option>
<option>nagpur</option>
<option>chandigarh</option>
<option>amritsar</option>
<option>Jaisalmer</option>
<option>jaipur</option>
<option>jodhpur</option>
</select>
<br><br>
File:
    <input type="file" name="upfiles">
    <br>
    <button type="submit">upload</button>
</form>

