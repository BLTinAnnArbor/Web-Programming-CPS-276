<?php
/*
 The code below errors on line 8 and 12 if ip_address....assignment10/   is clicked. And also if
 an incorrectly filled out form it submitted, it doesn't recognize 'page'
*/

 if(isset($_GET)){
	 if($_GET['page'] == 'form'){
		 require('php/form.php');
		 $result = init();
	 }
	 else if($_GET['page'] == 'display'){
		 require('php/displayRecords.php');
		 
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