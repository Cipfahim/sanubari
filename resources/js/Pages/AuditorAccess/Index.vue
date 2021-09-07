<template>
    <app-layout>
        <div class="mt-4 px-4 sm:px-6 lg:px-8">
            <breadcrumb
                :links="[
                    {
                        title: 'Sessions',
                        active: true,
                    },
                ]"
            />
            <div class="mb-6 flex justify-between items-center">
                <div class="flex items-center w-full max-w-md mr-4">
                    <div class="flex items-center w-full bg-white shadow-sm rounded relative">
                        <SearchIcon class="h-7 w-7 text-gray-300 mx-2" />
                        <input v-model="queryForm.filter" autocomplete="off" type="text" name="search" placeholder="Search…" class="relative w-full px-4 py-2 rounded-md border-0 border-transparent focus:outline-none focus:ring-2 focus:ring-transparent" />
                    </div>
                    <button type="button" @click="reset" class="py-2 px-4 border border-transparent rounded-md ml-3 font-bold text-sm shadow-sm bg-red-500 hover:bg-red-600 text-white hover:text-gray-100 focus:outline-none">Reset</button>
                </div>

                <div class="flex justify-between">
                    <!-- <inertia-link :href="route('auditor-access.create')" class="py-2 px-4 border border-transparent font-bold shadow-sm text-sm rounded-md text-white bg-gray-700 hover:bg-gray-800 focus:outline-none"> Add </inertia-link> -->
                    <button @click="auditModal = true" class="py-2 px-4 border border-transparent font-bold shadow-sm text-sm rounded-md text-white bg-cyan-500 hover:bg-cyan-600 focus:outline-none">Add</button>
                </div>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div v-if="sessions.data.length" class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sl.</th>
                                    <th scope="col" @click="sort('name')" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                        <sort-arrow :sort="queryForm.sort" field="name" />
                                        Auditor
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">Start Date</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">End Date</th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">Status</th>

                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="(session, index) in sessions.data" :key="index" class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ index + 1 }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ session.user.name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ session.start_date }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ session.end_date }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ session.status }}
                                    </td>

                                    <td class="px-6 whitespace-nowrap text-right text-sm font-medium">
                                        <inertia-link :href="route('auditor-access.edit', session.id)" class="text-white bg-green-500 hover:bg-green-700 transition duration-500 px-3 py-1 rounded-md shadow-md ml-2 h-10">Edit </inertia-link>

                                        <!-- <button
                                      type="button"
                                      @click="confirmDeletion(category)"
                                      class="text-white bg-red-500 hover:bg-red-700 transition duration-500 px-2 py-1 rounded-md shadow-md ml-2"
                                    >
                                      Delete
                                    </button> -->
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <pagination class="m-2" :links="sessions.links" />
                        </div>
                        <no-data-found v-else resource="sessions"/>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add Audit Modal -->
        <modal :show="auditModal">
            <jet-form-section class="md:gap-y-0 min-h-[35rem]">
                <template #form class="md:col-span-12">
                    <div class="bg-gray-50 p-4 rounded-md h-full">
                        <div class="sm:my-3 space-y-6 sm:space-y-5">
                            <!-- Auditor Name field-->
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start">
                                <jet-label value="Auditor Name *" />
                                <select v-model="auditor" class="col-span-2 focus:ring-cyan-500 focus:border-cyan-500 w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <option v-for="auditor in auditors" :value="auditor.id">{{ auditor.name }}</option>
                                </select>
                            </div>

                            <!-- Session Range field-->
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start">
                                <jet-label for="date_of_join" value="Session Range *" />

                                <div class="mt-1 sm:mt-0 sm:col-span-2 flex justify-between items-center">
                                    <div class="max-w-lg focus-within:z-10">
                                        <!--                                        <jet-input id="date_of_join" v-model="startDate" type="date" />-->
                                        <DatePicker v-model="startDate" :masks="datePickerConfig.masks"
                                                    :model-config="datePickerConfig.modelConfig">
                                            <template #default="{ inputValue, inputEvents }">
                                                <input
                                                    class="px-3 py-2 text-sm border rounded w-full focus:ring-cyan-500 focus:border-cyan-500 focus:outline-none shadow-sm border-gray-300"
                                                    :value="inputValue"
                                                    v-on="inputEvents"/>
                                            </template>
                                        </DatePicker>
                                    </div>
                                    <div>to</div>
                                    <div class="max-w-lg focus-within:z-10">
                                        <!--                                        <jet-input id="date_of_join" v-model="" type="date" />-->
                                        <DatePicker v-model="endDate" :masks="datePickerConfig.masks"
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

                                <!-- <jet-input-error :message="form.errors.date_of_join" class="mt-2" /> -->
                            </div>

                            <!-- Location field-->
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start">
                                <jet-label for="location" value="Start with *" />

                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <div class="max-w-lg flex justify-space-between">
                                        <select v-model="locationId" class="focus:ring-cyan-500 focus:border-cyan-500 w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            <option v-for="location in locations" :value="location.id">{{ location.name }}</option>
                                        </select>

                                        <!-- <jet-input-error :message="form.errors.location" class="mt-2" /> -->
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="mt-5">
                                <div class="flex justify-end focus-within:z-10">
                                    <inertia-link href="/auditor-access" class="py-2 px-4 border border-transparent rounded-md ml-3 font-bold text-sm shadow-sm bg-red-500 hover:bg-red-600 text-white hover:text-gray-100 focus:outline-none"> Cancel </inertia-link>
                                    <button @click="create()" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">Save & Continue</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End::Stepper Contents -->
                </template>
            </jet-form-section>
        </modal>

        <!-- Delete confirmation modal -->
        <jet-confirmation-modal :show="confirmingDeletion" @close="confirmingDeletion = false">
            <template #title> Delete Category</template>

            <template #content> Are you sure you want to delete this category? Once category is deleted, all of its resources and data will be permanently deleted. </template>

            <template #footer>
                <jet-secondary-button @click.native="confirmingDeletion = false"> Nevermind </jet-secondary-button>

                <jet-danger-button class="ml-2" @click="destroy"> Delete </jet-danger-button>
            </template>
        </jet-confirmation-modal>
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
        DatePicker
    },
    props: {
        requests: Object,
        sessions: Object,
        auditors: Object,
        locations: Object,
    },
    data() {
        return {
            queryForm: {
                field: this.requests.filter ? Object.keys(this.requests.filter)[0] : "user.name",
                filter: this.requests.filter ? Object.values(this.requests.filter)[0] : "",
                sort: this.requests.sort,
            },
            bulkIds: [],
            confirmingBulkDeletion: false,
            confirmingDeletion: false,
            deleteCategory: null,
            checkAll: false,
            auditModal: false,
            auditor: 0,
            locationId: 0,
            startDate: null,
            endDate: null,
            datePickerConfig: {
                masks: {
                    input: 'DD MMM YYYY',
                },
                modelConfig: {
                    type: 'string',
                    mask: 'YYYY-MM-DD', // Uses 'iso' if missing
                },
            },
        }
    },
    mounted() {
        console.log(this.auditors)
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
                    this.route("auditor-access.index", Object.keys(queryString).length ? queryString : {remember: "forget"}),
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
        toggleAll() {
            if (!this.checkAll) {
                this.bulkIds = []
            } else {
                let ids = []
                this.honorariumCategories.data.forEach(function (category) {
                    ids.push(category.id)
                })
                this.bulkIds = ids
            }
        },
        create() {
            this.$inertia.get(this.route("auditor-access.create"), {
                auditor: this.auditor,
                location: this.locationId,
                startDate: this.startDate,
                endDate: this.endDate,
                // _token: this.$page.props.csrf_token,
            })
        },
        // Sort data by field
        sort(field) {
            this.queryForm.sort === field ? (this.queryForm.sort = "-" + field) : (this.queryForm.sort = field)
        },

        // Reset all filters
        reset() {
            this.$inertia.visit(this.route("auditor-access.index"))
        },

        // Confirm deletion.
        confirmDeletion(category) {
            this.deleteCategory = category
            this.confirmingDeletion = true
        },

        // Send delete request.
        destroy() {
            this.$inertia.delete(this.route("auditor-access.destroy", this.deleteCategory), {
                preserveState: true,
                preserveScroll: true,
                onSuccess: () => {
                    this.deleteCategory = null
                    this.confirmingDeletion = false
                },
            })
        },

        // Confirm bulk deletion.
        confirmBulkDeletion() {
            this.confirmingBulkDeletion = true
        },
    },
}
</script>
