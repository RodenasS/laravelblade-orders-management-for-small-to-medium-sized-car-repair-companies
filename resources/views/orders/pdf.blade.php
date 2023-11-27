<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="lt-LT" xml:lang="lt">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PVM Sąskaita faktūra</title>
    <style>
        * {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10px;
        }
        body {
            margin: 0;
            padding: 10px;
            background: #fff;
        }
        .invoice-container {
            width: 100%;
            padding: 5px;
        }
        .header-logo{
            width: auto;
            max-height: 110px;
            position: absolute;
        }

        .header {
            text-align: center;
            margin-bottom: 5px;
        }

        .header h2 {
            font-size: 13px;
        }

        .header h3 {
            font-size: 12px;
        }

        .info-section, .section {
            margin-bottom: 10px;
        }
        .info-section p, .section p {
            margin: 0;
            padding: 2px 0;
        }
        .company-info, .client-info {
            float: left;
            width: 50%;
        }
        .info-section:after, .section:after {
            content: "";
            display: table;
            clear: both;
        }
        .items-table, .vehicle-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .items-table th, .items-table td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }
        .vehicle-table th, .vehicle-table td {
            border: none;
            padding: 5px;
            text-align: left;
        }
        .totals-table {
            float: right;
            min-width: 80px;
            border-collapse: collapse;
        }
        .totals-table td {
            padding: 5px;
            text-align: left;
        }
        .signatures {
            text-align: left;
            margin-top: 20px;
        }
        .signature p {
            margin-left: 20px;
        }
    </style>
</head>
<body>
<div class="header-logo">
    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(storage_path('app/public/logos/logo.png'))) }}" class="header-logo" alt="Company Logo">
</div>
<div class="invoice-container">
    <div class="header">
        <h2>PVM SĄSKAITA FAKTŪRA</h2>
        <h3>Nr. </h3>
        <h3>{{ date('Y-m-d') }}</h3>
    </div>

    <div class="info-section">
        <div class="company-info">
            <h5> PARDAVĖJAS / SIUNTĖJAS</h5>
            <p><b>{{ $companyInformation->name }}</b></p>
            <p>Įmonės kodas: {{ $companyInformation->company_code }}</p>
            <p>PVM kodas: {{ $companyInformation->company_vat_code }}</p>
            <p>Adresas: {{ $companyInformation->address }}</p>
            <p>El. paštas : {{ $companyInformation->email }}</p>
            <p>Tel: {{ $companyInformation->phone_number }}, Fax: {{ $companyInformation->fax }}</p>
            <p>Ats.
                sąsk.: {{ $companyInformation->invoice_account }} {{ $companyInformation->invoice_account_bank }}</p>
        </div>

        <div class="client-info">
            <h5> PIRKĖJAS / GAVĖJAS</h5>
            <p><b>{{$order->client->name}}</b></p>
            <p>Įmonės kodas: {{$order->client->company_code}}</p>
            <p>PVM kodas: {{$order->client->company_vat_code}}</p>
            <p>Tel. nr.: {{$order->client->phone}}</p>
            <p>El. paštas: {{$order->client->email}}</p>
            <p>Kliento kodas: {{$order->client->clientCode}} </p>
        </div>

        <div class="clear"></div>
    </div>

    <div class="section">
        <h4>Automobilio informacija</h4>
        <table class="vehicle-table">
            <thead>
            <tr>
                <th>Valst. Nr.</th>
                <th>Markė / modelis</th>
                <th>Identifikavimo Nr. (VIN)</th>
                <th>Pirma registracija</th>
                <th>Rida, km</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $order->vehicle->license_plate }}</td>
                <td>{{ $order->vehicle->brand }} {{ $order->vehicle->model }}</td>
                <td>{{ $order->vehicle->vin }}</td>
                <td>{{ $order->vehicle->first_registration }}</td>
                <td>{{ $order->vehicle->mileage }}</td>
            </tr>
            </tbody>
        </table>
        <p><b>Kliento pageidavimai ir priėmėjo komentarai:</b></p>
        <p>{{ $order->description }}</p>

        <div class="section">
            <h4>Prekės / paslaugos</h4>
            <table class="items-table">
                <thead>
                <tr>
                    <th>Eil. Nr.</th>
                    <th>Prekės / paslaugos kodas</th>
                    <th>Prekės / paslaugos pavadinimas</th>
                    <th>Kiekis</th>
                    <th>Vienetai</th>
                    <th>Vieneto kaina (be PVM)</th>
                    <th>Suma (be PVM)</th>
                </tr>
                </thead>
                <tbody>
                @php $itemNumber = 1; @endphp
                @foreach($order->items as $item)
                    <tr>
                        <td>{{ $itemNumber++ }}</td>
                        <td>{{ $item->product_code }}</td>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->unit }}</td>
                        <td>{{ $item->unit_price }}</td>
                        <td>{{ $item->unit_price * $item->quantity }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="section">
                <div class="totals-container">
                    <table class="totals-table">
                        <tbody>
                        <tr>
                            <td><b>Iš viso suma:</b></td>
                            <td><b>{{ $order->total_ex_vat }} Eur.</b></td>
                        </tr>
                        <tr>
                            <td><b>PVM suma (21%):</b></td>
                            <td><b>{{$order->total_inc_vat - $order->total_ex_vat}} Eur.</b></td>
                        </tr>
                        <tr>
                            <td><b>Mokėjimo suma (su PVM):</b></td>
                            <td><b>{{$order->total_inc_vat}} Eur.</b></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="signatures">
        <div class="signature">
            <p><b>Prekes išdavė: </b></p>
            <p class="left-margin">(pareigos, vardas, pavardė, parašas)</p>
        </div>
        <div class="signature">
            <p><b>Prekes priėmė: </b></p>
            <p class="left-margin">(pareigos, vardas, pavardė, parašas)</p>
        </div>
    </div>
    </div>
</div>
</body>
</html>
