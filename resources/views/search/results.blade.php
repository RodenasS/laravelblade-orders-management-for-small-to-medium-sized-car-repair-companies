@extends('components/layout')
@section('content')
    <body class="h-full">
    <div class="container px-6 mx-auto">

        <h4 class="mt-6 mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">Pagal paiešką "{{$searchTerm }}" rasti užsakymai:</h4>
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
                    @unless(count($orders) == 0)
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
                                            style="font-weight: bold; font-size: 20px; background-image: url('{{ asset('storage/assets/number-plate.png') }}'); background-size: 100%; background-repeat: no-repeat; padding: 0 13px; color: black;">
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
                                    @if (auth()->id() === $order->user_id || auth()->user()->isAdmin())
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
                                            @endif
                                            <a href="/orders/{{$order->id}}"
                                               class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                               aria-label="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                                     viewBox="0 0 576 512" fill="currentColor">
                                                    <path
                                                        d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/>
                                                </svg>
                                            </a>
                                        </div>
                                </td>
                            </tr>
                            </tbody>
                        @endforeach
                    @else
                        <h4 class="text-sm font-semibold text-gray-600 dark:text-gray-300">Užsakymų pagal paiešką nerasta.</h4>
                    @endunless
                </table>
                <div class="px-6 ">
                    {{$orders->links()}}
                </div>
            </div>
        </div>


        <h4 class="mt-6 mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">Pagal paiešką "{{$searchTerm }}" rasti automobiliai:</h4>
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                        <th class="px-4 py-3">Markė ir Modelis</th>
                        <th class="px-4 py-3">Valst. numeriai</th>
                        <th class="px-4 py-3">Savininkas</th>
                        <th class="px-4 py-3">VIN kodas</th>
                        <th class="px-4 py-3">Veiksmai</th>
                    </tr>
                    </thead>
                    @unless(count($vehicles) == 0)
                        @foreach ($vehicles as $vehicle)
                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 ">
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm ">
                                        <div class="relative hidden w-12 h-8 mr-3 rounded-full md:block">
                                            @if ($vehicle->brand == 'Audi')
                                                <img class="object-cover  rounded-full" src="https://pngimg.com/d/audi_PNG99491.png" alt="Audi" loading="lazy"/>
                                            @elseif ($vehicle->brand == 'BMW')
                                                <img class="object-cover rounded-full" src="https://static.wixstatic.com/media/6324ea_65286e963c6c4b74b79b8c8c0b69d371~mv2.png/v1/fill/w_1100,h_620,al_c,q_90,usm_0.66_1.00_0.01,enc_auto/BMW_COVER.png" alt="BMW" loading="lazy"/>
                                            @elseif ($vehicle->brand == 'Toyota')
                                                <img class="object-cover rounded-full" src="https://purepng.com/public/uploads/large/purepng.com-toyotatoyotamotor-corporationautomotivemanufactureraichimultinational-1701527678483qlu8n.png" alt="BMW" loading="lazy"/>
                                            @elseif ($vehicle->brand == 'Honda')
                                                <img class="object-cover rounded-full" src="https://www.pngmart.com/files/22/Honda-Civic-EG-Hatch-PNG-Isolated-Image.png" alt="BMW" loading="lazy"/>
                                            @elseif ($vehicle->brand == 'Ford')
                                                <img class="object-cover rounded-full" src="https://purepng.com/public/uploads/large/purepng.com-fordfordcarfodr-carvehicle-1701527484256fm2ov.png" alt="BMW" loading="lazy"/>
                                            @endif
                                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                        </div>
                                        <div>
                                            <p class="font-semibold">{{$vehicle->brand}}</p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">{{$vehicle->model}}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                        <span
                                            style="font-weight: bold; font-size: 20px; background-image: url('{{ asset('storage/assets/number-plate.png') }}'); background-size: 100%; background-repeat: no-repeat; padding: 0 13px; color: black;">
                                            {{$vehicle->license_plate}}
                                        </span>
                                </td>
                                <td class="px-4 py-3 text-sm"> {{$vehicle->client->name}}</td>
                                <td class="px-4 py-3 text-sm"> {{$vehicle->vin}} </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <a href="/vehicles/{{$vehicle->id}}/edit" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                           aria-label="Edit">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                            </svg>
                                        </a>
                                        <form method="POST" action="/vehicles/{{$vehicle->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                        </form>
                                        <a href="/vehicles/{{$vehicle->id}}" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                           aria-label="Show">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512" fill="currentColor"><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        @endforeach
                    @else
                        <h4 class="text-sm font-semibold text-gray-600 dark:text-gray-300">Automobilių pagal paiešką nerasta.</h4>
                    @endunless
                </table>
                <div class="px-6 mt-2 mb-2">
                    {{$vehicles->links()}}
                </div>
            </div>
        </div>

        <h4 class="mt-6 mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">Pagal paiešką "{{$searchTerm }}" rasti klientai:</h4>
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                        <th class="px-4 py-3">Vardas ir Pavardė</th>
                        <th class="px-4 py-3">Identifikacijos kodas</th>
                        <th class="px-4 py-3">El. paštas</th>
                        <th class="px-4 py-3">Telefono numeris</th>
                        <th class="px-4 py-3">Veiksmai</th>
                    </tr>
                    </thead>
                    @unless(count($clients) == 0)
                        @foreach ($clients as $client)
                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                            <img class="object-cover w-full h-full rounded-full"
                                                 src="https://cdn.icon-icons.com/icons2/2468/PNG/512/user_icon_149344.png"
                                                 alt="" loading="lazy"/>
                                            <div class="absolute inset-0 rounded-full shadow-inner"
                                                 aria-hidden="true"></div>
                                        </div>
                                        <div>
                                            <p class="font-semibold">{{$client->name}}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm">{{$client->clientCode}} </td>
                                <td class="px-4 py-3 text-sm"> {{$client->email}} </td>
                                <td class="px-4 py-3 text-sm"> {{$client->phone}} </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <a href="/clients/{{$client->id}}/edit"
                                           class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                           aria-label="Edit">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                 viewBox="0 0 20 20">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                            </svg>
                                        </a>
                                        <form method="POST" action="/clients/{{$client->id}}">
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
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        @endforeach
                    @else
                        <h4 class="text-sm font-semibold text-gray-600 dark:text-gray-300">Klientų pagal paiešką nerasta.</h4>
                    @endunless
                </table>
                <div class="px-6 ">
                    {{$clients->links()}}
                </div>
            </div>
        </div>

    </div>
    </body>
@endsection

