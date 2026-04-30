<?php
include 'baglan.php';

$gelen_id=$_GET['id']??null;

if(!$gelen_id){
    header("Location: index.php");
    exit();
}

if(isset($_GET['onay'])){
     try{
        $sql='DELETE FROM gorevler WHERE id=:id';
        $sorgu=$baglanti->prepare($sql);
        $sorgu->execute([':id' => $gelen_id]);
        
        header("Location: index.php");
        exit();

     }catch(PDOException $e){
        die("Veri silinirken bir hata oluştu: ");
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Görev Sil-Görevler</title>
    <style>
        body{
            font-family: 'Segoe UI',sans-serif;
            background-color: #f5f5dc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .onay-kutusu{
            background-color: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 380px;
            border-top: 6px solid #d9534f;
        }
        .uyari-ikon{
            font-size: 45px;
            margin-bottom: 15px;
        }
        h2{
            color: #333;
            margin: 0 0 10px 0;
        }
        p{
            color: #777;
            line-height: 1,5;
        }
        .butonlar{
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 25px;
        }
        .buton-evet, .buton-hayir{
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            transition: 0.3s;
        }
        .buton-evet{
            background-color: #d9534f;
        }
        .buton-evet:hover{
            background-color: #c9302c;
        }
        .buton-hayir{
            background-color: #6c757d;
            color: white;
        }
        .buton-hayir:hover{
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    
    <div class="onay-kutusu">
        <h2>⚠️ Emin misin?</h2>
        <p>Bu görevi silmek üzeresin. Bu işlem geri alınamaz!</p>
        <div class="butonlar">
            <a href="delete.php?id=<?php echo htmlspecialchars($gelen_id); ?>&onay=1" class="buton-evet">Evet, Sil</a>
            <a href="index.php" class="buton-hayir">Hayır, Vazgeç</a>
        </div>
    </div>
</body>
</html>