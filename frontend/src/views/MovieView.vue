<script
  setup
  lang="ts"
>
import { computed } from "vue";

import MovieInfo from "@/components/movie/MovieInfo.vue";
import MovieRating from "@/components/movie/MovieRating.vue";
import MovieTitle from "@/components/movie/MovieTitle.vue";
import MovieDescription from "@/components/movie/MovieDescription.vue";
import MovieFavorite from "@/components/movie/MovieFavorite.vue";
import MovieTags from "@/components/movie/MovieTags.vue";
import { storeToRefs } from "pinia";
import { useMovieStore } from "@/stores/index";

const props = defineProps<{
  slug: string;
}>();
const { movie, isReadonly } = storeToRefs(useMovieStore());
</script>
<template>
  <div class="text-sm sm:text-lg p-5">
    <div class="relative z-0 rounded-xl shadow-2xl">
      <!-- background image -->
      <div
        v-if="isReadonly"
        class="absolute w-full h-full rounded-xl -z-[200] opacity-40 backdrop"
        :style="{ 'background-image': `url(${movie.image})` }"
      ></div>
      <div
        v-else
        class="absolute w-full h-full rounded-xl -z-[200] opacity-40 backdrop"
        :style="{ 'background-image': `url(${movie.image})` }"
      ></div>
      <!-- background image -->
      <div
        class="grid grid-cols-12 gap-x-2 gap-y-10 h-auto text-center p-5 items-center"
      >
        <MovieTitle
          class="2xl:col-span-11 sm:col-span-9 col-span-12"
          v-model:title="movie.title"
          :readonly="isReadonly"
        />
        <div
          class="flex flex-row gap-2 sm:justify-end justify-between 2xl:col-span-1 sm:col-span-3 col-span-12"
        >
          <MovieRating
            v-model:rating="movie.rating"
            :readonly="isReadonly"
          />
          <MovieFavorite
            v-model:favorite="movie.is_favorite"
            :readonly="isReadonly"
          />
        </div>
        <MovieInfo
          class="v-sm:col-span-3 col-span-12 self-end"
          title="Type"
          v-model:value="movie.type"
          :readonly="isReadonly"
        />
        <MovieInfo
          class="v-sm:col-span-3 col-span-12 self-end"
          title="Status"
          v-model:value="movie.status"
          :readonly="isReadonly"
        />
        <MovieInfo
          class="v-sm:col-span-3 col-span-12 self-end"
          title="Episode"
          v-model:value="movie.episode"
          :readonly="isReadonly"
          :max="movie.total_episodes"
        />
        <MovieInfo
          class="v-sm:col-span-3 col-span-12 self-end"
          title="Total episodes"
          v-model:value="movie.total_episodes"
          :readonly="isReadonly"
          :min="movie.episode"
        />
        <MovieDescription
          class="col-span-12"
          v-model:description="movie.description"
          :readonly="isReadonly"
        />
        <div class="col-span-12 justify-self-end">
          <MovieTags
            v-model:tags="movie.categories"
            :readonly="isReadonly"
          />
        </div>
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
