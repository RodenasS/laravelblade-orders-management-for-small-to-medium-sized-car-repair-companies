@extends('components/layout')
@section('content')
        <div class="mt-8 px-6 grid gap-6 container mx-auto md:grid-cols-2 xl:grid-cols-4">
            <!-- Card -->
            <div
                class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
            >
                <div
                    class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500"
                >
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 256 256"><path d="M240,112H229.2L201.42,49.5A16,16,0,0,0,186.8,40H69.2a16,16,0,0,0-14.62,9.5L26.8,112H16a8,8,0,0,0,0,16h8v80a16,16,0,0,0,16,16H64a16,16,0,0,0,16-16V192h96v16a16,16,0,0,0,16,16h24a16,16,0,0,0,16-16V128h8a8,8,0,0,0,0-16ZM69.2,56H186.8l24.89,56H44.31ZM64,208H40V192H64Zm128,0V192h24v16Zm24-32H40V128H216ZM56,152a8,8,0,0,1,8-8H80a8,8,0,0,1,0,16H64A8,8,0,0,1,56,152Zm112,0a8,8,0,0,1,8-8h16a8,8,0,0,1,0,16H176A8,8,0,0,1,168,152Z"></path></svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"> Viso automobilių </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200" >{{$totalVehicles}}</p>
                </div>
            </div>
            <!-- Card -->
            <div
                class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
            >
                <div
                    class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500"
                >
                    <svg class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><path d="M213.66,202.34a8,8,0,0,1-11.32,11.32L128,139.31,53.66,213.66a8,8,0,0,1-11.32-11.32l80-80a8,8,0,0,1,11.32,0Zm-160-68.68L128,59.31l74.34,74.35a8,8,0,0,0,11.32-11.32l-80-80a8,8,0,0,0-11.32,0l-80,80a8,8,0,0,0,11.32,11.32Z"></path></svg>
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"> Šiandien pridėta: </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"> {{ $vehiclesLast24Hours }} </p>
                </div>
            </div>
            <!-- Card -->
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                    <svg class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm64-88a8,8,0,0,1-8,8H147.31l26.35,26.34a8,8,0,0,1-11.32,11.32l-40-40A8,8,0,0,1,128,120h56A8,8,0,0,1,192,128Z"></path></svg>
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Naujų per 7 dienas:</p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{ $vehiclesLast7Days }}</p>
                </div>
            </div>
            <!-- Card -->
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                    <svg class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><path d="M211.18,196.56,139.57,128l71.61-68.56a1.59,1.59,0,0,1,.13-.13A16,16,0,0,0,200,32H56A16,16,0,0,0,44.7,59.31l.12.13L116.43,128,44.82,196.56l-.12.13A16,16,0,0,0,56,224H200a16,16,0,0,0,11.32-27.31A1.59,1.59,0,0,1,211.18,196.56ZM56,48h0v0Zm144,0-72,68.92L56,48ZM56,208l72-68.92L200,208Z"></path></svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Naujų per 31 dienas: </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"> {{ $vehiclesLast31Days }} </p>
                </div>
            </div>
        </div>
        <body class="h-full ">
        <div class="container px-6 mx-auto">
            <div class="flex justify-end">
                <a class="mb-4 px-5 my-6 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" href="/vehicles/create" role="button">
                    Pridėti automobilį į sąrašą
                </a>
            </div>
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
                                    <td class="px-4 py-3 text-sm"> {{$vehicle->client->name}} {{$vehicle->client->surname}} </td>
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
                            <p> Nerasta jokių įrašų</p>
                        @endunless
                    </table>
                    <div class="px-6 mt-2 mb-2">
                        {{$vehicles->links()}}
                    </div>
                </div>
            </div>
        </div>
        </body>
@endsection

