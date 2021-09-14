<template>
    <app-layout>
        <!-- Page header -->
        <div class="bg-white shadow sticky top-0">
            <div class="px-4 sm:px-6 lg:px-8">
                <div
                    class="py-3 md:flex md:items-center md:justify-between lg:border-t lg:border-gray-200"
                >
                    <div class="flex-1 min-w-0">
                        <!-- Profile -->
                        <div class="flex items-center">
                            <img
                                class="hidden h-12 w-12 rounded-full sm:block"
                                :src="$page.props.auth.user.photo ? $page.props.auth.user.photo : '/images/icon/avatar.png'"
                                alt="Profile"
                            />
                            <div>
                                <div class="flex items-center">
                                    <img
                                        class="h-12 w-12 rounded-full sm:hidden"
                                        :src="$page.props.auth.user.photo ? $page.props.auth.user.photo : '/images/icon/avatar.png'"
                                        alt="Profile"
                                    />
                                    <h1
                                        class="ml-3 text-2xl font-bold leading-7 text-gray-900 sm:leading-9 sm:truncate"
                                    >
                                        Welcome, {{ $page.props.auth.user.name }}
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <div class="px-4 sm:px-6 lg:px-8">
                <h2 class="text-lg leading-6 font-medium text-gray-900">Overview</h2>
                <div class="mt-2 grid grid-cols-1 gap-5 sm:grid-cols-4">
                    <!-- Card -->
                    <div
                        v-for="card in cards"
                        :key="card.name"
                        class="bg-white overflow-hidden shadow rounded-lg"
                    >
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <component
                                        :is="card.icon"
                                        class="h-8 w-8 text-gray-400"
                                        aria-hidden="true"
                                    />
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">
                                            {{ card.name }}
                                        </dt>
                                        <dd>
                                            <div class="text-lg font-medium text-gray-900">
                                                {{ card.amount }}
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "../../Layouts/App";
import {
    CheckCircleIcon,
    OfficeBuildingIcon,
    CashIcon,
    ChevronRightIcon,
    LocationMarkerIcon,
    UserGroupIcon,
    UsersIcon,
    ChatAlt2Icon
} from "@heroicons/vue/solid";

export default {
    components: {
        AppLayout,
        OfficeBuildingIcon,
        CheckCircleIcon,
        CashIcon,
        ChevronRightIcon,
    },
    props: {
        totalEmployee: Number,
        totalLocations: Number,
        totalUsers: Number,
    },
    data() {
        return {
            cards: [
                {
                    name: "Locations",
                    icon: LocationMarkerIcon,
                    amount: this.totalLocations
                },
                {
                    name: "Employee",
                    icon: UserGroupIcon,
                    amount: this.totalEmployee
                },
                {
                    name: "Users",
                    icon: UsersIcon,
                    amount: this.totalUsers
                },
            ]
        }
    },
};
</script>
