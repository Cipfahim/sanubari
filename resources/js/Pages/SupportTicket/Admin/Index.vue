<template>
    <app-layout>
        <div class="mt-4 px-4 sm:px-6 lg:px-8">
            <breadcrumb
                :links="[
          {
            title: 'All Support Tickets',
            active: true,
          },
        ]"
            />
            <div class="flex flex-col">
                <div class="overflow-x-auto shadow rounded sm:rounded-lg">
                    <div
                        class="align-middle inline-block min-w-full"
                    >
                        <div
                            v-if="true"
                            class="overflow-hidden rounded sm:rounded-lg"
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
                                        @click="sort('official_name')"
                                        class="pl-6 pr-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                    >
                                        <div class="flex gap-2 items-center">
                                            <sort-arrow :sort="true" field="official_name"/>
                                            Requester
                                        </div>
                                    </th>

                                    <th
                                        scope="col"
                                        @click="sort('phone')"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                    >
                                        <div class="flex gap-2 items-center">
                                            <sort-arrow :sort="true" field="phone"/>
                                            Subject
                                        </div>
                                    </th>

                                    <th
                                        scope="col"
                                        @click="sort('status')"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                    >
                                        <div class="flex gap-2 items-center">
                                            <sort-arrow :sort="true" field="status"/>
                                            <span>Status</span>
                                        </div>
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <span>Last Message</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                <tr
                                    v-for="(ticket, index) in tickets.data"
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
                                                <inertia-link :href="route('supportTickets.admin.show', {
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
                                        {{ last_message }}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <pagination class="m-2" :links="5"/>
                        </div>
                        <no-data-found
                            v-else
                            resource="employees"
                            action-text="Add Employee"
                            :action-link="route('employees.create')"
                        />
                    </div>
                </div>
            </div>
        </div>

    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/App";
import Breadcrumb from "@/Components/Breadcrumb";
import NoDataFound from "@/Components/NoDataFound";
import Pagination from "@/Components/Pagination";
import SortArrow from "@/Components/SortArrow";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import Button from "@/Jetstream/Button";
import {SearchIcon} from "@heroicons/vue/solid";
import throttle from "lodash/throttle";
import pickBy from "lodash/pickBy";

export default {
    components: {
        Button,
        AppLayout,
        Breadcrumb,
        NoDataFound,
        Pagination,
        SortArrow,
        JetSecondaryButton,
        JetDangerButton,
        SearchIcon,
    },
    props: {
        tickets: Object,
        last_message: Object,
        requests: Object
    },
    data() {
        return {
            queryForm: {
                field: this.requests.filter
                    ? Object.keys(this.requests.filter)[0]
                    : "user.name",
                filter: this.requests.filter
                    ? Object.values(this.requests.filter)[1]
                    : "subject",
                sort: this.requests.sort,
            },
            checkAll: false,
        };
    },
    methods: {
        sort(field) {
            this.queryForm.sort === field
                ? (this.queryForm.sort = "-" + field)
                : (this.queryForm.sort = field);
        },

    },
};
</script>
