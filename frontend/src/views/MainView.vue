<script
  setup
  lang="ts"
>
import FilteringGroup from "@/components/layout/FilteringGroup.vue";
import CardList from "@/components/card/CardList.vue";

import { useMovieStore } from "@/stores/index";
import { onBeforeMount } from "vue";
const { getAllMovies } = useMovieStore();

// onBeforeMount(() => {
//   getAllMovies();
// });
</script>

<template>
  <div class="2xl:container px-4">
    <FilteringGroup />
    <CardList />
  </div>
</template>
