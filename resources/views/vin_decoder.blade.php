@extends('components/layout')
@section('content')
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container px-6 mx-auto">
            <h4 class="mb-2 mt-16 text-lg font-semibold text-gray-600 dark:text-gray-300">
                VIN kodo nuskaitymas
            </h4>
            <form id="vinForm">
            <label for="vin" class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400"> Įveskite VIN kodą apačioje bei spauskite mygtuką "nuskaityti" </span>
                <div class="relative text-gray-500 focus-within:text-purple-600">
                    <input class="block w-full pr-20 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                           placeholder="WAUB8GFF4G1090034" type="text" id="vin" name="vin"/>
                    <button type="submit" class="absolute inset-y-0 right-0 px-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-r-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Nuskaityti</button>
                </div>
            </label>
            </form>


            <h4 class="mb-2 mt-16 text-lg font-semibold text-gray-600 dark:text-gray-300">
                Automobilio bendra specifikacija
            </h4>
        <div class="px-4 py-3 mb-2 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <div class="mb-4">
                <span class="text-gray-700 dark:text-gray-400">Markė, modelis: </span> <br>
                <h5 class="font-semibold text-gray-700 dark:text-gray-400"></h5>
            </div>
            <div class="mb-4">
                <span class="text-gray-700 dark:text-gray-400">Varomieji ratai: </span>
                <h5 class="font-semibold text-gray-700 dark:text-gray-400"></h5>
            </div>
            <div class="mb-4">
                <span class="text-gray-700 dark:text-gray-400">Kebulo tipas: </span>
                <h5 class="font-semibold text-gray-700 dark:text-gray-400"></h5>
            </div>
            <div class="mb-4">
                <span class="text-gray-700 dark:text-gray-400">Durų skaičius: </span>
                <h5 class="font-semibold text-gray-700 dark:text-gray-400"></h5>
            </div>
        </div>
            <h4 class="mb-2 mt-16 text-lg font-semibold text-gray-600 dark:text-gray-300">
                Variklio specifikacijos
            </h4>
            <div class="px-4 py-3 mb-2 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <div class="mb-4">
                    <span class="text-gray-700 dark:text-gray-400">Variklio kodas: </span> <br>
                    <h5 class="font-semibold text-gray-700 dark:text-gray-400"></h5>
                </div>
                <div class="mb-4">
                    <span class="text-gray-700 dark:text-gray-400">Kuro tipas: </span>
                    <h5 class="font-semibold text-gray-700 dark:text-gray-400"></h5>
                </div>
                <div class="mb-4">
                    <span class="text-gray-700 dark:text-gray-400">Variklio tūris (cm3): </span>
                    <h5 class="font-semibold text-gray-700 dark:text-gray-400"></h5>
                </div>
                <div class="mb-4">
                    <span class="text-gray-700 dark:text-gray-400">Variklio galia (AG): </span>
                    <h5 class="font-semibold text-gray-700 dark:text-gray-400"></h5>
                </div>
                <div class="mb-4">
                    <span class="text-gray-700 dark:text-gray-400">Sukimo momentas (Nm): </span>
                    <h5 class="font-semibold text-gray-700 dark:text-gray-400"></h5>
                </div>
                <div class="mb-4">
                    <span class="text-gray-700 dark:text-gray-400">Cilindrų skaičius: </span>
                    <h5 class="font-semibold text-gray-700 dark:text-gray-400"></h5>
                </div>
                <div class="mb-4">
                    <span class="text-gray-700 dark:text-gray-400">Vožtuvų skaičius: </span>
                    <h5 class="font-semibold text-gray-700 dark:text-gray-400"></h5>
                </div>
                <div class="mb-4">
                    <span class="text-gray-700 dark:text-gray-400">Kompresoriaus tipas: </span>
                    <h5 class="font-semibold text-gray-700 dark:text-gray-400"></h5>
                </div>
                <div class="mb-4">
                    <span class="text-gray-700 dark:text-gray-400">Variklio kompresija cilindre: </span>
                    <h5 class="font-semibold text-gray-700 dark:text-gray-400"></h5>
                </div>
            </div>
        </div>
        <div class="container px-6 mx-auto">
            <h4 class="mb-2 mt-16 text-lg font-semibold text-gray-600 dark:text-gray-300">
                Pavarų dežės specifikacijos
            </h4>
            <div class="px-4 py-3 mb-2 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <div class="mb-4">
                    <span class="text-gray-700 dark:text-gray-400">Pavadinimas: </span> <br>
                    <h5 class="font-semibold text-gray-700 dark:text-gray-400"></h5>
                </div>
                <div class="mb-4">
                    <span class="text-gray-700 dark:text-gray-400">ID kodas: </span> <br>
                    <h5 class="font-semibold text-gray-700 dark:text-gray-400"></h5>
                </div>
                <div class="mb-4">
                    <span class="text-gray-700 dark:text-gray-400">Tipas: </span>
                    <h5 class="font-semibold text-gray-700 dark:text-gray-400"></h5>
                </div>
                <div class="mb-4">
                    <span class="text-gray-700 dark:text-gray-400">Pavarų skaičius: </span>
                    <h5 class="font-semibold text-gray-700 dark:text-gray-400"></h5>
                </div>
            </div>
        </div>

        <script>
            document.getElementById('vinForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const vin = document.getElementById('vin').value;

                fetch(`/decode/${vin}`)
                    .then(response => response.json())
                    .then(data => {
                        if(data && data.success) {
                            displayResults(data.result);
                        } else {
                            alert('No data found for the provided VIN.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });

            function displayResults(data) {
                // Function to update text based on label
                const updateTextByLabel = (label, text) => {
                    const elements = document.querySelectorAll(".container .mb-4");
                    elements.forEach((element) => {
                        if (element.querySelector("span").textContent.trim() === label) {
                            element.querySelector("h5").innerText = text || 'N/A';
                        }
                    });
                };

                // Update general specifications
                updateTextByLabel("Markė, modelis:", `${data.make.name} ${data.model.name}`);
                updateTextByLabel("Varomieji ratai:", data.drivenWheels);
                updateTextByLabel("Kebulo tipas:", data.categories.vehicleStyle);
                updateTextByLabel("Durų skaičius:", data.numOfDoors);

                // Update engine specifications
                updateTextByLabel("Variklio kodas:", data.engine.code);
                updateTextByLabel("Kuro tipas:", data.engine.type);
                updateTextByLabel("Variklio tūris (cm3):", data.engine.displacement.toString());
                updateTextByLabel("Variklio galia (AG):", data.engine.horsepower.toString());
                updateTextByLabel("Sukimo momentas (Nm):", data.engine.torque.toString());
                updateTextByLabel("Cilindrų skaičius:", data.engine.cylinder.toString());
                updateTextByLabel("Vožtuvų skaičius:", data.engine.totalValves.toString());
                updateTextByLabel("Kompresoriaus tipas:", data.engine.compressorType);
                updateTextByLabel("Variklio kompresija cilindre:", data.engine.compressionRatio.toString());

                // Update transmission specifications
                updateTextByLabel("Pavadinimas:", data.transmission.name);
                updateTextByLabel("ID kodas:", data.transmission.id);
                updateTextByLabel("Tipas:", data.transmission.transmissionType);
                updateTextByLabel("Pavarų skaičius:", data.transmission.numberOfSpeeds);
            }
        </script>


    </main>

@endsection
