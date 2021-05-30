<template>

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>
    <div class="mx-auto w-full max-w-sm lg:w-96 shadow-lg bg-white rounded p-5 z-50">
        <div class="w-full flex justify-center">
            <img
                class="h-12 w-auto"
                src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
                alt="Workflow"
            />
        </div>
        <div class="mt-4">
            <div class="mt-6">
                <form @submit.prevent="submit" class="space-y-6">
                    <div class="text-center">
                        <Switch
                            v-model="employeeLogin"
                            :class="employeeLogin ? 'bg-cyan-900' : 'bg-cyan-700'"
                            class="relative inline-flex flex-shrink-0 h-[38px] w-[174px] border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
                        >
                                  <span
                                      aria-hidden="true"
                                      :class="employeeLogin ? 'translate-x-20' : 'translate-x-0'"
                                      class="flex items-center justify-center pointer-events-none inline-block h-[34px] w-[90px] rounded-full bg-white shadow-sm transform ring-0 transition ease-in-out duration-200"
                                  >
                                    <span v-if="employeeLogin" class="text-cyan-900">Employee</span>
                                    <span v-else class="text-cyan-900">User</span>
                                  </span>
                        </Switch>
                    </div>

                    <div v-if="employeeLogin" class="text-center">
                        <strong>In Progress please use user login for now.</strong>
                    </div>


                    <div>
                        <breeze-label for="phone" value="Phone"/>
                        <breeze-input id="phone" type="text" class="mt-1 block w-full" v-model="form.phone" required
                                      autofocus
                                      autocomplete="phone"/>
                    </div>
                    <div v-if="!employeeLogin" class="space-y-1">
                        <breeze-label
                            for="password"
                            value="Password"
                            class="block text-sm font-medium text-gray-700"
                        />
                        <div class="mt-1">
                            <breeze-input
                                id="password"
                                type="password"
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                            />
                        </div>
                    </div>
                    <div v-else>
                        <breeze-button
                            typeof="button"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Send OTP
                        </breeze-button>
                    </div>
                    <div class="mt-2">
                        <breeze-validation-errors/>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <label class="ml-2 block text-sm text-gray-900">
                                <breeze-checkbox
                                    name="remember"
                                    v-model:checked="form.remember"
                                />
                                <span class="ml-2 text-sm text-gray-600">Remember me</span>
                            </label>
                        </div>
                        <div class="text-sm">
                            <inertia-link
                                v-if="canResetPassword"
                                :href="route('password.request')"
                                class="font-medium text-indigo-600 hover:text-indigo-500"
                            >
                                Forgot your password?
                            </inertia-link>
                        </div>
                    </div>
                    <breeze-button
                        v-if="!employeeLogin"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Log in
                    </breeze-button>

                    <breeze-button
                        v-else
                        typeof="button"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Verify
                    </breeze-button>

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
</template>
<script>
import BreezeButton from "@/Components/Button";
import BreezeGuestLayout from "@/Layouts/Guest";
import BreezeInput from "@/Components/Input";
import BreezeCheckbox from "@/Components/Checkbox";
import BreezeLabel from "@/Components/Label";
import BreezeValidationErrors from "@/Components/ValidationErrors";
import {Switch} from "@headlessui/vue";

export default {
    layout: BreezeGuestLayout,

    components: {
        BreezeButton,
        BreezeInput,
        BreezeCheckbox,
        BreezeLabel,
        BreezeValidationErrors,
        Switch
    },

    props: {
        auth: Object,
        canResetPassword: Boolean,
        errors: Object,
        status: String,
    },

    data() {
        return {
            employeeLogin: false,
            form: this.$inertia.form({
                phone: '',
                password: '',
                remember: false
            })
        }
    },

    methods: {
        submit() {
            this.form
                .transform(data => ({
                    ...data,
                    remember: this.form.remember ? 'on' : ''
                }))
                .post(this.route('login'), {
                    onFinish: () => this.form.reset('password'),
                })
        }
    }
}
</script>
