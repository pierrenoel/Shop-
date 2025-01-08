<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../public/css/output.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>

    <div class="container mx-auto p-5 font-bold">
    <?php 
        foreach ($vars as $var) {
            echo '<pre class="text-gray-800 bg-gray-100 p-5">';
            var_dump($var);
            echo '</pre>';
        }
    ?>

    </div>
</body>
</html>