<script
  setup
  lang="ts"
>
import { ref } from "vue";

const props = defineProps<{
  description: string;
  readonly: boolean;
}>();

const textarea = ref<HTMLElement | null>(null);

const emit = defineEmits<{
  (e: "update:description", value: string): void;
}>();
</script>
<template>
  <div class="text-start text-md">
    <p class="font-semibold text-xl indent-5">Description</p>
    <Transition
      name="fade"
      mode="out-in"
      :duration="300"
    >
      <span
        v-if="readonly"
        class="description p-2"
      >
        {{ description }}
      </span>
      <textarea
        v-else
        class="description h-64"
        ref="textarea"
        rows="2"
        wrap="hard"
        @input="emit('update:description',($event.target as HTMLInputElement).value)"
        >{{ description }}</textarea
      >
    </Transition>
  </div>
</template>
<style
  lang="scss"
  scoped
>
.description {
  @apply font-normal bg-dark/0 resize-none w-full tracking-normal;
  @include editable-border;
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
