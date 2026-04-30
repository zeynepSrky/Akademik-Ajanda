
<?php
try{
    $host="localhost";
    $username="kullanici_adinizi_buraya_yaziniz";
    $db_name="veritabani_adinizi_buraya_yaziniz";
    $password= "sifrenizi_buraya_yaziniz";
    
    $baglanti=new PDO("mysql:host=$host;dbname=$db_name;charset=utf8",$username,$password);
    
    $baglanti->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
}catch(PDOException $e){
    die("Veritabanı bağlantısı kurulamadı. lütfen ayarlarınızı kontroledin");
}


?>
