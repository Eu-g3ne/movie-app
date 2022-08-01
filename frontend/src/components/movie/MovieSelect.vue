<script
  setup
  lang="ts"
>
import { computed } from "vue";

const props = defineProps<{
  title: string;
  value: string;
  values: Array<string>;
  readonly?: boolean;
}>();
const emit = defineEmits<{
  (e: "update:value", value: string): void;
}>();

const val = computed({
  get() {
    return props.value;
  },
  set(val: string) {
    emit("update:value", val);
  },
});
</script>
<template>
  <div>
    <div>{{ title }}:</div>
    <Transition
      name="fade"
      mode="out-in"
      :duration="300"
    >
      <span
        v-if="readonly"
        :title="value"
        >{{ value }}</span
      >
      <select
        v-else
        name="select"
        id="select"
        v-model="val"
      >
        <optgroup :label="title">
          <option
            v-for="(val, index) in values"
            :value="val"
            :key="index + val"
          >
            {{ val }}
          </option>
        </optgroup>
      </select>
    </Transition>
  </div>
</template>
<style
  lang="scss"
  scoped
>
select {
  @apply bg-light/0 w-full rounded-lg p-2 cursor-pointer sm:font-semibold leading-6 border-white border-2 border-solid tracking-[2px] h-12;
}

option,
optgroup {
  @apply bg-dark cursor-pointer sm:font-semibold;
}
select,
option,
optgroup {
  @apply tracking-[2px];
}

span {
  @apply bg-dark/0 font-normal sm:font-semibold ml-0 mr-auto w-full tracking-[2px] p-2;
}
</style>
