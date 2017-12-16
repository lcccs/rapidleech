<?php
    // No direct access to form
    if( ! defined('APPNAME') ) {
            die('');
    }
?>
<!doctype html>
<html>
<head>
<style>
    form{
            width: 400px;
            height: 200px;
            margin: 0 auto;
        } 

    textarea{
        width: 400px;
        height: 190px;
        }

    input{
        margin-top: 10px;
        }
</style>
</head>

<body>
<form action="" method="post">
        <textarea name="ct" id="ct">sample text</textarea>
        <input type="submit" value="submit" />
    </form>
</body>
</html>

