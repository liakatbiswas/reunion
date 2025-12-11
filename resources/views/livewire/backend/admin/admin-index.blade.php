<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-4">All Users</h2>

    <div class="mb-4">
        <input type="text" wire:model.debounce.300ms="search" placeholder="Search users..."
            class="px-4 py-2 border rounded w-full md:w-1/3">
    </div>

    <div class="overflow-x-auto rounded-tl-lg rounded-tr-lg">

        <table class="w-full border border-gray-300 text-sm">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Name</th>
                    <th class="border px-4 py-2">Email</th>
                    <th class="border px-4 py-2">Created At</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td class="border px-4 py-2">{{ $user->id }}</td>
                        <td class="border px-4 py-2">{{ $user->name }}</td>
                        <td class="border px-4 py-2">{{ $user->email }}</td>
                        <td class="border px-4 py-2">{{ $user->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="border px-4 py-2 text-center">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
