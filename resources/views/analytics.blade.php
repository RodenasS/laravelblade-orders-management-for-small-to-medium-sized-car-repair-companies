@extends('components/layout')
@section('content')

    <div class="mt-8 px-6 grid gap-6 container mx-auto md:grid-cols-2 xl:grid-cols-4">
        <div
            class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
        >
            <div
                class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500"
            >
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 256 256">
                    <path
                        d="M240,112H229.2L201.42,49.5A16,16,0,0,0,186.8,40H69.2a16,16,0,0,0-14.62,9.5L26.8,112H16a8,8,0,0,0,0,16h8v80a16,16,0,0,0,16,16H64a16,16,0,0,0,16-16V192h96v16a16,16,0,0,0,16,16h24a16,16,0,0,0,16-16V128h8a8,8,0,0,0,0-16ZM69.2,56H186.8l24.89,56H44.31ZM64,208H40V192H64Zm128,0V192h24v16Zm24-32H40V128H216ZM56,152a8,8,0,0,1,8-8H80a8,8,0,0,1,0,16H64A8,8,0,0,1,56,152Zm112,0a8,8,0,0,1,8-8h16a8,8,0,0,1,0,16H176A8,8,0,0,1,168,152Z"></path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"> Viso automobilių: </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{$totalVehicles}}</p>
            </div>
        </div>
        <div
            class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
        >
            <div
                class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500"
            >
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"
                    ></path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"> Viso klientų: </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"> {{$totalClients}} </p>
            </div>
        </div>
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Viso užsakymų:</p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{$totalOrders}}</p>
            </div>
        </div>
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                <svg class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                    <path
                        d="M211.18,196.56,139.57,128l71.61-68.56a1.59,1.59,0,0,1,.13-.13A16,16,0,0,0,200,32H56A16,16,0,0,0,44.7,59.31l.12.13L116.43,128,44.82,196.56l-.12.13A16,16,0,0,0,56,224H200a16,16,0,0,0,11.32-27.31A1.59,1.59,0,0,1,211.18,196.56ZM56,48h0v0Zm144,0-72,68.92L56,48ZM56,208l72-68.92L200,208Z"></path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Viso pajamų: </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"> {{$totalOrdersIncVat}} €</p>
            </div>
        </div>
    </div>
    @foreach($companies as $company)
        <body class="h-full ">
        <div class="container px-6 mx-auto">

            <form method="GET" action="{{ route('analytics') }}">
                <div class="mt-6 flex space-x-4">
                    <input type="date" id="start_date" name="start_date" class="form-input dark:border-gray-600 dark:bg-gray-700 dark:text-gray-400"
                           value="{{ request('start_date') }}">
                    <input type="date" id="end_date" name="end_date" class="form-input dark:border-gray-600 dark:bg-gray-700 dark:text-gray-400"
                           value="{{ request('end_date') }}">
                    <button type="submit" class="px-3 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Filtruoti</button>
                </div>
            </form>

            <div class="grid gap-6 mb-8 md:grid-cols-2">
                <div class="mt-6 min-w-0 p-4 text-white bg-purple-600 rounded-lg shadow-xs">
                    <h4 class="mb-4 font-semibold">
                        Klientai
                    </h4>
                    <p>Klientai, kurie daugiausiai kartų lankėsi <b>{{$company->name}}</b> bei atliko užsakymus:
                        <b>{{$commaSeparatedNames}}.</b></p>
                    <br> Skaičius klientų, kurie <b>{{$company->name}}</b> paslaugomis naudojosi ne vieną kartą:
                    <b>{{$repeatClients}}.</b>
                </div>
                <div class="mt-6 min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                        Klientų augimo grafikas:
                    </h4>
                    <canvas id="line"></canvas>
                    <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
                        <div class="flex items-center">
                    <span class="inline-block w-3 h-3 mr-1 bg-teal-500 rounded-full"></span>
                            <span>Klientai</span>
                        </div>
                    </div>
                </div>
                <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">Daugiausiai kartų remontuoti automobiliai, kurių gamintojas:</h4>
                    <canvas id="bars"></canvas>
                    <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
                    </div>
                </div>
                <div class="grid gap-6 mb-8 container mx-auto md:grid-cols-2">
                    <div class="min-w-0 p-4 text-white bg-purple-600 rounded-lg shadow-xs">
                        <h4 class="mb-4 font-semibold">Automobiliai</h4>
                        <p>Penkios daugiausia kartų <b>{{$company->name}}</b> remontuotos automobilio markės:<b>{{$commaSeparatedBrands}}.</b></p>
                        <br> Automobilių, kuriems atliktos paslaugos, ridos vidurkis: <b>{{$averageMileage}} km..</b>
                        </p>
                    </div>
                    <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                        <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">Daugiausiai kartų remontuoti automobiliai:</h4>
                        <canvas id="pie"></canvas>
                    </div>
                </div>
                <div class="grid gap-6 mb-8 container mx-auto md:grid-cols-2">
                    <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                        <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">Užsakymų statusų diagrama:</h4>
                        <canvas id="orderStatusPieChart"></canvas>
                    </div>
                    <div class="min-w-0 p-4 text-white bg-purple-600 rounded-lg shadow-xs">
                        <h4 class="mb-4 font-semibold">Užsakymai</h4>
                        <p>Vidutinis įmonės <b>{{$company->name}}</b> užsakymo laikas : <b>{{ number_format($averageOrderDuration,2)}} </b> dienos, per <b> {{$totalfilteredOrders}} </b> užsakymus.</p>
                        <br> Iš šių užsakymų gauta pajamų:
                        <b>{{ number_format($orderTotals['totalOrdersExVat'], 2) }} € be PVM,
                            {{ number_format($orderTotals['totalOrdersIncVat'], 2) }} € su PVM.</b>
                        </p>
                    </div>
                </div>
                <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">Užsakymų augimo grafikas:</h4>
                    <canvas id="orderlineConfig"></canvas>
                    <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
                    </div>
                </div>
            </div>
        </div>
        </body>
    @endforeach
    <script>
        var newClientsData = @json($newClientsData);
        var VehiclesData = @json($brandOrders);
        var ModelsData = @json($mostServicedVehicles);
        var newOrdersData = @json($totalOrdersPastYear);

        var orderStatuses = @json($orderStatusLabels);
        var orderStatusCounts = @json($orderStatusData);

        var top3Brands = VehiclesData.slice(0, 5);
        var top3BrandLabels = top3Brands.map(item => item.brand);
        var top3BrandCounts = top3Brands.map(item => item.total_orders);

        var top5BrandModels = ModelsData.slice(0, 5);
        var top5BrandModelLabels = top5BrandModels.map(item => item.brand + ' ' + item.model);
        var top5BrandModelCounts = top5BrandModels.map(item => item.total_orders);

        var orderStatuses = @json($orderStatusLabels);
        var orderStatusCounts = @json($orderStatusData);
    </script>
@endsection
