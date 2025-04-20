<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Table</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Nama Indikator</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $category_table; ?>
        </tbody>
    </table>
</body>
</html>
