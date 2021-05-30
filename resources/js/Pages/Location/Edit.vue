<template>
    <app-layout>
        <div class="mt-4 px-4 sm:px-6 w-full sm:w-3/4 xl:w-2/4 sm:mr-auto">
            <breadcrumb
                :links="[
          {
            title: 'Locations',
            url: route('locations.index'),
          },
          {
            title: 'Edit',
            active: true,
          },
        ]"
            />
            <div class="mt-10 sm:mt-0">
                <jet-form-section @submitted="submit">
                    <template #title> Update Location </template>

                    <template #description> Provide Location details. </template>

                    <template #form>
                        <!-- Name -->
                        <div class="col-span-6 sm:col-span-12">
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

                    </template>

                    <template #actions>
                        <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                            Saved.
                        </jet-action-message>

                        <jet-button
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
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
import AppLayout from "@/Layouts/App";
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
        locations: Object,
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
                    name: this.locations.name,
                },
                {
                    resetOnSuccess: true,
                }
            ),
            logoPreview: null,
        };
    },
    methods: {
        submit() {
            this.form.post(
                route("locations.update", this.locations.id),
                {
                    preserveScroll: true,
                }
            );
        },
    },
};
</script>
