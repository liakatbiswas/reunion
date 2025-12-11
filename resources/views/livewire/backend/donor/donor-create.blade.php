<div>
    <h1 class="text-4xl text-gray-900 dark:text-white text-center font-bold mb-6">
        Registration Yourself!
    </h1>

    <form wire:submit.prevent="save" class="max-w-7xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-xl shadow space-y-6"
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

            <!-- Father Name -->
            <div class="w-full md:w-[48%]">
                <label class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Father Name</label>
                <input type="text" wire:model="father_name"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring focus:ring-blue-300" />
                @error('father_name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mother Name -->
            <div class="w-full md:w-[48%]">
                <label class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Mother Name</label>
                <input type="text" wire:model="mother_name"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring focus:ring-blue-300" />
                @error('mother_name')
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

            <!-- Email -->
            <div class="w-full md:w-[48%]">
                <label class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Email</label>
                <input type="email" wire:model="email"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white" />
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Address -->
            <div class="w-full md:w-[48%]">
                <label class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Address</label>
                <input type="text" wire:model="address"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white" />
                @error('address')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Amount -->
            <div class="w-full md:w-[48%]">
                <label class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Donation Amount</label>
                <input type="number" wire:model="donation_amount"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white" />
                @error('donation_amount')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Donation Type -->
            <div class="w-full md:w-[48%]">
                <label class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Donation Type</label>

                <select wire:model="donation_type"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                    <option value="">Select Type</option>
                    <option value="Platinum">Platinum Sponsor</option>
                    <option value="Gold">Gold Sponsor</option>
                    <option value="Silver">Silver Sponsor</option>
                    <option value="Bronze">Bronze Sponsor</option>
                    <option value="General">General Donor</option>
                </select>

                @error('donation_type')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>


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
                            @php
                                $ext = strtolower($photo->getClientOriginalExtension());
                                $isImage = in_array($ext, ['jpg', 'jpeg', 'png']);
                            @endphp

                            @if ($isImage)
                                <div class="mt-4">
                                    <p class="font-semibold text-gray-700 dark:text-gray-200">Preview:</p>
                                    <img src="{{ $photo->temporaryUrl() }}"
                                        class="w-32 h-32 object-cover rounded border">
                                </div>
                            @else
                                <p class="mt-4 text-red-600 font-semibold">
                                    Invalid file. Only JPG/PNG allowed.
                                </p>
                            @endif
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
