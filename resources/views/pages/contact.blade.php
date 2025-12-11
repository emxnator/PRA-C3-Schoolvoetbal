<x-base-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
<div class="card">
<h1>Contactpagina</h1>
<p class="lead">Vul hieronder de contactgegevens in of gebruik het formulier om contact op te nemen.</p>


<!-- Contactformulier -->
<form id="contactForm" novalidate>
<div class="full">
<label for="schoolName">Naam van school</label>
<input id="schoolName" name="schoolName" type="text" placeholder="Bijv. Basisschool De Meer" required />
</div>


<div class="full">
<label for="addressName">Naam van adres / locatie</label>
<input id="addressName" name="addressName" type="text" placeholder="Bijv. Sportpark Oostveld, Veld 2" required />
</div>


<div>
<label for="coachEmail">E-mail van contact (de coach)</label>
<input id="coachEmail" name="coachEmail" type="email" placeholder="coach@school.nl" required />
<small class="hint">Dit adres wordt gebruikt voor wedstrijdafspraken en updates.</small>
</div>


<div>
<label for="numTeams">Hoeveel teams</label>
<input id="numTeams" name="numTeams" type="number" min="0" step="1" placeholder="Bijv. 4" required />
</div>


<div>
<label for="refName">Naam scheidsrechter</label>
<input id="refName" name="refName" type="text" placeholder="Bijv. Jan Jansen" />
</div>


<div>
<label for="refEmail">E-mail scheidsrechter</label>
<input id="refEmail" name="refEmail" type="email" placeholder="scheids@scheids.nl" />
</div>


<div class="full">
<label for="sport">Sport</label>
<select id="sport" name="sport" required>
<option value="">-- kies een sport --</option>
<option value="voetbal">Voetbal</option>
<option value="lijmbal">Lijmbal</option>
</select>
</div>


<div class="full">
<label for="message">Bericht (optioneel)</label>
<textarea id="message" name="message" placeholder="Bericht aan de organisatie / coach / scheidsrechter"></textarea>
</div>


<div class="full actions">
<button type="submit">Verstuur bericht</button>
<button type="button" class="secondary" id="previewBtn">Toon samenvatting</button>
<div style="margin-left:auto;color:var(--muted);font-size:0.9rem" id="status"></div>
</div>
</form>


<!-- Samenvatting / contactcards -->
<div class="info" id="summaryArea" aria-live="polite" style="display:none;margin-top:18px">
<div class="item">
<strong>Coach contact</strong>
<div id="summaryCoach">-</div>
</div>
<div class="item">
<strong>Scheidsrechter</strong>
<div id="summaryRef">-</div>
</div>
</div>


</div>
</div>
</body>
</html>    
</x-base-layout>
