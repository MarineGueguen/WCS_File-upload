<?php

if ($_SERVER['REQUEST_METHOD'] === "POST"){ 
    $uploadDir = 'uploads/';
    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $uploadFile = $uploadDir . uniqid('') . "." . $extension;
    $authorizedExtensions = ['jpg','png', 'gif', 'webp'];
    $maxFileSize = 1000000;
    if ((!in_array($extension, $authorizedExtensions))){
        $errors[] = 'Veuillez sélectionner une image de type Jpg ou Png ou Gif ou Webp !';
    }
    if (file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize)
    {
    $errors[] = "Votre fichier doit faire moins de 1M !";
    } else {
        move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);
    } 
}

?>

<h1>Profile</h1>
<div class="profile">
    <img src="<?= isset($uploadFile) ? $uploadFile : '' ?>" alt="profile_picture">
    <p>Firstname : <?= isset($_POST['firstname']) ? $_POST['firstname'] : '' ?></p>
    <p>Lastname : <?= isset($_POST['lastname']) ? $_POST['lastname'] : '' ?></p>
    <p>Age : <?= isset($_POST['age']) ? $_POST['age'] : '' ?></p>
</div>

<form method="post" enctype="multipart/form-data">
    <label for="firstname">Firstame</label>
    <input type="text" name="firstname" id="firstname">
    <label for="lastname">Lastame</label>
    <input type="text" name="lastname" id="lastname">
    <label for="age">Age</label>
    <input type="text" name="age" id="age">
    <label for="imageUpload">Upload an profile image</label>    
    <input type="file" name="avatar" id="imageUpload" />
    <button name="send">Send</button>
</form>
