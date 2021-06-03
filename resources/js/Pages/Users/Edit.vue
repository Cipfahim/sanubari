<template>
    <app-layout>
        <!-- Start::Stepper -->
        <div class="mt-4 px-4 sm:px-6 lg:px-8">
            <jet-form-section
                @submitted="submit"
                class="md:grid md:grid-cols-1 md:gap-0 md:gap-y-6"
            >
                <template #form class=" md:col-span-12">
                    <!-- Stepper Contents -->
                    <div class="bg-gray-50 p-4 rounded-md">
                        <div class="space-y-8 divide-y divide-gray-200">
                            <!-- User details-->
                            <div class="space-y-6 sm:pt-10 sm:space-y-5 mt-5 sm:mt-0">
                                <div class="sm:border-b sm:border-gray-200 pb-2">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                        User Details
                                    </h3>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                        This section contains sensitive information.
                                    </p>
                                </div>

                                <div class="space-y-6 sm:space-y-5">
                                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2">
                                        <!-- Profile Photo File Input -->
                                        <input type="file" class="hidden"
                                               ref="photo"
                                               @change="updatePhotoPreview">

                                        <jet-label for="photo" value="Photo"/>

                                        <div class="block">
                                            <!-- Current Profile Photo -->
                                            <div class="mt-2" v-show="! photoPreview">
                                                <img :src="getFileUrl(user.photo)" :alt="user.name"
                                                     class="rounded-full h-20 w-20 object-cover">
                                            </div>

                                            <!-- New Profile Photo Preview -->
                                            <div class="mt-2" v-show="photoPreview">
                                            <span class="block rounded-full w-20 h-20"
                                                  :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                                            </span>
                                            </div>

                                            <jet-secondary-button class="mt-2 mr-2" type="button"
                                                                  @click.prevent="selectNewPhoto">
                                                Select A New Photo
                                            </jet-secondary-button>

                                            <jet-input-error :message="form.errors.photo" class="mt-2"/>
                                        </div>
                                    </div>

                                    <!-- Name field-->
                                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2">
                                        <jet-label for="name" value="Name *"/>
                                        <jet-input
                                            id="name"
                                            type="text"
                                            v-model="form.name"
                                            :class="{ 'border-red-500': form.errors.name }"
                                        />
                                        <jet-input-error
                                            :message="form.errors.name"
                                            class="mt-2"
                                        />
                                    </div>

                                    <!-- Email field-->
                                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2">
                                        <jet-label for="email" value="Email"/>
                                        <jet-input
                                            id="email"
                                            type="text"
                                            v-model="form.email"
                                            :class="{ 'border-red-500': form.errors.email }"
                                        />
                                        <jet-input-error
                                            :message="form.errors.email"
                                            class="mt-2"
                                        />
                                    </div>


                                    <!-- Role field-->
                                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2">
                                        <jet-label for="role" value="Role *"/>

                                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                                            <div class="max-w-lg flex justify-space-between">
                                                <select
                                                    v-model="form.role"
                                                    id="role"
                                                    name="role"
                                                    autocomplete="role"
                                                    class="focus:ring-cyan-500 focus:border-cyan-500 w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                >
                                                    <option>Select one</option>
                                                    <option v-for="(role) in roles"
                                                            :value="role.id">{{ role.name }}
                                                    </option>
                                                </select>

                                                <jet-input-error
                                                    :message="form.errors.role"
                                                    class="mt-2"
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Phone field-->
                                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2">
                                        <jet-label for="phone" value="Phone *"/>
                                        <jet-input
                                            id="phone"
                                            type="text"
                                            v-model="form.phone"
                                            :class="{ 'border-red-500': form.errors.phone }"
                                            required
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

                                    <!-- Status field-->
                                    <div
                                        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                                    >
                                        <jet-label for="status" value="Status *"/>
                                        <Switch
                                            v-model="form.status"
                                            :class="form.status ? 'bg-cyan-900' : 'bg-cyan-700'"
                                            class="relative inline-flex flex-shrink-0 h-[38px] w-[174px] border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
                                        >
                                          <span
                                              aria-hidden="true"
                                              :class="form.status ? 'translate-x-20' : 'translate-x-0'"
                                              class="flex items-center justify-center pointer-events-none inline-block h-[34px] w-[90px] rounded-full bg-white shadow-sm transform ring-0 transition ease-in-out duration-200"
                                          >
                                            <span v-if="form.status" class="text-cyan-900">Active</span>
                                            <span v-else class="text-cyan-900">Inactive</span>
                                          </span>
                                        </Switch>
                                        <jet-input-error
                                            :message="form.errors.status"
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
                                                    :href="route('users.index')"
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
        roles: Array,
        user: Object
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
            photoPreview: null,

            form: this.$inertia.form(
                {
                    _method: 'PUT',
                    photo: null,
                    name: this.user.name,
                    email: this.user.email,
                    role: this.user.role_id,
                    phone: this.user.phone ? this.user.phone : '+60',
                    password: null,
                    status: this.user.status === 'Active' ? true : false,
                },
                {
                    resetOnSuccess: true,
                }
            ),
        }
    },
    methods: {
        submit() {
            if (this.$refs.photo) {
                this.form.photo = this.$refs.photo.files[0]
            }

            this.form
                .transform(data => ({
                    ...data,
                    status: this.form.status ? 'Active' : 'Inactive'
                }))
                .post(this.route('users.update', this.user.id))
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
    }
};
</script>
