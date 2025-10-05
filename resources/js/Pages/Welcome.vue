<script setup>
import PrimaryButtonLink from "@/Components/PrimaryButtonLink.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { trans } from "laravel-vue-i18n";
import { computed } from "vue";

const title = computed(() => trans("nav.welcome"));
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
            {{ trans("welcome.text") }}
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
