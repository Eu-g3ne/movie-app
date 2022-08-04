<script
  setup
  lang="ts"
></script>

<template>
  <button
    type="button"
    class="btn"
  >
    <slot />
  </button>
</template>

<style
  lang="scss"
  scoped
>
.btn {
  @apply text-white duration-150 w-full;
}
</style>
