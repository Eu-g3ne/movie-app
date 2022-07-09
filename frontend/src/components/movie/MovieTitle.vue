<script
  setup
  lang="ts"
>
const props = defineProps<{
  title: string;
  readonly: boolean;
}>();

const emit = defineEmits<{
  (e: "update:title", value: string): void;
}>();
</script>
<template>
  <Transition
    name="fade"
    mode="out-in"
    :duration="300"
  >
    <span v-if="readonly">{{ title }}</span>
    <input
      v-else
      type="text"
      maxlength="128"
      :value="title"
      @input="emit('update:title', ($event.target as HTMLInputElement).value)"
  /></Transition>
</template>
<style
  lang="scss"
  scoped
>
input {
  @include editable-border;
}

input,
span {
  @apply bg-dark/0 font-normal sm:font-semibold ml-0 mr-auto text-start text-3xl w-full tracking-[2px];
}
span {
  @apply p-2;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.2s;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

.fade-leave-from .fade-enter-to {
  opacity: 0;
}
</style>
