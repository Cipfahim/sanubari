<template>
    <app-layout>
        <!-- Start::Stepper -->
        <div class="mt-4 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col min-w-0 flex-1 overflow-hidden bg-white rounded-md">
                <div class="flex-1 relative z-0 flex overflow-hidden">
                    <div class="flex-1 relative z-0 overflow-y-auto focus:outline-none xl:order-last">
                        <article>
                            <!-- Profile header -->
                            <div>
                                <div>
                                    <img class="h-32 w-full object-cover object-top lg:h-48"
                                         src="https://images.unsplash.com/photo-1444628838545-ac4016a5418a?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80"
                                         alt="">
                                </div>
                                <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                                    <div class="-mt-12 sm:-mt-16 sm:flex sm:items-end sm:space-x-5">
                                        <div class="flex">
                                            <img class="h-24 w-24 rounded-full ring-4 ring-white sm:h-32 sm:w-32"
                                                 :src="employee.user.photo ? getFileUrl(employee.user.photo) : '/images/icon/avatar.png'"
                                                 :alt="employee.official_name">
                                        </div>
                                        <div
                                            class="mt-6 sm:flex-1 sm:min-w-0 sm:flex sm:items-center sm:justify-end sm:space-x-6 sm:pb-1">
                                            <div class="sm:hidden 2xl:block mt-6 min-w-0 flex-1">
                                                <h1 class="text-2xl font-bold text-gray-900 truncate">
                                                    {{ employee.official_name }}
                                                </h1>
                                            </div>
                                            <div
                                                class="mt-6 flex flex-col justify-stretch space-y-3 sm:flex-row sm:space-y-0 sm:space-x-4">
                                                <inertia-link :href="route('employees.index')"
                                                              class="inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md bg-red-600 hover:bg-red-500 text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                    <!-- Heroicon name: solid/mail -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-4 w-4"
                                                         viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                              clip-rule="evenodd"/>
                                                    </svg>
                                                    <span>Back</span>
                                                </inertia-link>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hidden sm:block 2xl:hidden mt-6 min-w-0 flex-1">
                                        <h1 class="text-2xl font-bold text-gray-900 truncate">
                                            {{ employee.official_name }}
                                        </h1>
                                    </div>
                                </div>
                            </div>

                            <!-- Tabs Button-->
                            <div class="mt-6 sm:mt-2 2xl:mt-5 overflow-x-auto scrollbar-hide">
                                <div class="border-b border-gray-200">
                                    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                                        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                                            <!-- Current: "border-cyan-500 text-gray-900", Default: "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" -->
                                            <button type="button" @click="toggleTabs(1)"
                                                    :class="{'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': openTab !== 1 , 'border-cyan-500 text-gray-900' : openTab === 1}"
                                                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm focus:outline-none"
                                                    aria-current="page">
                                                Employee Details
                                            </button>

                                            <button type="button" @click="toggleTabs(2)"
                                                    :class="{'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': openTab !== 2 , 'border-cyan-500 text-gray-900' : openTab === 2}"
                                                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm focus:outline-none"
                                                    aria-current="page">
                                                Contact Details
                                            </button>

                                            <button type="button" @click="toggleTabs(3)"
                                                    :class="{'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': openTab !== 3 , 'border-cyan-500 text-gray-900' : openTab === 3}"
                                                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm focus:outline-none"
                                                    aria-current="page">
                                                Contribution
                                            </button>

                                            <button type="button" @click="toggleTabs(4)"
                                                    :class="{'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': openTab !== 4 , 'border-cyan-500 text-gray-900' : openTab === 4}"
                                                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm focus:outline-none"
                                                    aria-current="page">
                                                Salary Details
                                            </button>

                                            <button type="button" @click="toggleTabs(5)"
                                                    :class="{'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': openTab !== 5 , 'border-cyan-500 text-gray-900' : openTab === 5}"
                                                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm focus:outline-none"
                                                    aria-current="page">
                                                Annual Leave
                                            </button>

                                            <inertia-link :href="route('employees.documents.index',employee.id)"
                                                          :class="{'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': route().current('employees.documents.index',employee.id) !== 5 , 'border-cyan-500 text-gray-900' : route().current('employees.documents.index',employee.id) === 5}"
                                                          class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm focus:outline-none"
                                                          aria-current="page">
                                                Documents
                                            </inertia-link>
                                            <inertia-link :href="route('employees.payslips.index',employee.id)"
                                                          :class="{'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': !route().current('employees.payslips.index',employee.id), 'border-cyan-500 text-gray-900' : route().current('employees.payslips.index',employee.id)}"
                                                          class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm focus:outline-none"
                                                          aria-current="page">
                                                Payslips
                                            </inertia-link>
                                        </nav>
                                    </div>
                                </div>
                            </div>

                            <!-- Tab-1 -->
                            <div :class="{hidden:openTab !== 1, block : openTab ===1 }"
                                 class="my-6 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Official Name
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            {{ employee.official_name }}
                                        </dd>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Nick Name
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            {{ employee.nick_name }}
                                        </dd>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Sex
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            {{ employee.sex }}
                                        </dd>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Citizenship
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            {{ employee.citizenship }}
                                        </dd>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Date of Birth
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            {{ employee.date_of_birth }}
                                        </dd>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Country of Birth
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            {{ employee.country_of_birth }}
                                        </dd>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            State of Birth
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            {{ employee.state_of_birth }}
                                        </dd>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Location
                                        </dt>
                                        <dd v-if="employee.location" class="mt-1 text-sm text-gray-900">
                                            {{ employee.location.name }}
                                        </dd>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Dath of Join
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            {{ employee.date_of_join }}
                                        </dd>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Passport Number
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            {{ employee.passport_number }}
                                        </dd>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Identity Card (IC) Number
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            {{ employee.ic_number }}
                                        </dd>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Status
                                        </dt>
                                        <dd v-if="employee.user" class="mt-1 text-sm text-gray-900">
                                            {{ employee.user.status }}
                                        </dd>
                                    </div>

                                </dl>
                            </div>

                            <!-- Tab-2 -->
                            <div :class="{hidden:openTab !== 2, block : openTab ===2 }"
                                 class="my-6 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Contact Number
                                        </dt>
                                        <dd v-if="employee.contact_numbers.length"
                                            v-for="contactNumber in employee.contact_numbers"
                                            class="my-1 text-sm text-gray-900">
                                            {{ contactNumber.value }}
                                        </dd>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Personal Email
                                        </dt>
                                        <dd v-if="employee.contact_emails.length"
                                            v-for="contactEmail in employee.contact_emails"
                                            class="my-1 text-sm text-gray-900">
                                            {{ contactEmail.value }}
                                        </dd>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Personal Address
                                        </dt>
                                        <dd v-if="employee.contact_address.length"
                                            v-for="contactAddress in employee.contact_address"
                                            class="my-1 text-sm text-gray-900">
                                            {{ contactAddress.value }}
                                        </dd>
                                    </div>
                                </dl>
                            </div>

                            <!-- Tab-3 -->
                            <div :class="{hidden:openTab !== 3, block : openTab ===3 }"
                                 class="my-6 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            EPF Employee (%)
                                        </dt>
                                        <dd v-if="employee.contribution" class="my-1 text-sm text-gray-900">
                                            {{ employee.contribution.epf_employee }}
                                        </dd>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            EPF Employer (%)
                                        </dt>
                                        <dd v-if="employee.contribution" class="my-1 text-sm text-gray-900">
                                            {{ employee.contribution.epf_employer }}
                                        </dd>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            SOCSO Group
                                        </dt>
                                        <dd v-if="employee.contribution" class="my-1 text-sm text-gray-900">
                                            {{ employee.contribution.socso_group }}
                                        </dd>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            EPF No (%)
                                        </dt>
                                        <dd v-if="employee.contribution" class="my-1 text-sm text-gray-900">
                                            {{ employee.contribution.epf_no }}
                                        </dd>
                                    </div>
                                </dl>
                            </div>

                            <!-- Tab-4 -->
                            <div :class="{hidden:openTab !== 4, block : openTab ===4 }"
                                 class="my-6 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Basic Salary
                                        </dt>
                                        <dd v-if="employee.salary_details" class="my-1 text-sm text-gray-900">
                                            {{ employee.salary_details.basic_salary }}
                                        </dd>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Cost of Living Allowance *
                                        </dt>
                                        <dd v-if="employee.salary_details" class="my-1 text-sm text-gray-900">
                                            {{ employee.salary_details.living_allowance }}
                                        </dd>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Attendance Allowance
                                        </dt>
                                        <dd v-if="employee.salary_details" class="my-1 text-sm text-gray-900">
                                            {{ employee.salary_details.attendance_allowance }}
                                        </dd>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Levy
                                        </dt>
                                        <dd v-if="employee.salary_details" class="my-1 text-sm text-gray-900">
                                            {{ employee.salary_details.levy }}
                                        </dd>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            In Charge Allowance *
                                        </dt>
                                        <dd v-if="employee.salary_details" class="my-1 text-sm text-gray-900">
                                            {{ employee.salary_details.in_charge_allowance }}
                                        </dd>
                                    </div>
                                </dl>
                            </div>

                            <!-- Tab-5 -->
                            <div :class="{hidden:openTab !== 5, block : openTab ===5 }"
                                 class="my-6 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Quota
                                        </dt>
                                        <dd class="my-1 text-sm text-gray-900">
                                            {{ employee.annual_leave_quota }}
                                        </dd>
                                    </div>

                                    <!--                                    <div class="sm:col-span-1">-->
                                    <!--                                        <dt class="text-sm font-medium text-gray-500">-->
                                    <!--                                            Annual Leave Taken (Days)-->
                                    <!--                                        </dt>-->
                                    <!--                                        <dd class="my-1 text-sm text-gray-900">-->
                                    <!--                                            12-->
                                    <!--                                        </dd>-->
                                    <!--                                    </div>-->
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
import AppLayout from "../../Layouts/App";
import TopBar from "./Edit/TopBar";
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
import Input from "../../Components/Input";
import JetCheckbox from "@/Jetstream/Checkbox";
import {Switch} from "@headlessui/vue";

export default {
    props: {
        employee: Object,
        showTab: Number
    },
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
        Switch
    },
    data() {
        return {
            openTab: this.showTab
                ? Number(this.showTab)
                : 1
        }
    },
    methods: {
        toggleTabs(tabNum) {
            this.openTab = tabNum
        }
    }
};
</script>
