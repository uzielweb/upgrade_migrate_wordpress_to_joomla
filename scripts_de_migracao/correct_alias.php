<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Pega Imagens de destaque anexas do WordPres e Traz para o Joomla 3</title>
  </head>
  <body>
 

    <div class="container">
        <div class="col-md-12">
            <?php
require 'connection.php';

// output data of each row
$result = $conn->query("
SELECT w.post_date, w.post_name, j.created AS created , j.alias AS alias
FROM ".$dbname.".".$dbprefix."posts AS w
INNER JOIN ".$dbname.".".$joomlaprefix."content AS j
WHERE w.post_date = j.created AND w.post_status = 'publish'
ORDER BY j.created DESC
");
foreach ($result as $row) {
echo "<p>UPDATE ".$joomlaprefix."content SET alias = '".$row['post_name']."' WHERE created = '".$row['created']."';</p>";
}

$conn->close();
?>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>