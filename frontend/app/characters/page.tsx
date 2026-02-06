import Link from 'next/link';
import { fetchAPI } from '@/app/lib/api';

type Character = {
  slug: string;
  name: string;
  title: string;
};

export default async function CharactersPage() {
  const characters = await fetchAPI<Character[]>(
    '/api/characters'
  );

  return (
    <main className="p-8 max-w-3xl mx-auto">
      <h1 className="text-3xl font-bold mb-6">Characters</h1>

      <ul className="space-y-3">
        {characters.map((c) => (
          <li key={c.slug}>
            <Link
              href={`/characters/${c.slug}`}
              className="text-blue-600"
            >
              {c.name} — {c.title}
            </Link>
          </li>
        ))}
      </ul>
    </main>
  );
}
