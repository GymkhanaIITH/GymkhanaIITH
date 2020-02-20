

<?php

$pass = $_POST['pass'];

if($pass == "Electi0n$@dm1n")
{
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Results Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>
      img{
          height:200px;
      }
  </style>
</head>
<body>

<div class="container">




<?php

require_once 'connect.php';
require_once 'names.php';
foreach($data as $d)
{

$disqualified = [];



$result=mysqli_query($db_server, "SELECT * from votesperpost where Post='$d[0]'");
    if(mysqli_num_rows( $result) > 0)
    {
    $row=mysqli_fetch_row( $result);

        $count = $row[2];
        }

?>
  <table class="table table-bordered">
      <thead><tr><th colspan="100%"><strong><center><?php echo $d[0]." (Total Votes - ".$count.")"; ?></center></strong></th></tr></thead>
      <tbody>
          <tr>
<?php

$pref1 = [];
$pref2 = [];
$pref0 = [];

$crit60 = 0;

for($i = 1; $i < count($d); $i++)
{


?>
 <td><table class="table table-bordered">
    <thead>
      <tr>
        <th><?php echo $d[$i] ?></th>
        <th>Preference of Votes</th>
        <th>Number of Votes</th>
      </tr>
    </thead>
    <tbody>

<?php

$result=mysqli_query($db_server,"SELECT * from votes where person='$d[$i]' and place=1");


$vpref1 = mysqli_num_rows($result);

$result=mysqli_query($db_server, "SELECT * from votes where person='$d[$i]' and place=2");
$vpref2 = mysqli_num_rows( $result);


$result=mysqli_query($db_server, "SELECT * from votes where person='$d[$i]' and place=0");
$vpref0 = mysqli_num_rows( $result);
echo '
  <tr>
        <td rowspan="3"><img src="images/'.$d[$i].'.jpg" alt="" /></td>
        <td>1st Preference</td>
        <td>'.$vpref1.'</td>
      </tr>
      <tr>

        <td>2nd Preference</td>
        <td>'.$vpref2.'</td>
      </tr>
      <tr>

        <td>No Preference</td>
        <td>'.$vpref0.'</td>
      </tr>';






?>
  <tr>
        <td colspan="3">
        <strong><?php
        if( $vpref1+$vpref2+$vpref0 != 0 && ($vpref1+$vpref2)/($vpref1+$vpref2+$vpref0) > 0.66)
{
$crit60 = 1;
$pref1[] = $vpref1;
$pref2[] = $vpref2;
$pref3[] = $vpref3;

}

        else
        {
echo "The person does not qualify 66% votes criteria.";
$disqualified[] = $d[$i];
}

?></strong></td>
      </tr>
    </tbody>
  </table></td>
    
<?php
}
?>
<tr>
<td colspan="100%"><center>
  <strong>Result : </strong>
<?php

if(count($pref1) == 1)
{
if(in_array($d[1], $disqualified))
echo "<strong>".$d[2]." won</strong>";
else
echo "<strong>".$d[1]." won</strong>";
}


if(count($pref1) == 2)
{
if($pref1[0] > $pref1[1])
{
echo "<strong>".$d[1]." won by ".($pref1[0] - $pref1[1])." votes.</strong>";
}
else if($pref1[0] == $pref1[1])
{

if($pref2[0] > $pref2[1])
{
echo "<strong>".$d[1]." won by ".($pref2[0] - $pref2[1])." votes in second preference.</strong>";

}
else if($pref2[0] == $pref2[1])
{
echo "<strong>TIE</strong>";
}
else
{
echo "<strong>".$d[2]." won by ".($pref2[1] - $pref2[0])." votes in second preference.</strong>";
}


}
else
{
echo "<strong>".$d[2]." won by ".($pref1[1] - $pref1[0])." votes.</strong>";
}


}


if($crit60 == 0)
{
echo "No one could qualify the minimum 66% votes criteria.";
}

?>
</center>
            </td>

</tr>
      </tbody>
   </table>

  <?php
}

/*
$result=mysqli_query("SELECT person,sum(place) FROM `votes` group by person order by sum(place) desc;");
for($i=0;$i<mysqli_num_rows( $result);$i++){
    $row=mysqli_fetch_row( $result);
    $name=$data[intval(str_replace('p','',$row[0]))-1];
    echo '<tr><td>'.$name.'</td><td>'.$row[1].'</td></tr>';
}
*/

?>
</div>

</body>
</html>
<?php 
} else
{
?>
            <form method="POST">
            Pass <input type="password" name="pass"></input><br/>
            <input type="submit" name="submit" value="Go"></input>
            </form>
    <?php 
} 
?>

