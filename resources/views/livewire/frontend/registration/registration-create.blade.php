<div>
    <h1 class="text-4xl text-gray-900 dark:text-white text-center font-bold mb-6">
        Registration Yourself!
    </h1>
    <div class="text-center text-sm">
        <p> Single: একক ব্যক্তি, কোনো পরিবার নেই। </p>
        <p> Husband & Wife (Couple): শুধু স্বামী ও স্ত্রী, সন্তান নেই। </p>
        <p> Parent + Children: একজন পিতামাতা (বাবা বা মা) + সন্তানরা। </p>
        <p> Husband & Wife + Children: স্বামী–স্ত্রী এবং তাদের সন্তানরা। </p>
        <p> Children Only: কেবল সন্তানরা, পিতামাতা নেই। </p>
    </div>

    <form wire:submit.prevent="submit" class="max-w-6xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-xl shadow space-y-6"
        enctype="multipart/form-data">

        <div class="flex flex-wrap gap-6">

            <!-- Name -->
            <div class="w-full md:w-[48%]">
                <label class="block font-medium mb-1">Name</label>
                <input type="text" wire:model="name"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white" />
                @error('name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Batch -->
            <div class="w-full md:w-[48%]">
                <label>Batch</label>
                <select wire:model="batch_id" class="w-full border rounded p-2">
                    <option value="">Select Batch</option>
                    @foreach ($batches as $batch)
                        <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                    @endforeach
                </select>
                @error('batch_id')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Member Type -->
            <div class="w-full md:w-[48%]">
                <label class="block mb-1 font-medium">Member Type</label>
                <select wire:model.live="member_type"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                    <option value="">-- Select --</option>
                    <option value="single">Single</option>
                    <option value="couple">Husband & Wife</option>
                    <option value="couple_with_children">Husband & Wife + Children</option>
                    <option value="parent_with_children">Parent + Children</option>
                    <option value="children_only">Children Only</option>
                </select>
                @error('member_type')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Children -->
            @if (in_array($member_type, ['parent_with_children', 'couple_with_children', 'children_only']))
                <div class="w-full md:w-[48%]">
                    <label class="block mb-1 font-medium">সন্তান সংখ্যা</label>
                    <input type="number" min="0" wire:model.live="children"
                        class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white" />
                    @error('children')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            @endif

            <!-- Amount -->
            <div class="w-full md:w-[48%]">
                <label class="block mb-1 font-medium">Amount</label>
                <input type="text" wire:model="amount" readonly
                    class="w-full bg-gray-100 dark:bg-gray-700 dark:text-white rounded-lg" />
                @error('amount')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone -->
            <div class="w-full md:w-[48%]">
                <label class="block font-medium mb-1">Phone</label>
                <input type="tel" wire:model="phone"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white" />
                @error('phone')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- bKash -->
            <div class="w-full md:w-[48%]">
                <label class="block font-medium mb-1">bKash Number</label>
                <input type="tel" wire:model="bKash"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white" />
                @error('bKash')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="w-full md:w-[48%]">
                <label class="block font-medium mb-1">Email</label>
                <input type="email" wire:model="email"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white" />
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Occupation -->
            <div class="w-full md:w-[48%]">
                <label class="block font-medium mb-1">Occupation</label>
                <input type="text" wire:model="occupation"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white" />
                @error('occupation')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Address -->
            <div class="w-full md:w-[98%]">
                <div class="flex items-center gap-4">

                    <!-- Division -->
                    <div class="w-full md:w-[20%]">
                        <label>Division</label>
                        <select wire:model.live="division_id" class="w-full border rounded p-2">
                            <option value="">Select Division</option>
                            @foreach ($divisions as $division)
                                <option value="{{ $division->id }}">{{ $division->name }}</option>
                            @endforeach
                        </select>
                        @error('division_id')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- District -->
                    <div class="w-full md:w-[20%]">
                        <label>District</label>
                        <select wire:model.live="district_id" class="w-full border rounded p-2">
                            <option value="">Select District</option>
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                            @endforeach
                        </select>
                        @error('district_id')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Upazila -->
                    <div class="w-full md:w-[20%]">
                        <label>Upazila</label>
                        <select wire:model.live="upazila_id" class="w-full border rounded p-2">
                            <option value="">Select Upazila</option>
                            @foreach ($upazilas as $upazila)
                                <option value="{{ $upazila->id }}">{{ $upazila->name }}</option>
                            @endforeach
                        </select>
                        @error('upazila_id')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Post Office -->
                    <div class="w-full md:w-[20%]">
                        <label class="block font-medium mb-1">Post Office</label>
                        <input type="text" wire:model="post_office"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white" />
                        @error('post_office')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Village -->
                    <div class="w-full md:w-[20%]">
                        <label class="block font-medium mb-1">Village</label>
                        <input type="text" wire:model="village"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white" />
                        @error('village')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

            </div>

            <!-- Gender -->
            <label class="block font-medium mb-2">Gender: </label>
            <div class="w-full md:w-[48%]">
                <div class="flex items-center gap-6">
                    <label><input type="radio" wire:model="gender" value="male"> Male</label>
                    <label><input type="radio" wire:model="gender" value="female"> Female</label>
                    <label><input type="radio" wire:model="gender" value="other"> Other</label>
                </div>
                @error('gender')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <!-- While registering, a user's status will always be pending
            & Admin will active him -->

            <!-- Note -->
            <div class="w-full">
                <label class="block font-medium mb-1">Notes</label>
                <textarea wire:model="note" rows="3"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white"></textarea>
                @error('note')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Photo Upload -->
            <div class="w-full">
                <div class="flex h-32">
                    <div>
                        <label class="font-semibold">Upload Photo</label>
                        <input type="file" wire:model="photo" class="mt-2">
                    </div>

                    <div>
                        <!-- Loading state -->
                        <div wire:loading wire:target="photo" class="text-blue-500">
                            Uploading...
                        </div>

                        <!-- Preview Image -->
                        @if ($photo)
                            <div class="mt-4">
                                <p class="font-semibold">Preview:</p>
                                <img src="{{ $photo->temporaryUrl() }}"
                                    class="w-32 h-32 object-cover rounded border">
                            </div>
                        @endif
                    </div>
                </div>

                @error('photo')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

        </div>

        <!-- Submit -->
        <div class="pt-4">
            <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">
                Submit
            </button>
        </div>

    </form>
</div>
