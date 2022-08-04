<script
  setup
  lang="ts"
>
import { useMovieStore } from "@/stores/index";
import { storeToRefs } from "pinia";
const { editMode } = storeToRefs(useMovieStore());
</script>
<template>
  <div>
    <div
      class="relative inline-block w-10 align-middle select-none transition duration-200 ease-in"
    >
      <input
        type="checkbox"
        name="toggle"
        id="toggle"
        class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
        v-model="editMode"
      />
      <label
        for="toggle"
        class="toggle-label block overflow-hidden h-6 my-auto rounded-full cursor-pointer"
      ></label>
    </div>
    <label
      for="toggle"
      class="cursor-pointer pl-2 align-middle"
      >Edit mode</label
    >
  </div>
</template>
<style
  lang="scss"
  scoped
>
.toggle-label {
  transition: background-color 0.3s ease;
  background-color: darken(white, 30%);
}

.toggle-checkbox {
  transition: all 0.1s ease;
  right: 15px;
  &:checked {
    right: 0px;
    border-color: $bgColor;
    + .toggle-label {
      background-color: $bgColor;
    }
  }
}
</style>
