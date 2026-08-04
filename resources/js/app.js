import "./bootstrap";

import { createApp } from "vue";
import { createPinia } from "pinia";

import App from "./App.vue";
import router from "./router";

import LanguageSwitcher from "./components/LanguageSwitcher.vue";

import Swal from "sweetalert2";

window.Swal = Swal;

// Create Vue App
const app = createApp(App);

// Pinia
app.use(createPinia());

// Vue Router
app.use(router);

// Global Components
app.component("language-switcher", LanguageSwitcher);

// Mount Vue
app.mount("#app");

// Dark Mode
const themeToggleDarkIcon = document.getElementById("theme-toggle-dark-icon");

const themeToggleLightIcon = document.getElementById("theme-toggle-light-icon");

if (themeToggleDarkIcon && themeToggleLightIcon) {
    if (
        localStorage.getItem("color-theme") === "dark" ||
        (!("color-theme" in localStorage) &&
            window.matchMedia("(prefers-color-scheme: dark)").matches)
    ) {
        themeToggleLightIcon.classList.remove("hidden");
    } else {
        themeToggleDarkIcon.classList.remove("hidden");
    }

    const themeToggleBtn = document.getElementById("theme-toggle");

    if (themeToggleBtn) {
        themeToggleBtn.addEventListener("click", function () {
            themeToggleDarkIcon.classList.toggle("hidden");

            themeToggleLightIcon.classList.toggle("hidden");

            if (localStorage.getItem("color-theme")) {
                if (localStorage.getItem("color-theme") === "light") {
                    document.documentElement.classList.add("dark");

                    localStorage.setItem("color-theme", "dark");
                } else {
                    document.documentElement.classList.remove("dark");

                    localStorage.setItem("color-theme", "light");
                }
            } else {
                if (document.documentElement.classList.contains("dark")) {
                    document.documentElement.classList.remove("dark");

                    localStorage.setItem("color-theme", "light");
                } else {
                    document.documentElement.classList.add("dark");

                    localStorage.setItem("color-theme", "dark");
                }
            }
        });
    }
}
