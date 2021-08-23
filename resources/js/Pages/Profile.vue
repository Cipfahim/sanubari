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
                            <div class="space-y-6 sm:space-y-5">
                                <div class="sm:border-b sm:border-gray-200 py-5">
                                    <h3 class="text-2xl leading-6 font-semibold text-gray-900">
                                        User Profile
                                    </h3>
                                </div>

                                <div class="space-y-6 sm:space-y-5">
                                    <!-- Profile Photo -->
                                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2">
                                        <!-- Profile Photo File Input -->
                                        <input type="file" class="hidden"
                                               ref="photo"
                                               @change="updatePhotoPreview">

                                        <jet-label for="photo" value="Photo"/>

                                        <div class="block">
                                            <!-- Current Profile Photo -->
                                            <div class="mt-2" v-show="!photoPreview">
                                                <img src="/images/icon/avatar.png" alt="User"
                                                     class="rounded-full h-20 w-20 object-cover" />
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
                                        <div class="col-span-2 max-w-lg">
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
                                    </div>

                                    <!-- Email field-->
                                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2">
                                        <jet-label for="email" value="Email"/>
                                        <div class="col-span-2 max-w-lg">
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
import AppLayout from "../Layouts/App";
import JetFormSection from "@/Jetstream/FormSection";
import JetLabel from "@/Jetstream/Label";
import JetInputError from "@/Jetstream/InputError";
import JetInput from "@/Jetstream/Input";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import Input from "../Components/Input";

export default {
    props: {
        roles: Array
    },
    components: {
        Input,
        AppLayout,
        JetFormSection,
        JetSecondaryButton,
        JetLabel,
        JetInput,
        JetInputError,
        JetActionMessage,
        JetButton,
    },
    data() {
        return {
            photoPreview: null,

            form: this.$inertia.form(
                {
                    photo: null,
                    name: null,
                    email: null,
                    role: null,
                    phone: '+60',
                    password: null,
                    status: null
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
                .post(this.route('users.store'))
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
