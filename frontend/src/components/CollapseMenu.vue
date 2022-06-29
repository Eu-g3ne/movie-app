<script
  setup
  lang="ts"
></script>
<template>
  <div class="relative mt-5">
    <input
      id="collapsed"
      type="checkbox"
      class="absolute -bottom-7 inset-x-0 h-14 w-14 m-auto z-100 opacity-0 peer cursor-pointer v-sm:hidden"
      title="Hide/Show filters"
    />

    <svg
      xmlns="http://www.w3.org/2000/svg"
      class="h-12 w-12 duration-500 m-auto rounded-full v-sm:hidden rotate-180 peer-checked:rotate-0 bg-dark absolute -bottom-7 inset-x-0"
      viewBox="0 0 20 20"
      fill="currentColor"
    >
      <path
        fill-rule="evenodd"
        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
        clip-rule="evenodd"
      />
    </svg>

    <div
      class="peer-checked:max-h-0 duration-500 max-h-[40rem] overflow-hidden v-sm:peer-checked:max-h-[32rem]"
    >
      <slot />
    </div>
  </div>
</template>
<style
  lang="scss"
  scoped
></style>
