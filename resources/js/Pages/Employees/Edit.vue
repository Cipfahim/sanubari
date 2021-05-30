<template>
    <app-layout>
        <!-- Start::Stepper -->
        <div class="mt-4 px-4 sm:px-6 lg:px-8">
            <top-bar :steps="[
                {id: 'A', name: 'Employee Details', href: route('employees.edit',employee.id), status: true, current: true},
                {id: 'B', name: 'Identification Details', href: route('employees.identification.index',employee.id), status: true},
                {id: 'C', name: 'Contact Details', href: route('employees.contact-details.index',employee.id), status: true},
                {id: 'D', name: 'Contribution',href: route('employees.contributions.index',employee.id), status: true},
                {id: 'E', name: 'Salary Details', href: route('employees.salary-details.index',employee.id), status: true},
                {id: 'F', name: 'Annual Leave', href: route('employees.annual-leave.index',employee.id), status: true},
            ]"/>
            <jet-form-section
                @submitted="save"
                class="md:grid md:grid-cols-1 md:gap-0 md:gap-y-6"
            >
                <template #form class=" md:col-span-12">
                    <!-- Strat::Stepper Contents -->
                    <div class="bg-gray-50 p-4 rounded-md">
                        <div class="space-y-8 divide-y divide-gray-200">
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
                                            v-model="form.official_name"
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
                                            v-model="form.nick_name"
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
                                                <jet-input
                                                    id="date_of_join"
                                                    type="date"
                                                    v-model="form.date_of_join"
                                                    :class="{ 'border-red-500': form.errors.date_of_join }"
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
                                    <!-- Phone field-->
                                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2">
                                        <jet-label for="phone" value="Phone *"/>
                                        <jet-input
                                            id="phone"
                                            type="text"
                                            v-model="form.phone"
                                            :class="{ 'border-red-500': form.errors.phone }"
                                        />
                                        <jet-input-error
                                            :message="form.errors.phone"
                                            class="mt-2"
                                        />
                                    </div>

                                    <!-- Password field-->
                                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2">
                                        <jet-label for="password" value="Password *"/>
                                        <jet-input
                                            id="password"
                                            type="password"
                                            v-model="form.password"
                                            :class="{ 'border-red-500': form.errors.password }"
                                        />
                                        <jet-input-error
                                            :message="form.errors.password"
                                            class="mt-2"
                                        />
                                    </div>

                                    <!-- Status -->
                                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2">
                                        <div></div>
                                        <label class="flex items-center">
                                            <jet-checkbox name="status" v-model:checked="form.status"/>
                                            <span class="ml-2 text-sm text-gray-600">Status: {{
                                                    form.status ? 'Active' : 'Inactive'
                                                }}</span>
                                        </label>
                                        <jet-input-error :message="form.errors.status" class="mt-2"/>
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
                                                    :href="route('employees.index')"
                                                    class="py-2 px-4 border border-transparent rounded-md ml-3 font-bold text-sm shadow-sm bg-red-500 hover:bg-red-600 text-white hover:text-gray-100 focus:outline-none"
                                                >
                                                    Cancel
                                                </inertia-link>
                                                <button
                                                    type="submit"
                                                    class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
                                                >
                                                    Save
                                                </button>

                                                <button
                                                    type="button"
                                                    @click="saveAndContinue()"
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
import JetFormSection from "@/Jetstream/FormSection";
import JetLabel from "@/Jetstream/Label";
import JetInputError from "@/Jetstream/InputError";
import JetInput from "@/Jetstream/Input";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import Input from "../../Components/Input";
import JetCheckbox from "@/Jetstream/Checkbox";


export default {
    props: {
        locations: Array,
        employee: Object,
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
        JetCheckbox
    },
    directives: {mask},
    data() {
        return {
            form: this.$inertia.form(
                {
                    _method: 'PUT',
                    official_name: this.employee.official_name,
                    nick_name: this.employee.nick_name,
                    location: this.employee.location_id,
                    date_of_join: this.employee.date_of_join,
                    phone: this.employee.user.phone,
                    password: null,
                    status: this.employee.user.status === 'Active',
                    continue: false
                },
                {
                    resetOnSuccess: true,
                }
            ),
        }
    },
    methods: {
        submit() {
            this.form.post(this.route('employees.update', this.employee.id))
        },
        save() {
            this.submit()
        },

        saveAndContinue() {
            this.form.continue = true
            this.submit()
        }
    }
};
</script>
