<?php
require 'DBConnection.php'; // database verbinding

// Formulier verwerken
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Hier gebruiken we een statische participant_id
    $participant_id = 1; // vervang eventueel door een formulierveld als je meerdere deelnemers wilt

    $tournament_id = intval($_POST['game']);

    // Check of de deelnemer al ingeschreven is
    $check = $conn->prepare("SELECT * FROM registrations WHERE Participant_id = :participant_id AND Tournament_id = :tournament_id");
    $check->execute([
        'participant_id' => $participant_id,
        'tournament_id' => $tournament_id
    ]);

    if ($check->rowCount() > 0) {
        $message = "Je bent al ingeschreven voor dit toernooi!";
    } else {
        // Inschrijven
        $stmt = $conn->prepare("INSERT INTO registrations (Participant_id, Tournament_id) VALUES (:participant_id, :tournament_id)");
        if ($stmt->execute([
            'participant_id' => $participant_id,
            'tournament_id' => $tournament_id
        ])) {
            $message = "Succesvol ingeschreven!";
        } else {
            $message = "Er is iets misgegaan bij inschrijving.";
        }
    }
}

// Toernooien ophalen voor de lijst
$tournaments = $conn->query("
    SELECT t.*, COUNT(r.Registration_id) AS filled 
    FROM tournaments t
    LEFT JOIN registrations r ON t.Tournament_id = r.Tournament_id
    GROUP BY t.Tournament_id
    ORDER BY t.Date ASC
")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Game Tournament Aanmelding</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    input[type="radio"]:checked + .game-card {
      border-color: #2563eb;
      background-color: #e0f2fe;
    }

    input[type="radio"]:checked + .game-card .circle {
      border-color: #2563eb;
    }

    input[type="radio"]:checked + .game-card .circle .dot {
      background-color: #2563eb;
    }
  </style>
</head>
<body class="bg-gray-100">

  <div class="relative min-h-screen bg-cover bg-center" style="background-image: url('https PLACEHOLDER');">
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>

    <div class="relative z-10 flex flex-col md:flex-row items-center justify-center min-h-screen px-6 py-10 gap-10">

      <form method="POST" class="bg-white bg-opacity-90 rounded-xl p-8 w-full max-w-xl space-y-6">

        <h2 class="text-3xl font-bold text-center text-gray-900">Game Tournament</h2>

        <?php if($message): ?>
          <div class="p-3 bg-green-200 text-green-800 rounded"><?php echo $message; ?></div>
        <?php endif; ?>

        <div class="space-y-4">
          <?php foreach($tournaments as $row): 
              $is_full = $row['filled'] >= $row['Max_Participants'];
          ?>
            <label class="block">
              <input type="radio" name="game" value="<?php echo $row['Tournament_id']; ?>" class="hidden peer" <?php echo $is_full ? 'disabled' : ''; ?> <?php echo !$is_full ? 'checked' : ''; ?>>
              <div class="game-card peer-checked:border-blue-600 peer-checked:bg-blue-50 transition border-2 border-transparent rounded-lg p-4 flex justify-between items-center cursor-pointer <?php echo $is_full ? 'opacity-50 cursor-not-allowed' : ''; ?>">
                <div>
                  <div class="font-semibold text-gray-900"><?php echo $row['Name']; ?></div>
                  <div class="text-sm text-gray-600">Spelers: <?php echo $row['filled'].'/'.$row['Max_Participants']; ?></div>
                </div>
                <div class="text-right">
                  <div class="text-sm text-gray-700"><?php echo date("H:i - H:i", strtotime($row['Date'])); ?></div>
                  <div class="circle w-6 h-6 border-2 border-gray-400 rounded-full flex items-center justify-center mt-1">
                    <div class="dot w-3 h-3 rounded-full bg-white"></div>
                  </div>
                </div>
              </div>
            </label>
          <?php endforeach; ?>
        </div>

        <button type="submit" class="w-full bg-gradient-to-r from-red-600 to-blue-600 hover:from-red-700 hover:to-blue-700 text-white py-3 rounded-lg text-lg font-medium shadow-md transition">
          Aanmelden
        </button>

      </form>

      <div class="hidden md:flex flex-col justify-center items-center bg-white bg-opacity-80 rounded-xl p-6 max-w-sm rotate-0 -rotate-12">
        <h3 class="text-xl font-semibold text-gray-800 mb-3">Informatie over tournament</h3>
        <p class="text-sm text-gray-700 text-center">
          Kies een game en tijdslot om je aan te melden voor het toernooi. Vol = vol, dus wees op tijd!
        </p>
      </div>

    </div>
  </div>

</body>
</html>
