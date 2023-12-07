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
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"
                        ></path>
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"> Viso užsakymų: </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{$totalOrders}}</p>
                </div>
            </div>
            <!-- Card -->
            <div
                class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
            >
                <div
                    class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500"
                >
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            fill-rule="evenodd"
                            d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"> Šiandien pridėta: </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"> {{ $ordersLast24Hours }} </p>
                </div>
            </div>
            <!-- Card -->
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"
                        ></path>
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Naujų per 7 dienas:</p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{ $ordersLast7Days }}</p>
                </div>
            </div>
            <!-- Card -->
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            fill-rule="evenodd"
                            d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Naujų per 31 dienas: </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"> {{ $ordersLast31Days }} </p>
                </div>
            </div>
        </div>
        <div class="">
            <div class="container px-6 mx-auto ">
                <div class="flex justify-between">
                    <form method="GET" action="{{ route('orders.index') }}">
                        <div class="mt-6 flex space-x-4">
                            <input type="text" id="start_date" name="start_date" class="form-input dark:border-gray-600 dark:bg-gray-700 dark:text-gray-400"
                                   value="{{ $start_date }}">
                            <input type="text" id="end_date" name="end_date" class="form-input dark:border-gray-600 dark:bg-gray-700 dark:text-gray-400" value="{{ $end_date }}">
                            <button type="submit"
                                    class="px-3 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                Filtruoti
                            </button>
                        </div>
                    </form>
                    <a class="mb-4 px-5 my-6 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                       href="/orders/create" role="button">
                        Sukurti naują užsakymą
                    </a>
                </div>
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
                                                <div class="relative hidden w-8 h-8 mr-3 md:block">
                                                    <svg class="object-cover w-full h-full " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="32" height="32">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
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
                                <p> Užsakymų nerasta</p>
                            @endunless
                        </table>
                        <div class="px-6 ">
                            {{$orders->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>

            flatpickr("#end_date", {
                enableTime: true, // Enable time picker
                dateFormat: "Y-m-d", // Date format including hours and minutes
                locale: "lt",
            });

            flatpickr("#start_date", {
                enableTime: true, // Enable time picker
                dateFormat: "Y-m-d", // Date format including hours and minutes
                locale: "lt",
            });

        </script>
@endsection
