<script
  setup
  lang="ts"
>
import { storeToRefs } from "pinia";
import { useMovieStore } from "@/stores/index";
import { onMounted } from "vue";

const props = defineProps<{
  slug: string;
}>();

const { movie } = storeToRefs(useMovieStore());
const { getMovieBySlug } = useMovieStore();

onMounted(() => {
  // getMovieBySlug(props.slug);
});
</script>
<template>
  <div>
    <div class="flex flex-col justify-around items-center p-5">
      <div
        class="fixed w-screen h-screen inset-0 -z-1 opacity-5"
        :style="{
          background: `url(${movie.image}) center center / cover no-repeat fixed`,
        }"
      ></div>
      <div>{{ movie.title }}</div>
      <div>
        <p>
          {{ movie.status }}
        </p>
        <p>
          {{ movie.type }}
        </p>
      </div>
      <div>Footer</div>
    </div>
  </div>
</template>
<style
  lang="scss"
  scoped
></style>
