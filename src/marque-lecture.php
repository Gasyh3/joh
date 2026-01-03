<?php
require __DIR__ . '/config/pdo.php';

$stmt = $pdo->query('SELECT id, nom, adresse FROM marques ORDER BY id DESC');
$marques = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marques - Influmatch</title>
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

    <main class="max-w-6xl mx-auto px-6 py-12">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold">Marques</h1>
            </div>
            <a href="marque-creation.php" class="rounded-xl px-5 py-2.5 text-sm font-semibold text-white bg-[linear-gradient(90deg,#A020F0,#D94CF0,#FF5E9D,#FF8A33)] shadow-md hover:opacity-90 transition duration-200">Ajouter une marque</a>
        </div>

        <div class="mt-6 overflow-x-auto bg-gray-800/60 border border-white/10 rounded-2xl shadow-lg">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-gray-800/80 text-xs uppercase text-white/70">
                    <tr>
                        <th class="px-4 py-4">ID</th>
                        <th class="px-4 py-4">Nom</th>
                        <th class="px-4 py-4">Adresse</th>
                        <th class="px-4 py-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10 text-gray-200">
                    <?php foreach ($marques as $marque): ?>
                        <tr class="hover:bg-white/5 transition duration-200">
                            <td class="px-4 py-4 font-semibold text-white"><?= htmlspecialchars((string) $marque['id']) ?></td>
                            <td class="px-4 py-4"><?= htmlspecialchars($marque['nom']) ?></td>
                            <td class="px-4 py-4"><?= htmlspecialchars($marque['adresse']) ?></td>
                            <td class="px-4 py-4">
                                <div class="flex flex-wrap gap-2">
                                    <a href="marque-modification.php?id=<?= htmlspecialchars((string) $marque['id']) ?>" class="px-3 py-1.5 rounded-lg text-xs font-semibold text-white bg-[linear-gradient(90deg,#A020F0,#D94CF0,#FF5E9D,#FF8A33)] shadow-md hover:opacity-90 transition duration-200">Modifier</a>
                                    <a href="marque-suppression.php?id=<?= htmlspecialchars((string) $marque['id']) ?>" class="px-3 py-1.5 rounded-lg text-xs font-semibold text-red-200 bg-red-500/20 hover:bg-red-500/30 transition duration-200" onclick="return confirm('Supprimer cette marque ?')">Supprimer</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            <a href="admin.php" class="text-white/70 hover:text-white transition duration-200">Retour administration</a>
        </div>
    </main>
</body>
</html>
