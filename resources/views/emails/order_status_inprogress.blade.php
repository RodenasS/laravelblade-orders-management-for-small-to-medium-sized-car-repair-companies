<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9fafb;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            max-width: 600px;
            padding: 20px;
            background-color: #fff;
        }
        h2 {
            color: #333;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            color: #666;
        }
        img {
            display: block;
            max-width: 100%;
            height: auto;
            margin: 0 auto;
        }
        .header {
            color: #7e3af2;
        }
    </style>
</head>
<body>
<div class="container">
    <img src="{{ asset('storage/' . $companyInformation->logo_path) }}" alt="{{ $companyInformation->name }}" width="150">
    <h2 class="header">Jūsų užsakymas yra <span class="header">vykdomas!</span></h2>
    <p>Sveiki, {{ $client->name }},</p>
    <p>Norime jums pranešti, jog jūsų užsakymas: {{ $order->order_number }} yra <span class="header">vykdomas</span>.</p>
    <p>Numanoma darbų pradžia: <span class="header">{{ $order->estimated_start }}</span></p>
    <p>Numanoma darbų pabaiga: <span class="header">{{ $order->estimated_end }}</span></p>
    <p class="header">Apie tolimesnę užsakymo eigą taip pat būsite informuotas el. paštu.</p>
    <br><br><br><br><br>
    <p>Ačiū, jog renkatės mūsų paslaugas!</p>
    <p>Jūsų, {{ $companyInformation->name }}.</p>
    <p>Adresas: {{ $companyInformation->address }}.</p>
    <p>Tel. nr: {{ $companyInformation->phone_number }}.</p>
    <p>El. paštas: {{ $companyInformation->email }}.</p>
</div>
</body>
</html>
