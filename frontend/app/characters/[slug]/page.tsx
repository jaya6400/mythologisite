import { fetchAPI } from '@/app/lib/api';

type Character = {
  name: string;
  title: string;
  description: string;
  culture: {
    slug: string;
  };
};

export default async function CharacterPage({
  params,
}: {
  params: Promise<{ slug: string }>;
}) {
  const { slug } = await params;

  const character = await fetchAPI<Character>(
    `/api/characters/${slug}`
  );

  return (
    <main className="p-8 max-w-3xl mx-auto">
      <h1 className="text-3xl font-bold mb-2">{character.name}</h1>
      <h2 className="text-xl text-gray-500 mb-4">
        {character.title}
      </h2>
      <p>{character.description}</p>
    </main>
  );
}
