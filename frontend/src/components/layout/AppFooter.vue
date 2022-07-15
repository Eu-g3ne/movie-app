<script
  setup
  lang="ts"
></script>
<template>
  <footer class="w-full min-h-20 bg-dark z-10">
    <div
      class="2xl:container py-3 grid gap-2 v-sm:grid-cols-3 grid-cols-1 justify-evenly leading-10"
    >
      <a
        href="/"
        class="flex items-center justify-center"
      >
        <img
          class="max-h-16"
          src="@/assets/icons/logo.png"
          alt="Logo"
        />
      </a>
      <div>
        <h1 class="font-bold text-center">Links</h1>
        <ul>
          <li>
            <a
              href="https://github.com/Eu-g3ne"
              target="_blank"
              rel="noopener noreferrer"
              class="mx-auto github-link"
            >
              Github
            </a>
          </li>
          <li>
            <a
              href="https://t.me/eu_g3ne"
              target="_blank"
              rel="noopener noreferrer"
              class="mx-auto tg-link"
            >
              Telegram
            </a>
          </li>
        </ul>
      </div>
      <div>
        <h1 class="font-bold text-center">Stack</h1>
        <span class="flex justify-center text-sm">Vue - Laravel API</span>
      </div>
    </div>
  </footer>
</template>
<style
  lang="scss"
  scoped
>
h1 {
  @apply pb-1;
}
ul {
  li {
    width: min-content;
    margin: auto;
    a {
      @apply duration-300 hover:text-gray-400 text-sm;
    }
  }
}

.tg-link {
  display: inline-block;
  white-space: nowrap;
  &::before {
    content: url("../../assets/icons/tg-logo.svg");
    display: inline-block;
    vertical-align: middle;
    width: 25px;
    height: 25px;
    margin: 0;
  }
}
.github-link {
  display: inline-block;
  white-space: nowrap;
  &::before {
    content: url("../../assets/icons/github-logo.svg");
    display: inline-block;
    vertical-align: middle;
    width: 25px;
    height: 25px;
    margin: 0;
    filter: invert(1);
  }
}
</style>
