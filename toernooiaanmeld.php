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

      <form class="bg-white bg-opacity-90 rounded-xl p-8 w-full max-w-xl space-y-6">

        <h2 class="text-3xl font-bold text-center text-gray-900">Game Tournament</h2>

        <div class="space-y-4">

          <label class="block">
            <input type="radio" name="game" class="hidden peer" checked>
            <div class="game-card peer-checked:border-blue-600 peer-checked:bg-blue-50 transition border-2 border-transparent rounded-lg p-4 flex justify-between items-center cursor-pointer">
              <div>
                <div class="font-semibold text-gray-900">Fortnite <span class="text-sm text-gray-500 ml-2">1v1</span></div>
                <div class="text-sm text-gray-600">Spelers: 5/18</div>
              </div>
              <div class="text-right">
                <div class="text-sm text-gray-700">16:30 - 17:30</div>
                <div class="circle w-6 h-6 border-2 border-gray-400 rounded-full flex items-center justify-center mt-1">
                  <div class="dot w-3 h-3 rounded-full bg-white"></div>
                </div>
              </div>
            </div>
          </label>

          <label class="block">
            <input type="radio" name="game" class="hidden peer">
            <div class="game-card peer-checked:border-blue-600 peer-checked:bg-blue-50 transition border-2 border-transparent rounded-lg p-4 flex justify-between items-center cursor-pointer">
              <div>
                <div class="font-semibold text-gray-900">Fortnite <span class="text-sm text-gray-500 ml-2">2v2</span></div>
                <div class="text-sm text-gray-600">Spelers: 8/24</div>
              </div>
              <div class="text-right">
                <div class="text-sm text-gray-700">18:00 - 19:30</div>
                <div class="circle w-6 h-6 border-2 border-gray-400 rounded-full flex items-center justify-center mt-1">
                  <div class="dot w-3 h-3 rounded-full bg-white"></div>
                </div>
              </div>
            </div>
          </label>

          <label class="block">
            <input type="radio" name="game" class="hidden peer">
            <div class="game-card peer-checked:border-blue-600 peer-checked:bg-blue-50 transition border-2 border-transparent rounded-lg p-4 flex justify-between items-center cursor-pointer">
              <div>
                <div class="font-semibold text-gray-900">Clash Royale <span class="text-sm text-gray-500 ml-2">1v1</span></div>
                <div class="text-sm text-gray-600">Spelers: 4/12</div>
              </div>
              <div class="text-right">
                <div class="text-sm text-gray-700">14:00 - 14:30</div>
                <div class="circle w-6 h-6 border-2 border-gray-400 rounded-full flex items-center justify-center mt-1">
                  <div class="dot w-3 h-3 rounded-full bg-white"></div>
                </div>
              </div>
            </div>
          </label>


          <label class="block">
            <input type="radio" name="game" class="hidden peer">
            <div class="game-card peer-checked:border-blue-600 peer-checked:bg-blue-50 transition border-2 border-transparent rounded-lg p-4 flex justify-between items-center cursor-pointer">
              <div>
                <div class="font-semibold text-gray-900">Rocket League <span class="text-sm text-gray-500 ml-2">1v1</span></div>
                <div class="text-sm text-gray-600">Spelers: 1/12</div>
              </div>
              <div class="text-right">
                <div class="text-sm text-gray-700">14:30 - 15:00</div>
                <div class="circle w-6 h-6 border-2 border-gray-400 rounded-full flex items-center justify-center mt-1">
                  <div class="dot w-3 h-3 rounded-full bg-white"></div>
                </div>
              </div>
            </div>
          </label>

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