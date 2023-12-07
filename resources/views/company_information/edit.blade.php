
@extends('components/layout')
@section('content')
    <body class="h-full ">
    <div class="container px-6 mx-auto">
        <h4
            class="mb-2 mt-16 text-lg font-semibold text-gray-600 dark:text-gray-300"> Įmonės rekvizitų redagavimas
        </h4>
        <form method="POST" action="/company_information/{{$company->id}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div
                class="px-4 py-3 mb-2 bg-white rounded-lg shadow-md dark:bg-gray-800"
            >
                <!-- Existing Logo -->
                @if ($company->logo_path)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $company->logo_path) }}" alt="{{ $company->name }} Logo" class="object-cover w-auto h-32 rounded-full">
                        <button
                            type="button"
                            class="mt-2 text-red-500 text-sm hover:underline focus:outline-none"
                            onclick="confirm('Ar tikrai norite pašalinti logotipą?') ? document.getElementById('logo_delete').submit() : null"
                        >
                            Ištrinti logotipą
                        </button>
                </div>
                @endif
                <!-- Logo Upload Field -->
                <label for="logo" class="block text-sm text-gray-700 dark:text-gray-400">Pakeisti logotipą</label>
                <input
                    type="file"
                    name="logo"
                    accept="image/*"
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                />
                @error('logo')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <label for="name" class="mb-4 block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Pavadinimas</span>
                    <input
                        name="name"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder="Automistro"
                        value="{{$company->name}}"
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
                        value="{{$company->company_code}}"
                    />
                </label>
                @error('company_code')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror

                <label for="company_vat_code" class="mb-4 block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Įmonės PVM kodas</span>
                    <input
                        name="company_vat_code"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder=""
                        value="{{$company->company_vat_code}}"
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
                        placeholder=""
                        value="{{$company->address}}"
                    />
                </label>
                @error('address')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
                <label for="phone_number" class="mb-4 block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Telefono numeris</span>
                    <input
                        name="phone_number"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder="+37062146987"
                        value="{{$company->phone_number}}"
                    />
                </label>
                @error('phone_number')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror

                <label for="fax" class="mb-4 block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Faksas:</span>
                    <input
                        name="fax"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder=""
                        value="{{$company->fax}}"
                    />
                </label>
                @error('fax')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror

                <label for="email" class="mb-4 block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">El. paštas</span>
                    <input
                        name="email"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder="info@automistro.lt"
                        value="{{$company->email}}"
                    />
                </label>
                @error('email')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror

                <label for="invoice_account" class="mb-4 block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Atsiskaitomoji saskaita</span>
                    <input
                        name="invoice_account"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder=""
                        value="{{$company->invoice_account}}"
                    />
                </label>
                @error('invoice_account')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror

                <label for="invoice_account_bank" class="mb-4 block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Atsiskaitomosios saskaitos bankas</span>
                    <input
                        name="invoice_account_bank"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder=""
                        value="{{$company->invoice_account_bank}}"
                    />
                </label>
                @error('invoice_account_bank')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror

            </div>
            <div class="flex justify-end">
                <button class="mb-4 px-5 my-6 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" role="button" type="submit">
                    Išsaugoti
                </button>
            </div>
        </form>
        <form
            id="logo_delete"
            method="POST"
            action="{{ route('company_information.delete_logo', $company->id) }}"
            style="display: none;"
        >
            @csrf
            @method('DELETE')
        </form>

    </div>
    </body>
@endsection
