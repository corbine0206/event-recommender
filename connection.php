<?php
	DEFINE("DB_SERVER", "localhost");
	DEFINE("DB_USERNAME", "root");
	DEFINE("DB_PASSWORD", "");
	DEFINE("DB_NAME", "new_event");

	function openConnection(){
		$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

		if($con === false)
			die("ERROR: Could not Connect " . mysqli_connect_error());
		
		return $con;
	}

	function closeConnection($con){
		mysqli_close($con);
	}

	function getRecord($con, $strSql){
		$arrRec = [];
		$i = 0;

		if ($rs = mysqli_query($con, $strSql)) {
			if(mysqli_num_rows($rs) > 0) {
				while($rec = mysqli_fetch_array($rs)){
					foreach ($rec as $key => $value) {
						$arrRec[$i][$key] = $value;
					}
					$i++;
				}
			}
			mysqli_free_result($rs);
		}
		else
			die("ERROR: Could not Execute your request!");

		return $arrRec;
		}
	
		function getEventCountByUser($user_id) {
			$connection = openConnection();

			$sql = "SELECT COUNT(*) AS event_count FROM events WHERE user_id = ?";
			$stmt = mysqli_prepare($connection, $sql);

			mysqli_stmt_bind_param($stmt, "i", $user_id);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $event_count);
			mysqli_stmt_fetch($stmt);
			mysqli_stmt_close($stmt);
			mysqli_close($connection);

			return $event_count;
		}

		function getTotalDistinctSessionTitlesByUser($user_id) {
			$connection = openConnection();
			
			$sql = "SELECT COUNT(DISTINCT es.session_title) AS total_count
					FROM event_sessions es
					INNER JOIN events e ON es.event_id = e.event_id
					WHERE e.user_id = ?";
			$stmt = mysqli_prepare($connection, $sql);

			mysqli_stmt_bind_param($stmt, "i", $user_id);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $total_count);
			mysqli_stmt_fetch($stmt);
			mysqli_stmt_close($stmt);
			mysqli_close($connection);
			
			return $total_count;
		}

		function getTotalDistinctSpeakersByUser($user_id) {
			$connection = openConnection();
			
			$sql = "SELECT COUNT(DISTINCT es.speaker) AS total_count
					FROM event_sessions es
					INNER JOIN events e ON es.event_id = e.event_id
					WHERE e.user_id = ?";
			$stmt = mysqli_prepare($connection, $sql);
			
			mysqli_stmt_bind_param($stmt, "i", $user_id);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $total_count);
			mysqli_stmt_fetch($stmt);
			mysqli_stmt_close($stmt);
			mysqli_close($connection);
			
			return $total_count;
		}
		
		function getTotalDistinctParticipantsByUser($user_id) {
			$connection = openConnection();
			
			$sql = "SELECT COUNT(*) AS total_count
					FROM events e
					INNER JOIN participants p ON e.event_id = p.event_id
					WHERE e.user_id = ?";
			$stmt = mysqli_prepare($connection, $sql);
			
			mysqli_stmt_bind_param($stmt, "i", $user_id);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $total_count);
			mysqli_stmt_fetch($stmt);
			mysqli_stmt_close($stmt);
			mysqli_close($connection);
			
			return $total_count;
		}

?>
