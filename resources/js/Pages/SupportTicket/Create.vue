<template>
    <app-layout>
        <div class="mt-4 px-4 sm:px-6 w-full sm:w-3/4 xl:w-2/4 sm:mr-auto">
            <breadcrumb
                :links="[
                {
                    title: 'Support Ticket',
                    url:route('employee.supportTickets.index'),
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
                        Create New Ticket
                    </template>
                    <template #description class="md:col-span-12" >
                        Provide Information
                    </template>
                    <template #form class="md:col-span-12" >
                        <!--Subject-->
                        <div class="col-span-6 sm:col-span-12 mb-2" >
                            <jet-label for="subject" value="Subject *" />
                            <jet-input
                                type="text"
                                v-model="form.subject"
                                class="mt-1 block w-full focus:ring-cyan-100"
                                :class="{ 'border-red-500': form.errors.subject }"
                                autocomplete="name"
                                required
                                autofocus
                            />
                            <JetInputError :message="form.errors.subject" class="mt-2" />
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
    props: {
      employees: Object
    },
    data(){
        return{
            form:this.$inertia.form(
                {
                    subject : null,
                },
                {
                    resetOnSuccess : true,
                }
            ),
        };
    },
    methods:{
        submit(){
            this.form.post(route('employee.supportTickets.store'),{
                preserveScroll: true,
            });
        },
    }
}
</script>
