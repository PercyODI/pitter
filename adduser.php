<?php
    session_start();
    include_once('header.php');
    include_once('functions.php');
?>
<!DOCTYPE html>
<html lang='en'>
    <head>
        <title>New Pitter User</title>
        <link rel="stylesheet" type="text/css" href="styling.css"> 
        <link href="css/bootstrap.css" rel="stylesheet">
    </head>
    <body>
        <div class="container" style="background-color: #A7A9B2">
            <br>
            <h1 class="jumbotron centerfy" style='background-color: #D1D6D8'>Create a New Pitter User</h1>
            <form method='post' action='adduserpost.php'>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Username" >
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <br>
        </div>
    </body>
</html>