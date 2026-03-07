<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des Patients</title>
</head>
<body>
    </h1>Liste des Patients</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>CIN</th>
                <th>Date de Naissance</th>
                <th>Sexe</th>
                <th>Adresse</th>
                <th>Téléphone</th>
            </tr>
        </thead>
        <tbody>
            @foreach($patients as $patient)
            <tr>
                <td>{{ $patient->id }}</td>
                <td>{{ $patient->last_name }}</td>
                <td>{{ $patient->first_name }}</td>
                <td>{{ $patient->cin }}</td>
                <td>{{ $patient->birth_date }}</td>
                <td>{{ $patient->gender}}</td>
                <td>{{ $patient->address }}</td>
                <td>{{ $patient->phone }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
