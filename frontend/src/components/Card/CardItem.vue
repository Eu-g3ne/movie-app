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
          :src="movie.image"
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
          <!-- <button
            class="bg-dark/90 p-2 rounded-xl h-12 group self-end"
            @click.prevent="movie.is_favorite = !movie.is_favorite"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-full w-full duration-300 group-hover:duration-200 group-hover:scale-125 group-active:scale-[2]"
              :fill="movie.is_favorite ? 'white' : 'none'"
              viewBox="0 0 24 24"
              stroke="currentColor"
              stroke-width="2"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
              />
              <path
                class="opacity-0 group-hover:opacity-100 duration-500"
                v-if="movie.is_favorite"
                d="M 10 6 14 8 10 13 14 13 10 18 L 14 20"
                stroke="black"
                stroke-width="2"
              />
            </svg>
          </button> -->
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
