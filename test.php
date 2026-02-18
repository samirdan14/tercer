<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Alias</title>
<style>
  * { box-sizing: border-box; }

  body{
    margin:0;
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
    background: radial-gradient(circle at 10% 20%, #7c3aed 0%, transparent 35%),
                radial-gradient(circle at 90% 30%, #22c55e 0%, transparent 40%),
                radial-gradient(circle at 60% 90%, #06b6d4 0%, transparent 35%),
                linear-gradient(135deg, #0b1020, #121a33);
    color:#fff;
    padding:24px;
  }

  .card{
    width:min(520px, 100%);
    background: rgba(255,255,255,0.12);
    border: 1px solid rgba(255,255,255,0.18);
    border-radius: 22px;
    padding: 28px;
    backdrop-filter: blur(14px);
    box-shadow: 0 18px 60px rgba(0,0,0,0.45);
    position: relative;
    overflow: hidden;
  }

  .card::before{
    content:"";
    position:absolute;
    inset:-2px;
    background: linear-gradient(120deg, rgba(255,255,255,0.25), transparent 40%, rgba(255,255,255,0.18));
    opacity: 0.5;
    pointer-events:none;
  }

  h1{
    margin: 0 0 6px;
    font-size: 28px;
    letter-spacing: .2px;
    position: relative;
  }

  .sub{
    margin: 0 0 18px;
    color: rgba(255,255,255,0.78);
    font-size: 14px;
    position: relative;
  }

  form{ position: relative; }

  .row{
    display:grid;
    gap:10px;
    margin: 14px 0;
  }

  label{
    font-size: 13px;
    color: rgba(255,255,255,0.85);
  }

  input{
    width:100%;
    padding: 12px 14px;
    border-radius: 14px;
    border: 1px solid rgba(255,255,255,0.18);
    background: rgba(0,0,0,0.22);
    color:#fff;
    outline:none;
    font-size: 15px;
    transition: transform .15s ease, border-color .2s ease, background .2s ease;
  }

  input:focus{
    border-color: rgba(34,197,94,0.55);
    background: rgba(0,0,0,0.28);
    transform: translateY(-1px);
  }

  .btn{
    width:100%;
    margin-top: 8px;
    padding: 12px 14px;
    border-radius: 14px;
    border: none;
    color: #0b1020;
    font-weight: 800;
    font-size: 15px;
    cursor:pointer;
    background: linear-gradient(135deg, #22c55e, #06b6d4, #7c3aed);
    box-shadow: 0 14px 30px rgba(0,0,0,0.35);
    transition: transform .15s ease, filter .2s ease;
  }

  .btn:hover{ transform: translateY(-2px); filter: brightness(1.08); }
  .btn:active{ transform: translateY(0px) scale(0.99); }

  .result{
    margin-top: 18px;
    padding: 16px;
    border-radius: 18px;
    background: rgba(255,255,255,0.10);
    border: 1px solid rgba(255,255,255,0.14);
    position: relative;
  }

  .result h2{
    margin: 0 0 10px;
    font-size: 18px;
  }

  .badge{
    display:inline-block;
    padding: 6px 10px;
    border-radius: 999px;
    background: rgba(34,197,94,0.20);
    border: 1px solid rgba(34,197,94,0.35);
    font-size: 12px;
    color: rgba(255,255,255,0.92);
    margin-bottom: 10px;
  }

  .grid{
    display:grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    margin-top: 10px;
  }

  .item{
    padding: 10px 12px;
    border-radius: 14px;
    background: rgba(0,0,0,0.18);
    border: 1px solid rgba(255,255,255,0.10);
  }

  .k{ font-size: 12px; color: rgba(255,255,255,0.72); }
  .v{ font-size: 16px; font-weight: 800; margin-top: 2px; }

  .aliasBig{
    font-size: 26px;
    font-weight: 900;
    letter-spacing: .6px;
  }

  .footerNote{
    margin-top: 14px;
    font-size: 12px;
    color: rgba(255,255,255,0.70);
  }
</style>
</head>
<body>

<div class="card">
  <h1>Alias de Pareja</h1>
  <p class="sub">Escribe dos nombres y generamos un alias + porcentaje con un extra aleatorio.</p>

  <form method="POST">
    <div class="row">
      <label>Nombre 1</label>
      <input type="text" name="nombre_uno" placeholder="Ej: Samir" required>
    </div>

    <div class="row">
      <label>Nombre 2</label>
      <input type="text" name="nombre_dos" placeholder="Ej: Daniela" required>
    </div>

    <button class="btn" type="submit">Generar</button>
  </form>

<?php
if ($_POST) {

    $nombre1 = $_POST["nombre_uno"];
    $nombre2 = $_POST["nombre_dos"];

    // Alias: 3 primeras letras del nombre1 + 3 últimas del nombre2
    $parte1 = substr($nombre1, 0, 3);
    $parte2 = substr($nombre2, -3);
    $alias  = $parte1 . $parte2;

    // Cantidad de caracteres
    $cant1 = strlen($nombre1);
    $cant2 = strlen($nombre2);

    $porcentaje = 0;

    // +15 si cada nombre contiene "a" (minúscula)
    if (str_contains(strtolower($nombre1), "a")) {
        $porcentaje += 15;
    }

    if (str_contains(strtolower($nombre2), "a")) {
        $porcentaje += 15;
    }

    // Random extra 0-30
    $resto = random_int(0, 30);

    // Sumar todo
    $porcentaje = $porcentaje + $cant1 + $cant2 + $resto;
?>
  <div class="result">
    <div class="badge">Resultado</div>
    <h2>Alias: <span class="aliasBig"><?php echo $alias; ?></span></h2>

    <div class="grid">
      <div class="item">
        <div class="k">Letras nombre 1</div>
        <div class="v"><?php echo $cant1; ?></div>
      </div>
      <div class="item">
        <div class="k">Letras nombre 2</div>
        <div class="v"><?php echo $cant2; ?></div>
      </div>
      <div class="item">
        <div class="k">Extra random</div>
        <div class="v"><?php echo $resto; ?></div>
      </div>
      <div class="item">
        <div class="k">Porcentaje final</div>
        <div class="v"><?php echo $porcentaje; ?>%</div>
      </div>
    </div>

    <div class="footerNote">Tip: si quieres que el % no pase de 100, se puede limitar con min().</div>
  </div>
<?php } ?>

</div>
</body>
</html>
