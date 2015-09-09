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
        <link rel="stylesheet" type="text/css" href="styling.css"> 
        <link href="css/bootstrap.css" rel="stylesheet">
    </head>
    <body>
        <div class="container" style="background-color: #A7A9B2">
            <br>
            <h1 class="jumbotron centerfy" style='background-color: #D1D6D8'>Welcome to Pitter!</h1>            
            <?php
                if(isset($_SESSION['message'])) {
                    echo "<div class='alert alert-info fade in'><a href='#' class='close' data-dismiss='alert'>&times;</a>" . $_SESSION['message'] . "</div>";
                    unset($_SESSION['message']);
                }
            ?>
            <form method='post' action='add.php'>
                <p>Your status:</p>
                <textarea class="form-control" rows="2" name="body"></textarea>
                <p><input type='submit' value='submit'></p>
            </form>
            <?php
                $users = show_users($_SESSION['userid']);
                if(count($users)) {
                    $myusers = array_keys($users);
                }
                else {
                    $myusers = array();
                }
                $myusers[] = $_SESSION['userid'];

                $posts = show_posts($myusers, 9);

                if (count($posts)){
                    echo "<div class='row'>\n";
                    foreach ($posts as $key => $list){ 
                        echo "<div class='col-md-4 vert-padding'>\n";
                            echo "<div class='centerfy' style='background-color: #DEE6DF; border: 2px solid #99C7A3; border-radius: 25px; padding: 8px;'>\n";
                                echo "<div style='text-decoration: underline;'>" . find_username($list['userid']) . "</div>\n";
                                echo "<div>" . $list['body'] . "</div>\n";
                                echo "<div>".$list['stamp'] . "</div>\n";
                            echo "</div>\n";
                        echo "</div>\n";
                    }
                    echo "</div>\n";
                } 
                else {
                    echo "<p><b>You haven't posted anything yet!</b></p>\n";
                }
            ?>
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