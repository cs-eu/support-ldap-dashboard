<script setup>
import PrimaryButtonLink from "@/Components/PrimaryButtonLink.vue";
import SecondaryButtonLink from "@/Components/SecondaryButtonLink.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { trans } from "laravel-vue-i18n";
import { computed } from "vue";

const title = computed(() => trans("nav.exit"));
</script>

<template>
  <Head :title="title" />

  <GuestLayout>
    <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">
      {{ trans("auth.logged-out.success") }}
    </h2>

    <div class="flex items-center justify-end mt-4">
      <SecondaryButtonLink :href="route('gitlab.redirect')">
        {{ trans("auth.gitlab") }}
      </SecondaryButtonLink>

      <PrimaryButtonLink class="ml-4" :href="route('welcome')">
        {{ trans("auth.re-login") }}
      </PrimaryButtonLink>
    </div>
  </GuestLayout>
</template>
