<!DOCTYPE html>
<html>
<head>
    <title>Slaptažodžio atstatymas - {{ $companyInformation->name }}</title>
</head>
<body>
<p>Sveiki,</p>
<p>Jūs {{ now()->format('Y-m-d H:i:s') }} sukūrėte užklausą atstatyti slaptažodį paskyrai <strong> {{ $user->email }} </strong>.</p>
<p> Jūsų naujas slaptažodis: </p>
<p><strong>{{ $newPassword }}</strong></p>
<p>Dėl saugumo, prašome prisijungus į paskyrą nedelsiant pasikeisti slaptažodį profilio nustatymuose.</p>

<p>Ši žinutė siunčiama iš įmonės {{ $companyInformation->name }} užsakymų valdymo sistemos.</p>

<img src="{{ asset('storage/' . $companyInformation->logo_path) }}" alt="" width="150">

</body>
</html>
