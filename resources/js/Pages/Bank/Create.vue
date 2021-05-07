<template>
    <app-layout>
        <div class="mt-4 px-4 sm:px-6 lg:px-8">
            <breadcrumb
                :links="[
                {
                    title: 'Banks',
                    url:route('banks.index'),
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
                        Create New Bank
                    </template>
                    <template #description class="md:col-span-12" >
                        Provide Bank Details
                    </template>
                    <template #form class="md:col-span-12" >
                        <!--Name-->
                        <div class="col-span-6 sm:col-span-12" >
                            <jet-label for="name" value="Bank Name *" />
                            <jet-input
                                type="text"
                                id="name"
                                v-model="form.name"
                                class="mt-1 block w-2/4 focus:ring-cyan-100"
                                :class="{ 'border-red-500': form.errors.name }"
                                autocomplete="name"
                                required
                                autofocus
                            />
                            <JetInputError :message="form.errors.name" class="mt-2" />
                        </div>
                        <!--Swift Code-->
                        <div class="col-span-6 sm:col-span-12" >
                            <jet-label for="name" value="Swift Code *" />
                            <jet-input
                                type="text"
                                id="name"
                                v-model="form.swift_code"
                                class="mt-1 block w-2/4 focus:ring-cyan-100"
                                :class="{ 'border-red-500': form.errors.swift_code }"
                                autocomplete="name"
                                required
                                autofocus
                            />
                            <JetInputError :message="form.errors.swift_code" class="mt-2" />
                        </div>
                    </template>
                    <template #actions >
                        <jet-action-message :on="form.recentlySuccessful" class="mr-3" >
                            Created.
                        </jet-action-message>
                        <jet-button
                            :class="{'opacity-25':form.processing}"
                            :disabled="form.processing"
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
                    swift_code : null,
                },
                {
                    resetOnSuccess : true,
                }
            ),
            logoPreview: null
        };
    },
    methods:{
        submit(){
            this.form.post(route('banks.store'),{
                preserveScroll: true,
            });
        },
    }
}
</script>
