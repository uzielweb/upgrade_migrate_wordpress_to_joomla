<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="generator" content="PSPad editor, www.pspad.com">
    <title>
    </title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
        integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
        integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous">
    </script>
    <style>
    body td {
        font-size: 14px;
        color: #333;
    }

    body td a {
        font-size: 14px;
        color: #46918C;
    }

    table td {
        padding: 10px;
    }

    thead td,
    thead td * {
        background: #818181 none repeat scroll 0 0;
        color: #fff !important;
        font-weight: bold;
        padding: 10px;
        text-align: left !important;
        text-transform: uppercase;
    }

    body>.container {
        padding-top: 40px;
        background-color: white;
    }

    /*  * Responsive stypes  */
    @media (max-width: 980px) {
        body>.container {
            padding-top: 0px;
        }

        .navbar-fixed-top {
            margin-bottom: 0;
        }
    }
    tr td:last-child {
	white-space: nowrap;
}
    tr td:nth-child(1), tr td:nth-child(2), tr td:nth-child(3), tr td:nth-child(4),
    tr th:nth-child(1), tr th:nth-child(2), tr th:nth-child(3), tr th:nth-child(4) {
	display: none;
}
    /* END: @media (max-width: 980px) */
    </style>
</head>

<body>
    <div class="container">
        <div class="col-md-12">
            <?php
//public $host = 'localhost';
//public $user = '97fmpontal';
//public $password = 'KUe97HkYenIxevg';
//public $db = 'joomla_97fmpontal';
//public $dbprefix = 'l9md2_';

$servername = "localhost";
$username = "97fmpontal";
$password = "KUe97HkYenIxevg";
$dbname = "joomla_97fmpontal";
$dbprefix = "wp_";
$joomlaprefix = "l9md2_";
// Create connection

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// output data of each row
echo "<table><thead><tr><td><b>ID: </b></td><td><b>TÍTULO: </b></td><td><b>APELIDO: </b></td><td><b>DATA: </b></td><td><span class='col-md-4'>Imagem</span><span class='col-md-4'>Intro/Full JOOMLA</span><span class='col-md-4'>SQL JOOMLA</span></td></tr></thead><tbody>";
foreach ($conn->query('SELECT ID, post_date, post_title, post_type, post_name, guid FROM ' . $dbprefix . 'posts WHERE post_type = "post" ORDER BY ID ASC') as $row) {
    echo "<td>" . $row["ID"] . "</td><td><a data-toggle='lightbox' rel='modal' href='" . $row["guid"] . "' target='_blank'>" . $row["post_title"] . "</a></td><td><a data-toggle='lightbox' rel='modal' href='" . $row["guid"] . "' target='_blank'>" . $row["post_name"] . "</a></td><td>" . $row["post_date"] . "</td><td>";

    foreach ($conn->query('SELECT ID, post_parent,guid FROM ' . $dbprefix . 'posts WHERE post_type = "attachment"') as $row2) {
        if ($row2["post_parent"] == $row["ID"]) {
            foreach ($conn->query('SELECT post_id,meta_value, meta_key FROM ' . $dbprefix . 'postmeta WHERE meta_key = "_thumbnail_id"') as $row3) {
                if ($row3["meta_value"] == $row2["ID"]) {
                    foreach ($conn->query('SELECT post_id,meta_value, meta_key FROM ' . $dbprefix . 'postmeta WHERE meta_key = "_wp_attached_file"') as $row4) {
                        if ($row4["post_id"] == $row3["meta_value"]) {
                            //  Comente essa linha abaixo caso precise  copiar só a coluna com o update da tabela
                            //  echo  "<span class='col-md-4'><a data-toggle='lightbox' rel='modal' href='wp-content/uploads/".$row4["meta_value"]."' target='_blank'>".$row4["meta_value"]."</a></span>";
                            //  Comente essa linha abaixo caso precise  copiar só a coluna com o update da tabela
                            //  echo  "<span class='col-md-4'><b>images/".$row4["meta_value"]."</b></span>";

                            echo "<span class='col-md-4'>UPDATE " . $joomlaprefix . "content SET images = '{\"image_intro\":\"images\\\/" . str_replace('/', '\\\/', $row4["meta_value"]) . "\",\"float_intro\":\"\",\"image_intro_alt\":\"\",\"image_intro_caption\":\"\",\"image_fulltext\":\"images\\\/" . str_replace('/', '\\\/', $row4["meta_value"]) . "\",\"float_fulltext\":\"\",\"image_fulltext_alt\":\"\",\"image_fulltext_caption\":\"\"}' WHERE publish_up = '" . $row["post_date"] . "';</span>";
                        }

                    }
                }
            }

        }
    }
    echo "</td></tr>";
}
echo "</tbody></table>";
$conn->close();
?>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</body>

</html>