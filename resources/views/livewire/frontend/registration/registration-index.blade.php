<div class="p-6">
    <div class="overflow-x-auto rounded-xl shadow">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-100 dark:bg-gray-800">
                <tr class="bg-gray-200 py-2">
                    <th
                        class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 tracking-wider">
                        Name
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 tracking-wider">
                        Batch
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 tracking-wider">
                        Address
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 tracking-wider">
                        Occupation
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 tracking-wider">
                        Phone
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 tracking-wider">
                        Email
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 tracking-wider">
                        Gender
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 tracking-wider">
                        Member Type
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 tracking-wider">
                        Children
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 tracking-wider">
                        Amount
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-900">
                @foreach ($registrations as $item)
                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-800">
                        <td class="px-6 py-4 text-gray-800 dark:text-gray-200">{{ $item->name }}</td>
                        <td class="px-6 py-4 text-gray-800 dark:text-gray-200">{{ $item->batch->name }}</td>
                        <td class="px-6 py-4 text-gray-800 dark:text-gray-200">{{ $item->address }}</td>
                        <td class="px-6 py-4 text-gray-800 dark:text-gray-200">{{ $item->occupation }}</td>
                        <td class="px-6 py-4 text-gray-800 dark:text-gray-200">{{ $item->phone }}</td>
                        <td class="px-6 py-4 text-gray-800 dark:text-gray-200">{{ $item->email }}</td>
                        <td class="px-6 py-4 text-gray-800 dark:text-gray-200">{{ ucfirst($item->gender) }}</td>
                        <td class="px-6 py-4 text-gray-800 dark:text-gray-200">
                            {{ ucfirst(str_replace('_', ' ', $item->member_type)) }}</td>
                        <td class="px-6 py-4 text-gray-800 dark:text-gray-200">{{ $item->children }}</td>
                        <td class="px-6 py-4 text-gray-800 dark:text-gray-200">{{ $item->amount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
