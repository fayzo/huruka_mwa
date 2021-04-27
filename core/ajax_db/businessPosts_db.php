<?php
include('../init.php');

if (isset($_POST['key'])) {

	// strip_tags($_GET['id']); remove script tags

        if ($_POST['key'] == 'edit') {
			$rowID = $db->real_escape_string($_POST['rowID']);
			$businessID = $db->real_escape_string($_POST['businessID']);
			$data= $users->selects('jobs',
			array(
				'job_title'=> 'job_title', 
				'job_summary'=> 'job_summary', 
				// 'responsibilities_duties'=> 'responsibilities_duties', 
				// 'qualifications_skills'=> 'qualifications_skills', 
				// 'conditions'=> 'conditions', 
				'deadline'=> 'deadline', 
		  		'website'=> 'website', 
		    	'categories_jobs' => 'categories_jobs',
				'business_id'=> 'business_id', 
				'created_on'=> 'created_on', 

			),array(
				 'job_id'=> $rowID,
				 'business_id'=> $businessID,
			));

			$jsonArrays = array(
				'job_title'=> $data['job_title'],
				'job_summary'=>  htmlspecialchars_decode($data['job_summary']),
                // 'responsibilities_duties'=> $data['responsibilities_duties'],
                // 'qualifications_skills'=> $data['qualifications_skills'],
                // 'conditions'=> $data['conditions'],
                'deadline'=> $data['deadline'],
                'website'=> $data['website'],
                'categories_jobs'=> $data['categories_jobs'],
                'created_on'=> $data['created_on'],
			);
			
			exit(json_encode($jsonArrays));
		 }
		 
		 if ($_POST['key'] == 'jobspostsFetch') {
			$begin_nmber = $db->real_escape_string($_POST['begin_nmber']);
			$end_nmber = $db->real_escape_string($_POST['end_nmber']);
			// $session = $db->real_escape_string($_POST['session']);

			$sql = $db->query("SELECT * FROM jobs WHERE turn='off' AND business_id = $_SESSION[key] ORDER BY created_on DESC LIMIT $begin_nmber, $end_nmber");
			if ($sql->num_rows > 0) {
				$response = "";
				$increment=0;
				while($row = $sql->fetch_array()) {
				   $increment++;
					$response .= '
						<tr>
							<td>'.$increment.'</td>
							<td  style="width:100px;"id="title_'.$row["job_id"].'">
							'.
                            (strlen($row["job_title"]) > 20 ?
                              $row["job_title"] = substr($row["job_title"],0,10)."..."
                            : $row["job_title"])
							.'
							</td>
							<td id="date_'.$row["created_on"].'">'.$users->timeAgo($row["created_on"]).'</td>
							<td></td>
						</tr>
						<tr><td colspan="7" align="right">
							<input type="button" onclick="PostsEdits('.$row["job_id"].','.$row["business_id"].', \'edit\')" value="Edit" class="btn btn-primary">
							<input type="button" onclick="PostsEdits('.$row["job_id"].','.$row["business_id"].', \'view\')" value="View" class="btn">
							<input type="button" onclick="jobsdeleteRow('.$row["job_id"].')" value="Delete" class="btn btn-danger">
							<input type="button" onclick="shows('.$row["job_id"].',\'on\')" value="turn on" class="btn btn-warning">
						</tr></td>
					';
				}
				exit($response);
			} else
				exit('Max');
		}

		 if ($_POST['key'] == 'jobspostsFetchOn') {
			$begin_nmber = $db->real_escape_string($_POST['begin_nmber']);
			$end_nmber = $db->real_escape_string($_POST['end_nmber']);
			// $session = $db->real_escape_string($_POST['session']);

			$sql = $db->query("SELECT * FROM jobs WHERE turn='on' AND business_id = $_SESSION[key]  ORDER BY created_on DESC LIMIT $begin_nmber, $end_nmber");
			if ($sql->num_rows > 0) {
				$response = "";
				$increment=0;
				while($row = $sql->fetch_array()) {
				   $increment++;
					$response .= '
						<tr>
							<td>'.$increment.'</td>
							<td  style="width:100px;"id="title_'.$row["job_id"].'">
							'.
                            (strlen($row["job_title"]) > 20 ?
                              $row["job_title"] = substr($row["job_title"],0,10)."..."
                            : $row["job_title"])
							.'
							</td>
							<td id="date_'.$row["created_on"].'">'.$users->timeAgo($row["created_on"]).'</td>
							<td></td>
						</tr>
						<tr><td colspan="7" align="right">

							<input type="button" onclick="PostsEdits('.$row["job_id"].','.$row["business_id"].', \'edit\')" value="Edit" class="btn btn-primary">
							<input type="button" onclick="PostsEdits('.$row["job_id"].','.$row["business_id"].', \'view\')" value="View" class="btn">
							<input type="button" onclick="jobsdeleteRow('.$row["job_id"].')" value="Delete" class="btn btn-danger">
							<input type="button" onclick="shows('.$row["job_id"].',\'off\')" value="turn off" class="btn btn-danger">
						</tr></td>
					';
				}
				exit($response);
			} else
				exit('Max');
		}

		$rowID = $db->real_escape_string($_POST['rowID']); 

		if ($_POST['key'] == 'on') {
	 		$db->query("UPDATE jobs SET turn='on' WHERE job_id='$rowID'");
			exit('success');
		}
		 if ($_POST['key'] == 'off') {
	 		$db->query("UPDATE jobs SET turn='off' WHERE job_id='$rowID'");
			exit('success');
		}

		if ($_POST['key'] == 'delete') {
			$db->query("DELETE FROM jobs WHERE job_id='$rowID'");
			exit('The Row Has Been Deleted!');
		}

		$businessID = $db->real_escape_string($_POST['businessID']); 
         
        $job_title = $users->test_input($_POST['job_title']);
        $job_summary = $users->test_input($_POST['job_summary']);
        // $job_summary = $db->real_escape_string($_POST['job_summary']);
		// $responsibilities_duties = $db->real_escape_string($_POST['responsibilities_duties']);
		// $qualifications_skills = $db->real_escape_string($_POST['qualifications_skills']);
		// $conditions = $db->real_escape_string($_POST['conditions']);
		$deadline = $db->real_escape_string($_POST['deadline']);
		$website = $db->real_escape_string($_POST['website']);
		$categories_jobs = $db->real_escape_string($_POST['categories_jobs']);

		if ($_POST['key'] == 'update') {
            $datetime= date('Y-m-d H-i-s');

			$users->update('jobs',array( 
			'job_title'=> $job_title, 
			'job_summary'=> $job_summary, 
			// 'responsibilities_duties'=> $responsibilities_duties,
			// 'qualifications_skills'=> $qualifications_skills, 
			// 'conditions'=> $conditions,
			'deadline'=> $deadline, 
			'categories_jobs' => $categories_jobs,
            'website'=> $website,
            'business_id'=> $businessID,
            'created_on'=> $datetime ),array('job_id' => $rowID));

			exit('success');
        }

		if ($_POST['key'] == 'create') {
            $datetime= date('Y-m-d H-i-s');

			$users->Postsjobscreates('jobs',array( 
			'job_title'=> $job_title, 
			'job_summary'=> $job_summary, 
			// 'responsibilities_duties'=> $responsibilities_duties,
			// 'qualifications_skills'=> $qualifications_skills, 
			// 'conditions'=> $conditions,
			'location'=> 'RW',
			'job_user_'=> $_SESSION['job_user'], 
			'deadline'=> $deadline, 
            'website'=> $website,
			'business_id'=> $businessID,
			'categories_jobs' => $categories_jobs,
            'turn'=> 'on',
            'created_on'=> $datetime ));

			exit('success');
        }
}