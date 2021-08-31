<template>
    <app-layout>
        <div class="p-4">
            <div class="w-full sm:w-96">
                <jet-form-section @submitted="submit">
                    <template #title> Update Country </template>

                    <template #description> Provide Country details. </template>

                    <template #form>
                        <!-- Name -->
                        <div class="col-span-6 sm:col-span-12 mb-2 -mx-4">
                            <jet-label for="name" value="Name *" />
                            <jet-input
                                id="name"
                                type="text"
                                v-model="form.name"
                                class="mt-1 block w-full focus:ring-cyan-100"
                                :class="{ 'border-red-500': form.errors.name }"
                                autocomplete="name"
                                required
                                autofocus
                            />
                            <jet-input-error :message="form.errors.name" class="mt-2" />
                        </div>
                        <!-- Country Code -->
                        <div class="col-span-6 sm:col-span-12 mb-2 -mx-4">
                            <jet-label for="country_code" value="Country Code *" />
                            <jet-input
                                id="country_code"
                                type="text"
                                v-model="form.country_code"
                                class="mt-1 block w-full focus:ring-cyan-100"
                                :class="{ 'border-red-500': form.errors.country_code }"
                                autocomplete="country_code"
                                required
                                autofocus
                            />
                            <jet-input-error :message="form.errors.country_code" class="mt-2" />
                        </div>
                        <!--flag-->
                        <div class="grid grid-cols-3 gap-3 -mx-4">
                            <div class="col-span-3 my-2">
                                <label for="photo" class="block text-sm font-medium text-gray-700">
                                    Flag
                                </label>
                                <div class="mt-1 flex items-center">
                                    <div class="mt-2" v-show="flagPreview">
                                    <span class="block rounded-full w-12 h-12"
                                          :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + flagPreview + '\');'">
                                    </span>
                                    </div>
                                    <div class="mt-2 p-3 h-12 w-12 overflow-hidden rounded-full bg-gray-100" v-show="!flagPreview">
                                        <img :src="country.flag_path ? country.flag_path : '/images/icon/country.png'" alt="Current Country Photo"
                                             class="h-full w-full">
                                    </div>
                                    <input type="file" class="hidden"
                                           ref="photo"
                                           @change="updateFlagPreview">
                                    <button type="button"
                                            @click.native.prevent="selectNewFlag"
                                            class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                            :class="{ 'border-red-500' : form.errors.photo }">
                                        Change
                                    </button>
                                </div>
                                <jet-input-error :message="form.errors.photo" class="mt-2"/>
                            </div>
                        </div>
                    </template>

                    <template #actions>
                        <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                            Saved.
                        </jet-action-message>

                        <jet-button
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                            class="bg-cyan-500 hover:bg-cyan-600 focus:outline-none"
                        >
                            Save
                        </jet-button>
                    </template>
                </jet-form-section>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/SettingLayout";
import Breadcrumb from "@/Components/Breadcrumb";
import JetFormSection from "@/Jetstream/FormSection";
import JetLabel from "@/Jetstream/Label";
import JetInputError from "@/Jetstream/InputError";
import JetInput from "@/Jetstream/Input";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

export default {
    props: {
        country: Object,
    },
    components: {
        AppLayout,
        Breadcrumb,
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
            form: this.$inertia.form(
                {
                    _method: "PUT",
                    name: this.country.name,
                    country_code: this.country.country_code,
                    flag: this.country.flag_path
                },
                {
                    resetOnSuccess: true,
                }
            ),
            flagPreview: null,
        };
    },
    methods: {
        submit() {
            if (this.$refs.photo) {
                this.form.flag = this.$refs.photo.files[0]
            }
            this.form.post(
                route("countries.update", this.country.id),
                {
                    preserveScroll: true,
                }
            );
        },
        selectNewFlag() {
            this.$refs.photo.click();
        },
        updateFlagPreview() {
            const reader = new FileReader();
            reader.onload = (e) => {
                this.flagPreview = e.target.result;
            };
            reader.readAsDataURL(this.$refs.photo.files[0]);
        },
    },
};
</script>
