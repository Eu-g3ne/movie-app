<script
  setup
  lang="ts"
></script>
<template>
  <footer class="w-full min-h-20 bg-dark z-10">
    <div class="container py-3 flex gap-2 flex-row justify-evenly leading-10">
      <a
        href="/"
        class="flex items-center"
      >
        <img
          class="max-h-16"
          src="@/assets/icons/logo.png"
          alt="Logo"
        />
      </a>
      <div>
        <h1 class="font-bold text-center">Links</h1>
        <ul class="">
          <li class="">
            <a
              href="https://github.com/Eu-g3ne"
              target="_blank"
              rel="noopener noreferrer"
              class="github-link"
            >
              Github
            </a>
          </li>
          <li class="">
            <a
              href="https://t.me/eu_g3ne"
              target="_blank"
              rel="noopener noreferrer"
              class="tg-link"
            >
              Telegram
            </a>
          </li>
        </ul>
      </div>
      <div>
        <h1 class="font-bold">Stack</h1>
        Vue - Laravel API
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
    a {
      @apply duration-300 hover:text-gray-400;
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
