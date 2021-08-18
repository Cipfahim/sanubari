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
                                    <jet-form-section @submitted="submit"
                                                      class="md:grid md:grid-cols-1 md:gap-0 md:gap-y-6"
                                    >
                                        <template #title class="md:col-span-12">
                                           Upload New Document
                                        </template>
                                        <template #form class="md:col-span-12">
                                            <!--                        description-->
                                            <div class="col-span-6 sm:col-span-12">
                                                <jet-label for="description" value="Description *"/>
                                                <jet-input
                                                    type="text"
                                                    id="description"
                                                    v-model="form.description"
                                                    class="mt-1 block w-full focus:ring-cyan-100"
                                                    :class="{ 'border-red-500': form.errors.description }"
                                                    autocomplete="description"
                                                    required
                                                    autofocus
                                                />
                                                <JetInputError :message="form.errors.description" class="mt-2"/>
                                            </div>

                                            <div class="col-span-6 sm:col-span-12">
                                                <jet-label for="year" value="Year *"/>
                                                <jet-input
                                                    type="text"
                                                    id="year"
                                                    v-model="form.year"
                                                    class="mt-1 block w-full focus:ring-cyan-100"
                                                    :class="{ 'border-red-500': form.errors.year }"
                                                    autocomplete="year"
                                                    required
                                                    autofocus
                                                />
                                                <JetInputError :message="form.errors.year" class="mt-2"/>
                                            </div>

                                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                <jet-label for="document" value="Document *"/>
                                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                    <div class="max-w-lg flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                                        <div class="space-y-1 text-center">
                                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                            <div class="flex text-sm text-gray-600">
                                                                <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                                    <span>Upload a file</span>
                                                                    <input id="file-upload" name="file-upload" type="file" class="sr-only" />
                                                                </label>
                                                                <p class="pl-1">or drag and drop</p>
                                                            </div>
                                                            <p class="text-xs text-gray-500">
                                                                PNG, JPG, GIF up to 10MB
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <JetInputError :message="form.errors.year" class="mt-2"/>
                                            </div>
                                        </template>
                                        <template #actions>
                                            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                                                Created.
                                            </jet-action-message>
                                            <jet-button
                                                :class="{'opacity-25':form.processing}"
                                                :disabled="form.processing"
                                            >
                                                Create
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
import NoDataFound from "@/Components/NoDataFound";
import Pagination from "@/Components/Pagination";
import SortArrow from "@/Components/SortArrow";
import TopBar from "./TopBar";


export default {
    props: {
        employee: Object,
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
            form: this.$inertia.form(
                {
                    description: null,
                    year: null,
                    document: null,
                },
                {
                    resetOnSuccess: true,
                }
            ),
            logoPreview: null,
            documentPreview: false
        }
    },
    methods: {
        submit() {
            this.form.post(route('locations.store'), {
                preserveScroll: true,
            });
        },
    }
};
</script>
