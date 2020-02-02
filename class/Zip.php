<?php

class Zip
{

  /* to copy all file/folder names from a directory into an array*/
public function dirToArray($dir_path) {
    $result = array();
    $path = realpath($dir_path);
    $objects = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path), \RecursiveIteratorIterator::SELF_FIRST);
    foreach($objects as $name => $object) {
        if( $object->getFilename() !== "." && $object->getFilename() !== "..") {
            $result[] = $object;
        }
    }
    return $result;
}


/* creates a compressed zip file */
public function create_zip($overwrite = false) {
    $fullProductPath = '../img/database';
    $a_filesFolders = $this->dirToArray( $fullProductPath );
    //if the zip file already exists and overwrite is false, return false
    $zip = new \ZipArchive();
    $zipProductPath = 'photos.zip';

    //if files were passed in...
    if(is_array($a_filesFolders) && count($a_filesFolders)){
         $opened = $zip->open( $zipProductPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE );
        if( $opened !== true ){
            $GLOBALS["errors"][] = "Impossible to open {$zipProductPath} to edit it.";
            return false;
        }else{
            //cycle through each file
            foreach($a_filesFolders as $object) {
                //make sure the file exists

                $fileName = $object -> getFilename();
                $pathName = $object -> getPathname();
                $pos = strpos($zipProductPath , "/tmp/") + 5;
                $fileDestination = substr($pathName, $pos);
                $zip->addFile($pathName,$fileName);

            }

            //close the zip -- done!
            $zip->close();
            //check to make sure the file exists
            return file_exists($zipProductPath);
        }
      }
  }
}


 ?>
