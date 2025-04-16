// public/js/validation.js
document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('busTrajetForm');
  if (!form) return;

  form.addEventListener('submit', function(e) {
    let valid = true;
    const errors = [];

    // reset
    ['stationDepart','stationArrivee','heureDepart','heureArrivee','numeroBus']
      .forEach(id => {
        document.getElementById(id).classList.remove('is-invalid');
        document.getElementById('error_' + id).innerText = '';
      });

    // 1) stationDepart
    const sd = form.stationDepart.value.trim();
    if (!sd) {
      valid = false;
      errors.push('La station de départ est obligatoire.');
      document.getElementById('stationDepart').classList.add('is-invalid');
      document.getElementById('error_stationDepart').innerText =
        'La station de départ est obligatoire.';
    }

    // 2) stationArrivee
    const sa = form.stationArrivee.value.trim();
    if (!sa) {
      valid = false;
      errors.push('La station d\'arrivée est obligatoire.');
      document.getElementById('stationArrivee').classList.add('is-invalid');
      document.getElementById('error_stationArrivee').innerText =
        'La station d\'arrivée est obligatoire.';
    }

    // 3&4) heures HH/MM
    const timeRe = /^(?:[01]\d|2[0-3])\/[0-5]\d$/;
    ['heureDepart','heureArrivee'].forEach(id => {
      const v = form[id].value.trim();
      if (!timeRe.test(v)) {
        valid = false;
        errors.push(`Le champ ${id==='heureDepart'?'heure de départ':'heure d\'arrivée'} doit être au format HH/MM.`);
        document.getElementById(id).classList.add('is-invalid');
        document.getElementById('error_' + id).innerText =
          'Si date pas sous le format HH/MM, veuillez ajouter l\'heure sous la forme HH/MM, merci !';
      }
    });

    // 5) numeroBus
    const nb = form.numeroBus.value.trim();
    if (!/^\d+$/.test(nb)) {
      valid = false;
      errors.push('Le numéro de bus doit contenir uniquement des chiffres.');
      document.getElementById('numeroBus').classList.add('is-invalid');
      document.getElementById('error_numeroBus').innerText =
        'Le numéro de bus doit contenir uniquement des chiffres.';
    }

    // si erreurs, affiche alerte globale
    if (!valid) {
      e.preventDefault();
      const alert = document.getElementById('formAlert');
      alert.innerHTML = '<ul class="mb-0"><li>' + errors.join('</li><li>') + '</li></ul>';
      alert.classList.remove('d-none');
      alert.scrollIntoView({ behavior: 'smooth' });
    }
  });
});
