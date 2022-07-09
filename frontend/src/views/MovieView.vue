<script
  setup
  lang="ts"
>
import { computed } from "vue";

import ListItem from "@/components/ListItem.vue";
import MovieRating from "@/components/movie/MovieRating.vue";
import MovieTitle from "@/components/movie/MovieTitle.vue";
import MovieDescription from "@/components/movie/MovieDescription.vue";
import { storeToRefs } from "pinia";
import { useMovieStore } from "@/stores/index";
import { capitalize } from "@/composables/helpers";

const props = defineProps<{
  slug: string;
}>();
const { movie, isReadonly } = storeToRefs(useMovieStore());
const cols = computed<Object>(() => {
  return {
    Type: capitalize(movie.value.type),
    Status: capitalize(movie.value.status),
    "Stopped on": movie.value.episode,
    "Total episodes": movie.value.total_episodes,
  };
});
</script>
<template>
  <div class="text-sm sm:text-lg p-5">
    <div class="relative z-0 rounded-xl shadow-2xl min-w-[200px]">
      <!-- background image -->
      <div
        class="absolute w-full h-full rounded-xl -z-[200] opacity-40 backdrop"
        :style="{ 'background-image': `url(${movie.image})` }"
      ></div>
      <!-- background image -->
      <div class="flex flex-col gap-5 h-auto text-center p-5">
        <div
          class="flex flex-col v-sm:flex-row gap-2 justify-between items-start"
        >
          <MovieTitle
            v-model:title="movie.title"
            :readonly="isReadonly"
          />
          <MovieRating
            v-model:rating="movie.rating"
            :readonly="isReadonly"
          />
          <div class="bg-dark/80 rounded-xl w-16 h-12 whitespace-nowrap">
            <button
              class="group w-full h-full"
              @click.prevent="movie.is_favorite = !movie.is_favorite"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-9 m-auto duration-300 group-hover:duration-200 group-hover:scale-125 group-active:scale-[2]"
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
            </button>
          </div>
        </div>
        <div
          class="flex flex-col v-sm:flex-row gap-5 items-center justify-between font-normal"
        >
          <ListItem
            v-for="(value, key) in cols"
            :title="capitalize(key)"
          >
            {{ value }}
          </ListItem>
        </div>
        <MovieDescription
          v-model:description="movie.description"
          :readonly="isReadonly"
        />
      </div>
    </div>
    <div class="p-5">
      You want download this movie?
      <div>go here</div>
      <div>
        <h5>amazing list</h5>
      </div>
    </div>
  </div>
</template>
<style
  lang="scss"
  scoped
>
.backdrop {
  background-position: center;
  background-attachment: fixed;
  background-clip: padding-box;
  background-size: cover;
  background-repeat: no-repeat;
}

h1 {
  @apply text-3xl;
}
</style>
