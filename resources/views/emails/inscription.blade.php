<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email de confirmation d'inscription</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h1 {
            color: #333;
            font-size: 24px;
        }
        h2 {
            color: #666;
            font-size: 18px;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
        }
        li strong {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Email de confirmation d'inscription</h1>
    <h2>Informations fournies</h2>
    <ul>
        <li>Nom : <strong>{{ $info['nom'] }} <span> </span> {{ $info['prenom'] }}</strong></li>
        <li>Email : <strong> {{ $info['email'] }}</strong></li>
    </ul>
</body>
</html>
