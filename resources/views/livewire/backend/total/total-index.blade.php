<div class="p-6">

    <h2 class="text-2xl font-bold mb-4">Payment Summary</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="p-4 bg-white dark:bg-gray-800 shadow rounded-lg">
            <h3 class="font-semibold">Total Amount</h3>
            <p class="text-3xl">{{ $totalAmount }}</p>
        </div>

        <a href="{{ route('account.show800') }}">
            <div class="p-4 bg-white dark:bg-gray-800 shadow rounded-lg">
                <h3 class="font-semibold">800 TK Paid</h3>
                <p>Count: <strong>{{ $eightHundredCount }}</strong></p>
                <p>Total: <strong>{{ $eightHundredTotal }}</strong></p>
            </div>
        </a>

        <a href="{{ route('account.show1000') }}">
            <div class="p-4 bg-white dark:bg-gray-800 shadow rounded-lg">
                <h3 class="font-semibold">1000 TK Paid</h3>
                <p>Count: <strong>{{ $thousandCount }}</strong></p>
                <p>Total: <strong>{{ $thousandTotal }}</strong></p>
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
