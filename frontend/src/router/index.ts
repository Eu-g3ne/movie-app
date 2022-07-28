import { useMovieStore } from "@/stores/index";
import { storeToRefs } from "pinia";
import { createRouter, createWebHistory } from "vue-router";

const MainView = () => import("@/views/MainView.vue");
const MovieView = () => import("@/views/MovieView.vue");
const PageNotFoundView = () => import("@/views/PageNotFoundView.vue");

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: "/",
      name: "home",
      component: MainView,
      beforeEnter: (to, from) => {
        const { getAllMovies } = useMovieStore();
        getAllMovies();
      },
    },
    {
      path: "/:slug([^-][a-z\\d-]+[^-])",
      name: "movie",
      component: MovieView,
      props: true,
      beforeEnter: (to, from) => {
        const { getMovieBySlug, getCategories } = useMovieStore();
        getMovieBySlug(to.params.slug as string);
        getCategories();
      },
    },
    {
      path: "/create",
      name: "create",
      component: MovieView,
      props: false,
      beforeEnter: (to, from) => {
        const { movie, editMode } = storeToRefs(useMovieStore());
        const { getCategories, emptyMovie } = useMovieStore();
        movie.value = emptyMovie;
        editMode.value = true;
        getCategories();
      },
    },
    {
      path: "/:pathMatch(.*)*",
      name: "404",
      component: PageNotFoundView,
    },
  ],
  sensitive: true,
});

export default router;
