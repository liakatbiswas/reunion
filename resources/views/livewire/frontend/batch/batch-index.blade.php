<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @foreach ($batches as $batch)
        @php
            $registeredCount = App\Models\Registration::where('batch_id', $batch->id)->count();
        @endphp

        @if ($registeredCount > 0)
            <div class="mb-4 rounded-sm">
                <div
                    class="hover:bg-gray-200 bg-neutral-primary-soft block p-6 border border-default rounded-lg shadow-xs">
                    <h5 class="mb-3 text-2xl font-semibold tracking-tight text-heading leading-8">
                        Batch: {{ $batch->name }}
                    </h5>

                    <p class="py-2">Total: {{ $registeredCount }} Person registered.</p>

                    <p class="text-body mb-6 text-justify">
                        প্রিয় <span class="text-red-800">{{ $batch->name }}</span> ব্যাচ এর বন্ধুগণ এখন পর্যন্ত আমাদের
                        ব্যাচের <span class="text-red-800">{{ $registeredCount }}</span> জন রেজিস্ট্রেশন করেছে। আমরা
                        প্রত্যেকে নিজেদের
                        পরিচিতদের রেজিস্ট্রেশন করার জন্য যোগাযোগ করি।
                        ধন্যবাদ
                    </p>
                    <a href="{{ route('show.all.friends', $batch->id) }}"
                        class="inline-flex items-center bg-brand box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm py-2.5 hover:underline focus:outline-none">
                        Show all Friends
                        <svg class="w-4 h-4 ms-1.5 rtl:rotate-180 -me-0.5" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 12H5m14 0-4 4m4-4-4-4" />
                        </svg>
                    </a>
                </div>
            </div>
        @endif
    @endforeach
</div>
