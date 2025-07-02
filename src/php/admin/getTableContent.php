<?php
include './../../db/config.php';

$tableName = $_GET['table'];

$sql = "SELECT * FROM " . $tableName;

$result = $conn->query($sql);

$table = "<table border='1' cellspacing='0'>";
?>
<h1 style="text-transform: capitalize;color: #333;"><?php echo $tableName; ?></h1><hr>
<div class="add-icon" onclick="location.href='insertData.php?table=<?php echo $tableName; ?>';" >
<p>Add More</p>
<i class="fa-solid fa-plus"></i>
</div>
<?php
if ($result->num_rows > 0) {
    // Construct table header row with column names
    $table .= "<tr>";
    $row = $result->fetch_assoc();
    foreach ($row as $column => $value) {
        $table .= "<th>" . $column . "</th>";
    }
    $table .= "<th>Actions</th>";
    $table .= "</tr>";
    // Construct table data rows with values
    $table .= "<tr>";
    foreach ($row as $column => $value) {
        $table .= "<td>" . $value . "</td>"; 
    }
    $table .= "<td><a href='deleteData.php?id=" . $row['id'] . "&table=" . $tableName . "'>Delete</a> | <a href='updateData.php?id=" . $row['id'] . "&table=" . $tableName . "'>Update</a></td>";
    $table .= "</tr>";
    while ($row = $result->fetch_assoc()) {
        $table .= "<tr>";
        foreach ($row as $column => $value) {
            $table .= "<td>" . $value . "</td>";
        }
        $table .= "<td><a href='deleteData.php?id=" . $row['id'] . "&table=" . $tableName . "'>Delete</a> | <a href='updateData.php?id=" . $row['id'] . "&table=" . $tableName . "'>Update</a></td>";
        $table .= "</tr>";
    }
} else {
    $table .= "<tr><td colspan='100%'>No data found.</td></tr>";
}
$table .= "</table>";

echo $table;
