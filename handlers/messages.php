<?php 

include('../config.php');

switch( $_REQUEST['action'] ) {

	case "sendMessage":

		//global $db;

		session_start();

		$query = $db->prepare("INSERT INTO messages SET user=?, message=?");

		$run = $query->execute([$_SESSION['username'], $_REQUEST['message']]);

		if ( $run ) {
			echo 1;
			exit;
		}



	break;

	case "getMessages":

		$query = $db->prepare("SELECT * FROM messages");
		$run = $query->execute();

		$rs = $query->fetchAll(PDO::FETCH_OBJ);

		$chat = '';
		foreach ($rs as $message ) {

			$chat .= '<div class="single-message">
						<strong>'.$message->user.' : </strong> '.$message->message.'
						<span>' .date('h:i a', strtotime($message->date)).'</span>
						</div>';
		}

		echo $chat;

	break;

}

?>