<?php
require_once("./conn.php"); 
if(!empty($_POST["statecode"])) 
{
$statecode=$_POST["statecode"];
$q =mysqli_query($conn,"SELECT city.id as `id`, city.name as `name` FROM city WHERE city.state_id = '$statecode'");
?>
<option value="">Select City</option>
<?php
while($row1=mysqli_fetch_array($q))  
{
?>
<option value="<?php echo $row1["id"]; ?>"><?php echo $row1["name"]; ?></option>
<?php
}
}
?>