<script
  setup
  lang="ts"
>
import MovieTitle from "@/components/movie/MovieTitle.vue";
import MovieDescription from "@/components/movie/MovieDescription.vue";
import MovieFavorite from "@/components/movie/MovieFavorite.vue";
import MovieEpisode from "@/components/movie/MovieEpisode.vue";
import MovieRating from "@/components/movie/MovieRating.vue";
import MovieTags from "@/components/movie/MovieTags.vue";
import MovieSelect from "@/components/movie/MovieSelect.vue";
import BaseButton from "@/components/base/BaseButton.vue";
import FileInput from "@/components/FileInput.vue";
import { storeToRefs } from "pinia";
import { useMovieStore } from "@/stores/index";
import type { Movie } from "@/models/Movie";

const props = defineProps<{
  slug: string;
}>();
const { updateMovie } = useMovieStore();
const { movie, isReadonly, editMode } = storeToRefs(useMovieStore());

function saveChanges(movie: Movie) {
  updateMovie(movie, props.slug);
  editMode.value = false;
}
</script>
<template>
  <div class="text-sm sm:text-lg p-5">
    <div class="relative z-0 rounded-xl shadow-2xl">
      <!-- background image -->
      <div
        class="absolute w-full h-full rounded-xl -z-[200] opacity-20 backdrop"
        :style="{ 'background-image': `url(${movie.image.background})` }"
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
          class="flex flex-row gap-2 justify-between sm:justify-end items-center 2xl:col-span-1 sm:col-span-3 col-span-12"
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
        <MovieSelect
          class="v-sm:col-span-3 col-span-12 self-end"
          title="Type"
          v-model:value="movie.type"
          :values="['anime', 'film', 'serial']"
          :readonly="isReadonly"
        />
        <MovieSelect
          class="v-sm:col-span-3 col-span-12 self-end"
          title="Status"
          v-model:value="movie.status"
          :values="['desired', 'finished', 'ongoing']"
          :readonly="isReadonly"
        />
        <MovieEpisode
          class="v-sm:col-span-3 col-span-12 self-end"
          title="Episode"
          v-model:value="movie.episode"
          :readonly="isReadonly"
          :max="movie.total_episodes"
        />
        <MovieEpisode
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

        <div class="col-span-12 sm:col-span-5 self-end">
          <MovieTags
            v-model:tags="movie.categories"
            :readonly="isReadonly"
          />
        </div>
        <Transition
          name="fade"
          mode="out-in"
          :duration="300"
        >
          <template v-if="!isReadonly">
            <div
              class="col-span-12 sm:col-span-5 justify-self-center self-center w-full h-64 v-sm:h-full v-sm:min-h-[8rem] max-h-[16rem] flex flex-col v-sm:flex-row justify-center gap-3"
            >
              <FileInput
                class="flex-1"
                caption="Poster"
                v-model:image="movie.image.poster"
              />

              <FileInput
                class="flex-1"
                caption="Background"
                v-model:image="movie.image.background"
              />
            </div>
          </template>
        </Transition>
        <Transition
          name="fade"
          mode="out-in"
          :duration="300"
        >
          <div
            v-if="!isReadonly"
            class="col-span-12 justify-self-center sm:col-start-11 sm:col-end-13 sm:place-self-end"
          >
            <BaseButton
              class="bg-dark p-3 rounded-xl duration-300 drop-shadow-sm hover:drop-shadow-xl text-ellipsis"
              @click.prevent="saveChanges(movie)"
            >
              Save changes
            </BaseButton>
          </div>
        </Transition>
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
