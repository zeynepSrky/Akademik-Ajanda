<?php
include 'baglan.php';

if($_SERVER['REQUEST_METHOD']=='POST' && isset( $_POST['kaydet'])){
    if(empty(trim($_POST['GorevAdi']))||empty(trim($_POST['DersAdi']))){
        die('Lütfen tüm alanları doldurun!');
    }
    $gorev=$_POST['GorevAdi'];
    $ders=$_POST['DersAdi'];
    $tarih=$_POST['Deadline'];
    $onem=$_POST['Severity'];

    try{
        $sql="INSERT INTO gorevler (GorevAdi, DersAdi, Deadline, Severity, StatusHomework) VALUES (:baslik, :ders, :tarih, :onem, 0)";
        $sorgu=$baglanti->prepare($sql);
        $sorgu->execute([
            ':baslik'=>$gorev,
            ':ders'=>$ders,
            ':tarih'=>$tarih,
            ':onem'=>$onem  
        ]);
        header("Location:index.php");
        exit();
    }catch(PDOException $e){
        die("Veri eklenirken bir hata oluştu: ");
    }
}
?>


<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yeni Görev Ekle-Görevler</title>
    <style>
        body{
            font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: bisque;
            display:flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0; 
        }
        .form-kapsayici{
            background-color: floralwhite;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        h2{
            color: #007bff;
            text-align: center;
            margin-top: 0;
        }
        .form-grup label{
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"],input[type="date"],select{
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
        }
        button{
            width: 100%;
            padding: 12px;
            background-color: #c03d89;
            color: whitesmoke;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 03s;
        }
        button:hover{
            background-color: #892b50;
        }
        .geri-link{
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
            font-size: 1em;
        }
        .geri-link:hover{
            text-decoration: underline;
        }
        
    </style>
</head>
<body>
        <div class="form-kapsayici">
        <h2>🚀 Yeni Görev Ekle</h2>
        <form action="ekle.php" method="POST">
            <div class="form-grup">
                <label>Görev Adı</label>
                <input type="text" name="GorevAdi" placeholder="Örn: Laboratuvar Çalışması" required>
                <br><br>
                <label>Ders Adı</label>
                <input type="text" name="DersAdi" placeholder="Örn: Fizik" required>
                <br><br>
                <label>Teslim Tarihi</label>
                <input type="date" name="Deadline" required>
                <br><br>
                <span>Önem Derecesi: </span>
                <label>
                    <input type="radio" id="yuksek" name="Severity" value="Yüksek" required>
                    <label for="yuksek">Yüksek</label>
                    <input type="radio" id="orta" name="Severity" value="Orta">
                    <label for="orta">Orta</label>
                    <input type="radio" id="dusuk" name="Severity" value="Düşük">
                    <label for="dusuk">Düşük</label>
                </label>
                <br><br>
                <button type="submit" name="kaydet">Kaydet</button>
            </div>
        </form>
        <br><br>
        <a href="index.php" class="geri-link">⬅️ Görev Listesine Dön</a>
    </div>   
</body>
</html>
