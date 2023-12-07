@extends('components/layout')
@section('content')
    <body class="h-full">
    <div class="container px-6 mx-auto">
        <h4 class="mb-2 mt-16 text-lg font-semibold text-gray-600 dark:text-gray-300">
            Redaguoti užsakymą
        </h4>
        <form action="{{ route('orders.update', $order->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label for="client_id" class="mb-4 block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Klientas:</span>
                <select name="client_id" id="client_id"
                        class="client-select block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray"">
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ $order->client_id == $client->id ? 'selected' : '' }}>
                        {{ $client->name }} {{ $client->surname }}
                    </option>
                    @endforeach
                    </select>
            </label>

            <label for="vehicle_id" class="mb-4 block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Automobilis:</span>
                <select name="vehicle_id" id="vehicle_id"
                        class="vehicle-select block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray">
                    @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}" {{ $order->vehicle_id == $vehicle->id ? 'selected' : '' }}>
                            {{ $vehicle->license_plate }} {{ $vehicle->brand }} {{ $vehicle->model }}, VIN
                            kodas: {{ $vehicle->vin }}
                        </option>
                    @endforeach
                </select>
            </label>

            <label for="estimated_start" class="mb-4 block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Numanoma darbų pradžia:</span>
                <input type="text" id="estimated_start" name="estimated_start" value="{{ $order->estimated_start }}"
                       class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
            </label>
            @error('estimated_start')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <label for="estimated_end" class="mb-4 block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Numanoma darbų pradžia:</span>
                <input type="text" id="estimated_start" name="estimated_start" value="{{ $order->estimated_end }}"
                       class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
            </label>
            @error('estimated_end')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <label for="vehicle_mileage" class="mb-4 block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Automobilio rida užsakymo metu:</span>
                <input
                    name="vehicle_mileage"
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="XXXXXXX km."
                    value="{{$order->vehicle_mileage}}"
                />
            </label>
            @error('vehicle_mileage')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <label for="status" class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">
                Užsakymo būsena:
            </span>
                <select name="status"
                        class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                    @foreach(['Vykdomas', 'Įvykdytas', 'Atšauktas'] as $statusOption)
                        <option
                            value="{{ $statusOption }}"
                            {{ $order->status == $statusOption ? 'selected' : '' }}
                            class="px-2 py-1 font-semibold leading-tight text-{{ strtolower($statusOption) }}-700 bg-{{ strtolower($statusOption) }}-100 rounded-full dark:text-white dark:bg-{{ strtolower($statusOption) }}-700"
                        >
                            {{ $statusOption }}
                        </option>
                    @endforeach
                </select>
            </label>
            @error('status')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
            <label for="sms_notifications" class="block text-sm">
                <input
                    type="checkbox"
                    id="sms_notifications"
                    name="sms_notifications"
                    class="form-checkbox text-purple-600"
                    {{ $order->sms_notifications ? 'checked' : '' }}
                />
                <span class="text-gray-700 dark:text-gray-400">Siųsti SMS pranešimus</span>
                <p id="smsNotificationMessage" class="text-red-600"
                   style="display: {{ $order->sms_notifications ? 'block' : 'none' }}">SMS pranešimai klientui bus
                    siunčiami kaskart atnaujinus užsakymo būseną!</p>
            </label>
            <label for="email_notifications" class="block text-sm">
                <input
                    type="checkbox"
                    id="email_notifications"
                    name="email_notifications"
                    class="form-checkbox text-purple-600"
                    {{ $order->email_notifications ? 'checked' : '' }}
                />
                <span class="text-gray-700 dark:text-gray-400">Siųsti el.pašto pranešimus</span>
                <p id="emailNotificationMessage" class="text-red-600"
                   style="display: {{ $order->email_notifications ? 'block' : 'none' }}">EL. pašto pranešimai klientui
                    bus siunčiami kaskart atnaujinus užsakymo būseną!</p>
            </label>
            <div class="mt-16 mb-4 flex justify-between items-center">
                <h4
                    class="mb-2 mt-6 text-lg font-semibold text-gray-600 dark:text-gray-300">Prekių bei paslaugų
                    pridėjimas
                </h4>
                <button
                    class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                    type="button" id="add-item" class="btn-primary">
                    Pridėti paslaugą arba prekę
                </button>
            </div>

            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3" style="width: 20%;">Prekės / paslaugos kodas</th>
                            <th class="px-4 py-3" style="width: 40%;">Prekės / paslaugos pavadinimas</th>
                            <th class="px-4 py-3" style="width: 15%;">Kiekis</th>
                            <th class="px-4 py-3" style="width: 15%;">Vienetai</th>
                            <th class="px-4 py-3" style="width: 15%;">Vieneto kaina (be PVM)</th>
                            <th class="px-4 py-3">Ištrinti</th>
                        </tr>
                        </thead>
                        <tbody id="order-items" class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach($order->items as $index => $item)
                            <tr>
                                <td class="px-4 py-3">
                                    <input type="text" name="items[{{ $index }}][product_code]"
                                           value="{{ $item->product_code }}"
                                           class="form-input block w-full dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700"
                                           placeholder="Kodas">
                                </td>
                                <td class="px-4 py-3">
                                    <input type="text" name="items[{{ $index }}][product_name]"
                                           value="{{ $item->product_name }}"
                                           class="form-input block w-full dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700"
                                           placeholder="Pavadinimas">
                                </td>
                                <td class="px-4 py-3">
                                    <input type="number" name="items[{{ $index }}][quantity]"
                                           value="{{ $item->quantity }}"
                                           class="form-input block w-full dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700"
                                           placeholder="Kiekis">
                                </td>
                                <td class="px-4 py-3">
                                    <input type="text" name="items[{{ $index }}][unit]" value="{{ $item->unit }}"
                                           class="form-input block w-full dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700"
                                           placeholder="Vienetai">
                                </td>
                                <td class="px-4 py-3">
                                    <input type="text" name="items[{{ $index }}][unit_price]"
                                           value="{{ $item->unit_price }}"
                                           class="form-input block w-full dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700"
                                           placeholder="Kaina">
                                </td>
                                <td class="px-4 py-3">
                                    <button type="button"
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                            onclick="removeItem(this)">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <label for="description" class="mb-4 block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Papildomas aprašas</span>
                <textarea
                    name="description"
                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                    rows="3"
                    placeholder="Čia galite pasirašyti papildomą informaciją apie klientą."
                >{{$order->description}}</textarea>
            </label>
            @error('description')
            <p class="text-red-600 text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <h4 class="mb-2 mt-8 text-lg font-semibold text-gray-600 dark:text-gray-300">Nuotraukų įkėlimas</h4>
            <!-- File Input Field -->
            <input type="file" name="images[]" id="imageUpload"
                   class="text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                   multiple>

            <!-- Container for Existing Image Previews -->
            <input type="hidden" name="removedImageIds" id="removedImageIds" value="">
            <div class="flex" id="imagePreviewContainer">
                @foreach($order->images as $image)
                    <div class="relative mr-2">
                        <img src="{{ Storage::url($image->path) }}"
                             class="mt-2 w-56 md:h-auto object-cover rounded-lg border border-gray-300"/>
                        <button type="button"
                                class="absolute top-0 right-0 bg-red-600 text-white rounded-full px-2 py-1 text-xs"
                                onclick="removeImage(this, '{{ $image->id }}')">X
                        </button>
                    </div>
                @endforeach
            </div>

            <br>
            <button
                class="mb-4 px-5 my-6 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                role="button" type="submit">
                Atnaujinti užsakymą.
            </button>
        </form>
    </div>
    </body>

    <script>
        function removeItem(button) {
            button.closest('tr').remove();
        }

        document.getElementById('add-item').addEventListener('click', function () {
            var container = document.getElementById('order-items');
            var itemIndex = container.querySelectorAll('tr').length; // Calculate the current index

            var newItem = document.createElement('tr');
            newItem.classList.add('text-gray-700', 'dark:text-gray-400', 'border-hidden');
            newItem.innerHTML = `
        <td class="px-4 py-3 dark:bg-gray-700">
            <input type="text" name="items[${itemIndex}][product_code]" class="form-input block w-full dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700" placeholder="Kodas">
        </td>
        <td class="px-4 py-3 dark:bg-gray-700">
            <input type="text" name="items[${itemIndex}][product_name]" class="form-input block w-full dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700" placeholder="Pavadinimas">
        </td>
        <td class="px-4 py-3 dark:bg-gray-700">
            <input type="number" name="items[${itemIndex}][quantity]" class="form-input block w-full dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700" placeholder="Kiekis">
        </td>
        <td class="px-4 py-3 dark:bg-gray-700">
            <input type="text" name="items[${itemIndex}][unit]" class="form-input block w-full dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700" placeholder="Vienetai">
        </td>
        <td class="px-4 py-3 dark:bg-gray-700">
            <input type="text" name="items[${itemIndex}][unit_price]" class="form-input block w-full dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700" placeholder="Kaina">
        </td>
        <td class="px-4 py-3 dark:bg-gray-700">
            <div class="flex items-center space-x-4 text-sm">
                <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete">
                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </td>
    `;
            container.appendChild(newItem);

            newItem.querySelector('.flex').addEventListener('click', function () {
                this.closest('tr').remove();
            });
        });

        $(document).ready(function () {
            $('.client-select').select2({
                placeholder: "Pasirinkite klientą",
                allowClear: true
            });
        });

        flatpickr("#estimated_start", {
            enableTime: true, // Enable time picker
            dateFormat: "Y-m-d H:i", // Date format including hours and minutes
            locale: "lt",
            theme: "dark", // Set the theme to dark
        });

        flatpickr("#estimated_end", {
            enableTime: true, // Enable time picker
            dateFormat: "Y-m-d H:i", // Date format including hours and minutes
            locale: "lt",
            theme: "dark", // Set the theme to dark
        });

        // Image preview

        function removeImage(button, imageId) {
            // Remove the image preview from the client-side
            button.parentElement.remove();

            // Store the removed image ID in a hidden field for server-side deletion
            var removedImageIds = document.getElementById('removedImageIds');
            if (removedImageIds.value) {
                removedImageIds.value += ',' + imageId;
            } else {
                removedImageIds.value = imageId;
            }
        }

        document.getElementById('imageUpload').addEventListener('change', function (event) {
            var imagePreviewContainer = document.getElementById('imagePreviewContainer');
            // Existing previews are kept, new uploads are appended

            var files = event.target.files; // Get the selected files

            // Loop through the FileList and render image files as thumbnails.
            for (var i = 0, f; f = files[i]; i++) {
                // Only process image files.
                if (!f.type.match('image.*')) {
                    continue;
                }

                var reader = new FileReader();

                // Closure to capture the file information and render thumbnail.
                reader.onload = (function (theFile) {
                    return function (e) {
                        // Render thumbnail.
                        var span = document.createElement('span');
                        span.innerHTML = '<img src="' + e.target.result + '" class="mt-2 w-56 md:h-auto object-cover" />';
                        imagePreviewContainer.appendChild(span);
                    };
                })(f);

                // Read in the image file as a data URL.
                reader.readAsDataURL(f);
            }
        });

        const smsNotificationsCheckbox = document.getElementById('sms_notifications');
        const smsNotificationMessage = document.getElementById('smsNotificationMessage');

        smsNotificationsCheckbox.addEventListener('change', function () {
            if (this.checked) {
                smsNotificationMessage.style.display = 'block';
            } else {
                smsNotificationMessage.style.display = 'none';
            }
        });

        const emailNotificationsCheckbox = document.getElementById('email_notifications');
        const emailNotificationMessage = document.getElementById('emailNotificationMessage');

        emailNotificationsCheckbox.addEventListener('change', function () {
            if (this.checked) {
                emailNotificationMessage.style.display = 'block';
            } else {
                emailNotificationMessage.style.display = 'none';
            }
        });

    </script>

@endsection
