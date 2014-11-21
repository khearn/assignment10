HOW TO DO SELECT STATEMENTS

$sql = "SELECT ALL THE THINGS FOR STUFF"

$result = mysqli_query($connect, $sql);

if (mysqli_num_rows($result) > 0)
{
while($row = $result->fetch_assoc())
{ $row["fldName"]
}} 