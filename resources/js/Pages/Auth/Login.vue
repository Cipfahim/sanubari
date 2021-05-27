<template>
    <breeze-validation-errors class="mb-4"/>

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>

    <form @submit.prevent="submit">
        <div>
            <breeze-label for="phone" value="Phone"/>
            <breeze-input id="phone" type="text" class="mt-1 block w-full" v-model="form.phone" required autofocus
                          autocomplete="phone"/>
        </div>

        <div class="mt-4">
            <breeze-label for="password" value="Password"/>
            <breeze-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                          autocomplete="current-password"/>
        </div>

        <div class="block mt-4">
            <label class="flex items-center">
                <breeze-checkbox name="remember" v-model:checked="form.remember"/>
                <span class="ml-2 text-sm text-gray-600">Remember me</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <inertia-link v-if="canResetPassword" :href="route('password.request')"
                          class="underline text-sm text-gray-600 hover:text-gray-900">
                Forgot your password?
            </inertia-link>

            <breeze-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Log in
            </breeze-button>
        </div>

        <div class="flex flex-col items-center mt-4" v-if="$page.props.app.env === 'local'">
            <p>Or continue with </p> <br>
            <inertia-link :href="route('dev-login')">
                <breeze-button>
                    Developer Account
                </breeze-button>
            </inertia-link>
        </div>
    </form>
</template>

<script>
import BreezeButton from '@/Components/Button'
import BreezeGuestLayout from "@/Layouts/Guest"
import BreezeInput from '@/Components/Input'
import BreezeCheckbox from '@/Components/Checkbox'
import BreezeLabel from '@/Components/Label'
import BreezeValidationErrors from '@/Components/ValidationErrors'

export default {
    layout: BreezeGuestLayout,

    components: {
        BreezeButton,
        BreezeInput,
        BreezeCheckbox,
        BreezeLabel,
        BreezeValidationErrors
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
