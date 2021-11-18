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
                                        <div class="col-span-2 max-w-lg">
                                            <Multiselect
                                                searchable
                                                v-model="form.nationality"
                                                :options="countries"
                                                valueProp="id"
                                                trackBy="name"
                                                placeholder="Choose a nationality"
                                                class="mt-1 block w-full"
                                                :class="{ 'border-red-500' : form.errors.nationality }"
                                            >
                                                <template v-slot:singlelabel="{ value }">
                                                    <div class="flex gap-2 items-center multiselect-single-label">
                                                        <img class="h-8 w-10 rounded-md character-label-icon"
                                                             :src="getFileUrl(value.flag_path)">
                                                        <p class="flex-1">{{ value.name }}</p>
                                                    </div>
                                                </template>
                                                <template v-slot:option="{ option }">
                                                    <div class="flex gap-2 items-center">
                                                        <img class="h-8 w-10 rounded-md"
                                                             :src="getFileUrl(option.flag_path)">
                                                        <p class="flex-1">{{ option.name }}</p>
                                                    </div>
                                                </template>
                                            </Multiselect>
                                            <jet-input-error
                                                :message="form.errors.nationality"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>
                                    <!-- Identity Card field-->
                                    <div
                                        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                                    >
                                        <jet-label for="identity" value="Identity Card (IC) Number *"/>
                                        <div class="col-span-2 max-w-lg">
                                            <jet-input
                                                id="identity"
                                                type="text"
                                                v-mask="'###### - ## - ####'"
                                                v-model="form.identity_card_number"
                                                :class="{ 'border-red-500': form.errors.identity_card_number }"
                                                placeholder="###### - ## - ####"
                                            />
                                            <jet-input-error
                                                :message="form.errors.identity_card_number"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>


                                    <!-- passport group-->
                                    <div class="border border-gray-200 rounded-md space-y-6 sm:space-y-5 pb-4 py-2 px-2 sm:px-0">
                                        <!-- Passport Numbrt field-->
                                        <div
                                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                                        >
                                            <jet-label class="sm:pl-2" for="passport" value="Passport Number *"/>
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

                                        <!-- passport_issue_date field-->
                                        <div
                                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                                        >
                                            <jet-label class="sm:pl-2" for="dob" value="Passport Issue/Expiry Date *"/>
                                            <div class="col-span-2 max-w-lg grid grid-cols-2 gap-4">
                                                <div class="col-span-1 relative">
                                                    <div class="max-w-lg focus-within:z-10">
                                                        <DatePicker v-model="form.passport_issue_date" :masks="datePickerConfig.masks"
                                                                    :model-config="datePickerConfig.modelConfig">
                                                            <template #default="{ inputValue, inputEvents }">
                                                                <input
                                                                    class="px-3 py-2 text-sm border rounded w-full focus:ring-cyan-500 focus:border-cyan-500 focus:outline-none shadow-sm border-gray-300"
                                                                    :class="{ 'border-red-500': form.errors.passport_issue_date }"
                                                                    :value="inputValue"
                                                                    v-on="inputEvents"
                                                                    placeholder="dd/mm/yyyy"
                                                                />
                                                            </template>
                                                        </DatePicker>
                                                    </div>
                                                    <span class="absolute -top-2 left-2 bg-gray-50 rounded px-2 text-xs font-light text-gray-600">Issue Date</span>
                                                    <jet-input-error
                                                        :message="form.errors.date_of_birth"
                                                        class="mt-2"
                                                    />
                                                </div>
                                                <div class="col-span-1 relative">
                                                    <div class="max-w-lg focus-within:z-10">
                                                        <DatePicker v-model="form.passport_expiry_date" :masks="datePickerConfig.masks"
                                                                    :model-config="datePickerConfig.modelConfig">
                                                            <template #default="{ inputValue, inputEvents }">
                                                                <input
                                                                    class="px-3 py-2 text-sm border rounded w-full focus:ring-cyan-500 focus:border-cyan-500 focus:outline-none shadow-sm border-gray-300"
                                                                    :class="{ 'border-red-500': form.errors.passport_expiry_date }"
                                                                    :value="inputValue"
                                                                    v-on="inputEvents"
                                                                    placeholder="dd/mm/yyyy"
                                                                />
                                                            </template>
                                                        </DatePicker>
                                                    </div>
                                                    <span class="absolute -top-2 left-2 bg-gray-50 rounded px-2 text-xs font-light text-gray-600">Expiry Date</span>
                                                    <jet-input-error
                                                        :message="form.errors.date_of_birth"
                                                        class="mt-2"
                                                    />
                                                </div>
                                            </div>
                                        </div>

                                        <!-- passport_expiry_date field-->
<!--                                        <div-->
<!--                                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"-->
<!--                                        >-->
<!--                                            <jet-label class="sm:pl-2" for="dob" value="Passport Expiry Date *"/>-->
<!--                                            -->
<!--                                        </div>-->

                                        <!-- passport_issuing_authority field-->
                                        <div
                                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                                        >
                                            <jet-label class="sm:pl-2" for="passport" value="Passport Issuing Authority"/>
                                            <div class="col-span-2 max-w-lg">
                                                <jet-input
                                                    id="passport-issuing-authority"
                                                    type="text"
                                                    v-model="form.passport_issuing_authority"
                                                    :class="{ 'border-red-500': form.errors.passport_issuing_authority }"
                                                />
                                                <jet-input-error
                                                    :message="form.errors.passport_issuing_authority"
                                                    class="mt-2"
                                                />
                                            </div>
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
                                                        <input
                                                            class="px-3 py-2 text-sm border rounded w-full focus:ring-cyan-500 focus:border-cyan-500 focus:outline-none shadow-sm border-gray-300"
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
                                            <Multiselect
                                                searchable
                                                v-model="form.country_of_birth"
                                                @close="selectBirthCountry"
                                                @change="changeCountry"
                                                :options="countries"
                                                valueProp="id"
                                                trackBy="name"
                                                placeholder="Choose country of birth"
                                                class="mt-1 block w-full"
                                                :class="{ 'border-red-500' : form.errors.country_of_birth }"
                                            >
                                                <template v-slot:singlelabel="{ value }">
                                                    <div class="flex gap-2 items-center multiselect-single-label">
                                                        <img class="h-8 w-10 rounded-md character-label-icon"
                                                             :src="getFileUrl(value.flag_path)">
                                                        <p class="flex-1">{{ value.name }}</p>
                                                    </div>
                                                </template>
                                                <template v-slot:option="{ option }">
                                                    <div class="flex gap-2 items-center">
                                                        <img class="h-8 w-10 rounded-md"
                                                             :src="getFileUrl(option.flag_path)">
                                                        <p class="flex-1">{{ option.name }}</p>
                                                    </div>
                                                </template>
                                            </Multiselect>
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
                                        <jet-label for="sob" value="State/City of Birth *"/>
                                        <div class="col-span-2 max-w-lg">
                                            <Multiselect
                                                searchable
                                                v-model="form.state_of_birth"
                                                :options="cities"
                                                valueProp="id"
                                                trackBy="name"
                                                label="name"
                                                placeholder="Choose state/city of birth"
                                                class="mt-1 block w-full"
                                                :class="{ 'border-red-500' : form.errors.state_of_birth }"
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
                                                    class="py-2 px-2 sm:px-4 border border-transparent rounded-md ml-2 sm:ml-3 font-bold text-sm shadow-sm bg-red-500 hover:bg-red-600 text-white hover:text-gray-100 focus:outline-none"
                                                >
                                                    Previous
                                                </inertia-link>
                                                <button
                                                    type="submit"
                                                    class="ml-2 sm:ml-3 inline-flex justify-center py-2 px-2 sm:px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
                                                >
                                                    Save
                                                </button>
                                                <button
                                                    type="button"
                                                    @click="saveAndContinue()"
                                                    class="ml-2 sm:ml-3 inline-flex justify-center py-2 px-2 sm:px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
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
import {Switch} from "@headlessui/vue";
import {DatePicker} from 'v-calendar';
import Multiselect from "@vueform/multiselect";
import '@vueform/multiselect/themes/default.css'

export default {
    props: {
        countries: Array,
        cities: Array,
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
        Multiselect
    },
    directives: {mask},
    data() {
        return {
            form: this.$inertia.form(
                {
                    _method: "PUT",
                    nationality: this.employee.country_id,
                    identity_card_number: this.employee.ic_number,
                    passport_number: this.employee.passport_number,
                    passport_issue_date: this.employee.passport_issue_date,
                    passport_expiry_date: this.employee.passport_expiry_date,
                    passport_issuing_authority: this.employee.passport_issuing_authority,
                    date_of_birth: this.employee.date_of_birth,
                    country_of_birth: this.employee.birth_country_id,
                    state_of_birth: this.employee.birth_city_id,
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
        changeCountry(){
            this.form.state_of_birth = null
        },
        selectBirthCountry() {
            this.$inertia.replace(
                this.route("employees.edit.identification.index", {
                    id: this.employee.id,
                    country_id: this.form.country_of_birth
                }), {
                    preserveState: true,
                    preserveScroll: true,
                }
            );
        },

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
        },
    },
};
</script>
