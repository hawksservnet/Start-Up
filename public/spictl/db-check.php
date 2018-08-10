<?php
// db info
$db_host = '127.0.0.1';
//$db_name = 'mysql';
$db_name = 'startuphub';
$db_user = 'root';                                                                                                                                                                                                               
$db_pass = 'XaVPeMJEfJ';                                                                                                                                                                                                         
                                                                                                                                                                                                                                 
// db connect                                                                                                                                                                                                                    
if($db_pass){                                                                                                                                                                                                                    
        $DB = new mysqli($db_host, $db_user, $db_pass);                                                                                                                                                                          
}else{                                                                                                                                                                                                                           
        $DB = new mysqli($db_host, $db_user);                                                                                                                                                                                    
}                                                                                                                                                                                                                                
                                                                                                                                                                                                                                 
// check connect                                                                                                                                                                                                                 
if($DB){                                                                                                                                                                                                                         
        echo '~test_ok~';                                                                                                                                                                                                        
}                                                                                                                                                                                                                                
else{                                                                                                                                                                                                                            
        echo 'connect NG';                                                                                                                                                                                                       
}                                                                                                                                                                                                                                
                                                                                                                                                                                                                                 
//db closed
$close = mysqli_close($DB);
/*
if($close){
        echo '~close_ok~';
}
else{
	echo 'close NG';
}
*/
?>
