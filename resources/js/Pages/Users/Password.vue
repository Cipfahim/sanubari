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
                                        Change Password
                                    </h3>
                                </div>

                                <div class="space-y-6 sm:space-y-5">
                                    <!-- Current Password field-->
                                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2">
                                        <jet-label for="password" value="Current Password *"/>
                                        <div class="col-span-2 max-w-lg">
                                            <div class="relative w-full">
                                                <jet-input
                                                    :type="showCurrPassword ? 'text' : 'password'"
                                                    v-model="form.current_password"
                                                    :class="{ 'border-red-500': form.errors.current_password }"
                                                    class="pr-10"
                                                />
                                                <div @click="toggleShowPassword('current')" class="absolute z-10 top-2.5 right-3 cursor-pointer">
                                                    <EyeIcon v-if="showCurrPassword" class="h-5 w-5 text-gray-600"/>
                                                    <EyeOffIcon v-else class="h-5 w-5 text-gray-400"/>
                                                </div>
                                            </div>
                                            <jet-input-error
                                                :message="form.errors.current_password"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>

                                    <!-- New Password field-->
                                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2">
                                        <jet-label for="password" value="New Password *"/>
                                        <div class="col-span-2 max-w-lg">
                                            <div class="relative w-full">
                                                <jet-input
                                                    :type="showNewPassword ? 'text' : 'password'"
                                                    v-model="form.password"
                                                    :class="{ 'border-red-500': form.errors.password }"
                                                    class="pr-10"
                                                />
                                                <div @click="toggleShowPassword('new')" class="absolute z-10 top-2.5 right-3 cursor-pointer">
                                                    <EyeIcon v-if="showNewPassword" class="h-5 w-5 text-gray-600"/>
                                                    <EyeOffIcon v-else class="h-5 w-5 text-gray-400"/>
                                                </div>
                                            </div>
                                            <jet-input-error
                                                :message="form.errors.password"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>
                                    <!-- Confirm Password field-->
                                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2">
                                        <jet-label for="password" value="Confirm Password *"/>
                                        <div class="col-span-2 max-w-lg">
                                            <div class="relative w-full">
                                                <jet-input
                                                    :type="showConfPassword ? 'text' : 'password'"
                                                    v-model="form.confirm_password"
                                                    :class="{ 'border-red-500': form.errors.confirm_password }"
                                                    class="pr-10"
                                                />
                                                <div @click="toggleShowPassword('confirm')" class="absolute z-10 top-2.5 right-3 cursor-pointer">
                                                    <EyeIcon v-if="showConfPassword" class="h-5 w-5 text-gray-600"/>
                                                    <EyeOffIcon v-else class="h-5 w-5 text-gray-400"/>
                                                </div>
                                            </div>
                                            <jet-input-error
                                                :message="form.errors.confirm_password"
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
                                                    :href="route('settings.users.index')"
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

export default {
    props: {
        roles: Array
    },
    components: {
        AppLayout,
        JetFormSection,
        JetSecondaryButton,
        JetLabel,
        JetInput,
        JetInputError,
        JetActionMessage,
        JetButton,
        EyeOffIcon,
        EyeIcon
    },
    data() {
        return {
            showCurrPassword: true,
            showNewPassword: true,
            showConfPassword: true,
            form: this.$inertia.form(
                {
                    _method: 'PUT',
                    current_password: null,
                    password: null,
                    confirm_password: null,
                },
                {
                    resetOnSuccess: true,
                }
            ),
        }
    },
    methods: {
        submit() {
            this.form.post(this.route('update.password', {
                'user': this.$page.props.auth.user
            }));
        },
        toggleShowPassword(type){
            if (type === 'current'){
                this.showCurrPassword = !this.showCurrPassword;
            }

            if(type == 'new'){
                this.showNewPassword = !this.showNewPassword;
            }

            if(type == 'confirm'){
                this.showConfPassword = !this.showConfPassword;
            }
        }
    }
};
</script>
