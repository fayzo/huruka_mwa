<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <form name="test" method="post">              
            <input type="text" name="name" value="<?php echo $_REQUEST['name']; ?>" size="40" />
            <input type="text" name="comment" value="<?php echo $_REQUEST['comment']; ?>" size="40" />
            <input type="submit" value="submit" />
        </form>
</body>
</html>