<template>
    <div>
        <jet-banner/>

        <div class="md:h-screen md:flex md:flex-col min-h-screen bg-gray-100">
            <nav class="bg-white md:flex md:flex-shrink-0">
                <div
                    class="bg-gray-900 md:flex-shrink-0 md:w-56 px-6 py-4 flex items-center justify-between md:justify-center">
                    <a href="https://demo.inertiajs.com/" class="mt-1">
                        <svg viewBox="0 0 1185 266" xmlns="http://www.w3.org/2000/svg" width="120" height="28"
                             class="fill-white">
                            <path
                                d="M77.463 265c-19.497 0-35.318-15.405-35.318-34.39v-22.054C17.987 202.676 0 181.326 0 155.948V55.206C0 25.291 24.946 1 55.668 1h154.664C241.054 1 266 25.29 266 55.206v100.806c0 29.916-24.946 54.206-55.668 54.206H145.67c-2.823 0-5.383 1.407-6.827 3.58-10.7 17.067-24.158 31.897-39.98 43.915-6.236 4.794-13.654 7.287-21.4 7.287zM55.701 27.336c-15.771 0-28.65 12.465-28.65 27.87v100.806c0 15.342 12.813 27.87 28.65 27.87 7.49 0 13.536 5.881 13.536 13.168v33.624c0 4.922 4.272 7.99 8.214 7.99 1.709 0 3.286-.575 4.732-1.662 13.273-10.1 24.576-22.565 33.578-36.947 6.309-10.036 17.743-16.237 29.965-16.237h64.727c15.77 0 28.65-12.464 28.65-27.87V55.206c0-15.341-12.814-27.87-28.65-27.87H55.7z"></path>
                            <path
                                d="M395.752 2.4c37.152 0 65.088 27.936 65.088 64.8 0 36.576-27.936 64.8-65.088 64.8h-46.368v72H322.6V2.4h73.152zm0 104.544c22.176 0 38.592-16.992 38.592-39.744 0-23.04-16.416-39.744-38.592-39.744h-46.368v79.488h46.368zM502.6 33.792c-9.504 0-16.992-7.488-16.992-16.704 0-9.216 7.488-16.992 16.992-16.992 9.216 0 16.704 7.776 16.704 16.992 0 9.216-7.488 16.704-16.704 16.704zM489.928 204V60h25.056v144h-25.056zM625 56.256c33.696 0 55.872 22.464 55.872 59.328V204h-25.056v-86.976c0-23.616-13.536-36.864-35.712-36.864-23.04 0-41.76 13.536-41.76 47.52V204h-25.056V60h25.056v20.736C589 63.744 604.84 56.256 625 56.256zM835.24 60h24.768v137.952c0 44.928-36 67.392-73.44 67.392-32.256 0-56.448-12.384-68.256-35.136l21.888-12.384c6.624 13.536 18.72 24.192 46.944 24.192 29.952 0 48.096-16.992 48.096-44.064v-20.448c-11.52 17.568-29.952 28.8-54.144 28.8-40.896 0-73.44-33.12-73.44-75.168 0-41.76 32.544-74.88 73.44-74.88 24.192 0 42.624 10.944 54.144 28.512V60zm-51.264 122.4c29.088 0 51.264-22.176 51.264-51.264 0-28.8-22.176-50.976-51.264-50.976-29.088 0-51.264 22.176-51.264 50.976 0 29.088 22.176 51.264 51.264 51.264zM946.8 205.08c-28.21 0-45.63-20.8-41.08-48.88 4.42-27.17 26.91-46.28 53.56-46.28 19.37 0 31.59 9.36 38.35 22.36l-23.79 12.61c-3.25-5.85-9.1-9.49-16.9-9.49-12.35 0-23.14 9.23-25.35 22.1-2.08 11.83 4.29 22.1 17.16 22.1 8.06 0 13.91-4.03 18.59-10.14l21.58 13.65c-9.36 13.78-24.44 21.97-42.12 21.97zm126.36-59.93c-1.95 11.18-8.58 19.5-18.2 24.44l11.7 33.28h-26l-9.36-28.6h-8.32l-5.07 28.6h-26l16.12-91h36.4c18.33 0 32.24 13.65 28.73 33.28zm-43.42-9.36l-2.99 16.9h10.66c5.07.13 8.84-2.99 9.75-8.32.91-5.33-1.82-8.58-7.02-8.58h-10.4zM1184.05 112l-15.99 91h-26l7.67-43.81-25.48 33.54h-2.34l-14.82-35.23-7.93 45.5h-26l15.99-91h26l13.65 37.31 27.95-37.31h27.3z"></path>
                        </svg>
                    </a>
                    <button @click="showingSidebarNavigationDropdown = ! showingSidebarNavigationDropdown" type="button"
                            class="md:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="fill-white w-6 h-6">
                            <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
                        </svg>  <!----></button>
                </div>
                <!-- Primary Navigation Menu -->
                <div
                    class="bg-white border-b w-full p-4 md:py-0 md:px-12 text-sm md:text-md flex justify-between items-center">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <div>Mart</div>
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <!-- Settings Dropdown -->
                        <div class="ml-3 relative">
                            <jet-dropdown align="right" width="48">
                                <template #trigger>
                                    <button v-if="$page.props.jetstream.managesProfilePhotos"
                                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="h-8 w-8 rounded-full object-cover"
                                             :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name"/>
                                    </button>

                                    <span v-else class="inline-flex rounded-md">
                                            <button type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                                {{ $page.props.user.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                          clip-rule="evenodd"/>
                                                </svg>
                                            </button>
                                        </span>
                                </template>

                                <template #content>
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Manage Account
                                    </div>

                                    <jet-dropdown-link :href="route('profile.show')">
                                        Profile
                                    </jet-dropdown-link>

                                    <jet-dropdown-link :href="route('api-tokens.index')"
                                                       v-if="$page.props.jetstream.hasApiFeatures">
                                        API Tokens
                                    </jet-dropdown-link>

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Authentication -->
                                    <form @submit.prevent="logout">
                                        <jet-dropdown-link as="button">
                                            Log Out
                                        </jet-dropdown-link>
                                    </form>
                                </template>
                            </jet-dropdown>
                        </div>
                    </div>


                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="showingNavigationDropdown = ! showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path
                                    :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"/>
                                <path
                                    :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}"
                     class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <jet-responsive-nav-link :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </jet-responsive-nav-link>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="flex items-center px-4">
                            <div v-if="$page.props.jetstream.managesProfilePhotos" class="flex-shrink-0 mr-3">
                                <img class="h-10 w-10 rounded-full object-cover"
                                     :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name"/>
                            </div>

                            <div>
                                <div class="font-medium text-base text-gray-800">{{ $page.props.user.name }}</div>
                                <div class="font-medium text-sm text-gray-500">{{ $page.props.user.email }}</div>
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <jet-responsive-nav-link :href="route('profile.show')"
                                                     :active="route().current('profile.show')">
                                Profile
                            </jet-responsive-nav-link>

                            <jet-responsive-nav-link :href="route('api-tokens.index')"
                                                     :active="route().current('api-tokens.index')"
                                                     v-if="$page.props.jetstream.hasApiFeatures">
                                API Tokens
                            </jet-responsive-nav-link>

                            <!-- Authentication -->
                            <form method="POST" @submit.prevent="logout">
                                <jet-responsive-nav-link as="button">
                                    Log Out
                                </jet-responsive-nav-link>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu For Sidebar -->
                <div :class="{'block': showingSidebarNavigationDropdown, 'hidden': ! showingSidebarNavigationDropdown}"
                     class="sm:hidden">
                    <div style="position: fixed; inset: 0px; z-index: 99998; background: black; opacity: 0.2;"
                         @click="showingSidebarNavigationDropdown = ! showingSidebarNavigationDropdown"></div>
                    <div x-placement="bottom-end"
                         style="position: absolute; z-index: 99999; transform: translate3d(165px, 44px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <div class="mt-2 px-8 py-4 shadow-lg bg-gray-800 rounded">
                            <div>
                                <div class="mb-4">
                                    <inertia-link :href="route('dashboard')" :active="route().current('dashboard')"
                                                   class="flex items-center group py-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                             class="w-4 h-4 mr-2 fill-white">
                                            <path
                                                d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm-5.6-4.29a9.95 9.95 0 0 1 11.2 0 8 8 0 1 0-11.2 0zm6.12-7.64l3.02-3.02 1.41 1.41-3.02 3.02a2 2 0 1 1-1.41-1.41z"></path>
                                        </svg>
                                        <div class="text-white">Dashboard</div>
                                    </inertia-link>
                                </div>
                                <div class="mb-4"><a href="https://demo.inertiajs.com/organizations"
                                                     class="flex items-center group py-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100"
                                         viewBox="0 0 100 100"
                                         class="w-4 h-4 mr-2 fill-indigo-400 group-hover:fill-white">
                                        <path fill-rule="evenodd"
                                              d="M7 0h86v100H57.108V88.418H42.892V100H7V0zm9 64h11v15H16V64zm57 0h11v15H73V64zm-19 0h11v15H54V64zm-19 0h11v15H35V64zM16 37h11v15H16V37zm57 0h11v15H73V37zm-19 0h11v15H54V37zm-19 0h11v15H35V37zM16 11h11v15H16V11zm57 0h11v15H73V11zm-19 0h11v15H54V11zm-19 0h11v15H35V11z"></path>
                                    </svg>
                                    <div class="text-indigo-300 group-hover:text-white">Organizations</div>
                                </a></div>
                                <div class="mb-4"><a href="https://demo.inertiajs.com/contacts"
                                                     class="flex items-center group py-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                         class="w-4 h-4 mr-2 fill-indigo-400 group-hover:fill-white">
                                        <path
                                            d="M7 8a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0 1c2.15 0 4.2.4 6.1 1.09L12 16h-1.25L10 20H4l-.75-4H2L.9 10.09A17.93 17.93 0 0 1 7 9zm8.31.17c1.32.18 2.59.48 3.8.92L18 16h-1.25L16 20h-3.96l.37-2h1.25l1.65-8.83zM13 0a4 4 0 1 1-1.33 7.76 5.96 5.96 0 0 0 0-7.52C12.1.1 12.53 0 13 0z"></path>
                                    </svg>
                                    <div class="text-indigo-300 group-hover:text-white">Contacts</div>
                                </a></div>
                                <div class="mb-4"><a href="https://demo.inertiajs.com/reports"
                                                     class="flex items-center group py-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                         class="w-4 h-4 mr-2 fill-indigo-400 group-hover:fill-white">
                                        <path
                                            d="M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z"></path>
                                    </svg>
                                    <div class="text-indigo-300 group-hover:text-white">Reports</div>
                                </a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>


            <!-- Page Content -->
            <main class="md:flex md:flex-grow md:overflow-hidden">
                <div class="hidden md:block bg-gray-800 flex-shrink-0 w-56 p-12 overflow-y-auto">
                    <div class="mb-4">
                        <inertia-link :href="route('dashboard')"
                                       class="flex items-center group py-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                 class="w-4 h-4 mr-2"
                                 :class="isUrl('dashboard') ? 'fill-white' : ''"
                            >
                                <path
                                    d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm-5.6-4.29a9.95 9.95 0 0 1 11.2 0 8 8 0 1 0-11.2 0zm6.12-7.64l3.02-3.02 1.41 1.41-3.02 3.02a2 2 0 1 1-1.41-1.41z"></path>
                            </svg>
                            <div :class="isUrl('dashboard') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Dashboard</div>
                        </inertia-link>
                    </div>
                    <div class="mb-4">
                        <inertia-link :href="route('suppliers.index')" class="flex items-center group py-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 20 20" :class="isUrl('suppliers') ? 'fill-white' : ''">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                            </svg> <div :class="isUrl('suppliers') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Suppliers</div>
                        </inertia-link>
                    </div>
                    <div class="mb-4">
                        <inertia-link :href="route('categories.index')" class="flex items-center group py-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 20 20" :class="isUrl('categories') ? 'fill-white' : ''">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                            </svg> <div :class="isUrl('categories') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Categories</div>
                        </inertia-link>
                    </div>
                    <div class="mb-4"><a href="https://demo.inertiajs.com/contacts" class="flex items-center group py-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             class="w-4 h-4 mr-2 fill-indigo-400 group-hover:fill-white">
                            <path
                                d="M7 8a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0 1c2.15 0 4.2.4 6.1 1.09L12 16h-1.25L10 20H4l-.75-4H2L.9 10.09A17.93 17.93 0 0 1 7 9zm8.31.17c1.32.18 2.59.48 3.8.92L18 16h-1.25L16 20h-3.96l.37-2h1.25l1.65-8.83zM13 0a4 4 0 1 1-1.33 7.76 5.96 5.96 0 0 0 0-7.52C12.1.1 12.53 0 13 0z"></path>
                        </svg>
                        <div class="text-indigo-300 group-hover:text-white">Contacts</div>
                    </a></div>
                    <div class="mb-4"><a href="https://demo.inertiajs.com/reports" class="flex items-center group py-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             class="w-4 h-4 mr-2 fill-indigo-400 group-hover:fill-white">
                            <path
                                d="M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z"></path>
                        </svg>
                        <div class="text-indigo-300 group-hover:text-white">Reports</div>
                    </a></div>
                </div>

                <div class="md:flex-1 px-4 py-8 md:p-12 md:overflow-y-auto" scroll-region>
                    <flash-messages />
                    <slot></slot>
                </div>
            </main>
        </div>
    </div>
</template>

<script>
import JetApplicationMark from '@/Jetstream/ApplicationMark'
import JetBanner from '@/Jetstream/Banner'
import JetDropdown from '@/Jetstream/Dropdown'
import JetDropdownLink from '@/Jetstream/DropdownLink'
import JetNavLink from '@/Jetstream/NavLink'
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'
import FlashMessages from '@/Shared/FlashMessages'

export default {
    components: {
        JetApplicationMark,
        JetBanner,
        JetDropdown,
        JetDropdownLink,
        JetNavLink,
        JetResponsiveNavLink,
        FlashMessages
    },

    data() {
        return {
            showingNavigationDropdown: false,
            showingSidebarNavigationDropdown: false,
        }
    },

    methods: {
        switchToTeam(team) {
            this.$inertia.put(route('current-team.update'), {
                'team_id': team.id
            }, {
                preserveState: false
            })
        },

        logout() {
            this.$inertia.post(route('logout'));
        },

        isUrl(...urls) {
            let currentUrl = this.$page.url.substr(1)
            if (urls[0] === '') {
                return currentUrl === ''
            }

            return urls.filter(url => currentUrl.startsWith(url)).length
        },
    }
}
</script>
