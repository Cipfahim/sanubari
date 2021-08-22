<template>
    <app-layout>
        <!-- Start::Stepper -->
        <div class="mt-4 px-4 sm:px-6 lg:px-8">
            <top-bar :employee="employee.id" :current="route('employees.edit.bank-details.index', employee.id)"/>

            <jet-form-section
                @submitted="submit"
                class="md:grid md:grid-cols-1 md:gap-0 md:gap-y-6"
            >
                <template #form class=" md:col-span-12">
                    <!-- Strat::Stepper Contents -->
                    <div class="bg-gray-50 p-4 rounded-md">
                        <div class="space-y-8 divide-y divide-gray-200">
                            <!-- Login details-->
                            <div class="space-y-6 sm:pt-10 sm:space-y-5 mt-5 sm:mt-0">
                                <div class="sm:border-b sm:border-gray-200 pb-2">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                        Bank Details
                                    </h3>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                        This section contains sensitive information.
                                    </p>
                                </div>

                                <div class="mt-4 sm:mt-3 space-y-6 sm:space-y-5">

                                    <!-- Location field-->
                                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2">
                                        <jet-label for="location" value="Bank Name *"/>

                                        <div class="col-span-2 max-w-lg">
                                            <select
                                                v-model="form.bank"
                                                id="bank"
                                                name="bank"
                                                autocomplete="bank"
                                                class="focus:ring-cyan-500 focus:border-cyan-500 w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                :class="{ 'border-red-500': form.errors.bank }"
                                            >
                                                <option disabled selected>Select one</option>
                                                <option v-for="(bank) in banks"
                                                        :value="bank.id">{{ bank.name }}
                                                </option>
                                            </select>
                                            <jet-input-error
                                                :message="form.errors.bank"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>

                                    <!-- account_number-->
                                    <div
                                        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                                    >
                                        <jet-label for="account_number" value="Account Number *"/>
                                        <div class="col-span-2 max-w-lg">
                                            <jet-input
                                                id="account_number"
                                                type="tel"
                                                v-mask="'#-# # # # # # # # # # #'"
                                                v-model="form.account_number"
                                                :class="{ 'border-red-500': form.errors.account_number }"
                                            />
                                            <jet-input-error
                                                :message="form.errors.account_number"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-5">
                                    <div class="space-y-6 sm:space-y-5">
                                        <div
                                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                                        >
                                            <div class="mt-1 sm:mt-0 sm:col-span-2 sm:col-start-2">
                                                <div
                                                    class="max-w-lg relative flex justify-end items-stretch flex-grow focus-within:z-10"
                                                >
                                                    <inertia-link
                                                        :href="route('employees.edit.contributions.index',employee.id)"
                                                        class="py-2 px-4 border border-transparent rounded-md ml-3 font-bold text-sm shadow-sm bg-red-500 hover:bg-red-600 text-white hover:text-gray-100 focus:outline-none"
                                                    >
                                                        Previous
                                                    </inertia-link>
                                                    <button
                                                        type="submit"
                                                        class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
                                                    >
                                                        Save
                                                    </button>

                                                    <button
                                                        @click.prevent="saveAndContinue"
                                                        type="button"
                                                        class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
                                                    >
                                                        Save & Continue
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End::Stepper Contents -->
                    </div>
                </template>
            </jet-form-section>
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
import {mask} from 'vue-the-mask'
import FormattedInput from "../../../Components/FormattedInput";

export default {
    props: {
        banks: Array,
        employee: Object,
    },
    directives: {mask},
    components: {
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
        JetFormSection,
        JetSecondaryButton,
        JetLabel,
        JetInput,
        JetInputError,
        JetActionMessage,
        JetButton,
        JetCheckbox,
        FormattedInput
    },
    data() {
        return {
            form: this.$inertia.form(
                {
                    _method: 'PUT',
                    bank: '',
                    account_number: null,
                    continue: false
                },
                {
                    resetOnSuccess: true,
                }
            ),
        }
    },
    mounted() {
        const bank_details = this.employee.bank_details;
        if (bank_details) {
            this.form.bank = bank_details.bank_id
            this.form.account_number = bank_details.account_number
        }
    },
    methods: {
        submit() {
            this.form.post(this.route('employees.edit.bank-details.update', this.employee.id))
        },

        saveAndContinue() {
            this.form.continue = true
            this.submit()
        }
    }
};
</script>
