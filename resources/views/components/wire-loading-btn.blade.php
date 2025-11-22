<!-- Main Button -->
<button wire:click="{{ $methodName ?? 'save' }}" wire:loading.delay.longer.remove
    wire:target="{{ $methodName ?? 'save' }}" type="{{ $type ?? 'button' }}"
    class="w-40 px-4 h-10 flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">
    {{ $label ?? 'Submit' }}
</button>

<div wire:loading.delay.longer wire:target="{{ $methodName ?? 'save' }}"
    class="w-40 px-4 py-2 bg-cyan-600 text-white rounded-lg shadow">
    <div class="flex items-center justify-start">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-4 h-4 animate-spin">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M4.5 12a7.5 7.5 0 0015 0m-15 0a7.5 7.5 0 1115 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077l1.41-.513m14.095-5.13l1.41-.513M5.106 17.785l1.15-.964m11.49-9.642l1.149-.964M7.501 19.795l.75-1.3m7.5-12.99l.75-1.3m-6.063 16.658l.26-1.477m2.605-14.772l.26-1.477m0 17.726l-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.794l-.75-1.299M7.5 4.205L12 12m6.894 5.785l-1.149-.964M6.256 7.178l-1.15-.964m15.352 8.864l-1.41-.513M4.954 9.435l-1.41-.514M12.002 12l-3.75 6.495" />
        </svg>
        <span class="pl-2">Loading </span>

        <span>
            <svg class="w-8 h-2 mt-1 ps-1" viewBox="0 0 120 30" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                <circle cx="15" cy="15" r="15">
                    <animate attributeName="r" from="15" to="15" begin="0s" dur="0.8s"
                        values="15;9;15" calcMode="linear" repeatCount="indefinite" />
                    <animate attributeName="fill-opacity" from="1" to="1" begin="0s" dur="0.8s"
                        values="1;.5;1" calcMode="linear" repeatCount="indefinite" />
                </circle>

                <circle cx="60" cy="15" r="9" fill-opacity="0.3">
                    <animate attributeName="r" from="9" to="9" begin="0s" dur="0.8s"
                        values="9;15;9" calcMode="linear" repeatCount="indefinite" />
                    <animate attributeName="fill-opacity" from="0.5" to="0.5" begin="0s" dur="0.8s"
                        values=".5;1;.5" calcMode="linear" repeatCount="indefinite" />
                </circle>

                <circle cx="105" cy="15" r="15">
                    <animate attributeName="r" from="15" to="15" begin="0s" dur="0.8s"
                        values="15;9;15" calcMode="linear" repeatCount="indefinite" />
                    <animate attributeName="fill-opacity" from="1" to="1" begin="0s" dur="0.8s"
                        values="1;.5;1" calcMode="linear" repeatCount="indefinite" />
                </circle>
            </svg>
        </span>
    </div>
</div>
