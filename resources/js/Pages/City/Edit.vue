<template>
    <SettingLayout>
        <div class="p-4">
            <div class="w-full sm:w-96">
                <jet-form-section @submitted="submit"
                                  class="md:grid md:grid-cols-1 md:gap-0 md:gap-y-6"
                >
                    <template #title class="md:col-span-12">
                        Update City
                    </template>
                    <template #description class="md:col-span-12" >
                        Provide City Details
                    </template>
                    <template #form class="md:col-span-12" >
                        <!--                        Name-->
                        <div class="col-span-6 sm:col-span-12 mb-2 -mx-4" >
                            <jet-label for="name" value="City Name *" />
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
                        <!--Country-->
                        <div class="col-span-6 sm:col-span-12 mb-2 -mx-4" >
                            <jet-label for="country" value="Country Name *" />
                            <select name="country" v-model="form.country"
                                    class="border-gray-300 focus:border-cyan-300 focus:ring focus:ring-cyan-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                                <option value="" disabled>Select Country</option>
                                <option v-for="(country, index) in countries" :key="index" :value="country.id">
                                    {{ country.name }}
                                </option>
                            </select>
                            <jet-input-error :message="form.errors.country" class="mt-2"/>
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
                            Update
                        </jet-button>
                    </template>
                </jet-form-section>
            </div>
        </div>
    </SettingLayout>

</template>

<script>
import SettingLayout from "@/Layouts/SettingLayout";
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
        SettingLayout,
        JetFormSection,
        JetLabel,
        JetInput,
        JetInputError,
        JetButton,
        JetActionMessage

    },
    props: {
        countries: Object,
        city: Object
    },
    data(){
        return{
            form:this.$inertia.form(
                {
                    _method: 'PUT',
                    name : this.city.name,
                    country: this.city.country_id
                },
                {
                    resetOnSuccess : true,
                }
            )
        };
    },
    methods:{
        submit(){
            this.form.post(route('settings.cities.update', this.city),{
                preserveScroll: true
            });
        },
    }
}
</script>
