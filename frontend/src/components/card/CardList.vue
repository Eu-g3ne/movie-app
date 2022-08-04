<script
  setup
  lang="ts"
>
import { useMovieStore } from "@/stores/index";

import CardItem from "@/components/card/CardItem.vue";
import PlusButton from "@/components/buttons/PlusButton.vue";
import { storeToRefs } from "pinia";

const { filtered: movies } = storeToRefs(useMovieStore());
</script>

<template>
  <div class="card-grid">
    <template
      v-for="movie in movies"
      :key="movie.id"
    >
      <CardItem
        class="justify-self-stretch transition-transform duration-500"
        :movie="movie"
      />
    </template>
    <div class="place-self-center group">
      <router-link to="create">
        <PlusButton
          class="w-20 h-20 duration-300 group-hover:scale-150 group-hover:rotate-180"
        />
      </router-link>
    </div>
  </div>
</template>

<style
  lang="scss"
  scoped
>
.card-grid {
  @apply grid auto-rows-fr grid-cols-1 gap-6 my-10 xxl:grid-cols-7 xl:grid-cols-6 lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 v-sm:grid-cols-2;
}
</style>
