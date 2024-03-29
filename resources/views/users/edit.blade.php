@extends('components/layout')
@section('content')
        <body class="h-full ">
        <div class="container px-6 mx-auto">
            <h4
                class="mb-2 mt-16 text-lg font-semibold text-gray-600 dark:text-gray-300">Redaguojate vartotoją: {{$user->name}}
            </h4>
            <form method="POST" action="/users/{{$user->id}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div
                    class="px-4 py-3 mb-2 bg-white rounded-lg shadow-md dark:bg-gray-800"
                >
                    <label for="name" class="mb-4 block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Vardas ir Pavardė</span>
                        <input
                            name="name"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="Vardenis Pavardenis"
                            value="{{$user->name}}"
                        />
                        @error('name')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </label>

                    <label for="position" class="mb-4 block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Pareigos</span>
                        <input
                            name="name"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="Servizo vadovas"
                            value="{{$user->position}}"
                        />
                        @error('name')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </label>

                    <label for="email" class="mb-4 block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">El. paštas</span>
                        <input
                            name="email"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="vardenis.pavardenis@gmail.com"
                            value="{{$user->email}}"
                        />
                    </label>
                    @error('email')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                    <label for="role" class="mb-4 block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Rolė (user - negali administruoti, admin - administratorius)</span>
                        <input
                            name="role"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="user"
                            value="{{$user->role}}"
                        />
                    </label>
                    @error('role')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                    <label for="password" class="mb-4 block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Pakeisti slaptažodį</span>
                        <input
                            type="password"
                            name="password"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="Naujas slaptažodis"
                        />
                        @error('password')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </label>
                    <label for="password_confirmation" class="mb-4 block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Patvirtinti slaptažodį</span>
                        <input
                            type="password"
                            name="password_confirmation"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="Patvirtinti slaptažodį"
                        />
                    </label>
                    @error('password_confirmation')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
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
