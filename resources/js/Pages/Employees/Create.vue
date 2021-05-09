<template>
    <app-layout>
        <!-- Start::Stepper -->
        <div class="mt-4 px-4 sm:px-6 lg:px-8">
            <top-bar/>
            <jet-form-section
                @submitted="submit"
                class="md:grid md:grid-cols-1 md:gap-0 md:gap-y-6"
            >
                <template #form class=" md:col-span-12">
                    <!-- Strat::Stepper Contents -->
                    <div class="bg-gray-50 p-4 rounded-md">
                        <div class="space-y-8 divide-y divide-gray-200">
                            <div>
                                <div>
                                    <div class="sm:border-b sm:border-gray-200 pb-2">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                                            Official Information
                                        </h3>
                                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                            Star (*) means required!
                                        </p>
                                    </div>

                                    <div class="mt-4 sm:mt-3 space-y-6 sm:space-y-5">
                                        <!-- Official Name field-->
                                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2">
                                            <jet-label for="official_name" value="Official Name *"/>
                                            <jet-input
                                                id="official_name"
                                                type="text"
                                                :class="{ 'border-red-500': form.errors.official_name }"
                                            />
                                            <jet-input-error
                                                :message="form.errors.official_name"
                                                class="mt-2"
                                            />
                                        </div>

                                        <!-- Nick Name field-->
                                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2">
                                            <jet-label for="nick_name" value="Nick Name *"/>
                                            <jet-input
                                                id="nick_name"
                                                type="text"
                                                :class="{ 'border-red-500': form.errors.nick_name }"
                                            />
                                            <jet-input-error
                                                :message="form.errors.nick_name"
                                                class="mt-2"
                                            />
                                        </div>

                                        <!-- Location field-->
                                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2">
                                            <jet-label for="location" value="Location *"/>

                                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                <div class="max-w-lg flex justify-space-between">
                                                    <select
                                                        v-model="form.location"
                                                        id="location"
                                                        name="location"
                                                        autocomplete="location"
                                                        class="focus:ring-cyan-500 focus:border-cyan-500 w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                    >
                                                        <option>Select one</option>
                                                        <option v-for="(location,index) in locations"
                                                                :value="location.id">{{ location.name }}
                                                        </option>
                                                    </select>

                                                    <button
                                                        type="button"
                                                        class="ml-2 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 flex items-center"
                                                    >
                                                        <PlusCircleIcon class="h-5 w-5 text-cyan-400 mr-2"/>
                                                        Add
                                                    </button>

                                                    <jet-input-error
                                                        :message="form.errors.location"
                                                        class="mt-2"
                                                    />
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Date of join field-->
                                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2">
                                            <jet-label for="date_of_join" value="Date of Join *"/>

                                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                <div class="max-w-lg focus-within:z-10">
                                                    <datepicker
                                                        v-model="form.date_of_join"
                                                        class="shadow-sm focus:ring-cyan-500 focus:border-cyan-500 relative block min-w-full rounded-md focus:z-10 sm:text-sm border-gray-300"
                                                    />
                                                </div>
                                            </div>

                                            <jet-input-error
                                                :message="form.errors.date_of_join"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <!-- Login details-->
                                <div class="space-y-6 sm:pt-10 sm:space-y-5 mt-5 sm:mt-0">
                                    <div class="sm:border-b sm:border-gray-200 pb-2">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                                            Login Details
                                        </h3>
                                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                            This section contains sensitive information.
                                        </p>
                                    </div>

                                    <div class="space-y-6 sm:space-y-5">
                                        <!-- Email field-->
                                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2">
                                            <jet-label for="email" value="Email *"/>
                                            <jet-input
                                                id="email"
                                                type="email"
                                                :class="{ 'border-red-500': form.errors.email }"
                                            />
                                            <jet-input-error
                                                :message="form.errors.email"
                                                class="mt-2"
                                            />
                                        </div>

                                        <!-- Password field-->
                                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2">
                                            <jet-label for="password" value="Password *"/>
                                            <jet-input
                                                id="password"
                                                type="password"
                                                :class="{ 'border-red-500': form.errors.password }"
                                            />
                                            <jet-input-error
                                                :message="form.errors.password"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End::Stepper Contents -->
                </template>
            </jet-form-section>
        </div>
        <!-- End::Stepper -->
    </app-layout>
</template>

<script>
import AppLayout from "../../Layouts/App";
import TopBar from "./TopBar";
import {
    CalendarIcon,
    CashIcon,
    CheckCircleIcon,
    CheckIcon,
    ChevronRightIcon,
    OfficeBuildingIcon,
    PlusCircleIcon,
} from "@heroicons/vue/solid";
import {mask} from "vue-the-mask";
// Date-picker
import Datepicker from "vue3-datepicker";
import JetFormSection from "@/Jetstream/FormSection";
import JetLabel from "@/Jetstream/Label";
import JetInputError from "@/Jetstream/InputError";
import JetInput from "@/Jetstream/Input";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";


export default {
    props: {
        locations: Array
    },
    components: {
        TopBar,
        AppLayout,
        OfficeBuildingIcon,
        CheckCircleIcon,
        CashIcon,
        ChevronRightIcon,
        CheckIcon,
        CalendarIcon,
        PlusCircleIcon,
        Datepicker,

        JetFormSection,
        JetSecondaryButton,
        JetLabel,
        JetInput,
        JetInputError,
        JetActionMessage,
        JetButton,
    },
    directives: {mask},
    data() {
        return {
            form: this.$inertia.form(
                {
                    name: null,
                    email: null,
                    password: null,
                    status: null,
                },
                {
                    resetOnSuccess: true,
                }
            ),
        }
    },
    methods: {
        submit() {

        }
    }
};
</script>
