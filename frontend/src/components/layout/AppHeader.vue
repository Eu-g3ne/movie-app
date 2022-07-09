<script
  setup
  lang="ts"
>
import { useScrollEffect } from "@/composables/helpers";
import SwitchButton from "../base/SwitchButton.vue";

useScrollEffect();
</script>

<template>
  <header
    id="navbar"
    class="fixed top-0 left-0 w-screen h-20 flex items-center duration-500 bg-dark z-10"
  >
    <router-link
      class="flex items-center mx-auto h-full"
      to="/"
    >
      <img
        class="h-16 w-full"
        src="@/assets/icons/logo.png"
        alt="Logo"
      />
    </router-link>
    <div class="mr-16">
      <SwitchButton />
    </div>
  </header>
</template>
