@layout('templates.layout')

<div
    class="grid grid-cols-2 gap-12 w-full mt-10 p-12 h-auto absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">

    <!-- Login Card -->
    <form action="@route('loginSubmit')" method="post" class="glass-card rounded-3xl p-8 md:p-12">
        <h2 class="text-4xl font-bold text-gray-900 mb-7">Welcome to DigitalWave</h2>
        <p class="text-gray-600 mb-12">
            Log in to your account to continue
        </p>

        <div class="flex flex-col gap-8">

            <!-- Email -->
            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">
                    Email
                </label>
                <input
                    name="email"
                    type="email"
                    class="form-input w-full px-4 py-3 rounded-xl border-2 border-purple-100 focus:border-purple-300 focus:ring-0"
                    placeholder="you@example.com">
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">
                    Password
                </label>
                <input
                    name="password"
                    type="password"
                    class="form-input w-full px-4 py-3 rounded-xl border-2 border-purple-100 focus:border-purple-300 focus:ring-0"
                    placeholder="••••••••">
            </div>

            <!-- Forgot password -->
            <div class="text-right -mt-6">
                <a href="#"
                   class="text-sm font-medium text-purple-600 hover:text-purple-700 transition">
                    Forgot password?
                </a>
            </div>

            <!-- Submit -->
            <button
                class="w-full accent-gradient text-white px-8 py-4 rounded-xl font-semibold text-lg hover:shadow-lg transition-all duration-300 transform hover:scale-[1.02] flex items-center justify-center gap-3">
                Login
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </button>

            <!-- Divider -->
            <div class="flex items-center gap-4">
                <div class="flex-1 h-px bg-gray-200"></div>
                <span class="text-sm text-gray-400 font-medium">or login with</span>
                <div class="flex-1 h-px bg-gray-200"></div>
            </div>

            <!-- Social login -->
            <div class="grid grid-cols-2 gap-4">
                <button
                    class="flex items-center justify-center gap-3 border border-gray-200 rounded-xl py-3 font-medium text-gray-700 hover:bg-gray-50 transition">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5" />
                    Google
                </button>

                <button
                    class="flex items-center justify-center gap-3 border border-gray-200 rounded-xl py-3 font-medium text-gray-700 hover:bg-gray-50 transition">
                    <img src="https://www.svgrepo.com/show/512317/github-142.svg" class="w-5 h-5" />
                    GitHub
                </button>
            </div>

            <p class="text-center text-sm text-gray-600">
                Don't have an account?
                <a href="@route('signup')" class="text-purple-600 font-semibold hover:underline">
                    Sign Up
                </a>
            </p>

        </div>
    </form>

    <!-- Image -->
    <div class="flex items-center justify-center">
        <img src="@asset('images/loginimage.jpg')"
             alt="login image"
             class="w-[98%] h-auto">
    </div>

</div>

@endlayout
