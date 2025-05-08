
<h1>Main Home</h1>

<div class="track-item">
  <button class="play-track" data-src="../Uploads/WhatsApp Audio 2025-05-03 at 14.34.56_b08f2fff.mp3">
    ▶️ Play Track 1
  </button>
  <p>Title: WhatsApp Audio 2025-05-03</p>
  <p>Artist: Unknown</p>
</div>

<div class="track-item">
  <button class="play-track" data-src="../Uploads/WhatsApp Audio 2025-05-06 at 14.12.18_e90fbdba.mp3">
    ▶️ Play Track 2
  </button>
  <p>Title: WhatsApp Audio 2025-05-06</p>
  <p>Artist: Unknown</p>
</div>


<!-- store the muisc or data in this form -->

<!--  Example: Assume $conn is your mysqli connection
 $query = "SELECT title, file_path FROM user_tracks WHERE user_id = ?";
 $stmt = $conn->prepare($query);
 $stmt->bind_param("i", $userId);
 $stmt->execute();
 $result = $stmt->get_result();

 while ($row = $result->fetch_assoc()) {
     $title = htmlspecialchars($row['title']);
     $filePath = htmlspecialchars($row['file_path']);
     echo '<button class="play-track" data-src="' . $filePath . '">▶️ ' . $title . '</button>';
 } -->
