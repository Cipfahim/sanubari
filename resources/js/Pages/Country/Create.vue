<template>
    <app-layout>
        <div class="mt-4 px-4 sm:px-6 w-full sm:w-3/4 xl:w-2/4 sm:mr-auto">
            <breadcrumb
                :links="[
                {
                    title: 'Countries',
                    url:route('countries.index'),
                },
                {
                    title : 'Create',
                    active: true
                }
            ]"
            />
            <div class="mt-10 sm:mt-0">
                <jet-form-section @submitted="submit"
                                  class="md:grid md:grid-cols-1 md:gap-0 md:gap-y-6"
                >
                    <template #title class="md:col-span-12">
                        Create New Country
                    </template>
                    <template #description class="md:col-span-12" >
                        Provide Country Details
                    </template>
                    <template #form class="md:col-span-12" >
                        <!--                        Name-->
                        <div class="col-span-6 sm:col-span-12 mb-2" >
                            <jet-label for="name" value="Country Name *" />
                            <jet-input
                                type="text"
                                id="name"
                                v-model="form.name"
                                class="mt-1 block w-full focus:ring-cyan-100"
                                :class="{ 'border-red-500': form.errors.name }"
                                autocomplete="name"
                                required
                                autofocus
                            />
                            <JetInputError :message="form.errors.name" class="mt-2" />
                        </div>
                        <!--Country Code-->
                        <div class="col-span-6 sm:col-span-12 mb-2" >
                            <jet-label for="country_code" value="Country Code *" />
                            <jet-input
                                type="number"
                                id="country_code"
                                v-model="form.country_code"
                                class="mt-1 block w-full focus:ring-cyan-100"
                                :class="{ 'border-red-500': form.errors.country_code }"
                                autocomplete="country_code"
                                required
                                autofocus
                            />
                            <JetInputError :message="form.errors.country_code" class="mt-2" />
                        </div>
                        <!--flag-->
                        <div class="col-span-3 my-2">
                            <label for="flag" class="block text-sm font-medium text-gray-700">
                                Flag
                            </label>
                            <div class="mt-1 flex items-center">
                                <span v-if="flagPreview == null"
                                      class="h-12 w-12 p-3 rounded-full overflow-hidden bg-gray-100">
                                  <img class="w-full h-full" src="/images/icon/country.png" alt="Country Placeholder">
                                </span>
                                <div class="mt-2" v-show="flagPreview">
                                    <span class="block rounded-full w-12 h-12"
                                          :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + flagPreview + '\');'">
                                    </span>
                                </div>
                                <input type="file" class="hidden"
                                       ref="photo"
                                       @change="updateFlagPreview">
                                <button type="button"
                                        @click.native.prevent="selectNewFlag"
                                        class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
                                        :class="{ 'border-red-500' : form.errors.flag }">
                                    Change
                                </button>
                            </div>
                            <jet-input-error :message="form.errors.photo" class="mt-2"/>
                        </div>
                    </template>
                    <template #actions >
                        <jet-action-message :on="form.recentlySuccessful" class="mr-3" >
                            Created.
                        </jet-action-message>
                        <jet-button
                            :class="{'opacity-25':form.processing}"
                            :disabled="form.processing"
                            class="bg-cyan-500 hover:bg-cyan-600 focus:outline-none"
                        >
                            Create
                        </jet-button>
                    </template>
                </jet-form-section>
            </div>
        </div>
    </app-layout>

</template>

<script>
import AppLayout from "@/Layouts/App";
import Breadcrumb from "@/Components/Breadcrumb";
import JetFormSection from "@/Jetstream/FormSection";
import JetLabel from "@/Jetstream/Label";
import JetInputError from "@/Jetstream/InputError";
import JetInput from "@/Jetstream/Input";
import JetButton from "@/Jetstream/Button";
import JetActionMessage from "@/Jetstream/ActionMessage";
export default {
    components : {
        Breadcrumb,
        AppLayout,
        JetFormSection,
        JetLabel,
        JetInput,
        JetInputError,
        JetButton,
        JetActionMessage

    },
    data(){
        return{
            form:this.$inertia.form(
                {
                    name : null,
                    country_code: null,
                    flag: null
                },
                {
                    resetOnSuccess : true,
                }
            ),
            flagPreview: null
        };
    },
    methods:{
        submit(){
            if (this.$refs.photo) {
                this.form.flag = this.$refs.photo.files[0]
            }
            this.form.post(route('countries.store'),{
                preserveScroll: true,
            });
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
    }
}
</script>
