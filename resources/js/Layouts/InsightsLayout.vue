<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import LanguageSelector from "@/Components/LanguageSelector.vue";
import NavIcon from "@/Components/NavIcon.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { FilmIcon, HomeIcon } from "@heroicons/vue/24/solid";
import { Link, usePage } from "@inertiajs/inertia-vue3";
import { trans } from "laravel-vue-i18n";
import { computed, ref, watch } from "vue";
import { useToast } from "vue-toastification";

const showingNavigationDropdown = ref(false);

var active_dashboard = computed(() => route().current("insights.dashboard"));
var active_beamer = computed(() => route().current("insights.beamer"));

const toast = useToast();

watch(usePage().props, async () => {
  let flash = usePage().props.value.flash;
  if (flash.success) {
    toast.success(flash.success);
  }
  if (flash.error) {
    toast.error(flash.error);
  }
  if (flash.info) {
    toast.info(flash.info);
  }
  if (flash.warning) {
    toast.warning(flash.warning);
  }
});
</script>

<template>
  <div>
    <div class="min-h-screen bg-gray-100">
      <div class="w-full">
        <nav class="bg-white border-b border-gray-100">
          <!-- Primary Navigation Menu -->
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
              <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                  <Link :href="route('insights.dashboard')">
                    <ApplicationLogo class="block h-9 w-auto" />
                  </Link>
                </div>

                <!-- ### Navigation Links ### -->

                <!-- Dashboard -->
                <div class="hidden space-x-8 sm:ml-8 sm:-my-px lg:ml-10 sm:flex">
                  <NavLink :href="route('insights.dashboard')" :active="active_dashboard">
                    <div class="flex flex-row">
                      <NavIcon class="h-6 w-6" :active="active_dashboard">
                        <HomeIcon></HomeIcon>
                      </NavIcon>
                      <span class="ml-2 hidden lg:flex">{{ trans("nav.dashboard") }}</span>
                    </div>
                  </NavLink>
                </div>

                <!-- Beamer -->
                <div class="hidden space-x-8 sm:ml-8 sm:-my-px lg:ml-10 sm:flex">
                  <NavLink :href="route('insights.beamer')" :active="active_beamer">
                    <div class="flex flex-row">
                      <NavIcon class="h-6 w-6" :active="active_beamer">
                        <FilmIcon></FilmIcon>
                      </NavIcon>
                      <span class="ml-2 hidden lg:flex">{{ trans("nav.beamer_accesses") }}</span>
                    </div>
                  </NavLink>
                </div>
              </div>

              <div class="hidden sm:flex sm:items-center sm:ml-6">
                <div class="pr-4">
                  <LanguageSelector></LanguageSelector>
                </div>

                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                  <Dropdown align="right" width="48">
                    <template #trigger>
                      <span class="inline-flex rounded-md py-6">
                        <button
                          type="button"
                          class="inline-flex items-center px-3 border border-transparent text-base leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                        >
                          {{ $page.props.auth.user.name }}

                          <svg
                            class="ml-2 -mr-0.5 h-4 w-4"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                          >
                            <path
                              fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd"
                            />
                          </svg>
                        </button>
                      </span>
                    </template>

                    <template #content>
                      <DropdownLink :href="route('insights.logout')" method="post" as="button">
                        Log Out
                      </DropdownLink>
                    </template>
                  </Dropdown>
                </div>
              </div>

              <!-- Hamburger -->
              <div class="-mr-2 flex items-center sm:hidden">
                <div class="pr-10">
                  <LanguageSelector></LanguageSelector>
                </div>
                <button
                  @click="showingNavigationDropdown = !showingNavigationDropdown"
                  class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                >
                  <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path
                      :class="{ 'hidden': showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown }"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"
                    />
                    <path
                      :class="{ 'hidden': !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"
                    />
                  </svg>
                </button>
              </div>
            </div>
          </div>

          <!-- Responsive Navigation Menu -->
          <div :class="{ 'block': showingNavigationDropdown, 'hidden': !showingNavigationDropdown }" class="sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
              <!-- Dashboard -->
              <ResponsiveNavLink :href="route('insights.dashboard')" :active="active_dashboard">
                <div class="flex flex-row">
                  <NavIcon class="h-6 w-6" :active="active_dashboard">
                    <HomeIcon></HomeIcon>
                  </NavIcon>
                  <span class="ml-2">{{ trans("nav.dashboard") }}</span>
                </div>
              </ResponsiveNavLink>
            </div>

            <div class="pt-2 pb-3 space-y-1">
              <!-- Beamer -->
              <ResponsiveNavLink :href="route('insights.beamer')" :active="active_beamer">
                <div class="flex flex-row">
                  <NavIcon class="h-6 w-6" :active="active_beamer">
                    <FilmIcon></FilmIcon>
                  </NavIcon>
                  <span class="ml-2">{{ trans("nav.beamer_accesses") }}</span>
                </div>
              </ResponsiveNavLink>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
              <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ $page.props.auth.user.name }}</div>
                <div class="font-medium text-base text-gray-500">{{ $page.props.auth.user.email }}</div>
              </div>

              <div class="mt-3 space-y-1">
                <ResponsiveNavLink class="w-full text-left" :href="route('insights.logout')" method="post" as="button">
                  Log Out
                </ResponsiveNavLink>
              </div>
            </div>
          </div>
        </nav>

        <!-- Page Heading -->
        <header class="bg-white shadow" v-if="$slots.header">
          <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 sm:px-8">
            <slot name="header" />
          </div>
        </header>
      </div>

      <div>
        <!-- Page Content -->
        <main>
          <slot />
        </main>
      </div>
    </div>
  </div>
</template>
