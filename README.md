#Cull Images Service

The Cull Images Service is a couple PHP scripts that will search a specified directory for images, renaming the most recently modified to a specific name, and then removing the renaming images.

This is useful for monitoring a series of directories where security feed images are uploaded and then referencing a single image filename on an HTML page.

##Instructions

- Configure the culling service's settings:
   
		//Images to include in the search filter
		$IMAGES_FILTER = '*.jpg';
		//Filename to use when renaming the most recent file
		$LATEST_FILE_NAME = 'image.jpg';
		//Directories to include in search
		$IMAGES_DIRS = array('./images1/', './images2/', './images3/');

- Make sure the web server account has access to the directories you want to monitor:

		chmod a+w images1 images2 images3


- Setup a cron job that points to cull-images.php which will run every minute or so.

- If you want to call the service more than once every minute, configure the cron service's settings and point your cron job to cron.php:

		// Cron URL here.
		$cron_url="http://localhost/cull-images.php";
		// Time interval needed (second).
		$time_interval=15;



