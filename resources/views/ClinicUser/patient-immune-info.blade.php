<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Immunization Details</title>
    <link rel="icon" href="{{ asset('drcare_logo.png') }}" type="image/png">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/chart.js','resources/js/datetime.js'])

    @endif

</head>


<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">
    <div class="bg-white shadow-xl rounded-2xl p-10 w-full max-w-3xl border border-gray-200">
        <div class="grid grid-cols-3">
            <div class="col-span-3 md:col-span-2">
                <img src="{{ asset('images/vaccine-card-title.png') }}" alt="Title Logo">


            </div>
            <div class="col-span-3 md:col-span-1">
                <div class="w-full flex items-end justify-end ">
                    <img src="{{ asset('images/Logo-DOH.webp') }}" alt="DOH Logo" class="md:w-20 md:h-14 w-12 h-12">
                    <img src="{{ asset('images/rabies-free.jpg') }}" alt="Rabies Free Logo" class="md:w-16 md:h-16 w-12 h-12">
                </div>
            </div>
        </div>

        <h1 class="mt-4 text-2xl font-900 text-sky-700 mb-6 text-center">
            Immunization Details
        </h1>
        <h2 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">
            {{ $immunization->service->name}}
        </h2>

        {{-- Patient Information --}}
        <div class="mb-6">
            <h2 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">
                Patient Information
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-1 text-gray-700">
                <p><span class="font-medium text-gray-900">Patient Name:</span> {{ $patient->first_name }} {{ $patient->last_name }}</p>
                <p><span class="font-medium text-gray-900">Immunization Date:</span> {{ $immunization->date_given }}</p>
                <p><span class="font-medium text-gray-900">Immunization Type:</span> {{ $immunization->immunization_type }}</p>
            </div>
        </div>
        {{-- Body Part Visualization --}}
        <x-selected-body-part :selectedParts="$immunization->exposure->site_of_bite" />
        {{-- Exposure Information --}}
        <div class="mb-6">
            <h2 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">
                Exposure Information
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-1 text-gray-700">
                <p><span class="font-medium text-gray-900">Date & Time:</span> {{ $immunization->exposure->date_time }}</p>
                <p><span class="font-medium text-gray-900">Type of Exposure:</span> {{ $immunization->exposure->type_of_exposure }}</p>
                <p><span class="font-medium text-gray-900">Place of Bite:</span> {{ $immunization->exposure->place_of_bite }}</p>
                <p><span class="font-medium text-gray-900">Site of Bite:</span> {{ $immunization->exposure->site_of_bite }}</p>
                <p><span class="font-medium text-gray-900">Animal Species:</span> {{ $immunization->exposure->animalProfile->species }}</p>
                <p><span class="font-medium text-gray-900">Bite Category:</span> {{ $immunization->exposure->bite_category }}</p>
                <p><span class="font-medium text-gray-900">Clinical Status:</span> {{ $immunization->exposure->animalProfile->clinical_status }}</p>
                <p><span class="font-medium text-gray-900">Ownership Status:</span> {{ $immunization->exposure->animalProfile->ownership_status }}</p>
            </div>
        </div>

        <div class="mb-6">
            <h2 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">
                Vaccine Information
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
                <p><span class="font-medium text-gray-900">Administered By:</span> {{ $immunization->administeredBy->first_name }} {{ $immunization->administeredBy->last_name }}</p>
                @php
                $vaccines = array_filter([
                $immunization->vaccineUsed->item->brand_name ?? null,
                $immunization->rigUsed->item->brand_name ?? null,
                $immunization->antiTetanusUsed->item->brand_name ?? null,
                ]);
                @endphp

                <p>
                    <span class="font-medium text-gray-900">Vaccine's Used:</span>
                    {{ implode(', ', $vaccines) }}
                </p>
            </div>
        </div>

        {{-- Body Part Visualization --}}


    </div>
</body>



</html>