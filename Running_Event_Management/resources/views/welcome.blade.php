<x-app-layout>
    <!-- Hero Section -->
    <div class="relative bg-secondary overflow-hidden text-white rounded-3xl my-6">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-secondary sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32 rounded-r-3xl">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl">
                            <span class="block xl:inline">Professional Event</span>
                            <span class="block text-primary xl:inline">Management</span>
                        </h1>
                        <p class="mt-3 text-base text-gray-300 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Organize, manage, and track running events with precision. From registration to race results, we handle it all.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <a href="{{ route('register') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary hover:bg-orange-700 md:py-4 md:text-lg">
                                    Get Started
                                </a>
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-3">
                                <a href="#" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-primary bg-orange-100 hover:bg-orange-200 md:py-4 md:text-lg">
                                    Live Demo
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <!-- Decorative Image/Gradient -->
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2 bg-gray-800 flex items-center justify-center">
             <!-- Placeholder for Hero Image -->
             <div class="text-gray-600 font-bold text-2xl">HERO IMAGE</div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-12 bg-white rounded-3xl p-8 shadow-sm">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8">
            <div class="text-center">
                <h2 class="text-base font-semibold text-primary tracking-wide uppercase">Features</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Everything you need to run
                </p>
            </div>

            <div class="mt-10">
                <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                    <!-- Feature 1 -->
                    <div class="relative">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-primary text-white">
                                <!-- Heroicon name: globe-alt -->
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                </svg>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Event Dashboard</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Real-time statistics on registrations, income, and participant demographics.
                        </dd>
                    </div>

                    <!-- Feature 2 -->
                    <div class="relative">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-primary text-white">
                                <!-- Heroicon name: scale -->
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                </svg>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Secure Payments</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Integrated payment gateway with automatic verification and receipts.
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</x-app-layout>
