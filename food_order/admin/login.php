<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login - Food Order</title>
    <link rel="stylesheet" href="../css/admin.css">

</head>

<body>
    <div class="login">
        <h1 class="text-center">Login</h1>


        <form action="connexion-admin.php" method="POST" class="text-center">
            <p> username: </p>
            <input type="text" name="username" placeholder="Enter username">
            <p>Password: </p>
            <input type="password" name="password" placeholder="Enter password">

            <p><input type="submit" name="submit" value="Login" class="btn-primary"></p>
        </form>


        <p class="text-center">Created By - <a href="">Mehdi Kerkar</a> </p>
    </div>

</body>

</html>