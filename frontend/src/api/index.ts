import axios, { type AxiosRequestConfig, type AxiosResponse } from "axios";
import type { Movie, Movies } from "@/models/Movie";

const instance = axios.create({
  baseURL: "http://localhost:3000/api",
  headers: {
    "content-type": "multipart/form-data",
  },
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
  getAllCategories: (): Promise<Array<string>> => requests.get("categories"),
  getBySlug: (slug: string): Promise<Movie> => requests.get(`movies/${slug}`),
  createMovie: (movie: FormData): Promise<Movie> =>
    requests.post("movies", movie),
  updateMovie: (slug: string, movie: FormData): Promise<Movie> =>
    requests.post(`movies/${slug}`, movie),
  deleteMovie: (slug: string): Promise<void> =>
    requests.delete(`movies/${slug}`),
};
