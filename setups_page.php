<?php

$timestamp=time();
$salted=md5('unique_salt' . $timestamp);

echo "

<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js' type='text/javascript'></script>
<script src='js//jquery.uploadify.min.js' type='text/javascript'></script>
<link rel='stylesheet' type='text/css' href='css/uploadify.css'>
<style type='text/css'>
body {
	font: 13px Arial, Helvetica, Sans-serif;
}
</style>


<body>
	<h3>Upload Setup</h3>
	<form>
		<div id='queue'></div>
		<input id='file_upload' name='file_upload' type='file' multiple='true'>

	</form>
			<select id='track'>
			<option value=''></option>
			<option value='chrome'>Google Chrome</option>
			<option value='ff'>Firefox</option>  
			<option value='ie'>Internet Explorer</option>
			<option value='safari'>Safari</option>
			<option value='opera'>Opera</option>
		</select>

	<script type='text/javascript'>
		
		$(function() {
			

			$('#file_upload').uploadify({
				'method'   : 'post',
				'formData'     : {
					'track'     : $('#track option:selected').val(),
					'timestamp' : '$timestamp',
					'token'     : '$salted'
				},
				'swf'      : 'uploadify.swf',
				'uploader' : 'uploadify.php'
				
			});
		});
	</script>
</body>



	";
	
?>