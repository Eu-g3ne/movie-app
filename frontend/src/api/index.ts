import axios, { type AxiosResponse } from "axios";
import type { Movie, Movies } from "@/models/Movie";

const instance = axios.create({
  baseURL: "http://localhost:3000/api",
});

const responseBody = (response: AxiosResponse) => response.data;

const requests = {
  get: (url: string) => instance.get(url).then(responseBody),
  post: (url: string, body: {}) => instance.post(url, body).then(responseBody),
  put: (url: string, body: {}) => instance.put(url, body).then(responseBody),
  delete: (url: string) => instance.delete(url).then(responseBody),
};

export const MovieAPI = {
  getMovies: (): Promise<Movies> => requests.get("movies"),
  getBySlug: (slug: string): Promise<Movie> => requests.get(`movies/${slug}`),
  createMovie: (movie: Movie): Promise<Movie> => requests.post("movies", movie),
  deleteMovie: (id: number): Promise<void> => requests.delete(`movies/${id}`),
};
