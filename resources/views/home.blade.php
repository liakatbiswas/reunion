<x-guest-layout>
    <div class="py-4 mx-auto sm:px-6 lg:px-8">
        <div class="w-auto mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900 dark:text-gray-100">
                    <div class="flex flex-col md:flex-row">

                        <!-- left -->
                        <div class="flex-[2] bg-gray-300">
                            <div class="flex flex-col items-center p-2 bg-orange-200">
                                <h2 class="text-3xl font-black text-center mb-4 text-blue-600">
                                    Title
                                </h2>
                                <img width="150px" src="{{ asset('no_image.jpg') }}" alt="Liakat Biswas">
                                <div class="p-4">
                                    <h2 class="text-center text-2xl font-bold mb-2">Name</h2>
                                    <p class="text-justify">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Et
                                        quaerat placeat eaque
                                        laboriosam maxime a alias est ab! Dolore enim ducimus, expedita magnam totam
                                        reiciendis sed. Harum enim rem ad?
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- middle -->
                        <div class="flex-[8] bg-gray-200 p-2">

                            <livewire:frontend.donor.doner-index />

                            <!-- Slider Starts -->
                            <div class="relative w-full max-w-6xl mx-auto overflow-hidden rounded-xl">
                                <!-- Slider wrapper -->
                                <div id="slider" class="flex transition-transform duration-700 h-[750px]">
                                    <img src="{{ asset('liakat.jpg') }}" class="w-full flex-shrink-0" />
                                    <img src="{{ asset('img/school1.jpg') }}" class="w-full flex-shrink-0" />
                                    <img src="{{ asset('img/school2.jpg') }}" class="w-full flex-shrink-0" />
                                    <img src="{{ asset('img/school3.jpg') }}" class="w-full flex-shrink-0" />
                                    <img src="{{ asset('img/school4.jpg') }}" class="w-full flex-shrink-0" />
                                </div>

                                <!-- Prev button -->
                                <button onclick="prevSlide()"
                                    class="absolute top-1/2 left-4 -translate-y-1/2 bg-white/60 hover:bg-white text-black p-2 rounded-full shadow">
                                    ‹
                                </button>

                                <!-- Next button -->
                                <button onclick="nextSlide()"
                                    class="absolute top-1/2 right-4 -translate-y-1/2 bg-white/60 hover:bg-white text-black p-2 rounded-full shadow">
                                    ›
                                </button>
                            </div>
                            <!-- Slider Ends -->

                        </div>

                        <!-- right -->
                        <div class="flex-[2] bg-gray-300">
                            <div class="flex flex-col items-center p-2 bg-orange-200">
                                <h2 class="text-3xl font-black text-center mb-4 text-blue-600">
                                    Title
                                </h2>
                                <img width="150px" src="{{ asset('no_image.jpg') }}" alt="Liakat Biswas">
                                <div class="p-4">
                                    <h2 class="text-center text-2xl font-bold mb-2">Name</h2>
                                    <p class="text-justify">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Et
                                        quaerat placeat eaque
                                        laboriosam maxime a alias est ab! Dolore enim ducimus, expedita magnam totam
                                        reiciendis sed. Harum enim rem ad?
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        let index = 0;
        const slider = document.getElementById("slider");
        const slides = slider.children.length;

        function showSlide() {
            slider.style.transform = `translateX(-${index * 100}%)`;
        }

        function nextSlide() {
            index = (index + 1) % slides;
            showSlide();
        }

        function prevSlide() {
            index = (index - 1 + slides) % slides;
            showSlide();
        }
        // Auto-slide every 3 sec
        setInterval(nextSlide, 3000);
    </script>

</x-guest-layout>
