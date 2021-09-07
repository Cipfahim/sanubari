<template>
    <app-layout>
        <div class="p-4">
            <div class="w-full sm:w-96">
                <jet-form-section @submitted="submit"
                                  class="md:grid md:grid-cols-1 md:gap-0 md:gap-y-6"
                >
                    <template #title class="md:col-span-12">
                        Create New Location
                    </template>
                    <template #description class="md:col-span-12" >
                        Provide Location Details
                    </template>
                    <template #form class="md:col-span-12" >
<!--                        Name-->
                        <div class="col-span-6 sm:col-span-12 -mx-4" >
                            <jet-label for="name" value="Location Name *" />
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
import AppLayout from "@/Layouts/SettingLayout";
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
                },
                {
                    resetOnSuccess : true,
                }
            ),
        };
    },
    methods:{
        submit(){
          this.form.post(route('locations.store'),{
              preserveScroll: true,
          });
        },
    }
}
</script>
