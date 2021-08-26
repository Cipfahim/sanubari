<template>
    <app-layout>
        <!-- Start:: -->
        <div class="mt-4 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col min-w-0 flex-1 overflow-hidden bg-white rounded-md">
                <div class="flex-1 relative z-0 flex overflow-hidden">
                    <div class="flex-1 relative z-0 overflow-y-auto focus:outline-none xl:order-last">
                        <article>
                            <TopBar :employee="employee"/>
                            <!-- Tab-1 -->
                            <div class="my-6 block max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                                <dl class="gap-x-4 gap-y-8 sm:grid-cols-2">
                                    <jet-form-section @submitted="submit"
                                                      class="md:grid md:grid-cols-1 md:gap-0 md:gap-y-6"
                                    >
                                        <template #title class="md:col-span-12">
                                            Upload New Payslip
                                        </template>
                                        <template #form class="md:col-span-12">
                                            <!--  date_from-->
                                            <div class="col-span-6 sm:col-span-12 mb-2">
                                                <jet-label for="date_from" value="Date From *"/>
                                                <DatePicker v-model="form.date_from" :masks="datePickerConfig.masks"
                                                            :model-config="datePickerConfig.modelConfig">
                                                    <template #default="{ inputValue, inputEvents }">
                                                        <input
                                                            class="px-3 py-2 text-sm border rounded w-full focus:ring-cyan-500 focus:border-cyan-500 focus:outline-none shadow-sm border-gray-300"
                                                            :class="{ 'border-red-500': form.errors.date_from }"
                                                            :value="inputValue"
                                                            v-on="inputEvents"/>
                                                    </template>
                                                </DatePicker>
                                                <JetInputError :message="form.errors.date_from" class="mt-2"/>
                                            </div>

                                            <!--  date_to-->
                                            <div class="col-span-6 sm:col-span-12 mb-2">
                                                <jet-label for="date_to" value="Date To *"/>
                                                <DatePicker v-model="form.date_to" :masks="datePickerConfig.masks"
                                                            :model-config="datePickerConfig.modelConfig">
                                                    <template #default="{ inputValue, inputEvents }">
                                                        <input
                                                            class="px-3 py-2 text-sm border rounded w-full focus:ring-cyan-500 focus:border-cyan-500 focus:outline-none shadow-sm border-gray-300"
                                                            :class="{ 'border-red-500': form.errors.date_to }"
                                                            :value="inputValue"
                                                            v-on="inputEvents"/>
                                                    </template>
                                                </DatePicker>
                                                <JetInputError :message="form.errors.date_to" class="mt-2"/>
                                            </div>

                                            <div
                                                class="col-span-6 sm:col-span-12 sm:border-t sm:border-gray-200 sm:pt-5">
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
                                            >
                                                Upload
                                            </jet-button>
                                        </template>
                                    </jet-form-section>
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
import JetFormSection from "@/Jetstream/FormSection";
import JetLabel from "@/Jetstream/Label";
import JetInputError from "@/Jetstream/InputError";
import JetInput from "@/Jetstream/Input";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
import Input from "@/Components/Input";
import TopBar from "./TopBar";
import {DatePicker} from "v-calendar";

// Import Vue FilePond
import vueFilePond from "vue-filepond";

// Import FilePond styles
import "filepond/dist/filepond.min.css";

// Import FilePond plugins
// Please note that you need to install these plugins separately

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
        TopBar,
        Input,
        JetFormSection,
        JetLabel,
        JetInput,
        JetInputError,
        JetActionMessage,
        JetButton,
        FilePond,
        DatePicker
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
    }
};
</script>
