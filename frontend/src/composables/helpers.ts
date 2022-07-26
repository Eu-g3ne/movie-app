import { ref, onMounted, onUnmounted, type Ref } from "vue";
import _, { isArray } from "lodash";
import { transform, isEqual, isObject } from "lodash";
import type { Movie } from "@/models/Movie";

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
  return ["all", ...arr];
}

export const capitalize = (str: string): string => {
  return str?.charAt(0).toUpperCase() + str?.slice(1).toLowerCase();
};

export function difference(object: Object, base: Object) {
  return transform(object, (result: any, value, key) => {
    if (!isEqual(value, base[key])) {
      result[key] =
        isObject(value) && isObject(base[key]) && !isArray(value)
          ? difference(value, base[key])
          : value;
    }
  });
}

// TODO: make this works
export const toFormData = ((f) => f(f))(
  (h: any) => (f: any) => f((x: any) => h(h)(f)(x))
)((f: any) => (fd: any) => (pk: any) => (d: any): FormData => {
  if (d instanceof Object) {
    Object.keys(d).forEach((k) => {
      const v = d[k];
      if (pk) k = `${pk}[${k}]`;
      if (
        v instanceof Object &&
        !(v instanceof Date) &&
        !(v instanceof File) &&
        !(v instanceof Array)
      ) {
        return f(fd)(k)(v);
      } else {
        fd.append(k, v);
      }
    });
  }
  return fd;
})(new FormData())();
