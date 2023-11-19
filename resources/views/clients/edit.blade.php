@extends('components/layout')
@section('content')
        <body class="h-full ">
        <div class="container px-6 mx-auto">
            <h4
                class="mb-2 mt-16 text-lg font-semibold text-gray-600 dark:text-gray-300">Redaguojate klientą: {{$client->name}} {{$client->surname}}
            </h4>
            <form method="POST" action="/clients/{{$client->id}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div
                    class="px-4 py-3 mb-2 bg-white rounded-lg shadow-md dark:bg-gray-800"
                >
                    <label for="name" class="mb-4 block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Vardas</span>
                        <input
                            name="name"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="Vardenis"
                            value="{{$client->name}}"
                        />
                        @error('name')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </label>

                    <label for="surname" class="mb-4 block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Pavardė</span>
                        <input
                            name="surname"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="Pavardenis"
                            value="{{$client->surname}}"
                        />
                    </label>
                    @error('surname')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror

                    <label for="email" class="mb-4 block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">El. paštas</span>
                        <input
                            name="email"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="vardenis.pavardenis@gmail.com"
                            value="{{$client->email}}"
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
                            value="{{$client->phone}}"
                        />
                    </label>
                    @error('phone')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                    <label for="description" class="mb-4 block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Papildomas aprašas</span>
                        <textarea
                            name="description"
                            class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                            rows="3"
                            placeholder="Čia galite pasirašyti papildomą informaciją apie klientą."
                        >{{$client->description}}</textarea>
                    </label>
                    @error('description')
                    <p class="text-red-600 text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="flex justify-end">
                    <button class="mb-4 px-5 my-6 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" role="button" type="submit">
                        Išsaugoti
                    </button>
                </div>
            </form>
        </div>
        </body>
@endsection
