<div class="p-4">

    <div class="flex justify-between items-center mb-4">
        <div>
            <input type="text" wire:model.live="search" class="border px-3 py-2 rounded w-64"
                placeholder="Search donors...">
        </div>

        <a href="{{ route('donors.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow">
            Add Donor
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border-collapse bg-white shadow-md rounded">
            <thead class="bg-gray-100 text-sm">
                <tr>
                    <th class="border px-3 py-2">Photo</th>
                    <th class="border px-3 py-2">Name</th>
                    <th class="border px-3 py-2">Father</th>
                    <th class="border px-3 py-2">Mother</th>
                    <th class="border px-3 py-2">Phone</th>
                    <th class="border px-3 py-2">Email</th>
                    <th class="border px-3 py-2">Address</th>
                    <th class="border px-3 py-2">Donation</th>
                    <th class="border px-3 py-2">Donation Type</th>
                    <th class="border px-3 py-2">Note</th>
                    <th class="border px-3 py-2">Actions</th>
                </tr>
            </thead>

            <tbody class="text-sm">
                @forelse ($donors as $donor)
                    <tr class="hover:bg-gray-50">

                        <td class="border px-3 py-2 text-center">
                            @if ($donor->photo)
                                <img src="{{ asset('storage/' . $donor->photo) }}"
                                    class="w-12 h-12 rounded-full object-cover mx-auto">
                            @else
                                <div class="w-12 h-12 rounded-full bg-gray-300 mx-auto"></div>
                            @endif
                        </td>

                        <td class="border px-3 py-2">{{ $donor->name }}</td>
                        <td class="border px-3 py-2">{{ $donor->father_name }}</td>
                        <td class="border px-3 py-2">{{ $donor->mother_name }}</td>
                        <td class="border px-3 py-2">{{ $donor->phone }}</td>
                        <td class="border px-3 py-2">{{ $donor->email }}</td>

                        <td class="border px-3 py-2">{{ $donor->address }}</td>

                        <td class="border px-3 py-2 font-bold text-green-700">
                            {{ number_format($donor->donation_amount, 2) }}
                        </td>
                        <td class="border px-3 py-2">{{ $donor->donation_type }}</td>

                        <td class="border px-3 py-2">
                            {{ Str::limit($donor->note, 25) }}
                        </td>

                        <td class="border px-3 py-2 text-center">
                            <a href="{{ route('donors.edit', $donor->id) }}" class="text-blue-600">Edit</a>

                            <button wire:click="delete({{ $donor->id }})" class="text-red-600 ml-2"
                                onclick="return confirm('Delete donor?')">
                                Delete
                            </button>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center py-4 text-gray-500">
                            No donor records found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $donors->links() }}
    </div>

</div>
