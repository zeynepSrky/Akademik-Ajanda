<?php
include 'baglan.php';

$alinan_id=$_GET['id'] ?? null;
if($alinan_id){
    try{
        $sql="UPDATE gorevler SET StatusHomework=1 WHERE id=:id";

        $sorgu = $baglanti->prepare( $sql );
        $sorgu->execute([':id'=>$alinan_id ]);

        header("Location: index.php");
        exit();
    }catch(Exception $e){
        die("Günceleme yapılamadı: ");
    }
}else{
    header("Location: index.php");
    exit();
}
?>