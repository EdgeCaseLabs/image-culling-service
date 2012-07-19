<?php
/**
 * Given a directory, rename the most recent image and delete the rest.
 * @author      Wes Thomas <westhomas@edgecaselabs.com>
 */

//Cull Images Service Settings

//Images to include in the search filter
$IMAGES_FILTER = '*.jpg';
//Filename to use when renaming the most recent file
$LATEST_FILE_NAME = 'image.jpg';
//Directories to include in search
$IMAGES_DIRS = array('./images1/', './images2/', './images3/');


$BREAK = '<br/>';

//fetch files matching filter and note the modified time
foreach ($IMAGES_DIRS as $path){
    
    $arrDIR = array();
    $new_file_name = $path . $LATEST_FILE_NAME;

    foreach (glob($path . $IMAGES_FILTER) as $filename){
        if(is_file($filename) && $filename != $new_file_name) {  // if you want to omit directories 
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
                    rename($key, $new_file_name);
                }else{
                    //these files are old; delete them
                    echo 'delete';
                    unlink($key);
                }

                echo $BREAK;
                $i++;
            }

        }else{
            echo 'arsort() returned false';
            echo $BREAK;
        }
    }else{
        echo 'no files found matching ' . $path . $IMAGES_FILTER;
        echo $BREAK;
    }
}

?>
Done