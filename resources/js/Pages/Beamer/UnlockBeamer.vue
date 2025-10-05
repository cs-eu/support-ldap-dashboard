<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { trans } from "laravel-vue-i18n";
import { computed } from "vue";

const title = computed(() => trans("nav.beamer"));

const form = useForm({
  consent: false,
});

const submit = () => {
  form.post(route("beamer"), {
    onFinish: () => form.consent = false,
  });
};
</script>

<template>
  <Head :title="title" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ title }}
      </h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <form @submit.prevent="submit">
              <div>
                <label for="consent" class="flex items-center">
                  <Checkbox id="constent" v-model:checked="form.consent" />
                  <span class="ml-2 text-base text-gray-600">
                    {{ trans("beamer.consent") }}
                  </span>
                </label>
                <InputError class="mt-2" :message="form.errors.consent" />
              </div>

              <div class="flex items-center justify-start mt-4">
                <PrimaryButton class="ml-4">
                  {{ trans("beamer.unlock") }}
                </PrimaryButton>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
