<?php
function upload_file($path, $token, $target, $userid) {
	$postfields = array('upload-token' => $token, 'user' => $userid, 'file' => $cfile = new CURLFile('phplogo.png','image/png','file'));
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $target . '?return=json_on_error');
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    // 'Accept: application/json'
    ));
    curl_setopt($ch, CURLOPT_POST,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}