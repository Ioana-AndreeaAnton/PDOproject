<?php
 include "connection.php";
 $sql1="DROP PROCEDURE IF EXISTS deleteClient";
 $sql2="CREATE PROCEDURE deleteClient(IN intID int)
     BEGIN
     DELETE FROM images WHERE id=intID;
     END;";
 $sql="DROP TRIGGER IF EXISTS MysqlTrigger2";
 $sql_t="CREATE TRIGGER MysqlTrigger2 AFTER DELETE ON images FOR EACH ROW 
     BEGIN
     INSERT INTO images_update(title, status, edtime) VALUES (OLD.title, 'DELETED', NOW());
     END;";
$stmt=$con->prepare($sql);
$stmt->execute();
$stmt_t=$con->prepare($sql_t);
$stmt_t->execute();
$stmt1=$con->prepare($sql1);
$stmt2=$con->prepare($sql2);
$stmt1->execute();
$stmt2->execute();
$intID=$_GET['id'];
$sql3="CALL deleteClient('{$intID}')";
$q=$con->query($sql3);
header('Location:user.php');
?>
