<template>
    <app-layout>
        <!-- Start::Stepper -->
        <div class="mt-4 px-4 sm:px-6 lg:px-8 relative">
            <top-bar :employee="employee.id" :current="route('employees.edit.contact-details.index', employee.id)"/>
            <div class="bg-gray-50 px-4 pt-4 rounded-md mt-5 relative">

                <!-- Tab for Desktop & mobile -->
                <div class="block sm:block overflow-x-scroll scrollbar-hide text-center relative">
                    <div class="border-b border-gray-200 sticky top-0">
                        <nav class="-mb-px w-full flex justify-center space-x-2 sm:space-x-8" aria-label="Tabs">
                            <!-- Current: "border-cyan-500 text-cyan-600", Default: "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-200" -->
                            <button
                                type="button"
                                @click="toggleTabs(1)"
                                :class="{
                  'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-200':
                    openTab !== 1,
                  'border-cyan-500 text-cyan-600': openTab === 1,
                }"
                                class="whitespace-nowrap flex-1 sm:flex-none flex py-4 px-1 border-b-2 font-semibold text-xs sm:text-sm focus:outline-none"
                            >
                                Contact Number

                                <!-- Current: "bg-cyan-100 text-cyan-600", Default: "bg-gray-100 text-gray-900" -->
                                <span
                                    class="hidden ml-3 py-0.5 px-2.5 rounded-full text-xs font-medium md:inline-block"
                                    :class="{
                    'bg-gray-100 text-gray-900 ': openTab !== 1,
                    'bg-cyan-100 text-cyan-600 ': openTab === 1,
                  }"
                                >{{ employee.contact_numbers.length }}</span>
                            </button>

                            <button
                                type="button"
                                @click="toggleTabs(2)"
                                :class="{
                  'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-200':
                    openTab !== 2,
                  'border-cyan-500 text-cyan-600': openTab === 2,
                }"
                                class="whitespace-nowrap flex-1 sm:flex-none flex py-4 px-1 border-b-2 font-semibold text-xs sm:text-sm focus:outline-none"
                            >
                                Personal Email

                                <span
                                    class="hidden ml-3 py-0.5 px-2.5 rounded-full text-xs font-medium md:inline-block"
                                    :class="{
                    'bg-gray-100 text-gray-900 ': openTab !== 2,
                    'bg-cyan-100 text-cyan-600 ': openTab === 2,
                  }"
                                >{{ employee.contact_emails.length }}</span>
                            </button>

                            <button
                                type="button"
                                @click="toggleTabs(3)"
                                :class="{
                  'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-200':
                    openTab !== 3,
                  'border-cyan-500 text-cyan-600': openTab === 3,
                }"
                                class="whitespace-nowrap flex-1 sm:flex-none flex py-4 px-1 border-b-2 font-semibold text-xs sm:text-sm focus:outline-none"
                                aria-current="page"
                            >
                                Contact Address

                                <span
                                    class="hidden ml-3 py-0.5 px-2.5 rounded-full text-xs font-medium md:inline-block"
                                    :class="{
                    'bg-gray-100 text-gray-900 ': openTab !== 3,
                    'bg-cyan-100 text-cyan-600 ': openTab === 3,
                  }"
                                >{{ employee.contact_address.length }}</span>
                            </button>
                        </nav>
                    </div>
                </div>
                <!-- Personal Phone -->
                <div
                    class="mt-4 pb-10 h-full"
                    :class="{ hidden: openTab !== 1, block: openTab === 1 }"
                >
                    <contact-number :employee="employee" :number-types="numberTypes"/>
                </div>
                <!-- Personal Email -->
                <div
                    class="mt-4 pb-10 h-full"
                    :class="{ hidden: openTab !== 2, block: openTab === 2 }"
                >
                    <personal-email :employee="employee"/>

                </div>
                <!-- Address -->
                <div
                    class="pb-10 h-full"
                    :class="{ hidden: openTab !== 3, block: openTab === 3 }"
                >
                    <contact-address :employee="employee" :address-types="addressTypes"/>
                </div>
            </div>
        </div>
        <!-- End::Stepper -->
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/App";
import TopBar from "@/Pages/Employees/Edit/TopBar";

import {
    CalendarIcon,
    CashIcon,
    CheckCircleIcon,
    CheckIcon,
    ChevronRightIcon,
    OfficeBuildingIcon,
    PlusCircleIcon,
    XIcon,
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
import {VueTelInput} from "vue3-tel-input";
import "vue3-tel-input/dist/vue3-tel-input.css";
import ContactNumber from "./ContactNumber";
import PersonalEmail from "./PersonalEmail";
import ContactAddress from "./ContactAddress";

export default {
    props: {
        employee: Object,
        addressTypes: Array,
        numberTypes: Array
    },
    components: {
        ContactNumber,
        PersonalEmail,
        ContactAddress,
        Input,
        TopBar,
        AppLayout,
        OfficeBuildingIcon,
        CheckCircleIcon,
        CashIcon,
        ChevronRightIcon,
        CheckIcon,
        CalendarIcon,
        PlusCircleIcon,
        XIcon,
        JetFormSection,
        JetSecondaryButton,
        JetLabel,
        JetInput,
        JetInputError,
        JetActionMessage,
        JetButton,
        JetCheckbox,
        VueTelInput,
    },
    data() {
        return {
            openTab: 1,
        };
    },
    methods: {
        toggleTabs(tabNumber) {
            this.openTab = tabNumber;
        },
    },
};
</script>
