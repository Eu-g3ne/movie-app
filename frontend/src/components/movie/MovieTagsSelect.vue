<script
  setup
  lang="ts"
>
const props = defineProps<{
  tags: Array<string>;
}>();
</script>
<template>
  <select
    name="tags"
    class="bg-light rounded-xl p-2 cursor-pointer"
  >
    <option
      class="bg-dark"
      value=""
      selected
      disabled
    >
      Existing categories
    </option>
    <option
      v-for="(tag, index) in tags"
      :key="index + 'tag'"
      class="outline-none border-none bg-dark cursor-pointer"
      :value="tag"
    >
      {{ tag }}
    </option>
  </select>
</template>
<style
  lang="scss"
  scoped
></style>
