<template>
    <full-page-layout>
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>
        <div class="mx-auto w-full max-w-sm lg:w-96 shadow-lg bg-white rounded p-5 z-50">
            <div class="mt-4">
                <div class="mt-6">
                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <breeze-label for="phone" value="Phone"/>
                            <breeze-input id="phone" type="text" class="mt-1 block w-full" v-model="form.phone" required
                                          autofocus
                                          autocomplete="phone"/>
                        </div>
                        <div>
                            <breeze-button
                                typeof="button"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Send Forgot Password OTP
                            </breeze-button>
                        </div>
                        <div class="mt-2">
                            <breeze-validation-errors/>
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
                phone: '',
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('password.email'));
        }
    }
}
</script>
