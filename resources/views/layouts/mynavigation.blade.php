<nav x-data="{ open: false }">
    <!-- Primary Navigation Menu -->
    <div class="bg-orange mt-4 flex h-20 justify-between rounded-lg border-b border-gray-100 px-8">
        <div class="flex">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route("index") }}" class="flex items-center gap-4">
                    <img src="icon-black.png">
                    <h1 class="flex w-auto items-center justify-center text-5xl font-title">TutorConnect</h1>
                    <p class="text-xl font-body ml-4">家庭教師として働く大学生のためのQ&Aプラットフォーム</p>
                </a>
            </div>
        </div>

        <!-- Settings Dropdown -->
        <div class="hidden sm:ms-6 sm:flex sm:items-center">
            @auth
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __("Profile") }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route("logout") }}">
                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();"
                            >
                                {{ __("Log Out") }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            @endauth

            @guest
                <a href="/login" class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none">
                    <div>Log in</div>
                </a>
                <a href="/register" class="ms-4 inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none">
                    <div>Register</div>
                </a>
            @endguest
        </div>
    </div>
</nav>
