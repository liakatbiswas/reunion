<div>

    <h2 class="text-2xl font-bold mb-4 text-center">
        {{ $batch->name }} ব্যাচ- এর রেজিস্ট্রেশনকৃত বন্ধগণ
    </h2>

    @if ($friends->count() > 0)

        <div class="p-6">

            <x-slot name="head">
                <link rel="stylesheet"
                    href="https://cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.css">
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.js"></script>
            </x-slot>

            <div class="overflow-x-auto rounded-tl-lg rounded-tr-lg">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-800">
                        <tr class="bg-gray-200 py-2">
                            <th
                                class="w-20 p-2 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 tracking-wider">
                                Photo
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 tracking-wider">
                                Name
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 tracking-wider">
                                Batch
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 tracking-wider">
                                Registration Number
                            </th>

                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 tracking-wider">
                                Division
                            </th>

                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 tracking-wider">
                                District
                            </th>

                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 tracking-wider">
                                Upazila
                            </th>

                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 tracking-wider">
                                Occupation
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 tracking-wider">
                                Phone
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 tracking-wider">
                                Email
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 tracking-wider">
                                Gender
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 tracking-wider">
                                Member Type
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 tracking-wider">
                                Children
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 tracking-wider">
                                Amount
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-900">
                        @foreach ($friends as $item)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-800">

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

                                <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">
                                    {{ $item->name }}
                                </td>
                                <td class="px-6 py-4 text-gray-800 dark:text-gray-200">{{ $item->batch->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">
                                    {{ $item->regi_id }}
                                </td>

                                <td class="px-6 py-4 text-gray-800 dark:text-gray-200">{{ $item->division->name }}</td>
                                <td class="px-6 py-4 text-gray-800 dark:text-gray-200">{{ $item->district->name }}</td>
                                <td class="px-6 py-4 text-gray-800 dark:text-gray-200">{{ $item->upazila->name }}</td>

                                <td class="px-6 whitespace-nowrap py-4 text-gray-800 dark:text-gray-200">
                                    {{ $item->occupation }}
                                </td>
                                <td class="px-6 whitespace-nowrap py-4 text-gray-800 dark:text-gray-200">
                                    {{ $item->phone }}
                                </td>
                                <td class="px-6 whitespace-nowrap py-4 text-gray-800 dark:text-gray-200">
                                    {{ $item->email }}
                                </td>
                                <td class="px-6 py-4 text-gray-800 dark:text-gray-200">{{ ucfirst($item->gender) }}
                                </td>
                                <td class="px-6 whitespace-nowrap py-4 text-gray-800 dark:text-gray-200">
                                    {{ ucfirst(str_replace('_', ' ', $item->member_type)) }}</td>
                                <td class="px-6 py-4 text-gray-800 dark:text-gray-200">{{ $item->children }}</td>
                                <td class="px-6 py-4 text-gray-800 dark:text-gray-200">{{ $item->amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


            <div class="py-4">
                {{ $friends->links() }}
            </div>

        </div>



        {{-- <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ($friends as $friend)
                <div class="p-4 border rounded bg-white shadow">
                    <p><strong>Name:</strong> {{ $friend->name }}</p>
                    <p><strong>Phone:</strong> {{ $friend->phone }}</p>
                    <p><strong>Email:</strong> {{ $friend->email }}</p>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $friends->links() }}
        </div> --}}
    @else
        <p class="text-gray-500">No registrations found for this batch.</p>
    @endif

</div>
