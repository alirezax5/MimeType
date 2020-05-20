# mime-type
![php](https://img.shields.io/badge/Php%20Version-7-brightgreen)
required
---------
* PHP >= 7

install :
composer require alirezax5/mime-type

Examples
---------
```
<?php

use alirezax5\MimeType;

include 'vendor/autoload.php';
if (isset($_FILES['file']))
    MimeType::setAllowMime('application/json');
if (MimeType::isAllowed($_FILES['file']['name'])) {
    echo 'ok';
}
?>

‎<h3>File Upload:</h3>‎
Select a file to upload: <br>‎
‎
<form action="index.php" method="post" enctype="multipart/form-data">
    ‎<input type="file" name="file" size="50">‎
    ‎<br>‎
    ‎<input type="submit" value="Upload File">‎
</form>
?>
```
