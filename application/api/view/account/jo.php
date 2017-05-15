<?php
/**
 * Created by PhpStorm.
 * User: Jo
 * Date: 15/5/2017
 * Time: 11:31
 */

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>test</title>
    <script>
        function loadXMLDoc() {
            var xmlhttp;

            xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange=function()
            {
                if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    document.getElementById("joke").innerHTML=xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET","jo", true);
            xmlhttp.send();
        }
    </script>
</head>
<body>
    <div id="joke">Joke</div>
    <button type="button" onclick="loadXMLDoc()">On</button>
</body>
</html>
