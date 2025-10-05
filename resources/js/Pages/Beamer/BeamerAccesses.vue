<script setup>
import PrimaryButtonLink from "@/Components/PrimaryButtonLink.vue";
import InsightsLayout from "@/Layouts/InsightsLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { trans } from "laravel-vue-i18n";
import { computed } from "vue";

let { beamerAccess } = defineProps({
  beamerAccess: Object,
});

const title = computed(() => trans("nav.beamer_accesses"));
</script>

<template>
  <Head :title="title" />

  <InsightsLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ title }}
      </h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <div class="overflow-x-auto">
              <table class="min-w-full table-fixed">
                <thead class="border-b">
                  <tr>
                    <th scope="col" class="w-2/3 text-base font-semibold text-gray-900 px-2 md:px-6 py-4 text-left">
                      {{ trans("beamer.name") }}
                    </th>
                    <th
                      scope="col"
                      class="min-w-[25px] text-base font-semibold text-gray-900 px-2 md:px-6 py-4 text-center"
                    >
                      {{ trans("beamer.accessed_at") }}
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="(access, index) in beamerAccess"
                    class="border-b"
                    :class="{ 'bg-gray-200': (index + 1) % 2 }"
                  >
                    <td class="text-base text-gray-800 font-light px-2 md:px-6 py-2 whitespace-normal">
                      {{ access.name }}
                    </td>
                    <td class="text-base text-gray-800 font-light px-2 md:px-6 py-2 whitespace-normal text-center">
                      {{ access.accessed_at }}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </InsightsLayout>
</template>
