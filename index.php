<?php
session_start(); // start de sessie
include 'DBConnection.php';
$message = "";
$message_type = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $group = trim($_POST['group'] ?? '');

    if ($name === "" || $email === "" || $group === "") {
        $message = "Vul je naam, e-mail en klas in.";
        $message_type = "error";
    } else {
        try {
            $stmt = $conn->prepare("INSERT INTO participants (Name, Email, `Group`) VALUES (:name, :email, :group)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':group', $group);
            $stmt->execute();

            // Haal de laatst toegevoegde participant ID op
            $participant_id = $conn->lastInsertId();
            $_SESSION['participant_id'] = $participant_id; // opslaan in sessie

            $message = "Je registratie is succesvol!";
            $message_type = "success";

            // Doorsturen naar tournament pagina
            header('Location: toernooiaanmeld.php');
            exit;

        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                // Als e-mail al bestaat, haal participant ID op
                $stmt = $conn->prepare("SELECT Participant_id FROM participants WHERE Email = :email");
                $stmt->execute(['email' => $email]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION['participant_id'] = $row['Participant_id'];

                $message = "Dit e-mailadres is al geregistreerd!";
                $message_type = "error";

                // Doorsturen naar tournament pagina
                header('Location: toernooiaanmeld.php');
                exit;
            } else {
                $message = "Er is een fout opgetreden: " . $e->getMessage();
                $message_type = "error";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>LAN-Party | Alfa-college</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="relative min-h-screen bg-cover bg-center" style="background-image: url('img/background_image.webp');">
    <!-- Admin knop rechtsboven -->
    <div class="absolute top-4 right-4 bg-red-500 text-white px-4 py-1 rounded-md font-medium shadow-md z-10 text-sm sm:text-base">
        Admin
    </div>

    <div class="relative flex flex-col lg:flex-row items-center lg:items-stretch justify-center min-h-screen px-4 sm:px-6 py-8 lg:space-x-8 space-y-6 lg:space-y-0">
        <!-- Formulier -->
        <div class="w-[90%] lg:w-1/2 lg:max-w-lg bg-white/60 backdrop-blur-sm rounded-xl shadow-lg p-6 sm:p-10 flex flex-col lg:flex-1">
            <h2 class="text-2xl sm:text-3xl font-semibold text-center mb-6 sm:mb-8">Lan-Party</h2>

            <!-- Bericht tonen -->
            <?php if($message !== ""): ?>
                <div class="mb-4 p-3 rounded-md text-center <?php echo $message_type === 'error' ? 'bg-red-500 text-white' : 'bg-green-500 text-white'; ?>">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="index.php" class="space-y-4 sm:space-y-6 flex flex-col">
                <div>
                    <label for="name" class="block text-sm font-medium mb-1">Naam</label>
                    <input type="text" id="name" name="name" class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-400 text-sm sm:text-base" required>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-400 text-sm sm:text-base" required>
                </div>

                <div>
                    <label for="group" class="block text-sm font-medium mb-1">Klas</label>
                    <select id="group" name="group" class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-400 text-sm sm:text-base" required>
                        <option value="">Selecteer Klas</option>
                        <option value="1A">1A</option>
                        <option value="1B">1B</option>
                        <option value="2A">2A</option>
                        <option value="2B">2B</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-red-400 text-white py-2 rounded-md shadow-md hover:bg-red-500 transition text-sm sm:text-base mt-auto">
                    Volgende
                </button>
            </form>
        </div>

        <!-- Verticale lijn op laptop -->
        <div class="hidden lg:block w-[3px] bg-red-500"></div>

        <!-- Info blok -->
        <div class="w-[90%] lg:w-1/2 lg:max-w-lg bg-white/60 backdrop-blur-sm rounded-xl shadow-lg p-6 sm:p-10 flex items-center justify-center lg:flex-1">
            <p class="text-xl sm:text-3xl font-semibold text-gray-800 text-center">
                Informatie over lanparty
            </p>
        </div>
    </div>
</body>
</html>