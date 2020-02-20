<?php
session_start();
if(!isset($_SESSION['logged']) || $_SESSION['logged']==false){
	echo '<html><script>window.location.href=".";</script></html>';
	return;
}
$token=$_SESSION['token'];
$cat=$_SESSION['cat'];




?>
<html>
<head>
<script src="source/org/tool-man/core.js"></script>
<script src="source/org/tool-man/events.js"></script>
<script src="source/org/tool-man/css.js"></script>
<script src="source/org/tool-man/coordinates.js"></script>
<script src="source/org/tool-man/drag.js"></script>
<script src="source/org/tool-man/dragsort.js"></script>
<script src="source/org/tool-man/cookies.js"></script>
<script src="source/jquery.min.js"></script>
</head>
<title>
GYMKHANA ELECTIONS
</title>
<style type="text/css">
body{
	background-color: black;
	font-family: Calibri;
	color:white;
}
tr {
  margin-bottom: 20px;
}
.title{
	color: rgb(150,150,150);
	font-size: 42px;
}
.person_icon{
	width:180px;
	height:180px;
}
.person_box{
	display: inline-block;
	margin-left: 20px;
	margin-top: 20px;
	height: 190px;
	position: relative;
}
.person_name{
	position:absolute;
	top:190px;
	text-align: center;
	width:180px;
}
/* li{
  background-color: rgba(150,150,150,0.5);
  border-radius:10px;
  -webkit-border-radius:10px;
  -moz-border-radius:10px;
  height:40px;
  width:275px;
  padding:8px;
  text-align:center;
  box-sizing:border-box;
  margin-top:5px;
  cursor:pointer;
} */
.red{
	background-color: rgba(150,50,50,0.5);
}
.green{
	background-color: rgba(50,150,50,0.5);
}
ul{
	list-style-type:none;
}
td{
	text-align: center;
}
center {
  margin-top: 30px;
}
.inputGroup {
  background-color: rgba(150,150,150,0.5);
  display: block;
  margin: 10px 0;
  position: relative;
}
.inputGroup label {
  padding: 12px 30px;
  width: 100%;
  display: block;
  text-align: left;
  color: #fff;
  cursor: pointer;
  position: relative;
  z-index: 2;
  transition: color 200ms ease-in;
  overflow: hidden;
  float: left;
  background-color: rgba(150,150,150,0.5);
}
.inputGroup label:before {
  width: 10px;
  height: 10px;
  border-radius: 50%;
  content: '';
  background-color: #5562eb;
  position: absolute;
  left: 50%;
  top: 50%;
  -webkit-transform: translate(-50%, -50%) scale3d(1, 1, 1);
          transform: translate(-50%, -50%) scale3d(1, 1, 1);
  transition: all 300ms cubic-bezier(0.4, 0, 0.2, 1);
  opacity: 0;
  z-index: -1;
}
.inputGroup label:after {
  width: 32px;
  height: 32px;
  content: '';
  border: 2px solid #D1D7DC;
  background-color: #fff;
  background-image: url("data:image/svg+xml,%3Csvg width='32' height='32' viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5.414 11L4 12.414l5.414 5.414L20.828 6.414 19.414 5l-10 10z' fill='%23fff' fill-rule='nonzero'/%3E%3C/svg%3E ");
  background-repeat: no-repeat;
  background-position: 3.5px 3px;
  border-radius: 50%;
  z-index: 2;
  position: absolute;
  right: 30px;
  top: 50%;
  -webkit-transform: translateY(-50%);
          transform: translateY(-50%);
  cursor: pointer;
  transition: all 200ms ease-in;
}
.inputGroup input:checked ~ label {
  color: #fff;
}
.inputGroup input:checked ~ label:before {
  -webkit-transform: translate(-50%, -50%) scale3d(56, 56, 1);
          transform: translate(-50%, -50%) scale3d(56, 56, 1);
  opacity: 1;
}
.inputGroup input:checked ~ label:after {
  background-color: #54E0C7;
  border-color: #54E0C7;
}
.inputGroup input {
  width: 32px;
  height: 32px;
  order: 1;
  z-index: 2;
  position: absolute;
  right: 30px;
  top: 50%;
  -webkit-transform: translateY(-50%);
          transform: translateY(-50%);
  cursor: pointer;
  visibility: hidden;
}
.form {
  padding: 0 16px;
  max-width: 550px;
  margin: 50px auto;
  font-size: 18px;
  font-weight: 600;
  line-height: 36px;
}
.ordering {
  padding-top: 90px;
}
#submit {
  margin-top: 90px;
}
</style>
<body>
<center>
<h1 class="title">ELECTIONS </h1>
<br>
Following are the candidates. Arrange them in the order of your preference.
Candidates above &quot;Don&apos;t consider the below&quot; will get preference in descending order<br><br>
<table>
<tr>
<th>Candidates</th>
<th>Preference order</th>
</tr>
<?php
require_once 'names.php';

for($j=0;$j<count($data);$j++){
	if($cat == "PHD" && ($j==7 || $j==8)) // PHD
		continue;

	if($cat == "PG" && ($j==7 || $j==8)) // PG
		continue;
?>
<tr>

<td width=500>
<?php
	echo "<center><br><br><br>VOTE FOR : ".$data[$j][0]."</center><br>";
	for($i=2;$i<=count($data[$j]);$i++){
		echo '<div class="person_box"><img class="person_icon" src="images/'.$data[$j][$i-1].'.jpg"/><div class="person_name">'.$data[$j][$i-1].'</div></div>';
	}

?>

</td>

<td width=500 class="ordering">
<center>

<ul id="<?php echo $data[$j][0];?>">

<li id="p0" class="inputGroup"><input type="radio" id="<?php echo $data[$j][0] . 'none';?>" name="<?php echo $data[$j][0] . $data[$j][0];?>" value="None Of the above" checked><label for="<?php echo $data[$j][0] . 'none';?>">None Of the above</label></li>

<?php
for($i=2;$i<=count($data[$j]);$i++) {
    echo '<li id="'.($data[$j][$i-1]).'" class="inputGroup"><input type="radio" id="'.$data[$j][$i-1].($data[$j][$i-1]).'" name="'.($data[$j][0] . $data[$j][0]).'" value="'.$data[$j][$i-1].'"><label for="'.$data[$j][$i-1].($data[$j][$i-1]).'">'.$data[$j][$i-1].'</label></li>';
}
?>
</ul>
</center>
</td>
</tr>
<?php
}
?>
</table>
<input type="button" value="Vote" id="submit"/>
</center>
<script>
document.getElementById('submit').onclick=function(){
	if(confirm("Are you sure about what you have chosen?"))
		post('submit_final.php', {string: gen_final()});
}
gen_final=function(){
    console.log("General Final")
	main_string="";
    myString="";
	for (n=0;n<document.getElementsByTagName('ul').length;n++){
		arr=generate_list(n);
        ULElement = document.getElementsByTagName('ul')[n];
        position = ULElement.id;
        children = ULElement.children;
        positionString = myString === "" ? position :  "$"+position;
        notChosen = [];
        choice = ";";
        for(var lol = 0; lol < children.length; lol++) {
            element = children[lol];
            if(element.firstElementChild.checked && element.firstElementChild.value != "None Of the above") {
                choice = "," + element.firstElementChild.value + ";";
            } else if(element.firstElementChild.value != "None Of the above"){
                notChosen.push(element.firstElementChild.value);
            }
        }
        positionString += choice;
        for(var k = 0; k < notChosen.length; k++ ) {
            positionString += notChosen[k];
            if(k != (notChosen.length -1)) {
                positionString += ",";
            }
        }
        console.log(positionString);
        myString += positionString;
		string=document.getElementsByTagName('ul')[n].id;
		for(l=0;l<arr.length;l++)
			{
			if(arr[l] == ";")
			string+=";";
			else
			{
			if(arr[l-1] == ";")
			string+=arr[l];
			else
			string+=(","+arr[l]);


			}
			}
		main_string+=string+"$";
	}
	main_string = main_string.substring(0, main_string.length - 1);
	return myString;

}
generate_list=function(n){
	var ul=document.getElementsByTagName('ul')[n];
	var lis=ul.getElementsByTagName('li');
	result=[];
	for(i=0;i<lis.length;i++){
		if(lis[i].id=="p0")
			result.push(";");
		else
		result.push(lis[i].id);
	}
	return result;
}
function shuffle_post(i)
{
	//var ul=$('ul')[i];
	var ul=i;
	console.log(ul);
	$('li',ul).sort(function(x,y){

		if($(x).html()=="Dont consider the below")
			return -1;
		if($(y).html()=="Dont consider the below")
			return 1;
		return Math.round(Math.random())-0.5}).appendTo(ul);
}
/*for (k=0;k<document.getElementsByTagName('ul').length;k++){
	shuffle_post($('ul')[k]);
}*/
function post(path, params, method) {
    method = method || "post"; // Set method to post by default if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
         }
    }

    document.body.appendChild(form);
    form.submit();
}
//shuffle_post('ul');
// $('li').mouseup(function(){$(this).css({"cursor":"pointer"});});
// $('li').mousedown(function(){$(this).css({"cursor":"ns-resize"});});
//document.onmouseup=recolor;
//recolor();
</script>
</body>
</html>
