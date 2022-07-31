import { MovieAPI } from "@/api";
import type { Movie } from "@/models/Movie";
import { defineStore } from "pinia";
import { difference } from "@/composables/helpers";
import { clone, cloneDeep } from "lodash";
import { serialize } from "object-to-formdata";
import type MovieType from "@/models/Enums/MovieType";
import type MovieStatus from "@/models/Enums/MovieStatus";

export const useMovieStore = defineStore({
  id: "MovieStore",
  state: () => ({
    movie: {} as Movie,
    readonlyMovie: {} as Readonly<Movie>,
    movies: [] as Movie[],
    type: "all" as string,
    status: "all" as string,
    filteredMovies: [] as Movie[],
    moviesCount: 0,
    categories: [] as Array<string>,
    editMode: true as boolean, // need false
    isLoading: false as boolean,
    isAuthenticated: false,
  }),
  getters: {
    getMoviesCount(): number {
      return this.movies.length;
    },
    isReadonly(): boolean {
      return !this.editMode;
    },
    emptyMovie(): Movie {
      return {
        title: "",
        description: "",
        rating: 0,
        is_favorite: false,
        type: "" as MovieType,
        status: "" as MovieStatus,
        episode: 0,
        total_episodes: 0,
        image: {
          background: "",
          poster: "",
        },
        categories: [] as Array<string>,
      } as Movie;
    },
    filtered(): Array<Movie> {
      let filtered: Movie[] = this.movies;
      if (this.type !== "all") {
        filtered = filtered.filter((movie: Movie) => movie.type === this.type);
      }
      if (this.status !== "all") {
        filtered = filtered.filter(
          (movie: Movie) => movie.status === this.status
        );
      }
      return filtered;
    },
  },
  actions: {
    async getAllMovies(): Promise<void> {
      await MovieAPI.getMovies()
        .then((data) => {
          Object.assign(this, data);
          this.filteredMovies = this.movies;
          this.auth();
        })
        .catch((error) => {
          this.unauth();
        });
    },
    async getCategories(): Promise<void> {
      await MovieAPI.getAllCategories()
        .then((data) => {
          Object.assign(this, clone(data));
          this.auth();
        })
        .catch((error) => {
          this.unauth();
        });
    },
    async addMovie(movie: Movie): Promise<void> {
      const options = {
        allowEmptyArrays: true,
      };
      let form = serialize(movie, options);
      await MovieAPI.createMovie(form).then((data) => {
        this.movies.push(data);
      });
      this.moviesCount = this.getMoviesCount;
    },
    async updateMovie(movie: Movie, slug: string): Promise<void> {
      let data: Partial<Movie> & Omit<Movie, "id"> = difference(
        movie,
        this.readonlyMovie
      );
      const options = {
        allowEmptyArrays: true,
      };
      let form = serialize(data, options);
      form.append("_method", "PUT");
      await MovieAPI.updateMovie(slug, form).then((data) => {
        console.log(data);
        this.movie = cloneDeep(data);
      });
    },
    async removeMovie(movie: Movie): Promise<void> {
      if (movie.id !== undefined) {
        this.movies = this.movies.filter(
          (mv) => mv.id !== movie.id && mv.slug === movie.slug
        );
        await MovieAPI.deleteMovie(movie.slug);
        this.moviesCount = this.getMoviesCount;
      }
    },
    async getMovieBySlug(slug: string): Promise<void> {
      await MovieAPI.getBySlug(slug)
        .then((data) => {
          this.movie = cloneDeep(data);
          this.readonlyMovie = cloneDeep(data);
          this.auth();
        })
        .catch((error) => {
          this.unauth();
        });
    },
    auth(): void {
      this.isAuthenticated = true;
    },
    unauth(): void {
      this.isAuthenticated = false;
    },
  },
});
