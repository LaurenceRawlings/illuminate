<template>
    <div class="min-h-screen bg-gray-100">
        <flash-message v-if="$page.flash.message"/>
        <nav class="bg-white border-b border-gray-100">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <inertia-link :href="route('home')">
                                <!-- <jet-application-mark class="block h-9 w-auto" /> -->
                                <app-header/>
                            </inertia-link>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <jet-nav-link :active="route().current('posts.index')" :href="route('posts.index')">
                                Read
                            </jet-nav-link>
                        </div>

                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <jet-nav-link :active="route().current('news.index')" :href="route('news.index')">
                                News
                            </jet-nav-link>
                        </div>

                        <div v-if="$page.user" class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <jet-nav-link :active="route().current('posts.create')" :href="route('posts.create')">
                                Write
                            </jet-nav-link>
                        </div>
                    </div>

                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <div v-if="$page.user" class="ml-3 relative flex items-center">
                            <inertia-link :href="route('notifications.index')">
                                <div class="relative mr-4 flex">
                                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                                    </svg>
                                    <div v-show="$page.unreadNotificationsCount"
                                         class="z-1 -ml-3 -mt-1 bg-red-500 text-white text-xs px-1 rounded-full font-bold h-full">
                                        {{ $page.unreadNotificationsCount }}
                                    </div>
                                </div>
                            </inertia-link>

                            <jet-dropdown align="right" width="48">
                                <template #trigger>
                                    <button v-if="$page.jetstream.managesProfilePhotos"
                                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                        <img :alt="$page.user.name"
                                             :src="$page.user.profile_photo_url" class="h-10 w-10 rounded-full object-cover"/>
                                    </button>

                                    <button v-else
                                            class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                        <div>{{ $page.user.name }}</div>

                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" viewBox="0 0 20 20"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path clip-rule="evenodd"
                                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                      fill-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    </button>
                                </template>

                                <template #content>
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Manage Account
                                    </div>

                                    <jet-dropdown-link :href="route('user.show', $page.user.username)">
                                        Profile
                                    </jet-dropdown-link>

                                    <jet-dropdown-link :href="route('profile.show')">
                                        Settings
                                    </jet-dropdown-link>

                                    <jet-dropdown-link v-if="$page.user.is_admin" :href="route('users.index')">
                                        Admin
                                    </jet-dropdown-link>

                                    <jet-dropdown-link v-if="$page.jetstream.hasApiFeatures"
                                                       :href="route('api-tokens.index')">
                                        API Tokens
                                    </jet-dropdown-link>

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Team Management -->
                                    <template v-if="$page.jetstream.hasTeamFeatures">
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            Manage Team
                                        </div>

                                        <!-- Team Settings -->
                                        <jet-dropdown-link :href="route('teams.show', $page.user.current_team)">
                                            Team Settings
                                        </jet-dropdown-link>

                                        <jet-dropdown-link v-if="$page.jetstream.canCreateTeams"
                                                           :href="route('teams.create')">
                                            Create New Team
                                        </jet-dropdown-link>

                                        <div class="border-t border-gray-100"></div>

                                        <!-- Team Switcher -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            Switch Teams
                                        </div>

                                        <template v-for="team in $page.user.all_teams">
                                            <form :key="team.id" @submit.prevent="switchToTeam(team)">
                                                <jet-dropdown-link as="button">
                                                    <div class="flex items-center">
                                                        <svg v-if="team.id === $page.user.current_team_id"
                                                             class="mr-2 h-5 w-5 text-green-400" fill="none"
                                                             stroke="currentColor" stroke-linecap="round"
                                                             stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                                                            <path
                                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        <div>{{ team.name }}</div>
                                                    </div>
                                                </jet-dropdown-link>
                                            </form>
                                        </template>

                                        <div class="border-t border-gray-100"></div>
                                    </template>

                                    <!-- Authentication -->
                                    <form @submit.prevent="logout">
                                        <jet-dropdown-link as="button">
                                            Logout
                                        </jet-dropdown-link>
                                    </form>
                                </template>
                            </jet-dropdown>
                        </div>

                        <div v-else class="ml-3 relative">
                            <a class="mr-4 font-semibold text-xs uppercase tracking-widest" href="/login">
                                Login
                            </a>
                            <a href="/register">
                                <jet-button>
                                    Register
                                </jet-button>
                            </a>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                                @click="showingNavigationDropdown = ! showingNavigationDropdown">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }"
                                    d="M4 6h16M4 12h16M4 18h16" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"/>
                                <path
                                    :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                    d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <jet-responsive-nav-link :active="route().current('posts.index')" :href="route('posts.index')">
                        Read
                    </jet-responsive-nav-link>
                </div>

                <div class="pt-2 pb-3 space-y-1">
                    <jet-responsive-nav-link :active="route().current('news.index')" :href="route('news.index')">
                        News
                    </jet-responsive-nav-link>
                </div>

                <div v-if="$page.user" class="pt-2 pb-3 space-y-1">
                    <jet-responsive-nav-link :active="route().current('posts.create')" :href="route('posts.create')">
                        Write
                    </jet-responsive-nav-link>
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div v-if="$page.user">
                        <div class="flex items-center px-4">
                            <div class="flex-shrink-0">
                                <img :alt="$page.user.name" :src="$page.user.profile_photo_url"
                                     class="h-10 w-10 rounded-full"/>
                            </div>

                            <div class="ml-3">
                                <div class="font-medium text-base text-gray-800">{{ $page.user.name }}</div>
                                <div class="font-medium text-sm text-gray-500">{{ $page.user.email }}</div>
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <jet-responsive-nav-link :active="route().current('notifications.index')"
                                                     :href="route('notifications.index')">
                                <div class="flex items-center">
                                    <span class="mr-2">Notifications</span>
                                    <div v-show="$page.unreadNotificationsCount > 0"
                                         class="w-auto h-5 px-2 leading-5 rounded-full bg-red-500 text-white text-center text-sm font-bold align-middle">
                                        {{ $page.unreadNotificationsCount }}
                                    </div>
                                </div>
                            </jet-responsive-nav-link>

                            <jet-responsive-nav-link :active="route().current('user.show', $page.user.username)"
                                                     :href="route('user.show', $page.user.username)">
                                Profile
                            </jet-responsive-nav-link>

                            <jet-responsive-nav-link :active="route().current('profile.show')"
                                                     :href="route('profile.show')">
                                Settings
                            </jet-responsive-nav-link>

                            <jet-responsive-nav-link v-if="$page.user.is_admin" :active="route().current('users.index')"
                                                     :href="route('users.index')">
                                Admin
                            </jet-responsive-nav-link>

                            <jet-responsive-nav-link v-if="$page.jetstream.hasApiFeatures"
                                                     :active="route().current('api-tokens.index')"
                                                     :href="route('api-tokens.index')">
                                API Tokens
                            </jet-responsive-nav-link>

                            <!-- Authentication -->
                            <form method="POST" @submit.prevent="logout">
                                <jet-responsive-nav-link as="button">
                                    Logout
                                </jet-responsive-nav-link>
                            </form>

                            <!-- Team Management -->
                            <template v-if="$page.jetstream.hasTeamFeatures">
                                <div class="border-t border-gray-200"></div>

                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Manage Team
                                </div>

                                <!-- Team Settings -->
                                <jet-responsive-nav-link :active="route().current('teams.show')"
                                                         :href="route('teams.show', $page.user.current_team)">
                                    Team Settings
                                </jet-responsive-nav-link>

                                <jet-responsive-nav-link :active="route().current('teams.create')"
                                                         :href="route('teams.create')">
                                    Create New Team
                                </jet-responsive-nav-link>

                                <div class="border-t border-gray-200"></div>

                                <!-- Team Switcher -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Switch Teams
                                </div>

                                <template v-for="team in $page.user.all_teams">
                                    <form :key="team.id" @submit.prevent="switchToTeam(team)">
                                        <jet-responsive-nav-link as="button">
                                            <div class="flex items-center">
                                                <svg v-if="team.id === $page.user.current_team_id"
                                                     class="mr-2 h-5 w-5 text-green-400" fill="none"
                                                     stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                     stroke-width="2" viewBox="0 0 24 24">
                                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <div>{{ team.name }}</div>
                                            </div>
                                        </jet-responsive-nav-link>
                                    </form>
                                </template>
                            </template>
                        </div>
                    </div>

                    <div v-else class="ml-3 relative">
                        <a class="mr-4 font-semibold text-xs uppercase tracking-widest" href="/login">
                            Login
                        </a>
                        <a href="/register">
                            <jet-button>
                                Register
                            </jet-button>
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        <header v-if="hasHeaderSlot" class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot name="header"></slot>
            </div>
        </header>

        <!-- Page Content -->
        <main>
            <slot></slot>
        </main>

        <!-- Modal Portal -->
        <portal-target multiple name="modal">
        </portal-target>
    </div>
</template>

<script>
import JetApplicationMark from '@/Jetstream/ApplicationMark'
import JetDropdown from '@/Jetstream/Dropdown'
import JetDropdownLink from '@/Jetstream/DropdownLink'
import JetNavLink from '@/Jetstream/NavLink'
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'
import JetButton from "@/Jetstream/Button";

import AppHeader from "@/Shared/Components/HeaderGreeting";
import FlashMessage from "@/Shared/Components/FlashMessage";

export default {
    components: {
        FlashMessage,
        JetApplicationMark,
        JetDropdown,
        JetDropdownLink,
        JetNavLink,
        JetResponsiveNavLink,
        AppHeader,
        JetButton,
    },

    data() {
        return {
            showingNavigationDropdown: false,
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
            axios.post(route('logout').url()).then(response => {
                window.location = '/';
            })
        },
    },

    computed: {
        hasHeaderSlot() {
            return !!this.$slots.header
        }
    },

    created() {
        if (this.$page.user) {
            Echo.private(`App.Models.Users.${this.$page.user.id}`)
                .notification((notification) => {
                    axios.get('/notifications').then(response => {
                        this.$page.unreadNotificationsCount = response.data.unread;
                    });
                });
        }
    },
}
</script>
