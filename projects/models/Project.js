const mongoose = require('mongoose');

const ProjectSchema = new mongoose.Schema({
  naziv: { type: String, required: true },
  opis: { type: String, required: true },
  cijena: { type: Number, required: true },
  obavljeni_poslovi: { type: String },
  datum_pocetka: { type: Date, required: true },
  datum_zavrsetka: { type: Date },
  clanovi: { type: [String], default: [] }
});

module.exports = mongoose.model('Project', ProjectSchema);
