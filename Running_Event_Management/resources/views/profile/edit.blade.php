<x-app-layout>
    <x-slot name="header">
        User Profile
    </x-slot>

    <!-- Profile Header Card -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6 flex items-center gap-6">
        <!-- Avatar Placeholder -->
        <div class="h-24 w-24 rounded-full bg-gray-200 flex items-center justify-center text-3xl font-bold text-gray-500">
            {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
        </div>
        
        <div class="flex-1">
            <div class="flex items-center gap-3 mb-1">
                <h2 class="text-2xl font-bold text-gray-900">{{ auth()->user()->name ?? 'User Name' }}</h2>
                
                <!-- Logic for Badge Display (Mockup) -->
                @php
                    $role = 'participant'; // Default for view
                    // In real app: $role = auth()->user()->role->name;
                @endphp
                
                <span class="badge badge-{{ $role }}">
                    {{ ucfirst($role) }}
                </span>
            </div>
            <p class="text-gray-500">{{ auth()->user()->email ?? 'user@example.com' }}</p>
            <p class="text-sm text-gray-400 mt-1">Member since {{ date('M Y') }}</p>
        </div>

        <div>
            <button class="btn btn-primary">
                Edit Profile
            </button>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <div class="border-b border-gray-200 mb-6">
        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
            <a href="#" class="border-primary text-primary whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Personal Info
            </a>
            <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Race History
            </a>
            <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Settings
            </a>
        </nav>
    </div>

    <!-- Tab Content: Personal Info -->
    <div class="bg-white shadow-sm rounded-lg p-6">
        <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Personal Information</h3>
        
        <form action="#" method="POST">
            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                <!-- Full Name -->
                <div class="sm:col-span-3">
                    <label for="name" class="block text-sm font-medium text-gray-700">Full name</label>
                    <div class="mt-1">
                        <input type="text" name="name" id="name" value="{{ auth()->user()->name ?? '' }}" class="shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border">
                    </div>
                </div>

                <!-- Email -->
                <div class="sm:col-span-3">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                    <div class="mt-1">
                        <input type="email" name="email" id="email" value="{{ auth()->user()->email ?? '' }}" class="shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border">
                    </div>
                </div>

                <!-- Phone -->
                <div class="sm:col-span-3">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <div class="mt-1">
                        <input type="text" name="phone" id="phone" class="shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border">
                    </div>
                </div>

                <!-- Gender -->
                <div class="sm:col-span-3">
                    <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                    <div class="mt-1">
                        <select id="gender" name="gender" class="shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border">
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </div>
                </div>

                <!-- Address -->
                <div class="sm:col-span-6">
                    <label for="street-address" class="block text-sm font-medium text-gray-700">Street address</label>
                    <div class="mt-1">
                        <input type="text" name="street-address" id="street-address" autocomplete="street-address" class="shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border">
                    </div>
                </div>
            </div>

            <div class="pt-5">
                <div class="flex justify-end">
                    <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">Cancel</button>
                    <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">Save</button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
