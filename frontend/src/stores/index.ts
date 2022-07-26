import { MovieAPI } from "@/api";
import type { Movie } from "@/models/Movie";
import { defineStore } from "pinia";
import { difference, toFormData } from "@/composables/helpers";
import { clone, cloneDeep } from "lodash";
import { serialize } from "object-to-formdata";

export const useMovieStore = defineStore({
  id: "MovieStore",
  state: () => ({
    movie: {} as Movie,
    readonlyMovie: {} as Readonly<Movie>,
    movies: [] as Movie[],
    filteredMovies: [] as Movie[],
    moviesCount: 0,
    categories: [] as Array<string>,
    editMode: true as boolean, // need false
    isLoading: false as boolean,
  }),
  getters: {
    getMoviesCount(): number {
      return this.movies.length;
    },
    isReadonly(): boolean {
      return !this.editMode;
    },
  },
  actions: {
    async getAllMovies(): Promise<void> {
      await MovieAPI.getMovies().then((data) => {
        Object.assign(this, data);
        this.filteredMovies = this.movies;
      });
    },
    async getCategories(): Promise<void> {
      await MovieAPI.getAllCategories().then((data) => {
        Object.assign(this, clone(data));
      });
    },
    addMovie(movie: Movie): void {
      this.movies.push(movie);
      MovieAPI.createMovie(movie);
      this.moviesCount = this.getMoviesCount;
    },
    async updateMovie(movie: Movie, slug: string): Promise<void> {
      let data: Partial<Movie> & Omit<Movie, "id"> = difference(
        movie,
        this.readonlyMovie
      );
      // let form = toFormData(data);
      const options = {
        allowEmptyArrays: true,
      };
      let form = serialize(data, options);
      for (let i of form.values()) {
        console.log(i);
      }
      // if (data.categories.length === 0) {
      //   console.log(data.categories.length, "length");
      // }
      form.append("_method", "PUT");
      await MovieAPI.updateMovie(slug, form).then((data) => {
        console.log(data);
        this.movie = cloneDeep(data);
      });
    },
    // removeMovie(movie: Movie): void {
    //   if (movie.id !== undefined) {
    //     this.movies = this.movies.filter((mv) => mv.id !== movie.id);
    //     MovieAPI.deleteMovie(movie.id);
    //     this.moviesCount = this.getMoviesCount;
    //   }
    // },
    async getMovieBySlug(slug: string): Promise<void> {
      await MovieAPI.getBySlug(slug).then((data) => {
        this.movie = cloneDeep(data);
        this.readonlyMovie = cloneDeep(data);
      });
    },
    getFiltered(type: string, status: string) {
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
    },
  },
});
