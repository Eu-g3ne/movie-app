import type MovieStatus from "@/models/Enums/MovieStatus";
import type MovieType from "@/models/Enums/MovieType";
import type { Image } from "@/models/Image";

interface Movie {
  readonly id?: number;
  slug: string;
  title: string;
  description: string;
  episode: number;
  total_episodes: number;
  status: MovieStatus;
  type: MovieType;
  rating: number;
  created_at?: string;
  updated_at?: string;
  is_favorite: boolean;
  image: Image;
  categories: Array<string>;
}

interface Movies {
  movies: Array<Movie>;
  moviesCount: number;
}

export type { Movie, Movies };
