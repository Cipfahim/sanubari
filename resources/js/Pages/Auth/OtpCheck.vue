<template>
    <full-page-layout>
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>
        <div class="mx-auto w-full max-w-sm lg:w-96 shadow-lg bg-white rounded p-5 z-50">
            <div class="w-full flex justify-center">
                <img
                    class="h-12 w-auto"
                    src="/images/logo2.png"
                    alt="Sanubari"
                />
            </div>
            <div class="mt-4">
                <div class="mt-6">
                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <breeze-label for="otp" value="Otp"/>
                            <breeze-input id="otp" type="text" class="mt-1 block w-full" v-model="form.otp" required
                                          autofocus
                                          autocomplete="otp"/>
                        </div>
                        <div>
                            <breeze-button
                                typeof="button"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Submit
                            </breeze-button>
                        </div>
                        <div class="mt-2">
                            <breeze-validation-errors/>
                        </div>

                        <div v-if="$page.props.app.env === 'local'">
                            <div class="my-4 relative">
                                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                    <div class="w-full border-t border-gray-300"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-2 bg-white text-gray-500"> Or continue with </span>
                                </div>
                            </div>

                            <inertia-link
                                :href="route('dev-login')"
                                class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                            >
                                <span>Developer Account</span>
                            </inertia-link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </full-page-layout>
</template>
<script>
import BreezeButton from "@/Components/Button";
import BreezeGuestLayout from "@/Layouts/Guest";
import BreezeInput from "@/Components/Input";
import BreezeCheckbox from "@/Components/Checkbox";
import BreezeLabel from "@/Components/Label";
import BreezeValidationErrors from "@/Components/ValidationErrors";
import {Switch} from "@headlessui/vue";
import FullPageLayout from "@/Layouts/FullPage";

export default {
    layout: BreezeGuestLayout,

    components: {
        BreezeButton,
        BreezeInput,
        BreezeCheckbox,
        BreezeLabel,
        BreezeValidationErrors,
        Switch,
        FullPageLayout
    },

    props: {
        auth: Object,
        canResetPassword: Boolean,
        errors: Object,
        status: String,
    },
    data() {
        return {
            form: this.$inertia.form({
                otp: '',
            })
        }
    },

    methods: {
        submit() {
            if(this.$page.url === '/forgot-password') {
                this.form.post(this.route('otp.change.password'));
            }   else {
                this.form.post(this.route('otp.check'));
            }
        }
    }
}
</script>
