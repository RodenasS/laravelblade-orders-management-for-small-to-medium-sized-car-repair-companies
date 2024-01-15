@extends('components/layout')
@section('content')

    <body class="h-full ">
    <div class="container px-6 mx-auto">

        <div class="flex justify-between">
            <h4 class="mb-2 mt-16 text-lg font-semibold text-gray-600 dark:text-gray-300">
                Automobilio {{$order->vehicle->license_plate}} informacija
            </h4>
            <form action="{{ route('generatePDF', $order->id) }}" method="POST">
                @csrf
                <button type="submit"
                        class="px-5 mt-16 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                        role="button">
                    Generuoti PVM sąskaitą
                </button>
            </form>
        </div>
        <div class="px-4 py-3 mb-2 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <div class="mb-4">
                <span class="text-gray-700 dark:text-gray-400">Markė, modelis: </span> <br>
                <h5 class="font-semibold text-gray-700 dark:text-gray-400">{{ $order->vehicle->brand }} {{ $order->vehicle->model }}</h5>
            </div>

            <div class="mb-4">
                <span class="text-gray-700 dark:text-gray-400">Valstybinis numeris: </span>

                <h5 class="font-semibold text-gray-700 dark:text-gray-400">{{ $order->vehicle->license_plate }}</h5>
            </div>

            <div class="mb-4">
                <span class="text-gray-700 dark:text-gray-400">VIN kodas: </span>
                <h5 class="flex font-semibold text-gray-700 dark:text-gray-400">{{ $order->vehicle->vin }}
                    <a href="/vindecoder"
                       class="ml-2 flex items-center justify-betweentext-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                       aria-label="Show">
                        Nuskaityti VIN kodą</a>

                </h5>
            </div>

            <div class="mb-4">
                <span class="text-gray-700 dark:text-gray-400">Pirmosios registracijos data: </span>
                <h5 class="font-semibold text-gray-700 dark:text-gray-400">{{ $order->vehicle->first_registration }}</h5>
            </div>

            <div class="mb-4">
                <span class="text-gray-700 dark:text-gray-400">Automobilio rida užsakymo metu: </span>
                <h5 class="font-semibold text-gray-700 dark:text-gray-400">{{ $order->vehicle->mileage }}</h5>
            </div>

            <div class="mb-4">
                <span class="text-gray-700 dark:text-gray-400">Papildoma automobilio informacija: </span>
                <h5 class="font-semibold text-gray-700 dark:text-gray-400">{{ $order->vehicle->description }}</h5>
            </div>
        </div>
        <h4 class="mb-2 mt-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
            Kliento informacija
        </h4>
        <div class="px-4 py-3 mb-2 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <div class="mb-4">
                <span class="text-gray-700 dark:text-gray-400">Vardas bei pavardė / Pavadinimas: </span> <br>
                <h5 class="font-semibold text-gray-700 dark:text-gray-400">{{ $order->client->name }}</h5>
            </div>

            <div class="mb-4">
                <span class="text-gray-700 dark:text-gray-400">Įmonės kodas: </span>
                <h5 class="font-semibold text-gray-700 dark:text-gray-400">{{ $order->client->company_code }}</h5>
            </div>

            <div class="mb-4">
                <span class="text-gray-700 dark:text-gray-400">Įmonės pvm kodas: </span>
                <h5 class="font-semibold text-gray-700 dark:text-gray-400">{{ $order->client->company_vat_code }}</h5>
            </div>

            <div class="mb-4">
                <span class="text-gray-700 dark:text-gray-400">El. paštas: </span>
                <h5 class="font-semibold text-gray-700 dark:text-gray-400">{{ $order->client->email }}</h5>
            </div>

            <div class="mb-4">
                <span class="text-gray-700 dark:text-gray-400">Tel. numeris: </span>
                <h5 class="font-semibold text-gray-700 dark:text-gray-400">{{ $order->client->phone }}</h5>
            </div>

        </div>
        <h4 class="mb-2 mt-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
            Užsakymo detalės
        </h4>
        <div class="px-4 py-3 mb-2 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <div class="mb-4">
                <span class="text-gray-700 dark:text-gray-400">Numatoma darbų pradžia </span> <br>
                <h5 class="font-semibold text-gray-700 dark:text-gray-400">{{ $order->estimated_start }}</h5>
            </div>

            <div class="mb-4">
                <span class="text-gray-700 dark:text-gray-400">Numatoma darbų pabaiga: </span>
                <h5 class="font-semibold text-gray-700 dark:text-gray-400">{{ $order->estimated_end }}</h5>
            </div>

            <div class="mb-4">
                <span class="text-gray-700 dark:text-gray-400">Visa suma be PVM: </span>
                <h5 class="font-semibold text-purple-600 dark:text-gray-400">{{ $order->total_ex_vat }} €</h5>
            </div>

            <div class="mb-4">
                <span class="text-gray-700 dark:text-gray-400">Visa suma su taikomu 21% PVM: </span>
                <h5 class="font-semibold dark:text-gray-400 text-purple-600">{{ $order->total_inc_vat }} €</h5>
            </div>

            <div class="">
                <span class="text-gray-700 dark:text-gray-400">Užsakymo būsena: </span>
                @if (mb_strtolower(trim($order->status), 'UTF-8') == 'įvykdytas')
                    <span
                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">Įvykdytas</span>
                @endif

                @if (strtolower($order->status) == 'vykdomas')
                    <span
                        class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600">Vykdomas</span>
                @endif

                @if (strtolower($order->status) == 'atšauktas')
                    <span
                        class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">Atšauktas</span>
                @endif
            </div>
            @if($order->sms_notifications)
                <p class="text-red-600">SMS pranešimai yra įjungti ir klientui bus siunčiami kaskart atnaujinus užsakymo būseną!</p>
            @endif
            @if($order->email_notifications)
                <p class="text-red-600">El. pašto pranešimai yra įjungti ir klientui bus siunčiami kaskart atnaujinus užsakymo būseną!</p>
            @endif
            <div class="mb-4">
                <span class="text-gray-700 dark:text-gray-400">Papildoma užsakymo informacija: </span>
                <h5 class="font-semibold text-gray-700 dark:text-gray-400">{{ $order->description }}</h5>
            </div>
        </div>
        <div class="mt-6 w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3" style="width: 20%;">Prekės / paslaugos kodas</th>
                        <th class="px-4 py-3" style="width: 40%;">Prekės / paslaugos pavadinimas</th>
                        <th class="px-4 py-3" style="width: 15%;">Kiekis</th>
                        <th class="px-4 py-3" style="width: 15%;">Vienetai</th>
                        <th class="px-4 py-3" style="width: 15%;">Vieneto kaina (be PVM)</th>
                        <th class="px-4 py-3">Suma (be PVM)</th>
                    </tr>
                    </thead>
                    <tbody id="order-items" class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach($order->items as $index => $item)
                        <tr>
                            <td class="px-4 py-3">
                                <span class="block w-full dark:bg-gray-800 dark:text-gray-400"
                                      data-name="items[{{ $index }}][product_code]">{{ $item->product_code }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="block w-full dark:bg-gray-800 dark:text-gray-400"
                                      data-name="items[{{ $index }}][product_name]">{{ $item->product_name }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="block w-full dark:bg-gray-800 dark:text-gray-400"
                                      data-name="items[{{ $index }}][quantity]">{{ $item->quantity }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="block w-full dark:bg-gray-800 dark:text-gray-400"
                                      data-name="items[{{ $index }}][unit]">{{ $item->unit }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="block w-full dark:bg-gray-800 dark:text-gray-400"
                                      data-name="items[{{ $index }}][unit_price]">{{ $item->unit_price }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <span
                                    class="block w-full dark:bg-gray-800 dark:text-gray-400">{{ $item->unit_price*$item->quantity }} </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <h4 class="mb-2 mt-16 text-lg font-semibold text-gray-600 dark:text-gray-300">
            Prisegtos nuotraukos
        </h4>
        <span
            class="block w-full dark:bg-gray-800 dark:text-gray-400">Spausti ant nuotraukos norint ją išdidinti </span>
        <div class="flex" id="imagePreviewContainer">
            @foreach($order->images as $image)
                <div class="relative mr-2">
                    <img src="{{ Storage::url($image->path) }}"
                         class="mt-2 w-56 h-auto object-cover cursor-pointer image-item"/>
                    <button
                        class="mt-1 px-2 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple download-btn"
                        data-url="{{ Storage::url($image->path) }}">Atsisiųsti
                    </button>
                </div>
            @endforeach
        </div>
    </div>
    </body>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            function toggleImageSize(img) {
                img.classList.toggle("w-56");
                img.classList.toggle("w-full");
                img.classList.toggle("h-auto");
                img.classList.toggle("h-screen");
            }

            var images = document.querySelectorAll('.image-item');
            images.forEach(function (img) {
                img.addEventListener('click', function () {
                    toggleImageSize(this);
                });
            });

            function downloadImage(url) {
                var a = document.createElement('a');
                a.href = url;
                a.download = url.split('/').pop();
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
            }

            var downloadButtons = document.querySelectorAll('.download-btn');
            downloadButtons.forEach(function (btn) {
                btn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    downloadImage(this.getAttribute('data-url'));
                });
            });
        });
    </script>
@endsection
