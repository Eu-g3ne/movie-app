<script
  setup
  lang="ts"
>
const props = defineProps<{
  value: String | Number;
  readonly?: boolean;
}>();

const emit = defineEmits<{
  (e: "update:value", value: String | Number): void;
}>();
</script>
<template>
  <div>
    <div>{{ value }}:</div>
    <span class="font-semibold">
      <slot />
    </span>
  </div>
</template>
<style
  lang="scss"
  scoped
></style>
