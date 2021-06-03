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
                                                 :src="getFileUrl(user.photo)"
                                                 alt="">
                                        </div>
                                        <div
                                            class="mt-6 sm:flex-1 sm:min-w-0 sm:flex sm:items-center sm:justify-end sm:space-x-6 sm:pb-1">
                                            <div class="sm:hidden 2xl:block mt-6 min-w-0 flex-1">
                                                <h1 class="text-2xl font-bold text-gray-900 truncate">
                                                    {{ user.name }}
                                                </h1>
                                            </div>
                                            <div
                                                class="mt-6 flex flex-col justify-stretch space-y-3 sm:flex-row sm:space-y-0 sm:space-x-4">
                                                <inertia-link :href="route('users.index')"
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
                                            {{ user.name }}
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
                                                User Details
                                            </button>
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
                                            Name
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            {{ user.name }}
                                        </dd>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Email
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            {{ user.email }}
                                        </dd>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Phone
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            {{ user.phone }}
                                        </dd>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Role
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            {{ user.role.name }}
                                        </dd>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Status
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            {{ user.status }}
                                        </dd>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Created At
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            {{ user.created_at }}
                                        </dd>
                                    </div>

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
        user: Object,
    },
    components: {
        Input,
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
            openTab: 1
        }
    },
    methods: {
        toggleTabs(tabNum) {
            this.openTab = tabNum
        }
    }
};
</script>
