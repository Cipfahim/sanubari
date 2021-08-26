<template>
    <app-layout>
        <div class="mt-4 px-4 sm:px-6 lg:px-8">
            <breadcrumb
                :links="[
          {
            title: 'All Tokens',
            active: true,
          },
        ]"
            />
            <div class="mb-6 flex flex-col sm:flex-row justify-between items-center gap-y-2 sm:h-10">
                <div class="flex items-center gap-1 sm:gap-2 w-full h-full max-w-xl sm:mr-4 order-2 sm:order-1">
                    <div
                        class="flex items-center w-full h-full bg-white shadow-sm rounded-md relative overflow-hidden"
                    >
                        <select
                            class="h-full w-24 sm:w-40 truncate border-none focus:outline-none focus:border-none focus:ring-0 bg-gray-50 text-gray-800 text-sm">
                            <option value="official_name">Requester</option>
                            <option value="user.phone">Subject</option>
                            <option value="location.name">Assigned</option>
                            <option value="date_of_join">Status</option>
                        </select>
                        <input

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

                <div class="flex justify-between order-1 sm:order-2 ml-auto">
                    <inertia-link
                        href="route('employees.create')"
                        class="py-2 px-4 border border-transparent font-bold shadow-sm text-sm rounded-md text-white bg-cyan-500 hover:bg-cyan-600 focus:outline-none"
                    >
                        Add Token
                    </inertia-link>
                </div>
            </div>
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
                                        @click="sort('location')"
                                        class="px-6 py-3 w-44 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                    >
                                        <div class="flex gap-2 items-center">
                                            <sort-arrow :sort="true" field="location"/>
                                            Assigned
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
                                    v-for="(employee, index) in 5"
                                    :key="index"
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
                                                <inertia-link href="/"
                                                              class="w-full"
                                                              title="Click to show details">
                                                    Abdul Kader kjhfkdskfnjdsknfjdksfdskfsdkfdskfdskfdsjf{{ index }}
                                                </inertia-link>
                                            </div>
                                        </div>
                                    </td>

                                    <td
                                        class="pl-6 pr-2 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        <div class="max-w-xs truncate" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, provident!">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, provident!
                                        </div>
                                    </td>

                                    <td
                                        class="pl-6 pr-2 py-4 block w-44 truncate whitespace-nowrap text-sm text-gray-500"

                                    >
                                        Kayum kjdflk jksndfkjs l adjf {{ index }}
                                    </td>

                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        <span
                                          v-if="index === 1"
                                          class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
                                        >
                                            Open
                                        </span>
                                        <span
                                            v-else-if="index === 2"
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
                                        30 seconds ago
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
    data() {
        return {
            checkAll: false,
        };
    },

    methods: {
        sort(field) {
            this.queryForm.sort === field
                ? (this.queryForm.sort = "-" + field)
                : (this.queryForm.sort = field);
        },

        // Reset all filters
        reset() {
            this.$inertia.visit(this.route("employees.index"));
        },
    },
};
</script>
