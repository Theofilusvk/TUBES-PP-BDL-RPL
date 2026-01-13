<x-app-layout>
    <x-slot name="header">
        Dashboard
    </x-slot>

    <div class="flex gap-6">
        <!-- Sidebar (Visual Mockup for now, could be componentized) -->
        <div class="w-64 bg-white shadow-sm rounded-lg p-4 h-fit hidden md:block">
            <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">Menu</h3>
            <div class="space-y-1">
                <a href="#" class="block px-3 py-2 rounded-md bg-orange-50 text-primary font-medium">Overview</a>
                <a href="#" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-gray-50 hover:text-primary">My Events</a>
                <a href="#" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-gray-50 hover:text-primary">Race Results</a>
                <a href="#" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-gray-50 hover:text-primary">Payments</a>
            </div>
            
            <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mt-8 mb-4">Settings</h3>
            <div class="space-y-1">
                <a href="{{ url('/profile') }}" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-gray-50 hover:text-primary">Profile</a>
                <a href="#" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-gray-50 hover:text-primary">Notifications</a>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 space-y-6">
            
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6 border-l-4 border-primary">
                    <div class="text-gray-500 text-sm font-medium uppercase">Upcoming Races</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">3</div>
                </div>
                
                <!-- Card 2 -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6 border-l-4 border-secondary">
                    <div class="text-gray-500 text-sm font-medium uppercase">Total Distance</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">42 <span class="text-sm font-normal text-gray-400">km</span></div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6 border-l-4 border-gray-400">
                    <div class="text-gray-500 text-sm font-medium uppercase">Rank (Avg)</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">Top 10%</div>
                </div>
            </div>

            <!-- Recent Activity / Event List -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900">Upcoming Events</h3>
                    <a href="#" class="text-sm text-primary hover:text-orange-700">View All</a>
                </div>
                <div class="divide-y divide-gray-200">
                    <!-- Item 1 -->
                    <div class="p-6 flex items-center justify-between hover:bg-gray-50">
                        <div class="flex items-center gap-4">
                            <div class="h-12 w-12 bg-orange-100 text-primary rounded-lg flex items-center justify-center font-bold text-lg">
                                24
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-gray-900">Jakarta City Run 2025</h4>
                                <p class="text-sm text-gray-500">Monas, Jakarta • 5K Fun Run</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="badge badge-committee">Registered</span>
                            <button class="text-gray-400 hover:text-gray-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </button>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="p-6 flex items-center justify-between hover:bg-gray-50">
                        <div class="flex items-center gap-4">
                            <div class="h-12 w-12 bg-gray-100 text-gray-600 rounded-lg flex items-center justify-center font-bold text-lg">
                                15
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-gray-900">Bandung Maroon Run</h4>
                                <p class="text-sm text-gray-500">Gedung Sate • 10K Race</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="badge badge-participant">Finished</span>
                            <button class="text-gray-400 hover:text-gray-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
