<script setup>
import { Link } from "@inertiajs/inertia-vue3";
</script>

<template>
  <Link
    class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 active:bg-gray-700 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
  >
    <slot />
  </Link>
</template>
