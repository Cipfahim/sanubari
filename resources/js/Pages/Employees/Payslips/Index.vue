<template>
    <app-layout>
        <!-- Start::Stepper -->
        <div class="mt-4 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col min-w-0 flex-1 overflow-hidden bg-white rounded-md">
                <div class="flex-1 relative z-0 flex overflow-hidden">
                    <div class="flex-1 relative z-0 overflow-y-auto focus:outline-none xl:order-last">
                        <article>
                            <TopBar :employee="employee"/>

                            <!-- Tab-1 -->
                            <div class="my-6 block max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                                <dl class="gap-x-4 gap-y-8 sm:grid-cols-2">
                                    <div
                                        class="mb-6 flex flex-col sm:flex-row justify-between items-center gap-y-2 sm:h-10">
                                        <div
                                            class="flex items-center gap-1 sm:gap-2 w-full h-full max-w-xl sm:mr-4 order-2 sm:order-1">
                                            <div
                                                class="flex items-center w-full h-full bg-white shadow-sm rounded-md relative overflow-hidden border border-gray-200"
                                            >
                                                <input
                                                    v-model="queryForm.filter"
                                                    autocomplete="off"
                                                    type="text"
                                                    name="search"
                                                    placeholder="Search…"
                                                    class="block w-full h-full px-2 py-2 border-none text-gray-900 placeholder-gray-600 focus:outline-none focus:ring-0 focus:border-transparent sm:text-sm"
                                                />
                                                <div class="mx-2 sm:mx-3">
                                                    <SearchIcon
                                                        class="h-5 w-5 text-gray-400 hover:text-gray-500 cursor-pointer"/>
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
                                                :href="route('employees.payslips.create',employee.id)"
                                                class="py-2 px-4 border border-transparent font-bold shadow-sm text-sm rounded-md text-white bg-cyan-500 hover:bg-cyan-600 focus:outline-none"
                                            >
                                                Upload
                                            </inertia-link>
                                        </div>
                                    </div>

                                    <div class="flex flex-col">
                                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                            <div
                                                class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
                                            >
                                                <div
                                                    v-if="payslips.data.length"
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
                                                                @click="sort('description')"
                                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                                            >
                                                                <div class="flex gap-2 items-center">
                                                                    <sort-arrow :sort="queryForm.sort"
                                                                                field="description"/>
                                                                    Description
                                                                </div>
                                                            </th>

                                                            <th
                                                                scope="col"
                                                                @click="sort('date_from')"
                                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                                            >
                                                                <div class="flex gap-2 items-center">
                                                                    <sort-arrow :sort="queryForm.sort"
                                                                                field="date_from"/>
                                                                    Date From
                                                                </div>
                                                            </th>

                                                            <th
                                                                scope="col"
                                                                @click="sort('date_to')"
                                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                                            >
                                                                <div class="flex gap-2 items-center">
                                                                    <sort-arrow :sort="queryForm.sort" field="date_to"/>
                                                                    Date To
                                                                </div>
                                                            </th>

                                                            <th scope="col"
                                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                <span>Actions</span>
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="bg-white divide-y divide-gray-200">
                                                        <tr
                                                            v-for="(payslip, index) in payslips.data"
                                                            :key="index"
                                                        >
                                                            <td
                                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                                            >
                                                                {{ index + 1 }}
                                                            </td>

                                                            <td
                                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 max-w-sm truncate"
                                                                :title="payslip.description"
                                                            >
                                                                {{ payslip.description }}
                                                            </td>

                                                            <td
                                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                                            >
                                                                {{ payslip.date_from }}
                                                            </td>

                                                            <td
                                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                                            >
                                                                {{ payslip.date_to }}
                                                            </td>

                                                            <td
                                                                class="px-6 whitespace-nowrap text-left text-sm font-medium"
                                                            >
                                                                <a :href="getFileUrl(payslip.file_path)"
                                                                   class="text-white bg-green-500 hover:bg-green-700 transition duration-500 px-3 py-1 rounded-md shadow-md h-10"
                                                                   target="_blank">
                                                                    View
                                                                </a>

                                                                <inertia-link
                                                                    :href="route('employees.payslips.edit', {'id':employee.id,'payslip':payslip.id})"
                                                                    class="text-white bg-green-500 hover:bg-green-700 transition duration-500 px-3 py-1 rounded-md shadow-md ml-2 h-10"
                                                                >Edit
                                                                </inertia-link>

                                                                <a
                                                                    :href="getFileUrl(payslip.file_path)"
                                                                    class="text-white bg-green-500 hover:bg-green-700 transition duration-500 px-3 py-1 rounded-md shadow-md ml-2 h-10"
                                                                    download
                                                                >Download
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <pagination class="m-2" :links="payslips.links"/>
                                                </div>
                                                <no-data-found
                                                    v-else
                                                    resource="payslips"
                                                    action-text="Upload payslip"
                                                    :action-link="route('employees.payslips.create',employee.id)"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </dl>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
        <!-- End:: -->
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/App";
import {
    CalendarIcon,
    CashIcon,
    CheckCircleIcon,
    CheckIcon,
    ChevronRightIcon,
    OfficeBuildingIcon,
    PlusCircleIcon,
    SearchIcon
} from "@heroicons/vue/solid";
import JetFormSection from "@/Jetstream/FormSection";
import JetLabel from "@/Jetstream/Label";
import JetInputError from "@/Jetstream/InputError";
import JetInput from "@/Jetstream/Input";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import Input from "@/Components/Input";
import JetCheckbox from "@/Jetstream/Checkbox";
import {Switch} from "@headlessui/vue";
import throttle from "lodash/throttle";
import pickBy from "lodash/pickBy";
import NoDataFound from "@/Components/NoDataFound";
import Pagination from "@/Components/Pagination";
import SortArrow from "@/Components/SortArrow";
import TopBar from "./TopBar";


export default {
    props: {
        employee: Object,
        requests: Object,
        payslips: Object,
    },
    components: {
        TopBar,
        NoDataFound,
        SortArrow,
        Pagination,
        Input,
        AppLayout,
        OfficeBuildingIcon,
        CheckCircleIcon,
        CashIcon,
        ChevronRightIcon,
        CheckIcon,
        CalendarIcon,
        PlusCircleIcon,
        SearchIcon,
        JetFormSection,
        JetSecondaryButton,
        JetLabel,
        JetInput,
        JetInputError,
        JetActionMessage,
        JetButton,
        JetCheckbox,
        Switch
    },
    data() {
        return {
            queryForm: {
                field: this.requests.filter
                    ? Object.keys(this.requests.filter)[0]
                    : "description",
                filter: this.requests.filter
                    ? Object.values(this.requests.filter)[0]
                    : "",
                sort: this.requests.sort,
            },
        }
    },
    watch: {
        queryForm: {
            handler: throttle(function () {
                let customQuery = {
                    ["filter[" + this.queryForm.field + "]"]: this.queryForm.filter,
                    sort: this.queryForm.sort,
                    id: this.employee.id
                };
                let queryString = pickBy(customQuery);
                this.$inertia.get(
                    this.route(
                        "employees.payslips.index",
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
            this.$inertia.visit(this.route("employees.payslips.index", this.employee.id));
        },
    }
};
</script>
