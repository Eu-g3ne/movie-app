<script
  setup
  lang="ts"
></script>
<template>
  <div class="w-screen h-screen fixed inset-0 bg-dark z-100">
    <svg
      class="fixed inset-0"
      xmlns="http://www.w3.org/2000/svg"
      xmlns:xlink="http://www.w3.org/1999/xlink"
      style="
        margin: auto;
        /* background: rgb(31, 41, 55); */
        display: block;
        shape-rendering: auto;
      "
      width="210px"
      height="210px"
      viewBox="0 0 100 100"
      preserveAspectRatio="xMidYMid"
    >
      <circle
        cx="50"
        cy="50"
        r="35"
        stroke-width="7"
        stroke="#a4a7ab"
        stroke-dasharray="54.97787143782138 54.97787143782138"
        fill="none"
        stroke-linecap="round"
      >
        <animateTransform
          attributeName="transform"
          type="rotate"
          dur="2.127659574468085s"
          repeatCount="indefinite"
          keyTimes="0;1"
          values="0 50 50;360 50 50"
        ></animateTransform>
      </circle>
      <circle
        cx="50"
        cy="50"
        r="27"
        stroke-width="7"
        stroke="#ffffff"
        stroke-dasharray="42.411500823462205 42.411500823462205"
        stroke-dashoffset="42.411500823462205"
        fill="none"
        stroke-linecap="round"
      >
        <animateTransform
          attributeName="transform"
          type="rotate"
          dur="2.127659574468085s"
          repeatCount="indefinite"
          keyTimes="0;1"
          values="0 50 50;-360 50 50"
        ></animateTransform>
      </circle>
    </svg>
  </div>
</template>
<style
  lang="scss"
  scoped
></style>
