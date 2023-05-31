<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title Site</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            display: flex;
            flex-direction: column;
            /* justify-content: center; */
            background-color: goldenrod;
            color: white;
            overflow-x: hidden;
        }
    </style>
</head>

<body>
<?php require "nav.php"; ?>

    <section class="nav">
        <style>
            .nav {
                display: flex;
                /* flex-direction: column; */
                gap: 0.1em;
                margin: 0.3em 0;
            }

            button {
                text-align: left;
                color: white;
                background-color: darkviolet;
                border: none;
                cursor: pointer;
            }
        </style>


        <!-- ========== create table.txt... ========== -->
        <?php
        $filename = 'table/tables.txt';

        if (!file_exists($filename)) {
            file_put_contents($filename, 'cuyes');
        }


        $buttonArray = array("aves", "cuyes", "perros", "otros");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['button'])) {
                $button = $_POST['button'];
                file_put_contents($filename, $button);
            }
        }

        foreach ($buttonArray as $button) {
            echo '<form method="post" action="">';
            echo '<button type="submit" name="button" value="' . $button . '">' . $button . '</button>';
            echo '</form>';
        }
        ?>
        <!-- ========== create table.txt. ========== -->
        <script>
            var buttonActive = document.querySelector('button[value="<?php echo file_get_contents($filename); ?>"]');
            buttonActive.classList.add('active')
        </script>


    </section>
    <section class="iframe_section">
        <style>
            .iframe_section {
                width: 100%;
                min-height: 90vh;

            }

            iframe {
                border: 1px solid #888;
                /* margin: 1em auto; */
                width: 100%;
                min-height: 90vh;
            }

            .active {
                color: white;
                background-color: #000;
            }
        </style>

        <iframe id="previewFrame" src="table" frameborder="0"></iframe>
    </section>
</body>

</html>