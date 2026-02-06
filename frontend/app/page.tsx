import Link from 'next/link';

export default function HomePage() {
  return (
    <main className="p-8 max-w-3xl mx-auto">
      <h1 className="text-3xl font-bold mb-4">
        Mythology Knowledge Platform
      </h1>

      <p className="mb-6 text-gray-600">
        Explore Hindu mythology — gods, stories, and timeless wisdom.
      </p>

      <div className="space-y-4">
        <Link href="/culture/hindu" className="block text-blue-600">
          → Explore Hindu Culture
        </Link>

        <Link href="/characters" className="block text-blue-600">
          → Browse Characters
        </Link>
      </div>
    </main>
  );
}
