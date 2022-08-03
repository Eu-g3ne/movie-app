<script
  setup
  lang="ts"
>
import BaseButton from "@/components/base/BaseButton.vue";
import { MovieAPI } from "@/api";
import { reactive } from "vue";
import router from "@/router";

interface User {
  name: string;
  password: string;
}

const user: User = reactive({ name: "", password: "" });

async function login() {
  await MovieAPI.login(user)
    .then((data) => {
      localStorage.setItem("apiToken", data.token);
      router.push("/");
    })
    .catch((error) => {
      if (error.response?.data?.message === "Already authenticated") {
        router.push("/");
      } else {
        router.push("/login");
      }
    });
}
</script>
<template>
  <form
    class="flex flex-col justify-between items-center gap-10 w-min mx-auto"
    @submit.prevent="login"
  >
    <div>
      <label
        for="name"
        class="block text-center pb-5"
        >Name</label
      >
      <input
        class="w-64 rounded-xl bg-dark p-3 border-white border-solid border-2"
        id="name"
        type="text"
        v-model="user.name"
      />
    </div>
    <div>
      <label
        for="password"
        class="block text-center pb-5"
        >Password</label
      >
      <input
        class="w-64 rounded-xl bg-dark p-3 border-white border-solid border-2"
        id="password"
        type="password"
        v-model="user.password"
      />
    </div>
    <div class="w-40 h-8">
      <BaseButton
        class="bg-dark mx-auto rounded-3xl p-5"
        type="submit"
      >
        Login
      </BaseButton>
    </div>
  </form>
</template>
<style
  lang="scss"
  scoped
></style>
