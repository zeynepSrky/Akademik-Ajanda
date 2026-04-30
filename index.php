<?php 

include 'baglan.php';

try{
    $sql = "SELECT*FROM gorevler ORDER BY Deadline ASC";
    $sorgu = $baglanti->query( $sql );
    $gorevler = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    
    $bugun=date('Y-m-d');
}catch(PDOException $e){
    die("Veri çekme hatası: ");
}
?>

<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="UTF-8">
        <title>Akademik Ajandam</title>
        <style>
            body{
                font-family: sans-serif; 
                padding: 30px; 
                background-color:beige;
            }
            .mytable{
                background-color: floralwhite; 
                padding: 25px; 
                border-radius: 12px; 
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                max-width: 1100px;
                margin: 0 auto;
            }
            .tablo-baslik{
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
            }
            .gorev-ekle{
                background-color: #28a745;
                color: white;
                padding: 10px 20px;
                text-decoration: none;
                border-radius: 6px;
                font-weight: bold;
                transition: 0.3s;
            }
            .buton-sil{
                background-color: #536658;
                color: white;
                padding: 8px 16px;
                text-decoration: none;
                border-radius: 5px;
                font-size: 13px;
                font-weight: bold;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                transition: 0.3s;
            }
            .buton-guncelle{
                background-color: #007bff;
                color: white;
                padding: 8px 16px;
                border-radius: 5px;
                text-decoration: none;
                font-size: 13px;
                font-weight: bold;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                margin: 0;
            }
            .buton-guncelle:hover{
                background-color: #0056b3;
            }
            table{ width: 100%; border-collapse: collapse; }
            th,td{padding: 15px; border-bottom: 1px solid #b7b0b0; text-align: left; }
            th{
                background-color: #007bff; 
                color: white;
                font-weight: bold;
            }
            .gecikmis-tarih{
                color: #d34141;
                font-weight: bold;
            }
            .islem-alani{
                text-align: center;
                display: flex;
                justify-content: flex-end;
                min-width: 180px;
                gap: 12px;
            }
            .yuksek,.orta,.dusuk{
                display: inline-block;
                width: 85px;
                text-align: center;
                padding: 6px 0;
                border-radius: 5px;
                font-weight: bold;
                color: white;
            }
            .yuksek{ background-color: #d34141; }
            .orta{ background-color: #bda144;  }
            .dusuk{ background-color: #25d04d;  }
        </style>
    </head>
    <body>
        <div class="mytable">
            <div class="tablo-baslik">
            <h2>Ders Görev Listesi</h2>
            <a href="ekle.php" class="gorev-ekle">➕ Yeni Görev Ekle</a>
            </div>
            <table>
                <thead>
                    <tr style="background-color: #007bff; color: white;">
                        <th>Görev Adı</th>
                        <th>Ders Adı</th>
                        <th>Son Tarih</th>
                        <th>Önem Derecesi</th>
                        <th>Durum</th>
                        <th class="islem-alani">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($gorevler as $gorev): ?>
                        <?php
                            $gecikti_mi= ($gorev['Deadline']<$bugun && $gorev['StatusHomework']==0);
                            $class='';
                            if($gorev['Severity']=='Yüksek') $class='yuksek';
                            elseif($gorev['Severity']=='Orta') $class='orta';
                            else $class= 'dusuk';
                        ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($gorev['GorevAdi']); ?></strong></td>
                            <td><?php echo htmlspecialchars($gorev['DersAdi']); ?></td>
                            <td class="<?= $gecikti_mi ? 'gecikmis-tarih':'' ?>">
                                <?= htmlspecialchars($gorev['Deadline']) ?> <?= $gecikti_mi ? '⚠️' : '' ?>
                            </td>
                            <td>
                                <span class="onemli-sinif <?php echo $class; ?>"> <?php echo $gorev['Severity']; ?> </span>
                            </td>
                            <td>
                                <?php echo $gorev['StatusHomework']==1 ? '✅ Tamamlandı':'⏳ Devam Ediyor'; ?>
                            </td>
                            <td class="islem-alani">
                                <a href="delete.php?id=<?php echo $gorev['id']; ?>" class="buton-sil">Sil</a>
                               <?php if($gorev['StatusHomework']==0): ?>
                                <a href="update_status.php?id=<?php echo $gorev['id'];?>" class="buton-guncelle">Tamamla</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>