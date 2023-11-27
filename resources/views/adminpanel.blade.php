@extends('components/layout')
@section('content')

    <div class="container px-6 mx-auto">

        <h4 class="mb-2 mt-16 text-lg font-semibold text-gray-600 dark:text-gray-300">Įmonės rekvizitai</h4>
        @foreach($companies as $company)
            <div class="flex justify-between">
                <span class="text-gray-700 dark:text-gray-400"> Šiuo metu įmonės rekvizitai yra: </span>
                <a class="self-center mb-4 px-3 my-3 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                   href="/company_information/1/edit/" role="button">
                    Redaguoti įmonės rekvizitus
                </a>
            </div>
            <div class="mb-8 px-4 py-3 mb-2 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <div class="mb-4">
                    <span class="text-gray-700 dark:text-gray-400">Įmonės pavadinimas: </span> <br>
                    <h5 class="font-semibold text-gray-700 dark:text-gray-400">{{ $company->name }}</h5>
                </div>
                <div class="mb-4">
                    <span class="text-gray-700 dark:text-gray-400">Įmonės kodas: </span> <br>
                    <h5 class="font-semibold text-gray-700 dark:text-gray-400">{{ $company->company_code }}</h5>
                </div>
                <div class="mb-4">
                    <span class="text-gray-700 dark:text-gray-400">Įmonės PVM kodas: </span> <br>
                    <h5 class="font-semibold text-gray-700 dark:text-gray-400">{{ $company->company_vat_code }}</h5>
                </div>
                <div class="mb-4">
                    <span class="text-gray-700 dark:text-gray-400">Adresas: </span> <br>
                    <h5 class="font-semibold text-gray-700 dark:text-gray-400">{{ $company->address }}</h5>
                </div>
                <div class="mb-4">
                    <span class="text-gray-700 dark:text-gray-400">Telefono numeris: </span> <br>
                    <h5 class="font-semibold text-gray-700 dark:text-gray-400">{{ $company->phone_number }}</h5>
                </div>
                <div class="mb-4">
                    <span class="text-gray-700 dark:text-gray-400">Faksas: </span> <br>
                    <h5 class="font-semibold text-gray-700 dark:text-gray-400">{{ $company->fax }}</h5>
                </div>
                <div class="mb-4">
                    <span class="text-gray-700 dark:text-gray-400">El. paštas: </span> <br>
                    <h5 class="font-semibold text-gray-700 dark:text-gray-400">{{ $company->email }}</h5>
                </div>
                <div class="mb-4">
                    <span class="text-gray-700 dark:text-gray-400">Atsiskaitomoji saskaita: </span> <br>
                    <h5 class="font-semibold text-gray-700 dark:text-gray-400">{{ $company->invoice_account }}</h5>
                </div>
                <div class="mb-4">
                    <span class="text-gray-700 dark:text-gray-400">Atsiskaitomosios saskaitos bankas: </span> <br>
                    <h5 class="font-semibold text-gray-700 dark:text-gray-400">{{ $company->invoice_account_bank }}</h5>
                </div>
            </div>
        @endforeach

        <div class="flex justify-between">
            <h4 class="text-lg font-semibold text-gray-600 dark:text-gray-300">Sistemos naudotojų
                tvarkymas:</h4>
            <a class="mb-4 px-5 my-6 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
               href="/clients/create" role="button">
                Pridėti sistemos naudotoją
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
                        <th class="px-4 py-3">Pareigos</th>
                        <th class="px-4 py-3">El. paštas</th>
                        <th class="px-4 py-3">Rolė</th>
                        <th class="px-4 py-3">Veiksmai</th>
                    </tr>
                    </thead>
                    @unless(count($users) == 0)
                        @foreach ($users as $user)
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
                                            <p class="font-semibold">{{$user->name}}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm"> {{$user->position}} </td>
                                <td class="px-4 py-3 text-sm"> {{$user->email}} </td>
                                <td class="px-4 py-3 text-sm"> {{$user->role}} </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <a href="/users/{{$user->id}}/edit"
                                           class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                           aria-label="Edit">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                 viewBox="0 0 20 20">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                            </svg>
                                        </a>
                                        <form method="POST" action="/users/{{$user->id}}"
                                              onsubmit="return confirm('Ar tikrai norite ištrinti {{$user->name}} vartotoją?')">
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
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        @endforeach
                    @else
                        <p> No listings found</p>
                    @endunless
                </table>
                <div class="px-6 ">
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection
