<script
  setup
  lang="ts"
>
import { ref, type Ref } from "vue";

import BaseButton from "@/components/Base/BaseButton.vue";

const props = defineProps<{
  column: string;
  names: Array<string>;
}>();

const active: Ref<string> = ref("all");

function capitalize(str: string): string {
  return str.charAt(0).toUpperCase() + str.slice(1);
}
</script>

<template>
  <div class="btn-group">
    <BaseButton
      v-for="name in props.names"
      :key="name"
      :class="[active === name ? 'bg-dark' : 'bg-light']"
      @click="active = name"
      :value="name"
    >
      {{ capitalize(name) }}
    </BaseButton>
  </div>
</template>

<style
  lang="scss"
  scoped
>
.btn-group {
  @apply flex flex-col v-sm:flex-row justify-evenly rounded-xl bg-dark;
}
</style>
