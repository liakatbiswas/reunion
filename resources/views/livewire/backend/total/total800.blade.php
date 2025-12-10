 <div class="overflow-x-auto rounded-tl-lg rounded-tr-lg">

     <h2 class="text-2xl font-bold mb-4">Registrations Paid 800 TK</h2>

     <table class="w-full border border-gray-300 text-sm">
         <thead>
             <tr class="bg-gray-200">
                 <th class="border p-2">#</th>
                 <th class="border p-2">Name</th>
                 <th class="border p-2">Phone</th>
                 <th class="border p-2">Amount</th>
                 <th class="border p-2">Email</th>
                 <th class="border p-2">Batch</th>
             </tr>
         </thead>
         <tbody>
             @foreach ($registrations as $index => $reg)
                 <tr class="bg-white">
                     <td class="border p-2">{{ $index + 1 }}</td>
                     <td class="border p-2">{{ $reg->name }}</td>
                     <td class="border p-2">{{ $reg->phone }}</td>
                     <td class="border p-2">{{ $reg->amount }}</td>
                     <td class="border p-2">{{ $reg->email }}</td>
                     <td class="border p-2">{{ $reg->batch->name }}</td>
                 </tr>
             @endforeach
         </tbody>
     </table>

     @if ($registrations->isEmpty())
         <p class="mt-4 text-red-500">No registrations found for 800 TK.</p>
     @endif

 </div>
