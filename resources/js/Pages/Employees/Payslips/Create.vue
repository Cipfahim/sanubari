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
                                            <div class="col-span-6 sm:col-span-12 mb-2 -mx-4">
                                                <jet-label for="payslip_sessions" value="Payslip Sessions *"/>
                                                <Multiselect
                                                    searchable
                                                    v-model="form.payslip_session"
                                                    :options="payslipSessions"
                                                    valueProp="id"
                                                    trackBy="label"
                                                    label="label"
                                                    placeholder="Choose a session"
                                                    class="mt-1 block w-full !rounded-md focus:ring-cyan-500 focus:border-cyan-500"
                                                    :class="{ 'border-red-500' : form.errors.payslip_session }"
                                                />
                                                <JetInputError :message="form.errors.payslip_session" class="mt-2"/>
                                            </div>

                                            <div
                                                class="col-span-6 sm:col-span-12 sm:border-t sm:border-gray-200 sm:pt-5 -mx-4">
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
                                                class="bg-cyan-500 hover:bg-cyan-600 focus:outline-none"
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
import Multiselect from '@vueform/multiselect'
import '@vueform/multiselect/themes/default.css'


// Create component
const FilePond = vueFilePond(
    FilePondPluginFileValidateType,
    FilePondPluginImagePreview
);


export default {
    props: {
        employee: Object,
        payslipSessions: Array,
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
        DatePicker,
        Multiselect,
    },
    data() {
        return {
            loading: false,
            form: this.$inertia.form(
                {
                    payslip_session: null,
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
