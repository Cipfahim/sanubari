<template>
    <app-layout>
        <!-- Upload Start:: -->
        <div class="mt-4 px-4 sm:px-6 lg:px-8">
            <jet-form-section @submitted="submit"
                              class="md:grid md:grid-cols-1 md:gap-0 md:gap-y-6"
            >
                <template #title class="md:col-span-12">
                    Upload All Payslip
                </template>
                <template #form class="md:col-span-12">
                    <div class="col-span-6 sm:col-span-12">
                        <jet-label for="payslip" value="Upload Payslips *"/>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <file-pond
                                name="payslip"
                                ref="pond"
                                label-idle='Drag & Drop your files or <span class="filepond--label-action"> Browse </span>'
                                accepted-file-types="application/pdf"
                                :server="route('payslips.upload',paySlipSession.id)"
                                credits=""
                                @processfilestart="handleFileProcessStart"
                                @processfile="handleFilePondSuccessProcessed"
                            />
                        </div>
                        <JetInputError :message="form.errors.payslip" class="mt-2"/>
                    </div>
                </template>
                <template #actions>
                    <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                        Uploaded.
                    </jet-action-message>
                    <jet-button
                        :class="{'opacity-25':form.processing || loading}"
                        :disabled="form.processing || loading"
                        class="bg-cyan-500 hover:bg-cyan-600"
                    >
                        Upload
                    </jet-button>
                </template>
            </jet-form-section>
        </div>
        <!-- Upload End:: -->

        <div class="mt-4 px-4 sm:px-6 lg:px-8">
            <div v-if="failedUploads.length" class="bg-white p-4 rounded-md mb-4">
                <h2 class="text-xl text-red-500 font-bold mb-4">({{ failedUploads.length }}) Failed Uploads</h2>
                <div>
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div
                                class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
                            >
                                <div
                                    class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
                                >
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                scope="col"
                                                class="w-12 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                            >
                                                Sl.
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                            >
                                                File Name
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                            >
                                                Note
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                                <span>Actions</span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        <tr
                                            v-for="(failedUpload, index) in failedUploads"
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
                                                <div>{{ failedUpload.file_name }}</div>
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                            >
                                                <div>{{ failedUpload.note }}</div>
                                            </td>
                                            <td
                                                class="px-6 whitespace-nowrap text-right text-sm font-medium"
                                            >
                                                <a
                                                    download
                                                    :href="getFileUrl(failedUpload.file_path)"
                                                    class="text-white bg-green-500 hover:bg-green-700 transition duration-500 px-3 py-1 rounded-md shadow-md ml-2 h-10"
                                                >Download
                                                </a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white p-4 rounded-md">
                <h2 class="text-xl text-green-500 font-bold mb-4">Payslips</h2>
                <div>
                    <!--                    <div class="mb-6 flex flex-col sm:flex-row justify-between items-center gap-y-2">
                                            <div class="flex items-center w-full max-w-md sm:mr-4 order-2 sm:order-1">
                                                <div
                                                    class="h-10 flex items-center w-full bg-white shadow-sm border border-gray-200 overflow-hidden rounded-md relative"
                                                >
                                                    <SearchIcon class="h-7 w-7 text-gray-300 mx-2"/>
                                                    <input
                                                        autocomplete="off"
                                                        type="text"
                                                        name="search"
                                                        placeholder="Search…"
                                                        class="block w-full h-full pl-0 sm:pl-2 pr-3 py-2 border-transparent text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-0 focus:border-transparent sm:text-sm"
                                                    />
                                                </div>
                                                <button
                                                    type="button"
                                                    @click="reset"
                                                    class="h-10 py-2 px-4 rounded-md ml-3 font-bold text-sm shadow-sm bg-red-500 hover:bg-red-600 text-white hover:text-gray-100 focus:outline-none"
                                                >
                                                    Reset
                                                </button>
                                            </div>
                                        </div>-->
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div
                                class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
                            >
                                <div
                                    v-if="payslips.length"
                                    class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
                                >
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                scope="col"
                                                class="w-12 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                            >
                                                Sl.
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                            >
                                                Employee Name
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                            >
                                                File Name
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                            >
                                                Note
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                                <span>Actions</span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        <tr
                                            v-for="(payslip, index) in payslips"
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
                                                <div>{{ payslip.employee.official_name }}</div>
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                            >
                                                <div>{{ payslip.file_name }}</div>
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                            >
                                                <div>{{ payslip.note }}</div>
                                            </td>
                                            <td
                                                class="px-6 whitespace-nowrap text-right text-sm font-medium"
                                            >
                                                <a
                                                    download
                                                    :href="getFileUrl(payslip.file_path)"
                                                    class="text-white bg-green-500 hover:bg-green-700 transition duration-500 px-3 py-1 rounded-md shadow-md ml-2 h-10"
                                                >Download
                                                </a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <pagination class="m-2" :links="5"/>
                                </div>
                                <no-data-found
                                    v-else
                                    resource="payslips"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/App";
import JetFormSection from "@/Jetstream/FormSection";
import JetLabel from "@/Jetstream/Label";
import JetInputError from "@/Jetstream/InputError";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
import {SearchIcon} from "@heroicons/vue/solid"
import NoDataFound from "@/Components/NoDataFound";

// Import Vue FilePond
import vueFilePond from "vue-filepond";

// Import FilePond styles
import "filepond/dist/filepond.min.css";

// Import image preview plugin styles
import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";

// Import image preview and file type validation plugins
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";


// Create component
const FilePond = vueFilePond(
    FilePondPluginFileValidateType,
    FilePondPluginImagePreview
);


export default {
    props: {
        paySlipSession: Object,
        payslips: Object,
        failedUploads: Object,
    },
    components: {
        AppLayout,
        JetFormSection,
        JetLabel,
        JetInputError,
        JetActionMessage,
        JetButton,
        FilePond,
        SearchIcon,
        NoDataFound
    },
    data() {
        return {
            loading: false,
            form: this.$inertia.form(
                {
                    date_from: null,
                    date_to: null,
                    payslip: null,
                },
                {
                    resetOnSuccess: true,
                }
            ),
            showTab: 1,
        }
    },
    methods: {
        handleFileProcessStart() {
            this.loading = true
        },
        handleFilePondSuccessProcessed(error, file) {
            this.$refs.pond.removeFile(file)
            this.$inertia.reload({
                only: ['payslips', 'failedUploads']
            })
            this.loading = false
        },
        submit() {
            this.form.post(route('employees.payslips.store', this.employee.id), {
                preserveScroll: true,
            });
        },
        toggleTab(tab) {
            this.showTab = tab;
        }
    }
};
</script>
