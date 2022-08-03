<script
  setup
  lang="ts"
>
import { useScrollEffect } from "@/composables/helpers";
import SwitchButton from "@/components/base/SwitchButton.vue";
import BaseButton from "@/components/base/BaseButton.vue";
import { MovieAPI } from "@/api/index";
import router from "@/router";

useScrollEffect();

function logout() {
  MovieAPI.logout().then(() => {
    localStorage.removeItem("apiToken");
  });
  router.push("/login");
}
</script>

<template>
  <header
    id="navbar"
    class="fixed top-0 left-0 w-screen h-20 duration-500 bg-dark z-10"
  >
    <div class="h-full flex flex-row justify-center items-center mx-8">
      <div class="w-24 h-8 mr-auto">
        <BaseButton
          class="h-full bg-light rounded-3xl"
          @click="logout"
          >Logout</BaseButton
        >
      </div>
      <router-link
        class="flex items-center h-full"
        to="/"
      >
        <img
          class="h-16 w-full object-scale-down"
          src="@/assets/icons/logo.png"
          alt="Logo"
        />
      </router-link>
      <SwitchButton class="ml-auto" />
    </div>
  </header>
</template>
