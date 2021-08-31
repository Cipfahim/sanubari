<template>
    <div class="relative z-10 flex-shrink-0 flex h-16 bg-white border-b border-gray-200 lg:border-none sticky top-0">
        <button
            class="px-4 border-r border-gray-200 text-gray-400 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-cyan-500 lg:hidden"
            @click="$emit('toggleSidebar')">
            <span class="sr-only">Open sidebar</span>
            <MenuAlt1Icon class="h-6 w-6" aria-hidden="true"/>
        </button>
        <!-- Search bar -->
        <div class="flex-1 flex justify-between px-4 sm:px-6 lg:px-8">
            <div class="flex-1 flex">
                <form class="w-full flex items-center md:ml-0" action="#" method="GET">
                    <label for="search_field" class="sr-only">Search</label>
                    <div class="relative w-full text-gray-400 focus-within:text-gray-600 bg-gray-100 rounded-md">
                        <div class="absolute inset-y-0 left-2 flex items-center pointer-events-none" aria-hidden="true">
                            <SearchIcon class="h-5 w-5" aria-hidden="true"/>
                        </div>
                        <input id="search_field" name="search_field"
                               class="block bg-transparent w-full h-full pl-8 pr-1 sm:pr-3 py-2 border-transparent text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-0 focus:border-transparent text-sm"
                               placeholder="Search transactions" type="search"/>
                    </div>
                </form>
            </div>
            <div class="ml-4 flex items-center md:ml-6">
                <button
                    class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                    <span class="sr-only">View notifications</span>
                    <BellIcon class="h-6 w-6" aria-hidden="true"/>
                </button>

                <!-- Profile dropdown -->
                <Menu as="div" class="ml-3 relative">
                    <div>
                        <MenuButton
                            class="max-w-xs bg-white rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 lg:p-2 lg:rounded-md lg:hover:bg-gray-50">
                            <img class="h-8 w-8 rounded-full"
                                 :src="$page.props.auth.user.photo ? $page.props.auth.user.photo : '/images/icon/avatar.png'"
                                 alt="Profile"/>
                            <span class="hidden ml-3 text-gray-700 text-sm font-medium lg:block"><span class="sr-only">Open user menu for </span>{{
                                    $page.props.auth.user.name
                                }}</span>
                            <ChevronDownIcon class="hidden flex-shrink-0 ml-1 h-5 w-5 text-gray-400 lg:block"
                                             aria-hidden="true"/>
                        </MenuButton>
                    </div>
                    <transition enter-active-class="transition ease-out duration-100"
                                enter-from-class="transform opacity-0 scale-95"
                                enter-to-class="transform opacity-100 scale-100"
                                leave-active-class="transition ease-in duration-75"
                                leave-from-class="transform opacity-100 scale-100"
                                leave-to-class="transform opacity-0 scale-95">
                        <MenuItems
                            class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                            <MenuItem v-slot="{ active }">
                                <a href="/profile"
                                   :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Your
                                    Profile</a>
                            </MenuItem>
                            <MenuItem v-slot="{ active }">
                                <a href="/password"
                                   :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Change
                                    Password</a>
                            </MenuItem>
                            <MenuItem v-slot="{ active }">
                                <a href="#"
                                   :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Settings</a>
                            </MenuItem>
                            <MenuItem v-slot="{ active }">
                                <inertia-link as="button" method="post" :href="route('logout')"
                                              :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700 w-full text-left']">
                                    Logout
                                </inertia-link>
                            </MenuItem>
                        </MenuItems>
                    </transition>
                </Menu>
            </div>
        </div>
    </div>
</template>

<script>
import {ChevronDownIcon, SearchIcon} from '@heroicons/vue/solid'
import {BellIcon, MenuAlt1Icon,} from '@heroicons/vue/outline'
import {Menu, MenuButton, MenuItem, MenuItems,} from '@headlessui/vue'

export default {
    emits: ['toggleSidebar'],
    components: {
        BellIcon,
        MenuAlt1Icon,
        ChevronDownIcon,
        SearchIcon,
        Menu,
        MenuButton,
        MenuItem,
        MenuItems,
    },
}
</script>
