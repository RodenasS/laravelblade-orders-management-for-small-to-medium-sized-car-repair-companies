@extends('components/layout')
@section('content')
        <div class="mt-8 px-6 grid gap-6 container mx-auto md:grid-cols-2 xl:grid-cols-4">

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
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200" >4613</p>
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
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"> 6513 </p>
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
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">653</p>
            </div>
        </div>
        <!-- Card -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                <svg class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><path d="M211.18,196.56,139.57,128l71.61-68.56a1.59,1.59,0,0,1,.13-.13A16,16,0,0,0,200,32H56A16,16,0,0,0,44.7,59.31l.12.13L116.43,128,44.82,196.56l-.12.13A16,16,0,0,0,56,224H200a16,16,0,0,0,11.32-27.31A1.59,1.59,0,0,1,211.18,196.56ZM56,48h0v0Zm144,0-72,68.92L56,48ZM56,208l72-68.92L200,208Z"></path></svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Naujų per 31 dienas: </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"> 1112 </p>
            </div>
        </div>
        </div>

        <body class="h-full ">
        <div class="container px-6 mx-auto">
        <p class="mb-8 text-gray-600 dark:text-gray-400">
            Charts are provided by
            <a
                class="text-purple-600 dark:text-purple-400 hover:underline"
                href="https://www.chartjs.org/"
            >
                Chart.js
            </a>
            . Note that the default legends are disabled and you should
            provide a description for your charts in HTML. See source code for
            examples.
        </p>

        <div class="grid gap-6 mb-8 md:grid-cols-2">
            <!-- Doughnut/Pie chart -->
            <div
                class="min-w-0 p-4 text-white bg-purple-600 rounded-lg shadow-xs"
            >
                <h4 class="mb-4 font-semibold">
                    Colored card
                </h4>
                <p>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    Fuga, cum commodi a omnis numquam quod? Totam exercitationem
                    quos hic ipsam at qui cum numquam, sed amet ratione! Ratione,
                    nihil dolorum.
                </p>
            </div>
            <!-- Lines chart -->
            <div
                class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
            >
                <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                    Lines
                </h4>
                <canvas id="line"></canvas>
                <div
                    class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400"
                >
                    <!-- Chart legend -->
                    <div class="flex items-center">
                    <span
                        class="inline-block w-3 h-3 mr-1 bg-teal-500 rounded-full"
                    ></span>
                        <span>Organic</span>
                    </div>
                    <div class="flex items-center">
                    <span
                        class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"
                    ></span>
                        <span>Paid</span>
                    </div>
                </div>
            </div>
            <!-- Bars chart -->
            <div
                class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
            >
                <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                    Bars
                </h4>
                <canvas id="bars"></canvas>
                <div
                    class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400"
                >
                    <!-- Chart legend -->
                    <div class="flex items-center">
                    <span
                        class="inline-block w-3 h-3 mr-1 bg-teal-500 rounded-full"
                    ></span>
                        <span>Shoes</span>
                    </div>
                    <div class="flex items-center">
                    <span
                        class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"
                    ></span>
                        <span>Bags</span>
                    </div>
                </div>
            </div>
            <div class="grid gap-6 mb-8 container mx-auto md:grid-cols-2">
                <div
                    class="min-w-0 p-4 text-white bg-purple-600 rounded-lg shadow-xs"
                >
                    <h4 class="mb-4 font-semibold">
                        Colored card
                    </h4>
                    <p>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                        Fuga, cum commodi a omnis numquam quod? Totam exercitationem
                        quos hic ipsam at qui cum numquam, sed amet ratione! Ratione,
                        nihil dolorum.
                    </p>
                </div>
                <div
                    class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
                >
                    <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                        Doughnut/Pie
                    </h4>
                    <canvas id="pie"></canvas>
                    <div
                        class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400"
                    >
                        <!-- Chart legend -->
                        <div class="flex items-center">
                    <span
                        class="inline-block w-3 h-3 mr-1 bg-blue-600 rounded-full"
                    ></span>
                            <span>Shirts</span>
                        </div>
                        <div class="flex items-center">
                    <span
                        class="inline-block w-3 h-3 mr-1 bg-teal-500 rounded-full"
                    ></span>
                            <span>Shoes</span>
                        </div>
                        <div class="flex items-center">
                    <span
                        class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"
                    ></span>
                            <span>Bags</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </body>
@endsection
