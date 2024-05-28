<!DOCTYPE html>
<html lang="en">
<head>
    <title>Upload Form</title>
</head>
<body>

<?php foreach ($errors as $error): ?>
    <li><?= esc($error) ?></li>
<?php endforeach ?>

<form action="upload" method="POST" enctype="multipart/form-data">
    <input type="file" name="userfile" size="20">
    <br><br>
    <input type="submit" value="upload">
</form>

</body>
</html>
