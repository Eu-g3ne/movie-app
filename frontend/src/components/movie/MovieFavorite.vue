<script
  setup
  lang="ts"
>
const props = defineProps<{
  favorite: boolean;
  readonly: boolean;
}>();

const emit = defineEmits<{
  (e: "update:favorite", value: boolean): void;
}>();
</script>
<template>
  <div class="relative bg-dark/80 h-12 aspect-square rounded-xl group flex">
    <button
      v-if="!readonly"
      class="absolute inset-0 w-full h-full z-100"
      @click="emit('update:favorite', !favorite)"
    ></button>
    <svg
      xmlns="http://www.w3.org/2000/svg"
      class="h-8 w-8 m-auto duration-300"
      :class="{
        'group-hover:duration-200 group-hover:scale-125 group-active:scale-[2]':
          !readonly,
      }"
      :fill="favorite ? 'white' : 'none'"
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
        v-if="favorite && !readonly"
        d="M 10 6 14 8 10 13 14 13 10 18 L 14 20"
        stroke="black"
        stroke-width="2"
      />
    </svg>
  </div>
</template>
<style
  lang="scss"
  scoped
></style>
