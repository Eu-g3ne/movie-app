<script
  setup
  lang="ts"
>
const props = defineProps<{
  rating: number;
  readonly?: boolean;
}>();

const emit = defineEmits<{
  (e: "update:rating", value: number): void;
}>();

const getValue = (e: HTMLInputElement): number => {
  return parseInt(e.value);
};

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
    class="bg-dark/80 rounded-xl w-24 duration-700 py-2 overflow-hidden max-h-12"
    :class="{ 'hover:max-h-96 focus-within:max-h-96 scroll': !readonly }"
    v-on="{ wheel: readonly ? null : updateRating }"
  >
    <span class="bg-dark/0 my-auto text-xl text-center align-middle">
      {{ rating }}
    </span>
    <svg
      xmlns="http://www.w3.org/2000/svg"
      class="h-8 w-8 my-auto inline"
      viewBox="0 0 20 20"
      fill="currentColor"
    >
      <path
        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
      />
    </svg>
    <template v-if="!readonly">
      <input
        ref="ratingInput"
        class="mt-2 w-full h-20"
        id="description"
        type="range"
        orient="vertical"
        min="0"
        max="10"
        step="1"
        :value="rating"
        @input="emit('update:rating', getValue(($event.target as HTMLInputElement)))"
      />
    </template>
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
