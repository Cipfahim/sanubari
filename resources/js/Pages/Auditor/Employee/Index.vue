<template>
    <app-layout>
        <div class="mt-4 px-4 sm:px-6 lg:px-8">
            <breadcrumb
                :links="[
          {
            title: 'Employees',
            active: true,
          },
        ]"
            />
            <div class="mb-6 flex flex-col sm:flex-row justify-between items-center gap-y-2 sm:h-10">
                <div class="flex items-center gap-1 sm:gap-2 w-full h-full max-w-xl sm:mr-4 order-2 sm:order-1">
                    <div
                        class="flex items-center w-full h-full bg-white shadow-sm rounded-md relative overflow-hidden"
                    >
                        <select v-model="queryForm.field"
                                class="h-full w-24 sm:w-40 truncate border-none focus:outline-none focus:border-none focus:ring-0 bg-gray-50 text-gray-800 text-sm">
                            <option value="employee.official_name">Official name</option>
                            <option value="employee.user.phone">Phone</option>
                            <option value="employee.location.name">Location</option>
                            <option value="employee.date_of_join">Date of join</option>
                            <option value="employee.user.status">Status</option>
                        </select>
                        <input
                            v-model="queryForm.filter"
                            autocomplete="off"
                            type="text"
                            name="search"
                            placeholder="Search…"
                            class="block w-full h-full px-2 py-2 border-none text-gray-900 placeholder-gray-600 focus:outline-none focus:ring-0 focus:border-transparent sm:text-sm"
                        />
                        <div class="mx-2 sm:mx-3">
                            <SearchIcon class="h-5 w-5 text-gray-400 hover:text-gray-500 cursor-pointer"/>
                        </div>
                    </div>
                    <button
                        type="button"
                        @click="reset"
                        class="py-2 px-2 sm:px-4 rounded-md font-bold text-sm shadow-sm bg-red-500 hover:bg-red-600 text-white hover:text-gray-100 focus:outline-none"
                    >
                        Reset
                    </button>
                </div>
            </div>
            <div class="flex flex-col relative">
                <div class="overflow-x-auto rounded sm:rounded-lg">
                    <div
                        class="align-middle inline-block min-w-full"
                    >
                        <div
                            v-if="sessions.data.length"
                            class="shadow rounded sm:rounded-lg"
                        >
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Sl.
                                    </th>
                                    <th
                                        scope="col"
                                        @click="sort('official_name')"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                    >
                                        <div class="flex gap-2 items-center">
                                            <sort-arrow :sort="queryForm.sort" field="official_name"/>
                                            Official name
                                        </div>
                                    </th>

                                    <th
                                        scope="col"
                                        @click="sort('phone')"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                    >
                                        <div class="flex gap-2 items-center">
                                            <sort-arrow :sort="queryForm.sort" field="phone"/>
                                            Phone
                                        </div>
                                    </th>

                                    <th
                                        scope="col"
                                        @click="sort('location')"
                                        class="px-6 py-3 w-44 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                    >
                                        <div class="flex gap-2 items-center">
                                            <sort-arrow :sort="queryForm.sort" field="location"/>
                                            Location
                                        </div>
                                    </th>

                                    <th
                                        scope="col"
                                        @click="sort('date_of_join')"
                                        class="px-6 py-3 w-44 block text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                    >
                                        <div class="flex gap-2 items-center">
                                            <sort-arrow :sort="queryForm.sort" field="date_of_join"/>
                                            <span>Date of Join</span>
                                        </div>
                                    </th>

                                    <th
                                        scope="col"
                                        @click="sort('status')"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                    >
                                        <div class="flex gap-2 items-center">
                                            <sort-arrow :sort="queryForm.sort" field="status"/>
                                            <span>Status</span>
                                        </div>
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <span>Actions</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                <tr
                                    v-for="(session, index) in sessions.data"
                                    :key="index"
                                    class="hover:bg-gray-50"
                                >
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        {{ index + 1 }}
                                    </td>

                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        <div class="flex items-center gap-2">
                                            <div class="h-8 w-8 rounded-full overflow-hidden">
                                                <img class="h-full w-full"
                                                     :src="session.employee.user.photo ? session.employee.user.photo : '/images/icon/avatar.png'"
                                                     :alt="session.employee.official_name">
                                            </div>
                                            <inertia-link :href="route('employees.show',session.employee.id)"
                                                          class="max-w-sm truncate"
                                                          title="Click to show details">
                                                {{ session.employee.official_name }}
                                            </inertia-link>
                                        </div>
                                    </td>

                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        {{ session.employee.user.phone }}
                                    </td>

                                    <td
                                        class="px-6 py-4 w-44 truncate whitespace-nowrap text-sm text-gray-500"
                                        :title="session.employee.location.name"
                                    >
                                        {{ session.employee.location.name }}
                                    </td>

                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        {{ session.employee.date_of_join }}
                                    </td>

                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                      <span
                                          v-if="session.employee.user.status === 'Active'"
                                          class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
                                      >
                                        Active
                                      </span>
                                        <span
                                            v-else
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800"
                                        >
                                        {{ session.employee.user.status }}
                                      </span>
                                    </td>
                                    <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                                        <inertia-link :href="route('auditor.employees.show',{
                                            'id': session.id
                                        })"
                                                      class="text-white bg-green-500 hover:bg-green-700 transition duration-500 px-3 py-1 rounded-md shadow-md ml-2 h-10"
                                                      title="Click to show details">
                                            Show
                                        </inertia-link>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <pagination class="m-2" :links="sessions.links"/>
                        </div>
                        <no-data-found
                            v-else
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
import throttle from "lodash/throttle";
import pickBy from "lodash/pickBy";
import Button from "@/Jetstream/Button";
import {SearchIcon, DotsVerticalIcon} from "@heroicons/vue/solid";
import JetDropdown from "@/Jetstream/Dropdown";
import JetDropdownLink from "@/Jetstream/DropdownLink";

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
        JetDropdown,
        JetDropdownLink,
        DotsVerticalIcon
    },
    props: {
        requests: Object,
        sessions: Object,
    },
    data() {
        return {
            queryForm: {
                field: this.requests.filter
                    ? Object.keys(this.requests.filter)[0]
                    : "employee.official_name",
                filter: this.requests.filter
                    ? Object.values(this.requests.filter)[0]
                    : "",
                sort: this.requests.sort,
            },
            bulkIds: [],
            confirmingBulkDeletion: false,
            confirmingDeletion: false,
            deleteEmployee: null,
            checkAll: false,
        };
    },
    watch: {
        queryForm: {
            handler: throttle(function () {
                let customQuery = {
                    ["filter[" + this.queryForm.field + "]"]: this.queryForm.filter,
                    sort: this.queryForm.sort,
                };
                let queryString = pickBy(customQuery);
                this.$inertia.get(
                    this.route(
                        "auditor.employees",
                        Object.keys(queryString).length
                            ? queryString
                            : {remember: "forget"}
                    ),
                    {},
                    {
                        preserveState: true,
                        preserveScroll: true,
                    }
                );
            }, 150),
            deep: true,
        },
    },
    methods: {
        toggleAll() {
            if (!this.checkAll) {
                this.bulkIds = [];
            } else {
                let ids = [];
                this.employees.data.forEach(function (employee) {
                    ids.push(employee.id);
                });
                this.bulkIds = ids;
            }
        },
        // Sort data by field
        sort(field) {
            this.queryForm.sort === field
                ? (this.queryForm.sort = "-" + field)
                : (this.queryForm.sort = field);
        },

        // Reset all filters
        reset() {
            this.$inertia.visit(this.route("auditor.employees.index"));
        },
    },
};
</script>
