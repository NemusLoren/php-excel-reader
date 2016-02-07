<?php 
ini_set('auto_detect_line_endings',TRUE);
$file_handle = fopen("Address.csv", "r");
$ch = curl_init();
$url = 'http://sendy.neoaid.com/subscribe';

while (!feof($file_handle) ) {
set_time_limit(0);

$line_of_text = fgetcsv($file_handle, 1024);

$fields = array(
						'name' => urlencode($line_of_text[0]),
						'email' => urlencode($line_of_text[1]),
						'list' => urlencode('PUT-YOUR-LIST-ID-HERE')
				);

foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string, '&');


curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

if ($line_of_text[0] != ''){
	curl_exec($ch);
	sleep(5);
}

echo $line_of_text[1];
echo '<br>';


}

fclose($file_handle);
curl_close($ch);

?>
