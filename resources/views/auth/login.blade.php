<x-layouts.guest>

    <h2 class="text-2xl font-bold text-gray-800 mb-1">Welcome back!</h2>
    <p class="text-gray-500 text-sm mb-6">Sign in to continue to Mini Quiz</p>

    <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1" for="email">Email</label>
            <input type="email" id="email" name="email"
                   value="{{ old('email') }}"
                   required autofocus
                   class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition @error('email') border-red-400 @enderror"
                   placeholder="you@email.com">
            @error('email')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1" for="password">Password</label>
            <input type="password" id="password" name="password"
                   required
                   class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition @error('password') border-red-400 @enderror"
                   placeholder="••••••••">
            @error('password')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" id="remember" name="remember" class="rounded text-indigo-600">
            <label for="remember" class="text-sm text-gray-600">Remember me</label>
        </div>

        <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 rounded-xl transition-colors">
            Sign In
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-gray-500">
        Don't have an account?
        <a href="{{ route('register') }}" class="text-indigo-600 font-medium hover:underline">Register</a>
    </p>

</x-layouts.guest>