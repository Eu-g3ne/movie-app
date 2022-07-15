<script
  setup
  lang="ts"
>
import { computed } from "vue";

const props = defineProps<{
  rating: number;
  readonly?: boolean;
}>();

const emit = defineEmits<{
  (e: "update:rating", value: number): void;
}>();

const getValue = (e: Event): number => {
  return parseInt((e.target as HTMLInputElement).value);
};

const collapseInput = computed<Object>(() => ({
  "group-hover:max-h-96": !props.readonly,
  "group-focus-within:max-h-96": !props.readonly,
  "h-max": !props.readonly,
  "h-full": props.readonly,
}));

function updateRating(e: WheelEvent) {
  if (e.deltaY < 0 && props.rating < 10) {
    emit("update:rating", props.rating + 1);
  } else if (e.deltaY > 0 && props.rating > 0) {
    emit("update:rating", props.rating - 1);
  }
  e.preventDefault();
}
</script>
<template>
  <div
    class="relative w-16 h-12 group"
    v-on="{ wheel: readonly ? null : updateRating }"
  >
    <div
      class="absolute inset-0 bg-dark/80 max-h-12 min-w-fit rounded-xl py-3 sm:py-2 overflow-hidden duration-700"
      :class="collapseInput"
    >
      <div class="flex flex-row justify-center align-center">
        <div class="bg-dark/0 w-6 my-auto text-center align-middle">
          {{ rating }}
        </div>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-6 w-6 my-auto"
          viewBox="0 0 20 20"
          fill="currentColor"
        >
          <path
            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
          />
        </svg>
      </div>
      <template v-if="!readonly">
        <input
          class="mt-3 w-full h-20"
          id="description"
          type="range"
          orient="vertical"
          min="0"
          max="10"
          step="1"
          :value="rating"
          @input="emit('update:rating', getValue($event))"
        />
      </template>
    </div>
  </div>
</template>
<style
  lang="scss"
  scoped
>
input[type="range"][orient="vertical"] {
  writing-mode: bt-lr;
  -webkit-appearance: slider-vertical;
}
</style>
