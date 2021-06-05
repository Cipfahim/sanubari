<template>
    <app-layout>
        <div class="mt-4 px-4 sm:px-6 lg:px-8">
            <breadcrumb
                :links="[
                  {
                    title: 'Users',
                    active: true,
                  },
                ]"
            />
            <div class="mb-6 flex justify-between items-center">
                <div class="flex items-center w-full max-w-md mr-4">
                    <div
                        class="flex items-center w-full bg-white shadow-sm rounded relative"
                    >
                        <SearchIcon class="h-5 w-5 text-gray-300 mx-2"/>
                        <input
                            v-model="queryForm.filter"
                            autocomplete="off"
                            type="text"
                            name="search"
                            placeholder="Search…"
                            class="block w-full h-full pl-8 pr-3 py-2 border-transparent text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-0 focus:border-transparent sm:text-sm"
                        />
                    </div>
                    <button
                        type="button"
                        @click="reset"
                        class="py-2 px-4 border border-transparent rounded-md ml-3 font-bold text-sm shadow-sm bg-red-500 hover:bg-red-600 text-white hover:text-gray-100 focus:outline-none"
                    >
                        Reset
                    </button>
                </div>

                <div class="flex justify-between">
                    <inertia-link
                        :href="route('users.create')"
                        class="py-2 px-4 border border-transparent font-bold shadow-sm text-sm rounded-md text-white bg-gray-700 hover:bg-gray-800 focus:outline-none"
                    >
                        Add User
                    </inertia-link>
                </div>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div
                        class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
                    >
                        <div
                            v-if="users.data.length"
                            class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
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
                                        @click="sort('name')"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                    >
                                        <sort-arrow :sort="queryForm.sort" field="name"/>
                                        Name
                                    </th>

                                    <th
                                        scope="col"
                                        @click="sort('phone')"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                    >
                                        <sort-arrow :sort="queryForm.sort" field="phone"/>
                                        Phone
                                    </th>

                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                    >
                                        <!--                                        <sort-arrow :sort="queryForm.sort" field="role"/>-->
                                        Role
                                    </th>

                                    <th
                                        scope="col"
                                        @click="sort('created_at')"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                    >
                                        <sort-arrow :sort="queryForm.sort" field="created_at"/>
                                        Created At
                                    </th>

                                    <th
                                        scope="col"
                                        @click="sort('status')"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                    >
                                        <sort-arrow :sort="queryForm.sort" field="status"/>
                                        Status
                                    </th>

                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                <tr
                                    v-for="(user, index) in users.data"
                                    :key="index"
                                >
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        {{ index + 1 }}
                                    </td>

                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        {{ user.name }}
                                    </td>

                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        {{ user.phone }}
                                    </td>


                                    <td
                                        v-if="user.role"
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        {{ user.role.name }}
                                    </td>


                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        {{ user.created_at }}
                                    </td>

                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                      <span
                                          v-if="user.status === 'Active'"
                                          class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
                                      >
                                        Active
                                      </span>
                                        <span
                                            v-else
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800"
                                        >
                                        Inactive
                                      </span>
                                    </td>

                                    <td
                                        class="px-6 whitespace-nowrap text-right text-sm font-medium"
                                    >
                                        <inertia-link
                                            :href="route('users.show', user.id)"
                                            class="text-white bg-cyan-500 hover:bg-cyan-700 transition duration-500 px-3 py-1 rounded-md shadow-md ml-2 h-10"
                                        >Show
                                        </inertia-link>

                                        <inertia-link
                                            :href="route('users.edit', user.id)"
                                            class="text-white bg-green-500 hover:bg-green-700 transition duration-500 px-3 py-1 rounded-md shadow-md ml-2 h-10"
                                        >Edit
                                        </inertia-link>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <pagination class="m-2" :links="users.links"/>
                        </div>
                        <no-data-found
                            v-else
                            resource="users"
                            action-text="Add Employee"
                            :action-link="route('users.create')"
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
import throttle from "lodash/throttle";
import pickBy from "lodash/pickBy";
import Button from "@/Jetstream/Button";
import {SearchIcon} from "@heroicons/vue/solid";

export default {
    components: {
        Button,
        AppLayout,
        Breadcrumb,
        NoDataFound,
        Pagination,
        SortArrow,
        JetSecondaryButton,
        SearchIcon,
    },
    props: {
        requests: Object,
        users: Object,
    },
    data() {
        return {
            queryForm: {
                field: this.requests.filter
                    ? Object.keys(this.requests.filter)[0]
                    : "name",
                filter: this.requests.filter
                    ? Object.values(this.requests.filter)[0]
                    : "",
                sort: this.requests.sort,
            },
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
                        "users.index",
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
        // Sort data by field
        sort(field) {
            this.queryForm.sort === field
                ? (this.queryForm.sort = "-" + field)
                : (this.queryForm.sort = field);
        },

        // Reset all filters
        reset() {
            this.$inertia.visit(this.route("users.index"));
        },
    },
};
</script>
