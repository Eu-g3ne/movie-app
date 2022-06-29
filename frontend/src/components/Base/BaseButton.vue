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
.adaptive-rounded {
  @apply first:rounded-t-xl last:rounded-b-xl v-sm:first:rounded-t-none v-sm:last:rounded-b-none v-sm:first:rounded-tl-xl v-sm:first:rounded-bl-xl v-sm:last:rounded-tr-xl v-sm:last:rounded-br-xl;
}
.btn {
  @apply text-white p-4 adaptive-rounded border-2 border-dark border-double duration-150 w-full;
}
</style>
