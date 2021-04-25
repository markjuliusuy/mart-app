<template>
    <div>
        <jet-banner/>

        <div class="md:h-screen md:flex md:flex-col min-h-screen bg-gray-100">
            <nav class="bg-white md:flex md:flex-shrink-0">
                <div
                    class="bg-gray-900 md:flex-shrink-0 md:w-56 px-6 py-4 flex items-center justify-between md:justify-center transition-all duration-300" :class="{'-ml-56': !sidebarOpen}">
                    <a :href="route('dashboard')" class="mt-1 text-white text-xl">
                       Mart
                    </a>
                    <button @click="showingSidebarNavigationDropdown = ! showingSidebarNavigationDropdown" type="button"
                            class="md:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="fill-white w-6 h-6">
                            <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
                        </svg>  <!----></button>
                </div>
                <!-- Primary Navigation Menu -->
                <div
                    class="bg-white border-b w-full p-4 md:py-0 text-sm md:text-md md:px-2 flex justify-between items-center" >
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <button class="hidden md:block p-1 mr-4" @click="sidebarOpen = !sidebarOpen">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                            <div class="ml-2">{{ time }}</div>
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
                     class="md:hidden">
                    <div style="position: fixed; inset: 0px; z-index: 99998; background: black; opacity: 0.2;"
                         @click="showingSidebarNavigationDropdown = ! showingSidebarNavigationDropdown"></div>
                    <div x-placement="bottom-end"
                         style="position: absolute; z-index: 99999; transform: translate3d(165px, 44px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <div class="mt-2 px-8 py-4 shadow-lg bg-gray-800 rounded">
                            <div>
                                <div class="mb-4" v-for="navItem in navItems">
                                    <inertia-link :href="route(navItem.route_index)" :active="route().current(navItem.route_index)" class="flex items-center group py-3">
                                        <div :class="isUrl(navItem.url) ? 'text-white' : 'text-indigo-300 group-hover:text-white'">
                                            {{ navItem.label }}</div>
                                    </inertia-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>


            <!-- Page Content -->
            <main class="md:flex md:flex-grow md:overflow-hidden">
                <div class="hidden md:block bg-gray-800 flex-shrink-0 w-56 p-8 overflow-y-auto transition-all duration-300" :class="{'-ml-56': !sidebarOpen}">
                    <div class="mb-4" v-for="navItem in navItems">
                        <inertia-link :href="route(navItem.route_index)" class="flex items-center group py-3">

                            <div :class="isUrl(navItem.url) ? 'text-white' : 'text-indigo-300 group-hover:text-white'">
                                {{ navItem.label }}</div>
                        </inertia-link>
                    </div>
<!--                    <div class="mb-4">-->
<!--                        <inertia-link :href="route('categories.index')" class="flex items-center group py-3">-->
<!--                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 20 20" :class="isUrl('categories') ? 'fill-white' : ''">-->
<!--                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />-->
<!--                            </svg> <div :class="isUrl('categories') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Categories</div>-->
<!--                        </inertia-link>-->
<!--                    </div>-->
                </div>

                <div class="md:flex-1 p-4 md:p-12 md:overflow-y-auto" scroll-region>
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
import navItems from '@/Shared/NavItems'

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
            navItems,
            sidebarOpen: true,
            timeInterval: null,
            time: Intl.DateTimeFormat(navigator.language, {
                dateStyle: 'full',
                timeStyle: 'medium'
            }).format()
        }
    },
    beforeDestroy() {
        // prevent memory leak
        clearInterval(this.timeInterval)
    },
    created() {
        // update the time every second
        this.timeInterval = setInterval(() => {
            // Concise way to format time according to system locale.
            // In my case this returns "3:48:00 am"
            this.time = Intl.DateTimeFormat(navigator.language, {
                dateStyle: 'full',
                timeStyle: 'medium'
            }).format()
        }, 1000)
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
