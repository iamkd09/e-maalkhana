<?php
require_once("./conn.php");

if (!empty($_POST["categorycode"])) {
  $categorycode = $_POST["categorycode"];
  $q = mysqli_query($conn, "SELECT sub_category.id as `id`, sub_category.name as `name` FROM sub_category WHERE sub_category.category_id = '$categorycode'");
?>
  <option value="">Sub-category</option>
  <?php
  while ($row1 = mysqli_fetch_array($q)) {
  ?>
    <option value="<?php echo $row1["id"]; ?>"><?php echo $row1["name"]; ?></option>
  <?php
  }
}
?>
