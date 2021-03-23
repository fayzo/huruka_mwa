<?php
include('../init.php');

	if (isset($_POST['key'])) {

		if ($_POST['key'] == 'viewORedit') {
			$conn =$db;
			$rowID = $conn->real_escape_string($_POST['rowID']);
			$sql = $conn->query("SELECT firstname, lastname, username, password,
			 email, country FROM users WHERE user_id='$rowID'");
			$data = $sql->fetch_array();
			$jsonArrays = array(
				'firstname'=> $data['firstname'],
                'lastname'=> $data['lastname'],
                'username'=> $data['username'],
                'password'=> $data['password'],
                'email'=> $data['email'],
                // 'address'=> $data['address'],
                // 'address2'=> $data['address2'],
                'country'=> $data['country'],
                // 'state'=> $data['state'],
			);
			
			exit(json_encode($jsonArrays));
 		}

		if ($_POST['key'] == 'fetch_admin') {
			$conn =$db;
			$start = $conn->real_escape_string($_POST['start']);
			$limit = $conn->real_escape_string($_POST['limit']);

			$sql = $conn->query("SELECT * FROM users WHERE approval='on' ORDER BY date_registry DESC LIMIT $start, $limit");
			if ($sql->num_rows > 0) {
				$response = "";
				$increment=0;
				while($row = $sql->fetch_array()) {
			     	$increment++;
					$response .= '
						<tr>
							<td>'.$increment.'</td>
							<td  style="width:100px;"id="firstname'.$row["user_id"].'">'.$row["firstname"].'</td>
							<td  style="width:100px;"id="lastname'.$row["user_id"].'">'.$row["lastname"].'</td>
							<td  style="width:100px;"id="username'.$row["user_id"].'">'.$row["username"].'</td>
							<td  style="width:100px;"id="password'.$row["user_id"].'">'.$row["password"].'</td>
							<td  style="width:100px;"id="email'.$row["user_id"].'">
						    '.
                            (strlen($row["email"]) > 20 ?
                            $row["email"] = substr($row["email"],0,10)."..."
                            : $row["email"])
							.'
							</td>
							<td  style="width:100px;"id="country'.$row["user_id"].'">'.$row["country"].'</td>
						</tr>
						<tr><td colspan="7" align="right">
							<input type="button" onclick="viewORedits('.$row["user_id"].', \'edit\')" value="Edit" class="btn btn-primary">
							<input type="button" onclick="viewORedits('.$row["user_id"].', \'view\')" value="View" class="btn">
							<input type="button" onclick="deleteRow('.$row["user_id"].')" value="Delete" class="btn btn-danger">
							<button type="button" name="update_profile_id" id="'.$row["user_id"].'" class="btn btn-primary update_profile_id" role="button"><span class="fa fa-image"></button>
							<input type="button" onclick="approved('.$row["user_id"].', \'off\')" value="off" class="btn btn-warning ">
							</td>
						</tr>
					';
				}
				exit($response);
			} else
				exit('Max');
		}

		if ($_POST['key'] == 'fetch_admin1') {
			$conn =$db;
			$start = $conn->real_escape_string($_POST['start']);
			$limit = $conn->real_escape_string($_POST['limit']);

			$sql = $conn->query("SELECT * FROM users WHERE approval='off' ORDER BY date_registry DESC LIMIT  $start, $limit");
			if ($sql->num_rows > 0) {
				$response = "";
				$increment=0;
				while($row = $sql->fetch_array()) {
			     	$increment++;
					$response .= '
						<tr>
							<td>'.$increment.'</td>
							<td  style="width:100px;"id="firstname'.$row["user_id"].'">'.$row["firstname"].'</td>
							<td  style="width:100px;"id="lastname'.$row["user_id"].'">'.$row["lastname"].'</td>
							<td  style="width:100px;"id="username'.$row["user_id"].'">'.$row["username"].'</td>
							<td  style="width:100px;"id="password'.$row["user_id"].'">'.$row["password"].'</td>
							<td  style="width:100px;"id="email'.$row["user_id"].'">
						    '.
                            (strlen($row["email"]) > 20 ?
                            $row["email"] = substr($row["email"],0,10)."..."
                            : $row["email"])
							.'
							</td>
							<td  style="width:100px;"id="country'.$row["user_id"].'">'.$row["country"].'</td>
						</tr>
						<tr><td colspan="7" align="right">
								<input type="button" onclick="viewORedits('.$row["user_id"].', \'edit\')" value="Edit" class="btn btn-primary">
								<input type="button" onclick="viewORedits('.$row["user_id"].', \'view\')" value="View" class="btn">
								<input type="button" onclick="deleteRow('.$row["user_id"].')" value="Delete" class="btn btn-danger">
								<button type="button" name="update_profile_id" id="'.$row["user_id"].'" class="btn btn-primary update_profile_id" role="button"><span class="fa fa-image"></button>
								<input type="button" onclick="approved('.$row["user_id"].', \'on\')" value="on" class="btn btn-warning">
							</td>
						</tr>

					';
				}
				exit($response);
			} else
				exit('Max');
		}

		if ($_POST['key'] == 'image') {
        	$rowID = $db->real_escape_string($_POST['id']);
        	$sql = $db->query("SELECT user_id, username, profile_img , cover_img FROM users WHERE user_id=' $rowID'");
        	$data = $sql->fetch_array();
        	$jsonArrays = array(
        		'user_id' => $data['user_id'],
        		'username' => $data['username'],
        		'profile_image' => $data['profile_img'],
        		'cover_image' => $data['cover_img'],
        	);
        	exit(json_encode($jsonArrays));
		}

		$rowID = $db->real_escape_string($_POST['rowID']);

		if ($_POST['key'] == 'on') {
			$conn =$db;
	 		$conn->query("UPDATE users SET approval='on' WHERE user_id='$rowID'");
			exit('success');
		}
		 if ($_POST['key'] == 'off') {
			$conn =$db;
	 		$conn->query("UPDATE users SET approval='off' WHERE user_id='$rowID'");
			exit('success');
		}

		if ($_POST['key'] == 'deleteRow') {
			$conn->query("DELETE FROM add_admin WHERE user_id='$rowID'");
			exit('The Row Has Been Deleted!');
		}

		$firstname = $conn->real_escape_string($_POST['firstname']);
		$lastname = $conn->real_escape_string($_POST['lastname']);
		$username = $conn->real_escape_string($_POST['username']);
		$password = $conn->real_escape_string($_POST['password']);
		$email = $conn->real_escape_string($_POST['email']);
		$address = $conn->real_escape_string($_POST['address']);
		$address2 = $conn->real_escape_string($_POST['address2']);
		$country = $conn->real_escape_string($_POST['country']);
		$state = $conn->real_escape_string($_POST['state']);

		if ($_POST['key'] == 'update_Row') {
			$conn->query("UPDATE add_admin SET firstname='$firstname', lastname='$lastname',
			 username='$username', password='$password',email='$email', address2='$address2',
			  address='$address', country='$country', state='$state' WHERE user_id='$rowID'");
			exit('success');
		}

		if ($_POST['key'] == 'add_admin') {
			$sql = $conn->query("SELECT * FROM add_admin WHERE lastname = '$lastname'");
			if ($sql->num_rows > 0)
				exit("Country With This Name Already Exists!");
			else {
				$conn->query("INSERT INTO add_admin (firstname, lastname, username, password, email, address, address2, country, state) 
							VALUES ('$firstname', '$lastname', '$username', '$password','$email','$address','$address2','$country','$state')");
				exit('Country Has Been Inserted!');
			}
		}
		$conn->close();
	}
?>