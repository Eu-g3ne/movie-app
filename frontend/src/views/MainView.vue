<script
  setup
  lang="ts"
>
import FilteringGroup from "@/components/layout/FilteringGroup.vue";
import CardList from "@/components/Card/CardList.vue";

import { useMovieStore } from "@/stores/index";
import { onMounted } from "vue";
const { getAllMovies } = useMovieStore();

onMounted(() => {
  getAllMovies();
});
</script>

<template>
  <div class="2xl:container px-4">
    <FilteringGroup />
    <CardList />
  </div>
</template>
