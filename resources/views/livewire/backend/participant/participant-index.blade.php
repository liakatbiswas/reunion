<div class="p-6">

    <div class="flex items-center space-x-4 mb-4">
        <input type="text" wire:model.live="search" placeholder="Search students...">

        @include('components.wire-loading-btn', [
            'methodName' => 'exportExcel',
            'label' => 'Excel',
        ])
        @include('components.wire-loading-btn', [
            'methodName' => 'exportPDF',
            'label' => 'PDF',
        ])
        @include('components.wire-loading-btn', [
            'methodName' => 'exportWord',
            'label' => 'Word',
        ])
    </div>


    <x-slot name="head">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.js"></script>
    </x-slot>

    <div class="overflow-x-auto rounded-tl-lg rounded-tr-lg">

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
                    <th class="border p-2">Action</th>
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

                        <td class="border p-2">{{ $item->regi_id }}</td>

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
                        <td class="border p-2">
                            <button wire:click="toggleStatus({{ $item->id }})"
                                class="px-3 py-1 rounded 
                                        {{ $item->status === 'active' ? 'bg-red-500 text-white hover:bg-red-600' : 'bg-blue-500 text-white hover:bg-blue-600' }}">
                                {{ $item->status === 'active' ? 'Pending' : 'Active' }}
                            </button>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <div class="py-4">
        {{ $registrations->links() }}
    </div>

</div>
