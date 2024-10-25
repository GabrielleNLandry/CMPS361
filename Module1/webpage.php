<html>
    <head>
        <title> My first PHP Page </title>
        <style>
            body {
                font-family: Arial, Helvetica, sans-serif;
                background-color: #f4f4f4;
                color: #333;
                text-align: center;
                margin-top: 50px;
            }
        </style>
    </head>
    <body>
        <!-- Add Php to the body -->
        <?php
        $name = "Russel Wilson";
        ?>

        <p>Hi! My name is <?php echo $name ?>, and I am the new steelers QB for 2024.</p>

    </body>
</html>