<template>
    <app-layout>
        <div class="mt-4 px-4 sm:px-6 lg:px-8">
            <breadcrumb
                :links="[
                    {
                        title: 'Payslips',
                        active: true,
                    },
                ]"
            />
            <div class="mb-6 flex flex-col sm:flex-row justify-between items-center gap-y-2">
                <div class="flex items-center w-full max-w-md sm:mr-4 order-2 sm:order-1">
                    <div
                        class="h-10 flex items-center w-full bg-white shadow-sm border border-gray-200 overflow-hidden rounded-md relative"
                    >
                        <SearchIcon class="h-7 w-7 text-gray-300 mx-2"/>
                        <input autocomplete="off" type="text" name="search" placeholder="Search…"
                               class="block w-full h-full pl-0 sm:pl-2 pr-3 py-2 border-transparent text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-0 focus:border-transparent sm:text-sm"/>
                    </div>
                    <button type="button" @click="reset"
                            class="h-10 py-2 px-4 rounded-md ml-3 font-bold text-sm shadow-sm bg-red-500 hover:bg-red-600 text-white hover:text-gray-100 focus:outline-none">
                        Reset
                    </button>
                </div>

                <div class="flex justify-between order-1 sm:order-2 ml-auto">
                    <button @click="payslipModal = true"
                            class="h-10 py-2 px-4 border border-transparent font-bold shadow-sm text-sm rounded-md text-white bg-cyan-500 hover:bg-cyan-600 focus:outline-none">
                        Bulk Upload
                    </button>
                </div>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div v-if="payslips.data.length"
                             class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="w-12 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Sl.
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                        Description
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                        Form Date
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                        To Date
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                        <span>Actions</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="(payslip, index) in payslips.data" :key="index" class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ index + 1 }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ payslip.description }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ payslip.date_from }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ payslip.date_to }}
                                    </td>

                                    <td class="px-6 whitespace-nowrap text-right text-sm font-medium">
                                        <inertia-link :href="route('payslips.show',payslip.id)"
                                                      class="text-white bg-green-500 hover:bg-green-700 transition duration-500 px-3 py-1 rounded-md shadow-md ml-2 h-10">
                                            Show
                                        </inertia-link>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <pagination class="m-2" :links="5"/>
                        </div>
                        <no-data-found v-else resource="payslips" action-text="Add payslip session"/>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add Audit Modal -->
        <modal :show="payslipModal">
            <jet-form-section class="md:gap-y-0 min-h-[24rem]">
                <template #form class="md:col-span-12">
                    <div class="bg-gray-50 p-4 rounded-md h-full">
                        <div class="sm:my-3 space-y-6 sm:space-y-5">

                            <!-- Session Range field-->
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start">
                                <jet-label for="date_from" value="Date From *"/>

                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <div class="max-w-lg focus-within:z-10">
                                        <DatePicker v-model="form.date_from" :masks="datePickerConfig.masks"
                                                    :model-config="datePickerConfig.modelConfig">
                                            <template #default="{ inputValue, inputEvents }">
                                                <input
                                                    class="px-3 py-2 text-sm border rounded w-full focus:ring-cyan-500 focus:border-cyan-500 focus:outline-none shadow-sm border-gray-300"
                                                    :value="inputValue"
                                                    v-on="inputEvents"/>
                                            </template>
                                        </DatePicker>
                                    </div>
                                </div>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start">
                                <jet-label for="date_from" value="Date To *"/>

                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <div class="max-w-lg focus-within:z-10">
                                        <DatePicker v-model="form.date_to" :masks="datePickerConfig.masks"
                                                    :model-config="datePickerConfig.modelConfig">
                                            <template #default="{ inputValue, inputEvents }">
                                                <input
                                                    class="px-3 py-2 text-sm border rounded w-full focus:ring-cyan-500 focus:border-cyan-500 focus:outline-none shadow-sm border-gray-300"
                                                    :value="inputValue"
                                                    v-on="inputEvents"/>
                                            </template>
                                        </DatePicker>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="!mt-[200px]">
                                <div class="flex justify-end focus-within:z-10">
                                    <button @click.prevent="payslipModal = false"
                                            class="py-2 px-4 border border-transparent rounded-md ml-3 font-bold text-sm shadow-sm bg-red-500 hover:bg-red-600 text-white hover:text-gray-100 focus:outline-none">
                                        Cancel
                                    </button>
                                    <button @click.prevent="create"
                                            class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                                        Save & Continue
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End::Stepper Contents -->
                </template>
            </jet-form-section>
        </modal>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/App"
import Breadcrumb from "@/Components/Breadcrumb"
import NoDataFound from "@/Components/NoDataFound"
import Pagination from "@/Components/Pagination"
import SortArrow from "@/Components/SortArrow"
import JetCheckbox from "@/Jetstream/Checkbox"
import JetConfirmationModal from "@/Jetstream/ConfirmationModal.vue"
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue"
import JetDangerButton from "@/Jetstream/DangerButton.vue"
import Modal from "@/Jetstream/Modal.vue"
import throttle from "lodash/throttle"
import pickBy from "lodash/pickBy"
import Button from "@/Jetstream/Button"
import {SearchIcon} from "@heroicons/vue/solid"

import JetFormSection from "@/Jetstream/FormSection"
import JetLabel from "@/Jetstream/Label"
import JetInputError from "@/Jetstream/InputError"
import JetInput from "@/Jetstream/Input"
import {DatePicker} from 'v-calendar';

export default {
    components: {
        Button,
        AppLayout,
        JetCheckbox,
        Breadcrumb,
        NoDataFound,
        Pagination,
        SortArrow,
        JetConfirmationModal,
        JetSecondaryButton,
        JetDangerButton,
        SearchIcon,
        Modal,
        JetFormSection,
        JetLabel,
        JetInputError,
        JetInput,
        DatePicker,
    },
    props: {
        requests: Object,
        payslips: Object,
        auditors: Object,
        locations: Object,
    },
    data() {
        return {
            queryForm: {
                field: this.requests.filter ? Object.keys(this.requests.filter)[0] : "description",
                filter: this.requests.filter ? Object.values(this.requests.filter)[0] : "",
                sort: this.requests.sort,
            },

            payslipModal: false,
            datePickerConfig: {
                masks: {
                    input: 'DD MMM YYYY',
                },
                modelConfig: {
                    type: 'string',
                    mask: 'YYYY-MM-DD', // Uses 'iso' if missing
                },
            },
            form: this.$inertia.form(
                {
                    date_from: null,
                    date_to: null,
                },
                {
                    resetOnSuccess: true,
                }
            ),
        }
    },
    watch: {
        queryForm: {
            handler: throttle(function () {
                let customQuery = {
                    ["filter[" + this.queryForm.field + "]"]: this.queryForm.filter,
                    sort: this.queryForm.sort,
                }
                let queryString = pickBy(customQuery)
                this.$inertia.get(
                    this.route("payslips.index", Object.keys(queryString).length ? queryString : {remember: "forget"}),
                    {},
                    {
                        preserveState: true,
                        preserveScroll: true,
                    }
                )
            }, 150),
            deep: true,
        },
    },
    methods: {
        create() {
            if (this.form.date_from && this.form.date_to) {
                this.form
                    .post(this.route('payslips.store'));
            } else {
                alert('Please select date.')
            }
        },

        // Sort data by field
        sort(field) {
            this.queryForm.sort === field ? (this.queryForm.sort = "-" + field) : (this.queryForm.sort = field)
        },

        // Reset all filters
        reset() {
            this.$inertia.visit(this.route("payslips.index"))
        },
    },
}
</script>
