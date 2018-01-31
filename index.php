
<?php
$dirPath = './';
$listResult = '';
if (is_readable($dirPath) && is_dir($dirPath)) {
$listResult = '';
$listResult = '<table class="table table-bordered" id="icons-table">'
        .'<thead>'
        .'<tr><th>Image</th><th>File name</th><th>Image size(WxH)</th><th>File size</th></tr>'
        .'</thead>'
        .'<tbody>';
    $images = scandir($dirPath);
    foreach ($images as $key => $val) {
        $fullPath = $dirPath . '/' . $val;
        if (file_exists($fullPath) && @exif_imagetype($fullPath)) {
            $imageInfo = getimagesize($fullPath);
            $fileByteSize = filesize($fullPath);
            $listResult .= '<tr>';
            $listResult .= '<td class="icon-image"><a href="' . $fullPath . '" download="' . $val . '"><img src = "' . $fullPath . '" alt="' . $val . '"></td>';
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
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
        <style>
            body {
                padding: 10px;
            }
            .icon-image img {
                width: 50px;
                height: auto;
            }
            .icon-image {
                background-color: #F5F5F5;
            }
            .icon-image a {
                display: block;
                text-align: center;
            }
            .dataTables_length,
            .dataTables_info,
            .dataTables_paginate.paging_simple_numbers {
                display: none;
            }
            th:hover {
                background-color: #F5F5F5;
            }

            /* Bootstrap style overwrite */
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
                padding: .4rem;
            }

            /* DataTable style overwrite */
            div.dataTables_wrapper div.dataTables_filter {
                text-align: left;
            }
            div.dataTables_wrapper div.dataTables_paginate {
                text-align: left;
            }
            .table>tbody>tr>td,
            .table>tbody>tr>th,
            .table>tfoot>tr>td,
            .table>tfoot>tr>th,
            .table>thead>tr>td,
            .table>thead>tr>th {
                vertical-align: middle;
            }
        </style>
        <script>
            $(document).ready(function() {
                $('#icons-table').DataTable({
                    "lengthMenu": [[-1], ["All"]]
                });
            });
        </script>
    </head>
    <body>
        <?php
        echo $listResult;
        ?>
    </body>
</html>