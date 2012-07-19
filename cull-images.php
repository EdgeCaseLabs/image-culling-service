<?php
/**
 * Given a directory, rename the most recent image and delete the rest.
 * @author      Wes Thomas <westhomas@edgecaselabs.com>
 */

define('IMAGES_DIR', './images/');
define('IMAGES_FILTER', '*.jpg');
define('LATEST_FILE_NAME', IMAGES_DIR . 'image.jpg');


$BREAK = '<br/>';

//fetch files matching filter and note the modified time
foreach (glob(IMAGES_DIR . IMAGES_FILTER) as $filename){
    if(is_file($filename) && $filename != LATEST_FILE_NAME) {  // if you want to omit directories 
        $arrDIR[$filename] = filemtime($filename); 
    }
}
//sort the files in reverse so the most recent file is index=0
if(count($arrDIR) > 0){
    if(arsort($arrDIR)){

        $i = 0;
        foreach ($arrDIR as $key => $value) {
            echo $key . ' - ';
            echo date ("F d Y H:i:s", $value) . ' - ';
            
            if($i == 0){
                //the first one is the new latest file
                echo 'rename';
                rename($key, LATEST_FILE_NAME);
            }else{
                //these files are old; delete them
                echo 'delete';
                unlink($key);
            }

            echo $BREAK;
            $i++;
        }

    }else{
        echo 'arsort returned false';
    }
}else{
    echo 'no files found matching ' . IMAGES_DIR . IMAGES_FILTER;
}


?>