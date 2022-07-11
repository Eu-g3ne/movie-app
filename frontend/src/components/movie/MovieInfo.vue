<script
  setup
  lang="ts"
>
import { computed } from "vue";

const props = withDefaults(
  defineProps<{
    title: string;
    value: string | number;
    readonly?: boolean;
    min?: number;
    max?: number;
  }>(),
  {
    min: () => 0,
  }
);

const emit = defineEmits<{
  (e: "update:value", value: string | number): void;
}>();

const inputType = computed<string>(() => {
  return typeof props.value === "string" ? "text" : "number";
});

function updateValue(e: WheelEvent): void {
  if (typeof props.value === "number") {
    if (e.deltaY < 0 && validate()) {
      emit("update:value", props.value + 1);
    } else if (e.deltaY > 0 && props.min < props.value) {
      emit("update:value", props.value - 1);
    }
    e.preventDefault();
  }
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
  set(val) {
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
        :type="inputType"
        maxlength="128"
        :max="max"
        :min="min"
        v-model="val"
        v-on="{ wheel: inputType === 'number' ? updateValue : null }"
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
  @apply bg-dark/0 font-normal sm:font-semibold ml-0 mr-auto w-full tracking-[2px];
}
input {
  @include editable-border;
}
span {
  @apply p-2;
}
</style>
