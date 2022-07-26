<script
  setup
  lang="ts"
>
import type { Movie } from "@/models/Movie";
import MovieRating from "@/components/movie/MovieRating.vue";
import MovieFavorite from "../movie/MovieFavorite.vue";
import { computed } from "vue";

const props = defineProps<{
  movie: Movie;
}>();

const getEpisode = computed(() => {
  return `${props.movie.episode}/${props.movie.total_episodes}`;
});
</script>
<template>
  <div
    class="relative hover:scale-105 duration-150 flex flex-col gap-2 justify-start"
  >
    <router-link :to="movie.slug">
      <figure
        class="relative flex w-full h-[270px] max-w-2xl v-sm:min-w-[172px]"
      >
        <img
          class="absolute rounded-xl object-cover w-full h-full"
          :src="movie.image.poster"
          alt=""
        />
        <figcaption
          class="absolute text-center w-full h-full p-2 flex flex-row justify-between gap-1 grow shrink basis-0"
        >
          <MovieRating
            class="self-end"
            :rating="movie.rating"
            readonly
          />
          <span
            class="w-20 bg-dark/90 p-2 rounded-xl h-min self-end content-center"
          >
            {{ getEpisode }}
          </span>
          <MovieFavorite
            :favorite="movie.is_favorite"
            readonly
          />
        </figcaption>
      </figure>
    </router-link>
    <div>
      <p class="text-center">{{ movie.title }}</p>
    </div>
  </div>
</template>

<style
  scoped
  lang="scss"
></style>
