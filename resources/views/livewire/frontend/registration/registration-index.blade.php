<div class="overflow-x-auto">
    <x-slot name="head">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.js"></script>
    </x-slot>

    <h1 class="text-center font-bold text-4xl pb-4 text-red-950"> Search Yourself! </h1>
    <div class="mb-4">
        <input type="text" wire:model.live="search" id="search-box" class="w-full border px-3 py-2 rounded"
            placeholder="Search by name, regi id, phone, bKash...">
    </div>

    <table class="w-full border border-gray-300 text-sm">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="border p-2">Photo</th>
                <th class="border p-2">Name</th>
                <th class="border p-2">Regi ID</th>
                <th class="border p-2">Batch</th>

                <th class="border p-2">Division</th>
                <th class="border p-2">District</th>
                <th class="border p-2">Upazila</th>
                <th class="border p-2">Village</th>
                <th class="border p-2">Post Office</th>

                <th class="border p-2">Status</th>
                <th class="border p-2">Occupation</th>
                <th class="border p-2">Phone</th>
                <th class="border p-2">bKash</th>
                <th class="border p-2">Email</th>
                <th class="border p-2">Gender</th>
                <th class="border p-2">Amount</th>
                <th class="border p-2">Registered By</th>
                <th class="border p-2">Note</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($registrations as $item)
                <tr class="border">

                    <td class="w-20 p-2">
                        @php
                            $img = $item->photo ? asset('storage/' . $item->photo) : asset('no_image.jpg');
                        @endphp

                        <!-- Featherlight zoom trigger -->
                        <a href="{{ $img }}" data-featherlight="image">
                            <img src="{{ $img }}" alt="{{ $item->name }}"
                                class="aspect-square w-20 object-cover rounded border cursor-zoom-in">
                        </a>
                    </td>

                    <td class="border p-2 whitespace-nowrap">{{ $item->name }}</td>

                    <td class="border whitespace-nowrap p-2">{{ $item->regi_id }}</td>

                    <td class="border p-2">{{ $item->batch->name ?? 'N/A' }}</td>





                    <td class="border p-2">{{ $item->division->name ?? 'N/A' }}</td>
                    <td class="border p-2">{{ $item->district->name ?? 'N/A' }}</td>
                    <td class="border p-2">{{ $item->upazila->name ?? 'N/A' }}</td>
                    <td class="border p-2">{{ $item->village }}</td>
                    <td class="border p-2">{{ $item->post_office }}</td>






                    <td class="border p-2">
                        <span
                            class="px-2 py-1 rounded 
                            {{ $item->status == 'active' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>

                    <td class="border p-2">{{ $item->occupation }}</td>

                    <td class="border p-2">{{ $item->phone }}</td>

                    <td class="border p-2">{{ $item->bKash }}</td>

                    <td class="border p-2 whitespace-nowrap">{{ $item->email }}</td>

                    <td class="border p-2">{{ ucfirst($item->gender) }}</td>

                    <td class="border p-2">{{ $item->amount }}</td>

                    <!-- Relation: user -->
                    <td class="border p-2">{{ $item->user->name ?? 'N/A' }}</td>

                    <td class="border p-2">{{ $item->note }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
