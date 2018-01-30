
<?php
$dirPath = './images';
$listResult = '';
if (is_readable($dirPath) && is_dir($dirPath)) {
$listResult = '';
$listResult = '<table class="table table-bordered">'
        .'<thead>'
        .'<tr><th>Image</th><th>File name</th><th>Image size(WxH)</th><th>File size</th></tr>'
        .'</thead>'
        .'<tbody>';
    $images = scandir($dirPath);
    foreach ($images as $key => $val) {
        $fullPath = $dirPath . '/' . $val;
        if (file_exists($fullPath) && exif_imagetype($fullPath)) {
            $imageInfo = getimagesize($fullPath);
            $fileByteSize = filesize($fullPath);
            $listResult .= '<tr>';
            $listResult .= '<td class="thumbnail"><img src = "' . $fullPath . '" alt="' . $val . '"></td>';
            $listResult .= '<td class="file-name">'. $val . '</td>';
            $listResult .= '<td class="image-size">'. $imageInfo[0] . ' x ' . $imageInfo[1] . '</td>';
            $listResult .= '<td class="file-size">'. number_format($fileByteSize / 1024, 2) . 'KB</td>';
            $listResult .= '</tr>';
        }
    }
    $listResult .= '</tbody></table>';
} else {
     $listResult = '<p>Dir nothing or not read.</p>';
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>画像一覧</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                padding: 10px;
            }
            .table {
                width: auto;
            }
            .table thead th,
            .table tbody td {
                width: 10px;
                white-space: nowrap;
            }
            .table td,
            .table th {
                vertical-align: middle; 
                padding: .4rem;
            }
            .thumbnail img {
                width: 50px;
                height: auto;
            }
        </style>
    </head>
    <body>
        <?php
        echo $listResult;
        ?>
    </body>
</html>