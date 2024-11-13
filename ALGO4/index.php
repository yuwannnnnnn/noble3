<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	<style>
		body {
		    font-family: Arial, sans-serif;
		    background-color: #f0f4f8;
		    color: #333;
		    padding: 20px;
		    display: flex;
		    flex-direction: column;
		    align-items: center;
		}

		h1 {
		    text-align: center;
		    padding: 15px;
		    color: #1a73e8;
		}

		form {
		    display: flex;
		    justify-content: center;
		    margin: 20px 0;
		}

		form input[type="text"] {
		    padding: 8px;
		    border: 1px solid #ddd;
		    border-radius: 4px;
		    margin-right: 10px;
		    width: 220px;
		    outline: none;
		}

		form input[type="submit"] {
		    background-color: #1a73e8;
		    color: white;
		    border: none;
		    padding: 8px 20px;
		    border-radius: 4px;
		    cursor: pointer;
		    transition: background-color 0.3s;
		}

		form input[type="submit"]:hover {
		    background-color: #155bb5;
		}

		a {
		    text-decoration: none;
		    color: #1a73e8;
		    margin-right: 15px;
		    font-weight: bold;
		}

		a:hover {
		    color: #0a58ca;
		    text-decoration: underline;
		}

		table {
		    width: 90%;
		    max-width: 1000px;
		    margin-top: 20px;
		    border-collapse: collapse;
		    background-color: white;
		    border-radius: 8px;
		    overflow: hidden;
		    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		}

		th, td {
		    padding: 12px;
		    border-bottom: 1px solid #e0e0e0;
		    text-align: left;
		}

		th {
		    background-color: #1a73e8;
		    color: white;
		    font-weight: bold;
		}

		td {
		    color: #555;
		}

		td a {
		    color: #d32f2f;
		    font-weight: bold;
		}

		tr:hover {
		    background-color: #f4f8fd;
		}
	</style>
</head>
<body>

<?php  
	if (isset($_SESSION['message']) && isset($_SESSION['status'])) {
		if ($_SESSION['status'] == "200") {
			echo "<h1 style='color: green;'>{$_SESSION['message']}</h1>";
		} else {
			echo "<h1 style='color: red;'>{$_SESSION['message']}</h1>";	
		}
	}
	unset($_SESSION['message']);
	unset($_SESSION['status']);
?>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="GET">
	<input type="text" name="searchInput" placeholder="Search here">
	<input type="submit" name="searchBtn" value="Search">
</form>

<p><a href="index.php">Clear Search Query</a> | <a href="insert.php">Insert New User</a></p>

<table>
	<tr>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email</th>
		<th>Gender</th>
		<th>Address</th>
		<th>Specialization</th>
		<th>Years of Experience</th>
		<th>Date Added</th>
		<th>Action</th>
	</tr>

	<?php if (!isset($_GET['searchBtn'])) { ?>
		<?php $getAllUsers = getAllUsers($pdo); ?>
		<?php foreach ($getAllUsers as $row) { ?>
			<tr>
				<td><?php echo $row['first_name']; ?></td>
				<td><?php echo $row['last_name']; ?></td>
				<td><?php echo $row['email']; ?></td>
				<td><?php echo $row['gender']; ?></td>
				<td><?php echo $row['address']; ?></td>
				<td><?php echo $row['specialization']; ?></td>
				<td><?php echo $row['years_of_experience']; ?></td>
				<td><?php echo $row['date_added']; ?></td>
				<td>
					<a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
					<a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
				</td>
			</tr>
		<?php } ?>
	<?php } else { ?>
		<?php $searchForAUser = searchForAUser($pdo, $_GET['searchInput']); ?>
		<?php foreach ($searchForAUser as $row) { ?>
			<tr>
				<td><?php echo $row['first_name']; ?></td>
				<td><?php echo $row['last_name']; ?></td>
				<td><?php echo $row['email']; ?></td>
				<td><?php echo $row['gender']; ?></td>
				<td><?php echo $row['address']; ?></td>
				<td><?php echo $row['specialization']; ?></td>
				<td><?php echo $row['years_of_experience']; ?></td>
				<td><?php echo $row['date_added']; ?></td>
				<td>
					<a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
					<a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
				</td>
			</tr>
		<?php } ?>
	<?php } ?>
</table>

</body>
</html>
