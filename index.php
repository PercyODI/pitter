<?php
    session_start();
    include_once('header.php');
    include_once('functions.php');

    $_SESSION['userid'] = 1;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Pearse's Digital Ocean Test Page</title>
        <!-- <link rel="stylesheet" type="text/css" href="styling.css"> -->
        <link href="css/bootstrap.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <h1 class="jumbotron">Welcome to Pitter!</h1>
            <?php
                if(isset($_SESSION['message'])) {
                    echo "<div class='alert alert-info fade in'><a href='#' class='close' data-dismiss='alert'>&times;</a>" . $_SESSION['message'] . "</div>";
                    unset($_SESSION['message']);
                }
            ?>
            <form method='post' action='add.php'>
            <p>Your status:</p>
            <textarea name='body' rows='5' cols='40' wrap=VIRTUAL></textarea>
            <p><input type='submit' value='submit'></p>
            </form>

            <div class='row'>
                <?php
                    $users = show_users($_SESSION['userid']);
                    if(count($users)) {
                        $myusers = array_keys($users);
                    }
                    else {
                        $myusers = array();
                    }
                    $myusers[] = $_SESSION['userid'];

                    $posts = show_posts($myusers, 10);

                    if (count($posts)){
                        echo "<div class='postList'>";
                        foreach ($posts as $key => $list){
                            echo "<div class='col-md-4' style='background-color: #E40606; border: 2px solid #B10000; padding: 15px;'>";
                            echo "<div>" . find_username($list['userid']) . "</div><br>";
                            echo "<div>" . $list['body'] . "</div>";
                            echo "<div>".$list['stamp'] . "</div>";
                            echo "</div>";
                        }
                        echo "</div>";
                    } 
                    else {
                        echo "<p><b>You haven't posted anything yet!</b></p>";
                    }
                ?>
            </div>
            <p><a href='users.php'>see list of users</a></p>
            <h2>Users you're following</h2>

            <?php
                if(count($users)) {
                    echo "<ul>";
                    foreach($users as $key => $value) {
                        echo "<li>" . $value . "</li>\n";
                    }
                    echo "</ul>";
                }
                else {
                    echo "<p><b>You're not following anyone yet!</b></p>";
                }
            ?>
        </div>
    </body>
</html>