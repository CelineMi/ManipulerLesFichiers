
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<?php

include('inc/head.php');

if (isset($_GET['f'])) {

    $fichier = $_GET['f'];
    $contenu = file_get_contents($fichier);
}

if (isset($_POST['contenu'])){
    $fichier ='files/roswell/'. $_POST['filename'];
    $file = fopen($fichier, 'w');
    fwrite($file, $_POST['contenu']);
    fclose($file);
}

if (isset($_POST['delete'])){
    if (is_dir('files/roswell/' . $_POST['deleteFile'])){
        array_map('unlink', glob('files/roswell/' . $_POST['deleteFile']. '/*'));
        rmdir('files/roswell/' . $_POST['deleteFile']);
    }else{
        unlink('files/roswell/' . $_POST['deleteFile']);
    }
}

$it = new DirectoryIterator("files/roswell");

foreach($it as $file) {
        if(!$it->isDot()){

?>

        <a href=index.php?f=<?php echo $file ?> > <?php echo $file ?> </a>
        <form action="" method="post">
            <input type="hidden" name="deleteFile" value="<?php echo $file ?>">
            <input type="submit" name="delete" value="Supprimer">
        </form>

<?php

        }
}

/*while ($file = readdir($dir)){
    if ($file !='.' && $file !='..'){
        if (is_dir('files/roswell/' . $file)){
            $subdir = opendir('files/roswell/' . $file);
            while($subfiles = readdir($subdir)){
                if ($subfiles !='.' && $subfiles!='..') {
                    echo '<a href="?f=' . $subfiles . '"><br/>';
                    echo $subfiles;
                    echo '</a>';
                }
            }
        }else{
            echo '<a href="?f=' . $file .'"><br/>';
            echo $file;
            echo '</a>';
        }
        echo '<br/>';
    }

}*/

?>

<body>
<h4>Voici le contenu de tes répertoires et fichiers.</h4>
<div id="id=content">
    <form action="index.php" method="post">
        <input type="hidden" name="filename" value="<?php echo $_GET['f']?>">
        <textarea name="contenu" id="" style="width:100%;height: 200px;"><?php echo $contenu?></textarea>
        <input type="submit" value="Envoyer">

    </form>
</div>

</body>
</html>

<?php include('inc/foot.php'); ?>