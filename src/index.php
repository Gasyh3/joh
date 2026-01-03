<?php
require __DIR__ . '/config/pdo.php';

$typesStmt = $pdo->query('SELECT id, nom FROM types ORDER BY nom');
$types = $typesStmt->fetchAll();

$selectedTypeId = 0;
if (isset($_GET['type_id']) && $_GET['type_id'] !== '') {
    $selectedTypeId = (int) $_GET['type_id'];
}

$sql = 'SELECT p.id, p.description, p.montant, p.image_pitch, m.nom AS marque_nom, t.nom AS type_nom
        FROM propositions p
        JOIN marques m ON p.marque_id = m.id
        JOIN types t ON p.type_id = t.id';
$params = [];
if ($selectedTypeId > 0) {
    $sql .= ' WHERE p.type_id = :type_id';
    $params[':type_id'] = $selectedTypeId;
}
$sql .= ' ORDER BY p.id DESC';

$propsStmt = $pdo->prepare($sql);
$propsStmt->execute($params);
$propositions = $propsStmt->fetchAll();

$resultCount = count($propositions);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Influmatch</title>
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
        <section class="text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight bg-[linear-gradient(90deg,#A020F0,#D94CF0,#FF5E9D,#FF8A33)] bg-clip-text text-transparent">
                Influmatch
            </h1>
            <p class="mt-3 text-white/70 max-w-2xl mx-auto">
                Gerez vos propositions et collaborations simplement.
            </p>
        </section>

        <section class="mt-10 bg-gray-800/60 border border-white/10 rounded-2xl shadow-lg p-6">
            <form class="flex flex-col lg:flex-row lg:items-end gap-4" method="get" action="index.php">
                <div class="flex-1">
                    <label class="block text-sm text-white/70 mb-2" for="type_id">Type</label>
                    <select id="type_id" name="type_id" class="w-full bg-gray-900/60 border border-white/10 rounded-xl px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-[#D94CF0]/60">
                        <option value="">Tous</option>
                        <?php foreach ($types as $type): ?>
                            <option value="<?= htmlspecialchars($type['id']) ?>" <?= $selectedTypeId === (int) $type['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($type['nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="submit" class="rounded-xl px-5 py-2.5 text-sm font-semibold text-white bg-[linear-gradient(90deg,#A020F0,#D94CF0,#FF5E9D,#FF8A33)] shadow-md hover:opacity-90 transition duration-200">
                        Filtrer
                    </button>
                    <a href="proposition-creation.php" class="rounded-xl px-5 py-2.5 text-sm font-semibold text-white bg-[linear-gradient(90deg,#A020F0,#D94CF0,#FF5E9D,#FF8A33)] shadow-md hover:opacity-90 transition duration-200">
                        Ajouter une proposition
                    </a>
                </div>
            </form>
            <p class="mt-4 text-sm text-white/60">
                <?= htmlspecialchars((string) $resultCount) ?> resultat<?= $resultCount > 1 ? 's' : '' ?> trouve<?= $resultCount > 1 ? 's' : '' ?>
            </p>
        </section>

        <section class="mt-8">
            <?php if ($resultCount > 0): ?>
                <div class="overflow-x-auto bg-gray-800/60 border border-white/10 rounded-2xl shadow-lg">
                    <table class="min-w-full text-left text-sm">
                        <thead class="bg-gray-800/80 text-white/70 uppercase text-xs">
                            <tr>
                                <th class="px-4 py-4">ID</th>
                                <th class="px-4 py-4">Description</th>
                                <th class="px-4 py-4 text-right">Montant</th>
                                <th class="px-4 py-4">Marque</th>
                                <th class="px-4 py-4">Type</th>
                                <th class="px-4 py-4">Image du pitch</th>
                                <th class="px-4 py-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/10 text-gray-200">
                            <?php foreach ($propositions as $prop): ?>
                                <tr class="hover:bg-white/5 transition duration-200">
                                    <td class="px-4 py-4 font-semibold text-white"><?= htmlspecialchars((string) $prop['id']) ?></td>
                                    <td class="px-4 py-4"><?= htmlspecialchars($prop['description']) ?></td>
                                    <td class="px-4 py-4 text-right"><?= htmlspecialchars((string) $prop['montant']) ?></td>
                                    <td class="px-4 py-4"><?= htmlspecialchars($prop['marque_nom']) ?></td>
                                    <td class="px-4 py-4"><?= htmlspecialchars($prop['type_nom']) ?></td>
                                    <td class="px-4 py-4">
                                        <?php if (!empty($prop['image_pitch'])): ?>
                                            <img src="<?= htmlspecialchars($prop['image_pitch']) ?>" alt="Pitch" class="h-16 w-16 object-cover rounded-lg">
                                        <?php else: ?>
                                            <span class="inline-flex items-center rounded-full border border-white/10 px-3 py-1 text-xs text-white/60">Aucune</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex flex-wrap gap-2">
                                            <a href="proposition-modification.php?id=<?= htmlspecialchars((string) $prop['id']) ?>" class="px-3 py-1.5 rounded-lg text-xs font-semibold text-white bg-[linear-gradient(90deg,#A020F0,#D94CF0,#FF5E9D,#FF8A33)] shadow-md hover:opacity-90 transition duration-200">Modifier</a>
                                            <a href="proposition-suppression.php?id=<?= htmlspecialchars((string) $prop['id']) ?>" class="px-3 py-1.5 rounded-lg text-xs font-semibold text-red-200 bg-red-500/20 hover:bg-red-500/30 transition duration-200" onclick="return confirm('Supprimer cette proposition ?')">Supprimer</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="bg-gray-800/60 border border-white/10 rounded-2xl shadow-lg p-10 text-center">
                    <div class="mx-auto mb-4 h-12 w-12 rounded-2xl bg-white/5 flex items-center justify-center">
                        <svg class="h-6 w-6 text-white/70" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-white">Aucun resultat</h2>
                    <p class="mt-2 text-white/60">Commence par ajouter une proposition pour lancer la collaboration.</p>
                    <a href="proposition-creation.php" class="mt-6 inline-flex items-center justify-center rounded-xl px-5 py-2.5 text-sm font-semibold text-white bg-[linear-gradient(90deg,#A020F0,#D94CF0,#FF5E9D,#FF8A33)] shadow-md hover:opacity-90 transition duration-200">
                        Ajouter une proposition
                    </a>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <footer class="border-t border-white/10">
        <div class="max-w-6xl mx-auto px-6 py-6 flex flex-col md:flex-row items-center justify-between text-sm text-white/60">
            <a href="admin.php" class="hover:text-white transition duration-200">Administration</a>
            <span>Influmatch - gestion premium des collaborations</span>
        </div>
    </footer>
</body>
</html>
