<div id="command-<?= $c["CommandID"] ?>" class="command">
    <div class="command-id">#<?= $c["CommandID"] ?></div>
    <div class="command-info">
        <div class="command-title"><?= $c["Title"] ?></div>
        <div class="command-desc"><?= ($c["Type"] == "series" ? "Série" : "Film") . " • " . substr($c["Date"], 0, 10) ?></div>
    </div>
</div>