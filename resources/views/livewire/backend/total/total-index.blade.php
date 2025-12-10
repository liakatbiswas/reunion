<div class="p-6">

    <h2 class="text-2xl font-bold mb-4">Payment Summary</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <a href="{{ route('participants.index') }}" class="group">
            <div
                class="px-4 py-3 bg-green-400 hover:bg-green-500 transition dark:bg-green-600 dark:hover:bg-green-700 shadow rounded-lg">
                <h3 class="font-semibold text-gray-800 dark:text-white">Total Amount</h3>
                <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $totalAmount }}</p>
                <p class="font-bold">Tk.</p>
                <p class="text-sm text-red-700 dark:text-gray-200 mt-2 opacity-0 group-hover:opacity-100 transition">
                    সকল তালিকা দেখতে ক্লিক করুন →
                </p>
            </div>
        </a>

        <a href="{{ route('account.show800') }}" class="group">
            <div
                class="p-4 bg-gray-200 hover:bg-green-400 transition dark:bg-gray-800 dark:hover:bg-green-600 shadow rounded-lg">
                <h3 class="font-semibold text-gray-800 dark:text-white">800 TK Paid</h3>
                <p class="text-gray-700 dark:text-gray-300">Count: <strong>{{ $eightHundredCount }}</strong></p>
                <p class="text-gray-700 dark:text-gray-300">Total: <strong>{{ $eightHundredTotal }}</strong></p>
                <p class="text-sm text-red-600 dark:text-blue-400 mt-2 opacity-0 group-hover:opacity-100 transition">
                    লিস্ট দেখতে ক্লিক করুন →
                </p>
            </div>
        </a>

        <a href="{{ route('account.show1000') }}" class="group">
            <div
                class="p-4 bg-gray-200 hover:bg-green-400 transition dark:bg-gray-800 dark:hover:bg-green-600 shadow rounded-lg">
                <h3 class="font-semibold text-gray-800 dark:text-white">1000 TK Paid</h3>
                <p class="text-gray-700 dark:text-gray-300">Count: <strong>{{ $thousandCount }}</strong></p>
                <p class="text-gray-700 dark:text-gray-300">Total: <strong>{{ $thousandTotal }}</strong></p>
                <p class="text-sm text-red-600 dark:text-blue-400 mt-2 opacity-0 group-hover:opacity-100 transition">
                    লিস্ট দেখতে ক্লিক করুন →
                </p>
            </div>
        </a>

    </div>

    <hr class="my-6">

    <h3 class="text-xl font-semibold mb-3">Grouped Amount List</h3>

    <table class="w-full border dark:border-gray-700">
        <thead>
            <tr class="bg-gray-200 dark:bg-gray-700 text-left">
                <th class="border p-2">#</th>
                <th class="border p-2">Amount</th>
                <th class="border p-2">Count</th>
                <th class="border p-2">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grouped as $index => $row)
                <tr class="dark:bg-gray-800">
                    <td class="border p-2">{{ $index + 1 }}</td>
                    <td class="border p-2">{{ $row->amount }}</td>
                    <td class="border p-2">{{ $row->count }}</td>
                    <td class="border p-2">{{ $row->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
