@extends('components/layout')
@section('content')
    <div class="mt-8 px-6 grid gap-6 container mx-auto md:grid-cols-2 xl:grid-cols-4">
        <div
            class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
        >
            <div
                class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500"
            >
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"
                    ></path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"> Viso klientų: </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{$totalClients}}</p>
            </div>
        </div>
        <div
            class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
        >
            <div
                class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500"
            >
                <svg class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                    <path
                        d="M213.66,202.34a8,8,0,0,1-11.32,11.32L128,139.31,53.66,213.66a8,8,0,0,1-11.32-11.32l80-80a8,8,0,0,1,11.32,0Zm-160-68.68L128,59.31l74.34,74.35a8,8,0,0,0,11.32-11.32l-80-80a8,8,0,0,0-11.32,0l-80,80a8,8,0,0,0,11.32,11.32Z"></path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"> Šiandien pridėta: </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"> {{ $clientsLast24Hours }} </p>
            </div>
        </div>
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Naujų per 7 dienas:</p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{ $clientsLast7Days }}</p>
            </div>
        </div>
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Naujų per 31 dienas: </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"> {{ $clientsLast31Days }} </p>
            </div>
        </div>
    </div>

    <body class="h-full ">

    <div class="container px-6 mx-auto">
        <div class="flex justify-end">
            <a class="mb-4 px-5 my-6 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
               href="/clients/create" role="button">
                Pridėti klientą
            </a>
        </div>
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
                    <form method="GET" action="{{ route('clients.index') }}">
                        <tr class="dark:bg-gray-800 text-gray-700 dark:text-gray-400 border-hidden">
                            <td class="px-4 py-3">
                                <input type="text" name="name" class="form-input block w-full dark:bg-gray-800"
                                       placeholder="Vardas Pavardė / Pavadinimas" value="{{ request('name') }}">
                            </td>
                            <td class="px-4 py-3">
                                <input type="text" name="clientCode" class="form-input block w-full dark:bg-gray-800"
                                       placeholder="Identifikacijos kodas" value="{{ request('clientCode') }}">
                            </td>
                            <td class="px-4 py-3">
                                <input type="email" name="email" class="form-input block w-full dark:bg-gray-800"
                                       placeholder="El. paštas" value="{{ request('email') }}">
                            </td>
                            <td class="px-4 py-3">
                                <input type="text" name="phone" class="form-input block w-full dark:bg-gray-800"
                                       placeholder="Telefono numeris" value="{{ request('phone') }}">
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-4 text-sm">
                                    <button type="submit"
                                            class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                        Filtruoti
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </form>
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
                                        <button
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray delete-button"
                                            aria-label="Delete" data-client-id="{{ $client->id }}">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                 viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                      d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                            <div id="modal-overlay" class="fixed inset-0 bg-black bg-opacity-40 z-20 hidden"></div>
                            <div id="confirmation-modal-{{ $client->id }}" class="fixed inset-0 flex flex-col items-center justify-center z-30 hidden">
                                <div class="border-2 border-gray-300 dark:border-gray-700 modal-container bg-white dark:bg-gray-800 md:w-96 rounded-lg p-6 shadow-lg relative">
                                    <button id="modal-close-button-{{ $client->id }}" class="absolute top-0 right-0 m-4 p-2 z-40 text-gray-500 hover:text-red-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                    <div class="flex items-center justify-center mb-4">
                                        <div class="w-12 h-12 rounded-full flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 " viewBox="0 0 24 24">
                                                <path fill="#f83d5c"
                                                      d="M19 7a1 1 0 00-1 1v11.191A1.92 1.92 0 00 15.99 21H8.01A1.92 1.92 0 00 6 19.191V8a1 1 0 00-2 0v11.191A3.918 3.918 0 008.01 23h7.98A3.918 3.918 0 0020 19.191V8a1 1 0 00-1-1Zm1-3h-4V2a1 1 0 00-1-1H9a1 1 0 00-1 1v2H4a1 1 0 000 2h16a1 1 0 000-2ZM10 4V3h4v1Z"
                                                      data-original="#fd4b2f"/>
                                                <path fill="#f83d5c"
                                                      d="M11 17v-7a1 1 0 00-2 0v7a1 1 0 00 2 0Zm4 0v-7a1 1 0 00-2 0v7a1 1 0 00 2 0Z"
                                                      data-original="#fd4b2f"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <h2 class="text-gray-600 text-xl font-semibold text-center mb-4 dark:text-gray-200">
                                        <span>Ištrinimo patvirtinimas</span>
                                    </h2>
                                    <p class="text-gray-600 mb-6 text-center dark:text-gray-200">Ar tikrai norite
                                        pašalinti klientą <strong
                                            style="background-image: linear-gradient(to right, #f83d5c, #fd4b2f); color: transparent; -webkit-background-clip: text; background-clip: text;">{{ $client->name }}</strong>?
                                    </p>
                                    <div class="mt-6 flex justify-end">
                                        <button id="cancel-button-{{ $client->id }}"
                                                class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-600 font-semibold rounded-lg mr-2 focus:outline-none focus:ring focus:ring-gray-300 dark:text-gray-200">
                                            Atšaukti
                                        </button>
                                        <form id="delete-form-{{ $client->id }}" method="POST"
                                              action="/clients/{{ $client->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button id="confirm-delete-button-{{ $client->id }}"
                                                    style="background-image: linear-gradient(to right, #f83d5c, #fd4b2f); color: white;"
                                                    class="px-4 py-2 font-semibold rounded-lg shadow-md focus:outline-none focus:ring focus:ring-red-400">
                                                Ištrinti
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p> No listings found</p>
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

