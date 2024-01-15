@extends('components/layout')
@section('content')
    <div class="mt-8 px-6 grid gap-6 container mx-auto md:grid-cols-2 xl:grid-cols-4">
        <div
            class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
        >
            <div
                class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"> Viso užsakymų: </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{$totalOrders}}</p>
            </div>
        </div>
        <div
            class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
        >
            <div
                class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
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
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
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
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
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
                        <input type="text" id="start_date" name="start_date"
                               class="form-input dark:border-gray-600 dark:bg-gray-700 dark:text-gray-400"
                               value="{{ $start_date }}">
                        <input type="text" id="end_date" name="end_date"
                               class="form-input dark:border-gray-600 dark:bg-gray-700 dark:text-gray-400"
                               value="{{ $end_date }}">
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
                                                <svg class="object-cover w-full h-full "
                                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" width="32" height="32">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"/>
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
                                                <button
                                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray delete-button-order"
                                                    data-order-id="{{ $order->id }}" aria-label="Delete">
                                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                         viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                              d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                              clip-rule="evenodd"></path>
                                                    </svg>
                                                </button>
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
                                <div id="modal-overlay" class="fixed inset-0 bg-black bg-opacity-40 z-20 hidden"></div>
                                <div id="confirmation-modal-order-{{ $order->id }}"
                                     class="fixed inset-0 flex flex-col items-center justify-center z-30 hidden">
                                    <div
                                        class="border-2 border-gray-300 dark:border-gray-700 modal-container bg-white dark:bg-gray-800 md:w-96 rounded-lg p-6 shadow-lg relative"
                                        data-modal-id="confirmation-modal-order-{{ $order->id }}">
                                        <button id="modal-close-button-order-{{ $order->id }}"
                                                class="absolute top-0 right-0 m-4 p-2 z-40 text-gray-500 hover:text-red-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                        <div class="flex items-center justify-center mb-4">
                                            <div class="w-12 h-12 rounded-full flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 "
                                                     viewBox="0 0 24 24">
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
                                            pašalinti <strong
                                                style="background-image: linear-gradient(to right, #f83d5c, #fd4b2f); color: transparent; -webkit-background-clip: text; background-clip: text;">{{ $order->order_number }}</strong> užsakymą?
                                        </p>
                                        <div class="mt-6 flex justify-end">
                                            <button id="cancel-button-order-{{ $order->id }}"
                                                    class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-600 font-semibold rounded-lg mr-2 focus:outline-none focus:ring focus:ring-gray-300 dark:text-gray-200">
                                                Atšaukti
                                            </button>
                                            <form id="delete-form-order-{{ $order->id }}" method="POST"
                                                  action="{{ route('orders.destroy', $order->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button id="confirm-delete-button-order-{{ $order->id }}"
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
