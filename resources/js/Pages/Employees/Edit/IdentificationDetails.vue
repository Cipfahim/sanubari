<template>
    <app-layout>
        <!-- Start::Stepper -->
        <div class="mt-4 px-4 sm:px-6 lg:px-8">
            <top-bar :employee="employee.id" :current="route('employees.edit.identification.index', employee.id)"/>
            <jet-form-section
                @submitted="save"
                class="md:grid md:grid-cols-1 md:gap-0 md:gap-y-6"
            >
                <template #form class="md:col-span-12">
                    <!-- Strat::Stepper Contents -->
                    <div class="bg-gray-50 p-4 rounded-md">
                        <div class="space-y-8 divide-y divide-gray-200">
                            <!-- Login details-->
                            <div class="space-y-6 sm:pt-10 sm:space-y-5 mt-5 sm:mt-0">
                                <div class="sm:border-b sm:border-gray-200 pb-2">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                        Identification Details
                                    </h3>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                        This section contains sensitive information.
                                    </p>
                                </div>

                                <div class="space-y-6 sm:space-y-5">
                                    <!-- Citizenship field-->
                                    <div
                                        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                                    >
                                        <jet-label for="nationality" value="Nationality *"/>
                                        <Switch
                                            v-model="form.citizenship"
                                            :class="form.citizenship ? 'bg-cyan-900' : 'bg-cyan-700'"
                                            class="relative inline-flex flex-shrink-0 h-[38px] w-[174px] border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
                                        >
                                          <span
                                              aria-hidden="true"
                                              :class="form.citizenship ? 'translate-x-20' : 'translate-x-0'"
                                              class="flex items-center justify-center pointer-events-none inline-block h-[34px] w-[90px] rounded-full bg-white shadow-sm transform ring-0 transition ease-in-out duration-200"
                                          >
                                            <span v-if="form.citizenship" class="text-cyan-900">Foreigner</span>
                                            <span v-else class="text-cyan-900">Malaysian</span>
                                          </span>
                                        </Switch>
                                        <jet-input-error
                                            :message="form.errors.citizenship"
                                            class="mt-2"
                                        />
                                    </div>
                                    <!-- Identity Card field-->
                                    <div
                                        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                                        v-if="!form.citizenship"
                                    >
                                        <jet-label for="identity" value="Identity Card (IC) Number *"/>
                                        <div class="col-span-2 max-w-lg">
                                            <jet-input
                                                id="identity"
                                                type="text"
                                                v-mask="'######-##-####'"
                                                v-model="form.identity_card_number"
                                                :class="{ 'border-red-500': form.errors.identity_card_number }"
                                                placeholder="###### ## ####"
                                            />
                                            <jet-input-error
                                                :message="form.errors.identity_card_number"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>

                                    <!-- Passport Numbrt field-->
                                    <div
                                        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                                    >
                                        <jet-label for="passport" value="Passport Number *"/>
                                        <div class="col-span-2 max-w-lg">
                                            <jet-input
                                                id="passport"
                                                type="text"
                                                v-model="form.passport_number"
                                                :class="{ 'border-red-500': form.errors.passport_number }"
                                            />
                                            <jet-input-error
                                                :message="form.errors.passport_number"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>

                                    <!-- Date of birth field-->
                                    <div
                                        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                                    >
                                        <jet-label for="dob" value="Date of Birth *"/>
                                        <div class="col-span-2 max-w-lg">
                                            <div class="max-w-lg focus-within:z-10">
                                                <DatePicker v-model="form.date_of_birth" :masks="datePickerConfig.masks"
                                                            :model-config="datePickerConfig.modelConfig">
                                                    <template #default="{ inputValue, inputEvents }">
                                                        <input class="px-3 py-2 text-sm border rounded w-full focus:ring-cyan-500 focus:border-cyan-500 focus:outline-none shadow-sm border-gray-300"
                                                               :class="{ 'border-red-500': form.errors.date_of_join }"
                                                               :value="inputValue"
                                                               v-on="inputEvents"
                                                               placeholder="dd/mm/yyyy"
                                                        />
                                                    </template>
                                                </DatePicker>
                                            </div>
                                            <jet-input-error
                                                :message="form.errors.date_of_birth"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>
                                    <!-- Country of birth field-->
                                    <div
                                        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                                    >
                                        <jet-label for="cob" value="Country of Birth *"/>
                                        <div class="col-span-2 max-w-lg">
                                            <jet-input
                                                id="cob"
                                                type="text"
                                                v-model="form.country_of_birth"
                                                :class="{ 'border-red-500': form.errors.country_of_birth }"
                                            />
                                            <jet-input-error
                                                :message="form.errors.country_of_birth"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>
                                    <!-- State of birth field-->
                                    <div
                                        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                                    >
                                        <jet-label for="sob" value="State of Birth *"/>
                                        <div class="col-span-2 max-w-lg">
                                            <jet-input
                                                id="sob"
                                                type="text"
                                                v-model="form.state_of_birth"
                                                :class="{ 'border-red-500': form.errors.state_of_birth }"
                                            />
                                            <jet-input-error
                                                :message="form.errors.state_of_birth"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>
                                    <!-- Citizenship field-->
                                    <div
                                        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                                    >
                                        <jet-label for="citizenship" value="Sex *"/>
                                        <div class="col-span-2 max-w-lg">
                                            <Switch
                                                v-model="form.sex"
                                                :class="form.sex ? 'bg-cyan-900' : 'bg-cyan-700'"
                                                class="relative inline-flex flex-shrink-0 h-[38px] w-[174px] border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
                                            >
                                              <span
                                                  aria-hidden="true"
                                                  :class="form.sex ? 'translate-x-20' : 'translate-x-0'"
                                                  class="flex items-center justify-center pointer-events-none inline-block h-[34px] w-[90px] rounded-full bg-white shadow-sm transform ring-0 transition ease-in-out duration-200"
                                              >
                                                <span v-if="form.sex" class="text-cyan-900">Female</span>
                                                <span v-else class="text-cyan-900">Male</span>
                                              </span>
                                            </Switch>
                                        </div>
                                        <jet-input-error
                                            :message="form.errors.sex"
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
                                                    :href="route('employees.edit',employee.id)"
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
import {mask} from "vue-the-mask";
import JetFormSection from "@/Jetstream/FormSection";
import JetLabel from "@/Jetstream/Label";
import JetInputError from "@/Jetstream/InputError";
import JetInput from "@/Jetstream/Input";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import Input from "@/Components/Input";
import JetCheckbox from "@/Jetstream/Checkbox";
import {ref} from "vue";
import {Switch} from "@headlessui/vue";
import {DatePicker} from 'v-calendar';

export default {
    props: {
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
        JetCheckbox,
        Switch,
        DatePicker,
    },
    directives: {mask},

    setup() {
        const enabled = ref(false);

        return {enabled};
    },
    data() {
        return {
            form: this.$inertia.form(
                {
                    _method: "PUT",
                    citizenship: this.employee.citizenship === 'Foreigner' ? true : false,
                    identity_card_number: this.employee.ic_number,
                    passport_number: this.employee.passport_number,
                    date_of_birth: this.employee.date_of_birth,
                    country_of_birth: this.employee.country_of_birth,
                    state_of_birth: this.employee.state_of_birth,
                    sex: this.employee.sex === 'Female' ? true : false,
                    continue: false
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
        };
    },
    methods: {
        submit() {
            this.form
                .transform(data => ({
                    ...data,
                    citizenship: this.form.citizenship ? 'Foreigner' : 'Malaysian',
                    sex: this.form.sex ? 'Female' : 'Male'
                }))
                .post(this.route("employees.edit.identification.update", this.employee.id));
        },

        save() {
            this.submit()
        },

        saveAndContinue() {
            this.form.continue = true
            this.submit()
        }
    },
};
</script>
