<script
  setup
  lang="ts"
>
import { computed } from "vue";

const props = withDefaults(
  defineProps<{
    title: string;
    value: number;
    readonly?: boolean;
    min?: number;
    max?: number;
  }>(),
  {
    min: () => 0,
  }
);

const emit = defineEmits<{
  (e: "update:value", value: number): void;
}>();

function updateValue(e: WheelEvent): void {
  if (e.deltaY < 0 && validate()) {
    emit("update:value", props.value + 1);
  } else if (e.deltaY > 0 && props.min < props.value) {
    emit("update:value", props.value - 1);
  }
  e.preventDefault();
}

function validate(): boolean {
  if (props.max !== undefined)
    if (props.max <= props.value || props.max === 0) {
      return false;
    }
  return true;
}

const val = computed({
  get() {
    return props.value;
  },
  set(val: number) {
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
        :title="value.toString()"
        >{{ value }}</span
      >
      <input
        v-else
        type="number"
        maxlength="128"
        :max="max"
        :min="min"
        v-model="val"
        @wheel="updateValue"
      />
    </Transition>
  </div>
</template>
<style
  lang="scss"
  scoped
>
input,
span {
  @apply bg-dark/0 font-normal sm:font-semibold ml-0 mr-auto w-full tracking-[2px] h-12;
}
input {
  @include editable-border;
}
span {
  @apply p-2;
}
</style>
