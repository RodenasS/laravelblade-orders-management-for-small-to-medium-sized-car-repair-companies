@extends('components/layout')
@section('content')
        <body class="h-full ">
        <div class="container px-6 mx-auto">
            <h4
                class="mb-2 mt-16 text-lg font-semibold text-gray-600 dark:text-gray-300">Naujo kliento sukurimas
            </h4>
            <form method="POST" action="/clients" enctype="multipart/form-data">
                @csrf
                <div
                    class="px-4 py-3 mb-2 bg-white rounded-lg shadow-md dark:bg-gray-800"
                >
                    <label for="name" class="mb-4 block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Vardas Pavardė / Įmonės pavadinimas</span>
                        <input
                            name="name"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="Vardenis Pavardenis"
                            value="{{old('name')}}"
                        />
                        @error('name')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </label>

                    <label for="company_code" class="mb-4 block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Įmonės kodas</span>
                        <input
                            name="company_code"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder=""
                            value="{{old('company_code')}}"
                        />
                    </label>
                    @error('company_code')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror

                    <label for="company_vat_code" class="mb-4 block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">PVM kodas</span>
                        <input
                            name="company_vat_code"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder=""
                            value="{{old('company_vat_code')}}"
                        />
                    </label>
                    @error('company_vat_code')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror

                    <label for="address" class="mb-4 block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Adresas</span>
                        <input
                            name="address"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="Gatvės g., 7"
                            value="{{old('address')}}"
                        />
                    </label>
                    @error('address')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror

                    <label for="email" class="mb-4 block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">El. paštas</span>
                        <input
                            name="email"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="vardenis.pavardenis@gmail.com"
                            value="{{old('email')}}"
                        />
                    </label>
                    @error('email')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                    <label for="phone" class="mb-4 block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Telefono numeris</span>
                        <input
                            name="phone"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="+370XXXXXXX"
                            value="{{old('phone')}}"
                        />
                    </label>
                    @error('phone')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="flex justify-end">
                    <button class="mb-4 px-5 my-6 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" role="button" type="submit">
                        Pridėti klientą
                    </button>
                </div>
            </form>
        </div>
        </body>
@endsection
