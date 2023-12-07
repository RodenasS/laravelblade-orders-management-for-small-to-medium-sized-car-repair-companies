@extends('components/layout')
@section('content')

    <body class="h-full ">
    <div class="container px-6 mx-auto">
        <h4 class="mb-2 mt-16 text-lg font-semibold text-gray-600 dark:text-gray-300">
            Automobilio {{$vehicle->license_plate}} informacija
        </h4>

        <div class="px-4 py-3 mb-2 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <div class="mb-4">
                <span class="text-gray-700 dark:text-gray-400">Markė, modelis: </span> <br>
                <h5 class="font-semibold text-gray-700 dark:text-gray-400">{{ $vehicle->brand }} {{ $vehicle->model }}</h5>
            </div>

            <div class="mb-4">
                <span class="text-gray-700 dark:text-gray-400">Valstybinis numeris: </span>

                <h5 class="font-semibold text-gray-700 dark:text-gray-400">{{ $vehicle->license_plate }}</h5>
            </div>

            <div class="mb-4">
                <span class="text-gray-700 dark:text-gray-400">VIN kodas: </span>
                <h5 class="flex font-semibold text-gray-700 dark:text-gray-400">{{ $vehicle->vin }}
                    <a href="/vin-decoder" class="ml-2 flex items-center justify-betweentext-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                       aria-label="Show">
                    Nuskaityti VIN kodą</a>

                </h5>

            </div>

            <div class="mb-4">
                <span class="text-gray-700 dark:text-gray-400">Pirmosios registracijos data: </span>
                <h5 class="font-semibold text-gray-700 dark:text-gray-400">{{ $vehicle->first_registration }}</h5>
            </div>

            <div class="mb-4">
                <span class="text-gray-700 dark:text-gray-400">Paskutinė užsakymų registruota rida: </span>
                <h5 class="font-semibold text-gray-700 dark:text-gray-400">{{ $vehicle->mileage }}</h5>
            </div>

            <div class="mb-4">
                <span class="text-gray-700 dark:text-gray-400">Papildoma automobilio informacija: </span>
                <h5 class="font-semibold text-gray-700 dark:text-gray-400">{{ $vehicle->description }}</h5>
            </div>
        </div>
        <h4 class="mb-2 mt-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
            Kliento informacija
        </h4>
        <div class="px-4 py-3 mb-2 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <div class="mb-4">
                <span class="text-gray-700 dark:text-gray-400">Vardas bei pavardė / Įmonės pavadinimas: </span> <br>
                <h5 class="font-semibold text-gray-700 dark:text-gray-400">{{ $vehicle->client->name }}</h5>
            </div>

            <div class="mb-4">
                <span class="text-gray-700 dark:text-gray-400">Įmonės kodas: </span>
                <h5 class="font-semibold text-gray-700 dark:text-gray-400">{{ $vehicle->client->company_code }}</h5>
            </div>

            <div class="mb-4">
                <span class="text-gray-700 dark:text-gray-400">Įmonės PVM kodas: </span>
                <h5 class="font-semibold text-gray-700 dark:text-gray-400">{{ $vehicle->client->company_vat_code }}</h5>
            </div>


            <div class="mb-4">
                <span class="text-gray-700 dark:text-gray-400">El. paštas: </span>
                <h5 class="font-semibold text-gray-700 dark:text-gray-400">{{ $vehicle->client->email }}</h5>
            </div>

            <div class="mb-4">
                <span class="text-gray-700 dark:text-gray-400">Tel. numeris: </span>
                <h5 class="font-semibold text-gray-700 dark:text-gray-400">{{ $vehicle->client->phone }}</h5>
            </div>

        </div>
        <h4 class="mb-2 mt-6 text-lg font-semibold text-gray-600 dark:text-gray-300">
            Užsakymai, kuriems priklauso {{$vehicle->license_plate}} automobilis:
        </h4>

                    @unless(count($orders) == 0)
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                        >
                            <th class="px-4 py-3">Užsakymo numeris</th>
                            <th class="px-4 py-3">Automobilio valst. numeriai</th>
                            <th class="px-4 py-3">Užsakovas</th>
                            <th class="px-4 py-3">Statusas</th>
                            <th class="px-4 py-3">Veiksmai</th>
                        </tr>
                        </thead>
                        @foreach ($orders as $order)
                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                            <svg class="object-cover w-full h-full rounded-full"
                                                 xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                 fill="#000000" viewBox="0 0 256 256">
                                                <path
                                                    d="M216,40H40A16,16,0,0,0,24,56V200a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V56A16,16,0,0,0,216,40Zm0,160H40V56H216V200ZM184,96a8,8,0,0,1-8,8H80a8,8,0,0,1,0-16h96A8,8,0,0,1,184,96Zm0,32a8,8,0,0,1-8,8H80a8,8,0,0,1,0-16h96A8,8,0,0,1,184,128Zm0,32a8,8,0,0,1-8,8H80a8,8,0,0,1,0-16h96A8,8,0,0,1,184,160Z"></path>
                                            </svg>
                                            <div class="absolute inset-0 rounded-full shadow-inner"
                                                 aria-hidden="true"></div>
                                        </div>
                                        <div>
                                            <p class="font-semibold">{{$order->order_number}}</p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">{{$order->vehicle->brand}} {{$order->vehicle->model}}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                        <span
                                            style="font-weight: bold; font-size: 20px; background-image: url('{{ asset('storage/assets/number-plate.png') }}'); background-size: contain; min-width: 110px; max-width: 183px;  background-repeat: no-repeat; padding: 1px 18px; color: black;">
                                            {{$order->vehicle->license_plate}}
                                        </span>
                                </td>
                                <td class="px-4 py-3 text-sm"> {{$order->client->name}} {{$order->client->surname}}</td>
                                <td class="px-4 py-3 text-xs">
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
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <a href="/orders/{{$order->id}}/edit"
                                           class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                           aria-label="Edit">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                 viewBox="0 0 20 20">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                            </svg>
                                        </a>
                                        <form method="POST" action="/orders/{{$order->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                aria-label="Delete">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                     viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                          d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                          clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                        </form>
                                        <a href="/orders/{{$order->id}}" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                           aria-label="Show">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512" fill="currentColor"><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        @endforeach
                    @else
                        <p> Nerasta jokių įrašų susijusių su šiuo automobiliu</p>
                    @endunless
                </table>
                <div class="px-6 ">
                    {{$orders->links()}}
                </div>
            </div>
        </div>
    </div>
    </body>
@endsection
