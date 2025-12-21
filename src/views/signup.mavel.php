@layout('templates.layout')

<div
    class="grid grid-cols-2 gap-12 w-full mt-10 p-12 h-auto absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">

    <!-- Sign Up Card -->
    <form action="@route('signupSubmit')" method="post" class="glass-card rounded-3xl p-8 md:p-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Create Account</h2>
        <p class="text-gray-600 mb-6">
            Join us and start your journey in just a few seconds
        </p>

        <div class="flex flex-col gap-6">

            <!-- Name -->
            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">
                    Full Name
                </label>
                <input
                    name="name"
                    type="text"
                    class="form-input w-full px-4 py-3 rounded-xl border-2 border-purple-100 focus:border-purple-300 focus:ring-0"
                    placeholder="Badr Eddine">
            </div>

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

            <!-- Confirm Password -->
            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">
                    Confirm Password
                </label>
                <input
                    name="password_confirmation"
                    type="password"
                    class="form-input w-full px-4 py-3 rounded-xl border-2 border-purple-100 focus:border-purple-300 focus:ring-0"
                    placeholder="••••••••">
            </div>

            <!-- Terms -->
            <div class="flex items-start gap-3 text-sm text-gray-600">
                <input name="terms" type="checkbox" class="mt-1 rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                <p>
                    I agree to the
                    <a href="#" class="text-purple-600 font-medium hover:underline">Terms</a>
                    and
                    <a href="#" class="text-purple-600 font-medium hover:underline">Privacy Policy</a>
                </p>
            </div>

            <!-- Submit -->
            <button
                class="w-full accent-gradient text-white px-8 py-4 rounded-xl font-semibold text-lg hover:shadow-lg transition-all duration-300 transform hover:scale-[1.02] flex items-center justify-center gap-3">
                Sign Up
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </button>

            <!-- Divider -->
            <div class="flex items-center gap-4">
                <div class="flex-1 h-px bg-gray-200"></div>
                <span class="text-sm text-gray-400 font-medium">or sign up with</span>
                <div class="flex-1 h-px bg-gray-200"></div>
            </div>
    
            <!-- Login link -->
            <p class="text-center text-sm text-gray-600">
                Already have an account?
                <a href="@route('login')" class="text-purple-600 font-semibold hover:underline">
                    Login
                </a>
            </p>

        </div>
    </form>

    <!-- Image -->
    <div class="flex items-center justify-center">
        <img src="@asset('images/signupimage.jpg')"
             alt="signup image"
             class="w-[84%] h-auto">
    </div>

</div>

@endlayout