<script
  setup
  lang="ts"
>
import AppHeader from "@/components/layout/AppHeader.vue";
import AppFooter from "./components/layout/AppFooter.vue";
import Preloader from "./components/Preloader.vue";
import { useMovieStore } from "@/stores/index";
import { storeToRefs } from "pinia";
const store = useMovieStore();
const { isLoading } = storeToRefs(store);

store.$onAction(({ name, store, args, after, onError }) => {
  isLoading.value = true;

  after((result) => {
    isLoading.value = false;
  });

  onError((error) => {
    console.warn("some error = ", error);
  });
});
</script>

<template>
  <div class="min-h-screen flex flex-col">
    <AppHeader />
    <main class="2xl:container grow shrink pt-24">
      <router-view v-slot="{ Component }">
        <Transition
          name="fade"
          mode="out-in"
        >
          <component
            v-if="!isLoading"
            :is="Component"
            :key="$route.path"
          />
          <Preloader v-else />
        </Transition>
      </router-view>
    </main>
    <AppFooter />
  </div>
</template>

<style lang="scss">
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.2s;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

.fade-leave-from .fade-enter-to {
  opacity: 0;
}

* {
  @apply v-sm:whitespace-normal text-ellipsis;
  textarea {
    @apply whitespace-normal;
  }
}
</style>
