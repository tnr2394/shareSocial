<?php
error_reporting(-1);
ini_set('display_errors', 'On');
	if (strpos($_SERVER["HTTP_USER_AGENT"], "facebookexternalhit/") !== false || strpos($_SERVER["HTTP_USER_AGENT"], "Facebot") !== false || strpos($_SERVER["HTTP_USER_AGENT"], "Googlebot-Mobile") !== false || strpos($_SERVER["HTTP_USER_AGENT"], "Googlebot") !== false) {
	    // echo "<meta property='og:title' content='DETECTED FB' />";
	}
	else {
		$url =  "http://".$_SERVER['SERVER_NAME']."/#/guest/events/details/".$_GET['id'];
        ob_start();
		header("Location:".$url);
		exit();
	}


	include 'config.php';



	function getImages($id,$con){
		$result = mysqli_query($con,"select * from eventphotos where eventid = '$id' order by id desc") or die(mysqli_error($con));
		$nara = array();
		while($y = mysqli_fetch_array($result)){
			$y['path'] = $_SESSION['serverUrl'].$y['path'];
			$nara[] = $y;
		}
		return $nara;
	}
	
	$id = $_GET['id'];
	$result = mysqli_query($con,"select * from events where id = '$id' order by date desc") or die(mysqli_error($con));
	$ara = array();
	while($x = mysqli_fetch_array($result)){
		$sara = array();
		$sara['id'] = $x['id'];
		$sara['name'] = $x['name'];
		$sara['description'] = $x['description'];
		$sara['date'] = $x['date'];
		$sara['place'] = $x['place'];
		$sara['images'] = getImages($x['id'],$con);
		array_push($ara,$sara);
	}
	$title = $ara[0]['name'];
	$description = $ara[0]['description'];
	$image = $ara[0]['images'][0]['path'];


?>

<html>
	<head>

		<meta property="fb:app_id" content="807373209363035" /> 
		<meta property="og:title" content="<?php $title ?>" />
		<meta property="og:type" content="article" />
		<meta property="og:site_name" content="<?php echo $site_name; ?>" />

		<link rel="canonical" href="http://www.vvprotaract.club/server/guest/createEventToShareFB.php?id=<?php echo $id; ?>"/>

		<meta property="og:url" content="http://www.vvprotaract.club/server/guest/createEventToShareFB.php?id=<?php echo $id; ?>" />
		<meta property="og:image" content="<?php echo $image; ?>" />
		<meta property="og:description"   content="<?php echo $description; ?>" />
		<meta property="og:author"   content="<?php echo $author; ?>" />

		<meta name="author" content="<?php echo $author; ?>">
		<meta name="language" content="English">

		<meta name="url" content="http://www.vvprotaract.club/server/guest/createEventToShareFB.php?id=<?php echo $id; ?>" />
		<meta name="description"   content="<?php echo $description; ?>" />
		<meta name="title"   content="<?php echo $title; ?>" />
	</head>

	<body>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<h1 class="page-header">Share Social!</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12" ui-view>
					
				</div>
			</div>
		</div>

	</body>
</html>
