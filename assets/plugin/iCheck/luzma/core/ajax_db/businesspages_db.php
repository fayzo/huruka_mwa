<?php
include('../init.php');

if (isset($_POST['key'])) {

	// strip_tags($_GET['id']); remove script tags

        if ($_POST['key'] == 'businessviewORedit') {
			$rowID = $db->real_escape_string($_POST['rowID']);
			$data= $users->selects('users',
			array(
				'companyname'=> 'companyname', 
				'overview'=> 'overview', 
				'history'=> 'history', 
				'team'=> 'team', 
				'legal_structure'=> 'legal_structure', 
				'location_facilities'=> 'location_facilities', 
				'mission_statement'=> 'mission_statement', 
				'website'=> 'website' 

			),array(
				 'user_id'=> $rowID,
			));

			$jsonArrays = array(
				'companyname'=> $data['companyname'],
				'overview'=> $data['overview'],
                'history'=> $data['history'],
                'team'=> $data['team'],
                'legal_structure'=> $data['legal_structure'],
                'location_facilities'=> $data['location_facilities'],
                'mission_statement'=> $data['mission_statement'],
                'website'=> $data['website'],
			);
			
			exit(json_encode($jsonArrays));
         }

		$rowID = $db->real_escape_string($_POST['rowID']);
         
        $companyname = $db->real_escape_string($_POST['companyname']);
        $overview = $db->real_escape_string($_POST['overview']);
		$history = $db->real_escape_string($_POST['history']);
		$team = $db->real_escape_string($_POST['team']);
		$legal_structure = $db->real_escape_string($_POST['legal_structure']);
		$location = $db->real_escape_string($_POST['location']);
		$mission_statement = $db->real_escape_string($_POST['mission_statement']);
		$website = $db->real_escape_string($_POST['website']);

		if ($_POST['key'] == 'update_Row') {

			$users->update('users',array( 
			'companyname'=> $companyname, 
			'overview'=> $overview, 
			'history'=> $history,
			'team'=> $team, 
			'legal_structure'=> $legal_structure,
			'location_facilities'=> $location, 
			'mission_statement'=> $mission_statement,
			'website'=> $website 
		    ),array( 'user_id' => $rowID ));

			exit('success');
        }
}