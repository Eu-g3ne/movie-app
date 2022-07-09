<script
  setup
  lang="ts"
>
import { ref, type Ref } from "vue";

import BaseButton from "@/components/base/BaseButton.vue";
import { capitalize } from "@/composables/helpers";

const props = defineProps<{
  column: string;
  names: Array<string>;
}>();

const active: Ref<string> = ref("all");
</script>

<template>
  <div class="btn-group">
    <BaseButton
      class="p-4 border-2 border-dark border-double adaptive-rounded"
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
.adaptive-rounded {
  @apply first:rounded-t-xl last:rounded-b-xl v-sm:first:rounded-t-none v-sm:last:rounded-b-none v-sm:first:rounded-tl-xl v-sm:first:rounded-bl-xl v-sm:last:rounded-tr-xl v-sm:last:rounded-br-xl;
}
.btn-group {
  @apply flex flex-col v-sm:flex-row justify-evenly rounded-xl bg-dark;
}
</style>
