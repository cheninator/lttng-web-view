<?php

// This is just an example of reading server side data and sending it to the client.
// // It reads a json formatted text file and outputs it.
//

//Read Meta DATA
// Get folder

 $basedir = 'charts/';
 if (!file_exists($basedir))
  return null;
 $q = $_GET['n'];
 //$q = $_SERVER['n'];

 if ($q !== null )
   echo file_get_contents($basedir.$q);
 else {
  $files = scandir($basedir);
  $cnt = count($files);
  $rnd = rand(0,$cnt - 1);
  //echo $files[$rnd];
  echo file_get_contents($basedir.$files[$rnd]);
 }


 /*foreach ($files as $file)
   $datatablestr = file_get_contents($file);
   echo $datatablestr;
   }
 }*/

?>
