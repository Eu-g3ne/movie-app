import { useMovieStore } from "@/stores/index";
import { storeToRefs } from "pinia";
import { createRouter, createWebHistory } from "vue-router";

const MainView = () => import("@/views/MainView.vue");
const MovieView = () => import("@/views/MovieView.vue");
const LoginView = () => import("@/views/LoginView.vue");
const PageNotFoundView = () => import("@/views/PageNotFoundView.vue");

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: "/",
      name: "home",
      component: MainView,
      beforeEnter: async (to, from) => {
        const { getAllMovies } = useMovieStore();
        await getAllMovies();
      },
    },
    {
      path: "/:slug([^-][a-z\\d-]+[^-])",
      name: "movie",
      component: MovieView,
      props: true,
      beforeEnter: async (to, from) => {
        const { getMovieBySlug, getCategories } = useMovieStore();
        Promise.all([getMovieBySlug(to.params.slug as string), getCategories]);
      },
    },
    {
      path: "/create",
      name: "create",
      component: MovieView,
      props: false,
      beforeEnter: async (to, from) => {
        const { movie, editMode } = storeToRefs(useMovieStore());
        const { getCategories, emptyMovie } = useMovieStore();
        movie.value = emptyMovie;
        editMode.value = true;
        await getCategories();
      },
    },
    {
      path: "/login",
      name: "login",
      component: LoginView,
      props: false,
    },
    {
      path: "/:pathMatch(.*)*",
      name: "404",
      component: PageNotFoundView,
    },
  ],
  sensitive: true,
});

router.beforeResolve((to, from) => {
  const { isAuthenticated } = storeToRefs(useMovieStore());

  if (!(to.name === "login") && !isAuthenticated.value) {
    return { name: "login" };
  }
});

export default router;
