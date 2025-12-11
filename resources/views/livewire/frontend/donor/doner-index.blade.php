<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
    @foreach ($donors as $donor)
        <div class="rounded-lg mb-4 border border-gray-100 bg-gray-300 p-2 hover:bg-red-200 shadow-md">
            <div class="px-2">
                <img src="{{ $donor->photo ? asset('storage/' . $donor->photo) : asset('no_image.jpg') }}"
                    alt="{{ $donor->name }}" class="rounded-t-lg w-full h-52 object-cover">
            </div>

            <div class="px-5 py-2">
                <h5 class="mb-2 text-xl hover:text-white">
                    {{ $donor->donation_type }} Sponsor
                </h5>

                <h1 class="text-xl font-black">
                    {{ $donor->name }}
                </h1>

                <div>
                    Father's Name <p>{{ $donor->father_name }}</p>
                    Mother's Name <p>{{ $donor->mother_name }}</p>
                </div>

                <p class="mb-3 font-normal text-justify text-gray-600">
                    Donation: {{ number_format($donor->donation_amount) }} BDT
                </p>


                <p class="mb-3 font-normal text-justify text-gray-600">
                    {{ $donor->note }}
                </p>
                {{-- <a href="#"
                    class="inline-flex items-center rounded-lg bg-red-500 px-3 py-2 text-sm font-medium text-white hover:bg-teal-500">
                    Read more
                </a> --}}
                <p class="mt-4 text-center text-red-800">---- Thanks ----</p>
            </div>

        </div>
    @endforeach
</div>
