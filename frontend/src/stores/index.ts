import { MovieAPI } from "@/api";
import type { Movie } from "@/models/Movie";
import { defineStore } from "pinia";

export const useMovieStore = defineStore({
  id: "MovieStore",
  state: () => ({
    movies: [] as Movie[],
    movie: {} as Movie,
    // newMovie: {
    //   title: "enter you title",
    //   episode: 0,
    //   total_episodes: 1,
    //   status: "ongoing",
    //   type: "film",
    //   rating: 0,
    //   is_favorite: false,
    //   image: "/storage/default/def.png",
    // } as Movie,
    moviesCount: 0,
    filteredMovies: [] as Movie[],
    isLoading: false as boolean,
  }),
  getters: {
    getMoviesCount(): number {
      return this.movies.length;
    },
  },
  actions: {
    getAllMovies(): void {
      MovieAPI.getMovies().then((data) => {
        Object.assign(this, data);
        this.filteredMovies = this.movies;
        this.isLoading = false;
      });
    },
    addMovie(movie: Movie): void {
      this.movies.push(movie);
      MovieAPI.createMovie(movie);
      this.moviesCount = this.getMoviesCount;
    },
    removeMovie(movie: Movie): void {
      if (movie.id !== undefined) {
        this.movies = this.movies.filter((mv) => mv.id !== movie.id);
        MovieAPI.deleteMovie(movie.id);
        this.moviesCount = this.getMoviesCount;
      }
    },
    getMovieBySlug(slug: string): void {
      MovieAPI.getBySlug(slug).then((data) => {
        Object.assign(this.movie, data);
        this.isLoading = false;
      });
    },
    getFiltered(type: string, status: string) {
      this.isLoading = true;
      this.filteredMovies = this.movies;
      if (type === "all" && status !== "all") {
        this.filteredMovies = this.filteredMovies.filter(
          (movie: Movie) => movie.status === status
        );
      } else if (status === "all" && type !== "all") {
        this.filteredMovies = this.filteredMovies.filter(
          (movie: Movie) => movie.type === type
        );
      } else if (status !== "all" && type !== "all") {
        this.filteredMovies = this.filteredMovies.filter(
          (movie: Movie) => movie.status === status && movie.type === type
        );
      }
      this.isLoading = false;
    },
  },
});
