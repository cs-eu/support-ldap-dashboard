<script setup>
import DropDown from "@/Components/Dropdown.vue";
import { computed, onMounted, onUnmounted, ref } from "vue";

const props = defineProps({
  align: {
    default: "right",
  },
  width: {
    default: "48",
  },
  contentClasses: {
    default: () => ["py-1", "bg-white"],
  },
  active: {
    default: false,
  },
});

const classes = computed(() =>
  props.active
    ? "inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-base font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition  duration-150 ease-in-out"
    : "inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-base font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
);
</script>

<template>
  <div :class="classes">
    <DropDown :align="props.align" :width="props.width">
      <template #trigger>
        <slot name="trigger" />
      </template>

      <template #content :class="props.contentClasses">
        <slot name="content" />
      </template>
    </DropDown>
  </div>
</template>
