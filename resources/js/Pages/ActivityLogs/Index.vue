<template>
    <app-layout>
        <div class="mt-4 px-4 sm:px-6 lg:px-8">
            <breadcrumb
                :links="[
                  {
                    title: 'Activity Logs',
                    active: true,
                  },
                ]"
            />
            <div class="mb-6 flex justify-between items-center">
                <div class="flex items-center w-full max-w-md mr-4">
                    <div
                        class="flex items-center w-full bg-white shadow-sm rounded relative"
                    >
                        <SearchIcon class="h-7 w-7 text-gray-300 mx-2"/>
                        <input
                            v-model="queryForm.filter"
                            autocomplete="off"
                            type="text"
                            name="search"
                            placeholder="Search…"
                            class="relative w-full px-4 py-2 rounded-md border-0 border-transparent focus:outline-none focus:ring-2 focus:ring-transparent"
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
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div
                        class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
                    >
                        <div
                            v-if="activityLogs.data.length"
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
                                        @click="sort('subject_type')"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                    >
                                        <sort-arrow :sort="queryForm.sort" field="subject_type"/>
                                        Subject Type
                                    </th>

                                    <th
                                        scope="col"
                                        @click="sort('description')"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                    >
                                        <sort-arrow :sort="queryForm.sort" field="description"/>
                                        Description
                                    </th>

                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                    >
                                        <!--                                        <sort-arrow :sort="queryForm.sort" field="description"/>-->
                                        Causer
                                    </th>

                                    <th
                                        scope="col"
                                        @click="sort('created_at')"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                    >
                                        <sort-arrow :sort="queryForm.sort" field="created_at"/>
                                        Created At
                                    </th>

                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                <tr
                                    v-for="(activityLog, index) in activityLogs.data"
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
                                        {{ activityLog.subject_type }}
                                    </td>

                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        {{ activityLog.description }}
                                    </td>

                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        Name: {{ activityLog.causer.name }} <br>
                                        Email: {{ activityLog.causer.email }} <br>
                                    </td>

                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        {{ activityLog.created_at }}
                                    </td>

                                    <td
                                        class="px-6 whitespace-nowrap text-right text-sm font-medium"
                                    >
                                        <inertia-link
                                            :href="route('activityLogs.show', activityLog.id)"
                                            class="text-white bg-green-500 hover:bg-green-700 transition duration-500 px-3 py-1 rounded-md shadow-md ml-2 h-10"
                                        >Show
                                        </inertia-link>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <pagination class="m-2" :links="activityLogs.links"/>
                        </div>
                        <no-data-found
                            v-else
                            resource="activity logs"
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
import JetCheckbox from "@/Jetstream/Checkbox";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import throttle from "lodash/throttle";
import pickBy from "lodash/pickBy";
import Button from "@/Jetstream/Button";
import {SearchIcon} from "@heroicons/vue/solid";

export default {
    components: {
        Button,
        AppLayout,
        JetCheckbox,
        Breadcrumb,
        NoDataFound,
        Pagination,
        SortArrow,
        JetSecondaryButton,
        JetDangerButton,
        SearchIcon,
    },
    props: {
        requests: Object,
        activityLogs: Object,
    },
    data() {
        return {
            queryForm: {
                field: this.requests.filter
                    ? Object.keys(this.requests.filter)[0]
                    : "subject_type",
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
                        "activityLogs.index",
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
            this.$inertia.visit(this.route("activityLogs.index"));
        },
    },
};
</script>
