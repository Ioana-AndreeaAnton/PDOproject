<?php
require_once "connection.php";
$sql1="DROP PROCEDURE IF EXISTS saveClient";
$sql2="CREATE PROCEDURE saveClient(IN intID int, IN strNume varchar(256), IN strImage varchar(256))
    BEGIN
    INSERT INTO images(id, title,image)VALUES(intID, strNume, strImage);
    END;";
$sql1_t="DROP trigger IF EXISTS MysqlTrigger1";
$sql_t="CREATE TRIGGER MysqlTrigger1 BEFORE INSERT ON images FOR EACH ROW
    BEGIN 
    INSERT INTO images_update(title, status, edtime) VALUES (NEW.title, 'RECENTLY ADDED ', NOW());
    END;";
if(isset($_POST['upload'])){
    $stmt_t1=$con->prepare($sql1_t);
    $stmt_t=$con->prepare($sql_t);
    $stmt_t1->execute();
    $stmt_t->execute();
    $stmt1=$con->prepare($sql1);
    $stmt2=$con->prepare($sql2);
    $stmt1->execute();
    $stmt2->execute();
    $intID=rand();
    $strImage="./images/clienti/". md5(uniqid(time())). basename($_FILES['image']['name']);
    $strNume=$_POST['text'];
    $sql3="CALL saveClient('{$intID}','{$strNume}', '{$strImage}')";
    $q=$con->query($sql3);
    if(move_uploaded_file($_FILES['image']['tmp_name'],$strImage)){
       header('location:user.php');
    }else{
        $msg="Vai! Vai! Vai!!!";
    }
}
?>



