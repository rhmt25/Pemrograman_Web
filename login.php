<?php
session_Start();
$username_valid = "Rahmat";
$password_valid = "123";

if(!isset($_POST['username']) || !isset($_POST['password'])){
    header("Location: index.html");
    exit();
}

$username = $_POST['username'];
$password = $_POST['password'];

if($username === $username_valid && $password === $password_valid){
    $_SESSION['login'][] = [
        "username" => $username,
        "password" => $password,
        "login_at" => date("Y-m-d H:i:s")
    ];
    
	$safeUsername = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
	$loginCount = count($_SESSION['login']);

	ob_start();
	var_dump($_SESSION['login']);
	$sessionDump = ob_get_clean();

	echo <<<HTML
	<!DOCTYPE html>
	<html lang="id">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Berhasil Login</title>
		<style>
			:root { --blue1:#1e3c72; --blue2:#2a5298; --gold1:#ffd700; --gold2:#ffed4e; --muted:#3b5fa3; --text:#0b132b; }
			* { box-sizing: border-box; }
			body { margin:0; font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, "Apple Color Emoji", "Segoe UI Emoji"; background: linear-gradient(135deg, var(--blue1) 0%, var(--blue2) 25%, var(--gold1) 75%, var(--gold2) 100%); background-attachment: fixed; color: var(--text); }
			.container { min-height: 100dvh; display:flex; align-items:center; justify-content:center; padding: 24px; }
			.card { width: 100%; max-width: 720px; background: linear-gradient(145deg, rgba(135,206,235,0.95) 0%, rgba(255,215,0,0.85) 50%, rgba(255,255,153,0.9) 100%); border: 3px solid #ffffff; border-radius: 20px; padding: 28px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); backdrop-filter: blur(10px); }
			.header { display:flex; align-items:center; justify-content:space-between; gap: 16px; margin-bottom: 18px; }
			.badge { font-size:12px; color:#ffffff; background: linear-gradient(145deg, #4a90e2 0%, #2c5aa0 100%); padding: 6px 10px; border-radius: 999px; font-weight: 700; letter-spacing:.4px; box-shadow: 0 2px 8px rgba(44,90,160,0.35); }
			h1 { margin: 0 0 6px; font-size: 28px; letter-spacing:.3px; color: var(--blue1); text-shadow: 2px 2px 4px rgba(0,0,0,0.08); }
			.subtitle { margin:0; color: var(--blue2); font-weight:600; }
			.stats { display:flex; gap: 16px; margin: 18px 0 20px; }
			.stat { flex:1; background: rgba(255,255,255,0.85); border: 2px solid #ffffff; border-radius: 12px; padding: 14px 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
			.stat .label { color: var(--blue2); font-size: 12px; font-weight: 700; }
			.stat .value { font-size: 22px; font-weight: 800; margin-top: 4px; color: var(--blue1); }
			.actions { display:flex; gap: 12px; margin: 6px 0 18px; }
			.btn { display:inline-flex; align-items:center; gap:8px; padding: 12px 16px; border-radius: 10px; font-weight: 700; text-decoration:none; transition: .2s ease; border: none; box-shadow: 0 4px 15px rgba(44,90,160,0.3); }
			.btn.logout { color:#ffffff; background: linear-gradient(145deg, #4a90e2 0%, #2c5aa0 100%); }
			.btn.logout:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(44,90,160,0.4); }
			.section { margin-top: 14px; }
			.section h3 { margin: 0 0 8px; font-size: 16px; color: var(--blue2); font-weight: 700; }
			pre { margin:0; padding:16px; background: #0e1b3f; border:2px solid #2c5aa0; border-radius: 12px; color:#e2e8f0; overflow:auto; box-shadow: inset 0 1px 4px rgba(0,0,0,0.5); }
		</style>
	</head>
	<body>
		<div class="container">
			<div class="card">
				<div class="header">
					<div>
						<h1>Selamat Datang, {$safeUsername}!</h1>
						<p class="subtitle">Anda sudah login sebanyak <strong>{$loginCount}</strong> kali.</p>
					</div>
					<span class="badge">Logged In</span>
				</div>
				<div class="stats">
					<div class="stat">
						<div class="label">Username</div>
						<div class="value">{$safeUsername}</div>
					</div>
					<div class="stat">
						<div class="label">Jumlah Login</div>
						<div class="value">{$loginCount}</div>
					</div>
				</div>
				<div class="actions">
					<a class="btn logout" href="logout.php">Logout</a>
				</div>
				<div class="section">
					<h3>Data Session (var_dump)</h3>
					<pre>{$sessionDump}</pre>
				</div>
			</div>
		</div>
	</body>
	</html>
	HTML;
} else {
    echo "Username atau Password salah.";
}

