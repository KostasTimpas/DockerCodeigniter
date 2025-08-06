<!DOCTYPE html>
<html>
<head>
    <title>Basketball Teams</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2rem; }
        table { border-collapse: collapse; width: 100%; }
        th, td { padding: 10px; border: 1px solid #ddd; }
        th { background-color: #f4f4f4; }
        img { height: 30px; }
    </style>
</head>
<body>
<h1>Basketball Teams</h1>

<?php if ($error): ?>
    <p style="color: red;"><?= esc($error) ?></p>
<?php elseif (empty($teams)): ?>
    <p>No teams found.</p>
<?php else: ?>
    <table>
        <thead>
        <tr>
            <th>Logo</th>
            <th>Name</th>
            <th>City</th>
            <th>Country</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($teams as $team): ?>
            <tr>
                <td><img src="<?= esc($team['team']['logo']) ?>" alt="Logo"></td>
                <td><?= esc($team['team']['name']) ?></td>
                <td><?= esc($team['team']['code']) ?></td>
                <td><?= esc($team['country']['name']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
</body>
</html>
