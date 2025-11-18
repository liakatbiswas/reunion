<!-- Your Table -->
<div class="p-6">
    <div class="overflow-x-auto rounded-xl shadow bg-white dark:bg-gray-800">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-100 dark:bg-gray-800">
                <tr>
                    <th
                        class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                        Name
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                        Batch
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                        Phone
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                        Member
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                        Amount
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-900">
                @foreach ($registrations as $item)
                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-800">
                        <td class="px-6 py-4 text-gray-800 dark:text-gray-200">
                            {{ $item->name }}
                        </td>
                        <td class="px-6 py-4 text-gray-800 dark:text-gray-200">
                            {{ $item->batch }}
                        </td>
                        <td class="px-6 py-4 text-gray-800 dark:text-gray-200">
                            {{ $item->phone }}
                        </td>
                        <td class="px-6 py-4 text-gray-800 dark:text-gray-200">
                            <span
                                class="px-2 py-1 text-xs rounded-lg
                                            @if ($item->member === 'yes') bg-green-200 text-green-800 dark:bg-green-700 dark:text-white
                                            @else
                                                bg-red-200 text-red-800 dark:bg-red-700 dark:text-white @endif
                                        ">
                                {{ ucfirst($item->member) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-800 dark:text-gray-200">
                            {{ $item->amount }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</div>
