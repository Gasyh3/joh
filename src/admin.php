<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Influmatch</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen bg-[radial-gradient(ellipse_at_top,_rgba(160,32,240,0.18),_transparent_55%),radial-gradient(ellipse_at_bottom,_rgba(255,138,51,0.12),_transparent_50%)]">
    <header class="border-b border-white/10 bg-gray-900/80 backdrop-blur">
        <div class="max-w-6xl mx-auto px-6 py-4 flex flex-col md:flex-row items-center justify-between gap-3">
            <a href="index.php" class="text-lg font-semibold tracking-wide">
                <span class="bg-[linear-gradient(90deg,#A020F0,#D94CF0,#FF5E9D,#FF8A33)] bg-clip-text text-transparent">InfluMatch</span>
            </a>
            <nav class="flex items-center gap-6 text-sm text-white/70">
                <a href="index.php" class="hover:text-white transition duration-200">Accueil</a>
                <a href="admin.php" class="hover:text-white transition duration-200">Administration</a>
            </nav>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-6 py-12 text-center">
        <h1 class="text-3xl md:text-4xl font-extrabold">Administration</h1>
        <div class="mt-10 grid gap-6 md:grid-cols-2">
            <a href="type-lecture.php" class="group rounded-2xl border border-white/10 bg-gray-800/60 p-6 text-left shadow-lg hover:border-white/20 transition duration-200">
                <p class="text-sm text-white/60">Types</p>
                <h2 class="mt-2 text-xl font-semibold text-white">Gerer les types</h2>
                <span class="mt-4 inline-flex items-center rounded-xl px-4 py-2 text-xs font-semibold text-white bg-[linear-gradient(90deg,#A020F0,#D94CF0,#FF5E9D,#FF8A33)] shadow-md hover:opacity-90 transition duration-200">
                    Ouvrir
                </span>
            </a>
            <a href="marque-lecture.php" class="group rounded-2xl border border-white/10 bg-gray-800/60 p-6 text-left shadow-lg hover:border-white/20 transition duration-200">
                <p class="text-sm text-white/60">Marques</p>
                <h2 class="mt-2 text-xl font-semibold text-white">Gerer les marques</h2>
                <span class="mt-4 inline-flex items-center rounded-xl px-4 py-2 text-xs font-semibold text-white bg-[linear-gradient(90deg,#A020F0,#D94CF0,#FF5E9D,#FF8A33)] shadow-md hover:opacity-90 transition duration-200">
                    Ouvrir
                </span>
            </a>
        </div>
        <div class="mt-10">
            <a href="index.php" class="text-white/70 hover:text-white transition duration-200">Retour a l accueil</a>
        </div>
    </main>
</body>
</html>
