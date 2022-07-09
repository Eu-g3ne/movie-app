<script
  setup
  lang="ts"
>
const props = defineProps<{
  title: String | Number;
}>();
</script>
<template>
  <div>
    <div>{{ title }}:</div>
    <span class="font-semibold">
      <slot />
    </span>
  </div>
</template>
<style
  lang="scss"
  scoped
></style>
