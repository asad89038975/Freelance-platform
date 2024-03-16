<?php  
	include_once("connection.php");
	 if(isset($_POST["query"]))  
	 {  
	      $output = '';  
	      $query = "SELECT * FROM skills WHERE skill_name LIKE '%".$_POST["query"]."%'";  
	      $result = mysqli_query($connection, $query);  
	      $output = '<ul class="list-unstyled">';  
	      if(mysqli_num_rows($result) > 0)  
	      {  
	           while($row = mysqli_fetch_array($result))  
	           {  
	                $output .= '<li class="p-2">'.$row["skill_name"].'</li>';  
	           }  
	      }  
	      else  
	      {  
	           $output .= '<li>Skill Not Found</li>';  
	      }  
	      $output .= '</ul>';  
	      echo $output;  
	 }  
 ?>  