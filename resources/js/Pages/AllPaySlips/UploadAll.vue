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
                        <jet-label for="payslip" value="Payslip *"/>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <file-pond
                                name="file"
                                ref="pond"
                                :allowMultiple="false"
                                label-idle='Drag & Drop your files or <span class="filepond--label-action"> Browse </span>'
                                accepted-file-types="application/pdf"
                                server="/upload"
                                credits=""
                                @processfilestart="handleFileProcessStart"
                                @processfile="handleFilePondSuccessProcessed"
                                @removefile="handleRemoveFile"
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
            <div class="bg-white p-4 rounded-md">
                <div class="mb-5">
                    <div class="sm:hidden">
                        <label for="tabs" class="sr-only">Select a tab</label>
                        <select id="tabs" name="tabs"
                                class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option>All uploaded</option>

                            <option>Error</option>
                        </select>
                    </div>
                    <div class="hidden sm:block">
                        <div class="border-b border-gray-200">
                            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                                <!-- Current: "border-indigo-500 text-indigo-600", Default: "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-200" -->
                                <a href="#" @click="toggleTab(1)"
                                   :class="{'border-cyan-500 text-cyan-600' : showTab ==1 }"
                                   class="border-transparent text-gray-500 hover:text-cyan-700 hover:border-cyan-200 whitespace-nowrap flex py-4 px-1 border-b-2 font-medium text-sm">
                                    All Uploaded

                                    <!-- Current: "bg-indigo-100 text-indigo-600", Default: "bg-gray-100 text-gray-900" -->
                                    <span :class="{'bg-cyan-100 text-cyan-600' : showTab ==1 }" class="bg-gray-100 text-gray-900 hidden ml-3 py-0.5 px-2.5 rounded-full text-xs font-medium md:inline-block">52</span>
                                </a>

                                <a href="#" @click="toggleTab(2)"
                                   :class="{'border-cyan-500 text-cyan-600' : showTab ==2 }"
                                   class="border-transparent text-gray-500 hover:text-cyan-700 hover:border-cyan-200 whitespace-nowrap flex py-4 px-1 border-b-2 font-medium text-sm">
                                    Error
                                    <span :class="{'bg-cyan-100 text-cyan-600' : showTab ==2 }" class="bg-gray-100 text-gray-900 hidden ml-3 py-0.5 px-2.5 rounded-full text-xs font-medium md:inline-block">6</span>
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
                <div :class="{ block : showTab == 1, hidden : showTab !== 1 }">
                    <div class="mb-6 flex flex-col sm:flex-row justify-between items-center gap-y-2">
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

                        <div class="flex justify-between order-1 sm:order-2 ml-auto">
                            <inertia-link
                                :href="route('settings.cities.create')"
                                class="h-10 py-2 px-4 border border-transparent font-bold shadow-sm text-sm rounded-md text-white bg-red-400 hover:bg-red-500 focus:outline-none"
                            >
                                See un-uploaded file
                            </inertia-link>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div
                                class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
                            >
                                <div
                                    v-if="true"
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
                                                @click="sort('name')"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                            >
                                                <sort-arrow sort="queryForm.sort" field="name"/>
                                                Name
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                                <span>Actions</span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        <tr
                                            v-for="(city, index) in 5"
                                            :key="index"
                                            class="hover:bg-gray-50"
                                        >
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                            >
                                                {{ index + 1 }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 grid grid-cols gap-1"
                                            >
                                                <div>kjsdfj</div>
                                            </td>
                                            <td
                                                class="px-6 whitespace-nowrap text-right text-sm font-medium"
                                            >
                                                <inertia-link
                                                    href="route('settings.cities.edit', city.id)"
                                                    class="text-white bg-green-500 hover:bg-green-700 transition duration-500 px-3 py-1 rounded-md shadow-md ml-2 h-10"
                                                >Edit
                                                </inertia-link>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <pagination class="m-2" :links="5"/>
                                </div>
                                <no-data-found
                                    v-else
                                    resource="categories"
                                    action-text="Add City"
                                    :action-link="route('settings.cities.create')"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <div :class="{ block : showTab == 2, hidden : showTab !== 2 }">
                    <div class="mb-6 flex flex-col sm:flex-row justify-between items-center gap-y-2">
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

                        <div class="flex justify-between order-1 sm:order-2 ml-auto">
                            <inertia-link
                                :href="route('settings.cities.create')"
                                class="h-10 py-2 px-4 border border-transparent font-bold shadow-sm text-sm rounded-md text-white bg-red-400 hover:bg-red-500 focus:outline-none"
                            >
                                See un-uploaded file
                            </inertia-link>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div
                                class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
                            >
                                <div
                                    v-if="true"
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
                                                @click="sort('name')"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                            >
                                                <sort-arrow sort="queryForm.sort" field="name"/>
                                                Name
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                                <span>Actions</span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        <tr
                                            v-for="(city, index) in 5"
                                            :key="index"
                                            class="hover:bg-gray-50"
                                        >
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                            >
                                                {{ index + 1 }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 grid grid-cols gap-1"
                                            >
                                                <div>kjsdfj</div>
                                            </td>
                                            <td
                                                class="px-6 whitespace-nowrap text-right text-sm font-medium"
                                            >
                                                <inertia-link
                                                    href="route('settings.cities.edit', city.id)"
                                                    class="text-white bg-green-500 hover:bg-green-700 transition duration-500 px-3 py-1 rounded-md shadow-md ml-2 h-10"
                                                >Edit
                                                </inertia-link>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <pagination class="m-2" :links="5"/>
                                </div>
                                <no-data-found
                                    v-else
                                    resource="categories"
                                    action-text="Add City"
                                    :action-link="route('settings.cities.create')"
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
        employee: Object,
    },
    components: {
        AppLayout,
        JetFormSection,
        JetLabel,
        JetInputError,
        JetActionMessage,
        JetButton,
        FilePond,
        SearchIcon
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
            this.form.payslip = file.serverId
            this.loading = false
        },
        handleRemoveFile() {
            this.form.payslip = null;
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
