<?php
/* WRITE THE NECESSARY PHP CODE HERE- NOTE THE $RESULT ARRAY ON LINES 35 AND 36.  YOU WILL NEED TO RETURN
 AN ARRAY THAT CONTAINS TWO INDEXES. FIRST IS A PLACE FOR A MESSAGE (MAYBE BLANK OR NOT DEPENDING 
 ON THE SITUATION) AND THE OTHER IS THE FORM OR THE TABLE DISPLAYING THE DATA 

 The code below errors on line 11 and 15 if ip_address....assignment10/   is clicked.
  because it doesn't recognize 'form' or 'display'
*/

 if(isset($_GET)){
	 if($_GET['page'] === 'form'){
		 require('php/form.php');
		 $result = init();
	 }
	 else if($_GET['page'] === 'display'){
		 require('php/displayRecords.php');
		 //$result[0] = "";
		 //$result[1] = getData();
		 $d = new DisplayRecords();
		 $result = $d->getResult();
	 }
 }
 else{

	 require('php/form.php');
	 $result = init();

}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Final Project</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<style>
			.error {
				color: red;
				margin-left: 5px;
			}
			.space {
				margin-right: 30px;
			}
			nav ul li {
				list-style: none;
			}
			table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

			</style>
	</head>

	<body class="container">
		
		<nav>
			<ul>
				<li><a href="index.php?page=form">Add Contact Information</a></li>
				<li><a href="index.php?page=display">Display All Contacts Information</a></li>
			</ul>
		</nav>
		
		<?php
			// The first element is the acknowlegement, if any.
			echo "<h3 align='center'>$result[0]</h3>"; 

			// The form goes here. Look at form.php to see how the return is done.
			echo $result[1]; 
		?>
	</body>
</html> 