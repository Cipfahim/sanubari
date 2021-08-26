<template>
    <TransitionRoot as="template" :show="sidebarOpen">
        <Dialog as="div" static class="fixed inset-0 flex z-40 lg:hidden" @close="sidebarOpen = false"
                :open="sidebarOpen">
            <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0"
                             enter-to="opacity-100" leave="transition-opacity ease-linear duration-300"
                             leave-from="opacity-100" leave-to="opacity-0">
                <DialogOverlay class="fixed inset-0 bg-gray-600 bg-opacity-75"/>
            </TransitionChild>
            <TransitionChild as="template" enter="transition ease-in-out duration-300 transform"
                             enter-from="-translate-x-full" enter-to="translate-x-0"
                             leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0"
                             leave-to="-translate-x-full">
                <div class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-cyan-700">
                    <TransitionChild as="template" enter="ease-in-out duration-300" enter-from="opacity-0"
                                     enter-to="opacity-100" leave="ease-in-out duration-300" leave-from="opacity-100"
                                     leave-to="opacity-0">
                        <div class="absolute top-0 right-0 -mr-12 pt-2">
                            <button
                                class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                                @click="sidebarOpen = false">
                                <span class="sr-only">Close sidebar</span>
                                <XIcon class="h-6 w-6 text-white" aria-hidden="true"/>
                            </button>
                        </div>
                    </TransitionChild>
                    <div class="flex-shrink-0 flex items-center px-4">
                        <img class="h-8 w-auto"
                             src="https://tailwindui.com/img/logos/easywire-logo-cyan-300-mark-white-text.svg"
                             alt="Easywire logo"/>
                    </div>
                    <nav class="mt-5 flex-shrink-0 h-full divide-y divide-cyan-800 overflow-y-auto"
                         aria-label="Sidebar">
                        <div class="px-2 space-y-1">
                            <inertia-link v-if="$page.props.auth.user.role.slug === 'employee'"
                                          v-for="item in employeeNavigation" :key="item.name" :href="item.href"
                                          :class="[item.current ? 'bg-cyan-800 text-white' : 'text-cyan-100 hover:text-white hover:bg-cyan-600', 'group flex items-center px-2 py-2 text-base font-medium rounded-md']"
                                          :aria-current="item.current ? 'page' : undefined">
                                <component :is="item.icon" class="mr-4 h-6 w-6 text-cyan-200" aria-hidden="true"/>
                                {{ item.name }}
                            </inertia-link>

                            <inertia-link v-else v-for="item in navigation" :key="item.name" :href="item.href"
                                          :class="[item.current ? 'bg-cyan-800 text-white' : 'text-cyan-100 hover:text-white hover:bg-cyan-600', 'group flex items-center px-2 py-2 text-base font-medium rounded-md']"
                                          :aria-current="item.current ? 'page' : undefined">
                                <component :is="item.icon" class="mr-4 h-6 w-6 text-cyan-200" aria-hidden="true"/>
                                {{ item.name }}
                            </inertia-link>
                        </div>
                        <!--                        <div class="px-2 space-y-1">-->
                        <!--                            <inertia-link v-for="item in navigation" :key="item.name" :href="item.href"-->
                        <!--                                          :class="[item.current ? 'bg-cyan-800 text-white' : 'text-cyan-100 hover:text-white hover:bg-cyan-600', 'group flex items-center px-2 py-2 text-base font-medium rounded-md']"-->
                        <!--                                          :aria-current="item.current ? 'page' : undefined">-->
                        <!--                                <component :is="item.icon" class="mr-4 h-6 w-6 text-cyan-200" aria-hidden="true"/>-->
                        <!--                                {{ item.name }}-->
                        <!--                            </inertia-link>-->
                        <!--                        </div>-->
                        <div class="mt-6 pt-6">
                            <div class="px-2 space-y-1">
                                <inertia-link v-for="item in secondaryNavigation" :key="item.name" :href="item.href"
                                              class="group flex items-center px-2 py-2 text-base font-medium rounded-md text-cyan-100 hover:text-white hover:bg-cyan-600">
                                    <component :is="item.icon" class="mr-4 h-6 w-6 text-cyan-200" aria-hidden="true"/>
                                    {{ item.name }}
                                </inertia-link>
                            </div>
                        </div>
                    </nav>
                </div>
            </TransitionChild>
            <div class="flex-shrink-0 w-14" aria-hidden="true">
                <!-- Dummy element to force sidebar to shrink to fit close icon -->
            </div>
        </Dialog>
    </TransitionRoot>

    <!-- Static sidebar for desktop -->
    <div class="hidden lg:flex lg:flex-shrink-0">
        <div class="flex flex-col w-64">
            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <div class="flex flex-col flex-grow bg-cyan-700 pt-5 pb-4 overflow-y-auto">
                <div class="flex items-center flex-shrink-0 px-4">
                    <img class="h-8 w-auto"
                         src="https://tailwindui.com/img/logos/easywire-logo-cyan-300-mark-white-text.svg"
                         alt="Easywire logo"/>
                </div>
                <nav class="mt-5 flex-1 flex flex-col divide-y divide-cyan-800 overflow-y-auto" aria-label="Sidebar">
                    <div class="px-2 space-y-1">
                        <inertia-link v-for="item in navigation" :key="item.name" :href="item.href"
                                      :class="[item.current ? 'bg-cyan-800 text-white' : 'text-cyan-100 hover:text-white hover:bg-cyan-600', 'group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md']"
                                      :aria-current="item.current ? 'page' : undefined">
                            <component :is="item.icon" class="mr-4 h-6 w-6 text-cyan-200" aria-hidden="true"/>
                            {{ item.name }}
                        </inertia-link>
                    </div>
                    <div class="mt-6 pt-6">
                        <div class="px-2 space-y-1">
                            <inertia-link v-for="item in secondaryNavigation" :key="item.name" :href="item.href"
                                          class="group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md text-cyan-100 hover:text-white hover:bg-cyan-600">
                                <component :is="item.icon" class="mr-4 h-6 w-6 text-cyan-200" aria-hidden="true"/>
                                {{ item.name }}
                            </inertia-link>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
import {ref} from 'vue'
import {Dialog, DialogOverlay, TransitionChild, TransitionRoot,} from '@headlessui/vue'
import {ClockIcon, CogIcon, HomeIcon, UsersIcon, XIcon,} from '@heroicons/vue/outline'

export default {
    components: {
        Dialog,
        DialogOverlay,
        TransitionRoot,
        TransitionChild,
        XIcon,
        UsersIcon
    },
    setup() {
        const sidebarOpen = ref(false)

        return {
            sidebarOpen,
        }
    },
    data() {
        return {
            navigation: [
                {
                    name: 'Dashboard',
                    href: route('dashboard'),
                    icon: HomeIcon,
                    current: route().current('dashboard')
                },
                {
                    name: 'Employees',
                    href: route('employees.index'),
                    icon: ClockIcon,
                    current: route().current('employees.*'),
                },
                {
                    name: 'Locations',
                    href: route('locations.index'),
                    icon: ClockIcon,
                    current: route().current('locations.*')
                },
                {
                    name: 'Country',
                    href: route('countries.index'),
                    icon: ClockIcon,
                    current: route().current('countries.*')
                },
                {
                    name: 'City',
                    href: route('cities.index'),
                    icon: ClockIcon,
                    current: route().current('cities.*')
                },
                {
                    name: 'Bank List',
                    href: route('banks.index'),
                    icon: ClockIcon,
                    current: route().current('banks.*')
                },
                {
                    name: 'Activity Logs',
                    href: route('activityLogs.index'),
                    icon: CogIcon,
                    current: route().current('activityLogs.*')
                },
                {
                    name: 'Users',
                    href: route('users.index'),
                    icon: UsersIcon,
                    current: route().current('users.*')
                },
            ],
            secondaryNavigation: [
                {
                    name: 'Auditor Access',
                    href: route('auditor-access.index'),
                    icon: ClockIcon,
                    current: route().current('auditor-access.*')
                },
                {
                    name: 'Documents',
                    href: '/documents',
                    icon: CogIcon,
                    current: ''
                },
                {
                    name: 'Pay Slip',
                    href: '/payslips',
                    icon: CogIcon,
                    current: ''
                },
                {
                    name: 'Settings',
                    href: '#',
                    icon: CogIcon,
                },
            ],
            employeeNavigation: [
                {
                    name: 'Auditor Access',
                    href: route('auditor-access.index'),
                    icon: ClockIcon,
                    current: route().current('auditor-access.*')
                },
                {
                    name: 'Documents',
                    href: '/documents',
                    icon: CogIcon,
                    current: route().current('auditor-access.*')
                },
                {
                    name: 'Pay Slip',
                    href: route('payslips.index'),
                    icon: CogIcon,
                    current: route().current('payslips.*')
                },
                {
                    name: 'Settings',
                    href: '#',
                    icon: CogIcon,
                },
            ]
        }
    }
}
</script>
