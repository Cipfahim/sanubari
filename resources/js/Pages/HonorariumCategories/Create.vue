<template>
  <app-layout>
    <div class="mt-4 px-4 sm:px-6 w-full sm:w-3/4 xl:w-2/4 sm:mr-auto">
      <breadcrumb
        :links="[
          {
            title: 'Honorarium Categories',
            url: route('honorarium-categories.index'),
          },
          {
            title: 'Create',
            active: true,
          },
        ]"
      />
      <div class="mt-10 sm:mt-0">
        <jet-form-section
          @submitted="submit"
          class="md:grid md:grid-cols-1 md:gap-0 md:gap-y-6"
        >
          <template #title class="md:col-span-12">
            Create New Category
          </template>

          <template #description class="md:col-span-12">
            Provide category details.
          </template>

          <template #form class="md:col-span-12">
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

            <!-- Description -->
            <div class="col-span-6 sm:col-span-12">
              <jet-label for="description" value="Description" />
              <jet-input
                id="description"
                type="text"
                v-model="form.description"
                class="mt-1 block w-full focus:ring-cyan-100"
                :class="{ 'border-red-500': form.errors.description }"
              />
              <jet-input-error
                :message="form.errors.description"
                class="mt-2"
              />
            </div>

            <!-- Status -->
            <div class="col-span-6 sm:col-span-4">
              <label class="flex items-center">
                <jet-checkbox
                  name="status"
                  v-model:checked="form.status"
                  class="text-cyan-600 shadow-sm focus:border-cyan-300 focus:ring-cyan-200"
                />
                <span class="ml-2 text-sm text-gray-600"
                  >Status: {{ form.status ? "Active" : "Inactive" }}</span
                >
              </label>
              <jet-input-error :message="form.errors.status" class="mt-2" />
            </div>
          </template>

          <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
              Created.
            </jet-action-message>

            <jet-button
              :class="{ 'opacity-25': form.processing }"
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
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetCheckbox from "@/Jetstream/Checkbox";

export default {
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
    JetCheckbox,
  },
  data() {
    return {
      form: this.$inertia.form(
        {
          name: null,
          description: null,
          status: null,
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
      this.form.post(route("honorarium-categories.store"), {
        preserveScroll: true,
      });
    },
  },
};
</script>
