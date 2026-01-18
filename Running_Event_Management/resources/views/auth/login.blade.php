@extends('layouts.guest')

@section('title', 'Sign In')

@section('content')
<div class="hidden lg:flex lg:w-1/2 relative runner-bg items-center justify-center">
    <div class="absolute inset-0 gradient-overlay mix-blend-multiply"></div>
    <div class="absolute inset-0 bg-black/20"></div> 
    <div class="relative z-10 p-12 text-white max-w-2xl">
        <div class="flex items-center gap-3 mb-8">
            <span class="material-icons-outlined text-5xl">directions_run</span>
            <h1 class="text-5xl font-bold tracking-tight">LariKalcer</h1>
        </div>
        <h2 class="text-3xl font-semibold mb-6">Manage Your Race, Master Your Pace.</h2>
        <p class="text-lg opacity-90 leading-relaxed mb-8">
            The comprehensive event management platform for runners, organizers, and admins. 
            Track events, manage participants, handle race packs, and view real-time leaderboards all in one place.
        </p>
        <div class="flex gap-4 mt-8">
            <div class="flex -space-x-4">
                <img alt="User avatar 1" class="w-10 h-10 rounded-full border-2 border-white" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCc-0fcQMgEZ8L7sOcXzfAESZlSjDDoaOA5Ono0A6AnzDQbBpiLM248EkDOyx5lTw60THGGswlyLOuU7knHhN5tT91Qmkk4Zxi1D1hSUvK7SaEQq11Oyx4ClmRnxVEYDjhAakQhRfqSfazZrpNeIJhbeXxhBuKh7DaIDHGPfph5yDzKoHwVLMx44TR-3hg-ykL-p0eIoW--6DyzyLcV9XW5SUaJ3PfZ9VdxvhB20k4TvRTHyeJvnA3FvfxnCoM93VzPpE7kOvkw3fA"/>
                <img alt="User avatar 2" class="w-10 h-10 rounded-full border-2 border-white" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB6ug93ykHwAeCcwap92Of6mJElVjxMs6MpUdaV47oCBnwkAv1s-eAGxUSyvRXpmTeE_eutmJq177b1E-CXpkJVuiyL5_yGmGwQ-HwW1f-nRCzy6vcv3DzSwJSE9tJmuB_zCzVuVPkScKQFtHLst_MMCxtGxQXeDPgLSQN_tIV0G1JpvmrRR8QvqtmIIkPH6mJ_FPVR4zTRyvPqRqJaAJO1MCTqRgVAOpteJmKp3k7x5TEECHytjd6B5Ku3XyY6Q9p4BxEmN14Nfz4"/>
                <img alt="User avatar 3" class="w-10 h-10 rounded-full border-2 border-white" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAlLsoMn9Dx65BY9LRqTH7ckJDt79BiZbgwWy150GeklvMd26MOmH7dCkyNtZarfvAE_uGfINDkhQHeAI_GW4M1AM4N_abi4vplcQ0lt3w3LJuhlSHh102S-i6u2Qtyvkstl3g9CtAdoSqnkTllyOzUUWlPUMtb015wHCN1T4r4kH8FrT7udRfO2TUBllYdP4NBlasKuUwJVwsVJptjBr8R0SAFW6Wo2G4af-irtuoOQ42yQ9jdCJdeBhFZHwPUUVrdkhwE1ZXPApA"/>
                <div class="w-10 h-10 rounded-full border-2 border-white bg-white/20 flex items-center justify-center text-xs font-bold backdrop-blur-sm">
                    +2k
                </div>
            </div>
            <div class="flex flex-col justify-center">
                <span class="text-sm font-semibold">Join 2,000+ Runners</span>
                <span class="text-xs opacity-75">Active community members</span>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-6 mt-12">
            <div class="flex items-start gap-3">
                <div class="p-2 bg-white/20 rounded-lg backdrop-blur-sm">
                    <span class="material-icons-outlined text-xl">event_available</span>
                </div>
                <div>
                    <h4 class="font-semibold text-sm">Event Management</h4>
                    <p class="text-xs opacity-75 mt-1">Seamless registration &amp; tracking</p>
                </div>
            </div>
            <div class="flex items-start gap-3">
                <div class="p-2 bg-white/20 rounded-lg backdrop-blur-sm">
                    <span class="material-icons-outlined text-xl">insights</span>
                </div>
                <div>
                    <h4 class="font-semibold text-sm">Real-time Analytics</h4>
                    <p class="text-xs opacity-75 mt-1">Live results &amp; leaderboards</p>
                </div>
            </div>
        </div>
    </div>
    <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-accent/20 rounded-full blur-3xl"></div>
    <div class="absolute top-12 right-12 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
</div>
<div class="w-full lg:w-1/2 flex flex-col h-full bg-surface-light dark:bg-surface-dark overflow-y-auto relative">
    <div class="absolute top-6 right-6">
        <button class="p-2 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors" onclick="document.documentElement.classList.toggle('dark')">
            <span class="material-icons-outlined dark:hidden">dark_mode</span>
            <span class="material-icons-outlined hidden dark:block">light_mode</span>
        </button>
    </div>
    <div class="flex-1 flex flex-col justify-center max-w-md mx-auto w-full px-6 py-12">
        <div class="lg:hidden flex items-center gap-2 mb-8 text-primary">
            <span class="material-icons-outlined text-3xl">directions_run</span>
            <span class="text-2xl font-bold">LariKalcer</span>
        </div>
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Welcome Back!</h2>
            <p class="text-gray-500 dark:text-gray-400">Enter your details to access your dashboard.</p>
        </div>
        
        <!-- Mock functionality for role selection visual -->
        <div class="bg-gray-100 dark:bg-gray-800 p-1 rounded-xl flex mb-8">
            <button type="button" class="flex-1 py-2 px-4 rounded-lg text-sm font-medium bg-white dark:bg-gray-700 text-primary shadow-sm transition-all duration-200">
                Participant
            </button>
            <button type="button" class="flex-1 py-2 px-4 rounded-lg text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition-all duration-200">
                Organizer / Admin
            </button>
        </div>

        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1" for="email">Email Address</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <span class="material-icons-outlined text-xl">email</span>
                    </span>
                    <input class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg leading-5 bg-white dark:bg-gray-800 placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm text-gray-900 dark:text-white transition-colors" id="email" name="email" placeholder="runner@example.com" type="email" required/>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1" for="password">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <span class="material-icons-outlined text-xl">lock</span>
                    </span>
                    <input class="block w-full pl-10 pr-10 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg leading-5 bg-white dark:bg-gray-800 placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm text-gray-900 dark:text-white transition-colors" id="password" name="password" placeholder="••••••••" type="password" required/>
                    <button class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" type="button">
                        <span class="material-icons-outlined text-xl">visibility_off</span>
                    </button>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600" id="remember-me" name="remember" type="checkbox"/>
                    <label class="ml-2 block text-sm text-gray-700 dark:text-gray-300" for="remember-me">
                        Remember me
                    </label>
                </div>
                <div class="text-sm">
                    <a class="font-medium text-primary hover:text-blue-700 dark:hover:text-blue-400" href="#">
                        Forgot password?
                    </a>
                </div>
            </div>
            <button class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors transform active:scale-[0.98]" type="submit">
                Sign In
            </button>
        </form>

        <div class="mt-8">
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-surface-light dark:bg-surface-dark text-gray-500 dark:text-gray-400">
                        Or continue with
                    </span>
                </div>
            </div>
            <div class="mt-6 grid grid-cols-2 gap-3">
                <button class="w-full inline-flex justify-center items-center py-2.5 px-4 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-800 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12.545,10.239v3.821h5.445c-0.712,2.315-2.647,3.972-5.445,3.972c-3.332,0-6.033-2.701-6.033-6.032s2.701-6.032,6.033-6.032c1.498,0,2.866,0.549,3.921,1.453l2.814-2.814C17.503,2.988,15.139,2,12.545,2C7.021,2,2.543,6.477,2.543,12s4.478,10,10.002,10c8.396,0,10.249-7.85,9.426-11.748L12.545,10.239z"></path>
                    </svg>
                    Google
                </button>
                <button class="w-full inline-flex justify-center items-center py-2.5 px-4 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-800 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <svg class="h-5 w-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.791-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"></path>
                    </svg>
                    Facebook
                </button>
            </div>
        </div>
        <p class="mt-8 text-center text-sm text-gray-600 dark:text-gray-400">
            Don't have an account yet? 
            <a class="font-medium text-primary hover:text-blue-700 dark:hover:text-blue-400" href="#">Sign up now</a>
        </p>
    </div>
    <div class="py-6 px-6 text-center border-t border-gray-200 dark:border-gray-700">
        <div class="flex justify-center space-x-6 text-xs text-gray-400 dark:text-gray-500">
            <a class="hover:text-gray-600 dark:hover:text-gray-300" href="#">Privacy Policy</a>
            <a class="hover:text-gray-600 dark:hover:text-gray-300" href="#">Terms of Service</a>
            <a class="hover:text-gray-600 dark:hover:text-gray-300" href="#">Help Center</a>
        </div>
        <p class="mt-2 text-xs text-gray-400 dark:text-gray-500">© 2024 LariKalcer Inc. All rights reserved.</p>
    </div>
</div>
@endsection
