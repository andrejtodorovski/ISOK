<html lang="en">
<head>
    <title>Vezba so formi</title>
</head>
<body>
<form method="GET" action="collect.php">
    <h3>Registracija:</h3>
    Ime: <input type="text" name="ime"/> <br/>
    Prezime: <input type="text" name="prezime"/> <br/>
    Email: <input type="text" name="email"/> <br/>
    Masko: <input type="radio" name="pol" value="1"/>
    Zensko: <input type="radio" name="pol" value="0"/> <br/>
    <input type="submit" name="submit" value="Vnesi"/>
    Zapamti me: <input type="checkbox" name="zapamti_me" value="yes"/> <br/>
</form>
</body>
</html>