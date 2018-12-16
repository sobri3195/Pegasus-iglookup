<?php
	header('Content-Type: application/json; charset=UTF-8');
	function getUserInstagram($username)
	{
		$response=@file_get_contents('https://www.instagram.com/'.$username); 
		if (empty($response))
		{
			$data = array(
				'success' => false,
				'message' => "Username not found."
			);
			return $data;
		}
		$response = explode('window._sharedData = ',$response);
		if(sizeof($response)<2){
			$data = array(
				'success' => false,
				'message' => "Username not found."
			);
			return $data;
		}
		$response = explode(';</script>',$response[1]);
		$response = json_decode($response[0]);
		$data_user = $response->entry_data->ProfilePage;
		$data_user = $data_user[0]->graphql->user;
		$data = array(
			'success' 				=> true,
			'id' 					=> $data_user->id,
			'full_name' 			=> $data_user->full_name,
			'username' 				=> $data_user->username,
			'profile_pic_url' 		=> $data_user->profile_pic_url,
			'profile_pic_url_hd' 	=> $data_user->profile_pic_url_hd,
			'followers' 			=> $data_user->edge_followed_by->count,
			'following' 			=> $data_user->edge_follow->count,
			'biography'				=> $data_user->biography,
			'posts'					=> $data_user->edge_owner_to_timeline_media->count
		);				
	   return $data;
	}
	if (isset($_POST['username'])){
		$username = $_POST['username'];
		$user = getUserInstagram($username);	   
		if($user['success']){
			$html_code = '<div class="col-md-12">
							<div class="tuyin first">	
								<p><img src="'.$user['profile_pic_url_hd'].'"></p>
								<p class="full-name"><a href="http://instagram.com/'.$user['username'].'" target="_blank">'.$user['full_name'].'</a></p>
								<p class="user-id">'.$user['id'].'</p>
								<p class="text">'.$user['biography'].'</p>
								<table id="download-list" class="table text-center">
									<thead>
										<tr class="">
											<th class="fluid text-center">Posts</th>
											<th class="fluid text-center">Followers</th>
											<th class="fluid text-center">Following</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>'.$user['posts'].'</td>
											<td>'.$user['followers'].'</td>
											<td>'.$user['following'].'</td>
										</tr>
									</tbody>
								</table>
							</div>						
						</div>';
			$result = array(
				'success' => true,
				'message' => 'Success',
				'data' => $html_code
			);
		}else{
			$html_code = '<div class="col-md-12"><div class="tuyin first"><div class="alert alert-danger"><strong>Oops!</strong> '.$user['message'].'</div></div></div>';
			$result = array(
				'success' => false,
				'message' => $user['message'],
				'data' => $html_code
			);
		}			
	}else{
		$html_code = '<div class="col-md-12"><div class="tuyin first"><div class="alert alert-danger">Bad Request!</div></div></div>';
		$result = array(
			'success' => false,
			'message' => 'Bad request!',
			'data' => $html_code
		);
	}  
	echo json_encode($result);
?>