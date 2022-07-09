<script
  setup
  lang="ts"
>
import { useMovieStore } from "@/stores/index";

import CardItem from "@/components/card/CardItem.vue";
import { storeToRefs } from "pinia";

const { filteredMovies: movies } = storeToRefs(useMovieStore());
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
  </div>
</template>

<style
  lang="scss"
  scoped
>
.card-grid {
  @apply grid grid-cols-1 gap-6 my-10 xxl:grid-cols-7 xl:grid-cols-6 lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 v-sm:grid-cols-2;
}
</style>
