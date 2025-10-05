import "./bootstrap";
import "../css/app.css";

import { Inertia } from "@inertiajs/inertia";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import Multiselect from "@vueform/multiselect";
import Datepicker from "@vuepic/vue-datepicker";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { i18nVue } from "laravel-vue-i18n";
import { I18n } from "laravel-vue-i18n";
import { createApp, h } from "vue";
import VueChartkick from "vue-chartkick";
import { ZiggyVue } from "ziggy-js";
import "chartkick/chart.js";

import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

const appName = window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob("./Pages/**/*.vue")),
  setup({ el, app, props, plugin }) {
    return createApp({ render: () => h(app, props) })
      .use(plugin)
      .use(ZiggyVue, Ziggy)
      .use(i18nVue, {
        resolve: lang => {
          const langs = import.meta.globEager("../../lang/*.json");
          return langs[`../../lang/${lang}.json`].default;
        },
      })
      .use(Toast)
      .use(VueChartkick)
      .component("Datepicker", Datepicker)
      .component("Multiselect", Multiselect)
      .mount(el);
  },
});

InertiaProgress.init({ color: "#4B5563" });

window.I18n = I18n;

let stale = false;

window.addEventListener("popstate", () => {
  stale = true;
});

Inertia.on("navigate", (event) => {
  const page = event.detail.page;
  if (stale) {
    Inertia.get(page.url, {}, { replace: true, preserveState: false });
  }
  stale = false;
});
