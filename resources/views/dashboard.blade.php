@extends('components/layout')
@section('content')
    <style>
        .fc-h-event {
            border: 0;
        }
    </style>
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <div class="mb-4 mt-6">
                <span class=" text-gray-700 dark:text-gray-400">Sveiki, sugrįžę <b> {{$userName}}</b>! </span>
            </div>

                <div class="mb-4 font-semibold text-gray-800 dark:text-gray-300" id='calendar'></div>

            <h4 class="mt-6 mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">Šios dienos informacija</h4>

            <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
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
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"> Šiandien sukurtų klientų: </p>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{$clientsLast24Hours}}</p>
                    </div>
                </div>
                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                        <svg class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                            <path
                                d="M213.66,202.34a8,8,0,0,1-11.32,11.32L128,139.31,53.66,213.66a8,8,0,0,1-11.32-11.32l80-80a8,8,0,0,1,11.32,0Zm-160-68.68L128,59.31l74.34,74.35a8,8,0,0,0,11.32-11.32l-80-80a8,8,0,0,0-11.32,0l-80,80a8,8,0,0,0,11.32,11.32Z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Šiandien pridėtų automobilių
                        </p>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{$vehiclesLast24Hours}}</p>
                    </div>
                </div>
                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </div>
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Šiandien sukurtų užsakymų
                        </p>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{$ordersLast24Hours}}</p>
                    </div>
                </div>
                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </div>
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Šiandien vykdomų užsakymų</p>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{$ordersInVykdomasStatus}}</p>
                    </div>
                </div>
            </div>

            <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">Vykdomų užsakymų sąrašas</h4>

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
                                            style="font-weight: bold; font-size: 20px; background-image: url('{{ asset('storage/assets/number-plate.png') }}'); background-size: contain; min-width: 110px; max-width: 183px;  background-repeat: no-repeat; padding: 1px 18px; color: black;">
                                            {{$order->vehicle->license_plate}}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm"> {{$order->client->name}} {{$order->client->surname}}</td>
                                    <td class="px-4 py-3 text-xs">
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600">Vykdomas</span>
                                    </td>
                                    <td class="px-4 py-3">
                                                <a href="/orders/{{$order->id}}"
                                                   class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                   aria-label="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                                         viewBox="0 0 576 512" fill="currentColor">
                                                        <path
                                                            d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/>
                                                    </svg>
                                                </a>
                                    </td>
                                </tr>
                                </tbody>
                            @endforeach
                        @else
                            <p> No listings found</p>
                        @endunless
                    </table>
                    <div class="px-6 ">
                        {{$orders->links()}}
                    </div>
                </div>
            </div>
        </div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var calendarEl = document.getElementById('calendar');
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        timeZone: 'Europe/Vilnius',
                        locale: 'lt',
                        events: '/calendar-data',
                        eventTimeFormat: {
                            hour: '2-digit',
                            minute: '2-digit',
                            hour12: false
                        },
                        displayEventTime: false,
                        buttonText: {
                            today: 'Šiandien',
                            month: 'Mėnuo',
                            week: 'Savaitė',
                            day: 'Diena',
                            list: 'Sąrašas'
                        },
                    });

                    calendar.render();
                });
            </script>
    </main>
@endsection
