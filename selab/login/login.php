<?php
	session_start();

	function loadSetting($id) {
		$db = new PDO("mysql:dbname=custom;host=54.180.112.225;port=3306","root","1111"); //프로젝트에는 실제 mysql의 id, password 입력
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$check = "SELECT * FROM slide WHERE id = '$id'";
		$rows = $db->query($check);
		if ( count($rows) !== 0 ) {
			foreach ($rows as $row) {
				$_SESSION['slide_1by1'] = $row['1by1'];
				$_SESSION['slide_font'] = $row['font'];
				$_SESSION['slide_fontsize'] = $row['fontsize'];
				$_SESSION['slide_t_color'] = $row['t_color'];
				$_SESSION['slide_c_color'] = $row['c_color'];
			}
		}
	}
?>


<?php

	try {
		$db = new PDO("mysql:dbname=custom;host=54.180.112.225;port=3306","root","1111"); //프로젝트에는 실제 mysql의 id, password 입력
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$id = $_POST['id'];
		$pw = $_POST['password'];
		$check = "SELECT * FROM user WHERE id = '$id'";
		$rows = $db->query($check);
		$results = $rows->fetchAll();
		foreach($results as $result) {
			if ($result["id"] == $id) {
				if ($result["password"] == $pw) {
					$_SESSION['ID']=$id;
					loadSetting($id);
					Header("Location:../index.html"); //프로젝트에는 실제 index.html 경로를 입력
					break;
				}
				Header("Location:index4e7d.html"); // 위와 마찬가지
				break;
			}
		}
	}
	catch (PDOException $ex) {
?>
		<p>Sorry, a database error occurred. Please try again later.</p>
		<p>(Error details: <?= $ex->getMessage() ?>)</p>
<?php
	}
?>
