<script setup>
import { Link } from "@inertiajs/inertia-vue3";
</script>

<template>
  <div class="flex">
    <div v-for='(locale, key) in $page.props.localization["locales"]' class="ml-4">
      <span v-if="$page.props.localization['current_locale'] === locale">
        {{ key }}
      </span>
      <a v-else :href="route('language', [locale])">
        {{ key }}
      </a>
    </div>
  </div>
</template>
