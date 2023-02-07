<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Document</title>
</head>
<body>

<video autoplay muted loop>
    <source src="https://www.youtube.com/embed/ArT2dKNHW7c?start=189" type="video/webm">
</video>

<div class="form">
    <h1>Log in / Sign in</h1>
</div>
<div class="form">
    
        <form action="login.php" method="POST">
            <table>
                <tr><td class="izq">User:</td><td class="der"><input type="text" name="nombre"></td></tr>
                <tr><td class="izq">Pass:</td><td class="der"><input type="password" name="contrasena"></td></tr>
                <tr><td colspan="2"><input type="submit" name="registro" value="Sign in"></td>
                <td colspan="2"><input type="submit" name="login" value="Log in"></td></tr>
            </table><br><br><br><br><br><br><br><br><br>
        </form>
</div>
</body>
</html>