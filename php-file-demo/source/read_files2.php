<?php 

$telegrafSocket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
socket_set_option($telegrafSocket, SOL_SOCKET, SO_REUSEADDR, 1);
socket_bind($telegrafSocket, 0);

$dir = '/var/data/2';
while(true) {
if ($handle = opendir($dir)) {
	//echo "Directory handle: $handle\n";
	//echo "Entries:\n";

	/* This is the correct way to loop over the directory. */
	while (false !== ($entry = readdir($handle))) {
		if ($entry != "." && $entry != "..") {
                        $time_pre = microtime(true);
			//echo "$entry\n";
			$file = fopen($dir.'/'.$entry, 'r');
			if ($file) {
				$contents = fread($file, filesize($dir.'/'.$entry));
				//echo intval($contents) . "win\n";	
				sleep(intval($contents)/((rand(5,15)*5)));
			}
                        //end timing for port read
                        $time_post = microtime(true);
                        $exec_time = $time_post - $time_pre;

                        //timestamp for logging device time.
                        //add line to TELEGRAF to submit number of attempts made here
                        //create telegraf viable JSON array
                        $json_stats = array();
                        $json_stats['server'] = 'demo2';
                        $json_stats['file_parse_event_exec'] = $exec_time;

                        $json_msg_telegraf = json_encode($json_stats);

                        $json_len_telegraf = strlen($json_msg_telegraf);

                        //Send to telegraf json listener
                        if ( socket_sendto($telegrafSocket, $json_msg_telegraf, $json_len_telegraf, 0, 'localhost', 8092) !== false )
			{
				//nothing
				//echo "GOOD! \n";
			}
			else {
				error_log('Could not send UDP message.');
				//echo "BAD! \n";
			}
		}
	}

	sleep(1); //one second

	closedir($handle);
}
}
