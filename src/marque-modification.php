<?php
require __DIR__ . '/config/pdo.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) {
    header('Location: marque-lecture.php');
    exit;
}

$stmt = $pdo->prepare('SELECT id, nom, adresse FROM marques WHERE id = :id');
$stmt->execute([':id' => $id]);
$marque = $stmt->fetch();

if (!$marque) {
    header('Location: marque-lecture.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $adresse = trim($_POST['adresse'] ?? '');
    if ($nom !== '' && $adresse !== '') {
        $update = $pdo->prepare('UPDATE marques SET nom = :nom, adresse = :adresse WHERE id = :id');
        $update->execute([':nom' => $nom, ':adresse' => $adresse, ':id' => $id]);
        header('Location: marque-lecture.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une marque - Influmatch</title>
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

    <main class="max-w-xl mx-auto px-6 py-12">
        <h1 class="text-3xl font-bold">Modifier une marque</h1>

        <form method="post" class="mt-6 bg-gray-800/60 border border-white/10 rounded-2xl shadow-lg p-6 space-y-4">
            <div>
                <label class="block text-sm text-white/80 mb-2" for="nom">Nom</label>
                <input type="text" id="nom" name="nom" required class="w-full bg-gray-900/60 border border-white/10 rounded-xl px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-[#D94CF0]/60" value="<?= htmlspecialchars($marque['nom']) ?>">
            </div>
            <div>
                <label class="block text-sm text-white/80 mb-2" for="adresse">Adresse</label>
                <input type="text" id="adresse" name="adresse" required class="w-full bg-gray-900/60 border border-white/10 rounded-xl px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-[#D94CF0]/60" value="<?= htmlspecialchars($marque['adresse']) ?>">
            </div>
            <button type="submit" class="rounded-xl px-5 py-2.5 text-sm font-semibold text-white bg-[linear-gradient(90deg,#A020F0,#D94CF0,#FF5E9D,#FF8A33)] shadow-md hover:opacity-90 transition duration-200">Mettre a jour</button>
        </form>

        <div class="mt-6">
            <a href="marque-lecture.php" class="text-white/70 hover:text-white transition duration-200">Retour aux marques</a>
        </div>
    </main>
</body>
</html>
