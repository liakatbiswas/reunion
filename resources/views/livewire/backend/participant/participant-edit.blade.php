<div>
    <h1 class="text-4xl text-gray-900 dark:text-white text-center font-bold mb-6">
        Edit Registration
    </h1>

    <form wire:submit.prevent="update" class="max-w-7xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-xl shadow space-y-6"
        enctype="multipart/form-data">

        <div class="flex flex-wrap gap-6">

            <!-- Name -->
            <div class="w-full md:w-[48%]">
                <label class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Name</label>
                <input type="text" wire:model="name"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring focus:ring-blue-300" />
                @error('name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Batch -->
            <div class="w-full md:w-[48%]">
                <label class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Batch</label>
                <select wire:model="batch_id"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white p-2">
                    <option value="">Select Batch</option>
                    @foreach ($batches as $batch)
                        <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                    @endforeach
                </select>
                @error('batch_id')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Amount -->
            <div class="w-full md:w-[48%]">
                <label class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Amount</label>
                <input type="number" wire:model="amount" min="800" max="1000"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white" />
                @error('amount')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone -->
            <div class="w-full md:w-[48%]">
                <label class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Phone</label>
                <input type="tel" wire:model="phone"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white" />
                @error('phone')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- bKash -->
            <div class="w-full md:w-[48%]">
                <label class="block font-medium mb-1 text-gray-700 dark:text-gray-200">bKash Number</label>
                <input type="tel" wire:model="bKash"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white" />
                @error('bKash')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="w-full md:w-[48%]">
                <label class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Email</label>
                <input type="email" wire:model="email"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white" />
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Occupation -->
            <div class="w-full md:w-[48%]">
                <label class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Occupation</label>
                <input type="text" wire:model="occupation"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white" />
                @error('occupation')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Registered By -->
            <div class="w-full md:w-[48%]">
                <label class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Registered By</label>
                <select wire:model="user_id"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white p-2">
                    <option value="">Select Admin</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('user_id')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Village -->
            <div class="w-full md:w-[48%]">
                <label class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Village</label>
                <input type="text" wire:model="village"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white" />
                @error('village')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Gender -->
            <div class="w-full md:w-[48%] flex items-center pt-5">
                <label class="block font-medium text-gray-700 dark:text-gray-200">Gender:</label>
                <div class="flex items-center gap-6 ms-4 text-gray-700 dark:text-gray-200">
                    <label><input type="radio" wire:model="gender" value="male"> Male</label>
                    <label><input type="radio" wire:model="gender" value="female"> Female</label>
                    <label><input type="radio" wire:model="gender" value="other"> Other</label>
                </div>
                @error('gender')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Address Block -->
            <div class="w-full flex flex-wrap gap-4">

                <!-- Division -->
                <div class="w-full md:w-[18%]">
                    <label class="text-gray-700 dark:text-gray-200">Division</label>
                    <select wire:model.live="division_id"
                        class="w-full rounded border p-2 dark:bg-gray-900 dark:border-gray-700 dark:text-white">
                        <option value="">Select Division</option>
                        @foreach ($divisions as $d)
                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- District -->
                <div class="w-full md:w-[18%]">
                    <label class="text-gray-700 dark:text-gray-200">District</label>
                    <select wire:model.live="district_id"
                        class="w-full rounded border p-2 dark:bg-gray-900 dark:border-gray-700 dark:text-white">
                        <option value="">Select District</option>
                        @foreach ($districts as $dis)
                            <option value="{{ $dis->id }}">{{ $dis->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Upazila -->
                <div class="w-full md:w-[18%]">
                    <label class="text-gray-700 dark:text-gray-200">Upazila</label>
                    <select wire:model.live="upazila_id"
                        class="w-full rounded border p-2 dark:bg-gray-900 dark:border-gray-700 dark:text-white">
                        <option value="">Select Upazila</option>
                        @foreach ($upazilas as $upa)
                            <option value="{{ $upa->id }}">{{ $upa->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Post Office -->
                <div class="w-full md:w-[15%]">
                    <label class="block font-medium text-gray-700 dark:text-gray-200">Post Office</label>
                    <input type="text" wire:model="post_office"
                        class="w-full rounded border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white" />
                </div>
            </div>

            <!-- Notes -->
            <div class="w-full">
                <label class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Notes</label>
                <textarea wire:model="note" rows="3"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white"></textarea>
            </div>

            <!-- Photo Upload -->
            <div class="w-full flex gap-6 items-start">

                <div>
                    <label class="font-semibold text-gray-700 dark:text-gray-200">Update Photo</label>
                    <input type="file" wire:model="new_photo" class="mt-2">
                    @error('new_photo')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <!-- Preview -->
                    <p class="font-semibold text-gray-700 dark:text-gray-200">Current:</p>
                    @if ($photo)
                        <img src="{{ asset('storage/' . $photo) }}" class="w-32 h-32 object-cover rounded border">
                    @endif

                    @if ($new_photo)
                        <p class="mt-3 font-semibold text-gray-700 dark:text-gray-200">New Preview:</p>
                        <img src="{{ $new_photo->temporaryUrl() }}" class="w-32 h-32 object-cover rounded border">
                    @endif
                </div>
            </div>

        </div>

        <!-- Submit Button -->
        <div class="pt-4">
            <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">
                Update
            </button>
        </div>

    </form>
</div>
