import { fetchAPI } from '@/app/lib/api';

type Culture = {
  slug: string;
  region: string;
  name: string;
  description: string;
};

export default async function CulturePage({
  params,
}: {
  params: Promise<{ slug: string }>;
}) {
  const { slug } = await params;

  const culture = await fetchAPI<Culture>(
    `/api/cultures/${slug}`
  );

  return (
    <main className="p-8 max-w-3xl mx-auto">
      <h1 className="text-3xl font-bold mb-4">{culture.name}</h1>
      <p className="text-gray-700">{culture.description}</p>
    </main>
  );
}
