<template>
    <app-layout>
        <!-- Page header -->
        <div class="bg-white shadow sticky top-0">
            <div class="px-4 sm:px-6 lg:px-8">
                <div
                    class="py-6 md:flex md:items-center md:justify-between lg:border-t lg:border-gray-200"
                >
                    <div class="flex-1 min-w-0">
                        <!-- Profile -->
                        <div class="flex items-center">
                            <img
                                class="hidden h-16 w-16 rounded-full sm:block"
                                :src="$page.props.auth.user.photo ? $page.props.auth.user.photo : '/images/icon/avatar.png'"
                                alt="Profile"
                            />
                            <div>
                                <div class="flex items-center">
                                    <img
                                        class="h-16 w-16 rounded-full sm:hidden"
                                        :src="$page.props.auth.user.photo ? $page.props.auth.user.photo : '/images/icon/avatar.png'"
                                        alt="Profile"
                                    />
                                    <h1
                                        class="ml-3 text-2xl font-bold leading-7 text-gray-900 sm:leading-9 sm:truncate"
                                    >
                                        Good morning, {{ $page.props.auth.user.name }}
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<div class="mt-6 flex space-x-3 md:mt-0 md:ml-4">-->
                    <!--    <button-->
                    <!--        type="button"-->
                    <!--        class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"-->
                    <!--    >-->
                    <!--        Add money-->
                    <!--    </button>-->
                    <!--    <button-->
                    <!--        type="button"-->
                    <!--        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"-->
                    <!--    >-->
                    <!--        Send money-->
                    <!--    </button>-->
                    <!--</div>-->
                </div>
            </div>
        </div>

        <div class="mt-8">
            <div class="px-4 sm:px-6 lg:px-8">
                <h2 class="text-lg leading-6 font-medium text-gray-900">Overview</h2>
                <div class="mt-2 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
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
                                        class="h-6 w-6 text-gray-400"
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
                        <div class="bg-gray-50 px-5 py-3">
                            <div class="text-sm">
                                <inertia-link
                                    :href="card.href"
                                    class="font-medium text-cyan-700 hover:text-cyan-900"
                                >
                                    View all
                                </inertia-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h2
                class="mt-8 text-lg leading-6 font-medium text-gray-900 px-4 sm:px-6 lg:px-8"
            >
                Recent message
            </h2>

            <!-- Activity list (smallest breakpoint only) -->
            <div class="shadow sm:hidden">
                <ul
                    class="mt-2 divide-y divide-gray-200 overflow-hidden shadow sm:hidden"
                >
                    <li v-for="transaction in transactions" :key="transaction.id">
                        <a
                            :href="transaction.href"
                            class="block px-4 py-4 bg-white hover:bg-gray-50"
                        >
              <span class="flex items-center space-x-4">
                <span class="flex-1 flex space-x-2 truncate">
                  <CashIcon
                      class="flex-shrink-0 h-5 w-5 text-gray-400"
                      aria-hidden="true"
                  />
                  <span class="flex flex-col text-gray-500 text-sm truncate">
                    <span class="truncate">{{ transaction.name }}</span>
                    <span
                    ><span class="text-gray-900 font-medium">{{
                            transaction.amount
                        }}</span>
                      {{ transaction.currency }}</span
                    >
                    <time :datetime="transaction.datetime">{{
                            transaction.date
                        }}</time>
                  </span>
                </span>
                <ChevronRightIcon
                    class="flex-shrink-0 h-5 w-5 text-gray-400"
                    aria-hidden="true"
                />
              </span>
                        </a>
                    </li>
                </ul>

                <nav
                    class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200"
                    aria-label="Pagination"
                >
                    <div class="flex-1 flex justify-between">
                        <a
                            href="#"
                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:text-gray-500"
                        >
                            Previous
                        </a>
                        <a
                            href="#"
                            class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:text-gray-500"
                        >
                            Next
                        </a>
                    </div>
                </nav>
            </div>

            <!-- Activity table (small breakpoint and up) -->
            <div class="hidden sm:block">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col mt-2">
                        <div
                            class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg"
                        >
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        scope="col"
                                        class="pl-3 pr-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Sl.
                                    </th>
                                    <th
                                        scope="col"
                                        class="pl-6 pr-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                    >
                                        <div class="flex gap-2 items-center">
                                            Requester
                                        </div>
                                    </th>

                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                    >
                                        <div class="flex gap-2 items-center">
                                            Subject
                                        </div>
                                    </th>

                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                    >
                                        <div class="flex gap-2 items-center">
                                            <span>Status</span>
                                        </div>
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <span>Last Message</span>
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                <tr
                                    v-for="(ticket, index) in recentSupportTickets"
                                    :key="ticket.id"
                                    class="hover:bg-gray-50 cursor-pointer"
                                >
                                    <td
                                        class="pl-3 pr-2 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        <div>
                                            {{ index + 1 }}
                                        </div>
                                    </td>

                                    <td
                                        class="pl-6 pr-2 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        <div class="flex items-center gap-2">
                                            <div class="h-8 w-8 rounded-full overflow-hidden">
                                                <img class="h-full w-full"
                                                     :src="false ? '' : '/images/icon/avatar.png'"
                                                     alt="">
                                            </div>
                                            <div class="flex-1 w-32 truncate">
                                                <inertia-link :href="route('supportTickets.show', {
                                                    'supportTicket': ticket.id
                                                })"
                                                              class="w-full"
                                                              title="Click to show details">
                                                    {{ ticket.user.name }}
                                                </inertia-link>
                                            </div>
                                        </div>
                                    </td>

                                    <td
                                        class="pl-6 pr-2 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        <div class="max-w-xs truncate"
                                             title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, provident!">
                                            {{ ticket.subject }}
                                        </div>
                                    </td>

                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        <span
                                            v-if="ticket.status === 'Open'"
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
                                        >
                                            Open
                                        </span>
                                        <span
                                            v-else-if="ticket.status === 'Pending'"
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800"
                                        >
                                            Pending
                                        </span>
                                        <span
                                            v-else
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800"
                                        >
                                            Closed
                                        </span>
                                    </td>

                                    <td
                                        class="px-6 whitespace-nowrap text-left text-sm font-medium space-x-2"
                                    >
                                        {{ ticket.updated_at }}
                                    </td>
                                    <td
                                        class="px-6 whitespace-nowrap text-left text-sm font-medium space-x-2 cyan-500"
                                    >
                                        <inertia-link
                                            :href="route('employee.supportTickets.show', {
                                               'id': ticket.id
                                            })"
                                            class="py-2 px-4 border border-transparent font-bold shadow-sm text-sm rounded-md text-white bg-cyan-500 hover:bg-cyan-600 focus:outline-none"
                                        >
                                            View
                                        </inertia-link>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "../Layouts/App";
import {
    CheckCircleIcon,
    OfficeBuildingIcon,
    CashIcon,
    ChevronRightIcon,
} from "@heroicons/vue/solid";
import {ScaleIcon} from "@heroicons/vue/outline/esm";

const transactions = [
    {
        id: 1,
        name: "Payment to Molly Sanders",
        href: "#",
        amount: "$20,000",
        currency: "USD",
        status: "success",
        date: "July 11, 2020",
        datetime: "2020-07-11",
    },
    // More transactions...
];
const statusStyles = {
    success: "bg-green-100 text-green-800",
    processing: "bg-yellow-100 text-yellow-800",
    failed: "bg-gray-100 text-gray-800",
};
export default {
    props: {
        totalEmployee: Number,
        totalLocations: Number,
        openSupportTickets: Number,
        pendingSupportTickets: Number,
        recentSupportTickets: Array,
    },
    components: {
        AppLayout,
        OfficeBuildingIcon,
        CheckCircleIcon,
        CashIcon,
        ChevronRightIcon,
    },
    data() {
        return {
            cards: [
                {
                    name: "Locations",
                    href: this.route('locations.index'),
                    icon: ScaleIcon,
                    amount: this.totalLocations
                },
                {
                    name: "Employee",
                    href: this.route('employees.index'),
                    icon: ScaleIcon,
                    amount: this.totalEmployee
                },
                {
                    name: "Pending Support Tickets",
                    href: this.route('supportTickets.index'),
                    icon: ScaleIcon,
                    amount: this.pendingSupportTickets
                },
                {
                    name: "Open Support Tickets",
                    href: this.route('supportTickets.index'),
                    icon: ScaleIcon,
                    amount: this.openSupportTickets
                },
            ]
        }
    },
    setup() {
        return {
            transactions,
            statusStyles,
        };
    },
};
</script>
