<script
  setup
  lang="ts"
>
import ButtonGroup from "@/components/ButtonGroup.vue";
import CollapseMenu from "@/components/CollapseMenu.vue";
import MovieType from "@/models/Enums/MovieType";
import MovieStatus from "@/models/Enums/MovieStatus";
import { ref, watch, type Ref } from "vue";
import { useMovieStore } from "@/stores/index";

import { getNames } from "@/composables/helpers";
import { storeToRefs } from "pinia";
const { type: stateType, status: stateStatus } = storeToRefs(useMovieStore());

const type: Ref<string> = ref("all");
const status: Ref<string> = ref("all");

watch([type, status], ([newType, newStatus], [prevType, prevStatus]) => {
  stateType.value = newType;
  stateStatus.value = newStatus;
});
</script>
<template>
  <CollapseMenu>
    <div class="filter-group">
      <ButtonGroup
        :column="'Type'"
        :names="getNames(Object.values(MovieType))"
        @click="type = $event.target.value"
      />
      <ButtonGroup
        :column="'Status'"
        :names="getNames(Object.values(MovieStatus))"
        @click="status = $event.target.value"
      />
    </div>
  </CollapseMenu>
</template>
<style
  lang="scss"
  scoped
>
.filter-group {
  @apply flex flex-col gap-5 py-2 md:flex-row overflow-hidden;
}
</style>
