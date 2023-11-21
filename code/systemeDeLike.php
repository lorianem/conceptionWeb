
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Système de Like</title>
  <style>
    /* Ajoutez du style pour le bouton de like en forme de cœur */
    .like-button {
      cursor: pointer;
      background: none;
      border: none;
      font-size: 24px;
      color: #555;
    }

    .liked {
      color: #ff0000; /* Changez la couleur pour indiquer que l'élément est aimé */
    }
  </style>
</head>
<body>

  <script>
    // Ajoutez du JavaScript pour gérer les clics sur le bouton de like
    let isLiked = false;
    let likeCount = 0;

    function toggleLike() {
      isLiked = !isLiked;
      likeCount += isLiked ? 1 : -1;

      document.getElementById('like-count').innerText = likeCount;
      document.getElementById('like-button').classList.toggle('liked', isLiked);
    }
  </script>

</body>
</html>

