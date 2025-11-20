<div>
    <h1 class="text-4xl text-gray-900 dark:text-white text-center font-bold mb-6">
        Registration Yourself!
    </h1>

    <form wire:submit.prevent="submit"
        class="max-w-6xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-xl shadow space-y-6">

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
                    <option value="single">একক</option>
                    <option value="couple">স্বামী–স্ত্রী</option>
                    <option value="parent_with_children">স্বামী বা স্ত্রী + সন্তান</option>
                    <option value="couple_with_children">স্বামী–স্ত্রী + সন্তান</option>
                    <option value="children_only">শুধু সন্তান</option>
                </select>
                @error('member_type')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Children Count -->
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
            <div class="w-full md:w-[96%]">
                <div class="flex items-center gap-4">
                    <!-- Division -->
                    <div class="w-full md:w-[24%]">
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
                    <div class="w-full md:w-[24%]">
                        <label>District</label>
                        <select wire:model.live="district_id" class="w-full border rounded p-2"
                            {{ empty($districts) ? 'disabled' : '' }}>
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
                    <div class="w-full md:w-[24%]">
                        <label>Upazila</label>
                        <select wire:model.live="upazila_id" class="w-full border rounded p-2"
                            {{ empty($upazilas) ? 'disabled' : '' }}>
                            <option value="">Select Upazila</option>
                            @foreach ($upazilas as $upazila)
                                <option value="{{ $upazila->id }}">{{ $upazila->name }}</option>
                            @endforeach
                        </select>
                        @error('upazila_id')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="w-full md:w-[24%]">
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
            <div class="w-full md:w-[48%]">
                <label class="block font-medium mb-2">Gender</label>
                <div class="flex items-center gap-6">
                    <label class="flex items-center gap-2">
                        <input type="radio" wire:model="gender" value="male"> Male
                    </label>
                    <label class="flex items-center gap-2">
                        <input type="radio" wire:model="gender" value="female"> Female
                    </label>
                    <label class="flex items-center gap-2">
                        <input type="radio" wire:model="gender" value="other"> Other
                    </label>
                </div>
                @error('gender')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
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
