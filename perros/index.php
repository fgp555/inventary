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
            /* justify-content: center; */
            background-color: goldenrod;
            color: white;
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    <section class="nav">
        <style>
            .nav {
                display: flex;
                flex-direction: column;
                gap: 0.1em;
            }

            button {
                text-align: left;
                color: white;
                background-color: darkviolet;
                border: none;
                cursor: pointer;
            }
        </style>
        <?php

        // Get the current directory
        $dir = __DIR__;

        // Read the files in the current directory
        $files = scandir($dir);


        // Display the files with .txt extension
        foreach ($files as $file) {
            // Exclude directories and hidden files
            if (is_file($file) && !in_array($file, array('.', '..'))) {
                $fileInfo = pathinfo($file);
                $extension = $fileInfo['extension'];

                if ($extension === 'php') {
                    //echo "<div class='link'><a href='/$file'>$file</a></div>";
                    echo "<button onclick='openInIframe(this);'>$file</button>";
                }
            }
        }

        ?>
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
                height: 100%;
            }

            .active {
                color: white;
                background-color: #000;
            }
        </style>

        <?php
        // print "<br>";
        // print "<br>";
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
        $currentURL = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        // echo "Current URL: " . $currentURL;
        // print "<br>";

        ?>
        <?php
        // $REQUEST_URI1 = $_SERVER['REQUEST_URI'];
        // echo $_SERVER['REQUEST_URI'];
        $REQUEST_URI1 = "";
        // echo "Current URL: " . $REQUEST_URI1;
        ?>



        <iframe id="previewFrame" src="<?php echo $_SERVER['REQUEST_URI']; ?>/03_read.php" frameborder="0"></iframe>

        <script>
            function openInIframe(button) {
                var elements = document.querySelectorAll("button");
                for (var i = 0; i < elements.length; i++) {
                    elements[i].classList = [];
                    console.log(elements[i])
                }

                var url = button.textContent.trim();
                button.classList = "active"
                var iframe = document.getElementById("previewFrame");
                iframe.src = "<?php echo $_SERVER['REQUEST_URI']; ?>/" + url;
            }
        </script>
        <script>
            let buttonAll = document.querySelectorAll("button")
            // console.log(buttonAll)
            buttonAll.forEach(element => {
                if (element.textContent == "index.php") {
                    // console.log(element)
                    element.style.display = "none"
                }
                if (element.textContent == "00_connection.php") {
                    // console.log(element)
                    element.style.display = "none"
                }
                // if (element.textContent == "iframe.php") {
                //     // console.log(element)
                //     element.style.display = "none"
                // }
                if (element.textContent == "03_read.php") {
                    // console.log(element)
                    element.classList = "active"
                }
            });
        </script>
    </section>
</body>

</html>