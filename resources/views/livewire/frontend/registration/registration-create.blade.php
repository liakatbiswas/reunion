<div>
    <h1 class="text-4xl text-gray-900 text-center font-bold">Registration Yourself!</h1>

    <form wire:submit.prevent="submit" class="max-w-6xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-xl  space-y-6">
        <!-- 2 Column Layout -->
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
                <label class="block font-medium mb-1">Batch</label>
                <input type="text" wire:model="batch"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white" />
                @error('batch')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Address -->
            <div class="w-full md:w-[48%]">
                <label class="block font-medium mb-1">Address</label>
                <textarea wire:model="address" rows="2"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white"></textarea>
                @error('address')
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

            <!-- Phone -->
            <div class="w-full md:w-[48%]">
                <label class="block font-medium mb-1">Phone</label>
                <input type="tel" wire:model="phone"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white" />
                @error('phone')
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

            <!-- Member -->
            <div class="w-full md:w-[48%]">
                <label class="block font-medium mb-1">Member</label>
                <input type="number" wire:model="member"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white" />
                @error('member')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Amount -->
            <div class="w-full md:w-[48%]">
                <label class="block font-medium mb-1">Amount</label>
                <input type="number" wire:model="amount"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white" />
                @error('amount')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
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
