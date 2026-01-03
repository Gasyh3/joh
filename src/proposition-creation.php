<?php
require __DIR__ . '/config/pdo.php';

$typesStmt = $pdo->query('SELECT id, nom FROM types ORDER BY nom');
$types = $typesStmt->fetchAll();

$marquesStmt = $pdo->query('SELECT id, nom FROM marques ORDER BY nom');
$marques = $marquesStmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $description = trim($_POST['description'] ?? '');
    $montant = trim($_POST['montant'] ?? '');
    $marqueId = (int) ($_POST['marque_id'] ?? 0);
    $typeId = (int) ($_POST['type_id'] ?? 0);

    $imagePath = null;
    if (isset($_FILES['image_pitch']) && $_FILES['image_pitch']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/uploads';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $originalName = basename($_FILES['image_pitch']['name']);
        $safeName = preg_replace('/[^a-zA-Z0-9._-]/', '_', $originalName);
        $fileName = uniqid('pitch_', true) . '_' . $safeName;
        $targetPath = $uploadDir . '/' . $fileName;
        if (move_uploaded_file($_FILES['image_pitch']['tmp_name'], $targetPath)) {
            $imagePath = 'uploads/' . $fileName;
        }
    }

    if ($description !== '' && $montant !== '' && $marqueId > 0 && $typeId > 0) {
        $stmt = $pdo->prepare('INSERT INTO propositions (montant, description, marque_id, type_id, image_pitch) VALUES (:montant, :description, :marque_id, :type_id, :image_pitch)');
        $stmt->execute([
            ':montant' => $montant,
            ':description' => $description,
            ':marque_id' => $marqueId,
            ':type_id' => $typeId,
            ':image_pitch' => $imagePath,
        ]);
        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une proposition - Influmatch</title>
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

    <main class="max-w-2xl mx-auto px-6 py-12">
        <h1 class="text-3xl font-bold">Ajouter une proposition</h1>

        <form method="post" enctype="multipart/form-data" class="mt-6 bg-gray-800/60 border border-white/10 rounded-2xl shadow-lg p-6 space-y-4">
            <div>
                <label class="block text-sm text-white/80 mb-2" for="description">Description</label>
                <input type="text" id="description" name="description" required class="w-full bg-gray-900/60 border border-white/10 rounded-xl px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-[#D94CF0]/60">
            </div>
            <div>
                <label class="block text-sm text-white/80 mb-2" for="montant">Montant</label>
                <input type="number" step="0.01" id="montant" name="montant" required class="w-full bg-gray-900/60 border border-white/10 rounded-xl px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-[#D94CF0]/60">
            </div>
            <div>
                <label class="block text-sm text-white/80 mb-2" for="marque_id">Marque</label>
                <select id="marque_id" name="marque_id" required class="w-full bg-gray-900/60 border border-white/10 rounded-xl px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-[#D94CF0]/60">
                    <option value="">Choisir</option>
                    <?php foreach ($marques as $marque): ?>
                        <option value="<?= htmlspecialchars((string) $marque['id']) ?>"><?= htmlspecialchars($marque['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block text-sm text-white/80 mb-2" for="type_id">Type de mise en avant</label>
                <select id="type_id" name="type_id" required class="w-full bg-gray-900/60 border border-white/10 rounded-xl px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-[#D94CF0]/60">
                    <option value="">Choisir</option>
                    <?php foreach ($types as $type): ?>
                        <option value="<?= htmlspecialchars((string) $type['id']) ?>"><?= htmlspecialchars($type['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block text-sm text-white/80 mb-2" for="image_pitch">Image du pitch (optionnel)</label>
                <input type="file" id="image_pitch" name="image_pitch" class="w-full text-sm text-white/70">
            </div>
            <button type="submit" class="rounded-xl px-5 py-2.5 text-sm font-semibold text-white bg-[linear-gradient(90deg,#A020F0,#D94CF0,#FF5E9D,#FF8A33)] shadow-md hover:opacity-90 transition duration-200">Enregistrer</button>
        </form>

        <div class="mt-6">
            <a href="index.php" class="text-white/70 hover:text-white transition duration-200">Retour a l accueil</a>
        </div>
    </main>
</body>
</html>
