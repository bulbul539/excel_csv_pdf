<?php
if(isset($_POST['submit']))
{
	$connect=mysql_connect("localhost","root","") or die(mysql_error());
	mysql_select_db("ecom2",$connect) or die(mysql_error());
	
	$filename='uploads/'.strtotime("now").'.csv';
	//$filename='uploads/'.strtotime("now").'.xls';
	
	
	$data=mysql_query("select * from search");	
	$row=mysql_fetch_assoc($data);
	$num_rows=mysql_num_rows($data);
	if($num_rows>=1)
	{
			$fp=fopen($filename,"w");
			$seperator = "";
			$column = "";
			
			foreach($row as $name => $value)
			{
				$seperator .= $column . '' . str_replace('','""',$name);
				$column =",";
			}
			$seperator .="\n";
		
			fputs($fp,$seperator);
			
			
			mysql_data_seek($data,0);
			
			while($row=mysql_fetch_assoc($data))
			{	
			$seperator = "";
			$column = "";
			
			foreach($row as $name => $value)
			{
				$seperator .= $column . '' . str_replace('','""',$value);
				$column =",";
			}
			$seperator .="\n";
		
			fputs($fp,$seperator);
			
			}
			fclose($fp);
		}else{
		echo "No records in the databse ";
		}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<form method="post" action="index.php">
<input type="submit" value="submit" name="submit" />
</form>
</body>
</html>
