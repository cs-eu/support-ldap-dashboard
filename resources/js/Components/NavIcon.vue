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
    ? "h-6 w-6 text-indigo-600 transition  duration-150 ease-in-out"
    : "h-6 w-6 text-gray-500 transition  duration-150 ease-in-out"
);
</script>

<template>
  <div :class="classes">
    <slot :class="props.contentClasses" />
  </div>
</template>
