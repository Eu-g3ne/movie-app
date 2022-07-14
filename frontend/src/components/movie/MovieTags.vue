<script
  setup
  lang="ts"
>
import CrossButton from "@/components/CrossButton.vue";
import { computed, nextTick, ref, type Ref } from "vue";
import PlusButton from "@/components/buttons/PlusButton.vue";
import { takeRight } from "lodash";

const props = defineProps<{
  tags: Array<string>;
  readonly: boolean;
}>();

const emit = defineEmits<{
  (e: "update:tags", value: Array<string>): void;
}>();

const vFocus = {
  mounted: (el: HTMLElement) => {
    el.focus();
  },
};

const activeTag: Ref<number | null> = ref(null);

async function addTag() {
  emit("update:tags", props.tags.concat(""));
  await nextTick();
  activeTag.value = props.tags.length - 1;
}

function removeTag(index: number) {
  const tags: Array<string> = props.tags;
  tags.splice(index, 1);
  emit("update:tags", tags);
}

function removeOnNull(index: number) {
  if (props.tags[index] === "") {
    removeTag(index);
  }
  activeTag.value = null;
}

const gridByTags = computed(() => {
  return props.tags.length < 3
    ? `grid-cols-${props.tags.length + 1}`
    : "grid-cols-3";
});
</script>
<template>
  <div
    class="flex flex-row flex-wrap items-center gap-2 p-2 rounded-xl max-w-lg"
    :class="gridByTags"
  >
    <div
      v-for="(tag, index) in tags"
      class="bg-dark p-2 rounded-xl grow max-w-[195px]"
    >
      <Transition
        name="fade"
        mode="out-in"
        :duration="300"
      >
        <div
          v-if="readonly"
          class="pr-3 min-w-[40px] w-full text-start"
          @click="activeTag = index"
        >
          {{ tag }}
        </div>
        <template v-else>
          <div class="flex flex-row justify-between items-center">
            <input
              v-focus
              v-model="tags[index]"
              class="block min-w-[40px] bg-dark/0"
              type="text"
              maxlength="14"
              :style="{ width: tag.length + 1 + 'ch' }"
              @keydown.enter="removeOnNull(index)"
              @blur="removeOnNull(index)"
              @click="activeTag = index"
            />
            <CrossButton @click="removeTag(index)" />
          </div>
        </template>
      </Transition>
    </div>
    <Transition
      name="fade"
      mode="out-in"
      :duration="300"
    >
      <div
        class="w-8 h-8"
        v-if="!readonly"
      >
        <PlusButton @click="addTag()" />
      </div>
    </Transition>
  </div>
</template>
<style
  lang="scss"
  scoped
>
div,
input {
  @apply tracking-normal;
}
</style>
