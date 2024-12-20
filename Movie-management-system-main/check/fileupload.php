<?php
  if(isset($_POST['submit'])){
    $filename = $_FILES['upfile']['name'];
    $tmploc= $_FILES['upfile']['tmp_name'];
    $uploc ="images/".$filename;

    if(move_uploaded_file($tmploc,$uploc)){
         echo "Uploaded.";

    }else{
        echo "Not uploaded";
    }

  }
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method ="POST" >
<input type ="file" name="upfile"><br><br>
<input type ="submit" value="Upload" name="submit">

</form>