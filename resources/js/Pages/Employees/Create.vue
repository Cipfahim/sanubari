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
                                <div class="sm:border-b sm:border-gray-200 pb-2">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                        Official Information
                                    </h3>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                        Star (*) means required!
                                    </p>
                                </div>

                                <div class="mt-4 sm:mt-3 space-y-6 sm:space-y-5">
                                    <!-- Profile Photo -->
                                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2">
                                        <!-- Profile Photo File Input -->
                                        <input type="file" class="hidden"
                                               ref="photo"
                                               @change="updatePhotoPreview">

                                        <jet-label for="photo" value="Photo"/>

                                        <div class="block">
                                            <!-- New Profile Photo Preview -->
                                            <div class="mt-2">
                                                <span
                                                    class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                                                    :style="'background-image: url(\'' + (photoPreview ? photoPreview : '/images/icon/avatar.png') + '\');'">
                                                </span>
                                            </div>

                                            <jet-secondary-button class="mt-2 mr-2" type="button"
                                                                  @click.prevent="selectNewPhoto">
                                                Select A New Photo
                                            </jet-secondary-button>

                                            <jet-input-error :message="form.errors.photo" class="mt-2"/>
                                        </div>
                                    </div>

                                    <!-- Official Name field-->
                                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2">
                                        <jet-label for="official_name" value="Official Name *"/>
                                        <div class="col-span-2 sm:max-w-lg">
                                            <jet-input
                                                id="official_name"
                                                type="text"
                                                v-model="form.official_name"
                                                :class="{ 'border-red-500': form.errors.official_name }"
                                                class="capitalize"
                                            />
                                            <jet-input-error
                                                :message="form.errors.official_name"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>

                                    <!-- Nick Name field-->
                                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2">
                                        <jet-label for="nick_name" value="Nick Name *"/>
                                        <div class="col-span-2 max-w-lg">
                                            <jet-input
                                                id="nick_name"
                                                type="text"
                                                v-model="form.nick_name"
                                                :class="{ 'border-red-500': form.errors.nick_name }"
                                                class="capitalize"
                                            />
                                            <jet-input-error
                                                :message="form.errors.nick_name"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>

                                    <!-- Location field-->
                                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2">
                                        <jet-label for="location" value="Location *"/>

                                        <div class="col-span-2 max-w-lg">
                                            <div class="w-full sm:flex justify-space-between space-y-4 sm:space-y-0">
                                                <Multiselect
                                                    searchable
                                                    v-model="form.location"
                                                    :options="locations"
                                                    valueProp="id"
                                                    trackBy="name"
                                                    label="name"
                                                    placeholder="Choose a location"
                                                    class="mt-1 block w-full !rounded-md focus:ring-cyan-500 focus:border-cyan-500"
                                                    :class="{ 'border-red-500' : form.errors.location }"
                                                />

                                                <div class="flex gap-4 sm:gap-0">
                                                    <button
                                                        @click.prevent="refreshLocations"
                                                        class="sm:ml-2 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 flex items-center"
                                                    >
                                                        <RefreshIcon class="h-5 w-5 text-cyan-400 mr-2"
                                                                     :class="rotate ? 'animate-spin' : ''"/>
                                                        Reload
                                                    </button>

                                                    <a
                                                        :href="route('locations.create')"
                                                        target="_blank"
                                                        class="sm:ml-2 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 flex items-center"
                                                    >
                                                        <PlusCircleIcon class="h-5 w-5 text-cyan-400 mr-2"/>
                                                        Add
                                                    </a>
                                                </div>
                                            </div>
                                            <jet-input-error
                                                :message="form.errors.location"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>

                                    <!-- Date of join field-->
                                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2">
                                        <jet-label for="date_of_join" value="Date of Join *"/>

                                        <div class="col-span-2 max-w-lg">
                                            <div class="focus-within:z-10">
                                                <DatePicker v-model="form.date_of_join" :masks="datePickerConfig.masks"
                                                            :model-config="datePickerConfig.modelConfig">
                                                    <template #default="{ inputValue, inputEvents }">
                                                        <input
                                                            class="px-3 py-2 text-sm border rounded-md w-full shadow-sm border-gray-300 focus:ring-cyan-500 focus:border-cyan-500 focus:outline-none"
                                                            :class="{ 'border-red-500': form.errors.date_of_join }"
                                                            :value="inputValue"
                                                            v-on="inputEvents"/>
                                                    </template>
                                                </DatePicker>
                                            </div>
                                            <jet-input-error
                                                :message="form.errors.date_of_join"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Login details-->
                            <div class="space-y-6 pt-5 sm:pt-10 sm:space-y-5 mt-5 sm:mt-0">
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
                                        <div class="col-span-2 max-w-lg">
                                            <div class="relative flex">
                                                <vue-tel-input ref="telPhone"
                                                               mode="international"
                                                               class="!unset focus:ring-cyan-500 focus:border-cyan-500 block w-full !rounded-md sm:text-sm !border-gray-300 overflow-hidden"
                                                >
                                                </vue-tel-input>
                                            </div>

                                            <jet-input-error
                                                :message="form.errors.phone"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>

                                    <!-- Password field-->
                                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2">
                                        <jet-label for="password" value="Password *"/>

                                        <div class="col-span-2 max-w-lg">
                                            <div class="w-full flex justify-space-between">
                                                <div class="relative w-full">
                                                    <jet-input
                                                        id="password"
                                                        :type="showPassword ? 'text' : 'password'"
                                                        v-model="form.password"
                                                        :class="{ 'border-red-500': form.errors.password }"
                                                        class="pr-10"
                                                    />
                                                    <div @click="toggleShowPassword"
                                                         class="absolute z-10 top-2 right-3 cursor-pointer">
                                                        <EyeIcon v-if="showPassword" class="h-5 w-5 text-gray-600"/>
                                                        <EyeOffIcon v-else class="h-5 w-5 text-gray-400"/>
                                                    </div>
                                                </div>
                                                <button
                                                    type="button"
                                                    @click="generatePassword"
                                                    class="ml-2 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 flex items-center select-none"
                                                >
                                                    <ViewGridIcon
                                                        class="h-5 w-5 text-cyan-400 mr-2 transform transition duration-1000"
                                                        :class="generatePasswordIcon ? 'rotate-180' : '-rotate-180'"/>
                                                    Generate
                                                </button>
                                            </div>
                                            <jet-input-error
                                                :message="form.errors.password"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>

                                    <!-- Status field-->
                                    <div
                                        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                                    >
                                        <jet-label for="status" value="Status *"/>
                                        <div class="col-span-2 max-w-lg">
                                            <Switch
                                                v-model="form.status"
                                                :class="form.status ? 'bg-green-700' : 'bg-red-600'"
                                                class="relative inline-flex flex-shrink-0 h-[38px] w-[174px] border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
                                            >
                                              <span
                                                  aria-hidden="true"
                                                  :class="form.status ? 'translate-x-20' : 'translate-x-0'"
                                                  class="flex items-center justify-center pointer-events-none inline-block h-[34px] w-[90px] rounded-full bg-white shadow-sm transform ring-0 transition ease-in-out duration-200 select-none"
                                              >
                                                <span v-if="form.status" class="text-green-700">Active</span>
                                                <span v-else class="text-red-600">Inactive</span>
                                              </span>
                                            </Switch>
                                            <jet-input-error
                                                :message="form.errors.status"
                                                class="mt-2"
                                            />
                                        </div>
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
import TopBar from "./Edit/TopBar";
import {
    CalendarIcon,
    CashIcon,
    CheckCircleIcon,
    CheckIcon,
    ChevronRightIcon,
    OfficeBuildingIcon,
    PlusCircleIcon,
    RefreshIcon
} from "@heroicons/vue/solid";
import {
    ViewGridIcon,
    EyeOffIcon,
    EyeIcon
} from "@heroicons/vue/outline";
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
import {DatePicker} from 'v-calendar';
import Multiselect from '@vueform/multiselect'
import '@vueform/multiselect/themes/default.css'

import {VueTelInput} from 'vue3-tel-input'

export default {
    props: {
        locations: Array,
        countries: Array,
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
        ViewGridIcon,
        EyeOffIcon,
        EyeIcon,
        RefreshIcon,
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
        Multiselect,
        VueTelInput,
    },
    data() {
        return {
            countryFlagPath: '/images/icon/country.png',

            photoPreview: null,
            generatePasswordIcon: false,
            showPassword: true,
            form: this.$inertia.form(
                {
                    photo: null,
                    official_name: null,
                    nick_name: null,
                    location: null,
                    date_of_join: null,
                    name: null,
                    email: null,
                    phone: '',
                    password: null,
                    status: null
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
            rotate: false
        }
    },
    watch:{

    },
    methods: {
        refreshLocations() {
            this.rotate = true
            this.$inertia.reload({
                only: ['locations'],
                onFinish: visit => {
                    this.rotate = false
                },
            });
        },
        getFlagPath(event) {
            const matchCountry = this.countries.find(country => country.country_code === event.target.value);
            return this.countryFlagPath = matchCountry ? this.getFileUrl(matchCountry.flag_path)
                : '/images/icon/country.png';
        },
        submit() {
            if (this.$refs.photo) {
                this.form.photo = this.$refs.photo.files[0]
            }
            this.form
                .transform(data => ({
                    ...data,
                    phone: this.$refs.telPhone.phoneObject.number,
                    status: this.form.status ? 'Active' : 'Inactive'
                }))
                .post(this.route('employees.store'))
        },
        selectNewPhoto() {
            this.$refs.photo.click();
        },

        updatePhotoPreview() {
            const reader = new FileReader();

            reader.onload = (e) => {
                this.photoPreview = e.target.result;
            };

            reader.readAsDataURL(this.$refs.photo.files[0]);
        },
        generatePassword() {
            this.generatePasswordIcon = !this.generatePasswordIcon;
            this.form.password = Math.random().toString(36).slice(-8);
            this.showPassword = true;
        },
        toggleShowPassword() {
            this.showPassword = !this.showPassword;
        },
    }
};
</script>
