<?php
function get_config() {
	return json_decode(file_get_contents('./config.json'));
}
