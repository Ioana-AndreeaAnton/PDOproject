<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Digital Business Category Flat Bootstrap Responsive Web Template | Home :: w3layouts</title>
        <!-- for-mobile-apps -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Digital Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
              Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />

        <script>
            addEventListener("load", function () {
                setTimeout(hideURLbar, 0);
            }, false);

            function hideURLbar() {
                window.scrollTo(0, 1);
            }
        </script>

        <!-- css files -->
        <link href="css/bootstrap.css" rel='stylesheet' type='text/css' /><!-- bootstrap css -->
        <link href="css/style.css" rel='stylesheet' type='text/css' /><!-- custom css -->
        <link href="css/font-awesome.min.css" rel="stylesheet"><!-- fontawesome css -->
        <!-- //css files -->

        <!-- google fonts -->
        <link href="//fonts.googleapis.com/css?family=Cabin:400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext,vietnamese" rel="stylesheet">
        <!-- //google fonts -->

    </head>
    <!-- //header -->
    <header class="py-4">
        <div class="container">
            <div id="logo">
                <h1> <a href="index.php"><span class="fa fa-cloud" aria-hidden="true"></span> Digital</a></h1>
            </div>
            <!-- nav -->
            <nav class="d-lg-flex">
                <div class="login-icon ml-lg-2">
                    <?php
                    session_start();
                    if (isset($_SESSION["user_name"])) {
                        $visits = 1;
                        if (isset($_COOKIE["visits"])) {
                            $visits = (int) $_COOKIE["visits"];
                        }
                        setcookie("visits", $visits + 1, time() + 60 * 60 * 24 * 30);
                        echo "<a href='logout.php'>Logout</a>";
                    } else {
                        header('Location:index.php');
                    }
                    ?>
                </div>
            </nav>
            <div class="clear"></div>
            <!-- //nav -->
        </div>
    </header>
    <!-- //header -->
    <!-- banner -->
    <div class="banner" id="home">
        <div class="container">
            <div class="row banner-text">
                <div class="slider-info col-lg-6">
                    <div class="banner-info-grid mt-lg-5">
                        <?php
                        //include connection file
                        include 'connection.php';
                        $sql1 = "DROP PROCEDURE IF EXISTS updateClient";
                        $sql2 = "CREATE PROCEDURE updateClient(IN intID int, IN strNume varchar(256), IN strImage varchar(256))
            BEGIN 
            UPDATE images SET title=strNume, image=strImage WHERE id=intID;
            END;";
                        $sql_t = "DROP TRIGGER IF EXISTS MysqlTrigger3";
                        $sql = "CREATE TRIGGER MysqlTrigger3 BEFORE UPDATE ON images FOR EACH ROW
            BEGIN
            INSERT INTO images_update(title,status,edtime) VALUES (NEW.title,'RECENTLY UPDATED', NOW());
            END;";

                        if (!isset($_POST["submit"])) {
                            $sql_1 = "SELECT * FROM images WHERE ID='{$_GET['id']}'";
                            $result = $con->query($sql_1);
                            $record = $result->fetch(PDO::FETCH_BOTH);
                        } else {
                            $sql_2 = "SELECT * FROM images WHERE ID='{$_POST['id']}'";
                            $result_2 = $con->query($sql_2);
                            $rec = $result_2->fetch(PDO::FETCH_BOTH);
                            ;
                            $strNume = $_POST['title'];
                            if (isset($_POST['image'])) {
                                $strImage = "./images/" . basename($_FILES['image']['name']);
                            } else {
                                $strImage = $rec['image'];
                                echo $strImage;
                            }

                            $stm_t = $con->prepare($sql_t);
                            $stm_t->execute();
                            $stm = $con->prepare($sql);
                            $stm->execute();
                            $stmt1 = $con->prepare($sql1);
                            $stmt2 = $con->prepare($sql2);
                            $stmt1->execute();
                            $stmt2->execute();
                            $intID = $_POST['id'];
                            $sql3 = "CALL updateClient('{$intID}','{$strNume}', '{$strImage}')";
                            $q = $con->query($sql3);
                            if (move_uploaded_file($_FILES['image']['tmp_name'], $strImage)) {
                                header('location:user.php');
                            } else {
                                $msg = "Vai! Vai! Vai!!!";
                            }
                        }
                        ?>       









                        <h1>Edit the information about the client :</h1>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                            Name:<br/><input type="text" name="title" value="<?php echo $record['title']; ?>"/><br/>
                            Image: <br/><input type="file" name="image" value="<?php echo $record['image']; ?>"><br/>
                            <img src="<?php echo $record['image']; ?>"><br/>
                            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"/>
                            <input type="submit" name="submit" value="Edit"/>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>



