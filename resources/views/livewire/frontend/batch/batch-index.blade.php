<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @foreach ($batches as $batch)
        @if ($batch->registrations_count > 0)
            <div class="mb-4 rounded-sm">
                <div
                    class="hover:bg-gray-200 bg-neutral-primary-soft block p-6 border border-default rounded-lg shadow-xs">
                    <h5 class="mb-3 text-2xl font-semibold tracking-tight text-heading leading-8">
                        Batch: {{ $batch->name }}
                    </h5>

                    <p class="py-2">Total: {{ $batch->registrations_count }} Person registered.</p>

                    <p class="text-body mb-6 text-justify">
                        প্রিয় <span class="text-red-800">{{ $batch->name }}</span> ব্যাচ এর বন্ধুগণ এখন পর্যন্ত আমাদের
                        ব্যাচের <span class="text-red-800">{{ $batch->registrations_count }}</span> জন রেজিস্ট্রেশন
                        করেছে।
                        আমরা প্রত্যেকে নিজেদের পরিচিতদের রেজিস্ট্রেশন করার জন্য যোগাযোগ করি।
                        ধন্যবাদ
                    </p>

                    <a href="{{ route('show.all.friends', $batch->id) }}" class="inline-flex items-center ...">
                        Show all Friends
                    </a>
                </div>
            </div>
        @endif
    @endforeach

</div>
