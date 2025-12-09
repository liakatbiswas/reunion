<div>
    <h1 class="text-4xl text-gray-900 dark:text-white text-center font-bold mb-6">
        Registration Yourself!
    </h1>

    <form wire:submit.prevent="submit" class="max-w-7xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-xl shadow space-y-6"
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

            <!-- Amount (manual input now) -->
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


            <!-- Admin -->
            <div class="w-full md:w-[48%]">
                <label class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Registered By</label>
                <select wire:model="user_id"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white p-2">
                    <option value="">Select Batch</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('user_id')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            {{-- <div class="w-full md:w-[48%] flex items-center pt-5">
                <label class="block font-medium text-gray-700 dark:text-gray-200"></label>
                <input type="text" wire:model="village"
                    class="w-full rounded border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white" />
                @error('village')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div> --}}

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

            <!-- Address -->

            {{-- <div class="w-full md:w-[98%]">

                <div class="flex flex-wrap gap-4">

                    <!-- Division -->
                    <div class="w-full md:w-[18%]">
                        <label class="text-gray-700 dark:text-gray-200">Division</label>
                        <select wire:model.live="division_id"
                            class="w-full rounded border p-2 dark:bg-gray-900 dark:border-gray-700 dark:text-white">
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
                    <div class="w-full md:w-[18%]">
                        <label class="text-gray-700 dark:text-gray-200">District</label>
                        <select wire:model.live="district_id"
                            class="w-full rounded border p-2 dark:bg-gray-900 dark:border-gray-700 dark:text-white">
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
                    <div class="w-full md:w-[18%]">
                        <label class="text-gray-700 dark:text-gray-200">Upazila</label>
                        <select wire:model.live="upazila_id"
                            class="w-full rounded border p-2 dark:bg-gray-900 dark:border-gray-700 dark:text-white">
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
                    <div class="w-full md:w-[15%]">
                        <label class="block font-medium text-gray-700 dark:text-gray-200">Post Office</label>
                        <input type="text" wire:model="post_office"
                            class="w-full rounded border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white" />
                        @error('post_office')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Village -->
                    <div class="w-full md:w-[25%]">
                        <label class="block font-medium text-gray-700 dark:text-gray-200">Village</label>
                        <input type="text" wire:model="village"
                            class="w-full rounded border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white" />
                        @error('village')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div> --}}



            <!-- Note -->
            <div class="w-full">
                <label class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Notes</label>
                <textarea wire:model="note" rows="3"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white"></textarea>
                @error('note')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Photo Upload -->
            <div class="w-full">
                <div class="flex h-32 gap-6">

                    <div>
                        <label class="font-semibold text-gray-700 dark:text-gray-200">Upload Photo</label>
                        <input type="file" wire:model="photo" class="mt-2">
                        @error('photo')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <!-- Loading -->
                        <div wire:loading wire:target="photo" class="text-blue-500">Uploading...</div>

                        <!-- Preview -->
                        @if ($photo)
                            <div class="mt-4">
                                <p class="font-semibold text-gray-700 dark:text-gray-200">Preview:</p>
                                <img src="{{ $photo->temporaryUrl() }}" class="w-32 h-32 object-cover rounded border">
                            </div>
                        @endif
                    </div>

                </div>
            </div>

        </div>

        <!-- Submit Button -->
        <div class="pt-4">
            <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">
                Submit
            </button>
        </div>

    </form>
</div>
