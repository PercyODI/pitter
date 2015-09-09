<?php
	// session_start();
	// $mylink = $_SESSION['link'];


	function add_post($userid, $body) {
		global $mylink;
		$body = mysqli_real_escape_string($mylink, $body);
		$sql = "insert into posts (user_id, body, stamp) values ($userid, '$body', now())";
		echo $sql;
		$result = mysqli_query($mylink, $sql);
	}

	function show_posts($userid, $limit=0) {
		global $mylink;
		$posts = array();

		$user_string = implode(',', $userid);
		$extra = " and id in ($user_string)";

		if($limit > 0) {
			$extra = "limit $limit";
		}
		else {
			$extra = '';
		}

		$sql = "select user_id, body, stamp from posts
				where user_id in ($user_string)
				order by stamp desc $extra";
		$result = mysqli_query($mylink, $sql);

		while($data = mysqli_fetch_object($result)) {
			$posts[] = array(	'stamp' => $data->stamp,
								'userid' => $data->user_id,
								'body' => $data->body
								);
		}
		return $posts;
	}

	function find_username($userid) {
		global $mylink;
		$sql = "select username from users where id='$userid'";

		$username = array();
		$result = mysqli_query($mylink, $sql);
		if($data = mysqli_fetch_array($result)) {
			return $data['username'];
		}
		else
		{
			return 'Username Not Found';
		}
	}

	function show_users($user_id=0) {
		global $mylink;
		if($user_id > 0) {
			$follow = array();
			$fsql = "select user_id from following where follower_id='$user_id'";
			$fresult = mysqli_query($mylink, $fsql);

			while($f = mysqli_fetch_object($fresult)) {
				array_push($follow, $f->user_id);
			}

			if(count($follow)) {
				$id_string = implode(',', $follow);
				$extra = " and id in ($id_string)";
			}
			else {
				return array();
			}
		}
		$users = array();
		$sql = "select id, username from users where status='active' $extra order by username";
		$result = mysqli_query($mylink, $sql);

		while ($data = mysqli_fetch_object($result)) {
			$users[$data->id] = $data->username;
		}

		return $users;
	}

	function following($userid) {
		global $mylink;
		$users = array();
		$sql = "select distinct user_id from following
				where follower_id = '$userid'";
		$result = mysqli_query($mylink, $sql);

		while($data = mysqli_fetch_object($result)) {
			array_push($users, $data->user_id);
		}

		return $users;
	}

	function check_count($first, $second) {
		global $mylink;
		$sql = "select count(*) from following
				where user_id='$second' and follower_id='$first'";
		$result = mysqli_query($mylink, $sql);

		$row = mysqli_fetch_row($result);
		return $row[0];
	}

	function follow_user($me, $them) {
		global $mylink;
		$count = check_count($me, $them);

		if($count == 0) {
			$sql = "insert into following (user_id, follower_id) values ($them, $me)";
			$result = mysqli_query($mylink, $sql);
		}
	}

	function unfollow_user($me, $them) {
		global $mylink;
		$count = check_count($me, $them);

		if($count != 0) {
			$sql = "delete from following where user_id='$them' and follower_id='$me' limit 1";
			$result = mysqli_query($mylink, $sql);
		}
	}
?>