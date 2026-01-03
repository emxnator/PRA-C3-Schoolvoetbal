<x-base-layout>
<!doctype html>
<html lang="nl">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Formulier</title>

<!-- Google Font (zelfde stijl) -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Inter', sans-serif;
        background: #f7f7f7;
        margin: 0;
    }

    .page {
        display: flex;
        justify-content: center;
        padding: 40px 20px;
    }

    .form-card {
        background: white;
        width: 650px;
        padding: 40px;
        border-radius: 14px;
        box-shadow: 0 8px 28px rgba(0,0,0,0.08);
    }

    h2 {
        text-align: center;
        color: #4d00c8;
        margin-top: 0;
        margin-bottom: 30px;
        font-weight: 700;
    }

    .form-group {
        margin-bottom: 22px;
    }

    label {
        font-weight: 600;
        color: #4d00c8;
        margin-bottom: 6px;
        display: block;
        font-size: 15px;
    }

    input, textarea {
        width: 100%;
        padding: 12px;
        font-size: 15px;
        border: 2px solid #ddd;
        border-radius: 8px;
        transition: 0.2s;
        font-family: inherit;
    }

    input:focus, textarea:focus {
        border-color: #7e2bff;
        outline: none;
        box-shadow: 0 0 6px rgba(126, 43, 255, 0.3);
    }

    .radio-row {
        display: flex;
        gap: 40px;
        margin-top: 6px;
    }

    .radio-row label {
        font-weight: 500;
        color: #222;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    button:hover {
        opacity: 0.9;
    }
</style>
</head>

<body>

<div class="page">
    <div class="form-card">

        <h2>Contactformulier</h2>

        <form>

            <div class="form-group">
                <label>Naam van school</label>
                <input type="text" placeholder="Schoolnaam">
            </div>

            <div class="form-group">
                <label>Naam van adres</label>
                <input type="text" placeholder="Adres">
            </div>

            <div class="form-group">
                <label>Email van coach</label>
                <input type="email" placeholder="coach@voorbeeld.nl">
            </div>

            <div class="form-group">
                <label>Hoeveel teams</label>
                <input type="number" min="0" placeholder="Aantal teams">
            </div>

            <div class="form-group">
                <label>Email van scheidsrechter</label>
                <input type="email" placeholder="scheids@voorbeeld.nl">
            </div>

            <div class="form-group">
                <label>Sport</label>
                <div class="radio-row">
                    <label><input type="radio" name="sport" value="voetbal"> Voetbal</label>
                    <label><input type="radio" name="sport" value="lijnbal"> Lijnbal</label>
                </div>
            </div>

            <div class="form-group">
                <label>Bericht</label>
                <textarea rows="5" placeholder="Typ je bericht..."></textarea>
            </div>

            <button type="submit">Verstuur bericht</button>

        </form>

    </div>
</div>

</body>
</html>

</x-base-layout>
