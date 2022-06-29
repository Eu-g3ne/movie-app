import { ref, onMounted, onUnmounted, type Ref } from "vue";
import _ from "lodash";

export function useScrollEffect() {
  const prevScrollPos: Ref<number> = ref(window.pageYOffset);

  onMounted(() =>
    document.addEventListener("scroll", _.throttle(handleScroll, 200))
  );
  onUnmounted(() =>
    document.removeEventListener("scroll", _.throttle(handleScroll, 200))
  );

  function handleScroll(): void {
    let currentScrollPos: number = window.pageYOffset;

    if (prevScrollPos.value > currentScrollPos) {
      (document.getElementById("navbar") as HTMLElement).style.top = "0";
    } else if (currentScrollPos > 30) {
      (document.getElementById("navbar") as HTMLElement).style.top = "-80px";
    }
    prevScrollPos.value = currentScrollPos;
  }
}

export function getNames(arr: Array<string>): Array<string> {
  return ["all"].concat(arr);
}
