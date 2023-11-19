@extends('components/layout')
@section('content')

        <body class="h-full ">
        <div class="container px-6 mx-auto">
            <h4
                class="mb-2 mt-16 text-lg font-semibold text-gray-600 dark:text-gray-300">Automobilio pridėjimas į sistemą
            </h4>
            <form method="POST" action="/vehicles" enctype="multipart/form-data">
                @csrf
                <div
                    class="px-4 py-3 mb-2 bg-white rounded-lg shadow-md dark:bg-gray-800"
                >
                    <label for="brand" class="mb-4 block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Markė</span>
                        <input
                            name="brand"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="Audi"
                            value="{{old('brand')}}"
                        />
                        @error('brand')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </label>

                    <label for="model" class="mb-4 block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Modelis</span>
                        <input
                            name="model"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="A4"
                            value="{{old('model')}}"
                        />
                    </label>
                    @error('model')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror

                    <label for="mileage" class="mb-4 block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Kilometražas</span>
                        <input
                            name="mileage"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="55461"
                            value="{{old('mileage')}}"
                        />
                    </label>
                    @error('mileage')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror

                    <label for="first_registration" class="mb-4 block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Pirmosios registracijos data:</span>
                        <input
                            type="text"
                        id="first_registration"
                        name="first_registration"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        />
                    </label>
                    @error('first_registration')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                    <script>
                        flatpickr("#first_registration", {
                            dateFormat: "Y-m-d",
                        });
                    </script>

                    <label for="license_plate" class="mb-4 block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Valstybinis numeris:</span>
                        <input
                            name="license_plate"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="LFI 646"
                            value="{{old('license_plate')}}"
                        />
                    </label>
                    @error('license_plate')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror

                    <label for="vin" class="mb-4 block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">VIN kodas:</span>
                        <input
                            name="vin"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="WAUZZZ8K6AA103083"
                            value="{{old('vin')}}"
                        />
                    </label>
                    @error('vin')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror

                    <label for="client_id" class="mb-4 block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Klientas:</span>
                        <select
                            name="client_id"
                            id="client_id"
                            class="client-select block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray"
                        >
                            <option value="">Select a Client</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }} {{ $client->surname }}
                                </option>
                            @endforeach
                        </select>
                    </label>
                    @error('client_id')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror

                    <label for="description" class="mb-4 block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Papildomas aprašas</span>
                        <textarea
                            name="description"
                            class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                            rows="3"
                            placeholder="Čia galite pasirašyti papildomą informaciją apie klientą."
                            value="{{old('description')}}"
                        ></textarea>
                    </label>
                    @error('description')
                    <p class="text-red-600 text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="flex justify-end">
                    <button class="mb-4 px-5 my-6 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" role="button" type="submit">
                        Pridėti automobilį į sąrašą
                    </button>
                </div>
            </form>
        </div>
        </body>
@endsection
