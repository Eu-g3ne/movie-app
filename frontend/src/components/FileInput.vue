<script
  setup
  lang="ts"
>
import PlusButton from "./buttons/PlusButton.vue";

const props = defineProps<{
  caption: string;
  image: Object | string;
  readonly?: boolean;
}>();

const emit = defineEmits<{
  (e: "update:image", value: File): void;
}>();

function changeValue(event: Event) {
  const target = event.target as HTMLInputElement;
  if (target.files?.length) {
    const fl = target.files[0];
    emit("update:image", fl); //file.url for show
  }
}
</script>
<template>
  <div class="h-full flex flex-col">
    <h1 class="text-base">{{ caption }}</h1>
    <div
      class="relative flex flex-col gap-2 justify-center items-center h-full w-full text-center align-middle border-2 rounded-3xl border-white border-dashed bg-dark/60 group duration-300 hover:border-red-800 overflow-hidden"
    >
      <input
        ref="fileinput"
        class="absolute inset-0 h-full w-full z-100 opacity-0 cursor-pointer"
        type="file"
        accept=".jpg, .jpeg, .png"
        id="fileinput"
        @change="changeValue"
      />
      <label
        class="label text-center align-middle cursor-pointer text-sm"
        for="fileinput"
      ></label>
      <PlusButton
        class="duration-300 group-hover:scale-150 group-hover:rotate-180"
      />
    </div>
  </div>
</template>
<style
  lang="scss"
  scoped
></style>
